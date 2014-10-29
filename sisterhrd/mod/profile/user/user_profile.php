<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}


if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;

$style_include[] = <<<style
<style type="text/css">
@import url("mod/news/css/news.css");
</style>

style;

$JS_SCRIPT = <<<js
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/init.js"></script>

<script type="text/javascript">
if (typeof tinyMCE == 'object') {
tinyMCE.init({
plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template"
});
}
</script>
<!-- /TinyMCE -->
<script type=text/javascript>

	var allowsef = 1;
		
	// generate SEF urls 	
	function genSEF(from,to) { 
		if (allowsef == 1) {
			var str = from.value.toLowerCase();
			str = str.replace(/[^a-zA-Z 0-9]+/g,'');
			str = str.replace(/\s+/g, "-");		
			to.value = str;
		}
	}
		
</script>

	
js;
$script_include[] = $JS_SCRIPT;

if($_GET['aksi']==""){
$username=$_SESSION['UserName'];
$admin .='<h4 class="bg">Edit Profil</h4>';
if (isset($_POST["submit"])) {

define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";
	$id=$_POST['id'];
	$biodata=$_POST['biodata'];
//	$email=$_POST['email'];
	$namafile_name 	= $_FILES['gambar']['name'];
	$gambarlama=$_POST['gambarlama'];
$error = '';
if ($error) {
$admin .='<div class="error">'.$error.'</div>';
} else {
if (!empty ($namafile_name)){
$files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $namagambar = md5 (rand(1,100).$files) .'.jpg';
    $tempnews 	= 'mod/profile/temp/';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	
	$tnews 		= 'mod/profile/images/';
    $small 	= $tnews . $namagambar;
    $uploadgambarlama = $tnews . $gambarlama;
	create_thumbnail ($uploaddir, $small, $new_width = 100, $new_height = 'auto', $quality = 85);
if(!empty ($gambarlama)){
unlink($uploadgambarlama);
unlink($uploaddir);
}else{
unlink($uploaddir);
}
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET biodata='$biodata',avatar='$namagambar' WHERE UserId='$id'" );

$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Profil telah di updated</b><br />
'.$desc.'</font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}else{
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET biodata='$biodata' WHERE UserId='$id'" );

$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Profil telah di updated</b><br />
'.$desc.'</font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$username'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$user=$data['user'];
	$biodata=$data['biodata'];
	$email=$data['email'];
	$gambarlama=$data['avatar'];
}
$admin .='<div class="border">';
$admin .='
<form method="post" action=""enctype ="multipart/form-data">
    <table>
		        <tr>
            <td>User&nbsp;:</td>
            <td>'.$user.'</td>
        </tr>
		        <tr>
            <td>Email&nbsp;:</td>
            <td>'.$email.'</td>
        </tr>
        <tr>
            <td valign="top">Biodata&nbsp;:</td>
            <td><textarea name="biodata" cols="40">'.$biodata.'</textarea></td>
        </tr>
		
		    <tr>
            <td>Avatar&nbsp;:</td>
            <td><input type="file" name="gambar">
			<input type="hidden" name="gambarlama" size="40" value="'.$gambarlama.'"></td>
        </tr>
		    <tr>
            <td></td>
            <td>
			<img src="mod/profile/images/'.$gambarlama.'"></td>
        </tr>
        <tr>
            <td></td><td colspan="2">
            <input type="hidden" name="id" value="'.$id.'" />
            <input type="submit" name="submit" value="Update" />
            </td>
        </tr>
    </table>
</form> ';
$admin .='</div>';
}

echo $admin;

?>