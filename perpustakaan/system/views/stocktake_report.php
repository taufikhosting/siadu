<?php require_once(MODDIR.'control.php');
$cid=gpost('cid');
stocktake_ptrack(5);
$t=mysql_query("SELECT * FROM pus_stockhist WHERE replid='$cid' LIMIT 0,1");
$r=mysql_fetch_array($t);
$tbl="joshso.".$r['tabel'];

$tot=$r['nitem'];
$ncek=$r['nceky'];
$nnocek=$tot-$ncek;
$nwn=$r['nnote'];
$nnn=$nnocek-$nwn;
?>
<div style="padding:10px">
<div class="sfont" style="width:100%;font-size:14px;float:left;margin-bottom:10px">
	Cetak laporan stock opname
</div>
<div class="sfont" style="width:100%;float:left;margin-bottom:20px">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px">
			<td width="150px">Nama stock opname</td><td width="150px">: <?=$r['nama']?></td>
			<td></td><td></td>
		</tr>
		<tr height="24px">
			<td>Tanggal mulai</td><td>: <?=fftgl($r['tanggal1'])?></td>
			<td></td><td></td>
		</tr>
		<tr height="24px">
			<td>Tanggal selesai</td><td>: <?=fftgl($r['tanggal2'])?></td>
			<td></td><td></td>
		</tr>
		<tr height="24px">
			<td>Total item di database</td><td>: <?=$tot?> item</td>
			<td></td><td></td>
		</tr>
		<tr height="24px">
			<td>Item dicek</td><td>: <?=$ncek?> item</td>
			<td width="180px">Item hilang dengan keterangan</td><td>: <?=$nwn?> item</td>
		</tr>
		<tr height="24px">
			<td>Item hilang</td><td>: <?=$nnocek?> item</td>
			<td>Item hilang tanpa keterangan</td><td>: <?=$nnn?> item</td>
		</tr>
	</table>
</div>
<div class="sfont" style="width:100%;float:left;margin-bottom:10px">
	<b>Pengaturan laporan:</b>
</div>
<div style="width:100%;float:left">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="30px">
			<td width="90px">Cetak:</td>
			<td><?=iSelect('lap_cetak',array('Semua','Item yang dicek','Item hilang','Item hilang dengan keterangan','Item hilang tanpa keterangan'))?></td>
		</tr>
		<tr height="30px">
			<td width="90px">&nbsp;</td>
			<td><?=iCheckbox('lap_tglcetak','',1,'tampilkan tanggal pencetakan',1)?></td>
		</tr>
		<tr height="30px">
			<td width="90px">&nbsp;</td>
			<td><?=iCheckbox('lap_sum','',1,'tampilkan rangkuman',1)?></td>
		</tr>
		<tr height="30px">
			<td width="90px">Ukuran kertas:</td>
			<td><?=iSelect('lap_kertas',array('F4'=>'F4 210x330mm','A4'=>'A4 210x297mm'))?></td>
		</tr>
	</table>
</div>
<div style="width:100%;float:left;text-align:left;margin-top:30px">
	<div style="width:500px;float:left">
	<button class="btn" style="float:left" onclick="stocktake_report_back()">Batal</button>
	<button class="btnz" style="float:right" onclick="stocktake_print(<?=$r['replid']?>)">Cetak laporan</button>
	</div>
</div>
</div>
