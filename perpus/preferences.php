<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="preferences";  // current view
$ct_bg="";
$ct_title="Books shelf";
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'preferences.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
</head><body>
<div id="maincontainer">

<div id="topsection" style="position:fixed;width:100%"><div class="innertube">
	<?php require_once(VWDIR.'banner.php');?>
</div></div>

<div class="tviewx"><div style="margin:15px 0 0 0;"><span style="font:bold 20px 'Segoe UI', Verdana, Tahoma, sans-serif"><?=$ct_title?></span> &raquo; New Book</div></div>
<div id="contentwrapper" style=""><div id="contentcolumn"><div class="innertube">
<div id="ct_box_wrapper">
	<div id="ct_box">
	<!-- ========= CONTENT ========= -->
	<div id="prefbox" style="width:800px">
		<?php require_once(VWDIR.'p_book_new.php');?>
	</div><br/><br/><br/>
	<!-- ========= END OF CONTENT ========= -->
	</div>
</div>
</div>
</div>
</div>
<div id="leftcolumn" style="background:#ffffff;top:110px;left:0px;">
	<?php require_once(VWDIR.'left.php');?>
</div>
<div class="shadew" style="width:100%;position:fixed;margin-left:180px;margin-top:136px"></div>

</div>
</body>
</html>