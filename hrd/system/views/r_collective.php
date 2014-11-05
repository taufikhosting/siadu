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

function cekRange(a,b){
	if(a==1){
		E('rc_thismonth').checked=false;
	} else {
		if(b){
			var d=new Date();
			var dm=new Date(d.getFullYear(),d.getMonth()+1,0).getDate();
			var y=d.getFullYear();
			var m=d.getMonth()+1;
			inputdateSet('date1',y+"-"+m+"-1");
			inputdateSet('date2',y+"-"+m+"-"+dm);
		}
	}
}

function doSubmit(){
	E('rc_date1').value=E('date1').value;
	E('rc_date2').value=E('date2').value;
	E('rc_status').value=E('status').value;
	E('rc_level').value=E('level').value;
	E('rc_group').value=E('group').value;
	E('rc_division').value=E('division').value;
	E('rc_sortby').value=E('sortby').value;
	var dp="0";
	for(var i=1;i<=6;i++){
		dp+=E('dp'+i).checked?"-1":"-0";
	}
	E('rc_dps').value=dp;
	document.rc_form.submit();
}
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Select<br/>records</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">2</td>
		<td id="ps2b" class="ptracktext0">Select columns & <br/>generate report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div style="position:relative;width:900px;height:400px">
	<div id="prog1" style="padding-left:10px;display:">
		<div style="height:340px">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="300px">
			<td style="padding-right:10px" width="400px">
			<div class="pfsub">Find employee data within range...</div>
				<table class="stable" cellspacing="0" cellpadding="0">
				<tr height="30px">
					<td width="150px">from:</td>
					<td><?=inputDate('date1',date("Y-m-d"),'cekRange(1,0)')?></td>
				</tr>
				<tr height="30px">
					<td width="150px">to:</td>
					<td><?=inputDate('date2',date("Y-m-d"),'cekRange(1,0)')?></td>
				</tr>
				<tr height="30px">
					<td colspan="2">or <label><input onclick="cekRange(0,this.checked)" id="rc_thismonth" class="iCheck" type="checkbox" value="1"/> this month</label></td>
				</tr>
				</table>
				<div class="pfsub" style="border-top:1px solid #eaeaea;padding-top:15px;margin-top:25px">Then narrow your results by...</div>
				<table class="stable" cellspacing="0" cellpadding="0">
					<tr height="30px"><td width="150px">status:</td><td><?=iSelect('status',$mstr_status,0,'width:250px')?></td></tr>
					<tr height="30px"><td width="150px">level:</td><td><?=iSelect('level',$mstr_level,0,'width:250px')?></td></tr>
					<tr height="30px"><td width="150px">group:</td><td><?=iSelect('group',$mstr_group,0,'width:250px')?></td></tr>
					<tr height="30px"><td width="150px">division:</td><td><?=iSelect('division',$mstr_division,0,'width:250px')?></td></tr>
				</table>
			</td>
			<td style="padding-left:30px" width="430px">
			<div id="emp_result" style="420px;margin-top:10px">
				<form name="rc_form" action="<?=RLNK?>report_collective.php" target="_blank" method="get" style="display:hidden">
					<input type="hidden" name="date1" id="rc_date1" value=""/>
					<input type="hidden" name="date2" id="rc_date2" value=""/>
					<input type="hidden" name="status" id="rc_status" value=""/>
					<input type="hidden" name="level" id="rc_level" value=""/>
					<input type="hidden" name="group" id="rc_group" value=""/>
					<input type="hidden" name="division" id="rc_division" value=""/>
					<input type="hidden" name="sortby" id="rc_sortby" value=""/>
					<input type="hidden" name="dps" id="rc_dps" value=""/>
				</form>
			</div>
			</td>
		</tr>
		</table>
		</div>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button class="btn" onclick="jumpTo('<?=RLNK?>report.php')">Back</button></td>
		<td align="right"><button id="ri_next1" class="btnx" onclick="gotoStep(2)" style="padding:0 10px"> Next </button></td>
		</td></tr></table>
	</div>
	<div id="prog2" style="padding-left:10px;display:none">
		<div style="height:340px">
		<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top" height="300px">
			<td style="padding-right:10px" width="400px">
			<div class="pfsub">Select columns to be printed:</div>
				<table class="listtable" cellspacing="0" cellpadding="0"><?php $l=1;?>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" disabled class="iCheck" type="checkbox" value="1"/></td><td><label for="dp<?=($l-1)?>">Name</label></td></tr>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" disabled  class="iCheck" type="checkbox" value="2"/></td><td><label for="dp<?=($l-1)?>">NIP</label></td></tr>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="3"/></td><td><label for="dp<?=($l-1)?>">Status</label></td></tr>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="4"/></td><td><label for="dp<?=($l-1)?>">Level</label></td></tr>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="5"/></td><td><label for="dp<?=($l-1)?>">Group</label></td></tr>
					<tr><td width="24px"><input  checked id="dp<?=($l++)?>" class="iCheck" type="checkbox" value="6"/></td><td><label for="dp<?=($l-1)?>">Division</label></td></tr>
				</table>
			<div class="pfsub">Sort by: <select id="sortby" class="iSelect">
					<option value="name">Name</option>
					<option value="nip">NIP</option>
					<option value="status">Status</option>
					<option value="level">Level</option>
					<option value="group">Group</option>
					<option value="division">Division</option>
				</select></div>
			</td>
		</tr>
		</table>
		</div>
		<div class="pfsub" style="border-top:1px solid #eaeaea;margin-top:20px"></div>
		<table id="prog2btntbl" class="stable" cellspacing="0" cellpadding="0" style="width:400px;margin-top:10px"><tr>
		<td><button class="btn" onclick="gotoStep(1)">Back</button></td>
		<td align="right"><button id="ri_next2" class="btnx" onclick="doSubmit()" style="padding:0 10px"> Generate report </button></td>
		</td></tr></table>
	</div>
</div>