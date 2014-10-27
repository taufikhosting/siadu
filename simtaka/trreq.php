<?php
require_once('../shared/config.php');
require_once('system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');

$filedesc=gpost('description');

/* File Upload */
$errormsg=""; $cerr=0; $imagedata="";
$allowedExts = array("jpg", "jpeg", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		$cerr++;
		$errormsg="Error return Code: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		if($_FILES["file"]["size"] < 2000000){
			if (file_exists($filepath))
			{
				$cerr++;
				$errormsg= $_FILES["file"]["name"] . " sudah ada. ";
			}
			else
			{
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

				$newheight=150;
				$newwidth=($width/$height)*$newheight;
				//$newheight=140;
				$tmp=imagecreatetruecolor($newwidth,$newheight);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

				$fname=$_FILES["file"]["name"];
				//$filename=date("YmdHis").".".$extension;
				$filename="tmpfoto.".$extension;
				$filepath=FOTODIR.$filename;

				imagejpeg($tmp,$filepath,100);
				
				$imagedata=chunk_split(base64_encode(file_get_contents($filepath)));
				mysql_query("INSERT INTO sar_tmp SET photo='$imagedata'");
				$imageid=mysql_insert_id();
				//echo $imagedata;

				imagedestroy($src);
				imagedestroy($tmp);
			}
		}
		else
		{
			$cerr++;
			$errormsg="Ukuran file foto melebihi maksimum (2MB).";
		}
	}
}
else
{
	$cerr++;
	$errormsg= "Format file tidak didukung. Gunakan jpg, jpeg, atau png.";
}

if(gets('photo')!=''){
	$cerr=0;
	$fname=gets('photo');
	$extension = end(explode(".", $fname));
}
/* End of File Upload */
?>
<html>
<head>
<style type="text/css">
.sfont {
	font:12px 'Segoe UI',Verdana,Tahoma; color:#444;
	cursor:default
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
	background-color: #f4f4f4;background:-webkit-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-moz-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-ms-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-o-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn:hover {
	background-color: #dfdfdf;background:-webkit-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-moz-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-ms-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-o-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn:active {
	background-color: #e2e2e2;background:-webkit-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-moz-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-ms-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-o-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);	box-shadow:none;
}
.linkl11 {
	font:11px Verdana, Tahoma;
	color:#468ad2;
	text-decoration:none;
}
.linkl11:hover {
	text-decoration:underline;
}
.atch{
	padding:2px 4px 2px 4px;
	background:url('<?=IMGR?>bi_afile.png') no-repeat;
	background-position:4px 4px;
	border-radius:5px;
	box-shadow:none;
	cursor:pointer;
}
.atch:hover{
	background-color:#efefef;
	box-shadow:inset 0px 1px 1px rgba(0, 0, 0, .45);
	cursor:pointer;
}
.atch:active{
	background-color:#e0e0e0;
	box-shadow:inset 0px 1px 1px rgba(0, 0, 0, .6);
	cursor:pointer;
}

.rembtn{
	width:11px;
	height:11px;
	background:url('<?=IMGR?>sdel.png') no-repeat;
	border:none;
	visibility:hidden;
	cursor:pointer;
	margin-top:3px;
}
.atch:hover .rembtn{
	visibility:visible;
}
</style>
<script type="text/javascript" language="javascript">
	function remfile(){
		parent.getPhoto('',0,200,'w');
		document.location='trform.php';
	}
</script>
</head>
<body style="padding:0;margin:0">
<div class="sfont" id="imessage" style="width:220px;height:21px;padding-top:3px">
<?php if($cerr==0){ $fname=(strlen($fname)>28)?substr($fname,0,23)."...".$extension:$fname;?>
<div onclick="remfile()" class="atch" title="Hapus foto"><?=$fname?> <button class="rembtn" style="float:right"></button></div>
<?php } else {?>

<?php }?>
</div>
<script type="text/javascript" language="javascript">
<?php if($cerr==0){?>
	parent.getPhoto("<?=$filename?>",<?=$imageid?>,<?=$newwidth?>,'w');
<?php } else {?>
alert('<?=$errormsg?>');
document.location='trform.php';
<?php }?>
</script>
</form>
</body>
</html>