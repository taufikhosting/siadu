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
$act=in_array($act,Array('return','loan','findmember','rev'))?$act:'';
$tab=gets('tab');
if($tab!=''){
$tab=in_array($tab,Array('loan','return','fine'))?$tab:'history';
} else $tab='history';
$cview="b_".$tab;  // current view
$ct_bg="";
$ct_title="Circulation";
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
	require_once(SVDIR.'s_circulation.php');
	if($tab=='return'){
		if($act=='return'){
			$nid=trim(gets('nid'));
			if($nid!=''){if(preg_match("/^[0-9]+$/",$nid)){
				$t=mysql_query("SELECT * FROM ".DB_HRD." WHERE nip='$nid' LIMIT 0,1");
				$n=dbNRow($t);
				if($n>0){ $pass=false;
					require_once(MODDIR.'control.php');
					require_once(SYDIR.'xtable.php');
					require_once(VWDIR.'v_cir_return_book.php');
				}
			}}
		} else {
			$pass=false;
			require_once(MODDIR.'control.php');
			require_once(VWDIR.'v_cir_return_src.php');
		}
	}
	else if($tab=='loan'){
		if($act=='loan'){
			$nid=trim(gets('nid'));
			if($nid!=''){if(preg_match("/^[0-9]+$/",$nid)){
				$t=mysql_query("SELECT * FROM ".DB_HRD." WHERE nip='$nid' LIMIT 0,1");
				$n=dbNRow($t);
				if($n>0){ $pass=false;
					require_once(MODDIR.'control.php');
					require_once(SYDIR.'xtable.php');
					require_once(VWDIR.'v_cir_loan_book.php');
				}
			}}
		} else {
			$pass=false;
			require_once(MODDIR.'control.php');
			require_once(VWDIR.'v_cir_loan_src.php');
		}
	}
	else if($tab=='fine'){
		$pass=false;
		require_once(MODDIR.'pagelink.php');
		require_once(MODDIR.'control.php');
		require_once(SYDIR.'xtable.php');
		require_once(VWDIR.'v_cir_fine.php');
		/*echo '<div style="float:left;color:#999;font-size:12px;padding:10px;background:#f0f0f0"><span style="font-size:13px">This page is under construction :)</span><br/><br/>
		<i>Halaman ini akan memuat data denda member yang terlambat mengembalikan buku.<br/><br/>
		<span style="line-height:150%">NB: Untuk sementara perhitungan denda dihutung berdasarkan jumlah hari keeterlambatan termasuk hari libur.<br/>
		Rencananya nanti akan disinkronisasikan dengan kalender akademik pada bagian akademik jika memungkinkan.</span></i></div>';*/
	}
	if($pass){
		$tab='history'; $act='';
		require_once(MODDIR.'masterdb.php');
		require_once(MODDIR.'control.php');
		require_once(SYDIR.'xtable.php');
		echo '<div style="float:left;color:#999;font-size:12px;padding:10px;background:#f0f0f0"><span style="font-size:13px">This page is under construction :)</span><br/><br/>
		Halaman ini akan memuat history dari aktivitas peminjaman dan pengembalian buku.</i></div>';
		//require_once(VWDIR.'v_cir_loan.php');
	}
	require_once(MODDIR.'fform.php');
	$_SESSION['newentry']='';
	$_SESSION['newentrymsg']='';
	?>
</div>
</td>
</tr></table>
<div class="tviewx"><div style="margin-top:10px;cursor:default"><?php
$actt=Array('view'=>' &raquo; View','loan'=>' &raquo; find book','add'=>' &raquo; Add new book','new'=>' &raquo; New catalog');
$xtab=$tab==""?"":strtoupper(substr($tab,0,1)).substr($tab,1);
$ct_title.=($tab!=''?' &raquo; <a class="linkb" href="'.RLNK.'circulation.php?tab='.$tab.'">'.$xtab.'</a>':'').$actt[$act];
echo $ct_title;
?></div></div>
</body></html>