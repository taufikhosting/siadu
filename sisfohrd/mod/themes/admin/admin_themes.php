<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

if (!cek_login ()){
	Header("Location: index.php");
	exit;
}else{
if (isset($_POST['submit'])) {
$theme  	= $_POST['theme'];
$hasil = $koneksi_db->sql_query( "UPDATE situs SET theme='$theme'WHERE id='1'" );
$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Theme telah di Ganti</b><br /></font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}
// read isi readme 
$fileComment = "themes/$theme/$theme.txt"; 
$f = fopen($fileComment, "r"); 
$isi = fread($f, filesize($fileComment)); 
fclose($f); 
$readmetheme = $isi;
//-----------------
$admin ='<h4 class="bg">Themes Manager </h4>';
$admin .='<div class="border"><a href="?pilih=themes&amp;mod=yes"><b>Home</b></a> | <a href="admin.php?pilih=themes&amp;mod=yes&amp;aksi=add"><b>Upload Themes</b></a></div>';
if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Administrator"){
if($_GET['aksi'] == ''){
$admin .= '<h4 class="bg">Themes Default</h4>';
$admin .='<div class="border">';
$admin .= '<img src="themes/'.$theme.'/'.$theme.'.jpg" style="max-width:180px;max-height:180px;margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;"><h2>'.$theme.'</h2>'.$readmetheme.'';
$admin .='</div>';
$admin .= '<h4 class="bg">Themes Gallery</h4>';
$admin .='<div class="border">';
$admin .= '<table  width="100%"><tr>';
$no =0;
$myDir = "themes/"; 
$dir = opendir($myDir);	
while($tmp = readdir($dir)){
	if($tmp != '..' && $tmp !='.' && $tmp !=''&& $tmp !='.htaccess'&& $tmp !='index.html'&& $tmp !='user'&& $tmp !='administrator'){
$urutan = $no + 1;
// read isi readme 
$fileComment = "themes/$tmp/$tmp.txt"; 
$f = fopen($fileComment, "r"); 
$isi = fread($f, filesize($fileComment)); 
fclose($f); 
$readmetmp = $isi;
//-----------------
$admin .= '<td valign="top"><img src="themes/'.$tmp.'/'.$tmp.'.jpg"style="max-width:180px;max-height:180px;margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;" border="0"><h2>'.$tmp.'</h2>'.$readmetmp.'';
$admin .='
<form method="post" action=""><input type="hidden" name="theme" value="'.$tmp.'" />
<input type="submit" name="submit" value="Ubah Theme" />
</form></td>';
if ($urutan  % $maxgalleri == 0) {
$admin .= '</tr></tr>';
}
$no++;
}
}
$admin .= '</table></div>';	
}
if ($_GET['aksi']=='add'){
global $max_size,$allowed_exts,$allowed_mime;
if (isset($_POST['submit'])) {

}

$admin .='<div class="border">
<form method="post" enctype="multipart/form-data" action="">
<b>File Uploader</b><br /><input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<input type="file" name="image" size="40" /><br /><br />
<input type="submit" name="submit" value="Upload" />
</form></div>';
}

}else{
	Header("Location: index.php");
	exit;
}
echo $admin;
}
?>