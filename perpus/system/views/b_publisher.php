<?php
/* Pre Data Processing */

// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	$search=" WHERE name LIKE '%$keyw%'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
// Sorting filelds
$sfa=Array('name','nbook','address','phone','note');
foreach($sfa as $k=>$v){
	if($sortby==$v) $sf=true;
}
if($sf){
	$sfi=($sortby=='date')?'date1':$sortby;
} else {
	$sfi="name"; $sortby="";
}
$sql="SELECT * FROM mstr_publisher ".$search." ORDER BY ".$sfi.$sm;
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."bibliographic.php?tab=publisher";
// number per page
$npp=30;
// number of page
$nop = ceil($ndata/$npp);
// current page
$page=getsx('page');
if($page=='') $page=1;
if(intval($page)>$ndata) $page=$ndata;
if(intval($page)<1) $page=1;
// number in page row start
$nps = $npp*($page-1);
// number in page row last
$npl = $nps+$npp;

// find item update location
$l=-1;
if($opt=='a' || $opt=='u'){
	$l=1;
	while($k=mysql_fetch_array($t)){
		if($cid==$k['dcid']){ // found!
			// Re-Calculate page:
			$page=ceil(($l)/$npp);
			$nps = $npp*($page-1);
			$npl = $nps+$npp;
			break;
		}
		$l++;
	}
	// Re-Queries:
	$t=mysql_query($sql);
	$ndata=mysql_num_rows($t);
}
?>
<script type="text/javascript" language="javascript">
function goSearch(a){
	jumpTo('<?=$page_link?>&q='+a);
}
</script>
<table cellspacing="0" cellpadding="0" width="800px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
	<button class="btn" title="Add new publisher" onclick="b_publisher('af')">
		<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">New publisher</div>
	</button>
<?php } else {?>
	<div class="sfont">
		<button class="btn" title="Show all publisher" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=publisher')" style="margin-right:20px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">All publisher</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> does not match with any publisher.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<form style="padding:0;margin:0" action="<?=RLNK?>bibliographic.php" method="get">
	<input type="hidden" name="tab" value="publisher"/>
	<?=iText('q','',"width:150px",'Search publisher')?>
	</form>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="1px" width="800px">
	<tr>
		<td class="xtdh" style="text-align:center">No</td>
		<?=iThxp("Name",'name',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("No. of books",'nbook',$page,$sortby,$smode,$keyw,"text-align:center")?>
		<?=iThxp("Address",'address',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Phone",'phone',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Note",'note',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Options</td>
	</tr>
<?php
$n=0; $rc=1; //$p=Array('title','type','host','place','date1','date2','speaker','participant');
while($r=mysql_fetch_array($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
	?>
	<tr id="p_train<?=$r['dcid']?>" class="xr<?=$rc?>">
		<td width="30px" align="center"><?=($n+1)?></td>
		<td width="*"><?=src_replace($r['name'])?></td>
		<td width="110px" align="center"><?=$r['nbook']?></td>
		<td width="200px" ><?=$r['address']?></td>
		<td width="100px"><?=$r['phone']?></td>
		<td width="100px" ><?=$r['note']?></td>
		<td width="60px" align="center">
			<button class="btnedit" title="Edit" onclick="b_publisher('uf',<?=$r['dcid']?>)"></button>
			<button class="btndel" title="Delete" onclick="b_publisher('df',<?=$r['dcid']?>)"></button>
		</td>
	</tr>
<?php } $n++; } ?>
</table>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"p_train".$cid:"E")?>"/>
<div style="margin-top:2px;width:800px;margin-bottom:20px">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){ $fp=true;?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ if(($n>=($page-3) && $n<=($page+3)) || $n==$nop || $n==1){ $fp=true;?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php } else if($fp) { $fp=false; echo "<td><span class=\"sfont\">...</span></td>";
		}}?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table></div>
<?php }?>