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
$t=mysql_query("SELECT * FROM `emp_dayoff` WHERE `dcid`='$dcid'");
$r=mysql_fetch_array($t);
$scuti=12-$hcuti+$r['count'];
$fwidth=$r['count']>1?550:420;
?>
<script type="text/javascript" language="javascript">

</script>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:<?=$fwidth?>px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Delete day off</b>
	</div>
	<div style="text-align:left;padding:10px">
		<table class="stable" cellspacing="0" cellpadding="3px" width="<?($fwidth-20)?>px">
			<tr><td>Delete <?=$fname?>'s day off on: <b><?=fftgl($r['date1'])?> <?php if($r['count']>1) echo "to ".fftgl($r['date1']);?></b> (<span id="htnghari"><?=$r['count']?></span> day<?=$r['count']>1?"s":""?>)?</td></tr>
			<tr><td><i>Sisa cuti setelah menghapus cuti ini: <span id="htnghari2" style="color:<?=(($scuti<=0)?"#ff0000":"inherit")?>"><?=$scuti?> Hari</span></i></td></tr>
		</table>
		<br/>
		<br/>
		<table cellspacing="0" cellpadding="3px" width="100%"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btnx" value="Delete" onclick="emp_delcuti(<?=$dcid?>)"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>