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

			$fname=$_FILES["file"]["name"];
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
		parent.pf_train_file('');
		document.location='trform.php';
	}
</script>
</head>
<body style="padding:0;margin:0">
<div class="sfont" id="imessage" style="220px;height:25px;padding-top:3px">
<?php if($cerr==0){ $fname=(strlen($fname)>28)?substr($fname,0,23)."...".$extension:$fname;?>
<div onclick="remfile()" class="atch" title="Remove"><?=$fname?> <button class="rembtn" style="float:right"></button></div>
<?php } else {?>

<?php }?>
</div>
<script type="text/javascript" language="javascript">
<?php if($cerr==0){?>
	parent.pf_train_file('<?=$filename?>');
<?php } else {?>
alert('<?=$errormsg?>');
document.location='trform.php';
<?php }?>
</script>
</form>
</body>
</html>