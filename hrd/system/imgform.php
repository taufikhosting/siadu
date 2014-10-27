<?php
require_once('db.php');
require_once('common.php');
?>
<html>
<head>
<?php require_once('style2.php');?>
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
	<input type="button" class="btn" onclick="parent.close_uform()" value="Batal"/>
	<input type="button" class="btnx" value="Upload" onclick="doSubmit()"/>
</div>
</form>
<center><img id="loader" style="display:none;margin-top:30px;" src="<?=IMGR?>load.gif"/></center>
</body>
</html>