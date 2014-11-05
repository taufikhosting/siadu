<?php appmod_use('aka/tahunajaran','aka/tingkat');
$fmod='tingkat';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);
if(count($departemen)>0){
$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

// Query
$t=mysql_query("SELECT * FROM aka_tingkat WHERE tahunajaran='$tajar' ORDER BY tingkat");
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,"width:".$PSBar->selw,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		tahunajaran_warn(); exit();
	}

$PSBar->end();

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Tingkat','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['tingkat'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else departemen_warn();
?>