<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

/** Page Personalization **/
$search_txt="find book...";
$search_action=RLNK."book.php";
$act=gets('act');
$act=in_array($act,Array('new','view','add','edit','rev'))?$act:'';
$tab=gets('tab');
$tab=in_array($tab,Array('history','init','publisher','class','language'))?$tab:'';
$cview="b_label";  // current view
$ct_bg="";
$ct_title="Print label";
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
<div class="tviewx"><div style="margin-top:10px"><?php
$actt=Array('rev'=>' &raquo; Edit book','edit'=>' &raquo; Edit catalog','add'=>' &raquo; Add new book','view'=>' &raquo; View book');
$xtab=$tab==""?"":strtoupper(substr($tab,0,1)).substr($tab,1);
$ct_title='Tools &raquo; <a class="linkb" href="'.RLNK.'label.php">'.$ct_title.'</a>&nbsp;';
$ct_title.=($tab!=''?'&raquo; <a class="linkb" href="'.RLNK.'stockopname.php?tab='.$tab.'">'.$xtab.'</a>':'').$actt[$act];
echo $ct_title;
?></div></div>
<?php require_once(FMDIR.'banner.php');?>
<style type="text/css">
.stab_act{
	width:70px;padding:5px 0px;height:20px;text-decoration:none;font:bold 13px <?=SFONT?>;color:<?=CBLUE?>;display:block;border-bottom:3px solid <?=CBLUE?>;
	text-align:center;
}
.stab {
	width:70px;padding:5px 0px;height:20px;text-decoration:none;font:13px <?=SFONT?>;color:<?=CLGREY?>;display:block;border-bottom:3px solid #fff;
	text-align:center;
}
.stab:hover{
	color:<?=CDARK?>;
}
</style>
<table cellspacing="0" cellpadding="0" style="margin-top:60px"><tr valign="top">
<td>
<?php require_once(FMDIR.'left.php');?>
</td>
<td>
<div id="maincontainer">
	<?php
	$pass=true;
	if($pass){
		require_once(VWDIR.'v_label.php');
	}
	?>
</div>
</td>
</tr></table>
</body></html>