<?php
$fmod='kelompok';
$xtable=new xtable($fmod,'kelompok pegawai');

// Query
$db=new xdb("hrd_m_kelompok");
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('kelompok'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama kelompok','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['kelompok'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>