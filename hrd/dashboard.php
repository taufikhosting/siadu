<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="dashboard";  // current view
$ct_bg="";
$ct_title="Dashboard";

/** Global Variables */
$emp_status=MstrGetStatus();

/** Pre Data Processing */
//  hitung statistik employee
	$t=mysql_query("SELECT * FROM employee");//dbSel("*","employee");
	$n=mysql_num_rows($t);
	$viewstat=false;
	if($n>0){
		$viewstat=true;
		$sval=Array();
		
		// berdasarkan status
		foreach($emp_status as $key=>$val) $sval[$key]=0;
		while($r=dbFA($t)){
			$sval[$r['status']]++;
		}
		$sdata=""; $k=0;
		foreach($emp_status as $key=>$val){
			if($sval[$key]>0){
			if($k>0) $sdata.=",";
			$sdata.="{ label: \"".$emp_status[$key]."\", data: ".$sval[$key]."}";
			$k++;
			}
		}
	}
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<script language="javascript" type="text/javascript" src="jsscript/jquery.js"></script>
<?php if($viewstat>0){ ?>
<script language="javascript" type="text/javascript" src="jsscript/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="jsscript/jquery.flot.pie.js"></script>
<script type="text/javascript">
	$(function(){
		var sdata=[<?=$sdata?>];
		var gobj={series:{pie:{show:true,radius:1,label:{show:true,radius:3/4,formatter:labelFormatter,background:{opacity:0}}}},legend:{show:false}}
		var placeholder=$("#placeholder");
		$.plot('#placeholder',sdata,gobj);
	});
	function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
</script>
<?php }?>
</head><body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top"><?php require_once(VWDIR.'banner.php');?></tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr>
		<td><?php require_once(VWDIR.'tabs.php');?></td>
		<td align="right"><?php require_once(WGDIR.'search.php');?></td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="ct_box">
				<div class="tview" style="position:relative"><b><?=$ct_title?></b></span>
					<button class="btn" style="position:absolute;top:5px;right:0px" title="Add new employee" onclick="document.location='<?=RLNK?>addemployee.php?lnk=home'">
					<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">New employee</div>
					</button>
				</div>
				<table cellspacing="0" cellpadding="0" width="940px">
				<tr valign="top">
					<td width="260px">
					<div style="margin-bottom:10px;box-shadow: 0px 2px 2px rgba(0, 0, 0, .15);background:url('<?=IMGR?>alert.png') no-repeat 5px 6px #fff5f5;border:1px solid #ffbbbb;width:210px;padding:10px 10px 10px 38px;font:11px Verdana,Tahoma;color:#ff3f3f;border-radius:5px">
						<b>1</b> Karyawan akan segera berakhir masa kerjanya!
					</div>
					<td rowspan="2" width="680px">
					<table class="xtable" border="0" cellspacing="1px" width="650px" style="margin-left:20px;display:none"><!-- AGENDA -->
					<tr>
						<th>History Aktivitas</th>
					</tr>
					<tr>
						<td style="padding:15px">
						<i>Tidak ada aktivitas terakhir yang dilakukan.</i>
						<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						</td>
					</tr>
					</table>
					</td>
				</tr>
				<tr valign="top">
					<td width="260px">
					<table class="xtable" border="0" cellspacing="1px" width="260px" style="margin-bottom:10px;display:none">
					<tr>
						<th>Catatan</th>
					</tr>
					<tr>
						<td style="padding:15px">
						
						<i>Tidak ada catatan.</i>
						
						</td>
					</tr>
					</table>
					<?php if($viewstat>0 && false){ ?>
					<table class="xtable" border="0" cellspacing="1px" width="260px">
					<tr>
						<th>Statistik Karyawan</th>
					</tr>
					<tr>
						<td style="padding:15px" align="center">
						<div id="placeholder" style="width:200px;height:200px"></div>
						</td>
					</tr>
					</table>
					<?php }?>
					</td>
				</tr>
				</table>
			</div>
		</td>
	</tr>
	</table>
</td></tr>
</table>
<?php require_once(VWDIR.'footer.php');?>
</div>
</body>
</html>