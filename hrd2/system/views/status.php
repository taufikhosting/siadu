<?php
$fmod='status';
$xtable=new xtable($fmod,'status pegawai');

// Query
$db=new xdb("hrd_m_status");
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('status'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama status','Reminder','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['status'],200);
		$xtable->td($r['reminder'].' hari',200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>