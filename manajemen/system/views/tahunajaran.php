<?php
require_once(MODDIR.'control.php');

$fmod='tahunajaran';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){

// Query
$t=mysql_query("SELECT * FROM aka_tahunajaran WHERE departemen='$dept' ORDER BY tglmulai DESC,replid DESC");
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
$PSBar->end();

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Tahun Ajaran','Tanggal Mulai','Tanggal Akhir','Keterangan','Status~C');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['tahunajaran'],200);
		$xtable->td(fftgl($r['tglmulai']),120);
		$xtable->td(fftgl($r['tglakhir']),120);
		$xtable->td($r['keterangan']);
		if($r['aktif']=='1'){
		$s='<button class="btns" title="Klik untuk me-non aktifkan." style="width:85px" onclick="tahunajaran_status_form(\'uf\','.$r['replid'].')">Aktif</button>';
		} else {
		$s='<button class="btn" title="Klik untuk mengaktifkan." style="width:85px" onclick="tahunajaran_status_form(\'uf\','.$r['replid'].')">Tidak Aktif</button>';
		}
		$xtable->td($s,100,'c');
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else departemen_warn();?>