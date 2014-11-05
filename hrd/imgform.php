<?php
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
?>
<html>
<head>
<style type="text/css">
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
<script type="text/javascript" language="javascript">
	function doSubmit(){
		document.getElementById('loader').style.display='';
		document.getElementById('regform').style.display='none';
		
		setTimeout("document.regform.submit()",250);
	}
</script>
</head>
<body>
<form name="regform" id="regform" enctype="multipart/form-data" action="imgreq.php" method="post" style="display:">
<input type="hidden" name="isImgOK" value="No" />
<input type="hidden" name="fname" value="<?=gets('name')?>" />
<table class="stable" cellspacing="0" cellpadding="3px" width="280px"><tr>
<td align="center"><input id="ifilex" type="file" name="file" style="width:280px"/></td>
</tr></table>
<div id="prebtn" style="width:280px;text-align:center;padding-top:20px">
	<input type="button" class="btn" onclick="parent.close_uform()" value="Cancel"/>
	<input type="button" class="btnx" value="Upload" onclick="doSubmit()"/>
</div>
</form>
<center><img id="loader" style="display:none;margin-top:30px;" src="<?=IMGR?>load.gif"/></center>
</body>
</html>