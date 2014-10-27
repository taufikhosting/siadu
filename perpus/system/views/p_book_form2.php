<?php 
require_once(MODDIR.'masterdb.php');

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
?>
<style type="text/css">
.espan{
	<?=SFONT11?>
	color:#ff0000;
}
.stablex {
	border-collapse:collapse;
	border:1px solid #b2b2b2;
}
.stablex tr td{
	<?=SFONT12?>
	color:<?=CDARK?>
}
</style>
<script type="text/javascript" language="javascript">
function viewbookinfo(a,f){
	_("bookinfo&barcode="+a+"&bookid="+a+"&info="+f,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function getNid(){
	var b=E('barcode').value;
	if(b!=''){
		var n=E('nid').value;
		var np=n.split("/");
		E('nid').value=b+(np.length>1?"/"+np[1]:"/")+(np.length>2?"/"+np[2]:"")+(np.length>3?"/"+np[3]:"")+(np.length>4?"/"+np[4]:"");
	}
}
function backNid(){
	var b=E('nid').value.split("/");
	E('barcode').value=b[0];
}
function getCallNumber(){
	var cla=E('cla').value;
	var aut=E('aut').value;
	var tit=E('tit').value;
	E('callnumber').value=cla+" "+aut+" "+tit;
}
function backCallNumber(){
	var cv=E('callnumber').value;
	if(cv!=""){
		var cn=cv.split(" ");
		E('cla').value=cn[0];
		if(cn.length>1)E('aut').value=cn[1];
		if(cn.length>2)E('tit').value=cn[2];
	}
}
function showErr(a,m){
	E(a).innerHTML=m;
	EShow(a);
	EShow('r'+a);
}
/** Validation **/
function vBarcode(x){
	var bc=E('barcode').value;
	if(bc==''){
		E('barcode').className='iTextErr';
		showErr('ebarcode',"You can't leave barcode empty.");
		return false;
	}
	if(bc.length<5){
		var l=bc.length;
		for(var i=l;i<5;i++){
			bc='0'+bc;
		}
		E('barcode').value=bc;
	}
	if(bc.length>5){
		E('barcode').className='iTextErr';
		showErr('ebarcode',"Barcode must have 5 digits length.");
		return false;
	}
	var p=new RegExp("^[0-9][0-9][0-9][0-9][0-9]$");
	if(!p.test(bc)){
		E('barcode').className='iTextErr';
		showErr('ebarcode','Invalid barcode number.');
		return false;
	}
	EHide('rebarcode');
	E('barcode').className='iText'+(x==0?'':'x');
	return true;
}
function vNid(x){
	var a=E('nid').value;
	if(x==0){
		a=a.trim();
		E('nid').value=a;
	}
	if(a==''){
		E('nid').className='iTextErr';
		showErr('enid',"You can't leave book number empty.");
		return false;
	}
	var p=new RegExp("^[0-9]+(\/[a-zA-Z0-9]+)+$");
	if(!p.test(a)){
		E('nid').className='iTextErr';
		showErr('enid','Invalid book number.');
		return false;
	}
	EHide('renid');
	E('nid').className='iText'+(x==0?'':'x');
	return true;
}
function vCNum(x){
	var a=E('callnumber').value;
	if(x==0){
		a=a.trim();
		a=a.replace(/  +/g," ");
		E('callnumber').value=a;
	}
	if(a==''){
		E('callnumber').className='iTextErr';
		showErr('ecnum',"You can't leave book number empty.");
		return false;
	}
	var p=new RegExp("^[a-zA-Z0-9\.]+ [a-zA-Z0-9\.\-]+ [a-zA-Z0-9\-]+$");
	if(!p.test(a)){
		E('callnumber').className='iTextErr';
		showErr('ecnum','Invalid call number.');
		return false;
	}
	EHide('recnum');
	E('callnumber').className='iText'+(x==0?'':'x');
	return true;
}
function vform(a){
	var val=true;
	val&=vBarcode();
	val&=vNid();
	//if(val) E('bform').submit();
	//saveForm();
}
function backForm(){
	jumpTo('<?=RLNK?>bibliographic.php?tab=catalog<?=$blink?>');
}
function submitForm(a){
	var inp=new Array('catalog','barcode','nid','callnumber','shelf');
	var sr=E('bsr').checked?"r":"";
	sr=E('bsg').checked?"g":sr;
	var sv=sr==""?"":"&sourceval="+E('source'+sr).value;
	sr=sr==""?"":"&source="+sr;
	var v="";
	for(var i=0;i<inp.length;i++){
		v+="&"+inp[i]+"="+E(inp[i]).value;
	} v+=sr+sv;
	var dcid=E('dcid').value;
	var c=dcid==""?"":"&dcid="+dcid;
	dcid=E('catalog').value;
	var t=dcid==""?"":"&catalog="+dcid;
	v="request&q="+a+"book"+v+c+t;
	_(v,function(r){
		E('ffmsg').innerHTML=r.substr(1);
		if(r.substr(0,1)=='T'){
			setTimeout("backForm()",1000);
		} else {
			EShow('formbtn');
			//EHide('formmsg');
			close_fform();
		}
	});
}

function saveForm(){
	var val=true;
	val&=vBarcode(0);
	val&=vNid(0);
	val&=vCNum(0);
	//alert(val); return 0;
	if(val){
		// revalidate value that need request:
		var bc=E('barcode').value;
		_("validate&t=barcode&v="+bc+"&cid=<?=$f['dcid']?>",function(r){
			if(r!=''){
				E('barcode').className='iTextErr';
				showErr('ebarcode',r);
				return false;
			} else {
				EHide('formbtn');
				E('fform').innerHTML=E('dlgform').value;
				open_fform();
				setTimeout("submitForm('<?=$act?>')",500);
			}
		});
	}
}
$('document').ready(function(){
	getNid();
	E('barcode').focus();
	$('input').keypress(function(event){

		if (event.keyCode == 10 || event.keyCode == 13) 
			event.preventDefault();
	});
});
</script>
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
	<tr><td width="140px" align="left"><b>Barcode:</b></td><td><?=iText('barcode',$lbc,$txtWidth.";font-weight:bold",'','onkeyup="getNid();" onblur="vBarcode(0)"')?></td></tr>
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
<input type="button" class="btn" value="Cancel" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog<?=$blink?>')" style="margin-right:5px"/>
<input type="button" class="btnx" value="Save" style="margin-right:35px" onclick="saveForm()"/>
</div>
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