<?php
/**
 * Teamworks v2.3
 * http://www.teamworks.co.id
 * December 03, 2007 07:29:56 AM 
 * Author: Teamworks Creative - reky@teamworks.co.id - +6285732037068 - pin 25b7edd4
 */

if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}

$index_hal=1;


$tengah = '';
global $koneksi_db,$widgetpage;

$id = int_filter($_GET['id']);
$judul = $_GET['judul'];
$hasil = $koneksi_db->sql_query( "SELECT judul,konten FROM halaman WHERE seftitle='$judul'" );
$data = $koneksi_db->sql_fetchrow($hasil) ;
$judulnya = $data['judul'];
if (empty ($judulnya)){
		$tengah .='<div class="error"><center>Access Denied<br /><br />Regard<br /><br />Teamworks Creative<br />hai@teamworks.co.id</center></div>';
}else {
$tengah .='<h4 class="bg">'.$data['judul'].'</h4>';
$tengah .='<div class="border">';
$tengah .= $data['konten'];
$tengah .='</div>';

}
echo $tengah;

?>