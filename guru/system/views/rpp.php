<?php appmod_use('aka/guru','aka/tingkat'); $gid=guru_SID();
$fmod='rpp';
$xtable=new xtable($fmod,'!RPP');

$pel=gpost('pelajaran');
$pelajaran=guru_pelajaran_r($pel);
$ting=gpost('tingkat');
$tingkat=guru_tingkat_r($ting);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	
	if(count($pelajaran)>0){
		$PSBar->selection('Pelajaran',iSelect('pelajaran',$pelajaran,$pel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('pelajaran',$pel);
		hiddenval('tingkat',$ting);
		echo '<div class="warnbox" style="float:left">Tidak ada pelajaran yang diajar.</div>';
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		echo '<div class="warnbox" style="float:left">Tidak ada kelas yang diajar.</div>';
		$PSBar->pass=false;
	}}
	
$PSBar->end();

if($PSBar->pass){
	// Query
	$db=new xdb("aka_rpp");
	$db->where_and("aka_rpp.guru='$gid'");
	$db->where_and("aka_rpp.pelajaran='$pel'");
	$db->order("aka_rpp.replid");
	$t=$db->query();
	$xtable->ndata_db($t);

	$xtable->btnbar_f('add');

	if($xtable->ndata>0){
		// Table head
		$xtable->head('Unit','Deskripsi');
		
		while($r=mysql_fetch_array($t)){$xtable->row_begin();
			$xtable->td($r['unit'],200);
			$xtable->td(trim_textw($r['deskripsi'],300));
			$xtable->opt($r['replid'],'u','d');
			
		$xtable->row_end();}$xtable->foot();
	}else{$xtable->nodata();}
}
?>