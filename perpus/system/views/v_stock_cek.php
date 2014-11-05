<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";
$t=dbSel("*","so_history","W/status='1' OR status='2' LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
dbUpdate("so_history",Array('status'=>1),"dcid='".$r['dcid']."'");
$cn=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."`"));
$tn=mysql_num_rows(mysql_query("SELECT * FROM `book`"));
$ck=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
?>
<style type="text/css">
.scbcd{
	margin-left:6px;margin-right:6px;font:18px 'Segoe UI',Verdana; font-weight:bold;
	color: <?=CLBLUE?>;
	background:#faf8ff;
	border:1px solid #cacaca;
	border-radius:3px;
	padding:0 10px 0 10px;width:500px;
	height:28px;
	overflow:hidden;
}
</style>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber0" align="center">1</td>
		<td id="ps1b" class="ptracktext0">Initialize<br/>stock take</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber" align="center">2</td>
		<td id="ps2b" class="ptracktext">Books<br/>checking</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">3</td>
		<td id="ps2b" class="ptracktext0">Finish<br/>stock take</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">4</td>
		<td id="ps2b" class="ptracktext0">Generate<br/>report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<style type="text/css">
.espan{
	<?=SFONT11?>
	color:#ff0000;
}
</style>
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
/** Validation **/
function vBarcode(x){
	var bc=E('barcode').value;
	if(bc==''){
		E('barcode').className='iTextErr';
		showErr('ebarcode',"You can't leave barcode empty.");
		return false;
	}
	var p=new RegExp("^[0-9]+$");
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
function backForm2(){
	E('ffmsg').innerHTML=E('dlgform2').value;
	bookOK(1);
}
function submitForm2(a){
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
	v="request&q="+a+"book2"+v+c+t;
	_(v,function(r){
		E('ffmsg').innerHTML=r.substr(1);
		if(r.substr(0,1)=='T'){
			setTimeout("backForm2()",1000);
		} else {
			EShow('formbtn');
			//EHide('formmsg');
			close_fform();
		}
	});
}

function saveForm2(){
	var val=true;
	val&=vBarcode(0);
	val&=vNid(0);
	val&=vCNum(0);
	//alert(val); return 0;
	if(val){
		// revalidate value that need request:
		var bc=E('barcode').value;
		_("validate&t=barcode&v="+bc+"&cid=0",function(r){
			if(r!=''){
				E('barcode').className='iTextErr';
				showErr('ebarcode',r);
				return false;
			} else {
				EHide('formbtn');
				E('fform').innerHTML=E('dlgform').value;
				open_fform();
				setTimeout("submitForm2('add')",500);
			}
		});
	}
}
/*
$('document').ready(function(){
	getNid();
	E('barcode').focus();
	$('input').keypress(function(event){

		if (event.keyCode == 10 || event.keyCode == 13) 
			event.preventDefault();
	});
});*/
</script>
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
	_('checktitle2&v='+a,function(r){
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
		var p=new RegExp("^[a-zA-Z0-9\s \.\'\?\"\!]+$");
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
function requestForm2(a){
	var bc=E('sbarcode').value;
	v="so_reqform2&barcode="+bc+"&cid="+a;
	_(v,function(r){
		E('bookform2').innerHTML=r;
		EHide('bookform');
		EShow('bookform2');
		close_fform();
		getNid();
	});
}
function submitForm(a){
	var inp=new Array('dcid','title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	var v="";
	for(var i=0;i<inp.length;i++){
		v+="&"+inp[i]+"="+E(inp[i]).value;
	}
	v="request&q="+a+"catalog"+v;
	//alert(v); return 0;
	_(v,function(r){
		//alert(r); return 0;
		var msg=r.substr(1).split("~");
		E('ffmsg').innerHTML=msg[1];
		if(r.substr(0,1)=='T'){
			setTimeout("requestForm2("+parseInt(msg[0])+")",1000);
			//alert('ok');
		} else {
			EShow('formbtn');
			setTimeout("close_fform()",1000);
		}
	});
}
function saveForm(){
	var val=true;
	val&=vTitle(0);
	
	if(val){
		EHide('formbtn');
		//alert(E('dlgform').value);
		E('fform').innerHTML=E('dlgform').value;
		open_fform();
		setTimeout("submitForm('new')",500);
	}
}
</script>
<script type="text/javascript" language="javascript">
var aok=false;
function ffade(a,o){
	E(a).style.opacity=o;
	if(o<1.0){
		o+=0.1;
		setTimeout("ffade('"+a+"',"+o+")",20);
	}
}
function togAoke(a){
	aok=a;
	if(a) {E('okbtn').style.visibility='hidden'; bookOK();}
	else  E('okbtn').style.visibility='visible';
}
function fetch_book(n){
	_("soc_fetchbook&lst=<?=$r['ntable']?>&tn=<?=$tn?>&cn="+n,function(r){
		var nk=parseInt(r);
		var tk=<?=$tn?>;
		
		E('bproc').innerHTML=parseInt(nk*100/tk)+1;
		if(nk < <?=$tn?>){
			fetch_book(nk);
		} else {
			EHide('cblst');
			document.location.reload();
		}
	});
}
function setProc(a){
	var tot=<?=$tn?>;
	var p=parseInt(a*100/tot);
	var pb=parseInt(a*300/tot);
	E('pbar').style.width=pb+'px';
	E('cekedbook').innerHTML=a;
	//EHide('barload');
	//setTimeout("E('bframe').style.visibility='visible';",50);
	ffade('bframe',0.3);
}
function setUnlist(a){
	E('unlistedbook').innerHTML=a+' book'+(a>1?'s':'');
	ffade('bframe2',0.3);
}
function bookCancel(){
	E('scbcd').innerHTML='';
	E('sbarcode').value=0;
	E('ceknote').innerHTML='';
	E('xbarcode').focus();
	EHide('okbtn');
	EHide('oklbl');
	EHide('okbtn2');
	EHide('oklbl2');
}
function bookAddlist(){
	var a=E('sbarcode').value;
	if(parseInt(a)>0){
	//EShow('barload');
	E('bframe2').style.opacity=0;
	_("so_addbokk&lst=<?=$r['ntable']?>&bcode="+a,function(r){
		document.bframe2.relod();
		bookCancel();
	});
	}
}
function bookOK(x){
	var a=E('sbarcode').value;
	if(parseInt(a)>0){
	//EShow('barload');
	E('bframe').style.opacity=0;
	_("so_bookok&lst=<?=$r['ntable']?>&bcode="+a,function(r){
		if(x==1){
			closeNewCatalog(1);
			setTimeout("close_fform()",1000);
		}
		document.bframe.relod();
		bookCancel();
	});
	}
}

function okbtn(a){
	if(a=='T'){
		EShow('okbtn');
		EShow('oklbl');
		EHide('okbtn2');
		EHide('oklbl2');
	} else if(a=='F') {
		EShow('okbtn2');
		//EShow('oklbl2');
		EHide('okbtn');
		EHide('oklbl');
	} else {
		EHide('okbtn');
		EHide('oklbl');
		EHide('okbtn2');
		EHide('oklbl2');
		E('xbarcode').focus();
	}
}

function cekBook(){
	var a=E('xbarcode').value;
	E('xbarcode').value='';	
	_("so_cekbook&lst=<?=$r['ntable']?>&bcode="+a,function(r){
		if(r!=''){
			var s=r.split("~");
			E('sbarcode').value=s[1];
			E('scbcd').innerHTML=s[2];
			E('ceknote').innerHTML=s[3];
			okbtn(s[0]);
			if(s[0]=='T'){
				if(aok) setTimeout("bookOK()",1000);
			}
		} else {
			bookCancel();
		}
	});
}
function cekBarcode(e){
	if (e.keyCode == 13) {
        cekBook();
    }
}
function dSliR(a,h){
	E(a).style.left=h+'px';
	//E(a).style.opacity=(h/400.0);
	if(h<0){
		h+=100;
		if(h>0) h=0;
		setTimeout("dSliR('"+a+"',"+h+")",10);
	}
}
function dSliL(a,h){
	E(a).style.left=h+'px';
	//E(a).style.opacity=(h/400.0);
	if(h>-1000){
		h-=100;
		if(h<-1000) h=-1000;
		setTimeout("dSliL('"+a+"',"+h+")",10);
	}
}
function openNewCatalog(){
	EShow('formbtn');
	EShow('bookform');
	EHide('bookform2');
	dSliL('bookctr',0);
	EHide('retitle');
	E('title').value='';
	E('classcode').value='';
	E('class').value=2;
	E('isbn').value='';
	E('series').value='';
	E('language').value=1;
	getForm('author',0);
	getForm('author2',0);
	getForm('publisher',0);
	//E('title').focus();
}
function closeNewCatalog(x){
	if(x==1){
		E('bookctr').style.left=0;
	}
	else {
		dSliR('bookctr',-1000);
	}
}
function doneCheck(){
	E('donecekform').submit();
}

function doneChecking(){
	var v="a_stock_lost&opt=dncek&lst=<?=$r['ntable']?>";
	_(v,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}

$("document").ready(function(){
	<?php if($cn<$tn) echo 'EHide("bookcheck"); fetch_book('.$cn.');'; else echo "EHide('cblst');EShow('bookcheck');E('xbarcode').focus();";?>
	setProc(<?=$ck?>);
});
</script>
<div id="cblst">
	<div class="hl2" style="margin-top:10px;margin-bottom:10px">Please wait until preparation complete.</div>
	<div class="pdiv" style="margin-top:10px;margin-bottom:10px;color:<?=CLGREY?>">Cheking book list... <span id="bproc"></span> %</div>
</div>
<div id="bookcheck" style="display:none;position:relative;width:1000px;height:550px;overflow:hidden">
<div id="bookctr" style="height:500px;position:absolute;left:0px;top:0">
	<table cellspacing="0" cellpadding="0"><tr valign="top">
	<td>
	<div id="bookcekbox" style="width:1000px">
		<div class="hl2" style="margin-top:10px;margin-bottom:10px">Book checking</div>
		<div style="padding-bottom:30px;border-bottom:1px solid #d2d2d2;width:850px">
		<table cellspacing="0" cellpadding="0">
		<tr>
			<td><?=iText('xbarcode','',"width:250px;font-size:15px",'Barcode','onkeydown="cekBarcode(event)"')?></td>
			<td><button id="cekbtn" class="btnx" style="margin-left:6px" onclick="cekBook()">Check</button></td>
		</tr>
		</table>
		</div>
		<div style="margin-top:10px">
		<div class="hl3" style="margin-top:10px;margin-bottom:10px">Scanned book: <span id="ceknote"></span></div>
		<table cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<button class="btn" title="Cancel" style="border-radius:15px" onclick="bookCancel()">
				<div class="bi_canb">&nbsp;</div>
				</button>
			</td>
			<td>
				<div id="scbcd" class="scbcd"></div><input type="hidden" id="sbarcode" value="0"/>
			</td>
			<td id="okbtn">
				<button class="btn" style="width:50px;height:30px;margin-right:25px" onclick="bookOK()"><b>OK</b></button>
			</td>
			<td id="okbtn2" style="display:none">
				<button class="btn" style="height:30px;margin-right:10px" onclick="openNewCatalog()">Insert new catalog</button>
				<span class="sfont"> or &nbsp;</span>
				<a class="linkb" href="javascript:void(0)" onclick="bookAddlist()">Add to unlisted book</a>
			</td>
			<td>
				<label id="oklbl"><input type="checkbox" class="iCheck" id="aoke" style="float:left" onclick="togAoke(this.checked)"> <div class="sfont" style="float:left">&nbsp;always OK</div></label>
			</td>
		</tr>
		</table>
		</div>
		<table cellspacing="0" cellpadding="0"><tr>
		<td>
		<div style="margin-top:0px">
			<div class="hl2" style="margin-top:20px;margin-bottom:0px">Book check list:</div>
			<table cellspacing="0" cellpadding="0" style="margin-bottom:10px"><tr>
			<td><div style="border-radius:5px;width:300px;height:6px;border:1px solid #4b8fff;margin-right:10px">
				<div id="pbar" style="width:0px;height:6px;background:#5595ff"></div>
			</div></td>
			<td> <span style="<?=SFONT12?>;color:<?=CLGREY?>"><span id="cekedbook">500</span> of <?=$tn?></span></td>
			<td><img id="barload" style="margin-left:10px;display:none" src="<?=IMGR?>iclite.gif"/></td>
			</tr></table>
			<div style="width:410px;height:250px;background:url('<?=IMGR?>loader2.gif') center no-repeat">
			<iframe id="bframe" name="bframe" scrolling="auto" style="background:#fff;border:none;opacity:0;display:;height:220px;width:410px;overflow:auto;margin:0;padding:0" src="<?=RLNK?>bookcek.php?ntable=<?=$r['ntable']?>"></iframe>
			</div>
		</div>
		</td>
		<td>
		<div style="margin-top:0px;margin-left:40px">
			<div class="hl2" style="margin-top:20px;margin-bottom:0px">Unlisted book:</div>
			<table cellspacing="0" cellpadding="0" style="margin-bottom:10px"><tr>
			<td> <span id="unlistedbook" style="<?=SFONT12?>;color:<?=CLGREY?>">20 books</span></td>
			</tr></table>
			<div style="width:410px;height:250px;background:url('<?=IMGR?>loader2.gif') center no-repeat">
			<iframe id="bframe2" name="bframe2" scrolling="auto" style="background:#fff;border:none;visibility:visible;display:;height:220px;width:410px;overflow:auto;margin:0;padding:0" src="<?=RLNK?>bookunlist.php?ntable=<?=$r['ntable']?>"></iframe>
			</div>
		</div>
		</td>
		</tr></table>
		<table cellspacing="0" cellpadding="0" width="800px" border="0" style="margin-top:20px"><tr>
		<td align="right">
			<input type="button" class="btnx" value="Next step" onclick="doneChecking()" />
			<form id="donecekform" action="<?=RLNK?>request.php" method="post">
				<input type="hidden" name="req" value="donecekbook"/>
				<input type="hidden" name="cid" value="<?=$r['dcid']?>"/>
			</form>
		</td>
		</tr></table>
	</div>
	</td>
	<td>
	<div id="bookform" style="width:1000px">
		<?php require_once(VWDIR.'p_book_form3.php'); ?>
	</div>
	<div id="bookform2" style="width:1000px;display:none">
		<?php require_once(VWDIR.'p_book_form4.php'); ?>
	</div>
	</td>
	</tr></table>
</div>
</div>
</div>
<?php } else { 
$pass=true;
}?>