<?php
require_once(MODDIR.'pagelink.php');
// Searching:
$keyw=trim(getsx('q'));
$search="";
if($keyw!=""){
	if(is_numeric($keyw)){
		$sql="SELECT * FROM book WHERE barcode='$keyw' LIMIT 0,1";
		//echo $sql;
		$t=mysql_query($sql);
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			$search=" WHERE dcid='".$r['catalog']."'";
		}
	} else {
		$search=" WHERE title='$keyw' OR title LIKE '$keyw %' OR title LIKE '% $keyw %' OR title LIKE '% $keyw' OR title LIKE '$keyw,%'";
	}
}
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<b>\$0</b>", $v);}

// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
// Sorting filelds
if($sortby=='author'){
	$sql="SELECT t1.* FROM catalog t1 JOIN mstr_author t2 ON t1.author = t2.dcid ".$search." ORDER BY t2.name";
	$sf=true;
}
else if($sortby=='title'){
	$sql="SELECT * FROM catalog ".$search." ORDER BY title";
	$sf=true;
}
else {
	$sortby='newest';
	$sql="SELECT * FROM catalog ".$search." ORDER BY bnew,dcid DESC";
	$sf=true;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."bookshelf.php";
// number per page
$npp=60;
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
// Re Query only in page
$sql.=" LIMIT $nps,$npp";
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);
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

//$t=mysql_query($sql);
//$ndata=dbNRow($t);
$shrow=ceil($ndata/6);
$sr=0; $nr=0; $dcid=-1;
//border:10px solid #b6550f;
$auth1='';
?>
<style type="text/css">
.viewopt {
	height:18px;border:none;padding:0 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;cursor:pointer;
	color: #999;
}
.viewopt:hover{
	color: #303942;
}
.viewopta {
	height:18px;border:none;padding:0 0 0 24px;margin:0 4px 12px 0;font:bold 13px 'Segoe UI',Verdana;
	color: #1c64d1;
}
.sorta{
	display:block;padding:2px 4px;width:60px;color:#1c64d1;text-decoration:none
}
.sorta:hover{
	background:<?=CLBLUE?>;
	color:#fff;
}
.shlabel{
	font:bold 10px <?=SFONT?>;padding:1px 4px;background:#fff;color:#444;box-shadow:0px 1px 2px rgba(0,0,0,0.5)
}
.sorta2{
	display:block;padding:2px 0px;width:80px;color:#1c64d1;text-decoration:none;
	float:left;text-align:center;
}
.sorta2:hover{
	background:<?=CLBLUE?>;
	color:#fff;
}
.pf_photo{
	width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat;overflow:hidden;cursor:pointer;
}
.pf_photo2{
	width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat;overflow:hidden;cursor:pointer;
	border:2px solid #fff;margin-bottom:2px;border-radius:5px;
}
</style>
<table cellspacing="0" cellpadding="0" border="0"><tr>
<td>
	<button class="viewopta" style="background:url('<?=IMGR?>vw_grid.png') left center no-repeat;" onclick="jumpTo('<?=RLNK?>bookshelf.php?setview=grid')">Grid view</button>
	<button class="viewopt" style="background:url('<?=IMGR?>vw_list.png') left center no-repeat;margin-left:20px" onclick="jumpTo('<?=RLNK?>bookshelf.php?setview=list')">List view</button>
</td>
<td>
	<table cellspacing="0" cellpadding="0" border="0"><tr>
	<?php if(gets('get')!=''){?>
	<td>
	<div style="height:16px;width:250px;border:none;padding:2px 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;color:#999">
		<div style="float:left">Viewing books by :&nbsp;</div>
		<div style="color:#1c64d1"><?=dbFetch("name","mstr_author","W/`dcid`='".gets('getid')."'")?></div>
	</div>
	</td>
	<?php } $a=1+($page-1)*10; ?>
	<td>
	<div style="height:16px;width:200px;border:none;padding:2px 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;color:#999">
		<div style="float:left;width:88px">Showing row :&nbsp;</div>
		<div style="position:relative;color:#1c64d1;float:left;cursor:pointer;padding-right:16px;background:url('<?=IMGR?>dnarrow.png') right 4px no-repeat" onclick="showRowMenu()"><?=$a.' - '.($a+9)?>
			<div id="rowmenu" style="width:320px;display:none;position:absolute;top:-2px;left:-124px;background:#fff;box-shadow:0px 2px 10px rgba(0,0,0,0.75)" onmouseover="enhrm=false" onmouseout="enhrm=true">
			<?php
			for($ll=1;$ll<=$nop;$ll++){ $a=1+($ll-1)*10;?>
				<a href="<?=pageLink($ll,$sortby)?>" class="sorta2"><?=$a.' - '.($a+9)?></a>
			<?php }?>
			</div>
		</div>
	</div>
	</td>
	<td>
	<div style="height:16px;width:200px;border:none;padding:2px 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;color:#999">
		<div style="float:left;width:72px">Sorted by :&nbsp;</div>
		<div style="position:relative;color:#1c64d1;float:left;cursor:pointer;padding-right:16px;background:url('<?=IMGR?>dnarrow.png') right 4px no-repeat" onclick="showSortMenu()"><?=$sortby?>
			<div id="sortmenu" style="display:none;position:absolute;top:-2px;left:-4px;background:#fff;box-shadow:0px 2px 10px rgba(0,0,0,0.75)" onmouseover="enhsm=false" onmouseout="enhsm=true">
				<a href="<?=pageLink($page,'newest')?>" class="sorta">newest</a>
				<a href="<?=pageLink($page,'title')?>" class="sorta">title</a>
				<a href="<?=pageLink($page,'author')?>" class="sorta">author</a>
			</div>
		</div>
	</div>
	</td>
	<td>
	<input id="xxx" type="text" style="position:absolute;top:-100px;left:-300px;float:left" onblur="hideSortMenu()"/>
	<input id="yyy" type="text" style="position:absolute;top:-100px;left:-300px;float:left" onblur="hideRowMenu()"/>
	</td>
	</tr></table>
</td>
</tr></table>
<table cellspacing="0" cellpadding="0"><tr valign="top"><td>
<div style="width:785px;height:600px;overflow:auto;">
<table cellspacing="0" cellpadding="0" style="border:10px solid #eebd46;" border="0">
<?php $bk=0; while($r=dbFA($t)){
if($sr==0){ $nr++; // begining of a row
if($sortby=='author') $auth1=dbFetch("name","mstr_author","W/`dcid`='".$r['author']."'");?>
<tr style="background:url('<?=IMGR?>shelfbg.png') repeat-x" valign="bottom" height="180px">
<?php
} if($dcid==-1)$dcid=$r['dcid']; // first book
?>
<td width="140px" align="center">
<?php
if($r['cover']==''){ $title=$r['title']; if($title!='') $title=str_replace("\\","",$title); else $title="Untitled";?>
<div id="cbook<?=($bk)?>" class="pf_photo" title="<?=$title?>" onclick="selectBook(<?=($bk++)?>,<?=$r['dcid']?>)">
	<div style="width:104px;height:138px;background:url('<?=IMGC.'default'.$r['bnew']?>.jpg') center top no-repeat;overflow:hidden">
	<div style="font:bold 11px Tahoma,Verdana;color:#fff;text-align:center;width:76px;padding:24px 6px 6px 14px;overflow:hidden">
		<div id="cvtitle" style="color:#fff;width:80px;height:90px;background:;padding:2px 2px;overflow:hidden"><?=$title?></div>
	</div>
	</div>
</div>
<?php } else {?>
<div id="cbook<?=($bk)?>" class="pf_photo" title="<?=$title?>" onclick="selectBook(<?=($bk++)?>,<?=$r['dcid']?>)">
	<div style="width:104px;height:138px;background:url('<?=IMGC.$r['cover']?>') center top no-repeat">
	<img src="<?=IMGC.'cvshade'.$r['bnew']?>.png"/>
	</div>
</div>
<span id="cvtitle" style="display:hidden"></span>
<?php }
?>
</td>
<?php $sr++; if($sr==6){ $sr=0;?>
</tr>
<tr style="height:20px;background:url('<?=IMGR?>shelfbg2.png') repeat-x"><td colspan="6" style="padding:0">
<?php if($sortby=='author'){ $auth2=dbFetch("name","mstr_author","W/`dcid`='".$r['author']."'"); ?>
	<span class="shlabel"><?=$auth1.' - '.$auth2?></span>
<?php }?>
</td></tr>
<?php }
$auth2=dbFetch("name","mstr_author","W/`dcid`='".$r['author']."'");
}
if($sr>0 && $sr<6){
for($i=$sr;$i<6;$i++){?>
<td width="140px" style="padding:40px 10px 0px 10px">
<div style="width:104px;height:138px">
	
</div>
</td>
<?php } ?>
</tr>
<tr style="height:20px;background:url('<?=IMGR?>shelfbg2.png') repeat-x"><td colspan="6" style="padding:0">
<?php if($sortby=='author'){ ?>
	<span class="shlabel"><?=$auth1.' - '.$auth2?></span>
<?php }?>
</td></tr>
<?php }
if($nr<5){
for($r=$nr;$r<5;$r++){?>
<tr style="background:url('<?=IMGR?>shelfbg.png') repeat-x" height="180px">
<?php for($i=0;$i<6;$i++){?>
<td width="140px" style="padding:40px 10px 0px 10px">
<div style="width:104px;height:138px">
	
</div>
</td>
<?php }?>
</tr>
<tr style="height:20px;background:url('<?=IMGR?>shelfbg2.png') repeat-x"><td colspan="6" style="padding:0"></td></tr>
<?php
}} ?>
</table>
</div>
</td>
<td style="padding-left:5px">
<div style="width:300px;border:1px solid #1c64d1;border-top:10px solid #1c64d1;background:url('<?=IMGR?>loader2.gif') center no-repeat">
<div id="book_info" style="width:300px;background:#fff;padding-bottom:20px">
<?php 
require_once(VWDIR.'v_book_detail.php');
?>
</div>
</div>
</td>
</tr></table>