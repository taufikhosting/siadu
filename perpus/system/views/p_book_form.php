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
<style type="text/css">
.espan{
	<?=SFONT11?>
	color:#ff0000;
}
</style>
<script type="text/javascript" language="javascript">
function popbox_save2(a,b){
	var v=E('popi_'+a).value;
	var v1=E('popi_'+a+'1').value;
	if(v!=''&&v1!=''){
	_('popbox&t='+a+'&opt=a&v='+v+"&v1="+v1,function(r){
		var s=r.split("~");
		E(a+"code").value=s[0];
		E(a).innerHTML=s[1];
		close_popbox(a)
	});}else{close_popbox(a)}
}
function ffade(a,o){
	E(a).style.opacity=o;
	if(o<1.0){
		o+=0.1;
		setTimeout("ffade('"+a+"',"+o+")",20);
	}
}
function getClass(){
	var cla=getSelectedText('class');
	var sa=cla.indexOf("(")+1;
	var sb=cla.indexOf(")",sa);
	var clas=cla.substring(sa,sb);
	E('classcode').value=clas;
}
function acceptFile(a){
	E('cover').value=a;
}
function getForm(o,a){
	_("pb_dynform&opt="+o+"&v="+a,function(r){
		E(o).innerHTML=r;
	});
}
function sendTitle(){
	var a=E('title').value;
	document.imgframe.acceptTitle(a);
}
function addauth2(){
	E('auth2a').style.display='none';
	E('auth2').style.display='';
}

function checkBookTitle(){
	var a=E('title').value;
	_('checktitle&v='+a,function(r){
		E('titlecheck').innerHTML=r;
	});
}
function showErr(a,m){
	E(a).innerHTML=m;
	EShow(a);
	EShow('r'+a);
}
function vTitle(x){
	var a=E('title').value;
	if(x==0 && a==''){
		E('title').className='iTextErr';
		showErr('etitle',"You can't leave title empty.");
		return false;
	}
	if(a!=''||x==0){
		a=a.trim();
		a=a.replace(/  +/g,' ');
		var p=new RegExp("^[a-zA-Z0-9 \,\.\'\?\"\!]+$");
		if(!p.test(a)){
			E('title').className='iTextErr';
			showErr('etitle','Invalid character in title.');
			return false;
		}
	}
	EHide('retitle');
	E('title').className='iText'+(x==0?'':'x');
	return true;
}
function backForm(a){
	//header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$dcid);
	jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=view&nid='+a);
}
function submitForm(a){
	var inp=new Array('dcid','title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	var v="";
	for(var i=0;i<inp.length;i++){
		v+="&"+inp[i]+"="+E(inp[i]).value;
	}
	v="request&q="+a+"catalog"+v;
	_(v,function(r){
		//alert(r); return 0;
		var msg=r.substr(1).split("~");
		E('ffmsg').innerHTML=msg[1];
		if(r.substr(0,1)=='T'){
			setTimeout("backForm("+parseInt(msg[0])+")",1000);
		} else {
			EShow('formbtn');
			close_fform();
		}
	});
}
function saveForm(){
	var val=true;
	val&=vTitle(0);
	
	if(val){
		EHide('formbtn');
		E('fform').innerHTML=E('dlgform').value;
		open_fform();
		setTimeout("submitForm('<?=$act?>')",500);
	}
}
</script>
<input type="hidden" name="dcid" id="dcid" value="<?=$r['dcid']?>"/>
<table cellspacing="0" cellpadding="0" border="0"><tr valign="top"><td>
<div class="hl2" style="margin-top:10px;margin-bottom:10px">Bibliographic Informations</div>
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="100px" align="left">Title:</td><td width="370px"><?=iText('title',$r['title'],$txtWidth,'','onkeyup="sendTitle();vTitle(1);checkBookTitle()" onblur="vTitle(0)"')?></td></tr>
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
	<tr><td  align="left">Classification:</td><td>
			<?=iText('classcode',$r['classcode'],"width:100px;float:left;margin-right:5px")?>
			<?=iSelect('class',$mstr_class,$r['class'],"float:left;width:215px","getClass()")?>
			<?=iPopbox2('class','Code-Class name','',"getClass()")?></td></tr>
	<tr><td  align="left">ISBN:</td><td><?=iText('isbn',$r['isbn'],$txtWidth)?></td></tr>
	<tr><td  align="left">Publisher:</td><td><?=iSelect('publisher',$mstr_publisher,$r['publisher'],"float:left;width:320px")?>
			<?=iPopbox('publisher','publisher name')?></td></tr>
	<tr style="display:none"><td  align="left">Call number:</td><td><?=iText('tcallnumber',$r[''],$txtWidth)?></td></tr>
	<tr><td  align="left">Publish year:</td><td><?=inputYear('release',$r['release'])?></td></tr>
	<tr><td  align="left">Series:</td><td><?=iText('series',$r['series'],"width:200px")?></td></tr>
	<tr><td  align="left">Language:</td><td>
			<?=iSelect('language',$mstr_language,$r['language'],"float:left")?>
			<?=iPopbox('language','language name')?>
			</td></tr>
	<tr><td  align="left"></td><td align="right" style="padding-top:20px">
		<div id="formbtn">
			<input type="button" class="btn" value="Cancel" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog<?=gets('back')=='view'?'&act=view&nid='.$r['dcid']:''?>')" style="margin-right:5px"/>
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
<script type="text/javascript" language="javascript">
$('document').ready(function(){
	getForm('author',<?=$r['author']?>);
	getForm('author2',<?=$r['author2']?>);
	getForm('publisher',<?=$r['publisher']?>);
	<?php if(gets('act')!='edit'){?>E('title').focus();<?php }?>
	$('input').keypress(function(event){
	if (event.keyCode == 10 || event.keyCode == 13)
		event.preventDefault();
	});
});
</script>
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