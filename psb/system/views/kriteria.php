<?php
$fmod='kriteria';
$xtable=new xtable($fmod);
$xtable->use_urut('psb_kriteria');

// Query
$t=mysql_query("SELECT * FROM psb_kriteria ORDER BY urut");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('add','updn');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama kriteria','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['kriteria'],200);
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>