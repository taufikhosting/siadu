<?php
/* Pre Data Processing */
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'control.php');
require_once(MODDIR.'pagelink.php');
require_once(SYDIR.'xtable.php');

// Searching:
$keyw=getsx('q');
$search=" WHERE cek!='Y'";
if($keyw!=""){
	$search.=" AND barcode LIKE '%$keyw%'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='title'){
	$sql="SELECT t1.* FROM ".$ntable." t1 JOIN catalog t2 ON t1.catalog = t2.dcid ".$search." ORDER BY t2.title".$sm;
	$sf=true;
} else if($sortby=='callnumber'){
	$sql="SELECT t1.* FROM ".$ntable." t1 JOIN book t2 ON t1.barcode = t2.barcode ".$search." ORDER BY t2.callnumber".$sm;
	$sf=true;
} else {
	// Sorting filelds
	$sfa=Array('barcode','title','callnumber');
	foreach($sfa as $k=>$v){
		if($sortby==$v) $sf=true;
	}
	if($sf){
		$sfi=$sortby;
	} else {
		$sfi="barcode"; $sortby="";
	}
	$sql="SELECT * FROM ".$ntable." ".$search." ORDER BY ".$sfi.$sm;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."stockopname.php?tab=note";
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

$sql.=" LIMIT $nps,$npp";
$t=mysql_query($sql);

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
<table cellspacing="0" cellpadding="0" width="850px" style="margin-bottom:2px"><tr height="30px">
<td>
<?php if($keyw==''){?>
<?php } else {?>
	<div class="vfont">
		<button class="btn" title="Show all lost book" onclick="jumpTo('<?=$page_link?>')" style="margin-right:20px">
			<div class="bi_arrow">All lost book</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching lost book with barcode <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> does not match with any lost book.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<form style="padding:0;margin:0" action="<?=RLNK?>stockopname.php?tab=init" method="get">
	<input type="hidden" name="tab" value="init"/>
	<?=iText('q','',"width:150px",'Search barcode')?>
	</form>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="1px" width="850px">
	<tr>
		<?=iThxp("Title",'title',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Barcode",'barcode',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:left">Call number</td>
		<td class="xtdh" style="text-align:left">Note</td>
		<td class="xtdh" style="text-align:left">Options</td>
	</tr>
<?php
$n=$nps; $rc=1; $k=1; $rh=$cover?'height="100px"':'';
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;};
	$y=mysql_query("SELECT * FROM catalog WHERE dcid='".$r['catalog']."' LIMIT 0,1");
	$f=mysql_fetch_array($y);
	$y1=mysql_query("SELECT * FROM book WHERE barcode='".$r['barcode']."' LIMIT 0,1");
	$f1=mysql_fetch_array($y1);
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="250px"><?=str_replace("\\","",$f['title'])?></td>
		<td width="100px" onclick="selectRow(<?=$k?>)"><?=src_replace($r['barcode'])?></td>
		<td width="150px"><?=$f1['callnumber']?></td>
		<td width="*"><div id="xrn<?=$r['dcid']?>"><?=$r['note']?><div></td>
		
		<td width="60px" align="left">
			<button class="btn" title="Give note" onclick="addNote(<?=$r['dcid']?>)">
				<div class="bi_edit">&nbsp;Note</div>
			</button>
		</td>
	</tr>
<?php $k++;}$n++;} ?>
</table>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>
<div style="margin-top:2px;width:850px;margin-bottom:20px">
<table cellspacing="0" cellpadding="0" align="right"><tr height="30px">
<td width="60px"><?php if($nop>1){?><span class="sfont">Pages:</span><?php }?></td>
<td align="right">
	<?php
	if($nop>1){ $fp=true;?>
	<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>
		<td width="24px" align="center"><a class="plink<?=(($page>1)?"\" title=\"Go to previous page\" href=\"".pageLinkp($page-1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> < </a></td>
		<?php for($n=1;$n<=$nop;$n++){ if(($n>=($page-3) && $n<=($page+3)) || $n==$nop || $n==1){ $fp=true;?>
		<td width="24px" align="center"><a class="plink<?=(($n!=$page)?"\" title=\"Go to page $n\" href=\"".pageLinkp($n,gets('sortby'),gets('mode'),gets('q')):"a")?>"><?=$n;?></a></td>
		<?php } else if($fp) { $fp=false; echo '<td width="24px" align="center"><span class="sfont">...</span></td>';
		}}?>
		<td width="24px" align="center"><a class="plink<?=(($page<$nop)?"\" title=\"Go to next page\" href=\"".pageLinkp($page+1,gets('sortby'),gets('mode'),gets('q')):"o")?>"> > </a></td>
	</tr></table>
	<?php }?>
</td>
</tr></table></div>
<table cellspacing="0" cellpadding="0" width="850px" border="0" style="margin-top:60px"><tr>
<td>
	<input class="btn" type="button" value="Back" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=cek')"/>
</td>
<td align="right">
	<input type="button" class="btnx" value="Finish" onclick="doneNote()" />
	<form id="donecekform" action="<?=RLNK?>sofinish.php" method="post">
		<input type="hidden" name="req" value="donenote"/>
		<input type="hidden" name="cid" value="<?=$tblid?>"/>
	</form>
</td>
</tr></table>
<?php }
?>
