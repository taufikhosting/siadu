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
if($tab!=''){
$tab=in_array($tab,Array('catalog','author','publisher','class','language'))?$tab:'class';
} else $tab='catalog';
$cview="b_".$tab;  // current view
$ct_bg="";
$ct_title="Bibliographic";
?>
<html><head>
<?php require_once(SYDIR.'main.php');?>
<?php require_once(MODDIR.'control.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
<?php require_once(FMDIR.'banner.php');?>
<div class="tviewx"><div style="margin-top:10px;cursor:default"><?php
$actt=Array('rev'=>' &raquo; Edit book','edit'=>' &raquo; Edit catalog','add'=>' &raquo; Add new book','view'=>' &raquo; View book','new'=>' &raquo; New catalog');
$xtab=$tab==""?"":strtoupper(substr($tab,0,1)).substr($tab,1);
$ct_title.=($tab!=''?' &raquo; <a class="linkb" href="'.RLNK.'bibliographic.php?tab='.$tab.'">'.$xtab.'</a>':'').$actt[$act];
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
</style>
<table cellspacing="0" cellpadding="0" style="margin-top:60px"><tr valign="top">
<td>
<?php require_once(FMDIR.'left.php');?>
</td>
<td>
<div id="maincontainer">
	<div style="width:800px;border-bottom:1px solid #eaeaea;margin-bottom:30px">
		<table cellspacing="0" cellpadding="0"></tr>
			<td><a class="stab<?=($tab=="catalog"?"_act":"")?>" href="<?=RLNK?>bibliographic.php?tab=catalog">Catalog</div></td>
			<td><a class="stab<?=($tab=="author"?"_act":"")?>" style="margin-left:30px" href="<?=RLNK?>bibliographic.php?tab=author">Author</div></td>
			<td><a class="stab<?=($tab=="publisher"?"_act":"")?>" style="margin-left:30px" href="<?=RLNK?>bibliographic.php?tab=publisher">Publisher</a></td>
			<td><a class="stab<?=($tab=="class"?"_act":"")?>" style="margin-left:30px" href="<?=RLNK?>bibliographic.php?tab=class">Class</a></td>
			<td><a class="stab<?=($tab=="language"?"_act":"")?>" style="margin-left:30px" href="<?=RLNK?>bibliographic.php?tab=language">Language</a></td>
		</tr></table>
	</div>
	<?php
	if($tab=='catalog'){
		$pass=true;
		
		if($act=='new'){$pass=false;
			require_once(VWDIR.'v_catalog_new.php');
			require_once(MODDIR.'fform.php');
		}
		else if($act=='add'||$act=='edit'||$act=='view'){
			$nid=intval(gets('nid'));
			if($nid>0){
				$t=mysql_query("SELECT * FROM catalog WHERE dcid='$nid' LIMIT 0,1");
				if(mysql_num_rows($t)==1){ $pass=false;
					if($act=='view'){
						require_once(SVDIR.'s_catalog_view.php');
						echo '<div id="tcatalog">';
						require_once(VWDIR.'v_catalog_view.php');
						echo '</div>';
					} else {
						require_once(VWDIR.'v_catalog_'.$act.'.php');
					}
					require_once(MODDIR.'fform.php');
				}
			}
		} else if($act=='rev'){
			$nid=intval(gets('nid'));
			if($nid>0){
				$t=mysql_query("SELECT * FROM book WHERE dcid='$nid' LIMIT 0,1");
				if(mysql_num_rows($t)==1){ $pass=false;
					require_once(VWDIR.'v_catalog_rev.php');
					require_once(MODDIR.'fform.php');
				}
			}
		}
		if($pass){
			require_once(SVDIR.'s_catalog.php');
			echo '<div id="tcatalog">';
			require_once(VWDIR.'v_catalog.php');
			echo '</div>';
			require_once(MODDIR.'fform.php');
		}
	}
	else if($tab=='author'){
		require_once(SVDIR.'s_author.php');
		require_once(MODDIR.'masterdb.php');
		require_once(MODDIR.'control.php');
		require_once(MODDIR.'pagelink.php');
		require_once(SYDIR.'xtable.php');
		require_once(WGDIR.'optionbtn.php');
		echo '<div id="tauthor">';
		require_once(VWDIR.'v_author.php');
		echo '</div>';
		require_once(MODDIR.'fform.php');
	}
	else if($tab=='publisher'){
		require_once(SVDIR.'s_publisher.php');
		require_once(MODDIR.'masterdb.php');
		require_once(MODDIR.'control.php');
		require_once(MODDIR.'pagelink.php');
		require_once(SYDIR.'xtable.php');
		require_once(WGDIR.'optionbtn.php');
		echo '<div id="tauthor">';
		require_once(VWDIR.'v_publisher.php');
		echo '</div>';
		require_once(MODDIR.'fform.php');
	}
	else if($tab=='class'){
		require_once(SVDIR.'s_class.php');
		require_once(MODDIR.'masterdb.php');
		require_once(MODDIR.'control.php');
		require_once(MODDIR.'pagelink.php');
		require_once(SYDIR.'xtable.php');
		require_once(WGDIR.'optionbtn.php');
		echo '<div id="tauthor">';
		require_once(VWDIR.'v_class.php');
		echo '</div>';
		require_once(MODDIR.'fform.php');
	}
	else if($tab=='language'){
		require_once(SVDIR.'s_language.php');
		require_once(MODDIR.'masterdb.php');
		require_once(MODDIR.'control.php');
		require_once(MODDIR.'pagelink.php');
		require_once(SYDIR.'xtable.php');
		require_once(WGDIR.'optionbtn.php');
		echo '<div id="tauthor">';
		require_once(VWDIR.'v_language.php');
		echo '</div>';
		require_once(MODDIR.'fform.php');
	}
	?>
</div>
</td>
</tr></table>
</body></html>