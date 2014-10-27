<?php
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

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
<style type="text/css">
.sfont {
	<?=cssFontBody()?>
	<?=cssBodyColor?>
}
.pf_pbox {
	border:4px solid #ffffff;
	width:140px;
	box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
}
.stable tr td{
	font:11px Verdana, Tahoma;
	color:#323232;
}
.btn {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn:hover {
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn:active {
	<?=cssGrad("#ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%","#e2e2e2")?>
	box-shadow:none;
}
.btnx {
	height:24px;
	min-width:60px;
	padding:0 10px 1px 10px;
	<?=cssGrad("#c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%","#40e62a")?>
	//border:1px solid #c2c2c2;
	border:1px solid #33bb0a;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnx:hover {
	<?=cssGrad("#ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%","#4df337")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .25);
}
.btnx:active {
	<?=cssGrad("#a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%","#4df337")?>
	box-shadow:inset 0px 1px 3px rgba(0, 0, 0, .45);
}
</style>
</head>
<body>
<?php
if(!$errors){
?>
<form name="regform" id="regform" enctype="multipart/form-data" action="imgreq.php" method="post">
<input type="hidden" name="isImgOK" value="Yes" />
<table class="stable" cellspacing="0"><tr><td width="280px" align="center">
	<img id="pp<?=date("YmdHis")?>" class="pf_pbox" src="<?=(RLNK.$filename)."?arg=".date("YmdHis")?>"/>
</td></tr></table>
<div class="sfont" style="text-align:center;280px;margin:20px 0 10px 0">Set <?=gpost('fname')?>'s profile picture?</div>
<div id="posbtn" style="width:280px;text-align:center;padding-top:10px">
	<div class="sfont" id="imessage" style="text-align:center;280px"></div>
	<input type="button" class="btn" onclick="parent.close_uform()" value="   No   "/>
	<input type="button" class="btnx" value="Save" onclick="parent.takePhoto()"/>
</div>
</form>
<script type="text/javascript" language="javascript">
	parent.change_uform(<?=($xnewheight+115)?>);
</script>
<? } ?>
</form>
</body>
</html>