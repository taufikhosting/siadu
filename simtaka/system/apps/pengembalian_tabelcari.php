<?php
require_once(MODDIR.'xtable/xtable.php');
require_once(MODDIR.'control.php');
$fmod='peminjaman_tabelcari';
$xtable = new xtable($fmod);
$xtable->tblstyle='float:default';

$keyword = gpost('keyword');
if($keyword!=''){
// Query
$sql="SELECT sar_peminjaman.*,sar_barang.kode,sar_katalog.nama FROM sar_peminjaman LEFT JOIN sar_barang ON sar_barang.replid=sar_peminjaman.barang LEFT JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE (sar_barang.kode='$keyword' OR sar_katalog.nama LIKE '%$keyword%')";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
//echo '<textarea>';
echo '<div style="float:none !important">';
if($xtable->ndata>0){
	// Table head
	$xtable->tblstyle='float:left;margin-top:4px';
	$xtable->head('Kode','Nama Barang');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['kode'],80);
		$xtable->td($r['nama']);
		$xtable->opt($r['replid'],
			'<button class="btn" onclick="pengembalian_setpeminjaman(<id>)"><div class="bi_in">Proses</div></button>');
		
	$xtable->row_end();}$xtable->foot();
}else{
	$xtable->nodata_cust('Tidak ditemukan barang dengan kode atau nama <b>'.$keyword.'</b> yang dipinjam.');
}
echo '</div>';
//echo '</textarea>';
}
?>