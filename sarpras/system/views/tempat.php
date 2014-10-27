<?php
$fmod='tempat';
$xtable=new xtable($fmod);

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

$t=mysql_query("SELECT * FROM sar_tempat WHERE lokasi='$lok' ORDER BY nama");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama Tempat','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nama'],250);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>