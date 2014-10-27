<html>
<head>
<style type="text/css">
.iText{
	<?=SFONT12?>
    border:1px solid #c2c2c2;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px 4px;
	margin:0;
	height:21px;
	outline:none;
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
.btn2 {
	height:24px;
	padding:0 6px 1px 6px;
	background-color: #dfdfdf;background:-webkit-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-moz-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-ms-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-o-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
</style>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript" language="javascript">
	function doSubmit(){
		document.getElementById('loader').style.display='';
		document.getElementById('regform').style.display='none';
		//parent.change_uform(100);
		setTimeout("document.regform.submit()",250);
	}
</script>
</head>
<body style="margin:0;padding:0;">
<?php
$lang=admin_getLang();
if($lang=='en')$lbl='Browse image';
else $lbl='Ambil foto';
?>
<form name="regform" id="regform" enctype="multipart/form-data" action="trreq.php?ow=<?=$_GET['ow']?>&oh=<?=$_GET['oh']?>&rel=<?=$_GET['rel']?>" method="post" style="margin:0;padding:0;display:">
<div style="position:relative;width:250px;height:40px">
<button id="fakebtn" class="btn" style="position:absolute;top:0px;left:0px">
	<div style="background:url('<?=IMGR?>bi_photo.png') no-repeat;padding-left:16px"><?=$lbl?></div>
</button>
<input id="upload" type="file" name="file" style="cursor:default;opacity:0;position:absolute;top:0px;left:-130px;width:300px" onchange="doSubmit()" onmouseover="E('fakebtn').className='btn2'" onmouseout="E('fakebtn').className='btn'"/>
</div>
</form>
<center><img id="loader" style="display:none;margin-top:6px" src="<?=IMGR?>load.gif"/></center>
</body>
</html>