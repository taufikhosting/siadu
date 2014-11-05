<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="preferences";  // current view
$ct_bg="pref.png";
$ct_title="Books shelf";
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'preferences.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<style type="text/css">
body{
	margin:0;
	padding:0;
	line-height: 1.5em;
}

b{font-size: 110%;}
em{color: red;}

#topsection{
<?=cssGrad("#1c6cd0 0px, #a7c2fa 700px, #a7c2fa 100%","#1c6cd0","top")?>
height: 80px; /*Height of top section*/
}

#topsection h1{
margin: 0;
padding-top: 15px;
}

#contentwrapper{
float: left;
width: 100%;
}

#contentcolumn{
margin-left: 200px; /*Set left margin to LeftColumnWidth*/
}

#leftcolumn{
width: 200px; /*Width of left column*/
background: #C8FC98;
position:fixed;
}

#footer{
clear: left;
width: 100%;
background: black;
color: #FFF;
text-align: center;
padding: 4px 0;
}

#footer a{
color: #FFFF80;
}

.innertube{
margin: 10px; /*Margins for inner DIV inside each column (to provide padding)*/
margin-top: 0;
}



.blueblock{
width: 180px;
padding: 0 0 1em 0;
font:12 px'Segoe UI','Trebuchet MS', 'Lucida Grande', Arial, sans-serif;
color: #303942;
}

* html .blueblock{ /*IE 6 only */
w\idth: 147px; /*Box model bug: 180px minus all left and right paddings for .blueblock */
}

.blueblock ul{
list-style: none;
margin: 0;
padding: 0;
border: none;
}

.blueblock li {
margin: 0;
}

.blueblock li a{
display: block;
padding: 5px 5px 5px 8px;
border-left: 5px solid #ffffff;
color: #999;
text-decoration: none;
width: 100%;
}
.blueblock li a:hover{
border-left: 5px solid #ffffff;
//background-color: #2586d7;
color: #303942;
}

.blueblock li .active{
display: block;
padding: 5px 5px 5px 8px;
border-left: 5px solid #1c64d1;
color: #303942;
text-decoration: none;
width: 100%;
}

.blueblock li .active table tr td{
font: 12px 'Segoe UI','Trebuchet MS', 'Lucida Grande', Arial, sans-serif !important;
color: #303942;
}

.blueblock li .active:hover{
border-left: 5px solid #1c64d1;
color: #303942;
}

html>body .blueblock li a{ /*Non IE6 width*/
width: auto;
}

.lianum{
	padding:1px 5px;
	background:#2c74d1;
	border-radius:10px;
	font-size:10px;
	color:#fff;
}

.shadew{
	height:30px;
	background:url('<?=IMGR?>shadew.png') repeat-x;
}
</style>

<script type="text/javascript">
/*** Temporary text filler function. Remove when deploying template. ***/
var gibberish=["This is just some filler text", "Welcome to Dynamic Drive CSS Library", "Demo content nothing to read here"]
function filltext(words){
for (var i=0; i<words; i++)
document.write(gibberish[Math.floor(Math.random()*3)]+" ")
}
</script>
</head><body>
<div id="maincontainer">

<div id="topsection" style="position:fixed;width:100%"><div class="innertube">
	<?php require_once(VWDIR.'banner.php');?>
</div></div>

<div class="tviewx"><div style="margin:15px 0 0 0;"><span style="font:bold 20px 'Segoe UI', Verdana, Tahoma, sans-serif"><?=$ct_title?></span> &raquo; New Book</div></div>
<div id="contentwrapper" style="background:#ffffff;margin-top:140px">
<div id="contentcolumn">
<div class="innertube;margin:50px 20px 10px 20px">
<div id="ct_box_wrapper">
	<div id="ct_box" style="padding:0;margin:10px 0px">
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