<?php
/* Pre Data Processing */

// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	$search=" WHERE title LIKE '%$keyw%'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='author'){
	$sql="SELECT t1.* FROM book t1 JOIN mstr_author t2 ON t1.author = t2.dcid ".$search." ORDER BY t2.name".$sm;
	$sf=true;
} else if($sortby=='publisher'){
	$sql="SELECT t1.* FROM book t1 JOIN mstr_publisher t2 ON t1.publisher = t2.dcid ".$search." ORDER BY t2.name".$sm;
	$sf=true;
} else {
	// Sorting filelds
	$sfa=Array('title','author','publisher','avail');
	foreach($sfa as $k=>$v){
		if($sortby==$v) $sf=true;
	}
	if($sf){
		$sfi=($sortby=='date')?'date1':$sortby;
	} else {
		$sfi="barcode"; $sortby="";
	}
	$sql="SELECT * FROM book ".$search." ORDER BY ".$sfi.$sm;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."bibliographic.php?tab=catalog";
// number per page
$npp=6;
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

$mstr_author=MstrGet("mstr_author");
$mstr_publisher=MstrGet("mstr_publisher");
?>
<script type="text/javascript" language="javascript">
function goSearch(a){
	jumpTo('<?=$page_link?>&q='+a);
}
</script>
<table style="display:none" cellspacing="0" cellpadding="0" width="400px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
	<button class="btn" title="Add new book catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=new')">
		<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">New catalog</div>
	</button>
<?php } else {?>
	<div class="sfont">
		<button class="btn" title="Show all classification" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog')" style="margin-right:20px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">All catalog</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> does not match with any catalog.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<?php if($ndata>0){?>
	<form style="padding:0;margin:0" action="<?=RLNK?>bibliographic.php" method="get">
	<input type="hidden" name="tab" value="catalog"/>
	<?=iText('q','',"width:150px",'Search catalog title')?>
	</form>
	<?php }?>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="1px" width="550px">
	<tr>
		<td class="xtdh" style="text-align:center">Cover</td>
		<?=iThxp("Book",'title',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Barcode",'barcode',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Options</td>
	</tr>
<?php
$n=0; $rc=1; //$p=Array('title','type','host','place','date1','date2','speaker','participant');
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
	$ct=dbSFA("*","catalog","W/dcid='".$r['catalog']."'");
	$ttile='<b>"'.$ct['title'].'"</b>';
	?>
	<tr id="p_train<?=$r['dcid']?>" class="xxr<?=$rc?>" height="100px">
		<td width="70px" align="center">
			<img src="<?=IMGC.($ct['cover']==''?"nocover.jpg":$ct['cover'])?>" width="60px"/>
		</td>
		<td width="*"><b><?=str_replace("\\","",src_replace($ct['title']))?></b><br/> by <?=$mstr_author[$ct['author']]?></td>
		<td width="100px"><?=$r['barcode']?></td>
		<td width="70px" align="center">
			<button class="btn" title="Add book to loan list" onclick="getBook('<?=$r['barcode']?>')">Borrow</button>
		</td>
	</tr>
<?php } $n++; } ?>
</table>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"p_train".$cid:"E")?>"/>
<div style="margin-top:2px;width:400px;margin-bottom:20px">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ ?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php }?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table></div>
<?php }?>