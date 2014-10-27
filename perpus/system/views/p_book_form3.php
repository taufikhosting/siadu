<?php 
require_once(MODDIR.'popbox.php');
function iPopbox2($d,$t,$p="",$cb=""){
	if($p=="") $p=$t;
	$f=explode("-",$t);
	$q=explode("-",$p);
	$s="<div id=\"popd_".$d."\" style=\"float:left;margin-left:2px\">";
	$s.="<button type=\"button\" class=\"obtna\" title=\"Add new ".$f[0]."\" onclick=\"open_popbox('".$d."')\" style=\"margin-left:2px\">";
	$s.="<img src=\"".IMGR."add.png\" /></button>";
	$s.="<div id=\"popb_".$d."\" class=\"popblock2\" style=\"display:none;position:fixed;top:0;left:0\" onclick=\"close_popbox('".$d."')\"></div>";
	$s.="<div id=\"popx_".$d."\" class=\"popbox\" style=\"background-position:0 0;display:none\">";
	$s.="<table cellspacing=\"0\" cellpadding=\"0\" width=\"310px\"><tr height=\"58px\" style=\"padding-top:10px\">";
	$s.="<td width=\"35px\" align=\"right\"><input type=\"button\" class=\"popx\" title=\"Cancel\" onclick=\"close_popbox('".$d."')\"/></td>";
	$s.="<td align=\"center\">".iText("popi_".$d,'',"width:40px;text-align:center",$q[0]).iText("popi_".$d."1",'',"width:174px;margin-left:4px",$q[1])."</td>";
	$s.="<td width=\"35px\" align=\"left\"><input type=\"button\" class=\"popy\" title=\"Add\" onclick=\"popbox_save2('".$d."',function(){".$cb."})\"/></td>";
	$s.="</tr></table>";
	$s.="</div>";
	$s.="</div>";
	return $s;
}

// Master Author
$mstr_author=Array();$fm=gets('act')=='edit'?"WHERE dcid='".$r['author']."' ":"";
$t=dbSel("*","mstr_author",$fm."O/ prefix LIMIT 0,1");
while($f=dbFA($t)){
	$mstr_author[$f['dcid']]=$f['name'];
}
// Master Publisher
$mstr_publisher=Array();$fm=gets('act')=='edit'?" WHERE dcid='".$r['publisher']."'":"";
$t=dbSel("*","mstr_publisher",$fm."O/ name LIMIT 0,1");
while($f=dbFA($t)){
	$mstr_publisher[$f['dcid']]=$f['name'];
}

// Master Class 
$mstr_class=Array();
$t=dbSel("*","mstr_class","O/ code");
while($f=dbFA($t)){
	$mstr_class[$f['dcid']]="(".$f['code'].") ".$f['name'];
}

// Master Language
$mstr_language=Array();
$t=dbSel("*","mstr_language","O/ code");
while($f=dbFA($t)){
	$mstr_language[$f['dcid']]=$f['name'];
}

$txtWidth="width:344px";
?>
<div class="hl1">New catalog:</div>
<table cellspacing="0" cellpadding="0" border="0"><tr valign="top"><td>
<div class="hl2" style="margin-top:10px;margin-bottom:10px">Bibliographic Informations</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="100px" align="left">Title:</td><td width="370px"><?=iText('title',$r['title'],$txtWidth,'','onkeyup="sendTitle();vTitle(1);checkBookTitle()"')?></td></tr>
	<tr id="retitle" style="display:none"><td></td><td><div id="etitle" class="espan">You can't leave this empty.</div></td></tr>
	<tr><td  align="left">Author:</td><td>
			<?=iSelect('author',$mstr_author,$r['author'],"float:left;width:320px")?>
			<?=iPopbox('author','author name')?> 
			</td></tr>
	<tr id="auth2a"><td></td><td><div style="height:21px"><a class="linkb" href="javascript:addauth2()">Add second author...</a></div></td></tr>
	<tr id="auth2" style="display:none"><td  align="left">Second author:</td><td>
			<?=iSelect('author2',$mstr_author,$r['author2'],"float:left;width:320px")?>
			<?=iPopbox('author2','author name')?>
			</td></tr>
	<tr><td  align="left">Classification:</td><td width="370px">
			<?=iText('classcode',$r['classcode'],"width:100px;float:left;margin-right:5px")?>
			<?=iSelect('class',$mstr_class,$r['class'],"float:left;width:215px","getClass()")?>
			<?=iPopbox2('class','Code-Class name','',"getClass()")?></td></tr>
	<tr><td  align="left">ISBN:</td><td width="370px"><?=iText('isbn',$r['isbn'],$txtWidth)?></td></tr>
	<tr><td  align="left">Publisher:</td><td width="370px"><?=iSelect('publisher',$mstr_publisher,$r['publisher'],"float:left;width:320px")?>
			<?=iPopbox('publisher','publisher name')?></td></tr>
	<tr style="display:none"><td width="370px" align="left">Call number:</td><td><?=iText('tcallnumber',$r[''],$txtWidth)?></td></tr>
	<tr><td  align="left">Publish year:</td><td width="370px"><?=inputYear('release',$r['release'])?></td></tr>
	<tr><td  align="left">Series:</td><td width="370px"><?=iText('series',$r['series'],"width:200px")?></td></tr>
	<tr><td  align="left">Language:</td><td width="370px">
			<?=iSelect('language',$mstr_language,1,"float:left")?>
			<?=iPopbox('language','language name')?>
			</td></tr>
	<tr><td  align="left"></td><td align="right" style="padding-top:20px">
		<div id="formbtn">
			<input type="button" class="btn" value="Cancel" onclick="closeNewCatalog()" style="margin-right:5px"/>
			<input type="button" class="btnx" value="Save" style="margin-right:35px" onclick="saveForm()"/>
		</div>
			</td></tr>
</table>
</td><td>
	<div id="titlecheck"></div>
</td><td>
	<div class="hl2" style="margin-top:10px;margin-bottom:10px">Cover:</div>
	<input type="hidden" id="cover" name="cover" value="<?=$r['cover']?>"/>
	<iframe id="imgframe" name="imgframe" scrolling="no" style="border:none;display:;height:240px;width:150px;overflow:hidden;margin:0;padding:0" src="cvform.php?img=<?=$r['cover']?>&title=<?=$r['title']?>"></iframe>
</td>
</tr></table>
<!--Dialog Form-->
<?php // Form dimension
$fwidth=260; $lwidth=120;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<textarea id="dlgform" style="display:none">
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div id="ffmsg" style="font:14px <?=SFONT?>;color:<?=CDARK?>;text-align:center;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="0" align="center">
		<tr><td><td><img src="<?=IMGR?>iclite.gif"/></td><td style="padding-left:10px"><span style="font-size:14px">Saving. Please wait...</span></td></tr>
		</table>
	</div>
</div>
</td></tr></table>
</textarea>
<textarea id="dlgform2" style="display:none">
	<table class="stable" cellspacing="0" cellpadding="0" align="center">
	<tr><td><td><img src="<?=IMGR?>iclite.gif"/></td><td style="padding-left:10px"><span style="font-size:14px">Synchronizing new entry...</span></td></tr>
	</table>
</textarea>