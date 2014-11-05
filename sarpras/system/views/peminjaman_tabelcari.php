<?php
require_once(MODDIR.'xtable/xtable.php');
require_once(MODDIR.'control.php');
$fmod='peminjaman_tabelcari';
$xtable = new xtable($fmod);

$keyword = gpost('keyword');
if($keyword!=''){
// Query
$sql="SELECT sar_barang.*,sar_katalog.nama FROM sar_barang LEFT JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE sar_barang.kode='$keyword' OR sar_katalog.nama LIKE '%$keyword%'";

$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

if($xtable->ndata>0){
	// Table head
	$xtable->head('kode');
	while($r=mysql_fetch_array($t)){$xtable->row_click($r['replid'],'v'); $xtable->row_begin();
		
		$n=mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='".$r['replid']."'"));
		
		$xtable->td($r['kode'],80);
		$xtable->opt($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata_cust('Tidak ditemukan data barang dengan kode atau nama <b>'.$keyword.'</b>.');}
}
?>