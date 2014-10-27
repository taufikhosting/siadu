<?php appmod_use('aka/angkatan');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

dbDel("aka_tmp_saudara","sesid='".session_id()."'");

$fmod='siswa_pendataan_angkatan';

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$angk=gpost('angkatan');
$angkatan=angkatan_r($angk,$dept);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($angkatan)>0){
		$PSBar->selection('Angkatan',iSelect('angkatan',$angkatan,$angk,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('angkatan',$angk);
		angkatan_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
$PSBar->end();

if($PSBar->pass){
if($opt=='af'||$opt=='uf') require_once(VWDIR.'siswa_form.php');
else{
$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nis=>aka_siswa.nis:EQ','nama=>aka_siswa.nama:LIKE');
$xtable->docname="Data Siswa Angkatan ".angkatan_name($angk);
$xtable->printparams=array('angkatan'=>angkatan_name($angk));

// Query
$db=new xdb("aka_siswa");
$db->field("aka_siswa:replid,nis,nisn,nama,tmplahir,tgllahir");
$db->where_and("aka_siswa.angkatan='$angk'");
$db->where_and($xtable->search_sql_get());
$t=$xtable->use_db($db,$xtable->pageorder_sql('nis','nisn','nama'));

$xtable->btnbar_f('print','srcbox');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@!NIS','@!NISN','@nama','Tempat Tanggal lahir','{50px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nis'],80);
		$xtable->td($r['nisn'],120);
		$xtable->td($r['nama']);
		$xtable->td($r['tmplahir'].', '.fftgl($r['tgllahir']),100);
		
		//$s='<button class="btn" title="Keluarkan siswa dari kelas ini." onclick="siswa_form(\'df\',\''.$r['replid'].'\')"><div class="bi_canb">&nbsp;</div></button>';
		$xtable->opt($r['replid'],'v');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata_cust('Tidak ada data siswa pada angkatan ini.');}

}}} else { departemen_warn(); }?>