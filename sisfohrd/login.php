<?php
include "includes/session.php";
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
ob_start();
global $koneksi_db;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="themes/administrator/css/login.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<title>administrator : Login</title>
</head>

<body onload="setFocus();">
<center>

<?php
$login  ='';
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= aura_login ();

}

if (!cek_login ()){
?>
<div class="login">
<img src="themes/administrator/images/loginuser.jpg">
<form action="" method="post" name="login" id="loginForm">
<div class="form-block">
<div class="inputlabel">Username : <input name="username" type="text" class="inputbox" size="25" /></div>
<div class="inputlabel">Password : <input name="password" type="password" class="inputbox" size="25" /><input type="hidden" value="1" name="loguser" /></div>
<div class="loginbutton">
<input type="submit" name="submit_login" class="button" value="Login" /></div>
</div>
</form>
<form action="../" method="post" name="login" id="loginForm">
<div  class="loginbutton"><br>
<input type="submit" name="submit_login" class="button" value="MENU UTAMA" /></div>
</form>
</div>
<?php

}else{
/*
if (session_is_registered ('LevelAkses') &&  $_SESSION['LevelAkses']=="Administrator"){
header("location:admin.php?pilih=main");
exit;
}*/
if (isset ($_SESSION['LevelAkses'])){
header("location:admin.php?pilih=main");
exit;
}
} //akhir cek login

echo $login;


?>
</center>
</body>
</html>
