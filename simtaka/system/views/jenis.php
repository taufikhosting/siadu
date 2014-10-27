<?php
$fmod='jenis';
$xtable=new xtable($fmod,'Jenis barang');
// Query
$t=mysql_query("SELECT * FROM sar_jenis ORDER BY kode");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('notifbox','add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Kode','Nama','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		//$num_judul = @mysql_num_rows(mysql_query("SELECT * FROM sar_pustaka WHERE format=".$r['replid']));
		//$num_pustaka = @mysql_fetch_row(mysql_query("SELECT COUNT(d.replid) FROM sar_pustaka p, sar_daftarpustaka d WHERE d.pustaka=p.replid AND p.format=".$r['replid']));
				
		$xtable->td($r['kode'],60);
		$xtable->td($r['nama'],250);
		//$xtable->td($num_judul,100);
		//$xtable->td($num_pustaka[0],100);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>