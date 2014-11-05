<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'apps/aka.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas');
$fmod='sirkulasi_member_get_siswa';
$xtable=new xtable($fmod,'siswa');

$keyw=gpost('keyword');
$xtable->keyw=$keyw;
$xtable->keyph='nis atau nama siswa';
$xtable->search_box_pos('l');

$dept=gpost('psdepartemen');
$departemen=departemen_r($dept);

$tajar=gpost('pstahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$ting=gpost('pstingkat');
$tingkat=tingkat_r($ting,$tajar,1);

$kls=gpost('pskelas');
$kelas=kelas_r($kls,$ting,0,1);

?>
<div class="fftabbar">
<div class="fftab1" onclick="<?=$fmod?>_get(0)">Siswa</div>
<div class="fftab" onclick="siswa_saudara_siswapilih(0)">Pegawai</div>
<div class="fftab" onclick="siswa_saudara_siswapilih(0)">Member luar</div>
</div>
<?php
$PSBar = new PSBar_2(100);
$PSBar->begin();
	$PSBar->selection('Departemen',iSelect('psdepartemen',$departemen,$dept,$PSBar->selws,$fmod."_get(1)"));
	
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('pstahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('pstahunajaran',$angk);
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		hiddenval('keyword','');
		tahunajaran_warn(1,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>1){
		$PSBar->selection('Tingkat',iSelect('pstingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		hiddenval('keyword','');
		kelas_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>1){
		$PSBar->selection('Kelas',iSelect('pskelas',$kelas,$kls,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('pskelas',$kls);
		hiddenval('keyword','');
		kelas_warn(1,'float:left');
		$PSBar->pass=false;
	}}
	
$PSBar->end();
if($PSBar->pass){

$xtable->btnbar_begin();
	//echo iTextSrc('pskeyword',$keyw,'float:left~width:250px','NIS atau nama siswa...',"peminjaman_member_get_siswa(1)");
	$xtable->search_box();
$xtable->btnbar_end();

$fl="";
if($ting!=0){
	if($fl!="")$fl.=" AND ";
	$fl.=" aka_kelas.tingkat='$ting' ";
}
if($kls!=0){
	if($fl!="")$fl.=" AND ";
	$fl.=" aka_siswa.kelas='$kls' ";
} else {
	//if($fl!="")$fl.=" AND ";
	//$fl.=" aka_siswa.kelas<>'0' ";
}
if($keyw!=""){
	if($fl!="")$fl.=" AND ";
	$fl.=" (aka_siswa.nama LIKE '%$keyw%' OR aka_siswa.nis='$keyw') ";
}
if($fl!="")$fl=" WHERE ".$fl;


$t=mysql_query("SELECT aka_siswa.replid,aka_siswa.nama,aka_siswa.nis,aka_kelas.kelas as nkelas FROM aka_siswa_kelas LEFT JOIN aka_siswa ON aka_siswa.replid=aka_siswa_kelas.siswa LEFT JOIN aka_kelas ON aka_kelas.replid=aka_siswa_kelas.kelas ".$fl." GROUP BY aka_siswa_kelas.siswa ORDER BY aka_siswa.nama");
$xtable->ndata=mysql_num_rows($t);

//$xtable->search_info($keyw,'Hasil pencarian data siswa dengan NIS atau nama "<b>'.$keyw.'</b>".',"E('pskeyword').value='';peminjaman_member_get_siswa(1)");
$xtable->search_info();

if($xtable->ndata>0){
	//$xtable->optw='50px';
	$xtable->head('!NIS','Nama');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		
		if(admin_isoperator()) $s='<button class="btn" title="Lihat detil" onclick="sirkulasi_member_siswa_view(\''.$r['replid'].'\')"><div class="bi_srcb">&nbsp;</div></button>&nbsp;<button class="btn" onclick="sirkulasi_member_pilih('.$r['replid'].',1,\''.$r['nama'].'\')">Pilih</button>~75px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
	
} else { $xtable->nodata_cust('Tidak data siswa dengan NIS atau nama <b>'.$keyw.'</b> di kelas ini.'); }
}
?>