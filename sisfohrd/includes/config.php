<?php
/**
 * Teamworks v2.3
 * http://www.teamworks.co.id
 * December 03, 2007 07:29:56 AM 
 * Author: Teamworks Creative - reky@teamworks.co.id - +6285732037068 - pin 25b7edd4
 */

error_reporting(1);

/*---------------------------------------------------------------------------------
 konfigurasi database
---------------------------------------------------------------------------------*/
define('AURACMS_FUNC', true);


$mysql_user = 'root';
$mysql_password = '';
$mysql_database = 'sister_siadu';
$mysql_host = 'localhost';

/******************
$mysql_user = 'ppikom_ppikom';
$mysql_password = '5925460';
$mysql_database = 'ppikom_hrd';
$mysql_host = 'localhost';

*****************/

/*---------------------------------------------------------------------------------
 konfigurasi situs dan email
---------------------------------------------------------------------------------*/

//$email_master='';
//$theme='tcms';
//$judul_situs='';
//$url_situs= '';
//$slogan = '';
$adminfile = 'admin'; //silahkan di ganti dan jangan lupa merename file admin.php  sesuai dg yang anda ganti
$editor ='1';  //Jika menggunakan WYSIWYG isi 1 jika tidak 0
$name_blocker = '';
$mail_blocker = '';

//$_META['description'] = '';
//$_META['keywords'] = 'ada';

//$maxkonten=50;
//$maxadmindata = 20;
//$maxdata = 10;
$translateKal = array( 'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu',
      'Sun' => 'Minggu',
      'Jan' => 'Januari',
      'Feb' => 'Februari',
      'Mar' => 'Maret',
      'Apr' => 'April',
      'May' => 'Mei',
      'Jun' => 'Juni',
      'Jul' => 'Juli',
      'Aug' => 'Agustus',
      'Sep' => 'September',
      'Oct' => 'Oktober',
      'Nov' => 'Nopember',
      'Dec' => 'Desember');

if (file_exists('includes/fungsi.php')){
 include 'includes/fungsi.php';
}
if (file_exists('includes/Mobile_Detect.php')){
 include 'includes/Mobile_Detect.php';
}
?>