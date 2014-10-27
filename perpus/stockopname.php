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
$tab=in_array($tab,Array('history','init','cek','note','sum','report','language'))?$tab:'';
$cview="b_stopname";  // current view
$ct_bg="";
$ct_title="Stock opname";
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
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
<div id="maincontainer"><table cellspacing="0" cellpadding="0" style="margin-top:60px"><tr valign="top">
<td>
<?php require_once(FMDIR.'left.php');?>
</td>
<td>
<div id="maincontainer">	<?php
	$pass=true;
	if($tab=='history'){
		$pass=false;
		require_once(VWDIR.'v_stock_his.php');
	}
	else if($tab=='report'){
		$nid=intval(addslashes(gets('nid')));
		$t=dbSel("*","so_history","W/ dcid='$nid' AND status='3' LIMIT 0,1");
		$n=mysql_num_rows($t);
		if($n>0){ $pass=false;
			require_once(VWDIR.'v_stock_print.php');
		}
	}
	else if($tab=='init'){
		$t=dbSel("*","so_history","W/status='1' OR status='2'");
		$nso=mysql_num_rows($t);
		if($nso>0) {$r=dbFA($t); //echo ($r['status']==3?"OK":"(".$r['status'].")");
		}
		if($nso==0){
			$pass=false;
			require_once(VWDIR.'v_stock_init.php');
		}
	}
	else if($tab=='cek'){
		$t=dbSel("*","so_history","W/status='1' OR status='2' LIMIT 0,1");
		$nso=mysql_num_rows($t);
		if($nso==1){
			$pass=false;
			require_once(VWDIR.'v_stock_cek.php');
			require_once(MODDIR.'fform.php');
		}
	}
	else if($tab=='note'){
		$t=dbSel("*","so_history","W/status='1' OR status='2' LIMIT 0,1");
		$nso=mysql_num_rows($t);
		//echo $nso;
		if($nso==1){
			$pass=false;
			require_once(SVDIR.'s_stock_lost.php');
			require_once(VWDIR.'v_stock_syc.php');
			require_once(MODDIR.'fform.php');
		}
	}
	else if($tab=='sum'){
		$t=dbSel("*","so_history","W/status='3' LIMIT 0,1");
		$nso=mysql_num_rows($t);
		//echo $nso;
		if($nso==1){
			$pass=false;
			require_once(VWDIR.'v_stock_sum.php');
		}
	}
	if($pass){
		$act='';
		$tab='';
		$t=dbSel("*","so_history","W/status!='0' AND status!='4'");
		$nso=mysql_num_rows($t);
		require_once(VWDIR.'v_stock.php');
	}
	?>
</div>
</td>
</tr></table>
<div class="tviewx"><div style="margin-top:10px"><?php
$actt=Array('rev'=>' &raquo; Edit book','edit'=>' &raquo; Edit catalog','add'=>' &raquo; Add new book','view'=>' &raquo; View book');
$xtab=Array('init'=>'Initialize stock take','history'=>'History','cek'=>'Books checking','note'=>'Books checking','sum'=>'Books checking','report'=>'Report');
$ct_title='Tools &raquo; <a class="linkb2" href="'.RLNK.'stockopname.php">'.$ct_title.'</a>&nbsp;';
$ct_title.=($tab!=''?'&raquo; <span style="color:#999">'.$xtab[$tab].'</span>':'').$actt[$act];
echo $ct_title;
?></div></div>
</body></html>