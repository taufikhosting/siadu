<?php
$empstatus=MstrGet("mstr_status");
$dcid=gpost('id');
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
			<?=inputTanggal('tanggal1',$tgl,"hitungHari()")?> to </td></tr>
			<tr><td>&nbsp;</td><td><?=inputTanggal('tanggal2',$tgl,"hitungHari()")?> ( <span id="htnghari"><?=$dif?></span> day(s) )</td></tr>
			<tr><td>&nbsp;</td><td><i>Day off remaining after take this day off: <span id="htnghari2" style="color:<?=(($scuti<=0)?"#ff0000":"inherit")?>"><?=$scuti?> day(s)</span></i></td></tr>
			<tr valign="top"><td width="100px">Note:</td><td><?=iTextarea("keterangan","","width:100%",5)?></td></tr>
		</table>
		<br/>
		<br/>
		<table cellspacing="0" cellpadding="3px" width="100%"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Batal"/>
				<input type="button" class="btnx" value="Simpan" onclick="emp_addcuti()"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>