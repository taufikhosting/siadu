<?php
$fmod='lokasi';
$xtable=new xtable($fmod,'Lokasi barang');
// Query
$t=mysql_query("SELECT * FROM sar_lokasi ORDER BY kode");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('notifbox','add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Kode','Nama Lokasi','Alamat','Kontak','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['kode'],60);
		$xtable->td($r['nama'],200);
		$xtable->td(nl2br($r['alamat']),300);
		$xtable->td($r['kontak'],100);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>