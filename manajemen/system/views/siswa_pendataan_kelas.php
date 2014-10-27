<?php appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');
$opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='siswa_pendataan_kelas';

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$tajar);
$kls=gpost('kelas');
$kelas=kelas_r($kls,$ting,1);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tingkat_warn(0,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		kelas_warn(0,'float:left');
		$PSBar->pass=false;
	}}
$PSBar->end();

if($PSBar->pass){
if($opt=='af'||$opt=='uf') require_once(VWDIR.'siswa_form.php');
else{
$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nis=>aka_siswa.nis:EQ','nama=>aka_siswa.nama:LIKE');
$xtable->docname="Data Siswa Kelas ".kelas_name($kls)." T.A. ".tahunajaran_name($tajar);
$xtable->printparams=array('kelas'=>kelas_name($kls),'tahunajaran'=>tahunajaran_name($tajar));

$db=siswa_db_bykelas($kls,$ting,"nisn,tmplahir,tgllahir");
$db->where_and($xtable->search_sql_get());
$t=$xtable->use_db($db,$xtable->pageorder_sql('nis','nisn','nama'));

$xtable->btnbar_f('print','srcbox');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@!NIS','@!NISN','@nama','Tempat Tanggal lahir');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nis'],80);
		$xtable->td($r['nisn'],200);
		$xtable->td($r['nama']);
		$xtable->td($r['tmplahir'].', '.fftgl($r['tgllahir']),100);
		
		//$s='<button class="btn"></button>';
		$xtable->opt($r['replid'],'v');
		
	$xtable->row_end();}$xtable->foot();
	
}else{$xtable->nodata();}

}}} else { departemen_warn(); }?>