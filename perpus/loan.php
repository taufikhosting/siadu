<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find book...";
$search_action=RLNK."employee.php";
$tab=gets('tab');
$tab=in_array($tab,Array('label','stopname'))?$tab:"loan";
$cview="b_".$tab;  // current view
$ct_bg="";
if($tab=='label'){
$ct_title="Print label";
} else {
$ct_title="Circulation";
}
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'preferences.php');?>
<?php require_once(SYDIR.'pagelink.php');?>
<style type="text/css">
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
<script type="text/javascript" language="javascript">
/***** Pop Box *****/
function open_popbox(a){
	E('popd_'+a).style.position='relative';
	E('popb_'+a).style.display=''; E('popx_'+a).style.display='';
	E('popi_'+a).focus();
}
function close_popbox(a){
	E('popb_'+a).style.display='none'; E('popx_'+a).style.display='none';
	E('popd_'+a).style.position='static';
	E('popi_'+a).value='';
}
function ffade(a,o){
	E(a).style.opacity=o;
	if(o<1.0){
		o+=0.1;
		setTimeout("ffade('"+a+"',"+o+")",20);
	}
}
function popbox_save(a,b){
	var v=E('popi_'+a).value;
	_('popbox&t='+a+'&opt=a&v='+v,function(r){E(a).innerHTML=r;close_popbox(a);b()});
}
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
<div id="maincontainer">
<div class="tviewx"><div style="margin:15px 0 0 0;"><span style="font:bold 20px 'Segoe UI', Verdana, Tahoma, sans-serif"><?=$ct_title?></span><?=(gets('mid')!=''?" &raquo; Loan":"")?></div></div>
<div id="contentwrapper" style=""><div id="contentcolumn">
<div id="ct_box_wrapper">
	<div id="ct_box">
	<!-- ========= CONTENT ========= -->
	<div id="prefbox" style="width:100%">
		<?php
			$mid=gets('mid');
			if($mid!=''){
				require_once(VWDIR.'b_loan_trans.php');
			} else {
				require_once(VWDIR.'b_loan.php');
			}
		?>
	</div><br/><br/><br/>
	<!-- ========= END OF CONTENT ========= -->
	</div>
</div>
</div>
</div>
<div id="leftcolumn" style="height:100%;background:#ffffff;top:80px;left:0px;">
	<?php require_once(VWDIR.'left.php');?>
</div>

<div id="topsection" style="position:fixed;width:100%"><div class="innertube">
	<?php require_once(VWDIR.'banner.php');?>
</div></div>
</div>
</body>
</html>