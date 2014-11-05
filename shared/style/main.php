<?php
function cssGradTop($a,$b){
	$rs ="background-color: ".$b.";";
	$rs.="background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(".$b."), to(".$a."));";
	$rs.="background:-webkit-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-moz-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-ms-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-o-linear-gradient(top, ".$a.", ".$b.");";
	return $rs;
}
function cssGrad($a,$b="",$d="bottom"){
	$rs ="background-color: ".$b.";";
	$rs.="background:-webkit-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-moz-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-ms-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-o-linear-gradient(".$d.", ".$a.");";
	return $rs;
}


//$q=mysql_query("SELECT val FROM seting WHERE replid='1'");
//$val=mysql_fetch_array($q);
//$sbg=$val['val'];
$sbg="bg5.jpg";

$panelbg=Array();
$panelbg["bg8.jpg"]="#4d9abb";
$panelbg["bg3.jpg"]="#1c4893";
$panelbg["bg4.jpg"]="#005c73";
$panelbg["bg9.jpg"]="#032f7a";
$panelbg["bg6.jpg"]="#94e12f";

$optbg=$panelbg[$sbg];

?>
<style type="text/css">
html,body,div,ul,ol,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,pre,form,p,blockquote,fieldset,input,hr {margin:0; padding:0;}
.selectenabled{
-webkit-user-select: auto;
-moz-user-select: -moz-auto;
-ms-user-select: auto;
user-select: auto;
}
.selectdiabled{
-webkit-user-select: none;
-moz-user-select: -moz-none;
-ms-user-select: none;
user-select: none;
}
h1,h2,h3,h4,h5,h6,pre,code,address,caption,cite,code,em,strong,th {font-size:1em; font-weight:normal; font-style:normal;}
ul,ol {list-style:none;}
fieldset,img,hr {border:none;}
caption,th {text-align:left;}
/*table {border-collapse:collapse; border-spacing:0;}*/
button::-moz-focus-inner{ padding:0; margin:0; border:0; }
/* --- Container --- */
html {
	margin:0; padding:0;line-height: 1.5em;
}
body {
	<?=SFONT11?>;
	margin:0;
	padding:0 0px;
	line-height: 1.5em;
	/*background:url('<?=IMGR?>bg3.jpg') center fixed;*/
	background:url('<?=IMGR.$sbg?>') center top fixed <?=$optbg?>;
}
form {
	margin:0;padding:0;
}
#global{
	float:left;
	width:100%;
}
#maincontainer{
	margin-right:0px;
	margin-left:0px;
	padding:50px 0px 0px 0px;
}
.psf12150{
	color:<?=CDARK?>;cursor:default;line-height:150% !important;<?=SFONT12?>
}
.psf12155{
	color:<?=CDARK?>;cursor:default;line-height:150% !important;margin-bottom:5px;<?=SFONT12?>
}
.psf12200{
	color:<?=CDARK?>;cursor:default;line-height:200% !important;<?=SFONT12?>
}
.psf12205{
	color:<?=CDARK?>;cursor:default;line-height:200% !important;margin-bottom:5px;<?=SFONT12?>
}
.sfont{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default
}
.sfont2{
	<?=SFONT14?>
	color:<?=CDARK?>;
	cursor:default
}
.vfont{
	<?=VFONT11?>
	color:<?=CDARK?>
}

/* --- Links --- */
.linkw{
	color:#fff;
	text-decoration:none;
}
.linkw:hover{
	text-decoration:underline;
}
.linkk {
	<?=SFONT12?>
	color:#1c6cd0;
	text-decoration:none;
	cursor:pointer;
}
.linkk:hover {
	text-decoration:underline;
}
.linkb {
	<?=SFONT12?>
	color:#468ad2;
	text-decoration:none;
	cursor:pointer;
}
.linkb:hover {
	text-decoration:underline;
}
.linkb2 {
	font-family:<?=SFONT?>;
	font-size:inherit;
	color:#468ad2;
	text-decoration:none;
	cursor:pointer;
}
.linkb2:hover {
	text-decoration:underline;
}
.find16 {
	width:16px;
	height:16px;
	background:url('<?=IMGR?>sfind.png')no-repeat;
	background-position:0px -32px;
	cursor:pointer;
	border:none;
}
.find16:hover {
	background-position:0px -16px;
}
.find16:active {
	background-position:0px 0px;
}

.find21 {
	width:21px;
	height:21px;
	background:url('<?=IMGR?>ffind.png')no-repeat;
	background-position:0px 0px;
	cursor:pointer;
	border:none;
}
.find21:hover {
	background-position:0px -21px;
}
.find21:active {
	background-position:0px -42px;
}
/* ---------- BUTTONS ---------- */
.iform{
	margin:0;padding:0;
}
.obtna {
	height:21px;
	width:21px;
	padding:0;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:5px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.obtna:hover {
	<?=cssGrad("#e0e0e0 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .1);
}
.obtna:active {
	<?=cssGrad("#ffffff 0%, #ededed 4%, #ededed 96%, #d0d0d0 100%","#e2e2e2")?>
	box-shadow:none;
}
.btnz {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#008aff 0%, #1393ff 100%","#1c6cd0")?>
	border:1px solid #1c6cd0;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnz:hover{
	<?=cssGrad("#1795ff 0%, #27abff 100%","#1c6cd0")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btnz:active{
	<?=cssGrad("#1393ff 0%, #008aff 100%","#f0f0fa")?>
	box-shadow:none;
}

.btng {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#00c804 0%, #1ed900 100%","#00c804")?>
	border:1px solid #00b804;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btng:hover{
	<?=cssGrad("#00df05 0%, #20e400 100%","#00df05")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btng:active{
	<?=cssGrad("#1dcc02 0%, #1dcd00 100%","#1dcc02")?>
	box-shadow:none;
}

.btnr {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#e90000 0%, #ff1010 100%","#e90000")?>
	border:1px solid #e90000;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnr:hover{
	<?=cssGrad("#ff1b1b 0%, #ff3535 100%","#ff1b1b")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btnr:active{
	<?=cssGrad("#ec0000 0%, #ec0000 100%","#ec0000")?>
	box-shadow:none;
}

.btn {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn:hover {
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn:active {
	<?=cssGrad("#ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%","#e2e2e2")?>
	box-shadow:none;
}
.btn_c {
	padding:0 6px 1px 6px;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn_c:hover {
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn_c:active {
	<?=cssGrad("#ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%","#e2e2e2")?>
	box-shadow:none;
}
.btnc {
	padding:1px;
	height:11px;
}
.btni {
	padding:0px 0 1px 16px;
	height:11px;
}
.btnx {
	height:24px;
	min-width:60px;
	padding:0 10px 1px 10px;
	<?=cssGrad("#c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%","#40e62a")?>
	border:1px solid #33bb0a;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnx:hover {
	<?=cssGrad("#ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%","#4df337")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .25);
}
.btnx:active {
	<?=cssGrad("#a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%","#4df337")?>
	box-shadow:inset 0px 1px 3px rgba(0, 0, 0, .45);
}

.btns {
	height:24px;
	min-width:60px;
	padding:0 10px 1px 10px;
	<?=cssGrad("#2ac700 0%, #38ec00 100%","#38ec00")?>
	border:1px solid #2ac700;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btns:hover {
	<?=cssGrad("#2ac700 0%, #46ff0d 100%","#46ff0d")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .25);
}
.btns:active {
	<?=cssGrad("#2ac700 0%, #37dd03 100%","#37dd03")?>
	box-shadow:none;
}

.bi_arrow {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-9px -142px;
	padding-left:13px;
	text-align:left
}
.bi_arrowb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-8px -142px;
	width:10px;
}
.bi_arrow2 {
	background:url('<?=IMGR?>main.png') right center no-repeat;
	background-position:-9px -214px;
	padding-right:13px;
	text-align:left
}
.bi_arrow2x {
	background:url('<?=IMGR?>main.png?a1') right center no-repeat;
	padding-right:13px;
	text-align:left
}
.bi_arrow2ic{
	width:12px;
	height:13px;
	background:url('<?=IMGR?>main.png') right center no-repeat;
	background-position:-9px -214px;
}
.bi_arrow2b {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -214px;
	width:10px;
}
.bi_add {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -70px;
	padding-left:14px;
	text-align:left;
}
.bi_addb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -71px;
	width:10px;
}
.bi_edit {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -95px;
	padding-left:15px;
	text-align:left
}
.bi_editb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -94px;
	width:10px;
}
.bi_src {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -118px;
	padding-left:15px;
	text-align:left
}
.bi_srcb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -118px;
	width:10px;
}
.bi_del{
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -166px;
	padding-left:15px;
	text-align:left
}
.bi_delb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -166px;
	width:10px;
}
.bi_canb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -190px;
	width:10px;
}
.bi_pri {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -238px;
	padding-left:15px;
	text-align:left
}
.bi_prib {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -238px;
	width:12px;
}

.bi_fdlb {
	background:url('<?=IMGR?>main.png?xsd') no-repeat;
	background-position:-5px -765px;
	width:12px;
}

.bi_in {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -260px;
	padding-left:15px;
	text-align:left
}
.bi_inb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -260px;
	width:11px;
}
.bi_out {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -285px;
	padding-left:15px;
	text-align:left
}
.bi_outb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -285px;
	width:11px;
}
.bi_his {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -309px;
	padding-left:15px;
	text-align:left
}
.bi_lis {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -333px;
	padding-left:15px;
	text-align:left
}
.bi_lisb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -333px;
	width:11px;
}
.bi_usrb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -356px;
	width:11px;
}
.bi_usr2b {
	background:url('<?=IMGR?>main.png?asee') no-repeat;
	background-position:-7px -692px;
	width:11px;
}
.bi_rel {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -383px;
	padding-left:15px;
	text-align:left
}
.bi_relb {
	background:url('<?=IMGR?>main.png?asd') no-repeat;
	background-position:-5px -384px;
	width:13px;
	height:12px;
}
.bi_bin{
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -405px;
	padding-left:15px;
	text-align:left
}
.bi_binb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -405px;
	width:12px;
}
.bi_dnl {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -420px;
	padding-left:15px;
	text-align:left
}
.bi_dnlb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -420px;
	width:11px;
}

.bi_save {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -430px;
	padding-left:15px;
	text-align:left
}
.bi_saveb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -430px;
	width:12px;
}

.bi_help {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -440px;
	padding-left:15px;
	text-align:left
}
.bi_helpb {
	background:url('<?=IMGR?>main.png?asd') no-repeat;
	background-position:-5px -453px;
	width:14px;
	height:14px;
}
.bi_up {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -440px;
	padding-left:15px;
	text-align:left
}
.bi_upb {
	background:url('<?=IMGR?>main.png?asd') no-repeat;
	background-position:-5px -478px;
	width:14px;
	height:14px;
}
.bi_dn {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -440px;
	padding-left:15px;
	text-align:left
}
.bi_dnb {
	background:url('<?=IMGR?>main.png?asd') no-repeat;
	background-position:-5px -502px;
	width:14px;
	height:14px;
}
.bi_updn {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -440px;
	padding-left:15px;
	text-align:left
}
.bi_updnb {
	background:url('<?=IMGR?>main.png?add') no-repeat;
	background-position:-5px -526px;
	width:14px;
	height:14px;
}
.bi_cek {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -549px;
	padding-left:15px;
	text-align:left
}
.bi_updnb {
	background:url('<?=IMGR?>main.png?add') no-repeat;
	background-position:-5px -526px;
	width:14px;
	height:14px;
}

.bi_add2 {
	background:url('<?=IMGR?>main.png?adsada') no-repeat;
	background-position:-6px -573px;
	padding-left:15px;
	text-align:left
}

.bi_look {
	background:url('<?=IMGR?>main.png?adxx') no-repeat;
	background-position:-6px -620px;
	padding-left:16px;
	text-align:left
}
.bi_thumb {
	background:url('<?=IMGR?>main.png?asdkkk') no-repeat;
	background-position:-6px -669px;
	padding-left:15px;
	text-align:left
}

.bi_boxin{
	background:url('<?=IMGR?>main.png?asdkkk') no-repeat;
	background-position:-7px -406px;
	padding-left:15px;
	text-align:left
}

.bi_penfile {
	background:url('<?=IMGR?>main.png?alsdj567') no-repeat;
	
	padding-left:15px;
	text-align:left
}
.bi_penfileb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-7px -94px;
	width:10px;
}

.cplus {
	width:24px;
	height:24px;
	background:url('<?=IMGR?>cplus0.png') no-repeat;
	cursor:pointer;
	border:none;
}
.cplus:hover{
	background:url('<?=IMGR?>cplus1.png') no-repeat;
}
/* Leveling */
.hl0{
	font:18px <?=SFONT?>;
	color:<?=CBLUE?>;
	cursor:default;
}
.hl1{
	font:15px <?=SFONT?>;
	color:<?=CBLUE?>;
	cursor:default;
}
.hl2{
	<?=SFONT14?>
	color:<?=CDARK?>;
	cursor:default;
}
.hl3{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
}
.fgroup{
	font:14px <?=SFONT?>;
	cursor:default
	margin-top:6px;
	height:30px;
	width:100%;
	color:<?=CBLUE?>;
}

/*Table*/
.stable {
	border-collapse:collapse; border-spacing:0;
}
.stable tr td {
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
}
.stable24 tr {
	height:24px !important;
}
.stable24 td {
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
}
.stable26 tr {
	height:26px !important;
}
.stable26 td {
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
}
.ctable{
	margin:0 !important;
	padding:0 !important;
}
.ctable tr{
	margin:0 !important;
	padding:0 !important;
}
.ctable td{
	margin:0 !important;
	padding:0 !important;
}
.srow td{
	cursor:default;
}
.srow:hover{
	background:#f0f0f0;
}

/* Notif */
.notife{
	<?=SFONT12?>
	color:#ff0000;
}
.notifw{
	<?=SFONT12?>
	color:#ff8000;
}
.notifg{
	<?=SFONT12?>
	color:#00f000;
}
.notifb{
	<?=SFONT12?>
	color:<?=CBLUE?>;
}
.notifl{
	<?=SFONT12?>
	color:<?=CDARK?>;
}
/** Custom **/
.tbltopbar{
	float:left;
	margin-bottom:5px;
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	width:100%;
}
.tbltopbar button{
	margin-bottom:2px
}
.tbltopbar .lbl{
	float:left;
	margin-top:4px;
	margin-right:10px;
}
.tbltopmbar {
	float:left;
	width:100%;padding-bottom:5px;margin-bottom:10px
}
.infobox{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	padding:4px 9px 4px 21px;background:url('<?=IMGR?>info.png') 4px 6px no-repeat;
	float:left;
	line-height:150%;
	//border-radius:4px;
	//border:1px solid #01a8f7;
	margin-bottom:2px;
}
.infobox2{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	padding:4px 9px 4px 21px;background:url('<?=IMGR?>info.png') 4px 6px no-repeat;
	float:left;
	line-height:150%;
}
.warnbox{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	padding:4px 8px 4px 20px;border:1px solid #ffc000;border-radius:4px;background:url('<?=IMGR?>warn.png') 4px 5px no-repeat #fff8d6;
	line-height:150%;
	float:left;
}
.swarnbox{
	<?=SFONT12?>
	color:#ffde00;
	cursor:default;
	padding:4px 8px 4px 16px;background:url('<?=IMGR?>warn.png') 0px 5px no-repeat;
	line-height:150%;
}
.loader{
	width:16px; height:16px;
	background:url('<?=IMGR?>iclite.gif') center no-repeat;
}
.loader3{
	width:16px; height:16px;
	background:url('<?=IMGR?>iclite.gif') center no-repeat;
}
.xlabel{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	float:left;
	margin-top:4px;
	margin-bottom:0px;
}
.xlabelb{
	<?=SFONT12B?>
	color:<?=CDARK?>;
	cursor:default;
	float:left;
	margin-top:4px;
	margin-bottom:0px;
}
.xlbl{
	<?=SFONT12?>
	color:<?=CDARK?>;
	cursor:default;
	float:left;
	margin-bottom:2px;
}
.xlblb{
	<?=SFONT12B?>
	color:<?=CDARK?>;
	cursor:default;
	float:left;
	margin-bottom:4px;
}
.xrowl{
	margin-bottom:4px;
	width:100%;
	float:left;
}
.xrowl2{
	margin-bottom:4px;
	width:100%;
}
.flodiv {
	float:left;
}
.flodiv *{
	float:left;
}
.unflodiv *{
	float:left;
}
.unflodiv *{
	float:none !important;
}
/** Banner **/
#topsection {
	width:100%;
	float:left;
	overflow:hidden;
	color:#fff;
}
.tab_link {
	<?=SFONT12?>;
	color:#fff;
	text-decoration:none;
	display:block;height:16px;
	float:left;
	padding:2px 0 0 20px;
}
.tab_link:hover {
	text-decoration:underline;
}
#logo {
	height:32px;width:85px;
	background:url('<?=IMGR?>siadu_32.png') no-repeat;
	margin:10px;
	float:left;
}
#ltitle{
	float:left;
	color:#fff;
	font:18px <?=SFONT?>;
	margin-top:10px;
	cursor:default;
	margin-right:50px;
}
#tabmenu{
	float:left;
	margin-top:6px;
	margin-right:6px;
	position:relative;
	right:0px;
	list-style: none;
}
#tabmenu2{
	float:right;
	margin-top:8px;
	margin-right:6px;
	position:relative;
	right:0px;
	list-style: none;
}
#tabmenu3{
	float:right;
	margin-top:8px;
	margin-right:6px;
	position:relative;
	right:0px;
	list-style: none;
}
#tabmenu4{
	float:right;
	margin-top:8px;
	margin-right:4px;
	position:relative;
	right:0px;
	list-style: none;
}
#tabmenu5{
	float:right;
	margin-top:8px;
	margin-right:4px;
	position:relative;
	right:0px;
	list-style: none;
}
#tabmenu ul {
	list-style: none;
	margin: 0;
	padding: 0;
	border: none;
}
#tabmenu li {
	margin: 0;
	float:left;
	list-style: none;
}
#tabmenu li a {
	display: block;
	color: #fff;
	text-decoration: none;
	padding:2px 6px;
	margin:8px 4px 8px 0px;
	border-left-width:2px;
	border-left-style:solid;
	<?=SFONT12?>
}
#tabmenu li a:hover {
	color: #fff;
	background:#2171ca;
}
#tabmenu li .active {
	background:#fff;
	color:#2171ca;
}
#tabmenu li .active:hover {
	background:#fff;
	color:#2171ca;
}
/** Control **/
.iText{<?=VFONT11?>border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:0px 4px 2px 4px !important;margin:0;height:24px;outline:none;color:<?=CDARK?>}.iTextErr{<?=VFONT11?>border:1px solid #ff0000;-moz-border-radius:3px;border-radius:3px;padding:2px 4px !important;margin:0;height:24px;outline:none}.iTextx{<?=VFONT11?>border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:0px 4px 2px 4px !important;margin:0;height:24px;outline:none;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);color:<?=CDARK?>}.iTextA{<?=VFONT11?>border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;margin:0;outline:none;color:<?=CDARK?>}.iTextAx{<?=VFONT11?>border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;margin:0;outline:none;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);color:<?=CDARK?>}.iSelect{<?=VFONT11?>border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:2px;margin:0;height:24px;outline:none;color:#303942}.iSelectx{<?=VFONT11?>border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:2px;margin:0;height:24px;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);outline:none;color:#303942}.iCheck{padding:0;margin:0}
/** Page personalized **/
#barang_ib .xlabel{
	width:140px;
}
#barang_view .xrowl{
	<?=SFONT12?>
	color:<?=CDARK?>
}
#barang_view .plabel{
	width:140px;
	float:left;
}
#barang_view .pvalue{
	width:250px;
	float:left;
}
#barang_view .colon{
	width:8px;
	float:left;
}
#barang_view2 .xrowl{
	<?=SFONT12?>
	color:<?=CDARK?>
}
#barang_view2 .plabel{
	width:140px;
	float:left;
}
#barang_view2 .pvalue{
	width:250px;
	float:left;
}
#barang_view2 .colon{
	width:8px;
	float:left;
}
#pendataan_dots .xlabel{
	width:140px;
}
.xtaba{
	color:#777;padding:0px 4px 4px 4px;border-bottom:3px solid <?=CBLUE?>;float:left;margin-right:20px;cursor:pointer;<?=SFONT12?>
}
.xtaba:hover{color:#000}
.xtab{
	color:#777;padding:0px 4px 4px 4px;border-bottom:3px solid #fff;float:left;margin-right:4px;cursor:pointer;<?=SFONT12?>
}
.xtab:hover{color:#000}
.xtabbar{
	color:#646464;float:left;width:100%;border-bottom:1px solid #ddd;<?=SFONT12?>;margin-bottom:10px
}

.pagetitle{
	width:100%;
	font:24px <?=SFONTL?>;
	color:#fff;
	margin-bottom:10px;
	cursor:default;
	margin-left:20px;
}
.tileset{
	max-width:590px;
	margin-left:-4px;
	position:absolute;
}
.tileset *{
	float:left;
}
.tile{
	padding:15px 20px 40px 20px;
	color:#fff;
	margin:4px;
	display:block;
	text-decoration:none;
	height:80px !important
}
.tilebox{
	position:absolute;
	height:143px !important;
	border-radius:3px;
}
.tile:hover{
	box-shadow:0px 0px 6px rgba(0,0,0,0.75);
	//padding:9px 9px 19px 9px;
	margin:3px;
	border:1px solid #fff;
}
.tiletitle{
	font:22px <?=SFONTL?>;
	margin-bottom:12px
}
.tiletitle2{
	font:15px <?=SFONTL?>;
	margin-top:85px;
}
.tiledesc{
	<?=SFONT13?>;
}
.rarrow{
	margin-top:5px;
	//float:left;
	width:32px;height:32px;background:url('<?=IMGR?>rarrow0.png');
	cursor:pointer;
	position:absolute;
	top:0px;
}
.rarrow:hover{
	background:url('<?=IMGR?>rarrow1.png');
}
.larrow{
	margin-top:5px;
	//float:left;
	width:32px;height:32px;background:url('<?=IMGR?>larrow0.png');
	margin-right:8px;
	cursor:pointer;
	position:absolute;
	top:0px;
}
.larrow:hover{
	background:url('<?=IMGR?>larrow1.png');
}
#loginscreen{
	width:100%;
	position:relative;
	float:left;
	color:#fff;
	<?=SFONT12?>
	border-radius:3px;
	margin-bottom:10px;
	margin-top:10px;
	min-height:450px;
}
#panel{
	width:2000px;
	position:relative;
	float:left;
	height:430px;
	margin-left:20px;
}
#pagebox{
	width:100%;
	position:relative;
	float:left;
	color:#fff;
	<?=SFONT12?>
	/*background:rgba(255,255,255,0.95);*/
	background:#fff;
	border-radius:3px;
	/*box-shadow:0px 5px 10px rgba(0,0,0,0.80);*/
	margin-bottom:10px;
	margin-top:10px;
	min-height:450px;
}
#page{
	float:left;
	width:100%;
	min-height:450px;
}
#pagepreview{
	position:fixed;
	top:0px;left:0px;
	border:1px dotted #00f0ff;
	visibility:hidden;
}
.loader{
	position:relative;
	float:left;
	background:url('<?=IMGR?>loader8.gif') top left no-repeat;
	width:24px; height:24px;
}
#cbox{
	position:absolute;
	top:52px;
	left:0px;
	width:100%;
	background:#f4f4f4;
	min-height:800px
}

#optionbox{
	position:fixed;
	top:0px;
	right:-250px;
	width:250px;
	height:100%;
	background:<?=$optbg?>;
}
#optionclose{
	position:fixed;
	top:10px;
	right:-254px;
	width:16px;
	height:16px;
	background:url('<?=IMGR?>xclose.png') center no-repeat;
}
#optionbox img{
	cursor:pointer;
}
.loginbtn{
	width:24px;
	height:24px;
	border:none;
	background:url('<?=IMGR?>logarrow.png') center no-repeat #008287;
	float:left;
	cursor:pointer;
}
.loginbtn:hover{
	background-color:#00a1a7;
}
.smbtn{
	height:24px;
	border:none;
	/*background-color:#008287;*/
	background-color:#1c6cd0;
	float:left;
	cursor:pointer;
	color:#fff;
	border:1px solid #fff;
	<?=SFONT12?>
}
.smbtn:hover{
	/*background-color:#00a1a7;*/
	background-color:#2583f9;
}
.loginpswd{
	width:200px;
	height:24px;
	float:left;
	margin-right:4px;
	outline:none;
	padding:0px 4px;
	border:none;
	<?=SFONT12?>
}
#copyright{color:#fff;font:10px <?=VFONT?>;position:fixed;bottom:10px;left:0px;width:100%;text-align:right}
.fmark{color:#ff0000;float:right}

.sar_group_add{
	float:left;
	width:60px;
	cursor:pointer;
	margin:5px;
	padding-top:64px;
	background:url('<?=IMGR?>wh_add0.png') center no-repeat;
}
.sar_group_add:hover{
	background:url('<?=IMGR?>wh_add1.png') center no-repeat;
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
.scbcd{
	margin-left:6px;margin-right:6px;font:18px <?=SFONT?>; font-weight:bold;
	color: <?=CLBLUE?>;
	background:#faf8ff;
	border:1px solid #cacaca;
	border-radius:3px;
	padding:0 10px 0 10px;
	width:500px;
	height:28px;
	overflow:hidden;
}

.gptab1{
	cursor:pointer;color:#444;font:13px <?=SFONT?>;float:left;padding:0px 4px 3px 4px;border-bottom:4px solid #01a8f7;margin-right:20px
}
.gptab{
	cursor:pointer;color:#999;font:13px <?=SFONT?>;float:left;padding:0px 4px 7px 4px;margin-right:20px
}
.gptab:hover{
	color:#444;
}
.gptabbar{
	float:left;margin-bottom:14px;width:100%
}

</style>