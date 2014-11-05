<?php
$fmod='lokasi';
$xtable=new xtable($fmod);
$xtable->btnbar_f('add');

// Query
$sql="SELECT * FROM pus_lokasi";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('kode','nama'));

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Kode','@Nama Lokasi','Alamat','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['kode'],60);
		$xtable->td($r['nama'],250);
		$xtable->td(nl2br($r['alamat']),250);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>