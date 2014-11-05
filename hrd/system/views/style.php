<title><?=(($ptitle!="")?$ptitle." - ":"")?>Human Resource Management Software</title>
<style type="text/css">
body {
	<?=cssFontBody($b="")?>
	<?=cssGrad("#1c6cd0 0px, #a7c2fa 700px, #a7c2fa 100%","#1c6cd0","top")?>
}
#ct_box {
	border-radius: 0 5px 5px 5px;
	width:940px;
	min-height:380px;
	background:#f8fbff;
	background:<?php if($ct_bg!="") {?>url('<?=IMGR.$ct_bg?>') no-repeat 870px 88px<?php }?> #ffffff;
	padding:50px 30px 50px 30px;
	box-shadow: 0px 5px 5px rgba(0, 0, 0, .15);
}
#fform_bg{
	width:100%;height:100%;background:rgba(0,0,0,0.4);position:fixed;top:0px;left:0px
}
#fform_bg2{
	width:100%;height:100%;background:rgba(0,0,0,0.1);position:fixed;top:0px;left:0px
}
#fform{
	width:100%;height:100%;position:fixed;top:0px;left:0px;
}
.pdiv{
	padding-bottom:6px 
}
.popblock{
	background:rgba(0,0,0,0.1);width:1500px;height:800px;position:absolute;top:-400px;left:-500px
}
.popbox{
	width:310px;height:55px;position:absolute;top:20px;left:-141px;background:url('<?=IMGR?>pbox.png') center no-repeat;
}
.popbox2{
	width:310px;height:55px;position:absolute;top:20px;left:-257px;background:url('<?=IMGR?>popbox2.png') center no-repeat;
}
.line150 {
	line-height:150%
}
.tview {
	margin-bottom:30px;
	border-bottom:1px solid #6a92e5;
	padding-bottom:4px;
	font:bold 26px 'Segoe UI', Verdana, Tahoma, sans-serif;
	color:#468ad2;
}
.adms {
	color:white;
	font:10px Verdana,Tahoma;
}
.alink {
	color:white;
	font:10px Verdana,Tahoma;
}
.linkb11 {
	font:11px Verdana, Tahoma;
	color:#444444;
	text-decoration:none;
}
.linkb11:hover {
	text-decoration:underline;
}
.linkl11 {
	font:11px Verdana, Tahoma;
	color:#468ad2;
	text-decoration:none;
}
.linkl11:hover {
	text-decoration:underline;
}
.sfont {
	<?=cssFontBody()?>
	<?=cssBodyColor?>
}
/* ---------- TABS ---------- */
.tab_act {
	border-radius: 5px 5px 0 0;
	background:#ffffff;
	width:130px;
	height:15px;
	padding:11px 5px 5px 5px;
	font:bold 11px Verdana, Tahoma;
	color:#1c6cd0;
	text-align:center;
	margin-right:1px;
	cursor:pointer;
	display:block;
	text-decoration:none;
}
.tab {
	border-radius: 5px 5px 0 0;
	<?=cssGradTop("#f9fbff","#c9d3e8")?>
	width:130px;
	height:15px;
	padding:8px 5px 5px 5px;
	font:bold 11px Verdana, Tahoma;
	color:#729bcd;
	text-align:center;
	margin:3px 1px 0 0;
	cursor:pointer;
	display:block;
	text-decoration:none;
}
.tab:hover {
	<?=cssGradTop("#ffffff","#e7edf8")?>
	padding:11px 5px 5px 5px;
	margin:0 1px 0 0;
}
/* ---------- SEARCHBOX ---------- */
#search_input {
	width:170px;
	height:22px;
	border:none;
	border-radius: 10px;
	color:#999999;
	font:11px Verdana, Tahoma;
	padding:0 10px 0 10px;
	outline: none;
}
#srcbtn {
	width:22px;
	height:22px;
	background:url('<?=IMGR?>find0.png') center no-repeat;
	cursor:pointer;
	border:none;
}
#srcbtn:hover {
	background:url('<?=IMGR?>find1.png') center no-repeat;
}
#srcbtn:active {
	background:url('<?=IMGR?>find2.png') center no-repeat;
}

/* ---------- TABLE ---------- */
.stable tr td{
	font:11px Verdana, Tahoma;
	//color:#323232;
	color:#303942;
}
.xtable {
	border-collapse:collapse;
	border-left:1px solid #a7c2fa;
	border-bottom:1px solid #a7c2fa;
	border-right:1px solid #a7c2fa;
}

.xtdh {
	color:ffffff;
	background:url('<?=IMGR?>thbg.png') repeat-x #a7c2fa;
	padding:0 4px; margin:0;
	height:24px;
	font:bold 11px Verdana, Tahoma;
	border:none;
	cursor:default;
	text-align:left;
}

.xlinka {
	color:ffffff;
	font:bold 11px Verdana, Tahoma;
	background:url('<?=IMGR?>thbg1.png') repeat-x #a7c2fa;
	border:none;
	padding:0 4px; margin:0;
	height:100%;
	width:100%;
	cursor:pointer;
	text-align:left;
}
.xlink {
	color:ffffff;
	background:url('<?=IMGR?>thbg.png') repeat-x #a7c2fa;
	padding:0 4px; margin:0;
	height:100%;
	font:bold 11px Verdana, Tahoma;
	border:none;
	width:100%;
	cursor:pointer;
	text-align:left;
}
.xlink:hover {
	background:url('<?=IMGR?>thbg1.png') repeat-x #a7c2fa;
}
.xth{
	padding:0;
	height:24px;
}
.xr0 {
	background-color:#f4f4f4;
}
.xr0:hover{
	background-color:#ddedff;
}
.xr0:active{
	background-color:#bed6f1;
}
.xr0 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:36px;
	font-weight:inherit;
}
.xr1 {
	background-color:#ffffff;
}
.xr1:hover{
	background-color:#ddedff;
}
.xr1:active{
	background-color:#bed6f1;
}
.xr1 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:36px;
	font-weight:inherit;
}
.iText{
	<?=cssFontBody()?>
    border:1px solid #b2b2b2;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px 4px !important;
	margin:0;
	height:21px;
	outline:none;
	//box-shadow:inset 0px 1px 1px rgba(0, 0, 0, .15);
}
.iTextx{
	<?=cssFontBody()?>
	border:1px solid #ff9000;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px 4px !important;
	margin:0;
	height:21px;
	outline:none;
	box-shadow: 0px 0px 2px rgba(255, 144, 0, .45);
}
.iTextA{
	<?=cssFontBody()?>
    border:1px solid #b2b2b2;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px 4px;
	margin:0;
	outline:none;
}
.iTextAx{
	<?=cssFontBody()?>
	border:1px solid #ff9000;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px 4px;
	margin:0;
	outline:none;
	box-shadow: 0px 0px 2px rgba(255, 144, 0, .45);
}
.iSelect{
	<?=cssFontBody()?>
    border:1px solid #b2b2b2;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px;
	margin:0;
	height:21px;
	outline:none;
	color:#303942;
}
.iSelectx{
	<?=cssFontBody()?>
    border:1px solid #ff9000;
    -moz-border-radius: 3px;border-radius: 3px;
    padding:2px;
	margin:0;
	height:21px;
	box-shadow: 0px 0px 2px rgba(255, 144, 0, .45);
	outline:none;
	color:#303942;
}
.iCheck {
	padding:0;margin:0
}
.tablex{
    border-collapse:collapse;
}
.tablex td{
    border:1px solid #a7c2fa;
	font:11px Verdana, Tahoma;
	color:#444444;
	padding:4px;
	background:#f8fbfd;
}
.tablexhead th{
    font:bold 11px Verdana,Tahoma;
    text-align:left;
	border:1px solid #a7c2fa;
	background:#a7c2fa;
	color:white;
	height:24px;
	padding:0 4px;
}

/* ---------- BUTTONS ---------- */
.btnedit {
	border-radius:5px;
	width:18px;
	height:18px;
	background:url('<?=IMGR?>edit0_18.png') center no-repeat;
	cursor:pointer;
	border:none;
	outline:none;
}
.btnedit:hover {
	background:url('<?=IMGR?>edit1_18.png') center no-repeat #b4d3fa;
}
.btnedit:active {
	background:url('<?=IMGR?>edit1_18.png') center no-repeat #7da9e0;
}
.btnlook {
	border-radius:5px;
	width:18px;
	height:18px;
	background:url('<?=IMGR?>view0_18.png') center no-repeat;
	cursor:pointer;
	border:none;
	outline:none;
}
.btnlook:hover {
	background:url('<?=IMGR?>view1_18.png') center no-repeat #b4d3fa;
}
.btnlook:active {
	background:url('<?=IMGR?>view1_18.png') center no-repeat #7da9e0;
}

.btndel {
	border-radius:5px;
	width:18px;
	height:18px;
	background:url('<?=IMGR?>del0_18.png') center no-repeat;
	cursor:pointer;
	border:none;
	outline:none;
}
.btndel:hover {
	background:url('<?=IMGR?>del1_18.png') center no-repeat #b4d3fa;
}
.btndel:active {
	background:url('<?=IMGR?>del1_18.png') center no-repeat #7da9e0;
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

.popx{
	width:20px; height:20px;
	border:none;
	background:url('<?=IMGR?>popx.png');
	background-position:0 0;
	cursor:pointer;
}
.popx:hover{
	background-position:-20px 0;
}
.popy{
	width:20px; height:20px;
	border:none;
	background:url('<?=IMGR?>popy.png');
	background-position:0 0;
	cursor:pointer;
}
.popy:hover{
	background-position:-20px 0;
}
.btnz {
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#1c6cd0 0%, #62a8ff 100%","#f4f4f4")?>
	border:1px solid #1c6cd0;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnz:hover{
	<?=cssGrad("#2c7ce0 0%, #82c8ff 100%","#1c6cd0")?>
	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btnz:active{
	<?=cssGrad("#1c6cd0 0%, #5298ef 100%","#f0f0fa")?>
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
	//border:1px solid #c2c2c2;
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

/* ---------- FLOATING FORM ---------- */
#fblock {
	width:100%;
	height:100%;
	position:fixed;
	background: argb(0,0,0,0.15);
}
.fformbox {
	background:#f4f5f5;
	border:4px solid #6a92e5;
	border-radius:10px 10px 0 0;
	box-shadow:0px 4px 10px rgba(0, 0, 0, .15);
}
.fformbox2 {
	background:#ffffff;
	box-shadow:0px 0px 20px rgba(0, 0, 0, .5);
}
</style>