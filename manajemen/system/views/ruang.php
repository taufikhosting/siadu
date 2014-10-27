<?php
require_once(MODDIR.'control.php');

$fmod='ruang';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){

// Query
$sql="SELECT * FROM aka_ruang WHERE departemen='$dept'";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('kode','nama'));

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
$PSBar->end();

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Kode Ruang','@Nama Ruang','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['kode'],100);
		$xtable->td($r['nama'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else departemen_warn();
?>