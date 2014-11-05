<?php
/** Global Variables */
$mstr_traintype=MstrGetTraintype();

/* Pre Data Processing */
$dcid=gets('nid');
$mstr_status=MstrGet("mstr_status",true,"any status");
$mstr_level=MstrGet("mstr_level",true,"any level");
$mstr_group=MstrGet("mstr_group",true,"any group");
$mstr_division=MstrGet("mstr_division",true,"any division");

/*<td><input type="button" class="findbtn" title="Search" onclick="ri_emp('find')"/></td>*/
?>
<script type="text/javascript">
function lookUp(){
	var k=E('keyw').value;
	k=k==""?"-":k;
	var v="&status="+E('status').value;
		v+="&level="+E('level').value;
		v+="&group="+E('group').value;
		v+="&division="+E('division').value;
	_("r_individual&opt=lookup&k="+k+v,function(r){
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
	for(var i=1;i<=10;i++){
		dp+=E('dp'+i).checked?"-1":"-0";
	}
	E('dps').value=dp;
}
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Select<br/>employee</td>
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
			<div class="pfsub">Find employee with...</div>
				<table class="stable" cellspacing="0" cellpadding="0"><tr>
					<td width="150px">name or nip:</td>
					<td><?=iText('keyw','','width:250px','any name or nip',"onkeyup=\"lookUp()\"")?></td>
				</tr></table>
				<div class="pfsub" style="border-top:1px solid #eaeaea;padding-top:15px;margin-top:25px">Then narrow your results by...</div>
				<table class="stable" cellspacing="0" cellpadding="0">
					<tr height="30px"><td width="150px">status:</td><td><?=iSelect('status',$mstr_status,0,'width:250px',"lookUp()")?></td></tr>
					<tr height="30px"><td width="150px">level:</td><td><?=iSelect('level',$mstr_level,0,'width:250px',"lookUp()")?></td></tr>
					<tr height="30px"><td width="150px">group:</td><td><?=iSelect('group',$mstr_group,0,'width:250px',"lookUp()")?></td></tr>
					<tr height="30px"><td width="150px">division:</td><td><?=iSelect('division',$mstr_division,0,'width:250px',"lookUp()")?></td></tr>
				</table>
				<div style="width:400px;text-align:right;margin-top:10px">
				<a id="btn_specific" class="linkl11" href="javascript:lookUp()">Select employee...</a>
				</div>
			</td>
			<td style="padding-left:30px" width="430px">
			<div id="emp_result" style="420px;margin-top:10px">
				<?php require_once(VWDIR.'ri_emp.php');?>
			</div>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button class="btn" onclick="jumpTo('<?=RLNK?>report.php')">Back</button></td>
		<td align="right"><button id="ri_next1" class="btnx" onclick="gotoStep(2)" style="padding:0 10px"> Next </button></td>
		</td></tr></table>
	</div>
	<div id="prog2" style="padding-left:10px;display:none">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="300px">
			<td style="padding-right:10px" width="400px">
			<div class="pfsub">Select informations to be printed:</div>
				<table class="listtable" cellspacing="0" cellpadding="0"><?php $l=1;?>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" disabled class="iCheck" type="checkbox" value="1"/></td><td><label for="dp<?=($l-1)?>">Employee data</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" disabled  class="iCheck" type="checkbox" value="2"/></td><td><label for="dp<?=($l-1)?>">Personal information</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="3"/></td><td><label for="dp<?=($l-1)?>">Family information</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="4"/></td><td><label for="dp<?=($l-1)?>">Educational history</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="5"/></td><td><label for="dp<?=($l-1)?>">Job history</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="6"/></td><td><label for="dp<?=($l-1)?>">Self description</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="7"/></td><td><label for="dp<?=($l-1)?>">Healt circumtance</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="8"/></td><td><label for="dp<?=($l-1)?>">Reference</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="9"/></td><td><label for="dp<?=($l-1)?>">General information</label></td></tr>
					<tr><td width="24px"><input onclick="dpCheck()" checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="10"/></td><td><label for="dp<?=($l-1)?>">Additional information</label></td></tr>
				</table>
			</td>
		</tr>
		</table>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button class="btn" onclick="gotoStep(1)">Back</button></td>
		<td align="right"><button id="ri_next1" class="btnx" onclick="document.ri_form.submit()" style="padding:0 10px"> Generate report </button></td>
		</td></tr></table>
	</div>
</div>