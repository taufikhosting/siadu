<?php require_once(APPMOD.'psb/proses.php');
/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
define('IMGDIR',ROTDIR.'images/');

$dept=gpost('departemen');
$departemen=departemen_r($dept);
$proses=proses_r($pros,$dept);
// cell($a,$w=0,$c=1,$r=1,$al='',$b=-1,$bg='',$s='',$atr='')
$cid=gets('token');


$pros=gpost('proses');

$query = mysql_query("SELECT * FROM psb_calonsiswa WHERE replid='$cid' LIMIT 0,1");


$token=doc_decrypt($token);
/*
	$gb = mysql_query("SELECT nama,fname FROM rep_file WHERE replid=13")
	$data = mysql_fetch_assoc($gb)
	$gambar = $data[fname];
*/	
$proses=mysql_fetch_array(mysql_query("SELECT * FROM psb_proses WHERE replid='".$r['proses']."' LIMIT 0,1"));
$kelompok=mysql_fetch_array(mysql_query("SELECT * FROM psb_kelompok WHERE replid='".$r['kelompok']."' LIMIT 0,1"));
$departemen=mysql_fetch_array(mysql_query("SELECT * FROM departemen WHERE replid='".$proses['departemen']."' LIMIT 0,1"));

$doc=new doc();
$doc->dochead('Pendataan Calon Siswa',100);
//$doc->nl();

//$doc->row_blank(5);

//$t=dbQSql($token);
$no=1;
$doc->head('@Nomor Pendaftaran{2}','@Nama{2}','@Uang Pangkal{R,2}','Discount{C,1,3}','Denda{R,2}','Uang pangkal net{R,2,90px}','Angsuran{R}');
$doc->head('Subsidi{R}','Saudara{R}','Tunai{R}','!x bulan{R}');

while($r=dbFA($query)){

$doc->nl();
//$doc->cell($no++,20,'c');
$doc->cell($r['nopendaftaran'],90,'r');
$doc->cell($r['nama']);
$doc->cell(fRp($r['sumpokok']),90,'r');
$doc->cell(fRp($r['disctb']),90,'r');
$doc->cell(fRp($r['discsaudara']),90,'r');
$doc->cell(fRp($r['disctunai']),90,'r');
$doc->cell(fRp($r['denda']),90,'r');
$doc->cell(fRp($r['angsuran']).'<br/>x '.$r['jmlangsur'].' bulan',90,'r');

}


$doc->end(); ?>