<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
$admin = '';
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
$JS_SCRIPT= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
$admin .='<h4 class="page-header">Administrasi Pendidikan</h4>';


if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$hasil = $koneksi_db->sql_query("DELETE FROM `hrd_pendidikan` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">pendidikan berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=pendidikan&mod=yes" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
	$nama 		= $_POST['nama'];
	$tunjangan 		= $_POST['tunjangan'];

	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama pendidikan<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `hrd_pendidikan` SET `nama`='$nama' ,`tunjangan`='$tunjangan' WHERE `id`='$id'" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=pendidikan&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `hrd_pendidikan` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$admin .= '<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Edit</h3></div>';
$admin .= '
<form method="post" action="" class="form-inline">
<table   class="table table-striped table-hover">
	<tr>
		<td>Nama pendidikan</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$data['nama'].'" size="25" class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Simpan" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form></div>';
}

if($_GET['aksi']==""){
if(isset($_POST['submit'])){
	$nama 		= $_POST['nama'];
	$tunjangan 		= $_POST['tunjangan'];
	
	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama pendidikan<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `hrd_pendidikan` (`nama` ,`tunjangan`) VALUES ('$nama','$tunjangan')" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
		}
		unset($nama);
		unset($tunjangan);
	}

}
$nama     		= !isset($nama) ? '' : $nama;
$tunjangan     		= !isset($tunjangan) ? '' : $tunjangan;
$admin .= '<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Tambah</h3></div>';
$admin .= '
<form method="post" action="" class="form-inline">
<table class="table table-striped table-hover">
	<tr>
		<td>Nama pendidikan</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="30" class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Simpan" name="submit"class="btn btn-success"></td>
	</tr>
</table>
</form></div>';	
}

/************************************/
$admin.='
<table id="example"class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Pendidikan</th>
            <th width="30%">Aksi</th>
        </tr>
    </thead>';
	$admin.='<tbody>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_pendidikan" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 
$nama=$data['nama'];
$admin .='<tr>
<td>'.$nama.'</td>
<td><a href="?pilih=pendidikan&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=pendidikan&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'"><span class="btn btn-warning">Edit</span></a></td>
</tr>';
}
$admin .= '</tbody></table>';
/************************************/
}
echo $admin;

?>