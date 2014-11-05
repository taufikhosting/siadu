<?php dbDel("psb_tmp_saudara","sesid='".session_id()."'");
require_once(APPMOD.'psb/kelompok.php');
require_once(APPMOD.'psb/proses.php');
require_once(APPMOD.'psb.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0; $keyw=gpost('keyword');

$fmod='penerimaan';
$xtable = new xtable($fmod,'calon siswa');
$xtable->keyw=$keyw;

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
	
	if(count($kelompok)>0){
		$PSBar->selection('Kelompok',iSelect('kelompok',$kelompok,$kel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelompok',$kel);
		kelompok_warn(); exit();
	}

$PSBar->end();

if($opt=='af'||$opt=='uf') require_once(VWDIR.'pendataan_form.php');
else{
$xtable->pageorder="nopendaftaran,nama";
$xtable->search_keyon('nopendaftaran(nomor pendaftaran)=>EQ-0','nama-1');
// Query
$db=new xdb("psb_calonsiswa");
$db->where("proses='$pros' AND kelompok='$kel'");
$db->where_and($xtable->search_sql_get());

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$xtable->opt_w='50px';
$t=$db->query($xtable->pageorder_sql('nopendaftaran','nama'));

$xtable->btnbar_begin();
	?>
	<div style="padding-top:4px;float:left;margin-right:10px"><b>Kuota:</b> <?=$nsiswa.' dari '.$kapasitas?> siswa</div>
	<div style="float:left;border:1px solid #01a8f7;height:4px;width:<?=$barw?>px;margin-right:4px;margin-top:10px;margin-bottom:4px;position:relative">
		<div style="position:absolute;top:0px;left:0px;background:#38ec00;height:4px;width:<?=$wsiswa?>px"></div>
	</div>
	<?php

	//echo iTextSrc('keyword',$keyw,'float:right~width:300px','Cari no pendaftaran atau nama calon siswa...',"penerimaan_cari()");
	$xtable->search_box();
	if($ncalon>=$kapasitas) { echo '<div class="infobox" style="float:left;margin-left:40px">Kuota periode pendaftaran ini telah penuh.</div>'; }
	//$xtable->btnbar_print();
$xtable->btnbar_end();

if($xtable->ndata>0){
	// Table head
	$xtable->head('@No Pendaftaran','@Nama','!NIS','!NISN','Status~C');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		if($r['idsiswa']!=0){
			$ts=mysql_query("SELECT nis,nisn FROM aka_siswa WHERE replid='".$r['idsiswa']."'");
			$rs=mysql_fetch_array($ts);
			$r['nis']=$rs['nis'];
			$r['nisn']=$rs['nisn'];
		}
		
		$xtable->td($r['nopendaftaran'],100);
		$xtable->td($r['nama']);
		$xtable->td($r['nis']==''?'-':$r['nis'],100);
		$xtable->td($r['nisn']==''?'-':$r['nisn'],120);
		//$xtable->td($r['keterangan']);
		
		/*
		$cb=' onclick="pendataan_syarat_form(\'uf\','.$r['replid'].')" ';
		$cs=calonsiswa_syarat($r['replid']);
		if($cs==0) $s='<div title="Semua persyaratan telah dipenuhi. Klik untuk melihat data persyaratan." style="margin:auto;cursor:pointer;width:18px;height:18px;background:url(\''.IMGR.'check18.png\') center no-repeat" '.$cb.'></div>';
		else if($cs==1) $s='<div title="Persyaratan wajib telah dipenuhi. Klik untuk melihat data persyaratan." style="margin:auto;cursor:pointer;width:18px;height:18px;background:url(\''.IMGR.'check18.png\') center no-repeat" '.$cb.'></div>';
		else $s='<div title="Persyaratan wajib belum dipenuhi. Klik untuk melihat data persyaratan." style="margin:auto;cursor:pointer;width:18px;height:18px;background:url(\''.IMGR.'rednotif18.png\') center no-repeat" '.$cb.'></div>';
		$xtable->td($r['bayar']==1?'Sudah':'Belum',120);
		*/
		
		if($r['status']==1){
			$s='<button class="btns" style="width:94px" title="Klik untuk membatalkan penerimaan." onclick="pendataan_status_form(\'uf\','.$r['replid'].')">Diterima</button>';
		} else {
			$s='<button class="btn" style="width:94px" title="Klik untuk melakukan penerimaan." onclick="pendataan_status_form(\'uf\','.$r['replid'].')">Blm diterima</button>';
		}
		$xtable->td($s,96,'c');
		
		$xtable->idata='detil calon siswa';
		$s='<button class="btn" title="Lihat detil" onclick="pendataan_showdetil('.$r['replid'].')"><div class="bi_srcb">&nbsp;</div></button>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}}else departemen_warn(1);?>