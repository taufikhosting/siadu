<?php $opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='pegawai';

if($opt=='af'||$opt=='uf'){
	require_once(VWDIR.'pegawai_form.php');
}
else{
$xtable = new xtable($fmod,'pegawai');
$xtable->search_keyon('nama=>hrd_pegawai.nama:LIKE-0','nip=>hrd_pegawai.nip:EQ-1');
$xtable->pageorder="hrd_pegawai.nama";

// Query			  
$db=new xdb("hrd_pegawai");
$db->field("hrd_pegawai:*","hrd_m_status:status as nstatus");
$db->join("status","hrd_m_status");
$db->where($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('hrd_pegawai.nama','hrd_pegawai.nip','hrd_pegawai.status'));

$xtable->btnbar_f('add','print','srcbox');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama','@!NIP','Status');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['nama'],200);
		$xtable->td($r['nip'],100);
		$xtable->td($r['nstatus']);
		//$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata(); }
}
?>