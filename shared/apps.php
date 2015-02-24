<?php
	$app  =gpost('app');
	$act  =gpost('act');
	$cid  =gpost('id');
	$page =gpost('page');
	if($app=='panel'){
		require_once(MODDIR.'panel.php');
		$tilecount=1; 
		panel_draw();
	}else if($app=='menu'){
		app_menu();
	}else if($app=='view'){
		require_once(MODDIR.'xtable/xtable.php'); 
		require_once(MODDIR.'control.php');
		//sleep(1);
		app_page_view();
	}else if($app=='checkuser'){
		app_checkuser();
	}else if($app=='urut'){
		if($act=='up') 
			urut_up(gpost('table'),$cid);
		else if($act=='dn') 
			urut_dn(gpost('table'),$cid);
		require_once(MODDIR.'control.php'); 
		require_once(MODDIR.'xtable/xtable.php'); 
		$opt = gpost('opt');
		require_once(VWDIR.gpost('page').'.php');
	}else if($app=='notifbox'){
		notifbox();
	}else if($app=='gpage_tab'){
		require_once(MODDIR.'xtable/xtable.php'); 
		require_once(MODDIR.'control.php');
		require_once(MODDIR.'gpage.php');
		gpage_tab_show($page);
	}
?>