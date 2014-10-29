<?php
include "../includes/session.php";
include "../includes/config.php";
include "../includes/fungsi.php";

if (!cek_login ()){
header("location:../login.php");
exit;
}else{

if ( $_SESSION['LevelAkses']=="Administrator"){
header("location:../admin.php");
exit;
}else{
header("location:../login.php");
}
}
?>