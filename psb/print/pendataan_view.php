<?php
function head_label($a,$b){
	global $pdf;
	$pdf->SetFont(mydeffont, '', 8, '', true);
	$pdf->MultiCell(45, 0, $a, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(100, 0, ': '.$b, 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
function head_label2($a,$b,$c){
	global $pdf;
	$pdf->SetFont(mydeffont, '', 8, '', true);
	$pdf->MultiCell(45, 0, $a, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(50, 0, ': '.$b, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(50, 0, $c, 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
function head_label2x($a,$b,$c){
	global $pdf;
	$pdf->SetFont(mydeffont, '', 8, '', true);
	$pdf->MultiCell(45, 0, $a, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(50, 0, $b, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(50, 0, $c, 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
function group_label($a){
	global $pdf;
	$pdf->SetFont(mydeffont, 'B', 8, '', true);
	$pdf->MultiCell(200, 0, $a.':', 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$cid=gets('token');
$t=mysql_query("SELECT * FROM psb_calonsiswa WHERE replid='$cid' LIMIT 0,1");
if(mysql_num_rows($t)>0){
// Queries:
$r=mysql_fetch_array($t);
$proses=mysql_fetch_array(mysql_query("SELECT * FROM psb_proses WHERE replid='".$r['proses']."' LIMIT 0,1"));
$kelompok=mysql_fetch_array(mysql_query("SELECT * FROM psb_kelompok WHERE replid='".$r['kelompok']."' LIMIT 0,1"));
$departemen=mysql_fetch_array(mysql_query("SELECT * FROM departemen WHERE replid='".$proses['departemen']."' LIMIT 0,1"));
$kondisi=mysql_fetch_array(mysql_query("SELECT * FROM psb_kondisisiswa WHERE replid='".$r['kondisi']."' LIMIT 0,1"));
$status=mysql_fetch_array(mysql_query("SELECT * FROM psb_statussiswa WHERE replid='".$r['status']."' LIMIT 0,1"));
$agama=mysql_fetch_array(mysql_query("SELECT * FROM mst_agama WHERE replid='".$r['agama']."' LIMIT 0,1"));
$kelamin=Array('L'=>'Laki-laki','P'=>'Perempuan'); $a=0;

// add a page
$pdf->AddPage();
page_header();
require_once('header.php');

$pdf->SetFont(mydeffont, '', 12, '', true);
$pdf->MultiCell($dcPageW, 0, 'DATA CALON SISWA BARU', 0, 'C', 0, 1, '', '', true);
dc_YDown(3);

if(mysql_num_rows($t)>0){

head_label('Departemen',$departemen['departemen']);
head_label('Proses Penerimaan',$proses['proses']);
head_label('Kelompok',$kelompok['kelompok']);
head_label('No. Pendaftaan',$r['nopendaftaran']);

dc_Linebar('','',2,5);

group_label('Data Pribadi Siswa');
head_label('Nama',$r['nama']);
head_label('Jenis kelamin',$kelamin[$r['kelamin']]);
head_label('Tempat lahir',$r['tmplahir']);
head_label('Tanggal lahir',fftgl($r['tgllahir']));
head_label('Agama',$agama['agama']);
head_label('Alamat rumah',$r['alamat']);
head_label('Telepon rumah',$r['telpon']);
$pdf->Ln();

if(strlen($r['photo'])>0){
	$cx=$pdf->GetX();
	$cy=$pdf->GetY();
	$pdf->SetX(100);
	$pdf->SetY(30);
	$imgdata=base64_decode(chunk_split($r['photo']));
	$pdf->Image('@'.$imgdata,155,73);
	$pdf->SetX($cx);
	$pdf->SetY($cy);
}

group_label('Keterangan Kesehatan Siswa');
head_label('Golongan darah',$r['darah']);
head_label('Penyakit yang pernah diderita',$r['kesehatan']);
head_label('Alergi terhadap',$r['ketkesehatan']);
$pdf->Ln();

$agama=agama_r(0);
$t=mysql_query("SELECT * FROM psb_calonsiswa_ayah WHERE calonsiswa='$cid'");
$ayah=mysql_fetch_array($t);
$t=mysql_query("SELECT * FROM psb_calonsiswa_ibu WHERE calonsiswa='$cid'");
$ibu=mysql_fetch_array($t);
group_label('Data Orang Tua Siswa');
head_label2x('','  Ayah','Ibu');
head_label2('Nama',$ayah['nama'],$ibu['nama']);
head_label2('Kebangsaan',$ayah['warga'],$ibu['warga']);
head_label2('Tempat Lahir',$ayah['tmplahir'],$r['tmplahiribu']);
head_label2('Tanggal Lahir',fftgl($ayah['tgllahir']),fftgl($ibu['tgllahir']));
head_label2('Pekerjaan',$ayah['pekerjaan'],$ibu['pekerjaan']);
head_label2('Telepon Orangtua',$ayah['telpon'],$ibu['telpon']);
head_label2('PIN BB Orangtua',$ayah['pinbb'],$ibu['pinbb']);
head_label2('Email Orang Tua',$ayah['email'],$ibu['email']);
$pdf->Ln();

$t=mysql_query("SELECT * FROM psb_calonsiswa_keluarga WHERE calonsiswa='$cid'");
$keluarga=mysql_fetch_array($t);
group_label('Data Keluarga Siswa');
head_label('Tanggal perkawinan orang tua',fftgl($keluarga['tglnikah']));
head_label('Nama Kakek',$keluarga['kakek-nama']);
head_label('Tanggal lahir Kakek',fftgl($keluarga['kakek-tgllahir']));
head_label('Nama Nenek',$keluarga['nenek-nama']);
head_label('Tanggal lahir Nenek',fftgl($keluarga['nenek-tgllahir']));
$pdf->Ln();

group_label('Data Saudara Siswa');
for($i=1;$i<=3;$i++){
$t=mysql_query("SELECT * FROM psb_calonsiswa_saudara WHERE calonsiswa='$cid' AND ord='$i'");
$saudara=mysql_fetch_array($t);
head_label('Nama saudara '.$i,$saudara['nama']);
head_label('Tanggal lahir '.$i,fftgl($saudara['tgllahir']));
head_label('Sekolah saudara '.$i,$saudara['sekolah']);
}
$pdf->Ln();

$t=mysql_query("SELECT * FROM psb_calonsiswa_kontakdarurat WHERE calonsiswa='$cid'");
$kontakdarurat=mysql_fetch_array($t);
group_label('Dalam Kondisi Mendesak, orang yang dapat dihubungi (selain orang tua)');
head_label('Nama',$kontakdarurat['nama']);
head_label('Hubungan',$kontakdarurat['hubungan']);
head_label('Nomor yang dapat dihubungi',$kontakdarurat['telpon']);
$pdf->Ln();


} else {
	$pdf->SetFont(mydeffont, '', 8, '', true);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->MultiCell($dcPageW, 0, 'Tidak ada data proses penerimaan calon siswa baru.', 0, 'C', 0, 1, '', '', true);
}
$pdf->lastPage();

// ---------------------------------------------------------
$pdf->Output('PSB Kriteria Calon Siswa.pdf', 'I');
} else echo "Dokumen tidak tersedia!";
?>