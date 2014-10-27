<?php
$token=gets('token');

$t=mysql_query("SELECT * FROM  `keu_transaksi` WHERE nomer='$token'");
if(mysql_num_rows($t)>0){
// Queries:
$trans=mysql_fetch_array($t);
$kodetrans=substr($trans['nomer'],0,3);
if($kodetrans=='BKM') $ttl='BUKTI KAS MASUK';
else if($kodetrans=='BKK') $ttl='BUKTI KAS KELUAR';
else if($kodetrans=='BBM') $ttl='BUKTI BANK MASUK';
else if($kodetrans=='BBK') $ttl='BUKTI BANK KELUAR';
else $ttl='BUKTI TRANSAKSI';

?>
<table cellspacing="0" cellpadding="4px" style="border-collapse:collapse" width="<?=DOCPAPERWIDTH?>">
<tr valign="top">
	<td class="dochead1" colspan="3" align="center"><?=$ttl?></td>
</tr>
<tr height="10px">
	<td colspan="3"></td>
</tr>
<tr>
	<td>No. Transaksi</td><td colspan="2">: <?=$trans['nomer']?></td>
</tr>
<tr>
	<td>Tanggal</td><td colspan="2">: <?=fftgl($trans['tanggal'])?></td>
</tr>
<tr>
	<td>Diterima dari</td><td colspan="2">: </td>
</tr>
<tr height="10px">
	<td colspan="3"></td>
</tr>
<tr>
	<td class="cell" align="center" width="100px">Perkiraan</td>
	<td class="cell" align="center" width="300px">Uraian</td>
	<td class="cell" align="center" width="100px">Nominal</td>
</tr>
<?php
$t=mysql_query("SELECT * FROM keu_transaksi WHERE keu_transaksi.nomer='$token'");
$total=0;
while($r=mysql_fetch_array($t)){
	$t1=mysql_query("SELECT keu_jurnal.rek,keu_jurnal.debet,keu_jurnal.kredit,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek WHERE keu_jurnal.transaksi='".$r['replid']."' AND keu_rekening.kategorirek<>'1' AND keu_rekening.kategorirek<>'2' ORDER BY keu_jurnal.replid");

	while($r1=mysql_fetch_array($t1)){
		if($r1['rek']!=1){
			echo '<tr>';
			echo '<td class="cell" width="100px" align="center" x:str>'.$r1['koderek'].'</td>';
			echo '<td class="cell">'.$r['uraian'].'</td>';
			echo '<td class="cell" width="100px" align="right">'.fRp($r['nominal']).'</td>';
			echo '</tr>';
			$total+=$r['nominal'];
		}
	}
			
}
		echo '<tr>';
		echo '<td class="cell" width="100px"></td>';
		echo '<td class="cell" align="right">Jumlah</td>';
		echo '<td class="cell" width="100px" align="right" x:fmla="=SUM(C8:C9)">'.fRp($total).'</td>';
		echo '</tr>';
?>
</table>

<?php } else { doc_nofile(); } ?>