<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if(!$loginpage)if($_SESSION['hrdadmin']!='admin') header('location:login.php');
/* Links */
define('RLNK','http://127.0.0.1/new/perpus/');
define('IMGR',RLNK.'images/');
define('IMGP',RLNK.'photo/');
define('IMGF',RLNK.'berkas/');
define('FLNK',RLNK.'upload/');
define('IMGC',RLNK.'cover/');

// HRD
define('HRD_RLNK','http://127.0.0.1/new/hrd/');
define('HRD_IMGR',HRD_RLNK.'images/');
define('HRD_IMGP',HRD_RLNK.'photo/');
define('HRD_IMGF',HRD_RLNK.'berkas/');
define('HRD_FLNK',HRD_RLNK.'upload/');

/* Database */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPSWD','admin');
define('DBNAME','joshlib');

define('DB_HRD','`joshr`.`employee`');
define('DB_HRD_PHOTO','`joshr`.`emp_photo`');

/* System Directory */
define('ROOTDIR','E:/localhost/sites/www/new/');
define('ROTDIR',ROOTDIR.'perpus/');
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
define('FMDIR',VWDIR.'frame/');
define('SVDIR',VWDIR.'script/');

/* Resources Directory */
define('IMGDIR',ROTDIR.'images/');
define('PHODIR',ROTDIR.'photo/');
define('FILEDIR',ROTDIR.'upload/');
define('CVDIR',ROTDIR.'cover/');

/* miscellaneous */
define('MAXPAGEROW',30);
?>