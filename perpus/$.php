<?php
session_start();

// System files
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

// XMLHTTP Request
$q=gpost('x');
if($q!=""){
    require_once(APPDIR.$q.'.php');
}
?>