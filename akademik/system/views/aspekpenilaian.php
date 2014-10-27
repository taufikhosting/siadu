<?php
$fmod='aspekpenilaian';
$xtable=new xtable($fmod,'Aspek penilaian');
// Query
$t=mysql_query("SELECT * FROM aka_aspekpenilaian ORDER BY aspekpenilaian");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('notifbox','add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Kode','Aspek Penilaian');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['kode'],200);
		$xtable->td($r['aspekpenilaian']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>