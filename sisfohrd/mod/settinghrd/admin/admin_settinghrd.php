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

$admin  ='<h4 class="page-header">Pengaturan HRD</h4>';

######################################
# Edit Setting
######################################
if($_GET['aksi']==""){

$admin .='<ol class="breadcrumb">
  <li><a href="?pilih=settinghrd&mod=yes">Pengaturan</a></li>
</ol>';

if (isset($_POST["submit"])) {
$thr = $_POST["thr"];

$error = '';
if (!$thr)  $error .= "Error: Isi Syarat Lama Kerja memperoleh THR!<br />";

if ($error) {

$admin .='<div class="alert alert-danger">'.$error.'</div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE hrd_setting SET thr='$thr'" );

$admin.='<div class="alert alert-success">Informasi Syarat memperoleh THR telah di updated</div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_setting limit 1" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$thr		= $data['thr'];
}

$admin .='<form class="form-horizontal" method="post" action=""><table class="table table-striped" width="80%">
<tr>
	<td>Setting HRD / Gaji 13</td>
	<td><input type="text" name="thr" size="25" class="form-control" value="'.$thr.'">Syarat lama kerja minimal ( Dalam Hari )</td>
</tr>
<tr>
    <td></td>
	<td><input type="hidden" name="user" value="'.$user.'"><input type="submit" name="submit" value="Simpan" class="btn btn-success"></td>
</tr>
</table></form>';
}
}
echo $admin;
?>