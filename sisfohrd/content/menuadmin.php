<?php

if(preg_match('/'.basename(__FILE__).'/',$_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

if (cek_login ()){

if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){
if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Administrator"){

global $koneksi_db;

$hasil = $koneksi_db->sql_query( "SELECT * FROM admin_hrd where parent =0 ORDER BY ordering ASC" );
$menuadmin = "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
			$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
			
		}
$parentid=$data[0];
$menuadmin.= '<div class="bg2"><img src="themes/administrator/images/'.$data[6].'" align="top" style="margin-right:8px;">'.$data[1].'</div>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM admin_hrd where parent =$parentid ORDER BY menu ASC" );
$menuadmin .= "<ul>";
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";
kotakjudul('<a href="admin.php">Dashboard</a>', $menuadmin);
}elseif (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Editor"){
$username=$_SESSION['UserName'];
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_editor where parent =0 ORDER BY ordering ASC" );
$menuadmin = "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$adminmenu = $data[2];
			
		}
$parentid=$data[0];
$menuadmin.= '<div class="bg2"><img src="themes/administrator/images/'.$data[5].'" align="top" style="margin-right:8px;">'.$data[1].'</div>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_editor where parent =$parentid ORDER BY menu ASC" );
$menuadmin .= "<ul>";
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$adminmenu2 =$data2['url'];
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";


kotakjudul('Editor Menu', $menuadmin);
}else{
$username=$_SESSION['UserName'];
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_users where parent =0 ORDER BY ordering ASC" );
$menuadmin = "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$adminmenu = $data[2];
			
		}
$parentid=$data[0];
$menuadmin.= '<div class="bg2"><img src="themes/administrator/images/'.$data[5].'" align="top" style="margin-right:8px;">'.$data[1].'</div>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_users where parent =$parentid ORDER BY menu ASC" );
$menuadmin .= "<ul>";
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$adminmenu2 =$data2['url'];
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";


kotakjudul('User Menu', $menuadmin);
}
}
}

?>