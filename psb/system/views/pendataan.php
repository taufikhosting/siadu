<?php dbDel("psb_tmp_saudara","sesid='".session_id()."'");

require_once(APPMOD.'psb/proses.php');
require_once(APPMOD.'psb/kelompok.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$fmod='pendataan';
$xtable = new xtable($fmod,'calon siswa');
//$xtable->pageorder="barkode,judul";

$dept=gpost('departemen');
$departemen=departemen_r($dept);

$pros=gpost('proses');
$proses=proses_r($pros,$dept);

$kel=gpost('kelompok');
$kelompok=kelompok_r($kel,$pros);

if(count($departemen)>0){
$kapasitas=dbFetch("kapasitas","psb_proses","W/replid='$pros'");
if($kapasitas>0){
	$ncalon=dbSRow("psb_calonsiswa","W/proses='$pros' AND status<>0");
	$nsiswa=dbSRow("psb_calonsiswa","W/proses='$pros' AND kelompok='$kel' AND status<>0");
	$barw=300;
	$wcalon=intval($ncalon*$barw/$kapasitas);
	$wsiswa=intval($nsiswa*$barw/$kapasitas);
}

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($proses)>0){
		$PSBar->selection('Periode',iSelect('proses',$proses,$pros,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('proses',$pros);
		hiddenval('kelompok',$kel);
		proses_warn(); exit();
	}
	
	if($PSBar->pass){
	if(count($kelompok)>0){
		$PSBar->selection('Kelompok',iSelect('kelompok',$kelompok,$kel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelompok',$kel);
		kelompok_warn(); exit();
	}}

$PSBar->end();

if($opt=='af'||$opt=='uf'){require_once(VWDIR.'pendataan_form.php');}
else{
// Query
$xtable->pageorder="nopendaftaran,nama";
$xtable->search_keyon('nopendaftaran(nomor pendaftaran)=>EQ-0','nama-1');
$db=new xdb("psb_calonsiswa");
$db->where("kelompok='$kel'");
$db->where_and($xtable->search_sql_get());

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('nopendaftaran','nama'));

$xtable->btnbar_begin();
	if($ncalon<$kapasitas){ $xtable->btnbar_add(); }
	else { echo '<div class="infobox" style="float:left;margin-left:40px">Kuota periode pendaftaran ini telah penuh.</div>'; }
	$xtable->btnbar_print();
	$xtable->search_box();
$xtable->btnbar_end();

if($xtable->ndata>0){
	$xtable->head_addrow('@Nomor pendaftaran{2,100px}','@Nama{2}','Uang pangkal{R,2}','Discount{C,1,3}','Denda{R,2}','Uang pangkal net{R,2,90px}','Angsuran{R}');
	$xtable->head_addrow('Subsidi{R}','Saudara{R}','Tunai{R}','!x bulan{R}');
	$xtable->head_multi();
	while($r=mysql_fetch_array($t)){ $xtable->row_begin();
		$xtable->td($r['nopendaftaran'],100);
		$xtable->td($r['nama']);
		$xtable->td(fRp($r['sumpokok']),90,'r');
		$xtable->td(fRp($r['disctb']),90,'r');
		$xtable->td(fRp($r['discsaudara']),90,'r');
		$xtable->td(fRp($r['disctunai']),90,'r');
		$xtable->td(fRp($r['denda']),90,'r');
		$xtable->td(fRp($r['sumnet']),90,'r');
		$xtable->td(fRp($r['angsuran']).'<br/>x '.$r['jmlangsur'].' bulan',90,'r');
		$xtable->opt($r['replid'],'v','u','d');
	$xtable->row_end(); } $xtable->foot();

}
}}else departemen_warn(1);?>