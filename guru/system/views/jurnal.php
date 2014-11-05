<?php appmod_use('aka/guru','aka/tingkat'); $gid=guru_SID();
$fmod='jurnal';
$xtable=new xtable($fmod,'jurnal');

$pel=gpost('jurnal');
$pelajaran=guru_pelajaran_r($pel);
$kls=gpost('kelas');
$kelas=guru_kelas_r($kls);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	
	if(count($pelajaran)>0){
		$PSBar->selection('Pelajaran',iSelect('pelajaran',$pelajaran,$pel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('pelajaran',$pel);
		hiddenval('kelas',$kel);
		echo '<div class="warnbox" style="float:left">Tidak ada pelajaran yang diajar.</div>';
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		echo '<div class="warnbox" style="float:left">Tidak ada kelas yang diajar.</div>';
		$PSBar->pass=false;
	}}
	
$PSBar->end();

if($PSBar->pass){
	// Query
	$db=new xdb("aka_jurnal");
	$db->where_and("aka_jurnal.guru='$gid'");
	$db->where_and("aka_jurnal.pelajaran='$pel'");
	$db->where_and("aka_jurnal.kelas='$kls'");
	$db->order("aka_jurnal.tanggal");
	$t=$db->query();
	$xtable->ndata_db($t);

	$xtable->btnbar_f('add');

	if($xtable->ndata>0){
		// Table head
		$xtable->head('Tanggal','Keterangan');
		
		while($r=mysql_fetch_array($t)){$xtable->row_begin();
			$xtable->td($r['tanggal'],200);
			$xtable->td(trim_textw($r['keterangan'],500));
			$xtable->opt($r['replid'],'u','d');
			
		$xtable->row_end();}$xtable->foot();
	}else{$xtable->nodata();}
}
?>