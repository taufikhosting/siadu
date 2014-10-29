<?php

if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

if (!cek_login ()){
   $admin .='<h5 class="bg text-success">Access Denied !!!!!!</h5>';
}else{

global $koneksi_db,$PHP_SELF,$theme,$error,$url_situs;

$username = $_SESSION['UserName'];

$admin  ='<h4 class="page-header">Pengaturan</h4>';

######################################
# Edit Password Admin
######################################
if($_GET['aksi']==""){

$admin .='<ul class="nav nav-tabs">
<li class="active"><a href="?pilih=admin_info">Password</a></li>
<li><a href="?pilih=admin_info&aksi=profil_setting">Profil</a></li>
<li><a href="?pilih=admin_info&aksi=web_setting">Website</a></li>
<li><a href="?pilih=admin_info&aksi=widget_setting">Widget</a></li>
<li><a href="?pilih=admin_info&aksi=favicon">Favicon</a></li>
</ul><br>';

$admin .='<ol class="breadcrumb">
  <li><a href="?pilih=admin_info">Pengaturan</a></li>
  <li class="active">Password</li>
</ol>';

if (isset($_POST["submit"])) {

$user		   = text_filter($_POST['user']);
$email	      = text_filter($_POST['email']);
$password0 = md5($_POST["password0"]);
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

$hasil = $koneksi_db->sql_query( "SELECT password,email FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$password=$data['password'];
	$email0=$data['email'];
	}
$error = '';
if (!$password0)  $error .= "Error: Please enter your Old Password!<br />";
if (!$password1)  $error .= "Error: Please enter new password!<br />";
if (!$password2)  $error .= "Error: Please retype your your new password!<br />";
checkemail($email);
if ($password0 != $password)  $error .= "Invalid old pasword, silahkan ulangi lagi.<br />";
if ($password1 != $password2)   $error .= "New password dan retype berbeda, silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email' and user!='$user'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";

if ($error) {

$admin .='<div class="alert alert-danger">'.$error.'</div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET user='$user', email='$email', password='$password3' WHERE user='$user'" );

$admin.='<div class="alert alert-success">Infromasi Admin telah di updated</div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id		= $data[0];
$user	= $data[1];
$email	= $data[3];
}

$admin .='<form class="form-horizontal" method="post" action=""><table class="table table-striped">
<tr>
	<td>Username</td>
	<td><input type="text" value="'.$user.'" size="80" class="form-control" disabled></td>
</tr>
<tr>
    <td>Email</td>
	<td><input type="text" name="email" value="'.$email.'" size="80" class="form-control"></td>
</tr>
<tr>
    <td>Password Lama</td>
	<td><input type="password" name="password0" size="80" class="form-control"></td>
</tr>
<tr>
    <td>Password Baru</td>
	<td><input type="password" name="password1" size="80" class="form-control"></td>
</tr>
<tr>
    <td>Ulangi Password Baru</td>
	<td><input type="password" name="password2" size="80" class="form-control"></td>
</tr>
<tr>
    <td></td>
	<td><input type="hidden" name="user" value="'.$user.'"><input type="submit" name="submit" value="Simpan" class="btn btn-success"></td>
</tr>
</table></form>';
}

######################################
# Profil Setting
######################################
if($_GET['aksi']=="profil_setting"){

$admin .='<ul class="nav nav-tabs">
<li><a href="?pilih=admin_info">Password</a></li>
<li class="active"><a href="?pilih=admin_info&aksi=profil_setting">Profil</a></li>
<li><a href="?pilih=admin_info&aksi=web_setting">Website</a></li>
<li><a href="?pilih=admin_info&aksi=widget_setting">Widget</a></li>
<li><a href="?pilih=admin_info&aksi=favicon">Favicon</a></li>
</ul><br>';

$admin .='<ol class="breadcrumb">
  <li><a href="?pilih=admin_info">Pengaturan</a></li>
  <li class="active">Profil</li>
</ol>';

if (isset($_POST["submit"])) {

define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";
	$id=$_POST['id'];
//	$user=$_POST['user'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$telepon=$_POST['telepon'];
//	$email=$_POST['email'];
	$web=$_POST['web'];
	$ym=$_POST['ym'];
//	$avatar=$_POST['avatar'];
	$namafile_name 	= $_FILES['gambar']['name'];
$error = '';
if ($error) {
$admin .='<div class="alert alert-danger">'.$error.'</div>';
} else {
if (!empty ($namafile_name)){
$files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $namagambar = md5 (rand(1,100).$files) .'.jpg';
    $tempnews 	= 'mod/profile/temp/';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	
$tnews 		= 'mod/profile/images/';
$small 	= $tnews . $namagambar;

create_thumbnail ($uploaddir, $small, $new_width = 100, $new_height = 'auto', $quality = 100);
unlink($uploaddir);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET nama='$nama', alamat='$alamat', telepon='$telepon', web='$web', ym='$ym', avatar='$namagambar' WHERE UserId='$id'" );

$admin.='<div class="alert alert-success">Profil telah di updated</div>';
}else{
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET nama='$nama', alamat='$alamat', telepon='$telepon', web='$web', ym='$ym' WHERE UserId='$id'" );

$admin.='<div class="alert alert-success">Profil telah di updated</div>';
}
}
}

$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$username'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id			= $data['id'];
$user		= $data['user'];
$nama		= $data['nama'];
$alamat		= $data['alamat'];
$telepon	= $data['telepon'];
$email		= $data['email'];
$web		= $data['web'];
$ym			= $data['ym'];
$gambarlama	= $data['avatar'];
}

$admin .='<form class="form-horizontal" method="post" action=""enctype ="multipart/form-data"><table class="table table-striped">
<tr>
	<td>Nama Lengkap</td>
	<td><input type="text" size="40" name="nama" value="'.$nama.'" class="form-control"></td>
</tr>
<tr>
	<td>Alamat</td>
	<td><input type="text" size="40" name="alamat" value="'.$alamat.'" class="form-control"></td>
</tr>
<tr>
	<td>Telepon</td>
	<td><input type="text" size="40" name="telepon" value="'.$telepon.'" class="form-control"></td>
</tr>
<tr>
	<td>Email</td>
	<td>'.$email.'</td>
</tr>
<tr>
	<td>Yahoo Messenger</td>
	<td><input type="text" size="40" name="ym" value="'.$ym.'" class="form-control"></td>
</tr>
<tr>
	<td>Avatar</td>
	<td><input type="file" name="gambar"><input type="hidden" name="gambarlama" size="40" value="'.$gambarlama.'"></td>
</tr>
<tr>
	<td></td>
	<td><img src="mod/profile/images/'.$gambarlama.'"></td>
</tr>
<tr>
	<td></td>
	<td><input type="hidden" name="id" value="'.$id.'"><input type="submit" name="submit" value="Simpan" class="btn btn-success"></td>
</tr>
</table></form>';
}

######################################
# Web Setting
######################################
if($_GET['aksi']=="web_setting"){

$admin .='<ul class="nav nav-tabs">
<li><a href="?pilih=admin_info">Password</a></li>
<li><a href="?pilih=admin_info&aksi=profil_setting">Profil</a></li>
<li class="active"><a href="?pilih=admin_info&aksi=web_setting">Website</a></li>
<li><a href="?pilih=admin_info&aksi=widget_setting">Widget</a></li>
<li><a href="?pilih=admin_info&aksi=favicon">Favicon</a></li>
</ul><br>';

$admin .='<ol class="breadcrumb">
	<li><a href="?pilih=admin_info">Home</a></li>
	<li><a href="?pilih=admin_info">Setting</a></li>
	<li class="active">Edit Web Setting</li>
</ol>';

if (isset($_POST["submit"])) {
$publishwebsite 	= $_POST['publishwebsite'];
$judul_situs 	= $_POST['judul_situs'];
$url_situs 		= $_POST['url_situs'];
$slogan 		= $_POST['slogan'];
$email_master 	= $_POST['email_master'];
$description 	= $_POST['description'];
$keywords 		= $_POST['keywords'];
$alamatkantor 	= $_POST['alamatkantor'];
$error = '';
if (!$judul_situs)  $error .= "Error: Judul Situs tidak boleh kosong!<br />";
if (!$url_situs)  $error .= "Error: URL Situs tidak boleh kosong!<br />";
if (!$slogan)  $error .= "Error: Slogan Situs tidak boleh kosong!<br />";
if (!$email_master)  $error .= "Error: Email Master Situs tidak boleh kosong!<br />";
if (!$description)  $error .= "Error: Description Situs tidak boleh kosong!<br />";
if (!$keywords)  $error .= "Error: Keyword Situs tidak boleh kosong!<br />";
if ($error) {

$admin .='<div class="alert alert-danger">'.$error.'</div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE situs SET publishwebsite='$publishwebsite', judul_situs='$judul_situs', url_situs='$url_situs', slogan='$slogan', email_master='$email_master', description='$description', keywords='$keywords', alamatkantor='$alamatkantor' WHERE id='1'" );

$admin.='<div class="alert alert-success">Informasi Situs telah di updated</div>';
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id				= $data['id'];
$judul_situs	= $data['judul_situs'];
$url_situs		= $data['url_situs'];
$slogan			= $data['slogan'];
$email_master	= $data['email_master'];
$description	= $data['description'];
$keywords		= $data['keywords'];
$alamatkantor	= $data['alamatkantor'];
$publishwebsite	= $data['publishwebsite'];
}

$admin .='<form class="form-horizontal" method="post" action=""><table class="table table-striped">
<tr>
	<td>Status Website</td>
	<td><select name="publishwebsite" class="form-control">';
if ($publishwebsite==1){
$admin .= '<option value="1" selected>Aktif</option>';
$admin .= '<option value="0">Tidak Aktif</option>';
}else{
$admin .= '<option value="1">Aktif</option>';
$admin .= '<option value="0" selected>Tidak Aktif</option>';
}
$admin .='</select></td>
</tr>
<tr>
	<td>Judul Website</td>
	<td><input type="text" size="80" name="judul_situs" value="'.$judul_situs.'" class="form-control"></td>
</tr>
<tr>
	<td>Url Website</td>
	<td><input type="text" size="80" name="url_situs" value="'.$url_situs.'" class="form-control"></td>
</tr>
<tr>
	<td>Slogan</td>
	<td><input type="text" size="80" name="slogan" value="'.$slogan.'" class="form-control"></td>
</tr>
<tr>
	<td>Email Master</td>
	<td><input type="text" size="80" name="email_master" value="'.$email_master.'" class="form-control"></td>
</tr>
<tr>
	<td>Deskripsi [META]</td>
	<td><input type="text" name="description" value="'.$description.'" class="form-control"></td>
</tr>
<tr>
	<td>Keywords - Tags [META]</td>
	<td><textarea name="keywords" rows="3" class="form-control">'.$keywords.'</textarea></td>
</tr>
<tr>
	<td>Alamat Kantor</td>
	<td><textarea name="alamatkantor" rows="15" class="form-control">'.$alamatkantor.'</textarea></td>
</tr>		
<tr>
	<td></td>
	<td><input type="hidden" name="id" value="'.$id.'"><input type="submit" name="submit" value="Simpan" class="btn btn-success"></td>
</tr>
</table></form>';
}

######################################
# Widget Setting
######################################
if($_GET['aksi']=="widget_setting"){

$admin .='<ul class="nav nav-tabs">
<li><a href="?pilih=admin_info">Password</a></li>
<li><a href="?pilih=admin_info&aksi=profil_setting">Profil</a></li>
<li><a href="?pilih=admin_info&aksi=web_setting">Website</a></li>
<li class="active"><a href="?pilih=admin_info&aksi=widget_setting">Widget</a></li>
<li><a href="?pilih=admin_info&aksi=favicon">Favicon</a></li>
</ul><br>';

$admin .='<ol class="breadcrumb">
  <li><a href="?pilih=admin_info">Pengaturan</a></li>
  <li class="active">Widget</li>
</ol>';

if (isset($_POST["submit"])) {
$widgetpage = $_POST["widgetpage"];
$widgetnews = $_POST["widgetnews"];
$error = '';
if (!$widgetpage)  $error .= "Error: widgetpage tidak boleh kosong!<br />";
if (!$widgetnews)  $error .= "Error: widgetnews tidak boleh kosong!<br />";

if ($error) {
$admin .='<div class="alert alert-danger">'.$error.'</div>';
} else {
$hasil = $koneksi_db->sql_query( "UPDATE situs SET widgetpage='$widgetpage', widgetnews='$widgetnews'WHERE id='1'" );

$admin.='<div class="alert alert-success">Publikasi telah di updated</div>';
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$id			= $data['id'];
$widgetpage	= $data['widgetpage'];
$widgetnews	= $data['widgetnews'];
}

$admin .='<form class="form-horizontal" method="post" action=""><table class="table table-striped">
<tr>
	<td>Widget Halaman</td>
	<td><select name="widgetpage" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM `widget` ORDER BY id");
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$id = $datas['id'];
$widget = $datas['widget'];
$pilihan = ($datas[0]==$widgetpage)?"selected":'';
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['widget'].'</option>';
}
$admin .='</select></td>
</tr>
<tr>
	<td>Widget Berita</td>
	<td><select name="widgetnews" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM `widget` ORDER BY id");
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$id = $datas['id'];
$widget = $datas['widget'];
$code = $datas['code'];

$pilihan = ($datas['id']==$widgetnews)?"selected":'';
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['widget'].'</option>';
}
$admin .='</select></td>
</tr>
<tr>
	<td></td>
	<td><input type="hidden" name="id" value="'.$id.'"><input type="submit" name="submit" value="Update" class="btn btn-success"></td>
</tr>
</table></form>';

$hasilx = $koneksi_db->sql_query("SELECT * FROM `widget` where id!=1");
while ($datax =  $koneksi_db->sql_fetchrow ($hasilx)){
$id = $datax['id'];
$widget = $datax['widget'];
$code = $datax['code'];
$admin .='<h5 class="bg">'.$datax['widget'].'</h5>
<div class="border">'.$datax['code'].'</div>';
}
}

######################################
# Favicon
######################################
if($_GET['aksi']=="favicon"){

$admin .='<ul class="nav nav-tabs">
<li><a href="?pilih=admin_info">Password</a></li>
<li><a href="?pilih=admin_info&aksi=profil_setting">Profil</a></li>
<li><a href="?pilih=admin_info&aksi=web_setting">Website</a></li>
<li><a href="?pilih=admin_info&aksi=widget_setting">Widget</a></li>
<li class="active"><a href="?pilih=admin_info&aksi=favicon">Favicon</a></li>
</ul><br>';

$admin .='<ol class="breadcrumb">
  <li><a href="?pilih=admin_info">Pengaturan</a></li>
  <li class="active">Favicon</li>
</ol>';

if (isset($_POST['submit'])){

define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);

include "includes/hft_image.php";

$namafile_name 	= $_FILES['gambar']['name'];
if (!empty ($namafile_name)){
    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= ''.$url_situs.'/';
    $namagambar = 'favicon.png';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$gnews 		= '';
	$nsmall = $gnews . $namagambar;
	create_thumbnail ($uploaddir, $nsmall, $new_width = 100, $new_height = 100, $quality = 100);
	
$admin.='<div class="alert alert-success">Berhasil update favicon</div>';
$style_include[] ='<meta http-equiv="refresh" content="1; url=?pilih=admin_info&aksi=favicon" />';
}
}
$admin .= '<form class="form-horizontal" method="post" action="" enctype ="multipart/form-data" id="posts"><table class="table table-striped">
<tr>
	<td>Favicon</td>
	<td><input type="file" name="gambar" size="80"><p class="help-block">Upload Favicon dengan Extensi .PNG</p></td>
</tr>
<tr>
	<td>Preview</td>
	<td><img src="'.$url_situs.'/favicon.png" alt="favicon" style="padding:3px; border:1px solid #dddddd;"></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="Simpan" name="submit" class="btn btn-success"></td>
</tr>
</table></form>';
}

}
echo $admin;
?>