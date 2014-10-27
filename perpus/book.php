<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

/** Page Personalization **/
$search_txt="find book...";
$search_action=RLNK."bookshelf.php";
$act=gets('act');
$act=in_array($act,Array('new','view','add','edit','rev'))?$act:'';
$tab=gets('tab');
if($tab!=''){
$tab=in_array($tab,Array('manage','author','publisher','class','language'))?$tab:'';
}
$cview="b_".$tab;  // current view
$ct_bg="";
$ct_title="Book shelf";
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript" language="javascript">
function retDetail(a){
	_('pb_detail&cid='+a,function(r){E('book_info').innerHTML=r;ffade('book_info',0.3)});
	//E('book_info').style.opacity='1';
}
function getBookDetail(a){
	var cid=E('bookid').value;
	if(cid!=a){
	E('book_info').style.opacity='0.25';
	setTimeout("retDetail("+a+")",250);
	}
}
</script>
</head><body>
<?php require_once(FMDIR.'left.php');?>
<?php require_once(FMDIR.'banner.php');?>
<div class="tviewx"><div style="margin-top:10px;cursor:default"><?php
$actt=Array('rev'=>' &raquo; Edit book','edit'=>' &raquo; Edit catalog','add'=>' &raquo; Add new book','view'=>' &raquo; View book','new'=>' &raquo; New catalog');
$xtab=$tab==""?"":strtoupper(substr($tab,0,1)).substr($tab,1);
$ct_title.=($tab!=''?' &raquo; <a class="linkb" href="'.RLNK.'bookshelf.php?tab='.$tab.'">'.$xtab.'</a>':'').$actt[$act];
echo $ct_title;
?></div></div>
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
.viewopt {
	height:18px;border:none;padding:0 0 0 24px;margin:0 4px 12px 0;font: 13px 'Segoe UI',Verdana;cursor:pointer;
	color: #999;
}
.viewopt:hover{
	color: #303942;
}
.viewopta {
	height:18px;border:none;padding:0 0 0 24px;margin:0 4px 12px 0;font:bold 13px 'Segoe UI',Verdana;
	color: #1c64d1;
}
</style>
<div id="maincontainer">
	<?php 
		$tab=gets('tab');
		if($tab=='new'){
		require_once(VWDIR.'p_book_new.php');
		} else if($tab=='edit'){
		require_once(VWDIR.'p_book_edit.php');
		} else if($tab=='manage'){
		$cview="b_manage";
		require_once(VWDIR.'p_book_manage.php');
		} else {
		require_once(VWDIR.'p_book.php');
		}
		?>
</div>

</body></html>