<?php
$mstr_author=Array();
$t=dbSel("*","mstr_author","O/ prefix LIMIT 0,20");
while($r=dbFA($t)){
	$mstr_author[$r['dcid']]=$r['name']." (".$r['prefix'].")";
}
$mstr_publisher=Array();
$t=dbSel("*","mstr_publisher","O/ name LIMIT 0,20");
while($r=dbFA($t)){
	$mstr_publisher[$r['dcid']]=$r['name'];
}
$mstr_class=MstrGetx("mstr_class","code");
$mstr_language=MstrGet("mstr_language");
$txtWidth="width:344px";
?>
<script type="text/javascript" language="javascript">
function getBarcode(a){
	var b=a.split("/");
	E('barcode').value=b[0];
}
function getCallNumber(){
	var classcode=E('class').value;
	var author=getSelectedText('author');
	var sa=author.indexOf("(")+1;
	var sb=author.indexOf(")",sa);
	auth=author.substring(sa,sb);
	var title=E('title').value.substr(0,1);
	title=title.toUpperCase();
	var callnum=classcode+" "+auth+" "+title;
	E('tcallnumber').value=callnum;
	E('cn_class').value=classcode;
	E('cn_author').value=auth;
	E('cn_title').value=title;
	E('callnumber').value=callnum;
}
function getClass(){
	var cla=getSelectedText('classcode');
	var sa=cla.indexOf("(")+1;
	var sb=cla.indexOf(")",sa);
	var clas=cla.substring(sa,sb);
	E('class').value=clas;
}
function acceptFile(a){
	E('cover').value=a;
}
function getForm(o){
	_("pb_dynform&opt="+o,function(r){
		E(o).innerHTML=r;
	});
}
function sendTitle(){
	var a=E('title').value;
	document.imgframe.acceptTitle(a);
}
</script>

<script type="text/javascript" language="javascript">
$('document').ready(function(){
	 getForm('author');
	 getForm('publisher');
});
</script>