<?php
$fmod='golongan';
$xtable=new xtable($fmod);
$xtable->use_urut('psb_golongan');

// Query
$t=mysql_query("SELECT * FROM psb_golongan ORDER BY urut");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('add','updn');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama golongan','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['golongan'],200);
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>