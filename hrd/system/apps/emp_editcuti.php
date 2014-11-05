<?php
$empstatus=MstrGet("mstr_status");
$dcid=gpost('id');
$empappid=gpost('eid');
$tgl=gpost('tgl');
if($tgl=='0'){
	$tgl=date("Y-m-d");
	$dif=1;
	$scuti=intval(gpost('scuti'))-$dif;
} else {
	$dif=1;
	$scuti=intval(gpost('scuti'))-$dif;
}
$fname=gpost('name');
$cyear=date("Y");
$t=mysql_query("SELECT * FROM `emp_dayoff` WHERE `empid`='$empappid' AND `date1y`='$cyear' AND `date2y`='$cyear'");
$hcuti=0;
while($r=mysql_fetch_array($t)){
	$hcuti+=$r['count'];
}
$scuti=12-$hcuti;
$t=mysql_query("SELECT * FROM `emp_dayoff` WHERE `dcid`='$dcid'");
$r=mysql_fetch_array($t);

?>
<script type="text/javascript" language="javascript">

</script>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:500px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Day off request of : <?=$fname?></b>
	</div>
	<div style="text-align:left;padding:10px">
		<table class="stable" cellspacing="0" cellpadding="3px" width="480px">
			<tr><td>Day off date:</td><td>
			<?=inputTanggal('tanggal1',$r['date1'],"hitungHarix(".($scuti+$r['count']).")")?> s/d </td></tr>
			<tr><td>&nbsp;</td><td><?=inputTanggal('tanggal2',$r['date2'],"hitungHarix(".($scuti+$r['count']).")")?> ( <span id="htnghari"><?=$r['count']?></span> day(s) )</td></tr>
			<tr><td>&nbsp;</td><td><i>Day off remaining after take this day off: <span id="htnghari2" style="color:<?=(($scuti<=0)?"#ff0000":"inherit")?>"><?=$scuti?> day(s)</span></i></td></tr>
			<tr valign="top"><td width="100px">Note:</td><td><?=iTextarea("keterangan",$r['note'],$s="width:100%",$r=5)?></td></tr>
		</table>
		<br/>
		<br/>
		<table cellspacing="0" cellpadding="3px" width="100%"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Batal"/>
				<input type="button" class="btnx" value="Update" onclick="emp_updatecuti(<?=$dcid?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>