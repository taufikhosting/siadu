<?php appmod_use('aka/tahunlulus','aka/tingkat','aka/kelas','aka/siswa');
$opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='alumni';
$xtable=new xtable($fmod);
$xtable->search_keyon('nisn=>aka_siswa.nisn:EQ-0','nama=>aka_siswa.nama:LIKE-1');
$xtable->pageorder="aka_siswa.nisn";

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tlulus=gpost('tahunlulus');
$tahunlulus=tahunlulus_r($tlulus,$dept);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	$s='<button title="Tambah tahun kelulusan" class="btn" style="float:left" onclick="alumni_tahunlulus_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
	$PSBar->selection('Tahun kelulusan',iSelect('tahunlulus',$tahunlulus,$tlulus,'float:left;margin-right:4px;width:'.(intval($PSBar->selw)-28).'px',$fmod."_get()").$s);
	if(count($tahunlulus)==0){
		$PSBar->pass=false;
	}
	
$PSBar->end();

if($PSBar->pass){
// Query
$db=new xdb("aka_alumni");
$db->field("aka_alumni:replid,siswa as idsiswa,keterangan","aka_siswa:nisn,nama","departemen:nama as ndepartemen","aka_angkatan:angkatan as nangkatan");
$db->join("siswa","aka_siswa");
$db->joinother("aka_siswa","angkatan","aka_angkatan");
$db->joinother("aka_angkatan","departemen","departemen");
$db->where("aka_alumni.tahunlulus='$tlulus'");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata_db($t);
$t=$db->query($xtable->pageorder_sql('nisn','nama','angkatan'));

$xtable->btnbar_f('add','srcbox');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@!NISN','@nama','@angkatan{C}','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		//$t1=dbQSql("SELECT * FROM aka_siswa WHERE replid='".$r['siswa']."' LIMIT 0,1");
		//$r1=dbFA($t1);
		
		//$xtable->td($r['nis'],80);
		$xtable->td($r['nisn'],120);
		$xtable->td($r['nama'],300);
		$xtable->td($r['nangkatan'],80,'c');
		$xtable->td(nl2br($r['keterangan']));
		//$xtable->td($r['tmplahir'].', '.fftgl($r['tgllahir']),100);
		
		//$s='<button class="btn" title="Keluarkan siswa dari kelas ini." onclick="siswa_pendataan_kelas_form(\'df\',\''.$r['replid'].'\')"><div class="bi_canb">&nbsp;</div></button>';
		$xtable->opt($r['idsiswa'],'u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}

}

} else { departemen_warn(); }?>