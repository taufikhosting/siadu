<?php
session_start();
if($_REQUEST['username']=='admin' && $_REQUEST['password']=='admin'){
	$_SESSION['hrdadmin']='admin';
	header('location:employee.php');
} else {
	header('location:login.php?login=reqauth');
}
?>