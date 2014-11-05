<?php require_once(APPMOD.'psb/proses.php');
$fmod='kelompok';
$xtable=new xtable($fmod,'kelompok pendaftaran');

$dept=gpost('departemen');
$departemen=departemen_r($dept);
$pros=gpost('proses');
$proses=proses_r($pros,$dept);


if(count($departemen)>0){
// Query
$sql="SELECT * FROM psb_kelompok WHERE proses='$pros'";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

// Page sort and order
$po=$xtable->pageorder_sql('kelompok','kapasitas');
$t=mysql_query($sql.$po);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($proses)>0){
		$PSBar->selection('Periode',iSelect('proses',$proses,$pros,"width:".$PSBar->selw,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('proses',$pros);
		proses_warn(); exit();
	}
$PSBar->end();

$bcolor=array("#86c2ff", "#ffb129", "#00fa29", "#ffcf0d", "#00eb27", "#89bc02", "#ff8001");
$kapasitas=dbFetch("kapasitas","psb_proses","W/replid='$pros'");
$nsiswa=dbSRow("psb_calonsiswa","W/proses='$pros' AND status<>0");
$barw=300;
?>
<div class="tbltopbar" style="width:100%">
<div style="float:right;margin-left:10px;border:1px solid #01a8f7;height:4px;width:<?=$barw?>px;margin-right:4px;margin-top:10px;margin-bottom:4px">
<?php 
	$t1=mysql_query("SELECT * FROM psb_kelompok WHERE proses='$pros'"); $k=0;
	while($r1=mysql_fetch_array($t1)){
	$n=mysql_num_rows(mysql_query("SELECT * FROM psb_calonsiswa WHERE kelompok='".$r1['replid']."' AND status<>0"));
	$w=intval($n*$barw/$kapasitas);
		echo '<div style="float:left;background:'.$bcolor[$k++].';height:4px;width:'.$w.'px"></div>';
	}
?>
</div>
<div style="padding-top:4px;float:right"><b>Kuota:</b> <?=$nsiswa.' dari '.$kapasitas?> siswa</div>
<?php
if($ncalon<$kapasitas){ $xtable->btnbar_add(); }
else { echo '<div class="infobox" style="float:left;margin-left:40px">Kuota periode pendaftaran ini telah penuh.</div>'; }
$xtable->btnbar_print();  $xtable->btnbar_help();
?>
</div>
<?php
notifbox();
if($xtable->ndata>0){
	// Table head
	$xtable->head('&nbsp;','Kelompok','tanggal pendaftaran~C','Biaya pendaftaran{R}','Calon Siswa~C','Siswa Diterima~C','Keterangan');
	$k=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE kelompok='".$r['replid']."'");
		$n = mysql_num_rows($q);
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE kelompok='".$r['replid']."' AND status<>0");
		$n1 = mysql_num_rows($q);
		
		$xtable->td('<div style="margin:auto;width:14px;height:14px;background:'.$bcolor[$k++].'"></div>',20,'c');
		$xtable->td($r['kelompok'],300);
		$xtable->td(fftgl($r['tglmulai']).(fftgl($r['tglselesai'])!='-'?'<br/>s/d '.fftgl($r['tglselesai']):''),180,'c');
		$xtable->td(fRp($r['biaya']),120,'r');
		$xtable->td($n,100,'c');
		$xtable->td($n1,100,'c');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}else departemen_warn(1);
?>