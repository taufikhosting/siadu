<?php
error_reporting(0);

date_default_timezone_set('Asia/Jakarta');
define('ROOTLNK','../');
define('ROOTDIR','/xampp/htdocs/siadu(epiii)/');
// define('ROOTDIR','/opt/lampp/htdocs/siadu/');
define('SHAREDDIR',ROOTDIR.'shared/');
define('SHAREDLIB',ROOTDIR.'shared/libraries/');
define('SHAREDSTYLE',ROOTDIR.'shared/style/');
define('SHAREDAPPS',ROOTDIR.'shared/apps/');
define('SHAREDMAINSTYLE',ROOTDIR.'shared/style/main.php');
define('SHAREDFW',ROOTDIR.'shared/framework.php');
define('DBFILE',ROOTDIR.'shared/db.php');
define('SHAREDOBJ',SHAREDLIB.'obj/');

define('DB_HRD','`josh`.`hrd_pegawai`');

/* Database */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPSWD','');
// define('DBPSWD','adminstaff');
?>
