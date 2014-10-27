<?php
$APP_HOMETITLE='Home';
for($i=0;$i<count($APP_PAGES);$i++){
	if($APP_PAGES[$i]['tileset']['slide']==$APP_CSLIDE)$APP_HOMETITLE=$APP_PAGES[$i]['tileset']['title'];
}
$api=explode("|",$APP_PLUGIN);
$api_flot_cat=false;
$api_flot_pie=false;
$apli_tmce=false;
for($i=0;$i<count($api);$i++){
if($api[$i]=='flot')$api_flot=true;
if($api[$i]=='flot_pie')$api_flot_pie=true;
if($api[$i]=='tinymce')$api_tmce=true;
}
$APP_TITLE=ucwords(strtolower($APP_TITLE));
?>
<html><head>
<title>SIADU :: <?=$APP_TITLE?></title>
<?php
require_once(SHAREDMAINSTYLE);
require_once(MODDIR.'fform/style.php');
require_once(MODDIR.'xtable/style.php');
if(!empty($APP_CSS)){echo '<style type="text/css">'.$APP_CSS.'</style>';}require_once(MODDIR.'control.php');?>
<script type="text/javascript" language="javascript" src="../shared/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jkquery.js"></script>
<?php if($api_flot){?>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.categories.js"></script>
<?php }?>
<?php if($api_flot_pie){?>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.pie.js"></script>
<?php }?>
<script type="text/javascript" language="javascript">
var HomeTitle="<?=ucwords(strtolower($APP_HOMETITLE))?>"; var pagetitle=new Array(); var tiletitle=new Array();
<?php 
foreach($APP_PAGES as $k=>$v){
	$n=count($APP_PAGES[$k]['pages']);
	for($i=0;$i<$n;$i++){
		$x=&$APP_PAGES[$k]['pages'][$i]['key'];
		$y=&$APP_PAGES[$k]['pages'][$i]['title'];
		echo 'pagetitle["'.$x.'"]="'.($y==''?ucwords(strtolower($x)):ucwords(strtolower($y))).'";';
	}
} $n=count($APP_PAGES); $ft="";
for($i=0;$i<$n;$i++){
	echo 'tiletitle["'.$APP_PAGES[$i]['tileset']['key'].'"]="'.$APP_PAGES[$i]['tileset']['title'].'";';
	$pos=intval($APP_PAGES[$i]['tileset']['pos']);
	if($pos>=0 && $pos<=1000) $ft.='fadeTileset('.$i.');';
}
echo 'function fadeTiles(){'.$ft.'}';
echo 'var CSLIDE='.$APP_CSLIDE.';';
echo 'var CSLIDE0='.$APP_CSLIDE.';';
echo 'var tpos=new Array();';
foreach($APP_PANEL_POS as $k=>$v){
	echo 'tpos['.$k.']="'.$v.'";';
}
?>
</script>
<script type="text/javascript" src="../shared/maincontrol.js"></script>
<script type="text/javascript" src="controller.js"></script>
<?php
if(isset($APP_CONTROLSCR) && !empty($APP_CONTROLSCR)){
	$n=count($APP_CONTROLSCR);
	for($i=0;$i<$n;$i++){ ?>
<script type="text/javascript" src="<?=$APP_CONTROLSCR[$i]?>"></script>
<?php }
}
?>
<?php if($api_tmce){?>
<script type="text/javascript" src="../shared/tinymce/tiny_mce.js"></script>
<?php }?>
</head><body >
<div id="topsection">
	<div id="logo"></div>
	<div id="ltitle"><?=$APP_TITLE?></div>
	<div id="tabmenu3" style="display:none"><button class="smbtn" title="" onclick="Logout()">Logout</button></div>
	<div id="tabmenu4" style="display:none">
		<button class="smbtn" title="Pengaturan akun" onclick="setting_open()">
			<div style="width:20px;height:20px;background:url('<?=IMGR?>userset.png') center no-repeat;"></div>
		</button>
	</div>
	<div id="tabmenu5" style="display:none"><table cellspacing="0" cellpadding="0"><tr height="24px"><td>
		<div id="userinformation" class="sfont" style="padding:0px 6px 0px 6px;color:#fff"></div>
	</td></tr></table></div>
	<div id="tabmenu2"><button class="smbtn" title="" onclick="jumpTo('../')">Start Menu</button></div>
	<div id="tabmenu"><ul id="tablist"></ul></div>
</div>
<div id="global" class="selectenabled">
<div id="cbox" style="display:none">
	
</div>
<div id="maincontainer" style="overflow:hidden">
	<input type="hidden" id="cpage" value="matapelajaran" />
	<div id="pagetitle" class="pagetitle" style="display:none"><?=$APP_HOMETITLE?></div>
	<div id="pagebox" style="display:none">
		<table width="100%" cellspacing="15px" cellpadding="0"><tr><td style="padding-top:5px">
			<div id="loader" style="display:none;position:relative;width:100%;text-align:center;background:url('<?=IMGR?>loader.gif') left top no-repeat"></div>
			<div id="page"></div>
		</td></tr></table>
	</div>
<div id="panel" style="display:none">
</div>
<?php require_once(MODDIR.'login.php');?>
</div>
</div>
<?php include(MODDIR.'xtable/html.php');?>
<?php $xtableid=2; include(MODDIR.'xtable/html.php');?>
<?php $xtableid=3; include(MODDIR.'xtable/html.php');?>
<?php include(MODDIR.'fform/html.php'); ?>
<?php $fformid=2; include(MODDIR.'fform/html.php'); ?>
<?php $fformid=3; include(MODDIR.'fform/html.php'); ?>
<div id="pagepreview">
</div>
<textarea id="fformload" style="display:none">
<?php
echo '<table cellspacing="0" cellpadding="0" width="100%"><tr>',
		'<td id="fformt" align="center" style="padding-top:150px">',
		'<div id="fformbox" class="fformbox" style="padding:5px;width:400px">',
		'<div class="fformtitle"><span style="margin-left:-2px;float:left">###</span><div id="ffload" class="ffload" style=""></div></div>',
		'</div></td></tr></table>';
?>
</textarea>
<div id="copyright"></div>
<input type="hidden" id="body_mouse_x" value="0" />
<input type="hidden" id="body_mouse_y" value="0" />
<div id="box_global_empty" style="position:absolute;top:0px;left:0px">
<div id="tmpbox_stock" class="sfont" style="display:none;position:absolute;top:0px;left:0px;width:24px;font-size:11px;padding:1px;border:1px solid #999;background:#ffff00;text-align:center;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;box-shadow:0px 2px 4px rgba(0,0,0,0.5)" onmouseup="jadwal_sks_drop()"></div>
</div>
<div id="box_global_info" style="position:absolute;top:0px;left:0px;width:100%;background:#ffff00" class="sfont" style="font-size:11px">
</div>
<?php // notifbox() ?>
</body></html>