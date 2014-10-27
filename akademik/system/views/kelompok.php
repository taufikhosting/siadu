<?php appmod_use('aka/tahunajaran','aka/tingkat');
$fmod='kelompok';
$xtable=new xtable($fmod);
$xtable->use_urut('aka_grup');

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

// Query
$t=mysql_query("SELECT aka_grup.* FROM aka_grup WHERE aka_grup.tahunajaran='$tajar' ORDER BY aka_grup.urut");
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
	$xtable->head('Nama Kelompok','Jumlah siswa~C','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$n=mysql_num_rows(mysql_query("SELECT grup FROM aka_siswa_grup WHERE grup='".$r['replid']."'"));
		
		$xtable->td($r['nama'],200);
		$xtable->td($n,150,'c');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt($r['replid'],'u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
}else departemen_warn();?>