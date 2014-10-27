<?php appmod_use('aka/tahunajaran','aka/pelajaran');

$fmod='pelajaran';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

// Query
$t=mysql_query("SELECT aka_pelajaran.* FROM aka_pelajaran WHERE aka_pelajaran.tahunajaran='$tajar' ORDER BY aka_pelajaran.nama");
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
$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Mata Pelajaran','Singkatan','!SKM{C}','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nama'],200);
		$xtable->td($r['kode'],100);
		$xtable->td($r['skm'],60,'c');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
}else departemen_warn();?>