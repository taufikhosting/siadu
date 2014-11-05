<?php
require_once('db.php');
require_once('common.php');

/******************** IMAGE PROCESSING ********************/
define ("MAX_SIZE","800");

$imessage="";
 
 $errors=0;
 
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
        $image =$_FILES["file"]["name"];
 $uploadedfile = $_FILES['file']['tmp_name'];

  if ($image) 
  {
  $filename = stripslashes($_FILES['file']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") 
&& ($extension != "png") && ($extension != "gif")) 
  {
$imessage='Unknown Image extension';
$errors=1;
  }
 else
{
   $size=filesize($_FILES['file']['tmp_name']);
 
if ($size > MAX_SIZE*1024)
{
 $imessage="You have exceeded the size limit";
 $errors=1;
}
 
if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
}
else if($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
else 
{
$src = imagecreatefromgif($uploadedfile);
}
 
list($width,$height)=getimagesize($uploadedfile);

$newwidth=140;
$newheight=($height/$width)*$newwidth;
$xnewheight=$newheight;
$tmp=imagecreatetruecolor($newwidth,$newheight);

$newwidth1=80;
$newheight1=($height/$width)*$newwidth1;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
 $width,$height);

imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, 
$width,$height);

//$filename = "photo/". $_FILES['file']['name'];
//$filename1 = "photo/small/". $_FILES['file']['name'];

$filename = "photo/ptmp.".$extension;
$filename1 = "photo/small/ptmp.".$extension;

imagejpeg($tmp,$filename,100);
imagejpeg($tmp1,$filename1,100);

imagedestroy($src);
imagedestroy($tmp);
imagedestroy($tmp1);
}
}
}
/******************** END OF IMAGE PROCESSING ********************/

//If no errors registred, print the success message
if(!$errors){
   $imessage=$xnewheight."~Simpan sebagai foto ".gpost('fname')." ?";
}
 ?>
<html>
<head>
<?php require_once('style2.php');?>
<style type="text/css">
.pf_pbox {
	border:4px solid #ffffff;
	width:140px;
	box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
}
</style>
<script type="text/javascript" src="djsobj.js"></script>
<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
</head>
<body>
<?php
if(!$errors){
?>
<form name="regform" id="regform" enctype="multipart/form-data" action="imgreq.php" method="post">
<input type="hidden" name="isImgOK" value="Yes" />
<table class="stable" cellspacing="0"><tr><td width="280px" align="center">
	<img class="pf_pbox" src="<?=(RLNK.$filename)?>"/>
</td></tr></table>
<div class="sfont" style="text-align:center;280px;margin:20px 0 10px 0">Simpan sebagai foto <?=gpost('fname')?>?</div>
<div id="posbtn" style="width:280px;text-align:center;padding-top:10px">
	<div class="sfont" id="imessage" style="text-align:center;280px"></div>
	<input type="button" class="btn" onclick="parent.close_uform()" value="Tidak"/>
	<input type="button" class="btnx" value="Simpan" onclick="parent.takePhoto()"/>
</div>
</form>
<script type="text/javascript" language="javascript">
	parent.change_uform(<?=($xnewheight+90)?>);
</script>
<? } ?>
</form>
</body>
</html>