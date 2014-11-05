<?php
/** Global Variables */

/* Pre Data Processing */
$dcid=gets('nid');


$mstr_author=Array();
$t=dbSel("*","mstr_author","O/ prefix LIMIT 0,1");
$mstr_author[0]='any author';
while($r=dbFA($t)){
	$mstr_author[$r['dcid']]=$r['name']." (".$r['prefix'].")";
}
$mstr_publisher=Array();
$mstr_publisher[0]='any publisher';
$t=dbSel("*","mstr_publisher","O/ name LIMIT 0,1");
while($r=dbFA($t)){
	$mstr_publisher[$r['dcid']]=$r['name'];
}
$mstr_language=Array();
$mstr_language[0]='any language';
$t=dbSel("*","mstr_language","O/ name");
while($r=dbFA($t)){
	$mstr_language[$r['dcid']]=$r['name'];
}
						
$txtWidth="width:344px";

/*<td><input type="button" class="findbtn" title="Search" onclick="ri_emp('find')"/></td>*/
?>
<script type="text/javascript">
function lookUp(){
	var v="&mtype="+E('mtype').value;
		v+="&mid="+E('mid').value;
	_("ri_member&opt=lookup"+v,function(r){
		E('emp_result').innerHTML=r;
	});
}
function ri_emp_cek(e){
    if (e.keyCode == 13) {
        ri_emp('find');
    }
}

function gotoProgress(a){
	for(var i=1;i<=2;i++){
		E('prog'+i).style.display='none';
		E('ps'+i+'a').className='ptracknumber0';
		E('ps'+i+'b').className='ptracktext0';
	}
	E('prog'+a).style.display='';
	E('ps'+a+'a').className='ptracknumber';
	E('ps'+a+'b').className='ptracktext';
}
function checkAll(a){
	var n=parseInt(E('ri_emp_num').value);
	for(var i=1;i<=n;i++){
		E('ri_emp'+i).checked=a;
	}
	selCheck();
}
function selCheck(){
	var n=parseInt(E('ri_emp_num').value);
	var k=0; var ids="0";
	for(var i=1;i<=n;i++){
		if(E('ri_emp'+i).checked)k++;
		ids+=E('ri_emp'+i).checked?"-"+E('ri_emp'+i).value:"";
	}
	if(k==0){
		E('ri_next1').style.display='none';
	} else {
		E('ri_next1').style.display='';
	}
	if(n>1){
		E('ri_emp0').checked=(k==n);
	}
	E('ri_emp_ids').value=ids;
}
function gotoStep(a){
	if(a==1){
		E('prog2').style.display='none';
		E('prog1').style.display='';
		E('ps1a').className='ptracknumber';
		E('ps1b').className='ptracktext';
		E('ps2a').className='ptracknumber0';
		E('ps2b').className='ptracktext0';
	} else {
		E('ps1a').className='ptracknumber0';
		E('ps1b').className='ptracktext0';
		E('ps2a').className='ptracknumber';
		E('ps2b').className='ptracktext';
		E('prog2').style.display='';
		E('prog1').style.display='none';
	}
}
function dpCheck(){
	var dp="0";
	for(var i=1;i<=9;i++){
		dp+=E('dp'+i).checked?"-1":"-0";
	}
	E('dps').value=dp;
}
function getForm(o,v){
	_("pb_dynform2&opt="+o+"&v="+v,function(r){
		E(o).innerHTML=r;
	});
}
function doSumbitForm(){
	E('rauthor').value=E('author').value;
	E('rpublisher').value=E('publisher').value;
	E('rlanguage').value=E('language').value;
	//alert('yay');
	document.ri_form.submit();
}
function changeType(a){
	if(a=='m'){
		E('midlabel').innerHTML='Name or NIS';
	}
	else if(a=='s'){
		E('midlabel').innerHTML='Name or NIP';
	}
	else if(a=='o'){
		E('midlabel').innerHTML='Name or member ID';
	}
}
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Select<br/>member</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">2</td>
		<td id="ps2b" class="ptracktext0">Choose<br/>books</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div style="width:600px;height:400px">
	<div id="prog1" style="padding-left:10px;display:">
		<form action="<?=RLNK?>borrowing.php" method="get" style="padding:0;margin:0">
		<table class="stable2" cellspacing="0" cellpadding="0" style="margin-top:20px">
		<tr style="height:30px">
			<td width="160px">Membership type:</td>
			<td><?=iSelect('mtype',Array('m'=>'Student','s'=>'Staff','o'=>'Other'),'s','',"changeType(this.value);lookUp()")?></td>
		</tr>
		<tr style="height:30px">
			<td><span id="midlabel">Name or NIS</span>:</td>
			<td><?=iText('mid','','width:250px','',"onkeyup=\"lookUp()\"")?></td>
		</tr>
		</table>
		</form>
		<div id="emp_result" style="height:280px;border-top:1px solid #eaeaea;padding-top:0px;margin-top:20px">
			<?php require_once(VWDIR.'ri_member.php');?>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript">
$('document').ready(function(){
	 getForm('author',0);
	 getForm('publisher',0);
});
</script>