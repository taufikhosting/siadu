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
$normal2 = 'mod/karyawan/images/history/';
$temp2 = 'mod/karyawan/images/temp/';

$admin  .='<legend>Administrasi Cuti Karyawan</legend>';

$admin .='<ol class="breadcrumb">
<li><a href="?pilih=cuti&amp;mod=yes">Data Karyawan</a></li>
</ol>';

###################################
# List karyawan
###################################
if($_GET['aksi']==""){

$admin .='<h5 class="bg"><b>Data Karyawan</b></h5>';

$admin.='
<table id="example"class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th width="10%">NIP</th>
<th>Nama</th>
<th>Jumlah Cuti</th>
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
$jatahcuti = $data['jatahcuti'];
$query2 = mysql_query ("SELECT count(id) AS total_cuti FROM hrd_cuti where karyawan=$id");
$get2	= mysql_fetch_assoc($query2);
$jumlah2 = $get2['total_cuti'];
if(!$jumlah2){
$jumlah2='0';
}
$admin.='<tr>
<td>'.$nip.'</td>
<td>'.$nama.'</td>';
$admin.="<td>$jumlah2 / $jatahcuti </td>";
$admin.='</td>
<td><a class="text-info" href="?pilih=cuti&amp;mod=yes&amp;aksi=list_cuti&amp;id='.$data['id'].'"><span class="btn btn-success">List</span></a>  
<a class="text-info" href="?pilih=cuti&amp;mod=yes&amp;aksi=add_cuti&amp;id='.$data['id'].'"><span class="btn btn-info">Tambah</span></a></td>
</tr>';
}
$admin .= '</tbody></table>';
}

###################################
# Tambah cuti
###################################
if($_GET['aksi']=="add_cuti"){

$id     = int_filter($_GET['id']);

$s = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id");
$datas = $koneksi_db->sql_fetchrow($s);
$nama = $datas['nama'];

$admin .='<h5 class="bg">Tambah Cuti Karyawan dengan nama <strong>'.$nama.'</strong></h5>';

if (isset($_POST['submit'])){
	define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);

include "includes/hft_image.php";
$nip  			= $_POST['nip'];
$tgl  			= $_POST['tgl'];
$cuti  			= $_POST['cuti'];
$jatahcuti  			= $_POST['jatahcuti'];
$tahun = substr($tgl,0,4);
$total = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE nip = '".$_POST['nip']."' and id != '".$id."'");
$jumlah = $koneksi_db->sql_numrows( $total );
$total = $koneksi_db->sql_query( "SELECT * FROM hrd_cuti where karyawan = '".$id."' and tahun = '$tahun'");
$jmlcuti = $koneksi_db->sql_numrows( $total );
//$jmlcuti=getcuti($id);
$sisacuti = $jatahcuti - $jmlcuti;
$error = '';
if ($jumlah) $error .= "Error: NIP karyawan $nip sudah ada di dalam database!<br />";
if (!$nip)  $error .= "Error: NIP wajib diisi!<br />";
if (!$tgl)  $error .= "Error: tanggal wajib diisi!<br />";
if (!$cuti)  $error .= "Error: Cuti wajib diisi!<br />";
if (($sisacuti<=0)or($jatahcuti==0))  $error .= "Error: Cuti sudah mencapai Batas, atau tidak diperbolehkan mengambil Cuti <br /> cuti anda : $jmlcuti , Batas Maksimal Cuti : $jatahcuti";
if ($error){
$admin.='<div class="alert alert-danger">'.$error.'</div>';
}else{
$hasil = $koneksi_db->sql_query( "INSERT INTO hrd_cuti (karyawan,tahun,tgl,cuti) VALUES ('$id','$tahun','$tgl','$cuti')" );
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
$jatahcuti 	= $data['jatahcuti'];
$tglnow = date("Y-m-d");
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
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
	<td>Tanggal</td>
	<td><input type="text" name="tgl" size="75" class="form-control"value="'.$tgl.'">'.$tanggal.'</td>
</tr>
<tr>
	<td>Keterangan</td>
	<td><input type="text" name="cuti" size="75" class="form-control"></td>
</tr>
<tr>
	<td></td><input type="hidden" name="jatahcuti" value="'.$jatahcuti.'">
	<td><input type="submit" value="Simpan" name="submit" class="btn btn-success"></td>
	</tr>
</table></form>';
}

if($_GET['aksi']=="list_cuti"){

$id     = int_filter($_GET['id']);

$s = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id=$id");
$datas = $koneksi_db->sql_fetchrow($s);
$nama = $datas['nama'];

$admin .='<h5 class="bg">List Cuti <strong>'.$nama.'</strong></h5>';

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
}

if($_GET['aksi'] =='hapus_photo'){
$idkary = int_filter ($_GET['idkary']);
$id = int_filter ($_GET['id']);
$hapus = mysql_query ("DELETE FROM `hrd_cuti` WHERE `id`='$id'");	
if ($hapus){
$admin .= '<div class="sukses">Berhasil Dihapus</div>';	
$style_include[] ='<meta http-equiv="refresh" content="3; url=admin.php?pilih=cuti&mod=yes&aksi=add_cuti&id='.$idkary.'" />';
}else {
$admin .= '<div class="error">Gagal dihapus</div>';	
}
}

if(($_GET['aksi'] =='list_cuti')or($_GET['aksi'] =='add_cuti')){
$admin .='<a class="text-info" href="?pilih=cuti&amp;mod=yes&amp;aksi=add_cuti&amp;id='.$data['id'].'"><span class="btn btn-info">Tambah Cuti</span></a>';
$admin .='<legend>Daftar Cuti Karyawan</legend>';
$admin.='
<table id="example"class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Aksi</th>
</tr>
</thead>';
$admin.='<tbody>';
$s = mysql_query ("SELECT * FROM `hrd_cuti`where karyawan='$id' order by tgl desc");	
while($datas = mysql_fetch_array($s)){
$idphoto = $datas['id'];
$tgl = $datas['tgl'];
$cuti = $datas['cuti'];
$urutan = $no + 1;
$deleted = '<a href="admin.php?pilih=cuti&mod=yes&aksi=hapus_photo&id='.$idphoto.'&idkary='.$idkary.'" onclick="return confirm(\'Apakah Anda Ingin Menghapus Cuti Ini ?\')" style="color:red"><span class="btn btn-danger">Hapus</span></a>';
$admin .= '
<tr align="left">
<td>
'.datetimes($tgl,False,false).'
</td>
<td>
'.$cuti.'
</td>
<td>
'.$deleted.'
</td></tr>';
}
$admin .= '</table>';
}

echo $admin;

?>