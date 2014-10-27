<?php
session_start();

// System files
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$cid=gpost('cid');

if(dbUpdate("so_history",Array('status'=>3,'date2'=>date('Y-m-d')),"dcid='$cid'")){
	dbUpdate("mstr_setting",Array('val'=>'N'),"dcid=3");
	header('location:'.RLNK.'stockopname.php?tab=sum');
}
else {
	header('location:'.RLNK.'stockopname.php');
}