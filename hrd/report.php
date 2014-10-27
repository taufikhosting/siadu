<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="report";  // current view
$ct_bg="conico.png";
$ct_title="Reports";

/** Global Variables **/
$mstr_status=MstrGet("mstr_status",true,"any status");
$mstr_level=MstrGet("mstr_level",true,"any level");
$mstr_group=MstrGet("mstr_group",true,"any group");
$mstr_division=MstrGet("mstr_division",true,"any division");
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'preferences.php');?>
<style type="text/css">
.pdiv{
	font:11px Verdana,Tahoma,Arial;line-height:200%;color:#303942
}
.ptracknumber {
	width:24px;
	height:24px;
	background:url('<?=IMGR?>ptracknumber.png') center no-repeat;
	color:#ffffff !important;
	font:bold 12px Verdana,Tahoma,Arial;
	padding-right:2px;
}
.ptracktext{
	font:bold 11px Verdana,Tahoma,Arial;
	color:#008ee8;
	padding-left:5px;
	width:140px
}
.ptracknumber0 {
	width:24px;
	height:24px;
	background:url('<?=IMGR?>ptracknumber0.png') center no-repeat;
	color:#ffffff !important;
	font:bold 12px Verdana,Tahoma,Arial;
	padding-right:2px;
}
.ptracktext0{
	font:bold 11px Verdana,Tahoma,Arial;
	color:#c7c7c7;
	padding-left:5px;
	width:140px
}
.findbtn {
	width:21px;
	height:21px;
	background:url('<?=IMGR?>ffind.png') no-repeat;
	background-position:0 0;
	cursor:pointer;
	border:none;
}
.findbtn:hover {
	background-position:0 -21px;
}
.findbtn:active {
	background-position:0 -42px;
}
.listtable tr td{
	font:11px Verdana, Tahoma;
	color:#303942;
}
.listtable tr{
	height:24px;
}
</style>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top"><?php require_once(VWDIR.'banner.php');?></tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr>
		<td><?php require_once(VWDIR.'tabs.php');?></td>
		<td align="right"><?php require_once(WGDIR.'search.php');?></td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="ct_box"> 
			<form name="report_form" style="margin:0;padding:0;display:none" method="post" action="reporting.php">
				<input type="hidden" id="report_type" name="report_type" value="0"/>
			</form>
			<div class="tview" style="margin-bottom:10px"><b><?=$ct_title.(gets('type')==""?"":" - <span style=\"font-size:24px;font-weight:normal\">".gets('type')."</span>")?></b></div>
			<!-- ========= CONTENT ========= -->
			<?php
			$type=gets('type');
			if($type=='Individual'){
				require_once(VWDIR.'r_individual.php');
			} else if($type=='Collective'){
				require_once(VWDIR.'r_collective.php');
			} else {
				require_once(VWDIR.'r_select.php');
			}
			?>
			</div><br/><br/><br/>
			<!-- ========= END OF CONTENT ========= -->
			</div>
		</td>
	</tr>
	</table>
</td></tr>
</table>
<?php require_once(VWDIR.'footer.php');?>
</div>
<div id="fform_bg" style="display:none;opacity:0"></div>
<div id="fform" style="display:none;opacity:0"></div>
<div id="flog" style="display:none;position:fixed;top:0px;left:0px;width:100%;height:20px;background:rgba(0,0,0,0.55);color:#ffffff"></div>
</body>
</html>