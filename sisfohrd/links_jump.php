<?php

define('link', true);
if (isset($_GET['id'])){
include 'includes/config.php';
include 'includes/mysql.php';

$id		= int_filter($_GET['id']);
$hasil	= $koneksi_db->sql_query("SELECT url,hit,id FROM `mod_link` where id='$id'");
$data	= $koneksi_db->sql_fetchrow($hasil);
$url	= $data['url'];
$hit	= $data['hit'];
$Id	= $data['id'];
$hit	= $hit+1 ;
$hasil1 = $koneksi_db->sql_query("UPDATE `mod_link` SET `hit`=hit+1 WHERE id='$id'");
header ("location: $url");
exit;	
}
?>