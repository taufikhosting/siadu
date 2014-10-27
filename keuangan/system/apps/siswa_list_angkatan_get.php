<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');  require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/angkatan','aka/siswa');

$angk=gpost('angkatan',$angk);

$fmod='siswa_list_angkatan';
$xform=new xform($fmod);

$xform->table_begin();
	$xform->col_begin();
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Pilih Siswa');

	/*
$PSBar = new PSBar_2(100,220);
$PSBar->begin();
	$t=mysql_query("SELECT departemen FROM aka_angkatan WHERE replid='".$pemb['angkatan']."' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	$PSBar->selection('Departemen',departemen_name($r['departemen']));
	
	$PSBar->selection('Angkatan',angkatan_name($pemb['angkatan']));
$PSBar->end();
*/

$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nama=>aka_siswa.nama:LIKE|aka_siswa.nis:EQ-0,1');
$xtable->search_box_pos('l','200px');

$db=siswa_db_byangkatan($angk);
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

$xtable->search_box('nis atau nama siswa');

$xtable->search_info('data siswa dengan nis atau nama "<b>{keyw}</b>"'.($angk==0?'':' pada angkatan '.$angkatan[$angk]).'.');
$fid=0;
if($xtable->ndata>0){
	$xtable->head('NIS','Nama','{40px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		if($fid==0) $fid=$r['replid'];
		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		if(admin_isoperator()) $s='<button class="btn" title="Proses" onclick="E(\'siswa\').value='.$r['replid'].';pembayaran_proses_get()"><div class="bi_arrow2b">&nbsp;</div></button>~36px';
		else $s='<div style="height:23px;width:36px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else{
	$xtable->nodata_cust('Tidak ada data siswa'.($angk==0?'':' pada angkatan ini').'.');
}
$xform->table_end(0);

hiddenval('siswa_list_num',$xtable->ndata);
hiddenval('siswa_list_firstid',$fid);
?>