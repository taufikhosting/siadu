<?php

if (!defined('AURACMS_admin')) {
    Header("Location: ../index.php");
    exit;
}

if (!cek_login()){
    header("location: index.php");
    exit;
} else{

	
//$index_hal=1;	
global $maxadmindata;
	
	
$admin ='<legend>Manage Users</legend>';
$admin .= '
<a class="btn btn-success" href="admin.php?pilih=user&amp;mod=yes&amp;aksi=tambah_user">Tambah User</a>';

$admin .= '<script type="text/javascript" language="javascript">
   function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
</script>';

if ($_GET['aksi'] == 'hapus' && is_numeric($_GET['id'])){
	$id = int_filter ($_GET['id']);
$s = mysql_query ("SELECT * FROM `useraura` WHERE `UserId`='$id'");	
$data = mysql_fetch_array($s);
$user = $data['user'];	
$hapus = mysql_query ("DELETE FROM `useraura` WHERE `UserId`='$id' AND `user`!='admin'");	
if ($hapus){
$admin.='<div class="sukses">Data Berhasil Dihapus Dengan ID = '.$id.'</div>';	
}else {
$admin.='<div class="error">Data Gagal dihapus Dengan ID = '.$id.'</div>';	
}	
}

if (isset ($_POST['edit_users']) && is_numeric($_GET['id'])){
	$id = int_filter ($_GET['id']);
	$level = $_POST['level'];
	$tipe = $_POST['tipe'];
	$email	      = text_filter($_POST['email']);
if (!is_valid_email($email)) $error .= "Error, E-Mail address invalid!<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email' and UserId!='$id'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";
if ($error) {
$admin.='<div class="error">'.$error.'</div>';
} else {
$up = mysql_query ("UPDATE `useraura` SET `level`='$level',`tipe`='$tipe',`email`='$email' WHERE `UserId`='$id' AND `user`!='admin'");	
$admin.='<div class="sukses">Data Berhasil Diupdate Dengan ID = '.$id.'</div>';	
}
}

######################################
# Tambah User
######################################
if ($_GET['aksi'] == 'tambah_user'){
	
if (isset($_POST['add_users'])){
	
$user = cleantext($_POST['user']);	
$level = cleantext($_POST['level']);	
$tipe = cleantext($_POST['tipe']);
$password = cleantext($_POST['password']);
$email = cleantext($_POST['email']);

if (empty($_POST['user']))  $error .= "Error: Formulir user belum diisi , silahkan ulangi.<br />";
if (empty($_POST['email']))  $error .= "Error: Formulir email belum diisi , silahkan ulangi.<br />";
if (empty($_POST['password']))  $error .= "Error: Formulir Password belum diisi , silahkan ulangi.<br />";
if (!$user || preg_match("/[^a-zA-Z0-9_-]/", $user)) $error .= "Error: Karakter Username tidak diizinkan kecuali a-z,A-Z,0-9,-, dan _<br />";
if (strlen($user) > 20) $error .= "Username Terlalu Panjang Maksimal 20 Karakter<br />";
if (strrpos($user, " ") > 0) $error .= "Username Tidak Boleh Menggunakan Spasi";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT user FROM useraura WHERE user='$user'")) > 0) $error .= "Error: Username ".$user." sudah terdaftar , silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT nim FROM akd_mahasiswa WHERE nim='$user'")) > 0) $error .= "Error: NIM ".$user." sudah terdaftar , silahkan ulangi.<br />";
if (!is_valid_email($email)) $error .= "Error: E-Mail address invalid!<br />";
if ($error){
        $admin.='<div class="error">'.$error.'</div>';
}else{
$query = mysql_query ("INSERT INTO `useraura` (`user`,`password`,`level`,`tipe`,`email`) VALUES ('$user',md5('$password'),'$level','$tipe','$email')");	
if ($level=='Mahasiswa'){
$query2 = mysql_query ("INSERT INTO `akd_mahasiswa` (`nim`,`email`) VALUES ('$user','$email')");	
}
if ($level=='Dosen'){
$query2 = mysql_query ("INSERT INTO `akd_dosen` (`nip`,`email`) VALUES ('$user','$email')");	
}
$admin .= '<div class="sukses">Data : '.$user.',Berhasil Di add</div>';
}
}	

$ss = mysql_query ("SHOW FIELDS FROM useraura");
while ($as = mysql_fetch_array ($ss)){
$arrs = $as['Type'];
if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'level') break;
}

if (isset ($_GET['offset']) && isset ($_GET['pg']) && isset ($_GET['stg'])) {
$qss = "&pg=$pg&stg=$stg&offset=$offset";
}	
$admin.='<h5 class="bg text-success">Tambah User</h5>';
$admin.='<div class="border">';
$admin.='<form method="post" action="#">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="width:75px; padding:5px;">Username</td>
    <td style="width:10px; padding:5px;">:</td>
    <td style="padding:5px;"><input type="text" name="user" size="20" class="form-control"></td>
  </tr> 
  <tr>
    <td style="padding:5px;">Password</td>
    <td style="padding:5px;">:</td>
    <td style="padding:5px;"><input type="text" name="password" size="20" class="form-control"></td>
  </tr>
  <tr>
    <td style="padding:5px;">Email</td>
    <td style="padding:5px;">:</td>
    <td style="padding:5px;"><input type="text" name="email" size="20" class="form-control"></td>
  </tr>';
  
  
$sel = '<select name="level" class="form-control">';
$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
	$sel .= '<option value="'.$v.'">'.$v.'</option>';	
	
}

$sel .= '</select>';  
  
$sel2 = '<select name="tipe" class="form-control">';
$arr2 = array ('aktif','pasif');
foreach ($arr2 as $kk=>$vv){
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	

}

$sel2 .= '</select>';    
  
  
$admin .='<tr>
    <td style="padding:5px;">Level</td>
    <td style="padding:5px;">:</td>
    <td style="padding:5px;">'.$sel.'</td>
  </tr>';

$admin .='<tr>
    <td style="padding:5px;">Status</td>
    <td style="padding:5px;">:</td>
    <td style="padding:5px;">'.$sel2.'</td>
  </tr>';  

$admin .='<tr>
	<td style="padding:5px;">&nbsp;</td>
    <td style="padding:5px;">&nbsp;</td>
    <td style="padding:5px;"><input type="submit" value="Tambah" name="add_users" class="btn btn-success"></td>
  </tr>
</table></form>';
$admin .= '</div>';		
}

######################################
# Edit User
######################################
if ($_GET['aksi'] == 'edit_user'){
global $qss;
$id = int_filter($_GET['id']);
$s = mysql_query ("SELECT * FROM `useraura` WHERE `UserId`='$id'");	
$data = mysql_fetch_array($s);
$user = $data['user'];	
$level = $data['level'];	
$tipe = $data['tipe'];
$email = $data['email'];
$ss = mysql_query ("SHOW FIELDS FROM useraura");
while ($as = mysql_fetch_array ($ss)){
	 $arrs = $as['Type'];
if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'level') break;
}

if (isset ($_GET['offset']) && isset ($_GET['pg']) && isset ($_GET['stg'])) {
$qss = "&amp;pg=$pg&amp;stg=$stg&amp;offset=$offset";
}	
$admin.='<h5 class="bg text-success">Edit User</h5>';

$admin .= '<form method="post" action="admin.php?pilih=admin_users&amp;id='.$id.''.$qss.'">
<table class="table table-striped">
  <tr>
    <td>Username</td>
    <td><input type="text" name="user" value="'.$user.'" class="form-control" disabled="disabled"></td>
  </tr>';
$admin .= '<tr>
    <td>Email</td>
    <td><input type="text" name="email" value="'.$email.'" class="form-control"></td>
  </tr>';  
  
$sel = '<select name="level" class="form-control">';
$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
	if ($level == $v){
	$sel .= '<option value="'.$v.'" selected="selected">'.$v.'</option>';
	}else {
	$sel .= '<option value="'.$v.'">'.$v.'</option>';	
	}
}

$sel .= '</select>';  
  
$sel2 = '<select name="tipe" class="form-control">';
$arr2 = array ('aktif','pasif');
foreach ($arr2 as $kk=>$vv){
	if ($tipe == $vv){
	$sel2 .= '<option value="'.$vv.'" selected="selected">'.$vv.'</option>';
	}else {
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	
	}
}

$sel2 .= '</select>';    
  
  
$admin .= '<tr>
    <td>Level</td>
    <td>'.$sel.'</td>
</tr>
<tr>
    <td>Status</td>
    <td>'.$sel2.'</td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td><input type="submit" value="Simpan" name="edit_users" class="btn btn-success"></td>
  </tr>
</table></form>';
}

if (!in_array($_GET['aksi'],array('add','edit','hint','addhint'))){
if (isset($_POST['submit'])){
$tot     .= $_POST['tot'];
$pcheck ='';
			for($i=1;$i<=$tot;$i++)
			{
				$check = $_POST['check'.$i] ;
				if($check <> "")
				{
					$pcheck .= $check . ",";
				}
			}
$pcheck = substr_replace($pcheck, "", -1, 1);
$error = '';
if ($error){
$admin.='<div class="error">'.$error.'</div>';
}
if ($pcheck)  $sukses .= "Sukses: user dengan UserId $pcheck  Telah di hapus !<br />";
$koneksi_db->sql_query("DELETE FROM useraura WHERE UserId in($pcheck)");
if ($sukses){
$admin.='<div class="sukses">'.$sukses.'</div>';
}
}
$search = $_GET['search'];

$admin.='<h5>List Users</h5>';

$admin.='<form method="post" action=""><table class="table table-striped">
<tr>
<th class="text-center">No</th>
<th></th>
<th>Users</th>
<th>Email</th>
<th>Level</th>
<th>Status</th>
<th>Aksi</th>
</tr>';
$qss = null;
$offset = int_filter(@$_GET['offset']);
$pg		= int_filter(@$_GET['pg']);
$stg	= int_filter(@$_GET['stg']);
if($search){
$query = $koneksi_db->sql_query("SELECT count(user) as t FROM `useraura` WHERE user like '%$search%' or email like '%$search%'");
}else{
$query = $koneksi_db->sql_query("SELECT count(user) as t FROM `useraura` where user<>'superadmin'");
}
$rows = mysql_fetch_row ($query);
$jumlah = $rows[0];
mysql_free_result ($query);
$limit = 25;
$a = new paging ($limit);
if ($jumlah > 0){
if($search){
$q = mysql_query ("SELECT * FROM `useraura` WHERE user like '%$search%' or email like '%$search%' LIMIT $offset,$limit");
}else{
$q = mysql_query ("SELECT * FROM `useraura` where user<>'superadmin' LIMIT $offset,$limit");
}
if($offset){
$no = $offset+1;
}else{
$no = 1;
}
while ($data = mysql_fetch_array($q)){
$warna = empty ($warna) ? 'bgcolor="#f5f5f5"' : '';

$admin.='<tr '.$warna.'>
<td class="text-center">'.$no.'</td>
<td><input type=checkbox name=check'.$no.' value='.$data[0].'></td>
<td>'.$data['user'].'</td>
<td>'.$data['email'].'</td>
<td>'.$data['level'].'</td>
<td>'.$data['tipe'].'</td>
<td>
<a  class="btn btn-info" href="?pilih=user&amp;mod=yes&amp;aksi=edit_user&amp;id='.$data['UserId'].$qss.'">Edit</a> 
<a  class="btn btn-danger" href="?pilih=user&amp;mod=yes&amp;aksi=hapus&amp;id='.$data['UserId'].$qss.'" onClick="GP_popupConfirmMsg(\'Apakah anda Ingin menghapus Users \n['.$data['user'].']\');return document.MM_returnValue;">Hapus</a></td>
</tr>';  
  $no++;
}
$admin .='<input type="hidden" name="tot" value="'.$jumlah.'">
<tr>
<td colspan="7" style="padding:4px 10px 4px 10px;"><input type="submit" value="Hapus" name="submit" class="btn btn-danger"></td>
</tr>';
}
$admin .= '</table>';
$admin .="</form>";
if($jumlah>$limit){

if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
$offset = 0;
}

if (empty($_GET['pg']) and !isset ($_GET['pg'])) {
$pg = 1;
}

if (empty($_GET['stg']) and !isset ($_GET['stg'])) {
$stg = 1;
}

$admin .='<div class="border">';
$admin .="<center>";
$admin .= $a-> getPaging($jumlah, $pg, $stg);
$admin .="</center>";
$admin .='</div>';
}
}

}

echo $admin;

?>