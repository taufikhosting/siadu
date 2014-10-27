<?php
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$filedesc=gpost('description');

/* File Upload */
$errormsg=""; $cerr=0;
$allowedExts = array("jpg", "jpeg", "gif", "png", "txt", "pdf", "docx", "xlsx");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "text/plain")
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
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
			//$errormsg="Upload: " . $_FILES["file"]["name"] . "<br>";
			//$errormsg="Type: " . $_FILES["file"]["type"] . "<br>";
			//$errormsg="Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//$errormsg="Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			$filename=date("YmdHis").".".$extension;
			$filepath=FILEDIR.$filename;
			if (file_exists($filepath))
			{
				$cerr++;
				$errormsg= $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
				$dcid=gpost('dcid');
				$description=gpost('description');
				dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
				//$errormsg= "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
		else
		{
			$cerr++;
			$errormsg="File size is over the file size limit (2 MB).";
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
.linkl11 {
	font:11px Verdana, Tahoma;
	color:#468ad2;
	text-decoration:none;
}
.linkl11:hover {
	text-decoration:underline;
}
</style>
</head>
<body>
<form name="regform" id="regform" enctype="multipart/form-data" action="imgreq.php" method="post">
<input type="hidden" name="isImgOK" value="Yes" />
<div class="sfont" id="imessage" style="430px;height:40px">
<?php if($cerr==0){?>
<p style="line-height:200%">File "<?=$filedesc?>" is successfully uploaded. <a class="linkl11" target="_blank" href="<?=FLNK.$filename?>">Open file<img src="<?=IMGR?>link.png" border="0"/></a>
</p>
<?php } else {?>
<b>File canceled: </b><?=$errormsg?>
<?php }?>
</div>
<div id="posbtn" style="width:430px;text-align:center;padding-top:20px">
<input type="button" class="btnx" onclick="parent.pf_files('u',0,<?=($cerr>0?"false":"true")?>)" value="  OK  "/>
</div>
</form>
<script type="text/javascript" language="javascript">
	parent.change_uform(<?=($cerr>0?85:100)?>);
</script>
</form>
</body>
</html>