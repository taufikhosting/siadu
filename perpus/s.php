<?php
session_start();
if($_REQUEST['username']=='admin' && $_REQUEST['password']=='admin'){
	$_SESSION['hrdadmin']='admin';
	header('location:bookshelf.php');
} else {
	header('location:login.php?login=reqauth');
}
?>