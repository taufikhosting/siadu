<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

/** Page Personalization **/
$search_txt="find member name...";
$search_action=RLNK."members.php";
$act=gets('act');
$act=in_array($act,Array('view','loan','edit','rev'))?$act:'';
$tab=gets('tab');
if($tab!=''){
$tab=in_array($tab,Array('staff','student','other','class','language'))?$tab:'class';
} else $tab='catalog';
$cview="b_".$tab;  // current view
$ct_bg="";
$ct_title="Membership";
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
<?php require_once(FMDIR.'banner.php');?>
<table cellspacing="0" cellpadding="0" style="margin-top:60px"><tr valign="top">
<td>
<?php require_once(FMDIR.'left.php');?>
</td>
<td>
<div id="maincontainer">
	<?php
	$pass=true;
	if($tab=='staff'){
		if($act=='view'||$act=='loan'){
			$nid=gets('nid');
			if($nid!=''){if(intval($nid)>0){ $pass=false;
				$t=mysql_query("SELECT * FROM ".DB_HRD." WHERE nip='$nid' LIMIT 0,1");
				$n=dbNRow($t);
				if($n>0){ $pass=false;
					require_once(SVDIR.'s_staff_view.php');
					require_once(MODDIR.'masterdb.php');
					require_once(MODDIR.'control.php');
					require_once(SYDIR.'xtable.php');
					require_once(VWDIR.'v_staff_view.php');
					require_once(MODDIR.'fform.php');
				}
			}}
		}
		if($pass){
			require_once(SVDIR.'s_staff.php');
			require_once(MODDIR.'masterdb.php');
			require_once(MODDIR.'control.php');
			require_once(MODDIR.'pagelink.php');
			require_once(SYDIR.'xtable.php');
			require_once(WGDIR.'optionbtn.php');
			echo '<div id="tauthor">';
			require_once(VWDIR.'v_staff.php');
			echo '</div>';
			require_once(MODDIR.'fform.php');
		}
	}
	$_SESSION['newentry']='';
	$_SESSION['newentrymsg']='';
	?>
</div>
</td>
</tr></table>
<div class="tviewx"><div style="margin-top:10px;cursor:default"><?php
$actt=Array('view'=>' &raquo; View','loan'=>' &raquo; <a class="linkb" href="'.RLNK.'members.php?tab=staff&act=view&nid='.$nid.'">View</a> &raquo; Loan','add'=>' &raquo; Add new book','new'=>' &raquo; New catalog');
$xtab=$tab==""?"":strtoupper(substr($tab,0,1)).substr($tab,1);
$ct_title.=($tab!=''?' &raquo; <a class="linkb" href="'.RLNK.'members.php?tab='.$tab.'">'.$xtab.'</a>':'').$actt[$act];
echo $ct_title;
?></div></div>
</body></html>