
<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
if (!cek_login () or cek_login() ){
    Header("Location: login.php");
}
?>
