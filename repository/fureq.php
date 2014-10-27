<?php
require_once('../shared/config.php');
require_once('system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');

$filedesc=gpost('description');

/* File Upload */
$errormsg=""; $cerr=0; $imagedata="";
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
		if($_FILES["file"]["size"] < 5000000){
			//$errormsg="Upload: " . $_FILES["file"]["name"] . "<br>";
			//$errormsg="Type: " . $_FILES["file"]["type"] . "<br>";
			//$errormsg="Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//$errormsg="Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			//$filename=$_FILES["file"]["name"];
			$filename=$_FILES["file"]["name"];
			$fname=$filename;
			$ufile=date("YmdHis").'.'.$extension;
			$filepath=FILEDIR.$ufile;
			if (file_exists($filepath))
			{
				$cerr++;
				$errormsg= $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
				//$file=
				//$dcid=gpost('dcid');
				//$description=gpost('description');
				//dbInsert("emp_files",Array('empid'=>$dcid,'description'=>$description,'file'=>$filename,'type'=>$extension));
				//$errormsg= "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
		else
		{
			$cerr++;
			$errormsg="Ukuran file melebihi batas ukuran file maksimum (5 MB).";
		}
	}
}
else
{
	$cerr++;
	$errormsg= "Tipe file tidak didukung.";
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
		parent.getFile('');
		document.location='fuform.php';
	}
</script>
</head>
<body style="padding:0;margin:0">
<div class="sfont" id="imessage" style="width:220px;height:21px;padding-top:3px">
<?php if($cerr==0){ $filename=(strlen($filename)>28)?substr($filename,0,23)."...".$extension:$filename;?>
<div onclick="remfile()" class="atch" title="Hapus file"><?=$filename?> <button class="rembtn" style="float:right"></button></div>
<?php } else {?>

<?php }?>
</div>
<script type="text/javascript" language="javascript">
<?php if($cerr==0){?>
	parent.getFile("<?=$ufile?>","<?=$fname?>");
<?php } else {?>
alert('<?=$errormsg?>');
document.location='fuform.php';
<?php }?>
</script>
</form>
</body>
</html>