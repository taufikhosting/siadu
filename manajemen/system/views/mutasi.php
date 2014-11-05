<?php appmod_use('aka/tahunlulus','aka/tingkat','aka/kelas','aka/siswa');
$opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='mutasi';
$xtable=new xtable($fmod);
$xtable->search_keyon('nisn=>aka_siswa.nisn:EQ-0','nama=>aka_siswa.nama:LIKE-1');
$xtable->pageorder="aka_mutasi.tanggal";

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);	
$PSBar->end();

if($PSBar->pass){
// Query
$db=new xdb("aka_mutasi");
$db->field("aka_mutasi:replid,siswa as idsiswa,tanggal,keterangan","aka_jenismutasi.nama as njenis","aka_siswa:nisn,nama","departemen:nama as ndepartemen","aka_angkatan:angkatan as nangkatan");
$db->join("siswa","aka_siswa");
$db->join("jenismutasi","aka_jenismutasi");
$db->joinother("aka_siswa","angkatan","aka_angkatan");
$db->joinother("aka_angkatan","departemen","departemen");
$db->where("aka_angkatan.departemen='$dept'");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('aka_mutasi.tanggal','aka_siswa:nisn,nama','aka_jenismutasi.nama'));

$xtable->btnbar_f('add','print','srcbox');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@tanggal','@!NISN','@nama','@jenis mutasi','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		//$t1=dbQSql("SELECT * FROM aka_siswa WHERE replid='".$r['siswa']."' LIMIT 0,1");
		//$r1=dbFA($t1);
		
		$xtable->td(fftgl($r['tanggal']),120);
		$xtable->td($r['nisn'],80);
		$xtable->td($r['nama'],300);
		$xtable->td($r['njenis'],100);
		$xtable->td(nl2br($r['keterangan']));
		//$xtable->td($r['tmplahir'].', '.fftgl($r['tgllahir']),100);
		
		//$s='<button class="btn" title="Keluarkan siswa dari kelas ini." onclick="siswa_pendataan_kelas_form(\'df\',\''.$r['replid'].'\')"><div class="bi_canb">&nbsp;</div></button>';
		$xtable->opt($r['idsiswa'],'u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}

}

} else { departemen_warn(); }?>