<?php appmod_use('aka/tahunajaran','aka/tingkat');
$fmod='kelas';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$tajar);

// Query
$t=mysql_query("SELECT * FROM aka_kelas WHERE tingkat='$ting'");
$xtable->ndata=mysql_num_rows($t);

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
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		tingkat_warn(0,'float:left');
		$PSBar->pass=false;
	}}
$PSBar->end();

if($PSBar->pass){
$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama Kelas','Wali','Kapasitas','Terisi','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['kelas'],200);
		$xtable->td(dbFetch("nama","hrd_pegawai","W/replid='".dbFetch("pegawai","aka_guru","W/replid='".$r['wali']."'")."'"),200);
		$xtable->td($r['kapasitas'],150);
		$xtable->td(dbSRow("aka_siswa_kelas","W/kelas='".$r['replid']."'"),150);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
} else departemen_warn(); ?>