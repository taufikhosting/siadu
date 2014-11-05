<?php appmod_use('aka/guru','aka/tingkat'); $gid=guru_SID(); $opt=gpost('opt');
$fmod='penilaian';
$xtable=new xtable($fmod,'penilaian');
$xtable->pageorder="aka_penilaian.replid";

$pel=gpost('pelajaran');
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
	$db=new xdb("aka_penilaian");
	$db->field("SUM(aka_penilaian.bobot) as tbobot");
	$db->where_ands("aka_penilaian:guru='$gid',pelajaran='$pel',kelas='$kls'");
	$t1=$db->query();
	$r1=mysql_fetch_array($t1);
	$tbobot=$r1['tbobot'];
	
	// Query
	$db=new xdb("aka_penilaian");
	$db->field("aka_penilaian:*");
	$db->where_ands("aka_penilaian:guru='$gid',pelajaran='$pel',kelas='$kls'");
	$t=$db->query();
	$xtable->ndata_db($t);
	$t=$db->query($xtable->pageorder_sql("aka_penilaian:nama,kode,kkm,bobot"));

	$xtable->btnbar_f('add');
	
	//echo $xtable->ndata;
	if($xtable->ndata>0){
		// Table head
		$xtable->head('@Penilaian','@Kode{C}','@bobot penilaian{C}','!Persentase Bobot{C}','Keterangan');
	
		while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
			
			$xtable->td($r['nama'],300);
			$xtable->td($r['kode'],100,'c');
			//$xtable->td($r['kkm'],100,'c');
			$xtable->td($r['bobot'],120,'c');
			$xtable->td(number_format($r['bobot']*100/$tbobot,2).' %',120,'c');
			$xtable->td(nl2br($r['keterangan']));
			
			$s='<button class="btn" title="Daftar nilai siswa." onclick="openPage('.app_page_getindex('daftarnilai').',\'daftarnilai\',false,\'pelajaran='.$pel.'&kelas='.$kls.'&penilaian='.$r['replid'].'\')"><div class="bi_lis" style="">Nilai</div></button>&nbsp;&nbsp;~60';
			$xtable->opt($r['replid'],$s,'u','d');
			
		$xtable->row_end();}$xtable->foot();
		
	}else{$xtable->nodata();}
}
?>