<?php require_once(APPMOD.'psb/proses.php');
/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
define('FOTODIR',ROTDIR.'photo/');

$dept=gpost('departemen');
$departemen=departemen_r($dept);
$pros=gpost('proses');
$proses=proses_r($pros,$dept);
// cell($a,$w=0,$c=1,$r=1,$al='',$b=-1,$bg='',$s='',$atr='')
$cid=gets('token');

$query = mysql_query("SELECT * FROM psb_kelompok WHERE proses='$pros'");


$token=doc_decrypt($token);

$doc=new doc();
$doc->cell_format('border:1');
$img='<img src="../shared/images/logo.png" width="120px" />';


$doc->cell($img,1);
$doc->dochead("Data Kelompok Pendaftaran ".gets('kelompok'),4);
$doc->cell('&nbsp;',100,'',1);
$doc->cell('&nbsp;',100,'',1);
$doc->nl();


$doc->nl();

$doc->row_blank(7);

$bcolor=array("#86c2ff", "#ffb129", "#00fa29", "#ffcf0d", "#00eb27", "#89bc02", "#ff8001");
$kapasitas=dbFetch("kapasitas","psb_proses","W/replid='$pros'");
$nsiswa=dbSRow("psb_calonsiswa","W/proses='$pros' AND status<>0");
$barw=300;
?>

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
<?php

//$t=dbQSql($token);
$no=1;
$doc->head('No{C}','@Kelompok','@Tanggal Pendaftaran','@Biaya Pendaftaran','@calon Siswa','@Siswa diterima','Keterangan');

while($r=dbFA($query)){

		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE kelompok='".$r['replid']."'");
		$n1 = mysql_num_rows($q);
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE kelompok='".$r['replid']."' AND status<>0");
		$n2 = mysql_num_rows($q);
		
$doc->nl();
$doc->cell($no++,20,'c');
$doc->cell($r['kelompok'],80);
$doc->cell(fftgl($r['tglmulai']).(fftgl($r['tglselesai'])!='-'?'<br/>s/d '.fftgl($r['tglselesai']):''),50);
$doc->cell(fRp($r['biaya']),50);
//$doc->cell($r['biaya'],50);
$doc->cell($n1,50);
$doc->cell($n2,50);
}$doc->cell($r['keterangan'],50);

$doc->end(); ?>