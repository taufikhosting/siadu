<?php
$empstatus=getStatus();
$dcid=gpost('id');
$fname=gpost('name');
$r=dbSFA("*","jbssdm.employment_app","W/dcid='$dcid'");
?>
<script type="text/javascript" language="javascript">

</script>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
<div class="fformbox" style="width:400px">
	<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
		<b>Edit Data <?=$fname?></b>
	</div>
	<div style="text-align:left;padding:10px">
		<table class="stable" cellspacing="0" cellpadding="3px" width="380px">
			<tr><td width="100px">NIP:</td><td><input type="text" class="ifield" id="nip" value="<?=$r['nip']?>" style="width:250px"/></td></tr>
			<tr><td>Bagian:</td><td>
				<select class="ifield" id="empbagian" style="width:140px">
					<option value="Akademik"<?=isSelect("Non Akademik",$r['empbagian'])?>>Akademik</option>
					<option value="Non Akademik"<?=isSelect("Non Akademik",$r['empbagian'])?>>Non Akademik</option>
				</select>
			</td></tr>
			<tr><td>Tingkatan Staff:</td><td>
				<select class="ifield" id="staff" style="width:140px">
					<option value="Staff"<?=isSelect("Staff",$r['staff'])?>>Staff</option>
					<option value="General Staff"<?=isSelect("General Staff",$r['staff'])?>>General Staff</option>
				</select>
			</td></tr>
			<tr><td>Golongan:</td><td>
				<select class="ifield" id="golongan" style="width:140px">
					<option value="Lokal"<?=isSelect("Lokal",$r['golongan'])?>>Lokal</option>
					<option value="Ekspatriat"<?=isSelect("Ekspatriat",$r['golongan'])?>>Ekspatriat</option>
				</select>
			</td></tr>
		</table>
		<br/>
		<br/>
		<table cellspacing="0" cellpadding="3px" width="100%"><tr>
			<td align="center">
				<input type="button" class="btn" onclick="close_fform()" value="Batal"/>
				<input type="button" class="btnx" value="Simpan" onclick="save_ipf1()"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>