<?php
session_start();

// System files
require_once('../shared/config.php');
require_once('system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
define('VWDIR',SYSDIR.'views/');

// XMLHTTP Request
$q=gpost('x');
if($q!=""){
	if($q=='_apps') require_once(SHAREDDIR.'apps.php');
    else {
		$lang=admin_getLang();
		if($lang=='id')$lang='';
		require_once(APPDIR.($lang==''?'':$lang.'/').$q.'.php');
	}
}
?>