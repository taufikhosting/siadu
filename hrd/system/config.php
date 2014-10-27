<?php
$a=session_id(); if(empty($a)) session_start();
error_reporting(0); date_default_timezone_set('Asia/Jakarta');
if(!$loginpage)if($_SESSION['hrdadmin']!='admin') header('location:login.php');
/* Links */
define('RLNK','../hrd/');
define('IMGR',RLNK.'images/');
define('IMGP',RLNK.'photo/');
define('IMGF',RLNK.'berkas/');
define('FLNK',RLNK.'upload/');

/* Database */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPSWD','');
define('DBNAME','joshr');

/* System Directory */
define('ROTDIR','/xampp/htdocs/siadu/hrd/');
define('SYSDIR',ROTDIR.'system/');

/* Apps Directory */
define('APPDIR',SYSDIR.'apps/');

/* Libraries Directory */
define('LIBDIR',SYSDIR.'libraries/');
define('MODDIR',LIBDIR.'modules/');

/* Views Directory */
define('VWDIR',SYSDIR.'views/');
define('PGDIR',VWDIR.'pages/');
define('WGDIR',VWDIR.'widgets/');
define('SYDIR',VWDIR.'style/');

/* Resources Directory */
define('IMGDIR',ROTDIR.'images/');
define('PHODIR',ROTDIR.'photo/');
define('FILEDIR',ROTDIR.'upload/');

/* miscellaneous */
define('MAXPAGEROW',30);
?>
