<?php
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$filedesc=gpost('description');

/* File Upload */
$errormsg=""; $cerr=0;
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
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
		if($_FILES["file"]["size"] < 200000){
			if (file_exists($filepath))
			{
				$cerr++;
				$errormsg= $_FILES["file"]["name"] . " already exists. ";
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

				$newwidth=100;
				//$newheight=($height/$width)*$newwidth;
				//$xnewheight=$newheight;
				$newheight=135;
				$tmp=imagecreatetruecolor($newwidth,$newheight);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
				 $width,$height);

				$fname=$_FILES["file"]["name"];
				$filename=date("YmdHis").".".$extension;
				$filepath=CVDIR.$filename;

				imagejpeg($tmp,$filepath,100);

				imagedestroy($src);
				imagedestroy($tmp);
				//move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
				//$dcid=gpost('dcid');
				//$description=gpost('description');
				//dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
				//$errormsg= "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
		else
		{
			$cerr++;
			$errormsg="File size is over the file size limit (200 KB).";
		}
	}
}
else
{
	$cerr++;
	$errormsg= "File type is not supported.";
}
/* End of File Upload */
?>
<html>
<head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<style type="text/css">
.linkl11 {
	font:11px Verdana, Tahoma;
	color:#468ad2;
	text-decoration:none;
}
.linkl11:hover {
	text-decoration:underline;
}
.atch{
	padding:4px 4px 4px 18px;
	background:url('<?=IMGR?>bi_afile.png') no-repeat;
	background-position:4px 4px;
	border-radius:5px;
	box-shadow:none;
}
.atch:hover{
	background-color:#efefef;
	box-shadow:inset 0px 1px 1px rgba(0, 0, 0, .45);
	cursor:pointer;
}

.rembtn{
	width:11px;
	height:11px;
	background:url('<?=IMGR?>sdel.png') no-repeat;
	border:none;
	visibility:hidden;
	cursor:pointer;
}
.atch:hover .rembtn{
	visibility:visible;
}
</style>
<script type="text/javascript" language="javascript">
	function remfile(){
		parent.acceptFile('');
		document.location='rwform.php';
	}
	function acceptTitle(a){
		if(a=='') a='Untitled';
		else a='<i>'+a+'</i>';
		E('cvtitle').innerHTML=a;
	}
</script>
</head>
<body style="padding:0;margin:0">
<?php if($cerr==0){;?>
<table cellspacing="0" cellpadding="0"><tr><td align="center"><center>
<div id="pf_photo" style="width:104px;margin-left:0px;background:url('<?=IMGC?>cvbg.png') center no-repeat">
	<div style="width:104px;height:138px;background:url('<?=IMGC.$filename?>') center top no-repeat">
	<img src="<?=IMGC?>cvshade.png"/>
	</div>
</div>
<span id="cvtitle" style="display:hidden"></span>
<button class="btn" style="margin-top:5px" onclick="document.location='cvform.php'">Remove cover</button>
</center></td></tr></table>
<?php } else {?>

<?php }?>
<script type="text/javascript" language="javascript">
<?php if($cerr==0){?>
	parent.acceptFile('<?=$filename?>');
<?php } else {?>
alert('<?=$errormsg?>');
document.location='cvform.php';
<?php }?>
</script>
</form>
</body>
</html>