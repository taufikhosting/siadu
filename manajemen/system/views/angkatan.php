<?php
require_once(MODDIR.'control.php');

$fmod='angkatan';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){

// Query
$t=mysql_query("SELECT * FROM aka_angkatan WHERE departemen='$dept'");
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
$PSBar->end();

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Angkatan','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['angkatan'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else departemen_warn();
?>