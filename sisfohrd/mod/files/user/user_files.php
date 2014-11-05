<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}

function format_size($file){
	$get_file_size = filesize("./userfiles/$file");
	$get_file_size = number_format($get_file_size / 1024,1);
	return "$get_file_size KB";
}

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}

$admin ='<h4 class="bg">File Manager </h4>';
$admin .='<div class="border"><a href="?pilih=files&amp;mod=yes"><b>Home</b></a> | <a href="admin.php?pilih=files&amp;mod=yes&amp;aksi=add"><b>Upload File</b></a></div>';
$admin .='<div class="left_message">
<span style="text-decoration:underline">Catatan:</span><br />
Gunakan url seperti dibawah ini untuk menyisipkan image di artikel atau halaman web: <br /><b>"userfiles/nama_file.extension"</b><br /><span style="text-decoration:underline">contoh:</span> <br />&lt;img src="userfiles/goldentop.jpg" alt="" border="0" /&gt;
</div>';

if (session_is_registered ('LevelAkses')){
if($_GET['aksi'] == ''){
$admin .= '
<table cellspacing="0" style="width:100%">
<tbody id="rowbody">
	<tr bgcolor="#d1d1d1">
	<th style="text-align:left;padding:10px 5px 10px 10px;border-left:1px solid #ccc;border-top:1px solid #ccc;">Nama File</th>

	<th style="text-align:center;padding:10px 5px 10px 5px;border-top:1px solid #ccc;border-left:1px solid #ccc;width:100px;">Ukuran</th>
	<th colspan="2" style="text-align:center;padding:10px 5px 10px0 5px;border-right:1px solid #ccc;border-top:1px solid #ccc;border-left:1px solid #ccc;width:10%;">Aksi</th>
	</tr>';
$rep=opendir('./userfiles/');
$warna = '';
$no = 1;
while ($file = readdir($rep)) {
	if($file != '..' && $file !='.' && $file !=''&& $file !='Thumbs.db'){
		if (is_dir($file)){
			continue;
		}else {
			if ($file !='index.php'){
			$warna = empty($warna) ? 'bgcolor="#efefef"' : '';
			$admin .= '
			<tr id="'.$warna.'">
			<td style="text-align:left;padding:10px;border-left:1px solid #ccc;border-top:1px solid #ccc;"valign="top">'.$file.'</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;width:100px;"valign="top">'.format_size($file).'</td>
			<td style="text-align:center;padding:2px;border-top:1px solid #ccc;border-left:1px solid #ccc;"valign="top"><a href="userfiles/'.$file.'" target="_blank">View</a></td>
			<td style="text-align:center;padding:2px;border-right:1px solid #ccc;border-top:1px solid #ccc;border-left:1px solid #ccc;"valign="top"><a href="?pilih=files&amp;mod=yes&amp;aksi=hapus&amp;nama='.$file.'"><img src="images/delete.gif"></a></td>
			</tr>';
			$warna = empty($warna) ? 'bgcolor="#efefef"' : '';
			}
		}
	}
$no++;
}
closedir($rep);
clearstatcache();
$admin .= '<tr><td colspan="4" style="width:25px;text-align:center;padding:5px;border-top:1px solid #ccc;">&nbsp;</td></tr></tbody></table>';
	
	
}
if ($_GET['aksi']=='add'){

global $max_size,$allowed_exts,$allowed_mime;

if (isset($_POST['submit'])) {
    $image_name1=$_FILES['image1']['name'];
    $image_size1=$_FILES['image1']['size'];
    $image_name2=$_FILES['image2']['name'];
    $image_size2=$_FILES['image2']['size'];
    $image_name3=$_FILES['image3']['name'];
    $image_size3=$_FILES['image3']['size'];
    $image_name4=$_FILES['image4']['name'];
    $image_size4=$_FILES['image4']['size'];
    $image_name5=$_FILES['image5']['name'];
    $image_size5=$_FILES['image5']['size'];
	$error = '';
    if ($image_name1){
		@copy($_FILES['image1']['tmp_name'], "./userfiles/".$image_name1);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name1.' berhasil!</div>';  
	}
	if ($image_name2){
		@copy($_FILES['image2']['tmp_name'], "./userfiles/".$image_name2);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name2.' berhasil!</div>';  
	}
	if ($image_name3){
		@copy($_FILES['image3']['tmp_name'], "./userfiles/".$image_name3);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name3.' berhasil!</div>';  
	}
	if ($image_name4){
		@copy($_FILES['image4']['tmp_name'], "./userfiles/".$image_name4);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name4.' berhasil!</div>';  
	}
	if ($image_name5){
		@copy($_FILES['image5']['tmp_name'], "./userfiles/".$image_name5);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name5.' berhasil!</div>';  
	}
	 $style_include[] ='<meta http-equiv="refresh" content="3; url=?pilih=files&mod=yes" />';

}
$admin .='<div class="border">
<form method="post" enctype="multipart/form-data" action="">
<b>File Uploader</b><br /><input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<input type="file" name="image1" size="70" /><br />
<input type="file" name="image2" size="70" /><br />
<input type="file" name="image3" size="70" /><br />
<input type="file" name="image4" size="70" /><br />
<input type="file" name="image5" size="70" /><br />
<br />
<input type="submit" name="submit" value="Upload" />
</form></div>';
}

if ($_GET['aksi']=='hapus'){
    $nama = $_GET['nama'];
	if ($nama){
	unlink ("./userfiles/".$nama);
    }
    $admin.='<div class="sukses">File <b>'.$nama.'</b> telah di delete!</div>';
	header("location:?pilih=files&mod=yes");
exit;
}

}

echo $admin;

?>