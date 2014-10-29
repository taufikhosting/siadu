<?php

/**
 * Teamworks v2.3
 * http://www.teamworks.co.id
 * December 03, 2007 07:29:56 AM 
 * Author: Teamworks Creative - reky@teamworks.co.id - +6285732037068 - pin 25b7edd4
 */

if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
ob_start();
global $koneksi_db;

$login  ='';
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= '<br />';
$login .= aura_login ();

}

if (!cek_login ()){

$login .= '<br /><form method="post" action=""><table border="0" cellpadding="2" width="100%" cellspacing="1">
  <tr>
    <td>Username<br /><input type="text" name="username" size="20" /></td>
  </tr>
  <tr>
    <td>Password<br /><input type="password" name="password" size="20" /></td>
  </tr>
  <tr>
    <td width="66%"><input type="hidden" value="1" name="loguser" /><input type="submit" value="Login" name="submit_login" /></td>
  </tr>
  <tr>
    <td><br /></td>
  </tr>
</table></form>';
$login .= '<span><a href="/register.html">Register</a><br /><a href="/forgotpassword.html">Forgot Password</a></span>';

}else{
$login .= 'Hello   : <b>' . $_SESSION['UserName'] .'</b><br />';
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ 

$login .= 'Anda mengakses dengan proxy server<br />'; 
$login .= 'IP Anda : '. $_SERVER['HTTP_X_FORWARDED_FOR'].'<br />'; 
$login .= 'Terkoneksi lewat engine : '. $_SERVER['HTTP_VIA'].'<br />'; 
$login .= 'IP Proxy : ' . $_SERVER['REMOTE_ADDR']; 
}else{ 
$login .= 'Anda terkoneksi tanpa proxy <br />'; 
$login .= 'IP Anda : '. $_SERVER['REMOTE_ADDR']; 
}

} //akhir cek login

echo $login;

$out = ob_get_contents();
ob_end_clean();

?>