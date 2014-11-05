<?php appmod_use('aka/tahunajaran','aka/pelajaran');
$fmod='guru';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$pel=gpost('spelajaran');
$pelajaran=pelajaran_r($pel,$tajar,1);

// Query
if($pel==0){
$t=mysql_query("SELECT aka_guru.*,hrd_pegawai.nip,hrd_pegawai.nama,aka_pelajaran.nama as namapelajaran FROM aka_guru LEFT JOIN hrd_pegawai ON aka_guru.pegawai=hrd_pegawai.replid LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_guru.pelajaran WHERE aka_guru.tahunajaran='$tajar' ORDER BY aka_pelajaran.nama, hrd_pegawai.nama");
} else {
$t=mysql_query("SELECT aka_guru.*,hrd_pegawai.nip,hrd_pegawai.nama FROM aka_guru LEFT JOIN hrd_pegawai ON aka_guru.pegawai=hrd_pegawai.replid WHERE aka_guru.tahunajaran='$tajar' AND aka_guru.pelajaran='$pel' ORDER BY hrd_pegawai.nama");
}
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
		hiddenval('spelajaran',$pel);
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($pelajaran)>1){
		$PSBar->selection('Pelajaran',iSelect('spelajaran',$pelajaran,$pel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('spelajaran',$pel);
		pelajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}}
$PSBar->end();

if($PSBar->pass){
$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	if($pel==0){
		$xtable->head('Mata pelajaran','Nama Guru','NIP','Keterangan');
	} else {
		$xtable->head('Nama Guru','NIP','Keterangan');
	}
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		if($pel==0) $xtable->td($r['namapelajaran'],150);
		//$xtable->td($r['kode'],50);
		$xtable->td($r['nama'],250);
		$xtable->td($r['nip'],150);
		//$xtable->td(statusguru_name($r),150);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
} else departemen_warn(); ?>