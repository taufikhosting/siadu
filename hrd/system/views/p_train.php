<?php
/** Global Variables */
$mstr_traintype=MstrGetTraintype();

/* Pre Data Processing */
// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	$search=" WHERE title LIKE '%$keyw%' OR type LIKE '%$keyw%'";
	$t=mysql_query("SELECT dcid FROM mstr_traintype WHERE name LIKE '%$keyw%'");
	while($r=mysql_fetch_array($t)){
		$search.=" OR type='".$r['dcid']."'";
	}
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='type'){
	$sql="SELECT t1.* FROM training t1 JOIN mstr_traintype t2 ON t1.type = t2.dcid ORDER BY t2.name".$sm;
	$sf=true;
} else {
	// Sorting filelds
	$sfa=Array('title','host','place','date','speaker','participant');
	
	foreach($sfa as $k=>$v){
		if($sortby==$v) $sf=true;
	}
	if($sf){
		$sfi=($sortby=='date')?'date1':$sortby;
	} else {
		$sfi="title"; $sortby="";
	}
	$sql="SELECT * FROM training ".$search." ORDER BY ".$sfi.$sm.", dcid DESC";
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."training.php";
// number per page
$npp=20;
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
<table cellspacing="0" cellpadding="0" width="940px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
	<button class="btn" title="Add new training" onclick="p_train('af')">
		<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">New training</div>
	</button>
<?php } else {?>
	<div class="sfont">
		<button class="btn" title="Show all training" onclick="jumpTo('<?=RLNK?>training.php')" style="margin-right:20px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">All training</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> no match with any traning.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<?php
	if($nop>1){?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLink($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ ?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLink($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php }?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLink($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="1px" width="940px">
	<tr>
		<td class="xtdh" style="text-align:center">No</td>
		<?=iThx("Title",'title',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Type",'type',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Host",'host',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Place",'place',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Date",'date',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Speaker",'speaker',$page,$sortby,$smode,$keyw)?>
		<?=iThx("Participant",'participant',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Option</td>
	</tr>
<?php
$n=0; $rc=1; //$p=Array('title','type','host','place','date1','date2','speaker','participant');
while($r=mysql_fetch_array($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
	?>
	<tr id="p_train<?=$r['dcid']?>" class="xr<?=$rc?>">
		<td width="30px" align="center"><?=($n+1)?></td>
		<td width="*"><?=src_replace($r['title'])?></td>
		<td width="80px"><?=src_replace($mstr_traintype[$r['type']])?></td>
		<td width="110px" ><?=$r['host']?></td>
		<td width="100px" ><?=$r['place']?></td>
		<td width="110px"><?=$date1?><?=(($date1!=$date2)?" to<br/>".$date2:"")?></td>
		<td width="100px" ><?=$r['speaker']?></td>
		<td width="100px" ><?=$r['participant']?></td>
		<td width="60px" align="center">
			<button class="btnedit" title="Edit" onclick="p_train('uf',<?=$r['dcid']?>)"></button>
			<button class="btndel" title="Delete" onclick="p_train('df',<?=$r['dcid']?>)"></button>
		</td>
	</tr>
<?php } $n++; } ?>
</table>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"p_train".$cid:"E")?>"/>
<?php }?>