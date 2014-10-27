<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
$fmod='penempatan_saudara_pilihsiswa';
$xtable=new xtable($fmod);

$dept=gpost('psdepartemen');
$departemen=departemen_r($dept);

$tajar=gpost('pstahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('pstingkat');
$tingkat=tingkat_r($ting,$dept);
$kls=gpost('pskelas');
$kelas=kelas_r($kls,$ting);

if(count($departemen)>0){
?>
<div class="fftabbar">
<div class="fftab" onclick="pendataan_saudara_siswacari(0)">Cari siswa</div>
<div class="fftab1" onclick="pendataan_saudara_siswapilih(0)">Pilih siswa</div>
</div>
<?php

$PSBar = new PSBar_2(100);
$PSBar->begin();
	$PSBar->selection('Departemen',iSelect('psdepartemen',$departemen,$dept,$PSBar->selws,"pendataan_saudara_siswapilih(1)"));
	
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('pstahunajaran',$tahunajaran,$tajar,$PSBar->selws,"pendataan_saudara_siswapilih(1)"));
	} else {
		$PSBar->end();
		hiddenval('pstahunajaran',$tajar);
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		tahunajaran_warn(1,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('pstingkat',$tingkat,$ting,$PSBar->selws,"pendataan_saudara_siswapilih(1)"));
	} else {
		$PSBar->end();
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		tingkat_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('pskelas',$kelas,$kls,$PSBar->selws,"pendataan_saudara_siswapilih(1)"));
	} else {
		$PSBar->end();
		hiddenval('pskelas',$kls);
		kelas_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
$PSBar->end();

if($PSBar->pass){
$t=mysql_query("SELECT * FROM aka_siswa WHERE kelas='$kls' ORDER BY nama");
$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
	//$xtable->optw='50px';
	$xtable->head('NIS','NISN','Nama');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$xtable->td($r['nis'],120);
		$xtable->td($r['nisn'],120);
		$xtable->td($r['nama']);
		if(admin_isoperator()) $s='<button class="btn"onclick="pendataan_saudara_setsiswa(\''.$r['nama'].'\',\''.departemen_name($r['departemen']).'\',\''.$r['tgllahir'].'\')">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata_cust('Tidak ada data siswa pada kelas ini.'); }}
} else departemen_warn(1);
?>