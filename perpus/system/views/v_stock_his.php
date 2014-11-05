<?php
/* Pre Data Processing */
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'control.php');
require_once(MODDIR.'pagelink.php');
require_once(SYDIR.'xtable.php');

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
	$sql="SELECT t1.* FROM so_history t1 JOIN mstr_author t2 ON t1.author = t2.dcid ".$search." ORDER BY t2.name".$sm;
	$sf=true;
} else if($sortby=='publisher'){
	$sql="SELECT t1.* FROM so_history t1 JOIN mstr_publisher t2 ON t1.publisher = t2.dcid ".$search." ORDER BY t2.name".$sm;
	$sf=true;
} else {
	// Sorting filelds
	$sfa=Array('name','date','status');
	foreach($sfa as $k=>$v){
		if($sortby==$v) $sf=true;
	}
	if($sf){
		$sfi=$sortby;
	} else {
		$sfi="name"; $sortby="";
	}
	$sql="SELECT * FROM so_history ".$search." ORDER BY ".$sfi.$sm;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."stockopname.php?tab=history";
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
<input type="hidden" id="redir" value="<?=getCPageLink()?>"/>
<?php if($ndata>0){?>
<table cellspacing="0" cellpadding="0" width="850px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
	<button class="btn" onclick="jumpTo('<?=RLNK?>stockopname.php')" style="margin-right:20px">
		<div class="bi_arrow">Back</div>
	</button>
<?php } else {?>
	<div class="vfont">
		<button class="btn" title="Show all catalog" onclick="jumpTo('<?=RLNK?>stockopname.php&tab=history')" style="margin-right:20px">
			<div class="bi_arrow">All catalog</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> does not match with any stock opname.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<form style="padding:0;margin:0" action="<?=RLNK?>bibliographic.php" method="get">
	<input type="hidden" name="tab" value="catalog"/>
	<?=iText('q','',"width:150px",'Stock take name')?>
	</form>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<table class="xtable" border="0" cellspacing="1px" width="850px">
	<tr>
		<?php if($cover){?><td class="xtdh" style="text-align:center">Cover</td><?php }?>
		<?=iThxp("Stock stake name",'name',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Initial date",'date',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Finish date",'status',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:left">Description</td>
		<td class="xtdh" style="text-align:left">Options</td>
	</tr>
<?php
$n=0; $rc=1; $k=1; $rh=$cover?'height="100px"':'';
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;};
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="*"><?=src_replace($r['name'])?></td>
		<td width="120px"><?=fftgl($r['date'])?></td>
		<td width="120px"><?=($r['status']=='3'?fftgl($r['date2']):"Unfinished")?></td>
		<td width="200px"><?=$r['description']?></td>
		<td width="75px" align="left">
		<?php if($r['status']=='3'){?>
			<button class="btn" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=report&nid=<?=$r['dcid']?>')">
				<div class="bi_pri">Report</div>
			</button>
		<?php } else {?>
			<button class="btnz" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=init')">
				Continue
			</button>
		<?php }?>
		</td>
	</tr>
<?php $k++;}$n++;} ?>
</table>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>
<div style="margin-top:2px;width:700px;margin-bottom:20px">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,getsx('sortby'),getsx('mode'),getsx('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ ?>
		<td><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,getsx('sortby'),getsx('mode'),getsx('q')):"a")?>"><?=$n;?></a></td>
		<?php }?>
		<td><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,getsx('sortby'),getsx('mode'),getsx('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table></div>
<?php } else {?>
<div class="sfont" style="padding-top:30px;margin-bottom:20px">There is no stock take process finished</div>
<button type="button" class="btn" value="Back" style="margin-right:6px" onclick="jumpTo('<?=RLNK?>stockopname.php')">
<div class="bi_arrow">Back</div></button>
<?php }?>

