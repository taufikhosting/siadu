<?php

include 'includes/config.php';
include 'includes/mysql.php';
$idkary = int_filter($_GET['idkary']);
global $koneksi_db,$translateKal,$url_situs;

echo '<link rel="stylesheet" href="themes/administrator/css/print.css" type="text/css">';
//echo '<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.css" type="text/css">';
$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$idkary" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nip  			= $data['nip'];
$nama     		= text_filter($data['nama']);
$kotalahir  	= $data['kotalahir'];
$tgllahir  		= $data['tgllahir'];
$kelamin		= $data['kelamin'];
$agama			= $data['agama'];
$menikah		= $data['menikah'];
$alamat  		= $data['alamat'];
$kota  			= $data['kota'];
$kodepos  			= $data['kodepos'];
$propinsi 		= $data['propinsi'];
$negara 		= $data['negara'];
$telepon 		= $data['telepon'];
$handphone 		= $data['handphone'];
$departemen 	= $data['departemen'];
$jabatan		= $data['jabatan'];
$status		= $data['status'];
$pendidikan_terakhir = $data['pendidikan_terakhir'];
$fotolama 	= $data['foto'];
$tglmelamar = $data['tglmelamar'];
$tglditerima = $data['tglditerima'];
$tglpercobaan = $data['tglpercobaan'];
$tglkontrak = $data['tglkontrak'];
$tglresign = $data['tglresign'];
$golongan = $data['golongan'];

echo '<style type="text/css">
.border {
	background-color: transparent;
	border			: 1px solid black;
	padding			: 5px;
    margin			: 5px 0 5px 0;
}
	th,td {
    padding: 5px;
	}
.borderbawah {
border-bottom:1px solid black;
	padding			: 2px;
    margin			: 2px 0 5px 0;
}
</style>';

echo "<html><head><title>Cetak Karyawan $nama</title></head><body>";

$logoslip="<img src='images/logoslip.png'>";
echo'<div align="left" class="borderbawah">'.$logoslip.'</div>';
echo'<h3>CETAK DATA CALON KARYAWAN / KARYAWAN</h3>';

echo '<table class="border">
<tr><td>
<table>';
echo'<tr>
	<td>NIP</td>
	<td>: '.$nip.'</td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td>: '.$nama.'</td>
</tr>
<tr>
	<td>Kota Lahir</td>
	<td>: '.$kotalahir.'</td>
</tr>
<tr>
	<td>Tanggal Lahir</td>
	<td>: '.datetimes($tgllahir,False,false).'</td>
</tr>
<tr>
	<td>Jenis Kelamin</td>
	<td>: '.getkelamin($kelamin).'</td>
</tr>
<tr>
	<td>Agama</td>
	<td>: '.getagama($agama).'</td>
</tr>
<tr>
	<td>Menikah</td>
	<td>: '.getmenikah($menikah).'</td>
</tr>
<tr>
	<td>Alamat Lengkap</td>
	<td>: '.$alamat.'</td>
</tr>
<tr>
	<td>Kota</td>
	<td>: '.$kota.'</td>
</tr>
<tr>
	<td>Kode Pos</td>
	<td>: '.$kodepos.'</td>
</tr>
<tr>
	<td>Propinsi</td>
	<td>: '.$propinsi.'</td>
</tr>
<tr>
	<td>Negara</td>
	<td>: '.$negara.'</td>
</tr>
<tr>
	<td>Telepon</td>
	<td>: '.$telepon.'</td>
</tr>
<tr>
	<td>Handphone</td>
	<td>: '.$handphone.'</td>
</tr>
<tr>
	<td>Pendidikan Terakhir</td>
	<td>: '.getpendidikan($pendidikan_terakhir).'</td>
</tr>';
if($departemen){
echo'<tr>
	<td>Departemen</td>
	<td>: '.getdepartemen($departemen).'</td>
</tr>';}
if($jabatan){
echo'
<tr>
	<td>Jabatan</td>
	<td>: '.getjabatan($jabatan).'</td>
</tr>';}
if($status){
echo'
<tr>
	<td>Status</td>
	<td>: '.getstatus($status).'</td>
</tr>';}
if($tglmelamar !=  '0000-00-00'){
echo'
<tr>
	<td>Tanggal Melamar</td>
	<td>: '.datetimes($tglmelamar,False,false).'</td>
</tr>';}
if($tglditerima !=  '0000-00-00'){
echo'
<tr>
	<td>Tanggal Diterima</td>
	<td>: '.datetimes($tglditerima,False,false).'</td>
</tr>';}
if($tglpercobaan !=  '0000-00-00'){
echo'
<tr>
	<td>Tanggal Akhir Percobaan</td>
	<td>: '.datetimes($tglpercobaan,False,false).'</td>
</tr>';}
if($tglkontrak !=  '0000-00-00'){
echo'
<tr>
	<td>Tanggal Akhir Kontrak</td>
	<td>: '.datetimes($tglkontrak,False,false).'</td>
</tr>';}
if($tglresign !=  '0000-00-00'){
echo'<tr>
	<td>Tanggal Resign</td>
	<td>: '.datetimes($tglresign,False,false).'</td>
</tr>
<tr>
	<td>Alasan</td>
	<td>: '.$alasan.'</td>
</tr>';}
echo'
</table></td><td valign="top">
<table><tr>
	<td width="30%"></td>
	<td><img src="mod/karyawan/images/normal/'.$fotolama.'" height="120" class="img-polaroid"></td>
</tr></table>
</td></tr></table>';
echo "</body</html>";

if (isset($_GET['idkary'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
