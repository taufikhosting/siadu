<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
$tengah = null;

global $koneksi_db,$error;

if($_GET['aksi']=="register"){

$tengah .='<h4 class="bg">Registrasi User</h4>';

if(isset($_POST['submit'])){
$_POST = array_map('cleantext',$_POST);
$nama         = $_POST['nama'];
$email        = $_POST['email'];
if(!isset($_POST['cekperaturan'])){
$cekperaturan = '0';
}else{
$cekperaturan = $_POST['cekperaturan'];
}
$password     = md5($_POST['password']);
$rpassword    = md5($_POST['rpassword']);
$confirm_code = md5(uniqid(rand()));
$mail_blocker = explode(",", $mail_blocker);
	foreach ($mail_blocker as $key => $val) {
		if ($val == strtolower($email) && $val != "") $error .= "Given E-Mail the address is forbidden to use!<br />";
}
$name_blocker = explode(",", $name_blocker);
	foreach ($name_blocker as $key => $val) {
		if ($val == strtolower($nama) && $val != "") $error .= "Named it is forbidden to use!<br />";
}

if (!$nama || preg_match("/[^a-zA-Z0-9_-]/", $nama)) $error .= "Error: Karakter Username tidak diizinkan kecuali a-z,A-Z,0-9,-, dan _<br />";
if (strlen($nama) > 10) $error .= "Username Terlalu Panjang Maksimal 10 Karakter<br />";
if (strrpos($nama, " ") > 0) $error .= "Username Tidak Boleh Menggunakan Spasi";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT user FROM useraura WHERE user='$nama'")) > 0) $error .= "Error: Username ".$nama." sudah terdaftar , silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT user FROM temp_useraura WHERE user='$nama'")) > 0) $error .= "Error: Username ".$nama." sudah terdaftar , silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM temp_useraura WHERE email='$email'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";
if (!$nama)  $error .= "Error: Formulir Nama belum diisi , silahkan ulangi.<br />";
if ($cekperaturan != '1') $error .= "You should be agree with rules and conditions of use!<br />";
if (!$nama)  $error .= "Error: Formulir Nama belum diisi , silahkan ulangi.<br />";
if (empty($_POST['password']))  $error .= "Error: Formulir Password belum diisi , silahkan ulangi.<br />";
if ($_POST['password'] != $_POST['rpassword'])  $error .= "Password and Retype Password Not Macth.<br />";
if (!is_valid_email($email)) $error .= "Error: E-Mail address invalid!<br />";
if ($_POST['gfx_check'] != $_SESSION['Var_session'] or !isset($_SESSION['Var_session'])) {$error .= "Security Code Invalid <br />";}
if ($error){
        $tengah.='<div class="error">'.$error.'</div>';
}else{
	$hasil1 = $koneksi_db->sql_query("INSERT INTO useraura (user, email, password , level, tipe)VALUES('$nama', '$email', '$password','User','aktif')" );

        if($hasil1){
            $subject  ="Your Account Information";
            $header   = $email_master;
            $message  ="Your Account \r\n";
            $message .="<br /><br />";
            $message .="Username : ".$nama." <br>Password : ".$_POST['password']."";
            $message .="<br />Please Don't Replay This Email, this is Automatic Email Because You Register in $judul_situs <br /><br />";
            $message .="<br /><br /><br />Regard:<br /><br />Webmaster<br />";
            $sentmail = mail_send($email, $header, $subject, $message, 1, 1);
        $tengah.='<div class="sukses">Please Login With Your Username and Your Password</div>';
		unset($_POST);

        }
}

}

$nama         = !isset($nama) ? '' : $nama;
$email        = !isset($email) ? '' : $email;
$password     = !isset($passwordn) ? '' : $password;
$rpassword    = !isset($rpassword) ? '' : $rpassword;
$checkperaturan = isset($_POST['cekperaturan']) ? ' checked="checked"' : '';
$tengah .='<div class="border">';
$tengah .='
<p>Nikmati aneka fasilitas yang tersedia di Portal ini dengan menjadi member.
Untuk menjadi members, Anda hanya perlu melakukan registrasi dengan mengisi form
singkat berikut ini.</p>
<p>Masukkan user name atau login name yang diinginkan, lalu masukkan pula email
Anda.</p>
<table width="100%" border="0"  cellpadding="0" cellspacing="0">
<tr>
<td><form method="post" action="">
<table width="100%" border="0" cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><strong>Sign up</strong></td>
</tr>
<tr>
<td>Username</td>
<td>:</td>
<td><input name="nama" type="text" size="30" value="'.cleantext(stripslashes(@$_POST['nama'])).'" /></td>
</tr>
<tr>
<td>E-mail</td>
<td>:</td>
<td><input name="email" type="text" size="30" value="'.cleantext(stripslashes(@$_POST['email'])).'" /></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="password" type="password" size="30" /></td>
</tr>
<tr>
<td>ReType Password</td>
<td>:</td>
<td><input name="rpassword" type="password" size="30" /></td>
</tr>
';
if (extension_loaded("gd")) {
$tengah .= '
<tr>
<td valign=top>Security Code</td>
<td valign=top>:</td>
<td valign=top><img src="includes/code_image.php" border="1" alt="Security Code" /></td>
</tr>
<tr>
<td>Type Code</td>
<td>:</td>
<td><input name="gfx_check" type="text" size="10"  maxlength="6" /></td>
</tr>';
}
$tengah .= '
<tr>
<td valign="top">Peraturan</td>
<td valign="top">:</td>
<td><textarea cols="60" rows="10">
Common rules of a portal
1. Our portal is opened for visiting by all interested person. To use all size of services of a site, it is necessary for you to register.
2. The user of a portal can become any person, agreed to observe the given rules.
3. Each participant of dialogue has the right to confidentiality of the information on. Therefore do not discuss financial, family and other interests of participants without the permission on it the participant.
</textarea></td>
</tr>
<tr>
<td></td>
<td>:</td>
<td><input type="checkbox" name="cekperaturan" value="1" id="setuju"'.$checkperaturan.' /> <label for="setuju">I agree to the terms set out in this license.</label></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="Submit" /> &nbsp;
<input type="reset" name="Reset" value="Reset" /></td>
</tr>
</table>
</form></td>
</tr>
</table>';
$tengah .='</div>';

}

if($_GET['aksi']=="forgotpass"){

$tengah .='<h5 class="bg">Lupa Password / User ?</h5>';


if(isset($_POST['submit'])){
$email = $_POST['email'];
if (!$email)  $error .= "Error: Formulir Email belum diisi , silahkan ulangi.<br />";
if ($error){
$tengah.='<div class="error">'.$error.'</div>';
    }else{
$jumlah = $koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM useraura WHERE email='$email' AND tipe='aktif'"));
if($jumlah<1) { 
$tengah.='<div class="error">Sorry,no member with that data</div>';
} else {             
$newpass= gen_pass(10);
$userdata= "SELECT * FROM useraura WHERE email = '$email'";
$userdata = $koneksi_db->sql_query( $userdata );
$datauser = mysql_fetch_array($userdata);
$user=$datauser['user'];	
$emailuser=$datauser['email'];	
$newpassword = md5($newpass);
$update= "update useraura set password = '$newpassword' where email='$emailuser'";
$updatedata = $koneksi_db->sql_query( $update );	
//forgot_login();
$subject = "$judul_situs - Berikut Data Account Anda";
$pesan.= '
<table width="700" align="center">
<tr>
<td><img src="'.$url_situs.'/images/head.png" alt="teamworks.co.id" width="700" height="80" style=""/></td>
</tr>
<tr>
<td style="padding: 20px; color: rgb(0, 0, 0);">
Terima kasih atas kepercayaannya menggunakan layanan Teamworks Creative <br/><br/>
Anda melakukan Fitur Lupa Password<br/><br/>
Berikut informasi Account Anda :<br/><br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100">Username </td>
    <td width="15" align="center">:</td>
    <td>'.$user.'</td>
  </tr>
  <tr>
    <td>Email</td>
    <td align="center">:</td>
    <td>'.$emailuser.'</td>
  </tr>
  <tr>
    <td>Password</td>
    <td align="center">:</td>
    <td>'.$newpass.'</td>
  </tr>
</table><br/><br/>';

$pesan.='Terima kasih,<br/><br/>

Salam sukses,<br/>

'.$judul_situs.'
</td>
</tr>

<tr>
<td style="font-size: 10px; font-family: arial; padding: 5px; color: red; text-align: center;">
catatan : "Jangan membalas (reply) email ini, karena ini merupakan pemberitahuan otomatis"</td>
</tr>

<tr>
<td style="font-size: 10px; font-family: arial; display: block; padding: 5px; color: rgb(51, 51, 51); text-align: center;">
<img src="'.$url_situs.'/images/foot.png" alt="footer" width="670" height="10"/>
<p><a href="http://www.teamworks.co.id/" target="_blank" rel="nofollow">teamworks.co.id</a> - your smile is our creation</p></td>
</tr></table>';
$msg = ''.$pesan.'';
kirim_mail($emailuser,$email_master, $subject, $msg, 1, 1);
Posted('contact');
$tengah.='<div class="sukses">Thank you, mail has been sent! at : '.$emailuser.' from '.$email_master.'</div>';	
	
}
}
}	

$tengah .='<div class="borderhal">';

$tengah .='
<p>Lupa password / User? Bukan masalah.</p>
<p>Pertama, masukkan email Anda, dan klik Send Password.<br>
Kami akan membuat password baru untuk anda.

<form action="" method="post">
<table>
<tr>
  <td>Email</td>
  <td>:</td>
  <td><input type="text" name="email" size="26"/></td>
  <td><input type="submit" name="submit" value="Send Password" /></td>
</tr>
</table>
</form>';
$tengah .='</div>';
}


echo $tengah;


?>