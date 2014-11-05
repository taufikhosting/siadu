<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'apps/aka.php');
$fmod='penempatan_calon';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

$pros=gpost('proses');
$proses=proses_r($pros,$dept,1);
$kel=gpost('kelompok');
$kelompok=kelompok_r($kel,$pros,1);
$krit=gpost('kriteria');
$kriteria=kriteria_r($krit,1);

echo '<div class="tbltopbar" style="width:100%;padding-bottom:5px"><div style="padding-top:4px;float:left"><b>Calon siswa:</b></div></div>';

// Page Selection Bar
$PSBar = new PSBar_2(100);
$PSBar->begin();
	//$PSBar->selection('','');
	if(count($proses)>0){
		$PSBar->selection('Periode',iSelect('proses',$proses,$pros,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('proses',$pros);
		hiddenval('kelompok',$kel);
		hiddenval('kriteria',$krit);
		proses_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($kelompok)>0){
		$PSBar->selection('Kelompok',iSelect('kelompok',$kelompok,$kel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelompok',$kel);
		hiddenval('kriteria',$krit);
		kelompok_warn(0,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kriteria)>0){
		$PSBar->selection('Kriteria',iSelect('kriteria',$kriteria,$krit,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kriteria',$krit);
		kriteria_warn(0,'float:left');
		$PSBar->pass=false;
	}}
$PSBar->end();

if($PSBar->pass){
$t=mysql_query("SELECT psb_calonsiswa.*,aka_kelas.replid as idkelas, aka_kelas.kelas as nkelas,aka_tingkat.replid as idtingkat FROM psb_calonsiswa LEFT JOIN aka_kelas ON aka_kelas.replid=psb_calonsiswa.kelas LEFT JOIN aka_tingkat ON aka_tingkat.replid=aka_kelas.tingkat WHERE psb_calonsiswa.status='1' ".($pros==0?"":" AND psb_calonsiswa.proses='$pros' ").($kel==0?"":" AND psb_calonsiswa.kelompok='$kel'").($krit==0?"":" AND psb_calonsiswa.kriteria='$krit' ")." ORDER BY nama");

$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
	$xtable->optw='40px';
	$xtable->head('No Pendaftaran','Nama','Kelas~C');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['nopendaftaran'],100);
		$xtable->td($r['nama']);
		$k=$r['idkelas']!=0?'<a class="linkb" href="javascript:void(0)" onclick="penempatan_kelas_get('.$r['idkelas'].','.$r['idtingkat'].')" title="Tampilkan kelas '.$r['nkelas'].'">'.$r['nkelas'].'</a>':'';
		$xtable->td($k,100,'c');
		if(admin_isoperator() && $r['idsiswa']==0) $s='<button class="btn" title="Tempatkan siswa" onclick="penempatan_form(\'af\',<id>)"><div class="bi_arrow2b">&nbsp;</div></button>';
		else $s='<div style="height:23px;width:20px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata_cust('Belum ada calon siswa yang diterima pada kelompok penerimaan ini.'); }
}
?>