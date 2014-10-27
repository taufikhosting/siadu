<?php appmod_use('aka/tahunajaran');
$fmod='tesakademik';
$xtable=new xtable($fmod,'jenis penilaian');
$xtable->use_urut('aka_tes');
$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

// Query
$t=mysql_query("SELECT * FROM aka_tes WHERE tahunajaran='$tajar' ORDER BY urut");
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
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}

$PSBar->end();

if($PSBar->pass){
$xtable->btnbar_f('add','updn');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama Penilaian','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['nama'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt($r['replid'],'u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
}else departemen_warn();?>