<?php
/* Pre Data Processing */
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'pagelink.php');
require_once(MODDIR.'control.php');
require_once(SYDIR.'xtable.php');

$t=mysql_query("SELECT * FROM so_history WHERE status='1'");
if(mysql_num_rows($t)>0) $stocktaking=true;
else $stocktaking=false;

$mstr_shelf=Array();
$ts=dbSel("dcid,name","mstr_shelf","O/ dcid");
while($f=dbFA($ts)){
	$mstr_shelf[$f['dcid']]=$f['name'];
}

$nid=getsx('nid');
$t=mysql_query("SELECT * FROM catalog WHERE dcid='$nid' LIMIT 0,1");
$f=dbFAx($t);
$author=dbFetch("name","mstr_author","W/`dcid`='".$f['author']."'");
$publisher=dbFetch("name","mstr_publisher","W/`dcid`='".$f['publisher']."'");
$cla=dbSFA("name,code","mstr_class","W/dcid='".$f['class']."'");
// Sorting:
$sortby=getsx('sortby');
$sortmode=getsx('mode');
$sf=false;
$sm=($sortmode=='1')?" DESC":"";
if($sortby=='shelf'){
	$sql="SELECT t1.* FROM book t1 JOIN mstr_shelf t2 ON t1.shelf = t2.dcid WHERE catalog='$nid' ORDER BY t2.name".$sm;
	$sf=true;
} else {
	// Sorting fields
	$sfa=Array('nid','callnumber','available');
	foreach($sfa as $k=>$v){
		if($sortby==$v) $sf=true;
	}
	if($sf){
		$sfi=$sortby;
	} else {
		$sfi=$sfa[0]; $sortby="";
	}
	$sql="SELECT * FROM book WHERE catalog='$nid' ORDER BY ".$sfi.$sm;
}
if($sf){
	if($sortmode!='1') $smode='1';
	else $smode='0';
}

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

// Paging:
$page_link=RLNK."bibliographic.php?tab=catalog&act=view&nid=".$f['dcid'];
$page=1; // force page to 1 (no-pagging)

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
<table cellspacing="0" cellpadding="0" width="850px" style="margin-bottom:2px"><tr height="30px">
<td>
<button class="btn" style="float:left;margin-right:4px;width:55px" onclick="history.back(1)" style="margin-right:6px">
	<div class="bi_arrow">Back</div>
</button><?php if(!$stocktaking){?><button class="btn" style="float:left;margin-right:4px;width:96px" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=edit&nid=<?=$f['dcid']?>&back=view')" style="margin-right:6px">
	<div class="bi_edit">Edit catalog</div>
</button><button class="btn" style="float:left;margin-right:4px;width:85px" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$f['dcid']?>&back=view')">
	<div class="bi_add">Add book</div>
</button>
<?php }?>
</td></tr></table>
<table class="stable2" cellspacing="0" cellpadding="5px" width="600px" style="margin-top:20px">
<tr valign="top" style="height:110px">
	<td width="60px">
		<img src="<?=IMGC.($f['cover']==''?"nocover.jpg":$f['cover'])?>" width="60px"/>
	</td>
	<td style="padding-left:10px">
		<div style="font:15px <?=SFONT?>;color:<?=CDARK?>"><b><?=$f['title']?></b></div>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:6px">by <a class="linkb" target="_blank" href="<?=RLNK?>book.php?get=author&getid=<?=$r['author']?>" title="View all book by <?=$author?>"><?=$author?></a></div>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:4px">Publisher: <?=$publisher.($f['release']!=''?", ".$f['release']:"")?></div>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:4px">ISBN: <?=$f['isbn']?></div>
	</td>
	<td>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:26px;margin-bottom:4px">Classiffication: <?=$cla['name']." (".$f['classcode'].")"?></div>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-bottom:4px">Series: <?=$f['series']?></div>
		<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-bottom:4px">Language: <?=MstrGetname("language",$f['language'])?></div>
	</td>
</tr>
</table>
<?php if($ndata>0){
?>
<input type="hidden" id="redir" value="&nid=<?=$nid?>"/>
<table class="xtable" border="0" cellspacing="1px" width="850px">
	<tr>
		<td class="xtdh" width="1">
			<input type="checkbox" class="iCheck" id="xcek0" value="<?=$f['dcid']?>" onclick="checkAll(this.checked)"/>
		</td>
		<?=iThxp("Book number",'nid',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Call number",'callnumber',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Availability",'available',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Location",'shelf',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh">Borrowed by</td>
		<?php if(!$stocktaking){?><td class="xtdh">Options</td><?php }?>
	</tr>
<?php
$n=0; $rc=1; $k=1;
while($r=mysql_fetch_array($t)){if($rc==0){$rc=1;}else{$rc=0;};
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>">
		<td width="1">
			<input type="checkbox" class="iCheck" id="xcek<?=$k?>" value="<?=$r['dcid']?>" onclick="checkRow(<?=$k?>,this.checked)"/>
		</td>
		<td width="*" onclick="selectRow(<?=$k?>)"><?=$r['nid']?></td>
		<td width="100px" onclick="selectRow(<?=$k?>)"><?=$r['callnumber']?></td>
		<td width="100px" onclick="selectRow(<?=$k?>)"><?=($r['available']=='Y'?"Available":"Borrowed")?></td>
		<td width="120px" onclick="selectRow(<?=$k?>)"><?=$mstr_shelf[$r['shelf']]?></td>
		<td width="180px" onclick="selectRow(<?=$k?>)"><?=($r['brid']==0?"-":"")?></td>
		<?php if(!$stocktaking){?>
		<td width="119px">
			<button class="btn" style="width:24px;float:left;margin-right:2px" title="Edit book" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=rev&nid=<?=$r['dcid']?>')">
				<div class="bi_editb">&nbsp;</div>
			</button>
			<button class="btn" style="width:24px;float:left;margin-right:2px" title="Delete book" onclick="del(<?=$r['dcid']?>)">
				<div class="bi_delb">&nbsp;</div>
			</button>
			<?php if($r['available']=='Y'){?>
			<button class="btn" style="width:65px;float:left;margin-right:2px" onclick="">Borrow</button>
			<?php }else{?>
			<button class="btn" style="width:65px;float:left" onclick="">Return</button>
			<?php }?>
		</td>
		<?php }?>
	</tr>
<?php $k++;} ?>
</table>
<input type="hidden" id="xnrow" value="<?=$k?>"/>
<input type="hidden" id="newentry" value="<?=(($opt=='u' || $opt=='a')?"xrow".$cid:"E")?>"/>
<?php if(!$stocktaking){?>
<div style="<?=SFONT12?>margin-top:6px">
	<?php if($ndata>1){?>
	Option:
	&nbsp;:&nbsp;&nbsp;
	<a class="linkb" href="javascript:checkAll(true)">Check all</a> / <a class="linkb" href="javascript:checkAll(false)">Uncheck all</a>
	<span id="xdel" style="display:none">&nbsp;:&nbsp;&nbsp;<a class="linkb" href="javascript:checkAll(true)">Delete selected</a></span>
	<?php } else {?>
	<span id="xdel" style="display:none">Option:&nbsp;:&nbsp;&nbsp;<a class="linkb" href="javascript:checkAll(true)">Delete selected</a></span>
	<?php }?>
</div>
<?php }} else {?>
<div class="sfont">There is no book available in this catalog. Please <a class="linkb" href="<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$f['dcid']?>&back=view">add new book</a>.</div>
<?php }?>