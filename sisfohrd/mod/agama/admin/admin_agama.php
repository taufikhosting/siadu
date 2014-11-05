<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
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
$admin .='<h4 class="page-header">Administrasi Agama</h4>';

if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$hasil = $koneksi_db->sql_query("DELETE FROM `hrd_agama` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Agama berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=agama&mod=yes" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
	$nama 		= $_POST['nama'];
	$tunjangan 		= $_POST['tunjangan'];

	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama Agama<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `hrd_agama` SET `nama`='$nama' WHERE `id`='$id'" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=agama&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `hrd_agama` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$admin .= '<div class="panel panel-info">
<div class="panel-heading"><h3 class="panel-title">Edit</h3></div>';
$admin .= '
<form method="post" action="">
<table border="0" cellspacing="0" cellpadding="0"class="table INFO">
	<tr>
		<td>Nama Agama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$data['nama'].'" size="25"class="form-control"></td>
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

if($_GET['aksi']==""){
if(isset($_POST['submit'])){
	$nama 		= $_POST['nama'];
	$tunjangan 		= $_POST['tunjangan'];
	
	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama Agama<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `hrd_agama` (`nama` ,`tunjangan`) VALUES ('$nama','$tunjangan')" );
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
<form method="post" action="">
<table border="0" cellspacing="0" cellpadding="0"class="table table-condensed">
	<tr>
		<td>Nama Agama</td>
		<td>:</td>
		<td><input type="text" name="nama" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Simpan" name="submit"class="btn btn-success"></td>
	</tr>
</table>
</form>';
$admin .= '</div>';
}

$admin.='
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Agama</th>
            <th width="30%">Aksi</th>
        </tr>
    </thead>';
	$admin.='<tbody>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_agama" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) { 

$nama=$data['nama'];
$admin.='<tr>
            <td>'.$nama.'</td>
            <td><a href="?pilih=agama&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=agama&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'"><span class="btn btn-warning">Edit</span></a></td>
        </tr>';
}   
$admin.='</tbody>
</table>';
}
echo $admin;
?>