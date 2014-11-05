<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/guru');

$pel=gpost('pelajaran');
$tajar=gpost('tahunajaran');

$fmod='sks_guru_list';
$xtable=new xtable($fmod,'item','',3);
$xtable->search_box_pos('l');
$xtable->search_keyon('kunci=>hrd_pegawai.nip:EQ|hrd_pegawai.nama:LIKE-0,1');
$xtable->pageorder="hrd_pegawai.nama";

// Query
$db=guru_db();
$db->where_and("aka_guru.pelajaran='$pel'");
$db->where_and("aka_guru.tahunajaran='$tajar'");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('hrd_pegawai.nama','hrd_pegawai.nip'));

//$xtable->search_box('NIP atau nama guru');

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto">';
	$xtable->head('@Nama','@!NIP','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['npegawai']);
		$xtable->td($r['nip'],80);
		
		$s='<button class="btn" onclick="sks_guru_set('.$r['replid'].',\''.$r['npegawai'].'\')">Pilih</button>';
		$xtable->td($s,40,'c');
		
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
}else{$xtable->nodata();}
?>