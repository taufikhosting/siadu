<?php 
require_once(MODDIR.'masterdb.php');
require_once(MODDIR.'control.php');

$lbc=dbFetch("barcode","book","O/barcode DESC");
if($lbc=='') $lbc=1;
else $lbc=intval($lbc)+1;

$mstr_shelf=Array();
$ts=dbSel("dcid,name","mstr_shelf","O/ dcid");
while($l=dbFA($ts)){
	$mstr_shelf[$l['dcid']]=$l['name'];
}
$cla=dbSFA("name,code","mstr_class","W/dcid='".$r['class']."'");
$txtWidth="width:200px";
if(!empty($f['callnumber'])){
	$callnum=$f['callnumber'];
} else {
	$callnum=$r['classcode']." ".dbFetch("prefix","mstr_author","W/dcid='".$r['author']."'")." ".strtolower(substr(preg_replace("/(\"|\')/","",$r['title']),0,1));
}
$f['nid']="0/".dbFetch("val","mstr_setting","W/dcid='4'");
?>
<div class="hl1" style="margin-top:20px">Add book to new catalog:</div>
<input type="hidden" id="dcid" name="dcid" value="<?=$f['dcid']?>" />
<input type="hidden" id="catalog" name="catalog" value="<?=$r['dcid']?>" />
<table class="stable" cellspacing="0" cellpadding="4px" width="" border="0" style="margin-left:0px"><tr valign="top">
<td width="340px">
<div class="hl2" style="margin-top:10px;margin-bottom:10px">Bibliographic Informations</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
		<tr><td width="100px" align="left">Title</td><td>: <?=$r['title']?></td></tr>
		<tr><td  align="left">Author</td><td>: <?=MstrGetName("author",$r['author'])?></td></tr>
		<tr><td  align="left">Publisher</td><td>: <?=MstrGetName("publisher",$r['publisher'])?></td></tr>
		<tr><td  align="left">Classification</td><td>: <?=$cla['name']." (".$r['classcode'].")"?></td></tr>
		<tr><td  align="left">ISBN</td><td>: <?=$r['isbn']?></td></tr>
		<tr><td  align="left">Publish year</td><td>: <?=$r['release']?></td></tr>
		<tr><td  align="left">Series</td><td>: <?=$r['series']?></td></tr>
		<tr><td  align="left">Language</td><td>: <?=MstrGetname("language",$r['language'])?></td></tr>
		<tr><td  align="left">&nbsp;</td><td></td></tr>
		<?php $nb=mysql_num_rows(mysql_query("SELECT dcid FROM book WHERE catalog='".$r['dcid']."'"))?>
		<tr><td  align="left">Total book</td><td>: <?=$nb." book".($n>1?"s":"")?></td></tr>
</table>
<div id="formmsg" style="display:none">Saving. Please wait...</div>
</td>
<td style="padding-left:20px">
<div class="hl2" style="margin-top:10px;margin-bottom:10px"><?=$act=='add'?"New ":""?>Book Indentity</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="140px" align="left"><b>Barcode:</b></td><td><?=iText('barcode',$bcode,$txtWidth.";font-weight:bold",'','onkeyup="getNid();vBarcode()" onblur="vBarcode(0)"')?></td></tr>
	<tr id="rebarcode" style="display:none"><td></td><td><div id="ebarcode" class="espan">You can't leave this empty.</div></td></tr>
	<tr><td><b>Book number:</b></td><td><?=iText('nid',$f['nid'],"$txtWidth;font-weight:bold",'','onkeyup="backNid()" onblur="vNid(0)"')?>
	<tr id="renid" style="display:none"><td></td><td><div id="enid" class="espan">You can't leave this empty.</div></td></tr>
</table>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="140px"><b>Call number:</b></td><td><?=iText('callnumber',$callnum,"$txtWidth;font-weight:bold",'','onblur="vCNum(0)"')?></td></tr>
	<tr id="recnum" style="display:none"><td></td><td><div id="ecnum" class="espan">You can't leave this empty.</div></td></tr>
</table>

<div class="hl2" style="margin-top:10px;margin-bottom:10px">Book source</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="12px" align="left">
		<input id="bsr" class="iCheck" type="radio" <?=isCheck($f['source'],"r")?> name="source" value="r"/></td><td width="119px"><label for="bsr"><div>Buy:</div></label></td>
		<td><?=iText('sourcer',($f['source']=='r'?$f['sourceval']:""),$txtWidth,'price')?></td></tr>
	<tr><td width="12px" align="left">
		<input id="bsg" class="iCheck" type="radio" name="source" <?=isCheck($f['source'],"g")?>  value="g"/></td><td width="119px"><label for="bsg"><div>Gift:</div></label></td>
		<td><?=iText('sourceg',($f['source']=='g'?$f['sourceval']:""),$txtWidth,'from')?></td></tr>
</table>

<div class="hl2" style="margin-top:10px;margin-bottom:10px">Book allocation</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0" style="margin-bottom:30px">
	<tr><td width="140px" align="left">Place book in:</td><td><?=iSelect('shelf',$mstr_shelf,$f['shelf'])?></td></tr>
</table>
<div id="formbtn">
<input type="button" class="btn" value="Cancel" onclick="closeNewCatalog()" style="margin-right:5px"/>
<input type="button" class="btnx" value="Save" style="margin-right:35px" onclick="saveForm2()"/>
</div>
</td>
</tr></table>