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

$query = mysql_query("SELECT * FROM psb_proses WHERE departemen='$dept'");


$token=doc_decrypt($token);
/*
	$gb = mysql_query("SELECT nama,fname FROM rep_file WHERE replid=13")
	$data = mysql_fetch_assoc($gb)
	$gambar = $data[fname];
*/	

$doc=new doc();
$img='<img src="../shared/images/logo.png" width="120px" />';

$doc->cell($img,1);
$doc->dochead("Data Periode Penerimaan ".gets('kelompok'),6);
$doc->cell('&nbsp;',100,'',1);
$doc->cell('&nbsp;',100,'',1);
$doc->nl();

$doc->row_blank(9);
$doc->nl();
	

//$t=dbQSql($token);
$no=1;
$doc->head('No{C}','@Periode Penerimaan','@Kode Awalan','@Angkatan','@Kapasitas','@Calon Siswa','@Siswa diterima','@Status','Keterangan');

while($r=dbFA($query)){

		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE proses = '".$r['replid']."'");
		$n = mysql_num_rows($q);
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE proses = '".$r['replid']."' AND status<>0");
		$n1 = mysql_num_rows($q);
		
$doc->nl();
$doc->cell($no++,20,'c');
$doc->cell($r['proses'],80);
$doc->cell($r['kodeawalan'],30);
$doc->cell($r['angkatan'],30);
$doc->cell($r['kapasitas'],50);
$doc->cell($n,50);
$doc->cell($n1,50);
$doc->cell(($r['aktif']=='1'?'<span style="color:#00A000"><b>Dibuka</b></span>':'Ditutup'),50);
}$doc->cell(($r['keterangan']),50);

$doc->end(); ?>