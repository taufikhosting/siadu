<?php
if(session_id()=="") session_start();
header('Content-type: image/jpeg');

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$dcid=getsx('id');

$t=dbSel("photo","emp_photo","W/empid='$dcid'");
if(mysql_num_rows($t)>0){
	$r=dbFA($t);
	echo base64_decode($r['photo']);
} else {
	echo "Error!";
}
?>
