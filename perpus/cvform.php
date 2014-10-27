<?php
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
?>
<html>
<head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<style type="text/css">
.btn2 {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
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
	function acceptTitle(a){
		if(a=='') a='Untitled';
		else a='<i>'+a+'</i>';
		E('cvtitle').innerHTML=a;
	}
</script>
</head>
<body style="margin:0;padding:0;">
<form name="regform" id="regform" enctype="multipart/form-data" action="cvreq.php" method="post" style="margin:0;padding:0;display:">
<input type="hidden" name="isImgOK" value="No" />
<input type="hidden" name="fname" value="<?=gets('name')?>" />
<input type="hidden" name="dcid" value="<?=gets('id')?>" />
<?php if(gets('img')==''){ $title=gets('title'); if($title!='') $title=str_replace("\\","",$title); else $title="Untitled";?>
<div id="pf_photo" style="width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat">
	<div style="width:104px;height:138px;background:url('<?=IMGC?>default.jpg') center top no-repeat">
	<div style="font:bold 14px 'Cambria',Verdana;color:#fff;text-align:center;width:76px;padding:24px 6px 6px 14px">
		<div id="cvtitle" style="width:80px;background:;padding:2px 2px"><?=$title?></div>
	</div>
	</div>
</div>
<?php } else {?>
<div id="pf_photo" style="width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat">
	<div style="width:104px;height:138px;background:url('<?=IMGC.gets('img')?>') center top no-repeat">
	<img src="<?=IMGC?>cvshade.png"/>
	</div>
</div>
<span id="cvtitle" style="display:hidden"></span>
<?php }?>
<div style="position:relative;width:250px;height:40px;margin-top:5px">
<?php if(gets('img')==''){?>
<button id="fakebtn" class="btn" style="position:absolute;top:0px;left:0px">
	Add cover image
</button>
<?php } else {?>
<button id="fakebtn" class="btn" style="position:absolute;top:0px;left:4px">
	Change cover
</button>
<?php }?>
<input id="upload" type="file" name="file" style="cursor:default;opacity:0;position:absolute;top:0px;left:-130px;width:300px" onchange="doSubmit()" onmouseover="E('fakebtn').className='btn2'" onmouseout="E('fakebtn').className='btn'"/>
</div>
</form>
<div id="pf_photo" style="width:104px">
<center><img id="loader" style="display:none;margin-top:40px" src="<?=IMGR?>loader2.gif"/></center>
</div>
</body>
</html>