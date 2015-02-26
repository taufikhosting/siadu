<?php

if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}
$style_include[] = '<link rel="stylesheet" media="screen" href="mod/calendar/css/dynCalendar.css" />';
$admin .= '
<script language="javascript" type="text/javascript" src="mod/calendar/js/browserSniffer.js"></script>
<script language="javascript" type="text/javascript" src="mod/calendar/js/dynCalendar.js"></script>';
$tanggal= <<<eof
<script language="JavaScript" type="text/javascript">
    
    /**
    * Example callback function
    */
    /*<![CDATA[*/
    function exampleCallback_ISO3(date, month, year)
    {
        if (String(month).length == 1) {
            month = '0' + month;
        }
    
        if (String(date).length == 1) {
            date = '0' + date;
        }    
        document.forms['posts'].tgl.value = year + '-' + month + '-' + date;
    }
    calendar3 = new dynCalendar('calendar3', 'exampleCallback_ISO3');
    calendar3.setMonthCombo(true);
    calendar3.setYearCombo(true);
/*]]>*/     
</script>
eof;

$JS_SCRIPT= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
global $maxadmindata;

if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;
$normal2 = 'mod/karyawan/images/performa/';
$temp2 = 'mod/karyawan/images/temp/';

$admin  .='<legend>Administrasi Absensi Karyawan</legend>';

$admin .='<ol class="breadcrumb">
<li><a href="?pilih=absensi&amp;mod=yes">Data Karyawan</a></li>

<li><a href="?pilih=absensi&amp;mod=yes&amp;aksi=laporanbulanan">Laporan Bulanan</a></li>
</ol>';

###################################
# List karyawan
###################################
if($_GET['aksi']==""){

$admin .='<legend>Data Karyawan</legend>';
$admin.='
<table id="example"class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th width="10%">NIP</th>
<th>Nama</th>
<th>Jumlah Absensi</th>
<th width="20%">Aksi</th>
</tr>
</thead>';
$admin.='<tbody>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where tipe='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 
$gambar = $data['foto'];
$id = $data['id'];
$nip=$data['nip'];
$nama=$data['nama'];
$query2 = mysql_query ("SELECT count(id) AS total_absensi FROM hrd_absensi where karyawan=$id");
$get2	= mysql_fetch_assoc($query2);
$jumlah2 = $get2['total_absensi'];
if(!$jumlah2){
$jumlah2='0';
}
$admin.='<tr>
<td>'.$nip.'</td>
<td>'.$nama.'</td>';
$admin.="<td>$jumlah2 Bulan</td>";
$admin.='<td><a class="text-info" href="?pilih=absensi&amp;mod=yes&amp;aksi=list_absensi&amp;id='.$data['id'].'"><span class="btn btn-success">List</span></a>
<a class="text-info" href="?pilih=absensi&amp;mod=yes&amp;aksi=add_absensi&amp;id='.$data['id'].'"><span class="btn btn-info">Tambah</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
}

###################################
# Tambah absensi
###################################
if($_GET['aksi']=="add_absensi"){

$id     = int_filter($_GET['id']);

$s = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id");
$datas = $koneksi_db->sql_fetchrow($s);
$nama = $datas['nama'];

$admin .='<h5 class="bg">Tambah Absensi Karyawan dengan nama <strong>'.$nama.'</strong></h5>';

if (isset($_POST['submit'])){
	
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);

include "includes/hft_image.php";
$nip  			= $_POST['nip'];
$masuk  			= $_POST['masuk'];
$lembur  			= $_POST['lembur'];
$sakit  			= $_POST['sakit'];
$alpha  			= $_POST['alpha'];
$telat  			= $_POST['telat'];
$bulan  			= $_POST['bulan'];
$tahun  			= $_POST['tahun'];
$total = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE nip = '".$_POST['nip']."' and id != '".$id."'");
$jumlah = $koneksi_db->sql_numrows( $total );
$total2 = $koneksi_db->sql_query( "SELECT * FROM hrd_absensi WHERE bulan = '".$_POST['bulan']."' and karyawan= '".$id."'");
$jumlah2 = $koneksi_db->sql_numrows( $total2 );

$error = '';
if ($jumlah) $error .= "Error: NIP karyawan $nip sudah ada di dalam database!<br />";
if ($jumlah2) $error .= "Error: Bulan dan Tahun sudah ada di dalam database!<br />";
if (!$nip)  $error .= "Error: NIP wajib diisi!<br />";
if (!$bulan)  $error .= "Error: bulan wajib diisi!<br />";
if (!$tahun)  $error .= "Error: tahun wajib diisi!<br />";
if ($error){
$admin.='<div class="alert alert-danger">'.$error.'</div>';
}else{
$hasil = $koneksi_db->sql_query( "INSERT INTO hrd_absensi (karyawan,masuk,lembur,sakit,alpha,telat,bulan,tahun) VALUES ('$id','$masuk','$lembur','$sakit','$alpha','$telat','$bulan','$tahun')" );
$admin.='<div class="alert alert-success"><strong>Berhasil!</strong> Data  berhasil di Tambah</div>';
}
}

$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id" );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkary  			= $data['id'];
$nip  			= $data['nip'];
$nama     		= text_filter($data['nama']);
$departemen 	= $data['departemen'];
$jabatan		= $data['jabatan'];
$status		= $data['status'];
$fotolama 	= $data['foto'];
$yearnow = date("Y");
$tahun 		= !isset($tahun) ? $yearnow : $tahun;
$admin .= '<form class="form-inline" method="post" action="" enctype ="multipart/form-data" id="posts">
<table class="table table-striped table-hover">
<tr>
	<td>Foto</td>
	<td></td>
</tr>';
if(!$fotolama){
$fotolama='profile-default.jpg';
}
$admin .='<tr>
	<td></td>
	<td><img src="mod/karyawan/images/normal/'.$fotolama.'" height="120">
	<input type="hidden" name="fotolama" value="'.$fotolama.'"></td>
</tr>
<tr>
	<td>NIP</td>
	<td><input type="hidden" name="nip" value="'.$nip.'">'.$nip.'</td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td>
	<input type="hidden" name="nama" value="'.$nama.'">'.$nama.'
	</td>
</tr>
<tr>
	<td>Departemen</td>
	<td><input type="hidden" name="departemen" value="'.$departemen.'">'.getdepartemen($departemen).'</td>
</tr>
<tr>
	<td>Jabatan</td>
	<td><input type="hidden" name="jabatan" value="'.$jabatan.'">'.getjabatan($jabatan).'</td>
</tr>
<tr>
	<td>Status</td>
	<td><input type="hidden" name="status" value="'.$status.'">'.getstatus($status).'</td>
</tr>
<tr>
	<td>Bulan / Tahun</td>
	<td><select name="bulan" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM hrd_bulan ORDER BY id");
$admin .= '<option value="">== Pilih Bulan ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'">'.$datas['bulan'].'</option>';
}
$admin .='</select>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" name="tahun"value="'.$tahun.'" size="25" class="form-control"></td>
</tr>
<tr>
	<td>Masuk</td>
	<td><input type="text" name="masuk" size="25" class="form-control"> Hari</td>
</tr>
<tr>
	<td>Lembur</td>
	<td><input type="text" name="lembur" size="25" class="form-control"> Menit</td>
</tr>
<tr>
	<td>Sakit</td>
	<td><input type="text" name="sakit" size="25" class="form-control"> Hari</td>
</tr>
<tr>
	<td>Alpha</td>
	<td><input type="text" name="alpha" size="25" class="form-control"> Hari</td>
</tr>
<tr>
	<td>Terlambat</td>
	<td><input type="text" name="telat" size="25" class="form-control"> Menit</td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="Simpan" name="submit" class="btn btn-success"></td>
	</tr>
</table></form>';

}

if($_GET['aksi']=="edit"){

$id     = int_filter($_GET['id']);
$idabsen     = int_filter($_GET['idabsen']);
$s = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id");
$datas = $koneksi_db->sql_fetchrow($s);
$nama = $datas['nama'];

$admin .='<h5 class="bg">Edit Absensi Karyawan dengan nama <strong>'.$nama.'</strong></h5>';

if (isset($_POST['submit'])){
	
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);

include "includes/hft_image.php";
$idabsen  			= $_POST['idabsen'];
$idkary  			= $_POST['idkary'];
$masuk  			= $_POST['masuk'];
$lembur  			= $_POST['lembur'];
$sakit  			= $_POST['sakit'];
$alpha  			= $_POST['alpha'];
$telat  			= $_POST['telat'];
//$bulan  			= $_POST['bulan'];
//$tahun  			= $_POST['tahun'];
$error = '';
if ($error){
$admin.='<div class="alert alert-danger">'.$error.'</div>';
}else{
$hasil = $koneksi_db->sql_query( "update hrd_absensi  set masuk='$masuk',lembur='$lembur',sakit='$sakit',alpha='$alpha',telat='$telat' where id='$idabsen'" );

$admin.='<div class="alert alert-success"><strong>Berhasil!</strong> Data  berhasil di Edit</div>';
$style_include[] ='<meta http-equiv="refresh" content="3; url=admin.php?pilih=absensi&mod=yes&aksi=list_absensi&id='.$idkary.'" />';
}
}

$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id" );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkary  			= $data['id'];
$nip  			= $data['nip'];
$nama     		= text_filter($data['nama']);
$departemen 	= $data['departemen'];
$jabatan		= $data['jabatan'];
$status		= $data['status'];
$fotolama 	= $data['foto'];
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM hrd_absensi WHERE id=$idabsen" );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$idgaji  			= $data2['id'];
$nip  			= $data2['nip'];
$bulan  			= $data2['bulan'];
$tahun  			= $data2['tahun'];
$masuk  			= $data2['masuk'];
$lembur  			= $data2['lembur'];
$sakit  			= $data2['sakit'];
$alpha  			= $data2['alpha'];
$telat  			= $data2['telat'];
$admin .= '<form class="form-inline" method="post" action="" enctype ="multipart/form-data" id="posts">
<table class="table table-striped table-hover">
<tr>
	<td>Foto</td>
	<td></td>
</tr>';
if(!$fotolama){
$fotolama='profile-default.jpg';
}
$admin .='<tr>
	<td></td>
	<td><img src="mod/karyawan/images/normal/'.$fotolama.'" height="120">
	<input type="hidden" name="fotolama" value="'.$fotolama.'"></td>
</tr>
<tr>
	<td>NIP</td>
	<td><input type="hidden" name="nip" value="'.$nip.'">'.$nip.'</td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td>
	<input type="hidden" name="nama" value="'.$nama.'">'.$nama.'
	</td>
</tr>
<tr>
	<td>Departemen</td>
	<td><input type="hidden" name="departemen" value="'.$departemen.'">'.getdepartemen($departemen).'</td>
</tr>
<tr>
	<td>Jabatan</td>
	<td><input type="hidden" name="jabatan" value="'.$jabatan.'">'.getjabatan($jabatan).'</td>
</tr>
<tr>
	<td>Status</td>
	<td><input type="hidden" name="status" value="'.$status.'">'.getstatus($status).'</td>
</tr>
<tr>
	<td>Bulan / Tahun</td>
	<td><select name="bulan" class="form-control"  disabled>';
$hasil = $koneksi_db->sql_query("SELECT * FROM hrd_bulan ORDER BY id");
$admin .= '<option value="-">== Pilih Bulan ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){

$pilihan = ($datas['id']==$bulan)?"selected":'';
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['bulan'].'</option>';
}
$admin .='</select>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" disabled name="tahun" size="25" class="form-control" value="'.$tahun.'"></td>
</tr>
<tr>
	<td>Masuk</td>
	<td><input type="text" name="masuk" size="25" class="form-control"value="'.$masuk.'"> Hari</td>
</tr>
<tr>
	<td>Lembur</td>
	<td><input type="text" name="lembur" size="25" class="form-control"value="'.$lembur.'"> Menit</td>
</tr>
<tr>
	<td>Sakit</td>
	<td><input type="text" name="sakit" size="25" class="form-control"value="'.$sakit.'"> Hari</td>
</tr>
<tr>
	<td>Alpha</td>
	<td><input type="text" name="alpha" size="25" class="form-control"value="'.$alpha.'"> Hari</td>
</tr>
<tr>
	<td>Terlambat</td>
	<td><input type="text" name="telat" size="25" class="form-control"value="'.$telat.'"> Menit</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="hidden" name="idabsen" value="'.$idabsen.'">
	<input type="hidden" name="idkary" value="'.$idkary.'">
	<input type="submit" value="Simpan" name="submit" class="btn btn-success"></td>
	</tr>
</table></form>';
}

if($_GET['aksi']=="list_absensi"){

$id     = int_filter($_GET['id']);

$s = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id");
$datas = $koneksi_db->sql_fetchrow($s);
$nama = $datas['nama'];

$admin .='<h5 class="bg">List Absensi <strong>'.$nama.'</strong></h5>';

$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id" );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkary  			= $data['id'];
$nip  			= $data['nip'];
$nama     		= text_filter($data['nama']);
$departemen 	= $data['departemen'];
$jabatan		= $data['jabatan'];
$status		= $data['status'];
$fotolama 	= $data['foto'];

$admin .= '<form class="form-inline" method="post" action="" enctype ="multipart/form-data" id="posts">
<table class="table table-striped table-hover">
<tr>
	<td>Foto</td>
	<td></td>
</tr>';
if(!$fotolama){
$fotolama='profile-default.jpg';
}
$admin .='<tr>
	<td></td>
	<td><img src="mod/karyawan/images/normal/'.$fotolama.'" height="120">
	<input type="hidden" name="fotolama" value="'.$fotolama.'"></td>
</tr>
<tr>
	<td>NIP</td>
	<td><input type="hidden" name="nip" value="'.$nip.'">'.$nip.'</td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td>
	<input type="hidden" name="nama" value="'.$nama.'">'.$nama.'
	</td>
</tr>
<tr>
	<td>Departemen</td>
	<td><input type="hidden" name="departemen" value="'.$departemen.'">'.getdepartemen($departemen).'</td>
</tr>
<tr>
	<td>Jabatan</td>
	<td><input type="hidden" name="jabatan" value="'.$jabatan.'">'.getjabatan($jabatan).'</td>
</tr>
<tr>
	<td>Status</td>
	<td><input type="hidden" name="status" value="'.$status.'">'.getstatus($status).'</td>
</tr>
</table></form>';
$admin .= '</table>';
}

if($_GET['aksi'] =='hapus'){
$idkary = int_filter ($_GET['idkary']);
$id = int_filter ($_GET['id']);
$hapus = mysql_query ("DELETE FROM `hrd_absensi` WHERE `id`='$id'");	
if ($hapus){
$admin .= '<div class="sukses">Absensi Berhasil Dihapus</div>';	
$style_include[] ='<meta http-equiv="refresh" content="3; url=admin.php?pilih=absensi&mod=yes&aksi=add_absensi&id='.$idkary.'" />';
}else {
$admin .= '<div class="error">Absensi Gagal dihapus</div>';	
}
}

if($_GET['aksi']=="laporanbulanan"){
$yearnow = date("Y");
$tahun 		= !isset($tahun) ? $yearnow : $tahun;

$admin .= '<form class="form-inline" method="post" action="" enctype ="multipart/form-data" id="posts">
<table class="table table-striped table-hover">';
$admin .= '<tr>
	<td>Bulan / Tahun</td>
	<td><select name="bulan" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM hrd_bulan ORDER BY id");
$admin .= '<option value="">== Pilih Bulan ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'">'.$datas['bulan'].'</option>';
}
$admin .='</select>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" name="tahun"value="'.$tahun.'" size="25" class="form-control"></td>
</tr>';
$admin .= '<tr>
	<td></td>
	<td><input type="submit" value="Lihat Laporan Bulanan" name="submit" class="btn btn-success"></td>
	</tr>
</table></form>';
$admin .= '</table>';
$admin .= "* Apabila tidak dapat melakukan print, klik kanan pilih open link New Tab";
if (isset($_POST['submit'])){
$bulan  			= $_POST['bulan'];
$tahun  			= $_POST['tahun'];
$pbulan= getbulan($bulan);
$error = '';
if (!$bulan)  $error .= "Error: bulan wajib diisi!<br />";
if (!$tahun)  $error .= "Error: tahun wajib diisi!<br />";
if ($error){
$admin.='<div class="alert alert-danger">'.$error.'</div>';
}else{

$cetaklaporan = '<a href="cetak_labsensi.php?bulan='.$bulan.'&tahun='.$tahun.'" target="new"onclick="return confirm(\'Apakah Anda Ingin Mencetak Absensi Bulanan ?\')" style="color:blue"><span class="btn btn-danger">Cetak Laporan</span></a>';
$admin .='<h5 class="bg"><b>Laporan Absensi, Bulan / Tahun : '.$pbulan.' / '.$tahun.'</b> '.$cetaklaporan.'</h5>';
$admin .= '<table class="table table-striped table-hover">
<thead><tr>
<td class="text-center">No</td>
<td>Nama</td>
<td>Masuk (Hari)</td>
<td>Lembur (Jam)</td>
<td>Sakit (Hari)</td>
<td>Alpha (Hari)</td>
<td>Terlambat(Menit)</td>
</tr></thead><tbody>';
$no =1;
$s = mysql_query ("SELECT * FROM `hrd_absensi`where bulan='$bulan' and tahun='$tahun'");	
while($datas = mysql_fetch_array($s)){
$idphoto = $datas['id'];
$idkary = $datas['karyawan'];
$masuk 	= $datas['masuk'];
$lembur = $datas['lembur'];
$sakit = $datas['sakit'];
$alpha = $datas['alpha'];
$telat  = $datas['telat'];
$urutan = $no + 1;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
$admin .= '
<tr align="left">
<td class="text-center">'.$no.'</td>
<td>'.$nama.'</td>
<td>'.$masuk.'</td>
<td>'.$lembur.'</td>
<td>'.$sakit.'</td>
<td>'.$alpha.'</td>
<td>'.$telat.'</td>
</tr>';
$no++;
}
$admin .= '</table>';
}
}
}

if(($_GET['aksi']=="list_absensi")or($_GET['aksi']=="edit")or($_GET['aksi']=="add_absensi")){
$admin .='<a class="text-info" href="?pilih=absensi&amp;mod=yes&amp;aksi=add_absensi&amp;id='.$data['id'].'"><span class="btn btn-info">Tambah Absensi</span></a>';
$admin .='<legend>Daftar History Karyawan</legend>';
$admin.='
<table id="example"class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>Tahun</th>
<th>Bulan</th>
<th>Masuk</th>
<th>Lembur</th>
<th>Sakit</th>
<th>Alpha</th>
<th>Terlambat</th>
<th>Aksi</th>
</tr>
</thead>';
$admin.='<tbody>';
$s = mysql_query ("SELECT * FROM `hrd_absensi`where karyawan='$id' order by tahun,bulan desc");	
while($datas = mysql_fetch_array($s)){
$idphoto = $datas['id'];
$masuk = $datas['masuk'];
$lembur = $datas['lembur'];
$sakit = $datas['sakit'];
$alpha = $datas['alpha'];
$telat = $datas['telat'];
$bulan = $datas['bulan'];
$tahun = $datas['tahun'];
$urutan = $no + 1;
$edit = '<a href="admin.php?pilih=absensi&mod=yes&aksi=edit&id='.$idkary.'&idabsen='.$idphoto.'"onclick="return confirm(\'Apakah Anda Ingin Mengedit Absensi Ini ?\')" style="color:blue"><span class="btn btn-warning">Edit</span></a>';
$deleted = '<a href="admin.php?pilih=absensi&mod=yes&aksi=hapus&id='.$idphoto.'&idkary='.$idkary.'" onclick="return confirm(\'Apakah Anda Ingin Menghapus Absensi Ini ?\')" style="color:red"><span class="btn btn-danger">Delete</span></a>';

$admin .= '
<tr align="left">
<td>
'.$tahun.'
</td>
<td>
'.getbulan($bulan).'
</td>
<td>
'.$masuk.'
</td>
<td>
'.$lembur.'
</td>
<td>
'.$sakit.'
</td>
<td>
'.$alpha.'
</td>
<td>
'.$telat.'
</td>
<td>
'.$deleted.' '.$edit.'
</td></tr>';
}
$admin .= '</table>';
}
echo $admin;

?>