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
	var k=E('keyw').value;
	k=k==""?"-":k;
	var v="&author="+E('author').value;
		v+="&publisher="+E('publisher').value;
		v+="&language="+E('language').value;
	_("r_main&opt=lookup&k="+k+v,function(r){
		E('emp_result').innerHTML=r;
		if(parseInt(E('ri_emp_num').value)!=0){
			E('ri_next1').style.display='';
		} else {
			E('ri_next1').style.display='none';
		}
	})
	E('btn_specific').style.display='none';
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
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Select<br/>catalogs</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">2</td>
		<td id="ps2b" class="ptracktext0">Select information & <br/>generate report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div style="position:relative;width:900px;height:400px">
	<div id="prog1" style="padding-left:10px;display:">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="300px">
			<td style="padding-right:10px" width="400px">
			<div class="pfsub">Find catalog with...</div>
				<table class="stable" cellspacing="0" cellpadding="0"><tr>
					<td width="150px">title or callnumber:</td>
					<td><?=iText('keyw','','width:250px','any title or callnumber',"onkeyup=\"lookUp()\"")?></td>
				</tr></table>
				<div class="pfsub" style="border-top:1px solid #eaeaea;padding-top:15px;margin-top:25px">Then narrow your results by...</div>
				<table class="stable" cellspacing="0" cellpadding="0">
					<tr height="30px"><td width="150px">author:</td><td><?=iSelect('author',$mstr_author,0,'width:250px',"lookUp()")?></td></tr>
					<tr height="30px"><td width="150px">publisher:</td><td><?=iSelect('publisher',$mstr_publisher,0,'width:250px',"lookUp()")?></td></tr>
					<tr height="30px"><td width="150px">language:</td><td><?=iSelect('language',$mstr_language,0,'width:250px',"lookUp()")?></td></tr>
				</table>
				<div style="width:400px;text-align:right;margin-top:10px">
				<a id="btn_specific" class="linkl11" href="javascript:lookUp()">Select catalog...</a>
				</div>
			</td>
			<td style="padding-left:30px" width="430px">
			<div id="emp_result" style="420px;margin-top:10px">
				<?php require_once(VWDIR.'ri_book.php');?>
			</div>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button style="display:none" class="btn" onclick="jumpTo('<?=RLNK?>report.php')">Back</button></td>
		<td align="right"><button id="ri_next1" class="btnx" onclick="gotoStep(2)" style="padding:0 10px"> Next </button></td>
		</td></tr></table>
	</div>
	<div id="prog2" style="padding-left:10px;display:none">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="300px">
			<td style="padding-right:10px" width="400px">
			<div class="pfsub">Select informations to be printed:</div>
				<table class="listtable" cellspacing="0" cellpadding="0"><?php $l=1;?>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" disabled class="iCheck" type="checkbox" value="1"/></td><td><label for="dp<?=($l-1)?>">Title</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" disabled  class="iCheck" type="checkbox" value="2"/></td><td><label for="dp<?=($l-1)?>">Call number</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="3"/></td><td><label for="dp<?=($l-1)?>">ID number</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="4"/></td><td><label for="dp<?=($l-1)?>">Author</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="5"/></td><td><label for="dp<?=($l-1)?>">Publisher</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="6"/></td><td><label for="dp<?=($l-1)?>">Classification</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="7"/></td><td><label for="dp<?=($l-1)?>">ISBN</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="8"/></td><td><label for="dp<?=($l-1)?>">Release date</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="9"/></td><td><label for="dp<?=($l-1)?>">Availability</label></td></tr>
				</table>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button class="btn" onclick="gotoStep(1)">Back</button></td>
		<td align="right"><button id="ri_next1" class="btnx" onclick="doSumbitForm()" style="padding:0 10px"> Generate report </button></td>
		</td></tr></table>
	</div>
</div>
<script type="text/javascript" language="javascript">
$('document').ready(function(){
	 getForm('author',0);
	 getForm('publisher',0);
});
</script>