<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'apps/aka.php');
$fmod='penempatan_getkelas';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$dept,$tajar);
$kls=gpost('kelas');
$kelas=kelas_r($kls,$ting,1);

notifbox();

echo '<div class="tbltopbar" style="width:100%;padding-bottom:5px"><div style="padding-top:4px;float:left"><b>Penempatan:</b></div></div>';

$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,"penempatan_kelas_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tahunajaran_warn(1,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,"penempatan_kelas_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tingkat_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,"penempatan_kelas_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		kelas_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
$PSBar->end();

if($PSBar->pass){
$t=mysql_query("SELECT * FROM aka_siswa WHERE kelas='$kls' AND aktif='1' ORDER BY nis");
$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
	$xtable->optw='40px';
	$xtable->head('NIS','NISN','Nama');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$xtable->td($r['nis'],120);
		$xtable->td($r['nisn'],120);
		$xtable->td($r['nama']);
		if(admin_isoperator()) $s='<button class="btn" title="Batalkan penempatan siswa" onclick="penempatan_form(\'df\',\''.$r['replid'].'\')"><div class="bi_canb">&nbsp;</div></button>';
		else $s='<div style="height:23px;width:20px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata_cust('Belum ada siswa yang menempati kelas ini.'); }}
?>