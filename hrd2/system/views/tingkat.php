<?php
$fmod='tingkat';
$xtable=new xtable($fmod,'tingkat pegawai');

// Query
$db=new xdb("hrd_m_tingkat");
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('tingkat'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama Tingkat','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['tingkat'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>