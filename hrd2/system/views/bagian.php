<?php
$fmod='bagian';
$xtable=new xtable($fmod,'divisi pegawai');

// Query
$db=new xdb("hrd_m_bagian");
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('bagian'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama divisi','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['bagian'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>