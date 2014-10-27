<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');  require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/tingkat','aka/kelas','aka/siswa');

$tajar=gpost('tahunajaran',$tajar);
$tingk=gpost('tingkat');
$tingkat=tingkat_r($tingk,$tajar);
$kls=gpost('kelas');
$kelas=kelas_r($kls,$tingk);

$fmod='siswa_list_kelas';
$xform=new xform($fmod);

$xform->table_begin();
	$xform->col_begin();
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Pilih Siswa');

$PSBar = new PSBar_2(100,220);
$PSBar->begin();
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$tingk,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$tingk);
		tingkat_warn(1); exit();
	}
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		kelas_warn(1); exit();
	}
$PSBar->end();


$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nama=>aka_siswa.nama:LIKE|aka_siswa.nis:EQ-0,1');
$xtable->search_box_pos('l','200px');

$db=siswa_db_bykelas($kls,$tingk);
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

$xtable->search_box('nis atau nama siswa');

$xtable->search_info('data siswa dengan nis atau nama "<b>{keyw}</b>"'.($angk==0?'':' pada tahun ajaran '.$tahunajaran[$tajar]).'.');
$fid=0;
if($xtable->ndata>0){
	$xtable->head('NIS','Nama','Tunggakan{R}','{40px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		$t2=dbQSql("SELECT * FROM keu_pembayaran WHERE modul='$modid' AND siswa='".$r['replid']."'");
		$r2=dbFA($t2);
		$dibayar=0;
		$t3=dbQSql("SELECT * FROM keu_transaksi WHERE pembayaran='".$r2['replid']."'");
		while($r3=dbFA($t3)){
			$dibayar+=$r3['nominal'];
		}
		
		if($fid==0) $fid=$r['replid'];
		$xtable->td($r['nis'],40);
		$xtable->td($r['nama']);
		$xtable->td(fRp(($r2['nominal']-$dibayar)),80,'r');
		if(admin_isoperator()) $s='<button class="btn" title="Proses" onclick="E(\'siswa\').value='.$r['replid'].';pembayaran_proses_get()"><div class="bi_arrow2b">&nbsp;</div></button>~36px';
		else $s='<div style="height:23px;width:36px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else{
	$xtable->nodata_cust('Tidak ada data siswa.');
}
$xform->table_end(0);

hiddenval('siswa_list_num',$xtable->ndata);
hiddenval('siswa_list_firstid',$fid);
?>