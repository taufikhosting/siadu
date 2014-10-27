<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt');
$c=gpost('c');
$c=$c==""?"aka_setguru":$c;
if($opt=='find'){
	$keyw=gpost('name');
	$sql="SELECT aka_guru.*,hrd_pegawai.nip,hrd_pegawai.nama FROM aka_guru LEFT JOIN hrd_pegawai ON aka_guru.pegawai=hrd_pegawai.replid WHERE hrd_pegawai.nip='$keyw' OR hrd_pegawai.nama LIKE '%$keyw%' GROUP BY aka_guru.pegawai ORDER BY hrd_pegawai.nama";
	
	//echo $sql;
	//$sql="SELECT * FROM ".DB_HRD." WHERE nip='$keyw' OR name LIKE '%$keyw%' ORDER BY name";
	//echo $sql;
	$t=mysql_query($sql);
	$ndata=mysql_num_rows($t);
	if($ndata>0){?>
	<div style="max-height:210px;overflow:auto">
	<table class="xtable" border="0" cellspacing="1px" cellpadding="4px" width="100%">
	<tr>
		<th>NIP</th>
		<th>Nama</th>
		<th class="alc">Pilihan</th>
	</tr>
	<?php $x=$ndata>2?0:2;
	while($r=mysql_fetch_array($t)){ if($ndata>2) $x=$x==0?2:0; else $x=2; ?>
		<tr class="xtr<?=$x?>">
			<td width="100px"><?=$r['nip']?></td>
			<td width="*"><?=$r['nama']?></td>
			<td width="40px" align="center">
				<button class="btn" onclick="<?=$c?>('<?=$r['nip']?>','<?=$r['nama']?>',<?=$r['replid']?>);close_fform2();">Pilih</button>
			</td>
		</tr>
	<?php }?>
	</table>
	</div>
	<?php }else{?>
	<div class="infobox" style="float:left">Tidak ditemukan guru dengan nip atau nama <b><?=$keyw?></b></div>
	<?php }
} else {
$sql="SELECT aka_guru.*,".DB_HRD.".nip,".DB_HRD.".nama FROM aka_guru LEFT JOIN ".DB_HRD." ON aka_guru.pegawai=".DB_HRD.".replid GROUP BY aka_guru.pegawai ORDER BY ".DB_HRD.".nama";
//echo $sql;
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

$fwidth=500;
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt2" align="center" style="padding-top:100px">
<div id="fformbox2" class="fformbox" style="width:<?=($fwidth+20)?>px">
	<div class="fformtitle">Pilih Guru</div>
	<table cellspacing="15px" cellpadding="0" width="100%"><tr><td>
		<table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:-5px">
			<tr><td style="padding-bottom:6px">
				<input type="button" class="btn" id="showallbtn" value="Tampilkan semua" onclick="aka_findguru(0)" style="display:none;float:left"/>
				<input type="button" class="find21" value="" style="float:right;margin-top:2px;margin-left:4px" onclick="aka_findguru()"/><?=iText('srcname','','float:right','Nama atau nip guru')?>
				<input type="hidden" id="srccback" value="<?=$c?>" />
			</td></tr>
			<tr height="310px" valign="top"><td>
				<div style="width:100%">
					<div id="loader7" class="loader" style="display:none"></div>
					<div id="databox">
						<?php if($ndata>0){?>
						<div style="max-height:210px;overflow:auto">
						<table class="xtable" border="0" cellspacing="1px" cellpadding="4px" width="100%">
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th class="alc">Pilihan</th>
						</tr>
						<?php $x=$ndata>2?0:2;
						while($r=mysql_fetch_array($t)){ if($ndata>2) $x=$x==0?2:0; else $x=2; ?>
							<tr class="xtr<?=$x?>">
								<td width="100px"><?=$r['nip']?></td>
								<td width="*"><?=$r['nama']?></td>
								<td width="40px" align="center">
									<button class="btn" onclick="<?=$c?>('<?=$r['nip']?>','<?=$r['nama']?>',<?=$r['replid']?>);close_fform2();">Pilih</button>
								</td>
							</tr>
						<?php }?>
						</table>
						</div>
						<?php }else{?>
						<div class="infobox" style="float:left">Belum ada data guru</div>
						<?php }?>
					</div>
				</div>
			</td></tr>
			<tr><td align="right" style="padding-top:10px;padding-bottom:0px">
				<button onclick="close_fform2()" class="btn">Tutup</button>
			</td></tr>
		</table>
	</td></tr></table>
</div>
</td></tr></table>
<?php }?>