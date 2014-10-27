<?php

$opt=gpost('opt');
$act=gpost('a');
if($opt=='rife'){
	if($act=='find'){
		require_once(VWDIR.'ri_emp.php');
	}
}
?>