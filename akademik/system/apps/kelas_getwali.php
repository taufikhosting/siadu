<?php
require_once(MODDIR.'control.php');

$sql="SELECT * FROM ".DB_HRD." ORDER BY name";
//echo $sql;
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

$fwidth=500;
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt2" align="center" style="padding-top:100px">
<div id="fformbox2" class="fformbox" style="width:<?=($fwidth+20)?>px">
	<table cellspacing="15px" cellpadding="0" width="100%"><tr><td>
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr><td>
			<div class="xtabbar">
				<div class="xtaba">Pilih Pegawai</div>
				<div class="xtab">Cari Pegawai</div>
			</div>
			</td></tr>
			<tr height="310px" valign="top"><td>
				<div id="psiswa" style="width:100%">
					<div id="loader2" class="loader" style="display:none"></div>
					<div id="psiswatbl">
						<?php if($ndata>0){?>
						<div style="max-height:210px;overflow:auto">
						<table class="xtable" border="0" cellspacing="1px" cellpadding="4px" width="100%">
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th class="alc">Pilihan</th>
						</tr>
						<?php $x=0;
						while($r=mysql_fetch_array($t)){ if($ndata>2) $x=$x==0?2:0; else $x=2; ?>
							<tr class="xtr<?=$x?>">
								<td width="100px"><?=$r['nip']?></td>
								<td width="*"><?=$r['name']?></td>
								<td width="40px" align="center">
									<button class="btn" onclick="kelas_setwali('<?=$r['nip']?>','<?=$r['name']?>',<?=$r['dcid']?>)">Pilih</button>
								</td>
							</tr>
						<?php }?>
						</table>
						</div>
						<?php }else{?>
						<div class="infobox" style="float:left">Tidak ada pegawai</div>
						<?php }?>
					</div>
				</div>
			</td></tr>
			<tr><td align="center" style="padding-top:10px;padding-bottom:10px">
				<button onclick="close_fform2()" class="btn">Tutup</button>
			</td></tr>
		</table>
	</td></tr></table>
</div>
</td></tr></table>