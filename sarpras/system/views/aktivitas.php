<?php
$fmod='aktivitas';
$xtable=new xtable($fmod);
$xtable->pageorder="tanggal1 DESC,tanggal2 DESC";

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);

$PSBar = new PSBar_2(); // Page selection bar
$PSBar->begin();
	if(count($lokasi)>0){
		$PSBar->selection('lokasi',iSelect('lokasi',$lokasi,$lok,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('lokasi',$lok);
		lokasi_warn();
		exit();
	}
$PSBar->end();

// Query
$db=new xdb("sar_aktivitas","","lokasi='$lok'");
$t=$xtable->use_db($db,$xtable->pageorder_sql('tanggal1'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Tanggal','Aktivitas','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td(fftgl($r['tanggal1']).' - '.fftgl($r['tanggal2']),200);
		$xtable->td(nl2br($r['aktivitas']),250);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>