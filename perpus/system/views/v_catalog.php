<?php
/* Pre Data Processing */
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'control.php');
require_once(MODDIR.'pagelink.php');
require_once(SYDIR.'xtable.php');

$t=mysql_query("SELECT * FROM so_history WHERE status='1'");
if(mysql_num_rows($t)>0) $stocktaking=true;
else $stocktaking=false;

if(gets('cover')=='show'){
	$_SESSION['joshlibcatcover']='s';
}
else if(gets('cover')=='hide'){
	$_SESSION['joshlibcatcover']='h';
}
$cover=true;
if(!empty($_SESSION['joshlibcatcover'])){
	if($_SESSION['joshlibcatcover']=='h') $cover=false;
}

// Searching:
$keyw=getsx('q');
$search="";
if($keyw!=""){
	if(is_numeric($keyw)){
		$sql="SELECT * FROM book WHERE barcode='$keyw' LIMIT 0,1";
		//echo $sql;
		$t=mysql_query($sql);
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			$search=" WHERE dcid='".$r['catalog']."'";
		} else {
			$search=" WHERE dcid='0'";
		}
	} else {
		$search=" WHERE title='$keyw' OR title LIKE '$keyw %' OR title LIKE '% $keyw %' OR title LIKE '% $keyw' OR title LIKE '$keyw,%'";
	}
	//$search=" WHERE title LIKE '%$keyw %' OR title LIKE '% $keyw' OR title LIKE '% $keyw %' OR title='$keyw'";
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='author'){
	$sql="SELECT t1.* FROM catalog t1 JOIN mstr_author t2 ON t1.author = t2.dcid ".$search." ORDER BY t2.name".$sm;
	$sf=true;
} else if($sortby=='publisher'){
	$sql="SELECT t1.* FROM catalog t1 JOIN mstr_publisher t2 ON t1.publisher = t2.dcid ".$search." ORDER BY t2.name".$sm;
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
		$sfi="title"; $sortby="";
	}
	$sql="SELECT * FROM catalog ".$search." ORDER BY ".$sfi.$sm;
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
<?php if($keyw==''){ if(!$stocktaking){?>
	<button class="btn" title="Add new catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=new')">
		<div class="bi_add">New catalog</div>
	</button>
<?php }} else {?>
	<div class="vfont">
		<button class="btn" title="Show all catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog')" style="margin-right:20px">
			<div class="bi_arrow">All catalog</div>
		</button>
	<?php if($ndata>0){ ?>
		Searching catalog about <b>"<?=$keyw?>"</b>, found <?=$ndata?> result:
	<?php } else {?>
		<b><?=$keyw?></b> does not match with any catalog.
	<?php } ?>
	</div>
<?php } ?>
</td>
<td align="right">
	<form style="padding:0;margin:0" action="<?=RLNK?>bibliographic.php" method="get">
	<input type="hidden" name="tab" value="catalog"/>
	<?=iText('q','',"width:150px",'Search title or barcode')?>
	</form>
</td>
</tr></table>
<input type="hidden" id="pagelink" value="<?=(($page!='')?"&page=".$page:"")?><?=(($sortby!='')?"&sortby=".$sortby:"")?><?=(($smode!='')?"&mode=".$sortmode:"")?><?=(($keyw!='')?"&q=".$keyw:"")?>"/>
<?php if($ndata>0){?>
<table class="xtable" border="0" cellspacing="0" width="850px">
	<tr>
		<td class="xtdh" width="1">
			<input type="checkbox" class="iCheck" id="xcek0" value="<?=$r['dcid']?>" onclick="checkAll(this.checked)"/>
		</td>
		<?php if($cover){?><td class="xtdh" style="text-align:center">Cover</td><?php }?>
		<?=iThxp("Title",'title',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Author",'author',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Publisher",'publisher',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Availability</td>
		<td class="xtdh" style="text-align:left">Options</td>
	</tr>
<?php
$n=$nps; $rc=1; $k=1; $rh=$cover?'height="100px"':'';
while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;};
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="1">
			<input type="checkbox" class="iCheck" id="xcek<?=$k?>" value="<?=$r['dcid']?>" onclick="checkRow(<?=$k?>,this.checked)"/>
		</td>
		<?php if($cover){?>
		<td width="70px" align="center">
			<img src="<?=IMGC.($r['cover']==''?"nocover.jpg":$r['cover'])?>" width="60px"/>
		</td>
		<?php }?>
		<td width="*" onclick="selectRow(<?=$k?>)"><?=src_replace($r['title'])?></td>
		<td width="130px" onclick="selectRow(<?=$k?>)"><?=MstrGetName("author",$r['author'])?></td>
		<td width="140px" onclick="selectRow(<?=$k?>)"><?=MstrGetName("publisher",$r['publisher'])?></td>
		<?php
			$nbook=dbSRow("book","W/`catalog`='".$r['dcid']."'"); $abook=0;
		?>
		<td width="100px" align="center" <?php if($nbook==0){?>onclick="selectRow(<?=$k?>)"<?php }?>>
			<?php
				if($nbook>0){
				$abook=dbSRow("book","W/`catalog`='".$r['dcid']."' AND `available`='Y'");
				echo $abook." of ".$nbook;
				} else echo "N/A";
			?>
		</td>
		<td width="" align="left">
			<table class="ctable" cellspacing="0" cellpadding="0" width="142px" border="0" style="width:<?=($stocktaking?"50":"138")?>px"><tr>
			<td style="width:26px"><button class="btn" style="width:24px;margin:0;" title="View books" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=view&nid=<?=$r['dcid']?>')">
				<div class="bi_srcb">&nbsp;</div>
			</button></td>
			<?php if(!$stocktaking){?>
			<td style="width:26px"><button class="btn" style="width:24px" title="Edit catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=edit&nid=<?=$r['dcid']?>')">
				<div class="bi_editb">&nbsp;</div>
			</button></td>
			<td style="width:26px"><button class="btn" style="width:24px" title="Delete catalog" onclick="del(<?=$r['dcid']?>)">
				<div class="bi_delb">&nbsp;</div>
			</button></td>
			<td style="width:60px"><button class="btn" style="width:60px" title="Add book to catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')">
				<div class="bi_add">Book</div>
			</button></td>
			<?php } else {?>
			<td>&nbsp;</td>
			<?php }?>
			</tr></table>
		</td>
	</tr>
<?php $k++;}$n++;} ?>
</table>
<div style="<?=SFONT12?>margin-top:6px">
	Option:
	<?php if($cover){?>
	<a class="linkb" href="<?=getCPageLinkp()."&cover=hide"?>">Hide cover</a>
	<?php }else{?>
	<a class="linkb" href="<?=getCPageLinkp()."&cover=show"?>">Show cover</a>
	<?php } if($ndata>1){?>
	&nbsp;:&nbsp;&nbsp;
	<a class="linkb" href="javascript:checkAll(true)">Check all</a> / <a class="linkb" href="javascript:checkAll(false)">Uncheck all</a>
	<?php }?>
	<span id="xdel" style="display:none">&nbsp;:&nbsp;&nbsp;<a class="linkb" href="javascript:checkAll(true)">Delete selected</a></span>
</div>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>
<div style="margin-top:2px;width:850px;margin-bottom:20px">
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
<?php }
?>
