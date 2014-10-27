<?php
$fmod='contoh';
$xtable=new xtable($fmod);
// Query
$t=mysql_query("SELECT * FROM psb_angsuran ORDER BY cicilan");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('notifbox','add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('nOmOr','Jumlah angusran (bulan)','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($nom*=2,50);
		$xtable->td($r['cicilan'],200);
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>