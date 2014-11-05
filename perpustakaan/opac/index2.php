<?php session_start(); require_once('../../shared/config.php'); require_once('../system/config.php'); require_once(MODDIR.'control.php'); ?>
<html><head>
<title>SIADU :: Perpustakaan</title>
<style type="text/css">
html,body,div,ul,ol,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,pre,form,p,blockquote,fieldset,input,hr {margin:0; padding:0;}
h1,h2,h3,h4,h5,h6,pre,code,address,caption,cite,code,em,strong,th {font-size:1em; font-weight:normal; font-style:normal;}
ul,ol {list-style:none;}
fieldset,img,hr {border:none;}
caption,th {text-align:left;}
//table {border-collapse:collapse; border-spacing:0;}
button::-moz-focus-inner{ padding:0; margin:0; border:0; }
/* --- Container --- */
html {
	margin:0; padding:0;line-height: 1.5em;
}
body {
	font:11px 'Segoe UI',Verdana,Tahoma;;
	margin:0;
	padding:0 0px;
	line-height: 1.5em;
	//background:url('<?=IMGR?>bg3.jpg') center fixed;
	background:url('<?=IMGR?>bg5.jpg') center top fixed #005c73;
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
	padding:50px 20px 0px 20px;
}
.psf12150{
	color:#444;cursor:default;line-height:150% !important;font:12px 'Segoe UI',Verdana,Tahoma;}
.psf12155{
	color:#444;cursor:default;line-height:150% !important;margin-bottom:5px;font:12px 'Segoe UI',Verdana,Tahoma;}
.psf12200{
	color:#444;cursor:default;line-height:200% !important;font:12px 'Segoe UI',Verdana,Tahoma;}
.psf12205{
	color:#444;cursor:default;line-height:200% !important;margin-bottom:5px;font:12px 'Segoe UI',Verdana,Tahoma;}
.sfont{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default
}
.sfont2{
	font:14px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default
}
.vfont{
	font:11px Verdana,Tahoma,Arial;	color:#444}

/* --- Links --- */
.linkw{
	color:#fff;
	text-decoration:none;
}
.linkw:hover{
	text-decoration:underline;
}
.linkb {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#468ad2;
	text-decoration:none;
	cursor:pointer;
}
.linkb:hover {
	text-decoration:underline;
}
.linkb2 {
	font-family:'Segoe UI',Verdana,Tahoma;
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
	background-color: #f4f4f4;background:-webkit-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-moz-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-ms-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-o-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);	border:1px solid #c2c2c2;
	border-radius:5px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.obtna:hover {
	background-color: #dfdfdf;background:-webkit-linear-gradient(bottom, #e0e0e0 0%, #ffffff 100%);background:-moz-linear-gradient(bottom, #e0e0e0 0%, #ffffff 100%);background:-ms-linear-gradient(bottom, #e0e0e0 0%, #ffffff 100%);background:-o-linear-gradient(bottom, #e0e0e0 0%, #ffffff 100%);	box-shadow: 0px 1px 1px rgba(0, 0, 0, .1);
}
.obtna:active {
	background-color: #e2e2e2;background:-webkit-linear-gradient(bottom, #ffffff 0%, #ededed 4%, #ededed 96%, #d0d0d0 100%);background:-moz-linear-gradient(bottom, #ffffff 0%, #ededed 4%, #ededed 96%, #d0d0d0 100%);background:-ms-linear-gradient(bottom, #ffffff 0%, #ededed 4%, #ededed 96%, #d0d0d0 100%);background:-o-linear-gradient(bottom, #ffffff 0%, #ededed 4%, #ededed 96%, #d0d0d0 100%);	box-shadow:none;
}
.btnz {
	height:24px;
	padding:0 6px 1px 6px;
	background-color: #1c6cd0;background:-webkit-linear-gradient(bottom, #008aff 0%, #1393ff 100%);background:-moz-linear-gradient(bottom, #008aff 0%, #1393ff 100%);background:-ms-linear-gradient(bottom, #008aff 0%, #1393ff 100%);background:-o-linear-gradient(bottom, #008aff 0%, #1393ff 100%);	border:1px solid #1c6cd0;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnz:hover{
	background-color: #1c6cd0;background:-webkit-linear-gradient(bottom, #1795ff 0%, #27abff 100%);background:-moz-linear-gradient(bottom, #1795ff 0%, #27abff 100%);background:-ms-linear-gradient(bottom, #1795ff 0%, #27abff 100%);background:-o-linear-gradient(bottom, #1795ff 0%, #27abff 100%);	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btnz:active{
	background-color: #f0f0fa;background:-webkit-linear-gradient(bottom, #1393ff 0%, #008aff 100%);background:-moz-linear-gradient(bottom, #1393ff 0%, #008aff 100%);background:-ms-linear-gradient(bottom, #1393ff 0%, #008aff 100%);background:-o-linear-gradient(bottom, #1393ff 0%, #008aff 100%);	box-shadow:none;
}

.btng {
	height:24px;
	padding:0 6px 1px 6px;
	background-color: #00c804;background:-webkit-linear-gradient(bottom, #00c804 0%, #1ed900 100%);background:-moz-linear-gradient(bottom, #00c804 0%, #1ed900 100%);background:-ms-linear-gradient(bottom, #00c804 0%, #1ed900 100%);background:-o-linear-gradient(bottom, #00c804 0%, #1ed900 100%);	border:1px solid #00b804;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btng:hover{
	background-color: #00df05;background:-webkit-linear-gradient(bottom, #00df05 0%, #20e400 100%);background:-moz-linear-gradient(bottom, #00df05 0%, #20e400 100%);background:-ms-linear-gradient(bottom, #00df05 0%, #20e400 100%);background:-o-linear-gradient(bottom, #00df05 0%, #20e400 100%);	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btng:active{
	background-color: #1dcc02;background:-webkit-linear-gradient(bottom, #1dcc02 0%, #1dcd00 100%);background:-moz-linear-gradient(bottom, #1dcc02 0%, #1dcd00 100%);background:-ms-linear-gradient(bottom, #1dcc02 0%, #1dcd00 100%);background:-o-linear-gradient(bottom, #1dcc02 0%, #1dcd00 100%);	box-shadow:none;
}

.btnr {
	height:24px;
	padding:0 6px 1px 6px;
	background-color: #e90000;background:-webkit-linear-gradient(bottom, #e90000 0%, #ff1010 100%);background:-moz-linear-gradient(bottom, #e90000 0%, #ff1010 100%);background:-ms-linear-gradient(bottom, #e90000 0%, #ff1010 100%);background:-o-linear-gradient(bottom, #e90000 0%, #ff1010 100%);	border:1px solid #e90000;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnr:hover{
	background-color: #ff1b1b;background:-webkit-linear-gradient(bottom, #ff1b1b 0%, #ff3535 100%);background:-moz-linear-gradient(bottom, #ff1b1b 0%, #ff3535 100%);background:-ms-linear-gradient(bottom, #ff1b1b 0%, #ff3535 100%);background:-o-linear-gradient(bottom, #ff1b1b 0%, #ff3535 100%);	box-shadow: 0px 1px 2px rgba(0, 0, 0, .4);
}
.btnr:active{
	background-color: #ec0000;background:-webkit-linear-gradient(bottom, #ec0000 0%, #ec0000 100%);background:-moz-linear-gradient(bottom, #ec0000 0%, #ec0000 100%);background:-ms-linear-gradient(bottom, #ec0000 0%, #ec0000 100%);background:-o-linear-gradient(bottom, #ec0000 0%, #ec0000 100%);	box-shadow:none;
}

.btn {
	height:24px;
	padding:0 6px 1px 6px;
	background-color: #f4f4f4;background:-webkit-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-moz-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-ms-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-o-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn:hover {
	background-color: #dfdfdf;background:-webkit-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-moz-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-ms-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-o-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn:active {
	background-color: #e2e2e2;background:-webkit-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-moz-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-ms-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-o-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);	box-shadow:none;
}
.btn_c {
	padding:0 6px 1px 6px;
	background-color: #f4f4f4;background:-webkit-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-moz-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-ms-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);background:-o-linear-gradient(bottom, #d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%);	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
}
.btn_c:hover {
	background-color: #dfdfdf;background:-webkit-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-moz-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-ms-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);background:-o-linear-gradient(bottom, #eeeeee 0%, #ffffff 100%);	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn_c:active {
	background-color: #e2e2e2;background:-webkit-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-moz-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-ms-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);background:-o-linear-gradient(bottom, #ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%);	box-shadow:none;
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
	background-color: #40e62a;background:-webkit-linear-gradient(bottom, #c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%);background:-moz-linear-gradient(bottom, #c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%);background:-ms-linear-gradient(bottom, #c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%);background:-o-linear-gradient(bottom, #c1c1c1 0%, #33bb0a 4%, #40e62a 92%, #a4ff7c 100%);	border:1px solid #33bb0a;
	border-radius:2px;
	font:bold 11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btnx:hover {
	background-color: #4df337;background:-webkit-linear-gradient(bottom, #ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%);background:-moz-linear-gradient(bottom, #ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%);background:-ms-linear-gradient(bottom, #ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%);background:-o-linear-gradient(bottom, #ffffff 0%, #31b309 4%, #6aff56 92%, #a4ff7c 100%);	box-shadow: 0px 1px 2px rgba(0, 0, 0, .25);
}
.btnx:active {
	background-color: #4df337;background:-webkit-linear-gradient(bottom, #a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%);background:-moz-linear-gradient(bottom, #a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%);background:-ms-linear-gradient(bottom, #a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%);background:-o-linear-gradient(bottom, #a4ff7c 0%, #45d21a 4%, #4dde20 95%, #ffffff 100%);	box-shadow:inset 0px 1px 3px rgba(0, 0, 0, .45);
}

.btns {
	height:24px;
	min-width:60px;
	padding:0 10px 1px 10px;
	background-color: #38ec00;background:-webkit-linear-gradient(bottom, #2ac700 0%, #38ec00 100%);background:-moz-linear-gradient(bottom, #2ac700 0%, #38ec00 100%);background:-ms-linear-gradient(bottom, #2ac700 0%, #38ec00 100%);background:-o-linear-gradient(bottom, #2ac700 0%, #38ec00 100%);	border:1px solid #2ac700;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#ffffff;
    outline:none;
	margin:0;
}
.btns:hover {
	background-color: #46ff0d;background:-webkit-linear-gradient(bottom, #2ac700 0%, #46ff0d 100%);background:-moz-linear-gradient(bottom, #2ac700 0%, #46ff0d 100%);background:-ms-linear-gradient(bottom, #2ac700 0%, #46ff0d 100%);background:-o-linear-gradient(bottom, #2ac700 0%, #46ff0d 100%);	box-shadow: 0px 1px 2px rgba(0, 0, 0, .25);
}
.btns:active {
	background-color: #37dd03;background:-webkit-linear-gradient(bottom, #2ac700 0%, #37dd03 100%);background:-moz-linear-gradient(bottom, #2ac700 0%, #37dd03 100%);background:-ms-linear-gradient(bottom, #2ac700 0%, #37dd03 100%);background:-o-linear-gradient(bottom, #2ac700 0%, #37dd03 100%);	box-shadow:none;
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
.bi_usrb {
	background:url('<?=IMGR?>main.png') no-repeat;
	background-position:-6px -356px;
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
	font:18px 'Segoe UI',Verdana,Tahoma;
	color:#1c64d1;
	cursor:default;
}
.hl1{
	font:15px 'Segoe UI',Verdana,Tahoma;
	color:#1c64d1;
	cursor:default;
}
.hl2{
	font:14px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
}
.hl3{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
}
.fgroup{
	font:14px 'Segoe UI',Verdana,Tahoma;
	cursor:default
	margin-top:6px;
	height:30px;
	width:100%;
	color:#1c64d1;
}

/*Table*/
.stable {
	border-collapse:collapse; border-spacing:0;
}
.stable tr td {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
}
.stable24 tr {
	height:24px !important;
}
.stable24 td {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
}
.stable26 tr {
	height:26px !important;
}
.stable26 td {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
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
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#ff0000;
}
.notifw{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#ff8000;
}
.notifg{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#00f000;
}
.notifb{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#1c64d1;
}
.notifl{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
}
/** Custom **/
.tbltopbar{
	float:left;
	margin-bottom:5px;
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
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
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	padding:4px 9px 4px 21px;background:url('<?=IMGR?>info.png') 4px 6px no-repeat;
	float:left;
	line-height:150%;
	//border-radius:4px;
	//border:1px solid #01a8f7;
	margin-bottom:2px;
}
.infobox2{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	padding:4px 9px 4px 21px;background:url('<?=IMGR?>info.png') 4px 6px no-repeat;
	float:left;
	line-height:150%;
}
.warnbox{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	padding:4px 8px 4px 20px;border:1px solid #ffc000;border-radius:4px;background:url('<?=IMGR?>warn.png') 4px 5px no-repeat #fff8d6;
	line-height:150%;
	float:left;
}
.swarnbox{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#ffde00;
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
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	float:left;
	margin-top:4px;
	margin-bottom:0px;
}
.xlabelb{
	font:bold 12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	float:left;
	margin-top:4px;
	margin-bottom:0px;
}
.xlbl{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444;
	cursor:default;
	float:left;
	margin-bottom:2px;
}
.xlblb{
	font:bold 12px 'Segoe UI',Verdana,Tahoma;	color:#444;
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
	font:12px 'Segoe UI',Verdana,Tahoma;;
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
	font:18px 'Segoe UI',Verdana,Tahoma;
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
	font:12px 'Segoe UI',Verdana,Tahoma;}
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
.iText{font:11px Verdana,Tahoma,Arial;border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:0px 4px 2px 4px !important;margin:0;height:24px;outline:none;color:#444}.iTextErr{font:11px Verdana,Tahoma,Arial;border:1px solid #ff0000;-moz-border-radius:3px;border-radius:3px;padding:2px 4px !important;margin:0;height:24px;outline:none}.iTextx{font:11px Verdana,Tahoma,Arial;border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:0px 4px 2px 4px !important;margin:0;height:24px;outline:none;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);color:#444}.iTextA{font:11px Verdana,Tahoma,Arial;border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;margin:0;outline:none;color:#444}.iTextAx{font:11px Verdana,Tahoma,Arial;border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:2px 4px;margin:0;outline:none;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);color:#444}.iSelect{font:11px Verdana,Tahoma,Arial;border:1px solid #b2b2b2;-moz-border-radius:3px;border-radius:3px;padding:2px;margin:0;height:24px;outline:none;color:#303942}.iSelectx{font:11px Verdana,Tahoma,Arial;border:1px solid #37a8ff;-moz-border-radius:3px;border-radius:3px;padding:2px;margin:0;height:24px;box-shadow:0px 0px 3px rgba(55, 168, 255, .45);outline:none;color:#303942}.iCheck{padding:0;margin:0}
/** Page personalized **/
#barang_ib .xlabel{
	width:140px;
}
#barang_view .xrowl{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444}
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
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#444}
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
	color:#777;padding:0px 4px 4px 4px;border-bottom:3px solid #1c64d1;float:left;margin-right:20px;cursor:pointer;font:12px 'Segoe UI',Verdana,Tahoma;}
.xtaba:hover{color:#000}
.xtab{
	color:#777;padding:0px 4px 4px 4px;border-bottom:3px solid #fff;float:left;margin-right:4px;cursor:pointer;font:12px 'Segoe UI',Verdana,Tahoma;}
.xtab:hover{color:#000}
.xtabbar{
	color:#646464;float:left;width:100%;border-bottom:1px solid #ddd;font:12px 'Segoe UI',Verdana,Tahoma;;margin-bottom:10px
}

.pagetitle{
	width:100%;
	font:24px 'Segoe UI Light','Segoe UI',Verdana,Tahoma;
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
	height:143px !important
}
.tile:hover{
	box-shadow:0px 0px 6px rgba(0,0,0,0.75);
	//padding:9px 9px 19px 9px;
	margin:3px;
	border:1px solid #fff;
}
.tiletitle{
	font:22px 'Segoe UI Light','Segoe UI',Verdana,Tahoma;
	margin-bottom:12px
}
.tiletitle2{
	font:15px 'Segoe UI Light','Segoe UI',Verdana,Tahoma;
	margin-top:85px;
}
.tiledesc{
	font:13px 'Segoe UI',Verdana,Tahoma;;
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
	font:12px 'Segoe UI',Verdana,Tahoma;	border-radius:3px;
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
	font:12px 'Segoe UI',Verdana,Tahoma;	//background:rgba(255,255,255,0.95);
	background:#fff;
	border-radius:3px;
	//box-shadow:0px 5px 10px rgba(0,0,0,0.80);
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
	background:#005c73;
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
	background-color:#008287;
	//background-color:#1c6cd0;
	float:left;
	cursor:pointer;
	color:#fff;
	border:1px solid #fff;
	font:12px 'Segoe UI',Verdana,Tahoma;}
.smbtn:hover{
	background-color:#00a1a7;
	//background-color:#2583f9;
}
.loginpswd{
	width:200px;
	height:24px;
	float:left;
	margin-right:4px;
	outline:none;
	padding:0px 4px;
	border:none;
	font:12px 'Segoe UI',Verdana,Tahoma;}
#copyright{color:#fff;font:10px Verdana,Tahoma,Arial;position:fixed;bottom:10px;left:0px;width:100%;text-align:right}
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
	margin-left:6px;margin-right:6px;font:18px 'Segoe UI',Verdana,Tahoma; font-weight:bold;
	color: #468ad2;
	background:#faf8ff;
	border:1px solid #cacaca;
	border-radius:3px;
	padding:0 10px 0 10px;
	width:500px;
	height:28px;
	overflow:hidden;
}

.gptab1{
	cursor:pointer;color:#444;font:13px 'Segoe UI',Verdana,Tahoma;float:left;padding:0px 4px 3px 4px;border-bottom:4px solid #01a8f7;margin-right:20px
}
.gptab{
	cursor:pointer;color:#999;font:13px 'Segoe UI',Verdana,Tahoma;float:left;padding:0px 4px 7px 4px;margin-right:20px
}
.gptab:hover{
	color:#444;
}
.gptabbar{
	float:left;margin-bottom:14px;width:100%
}

</style><style type="text/css">
.fform{
	width:100%;height:100%;position:fixed;top:0px;left:0px;
}
.fform_bg{
	width:100%;height:100%;background:rgba(0,0,0,0.25);position:fixed;top:0px;left:0px;
}
.fformbox{
	border-radius:3px;
	background:#ffffff;
	box-shadow:0px 3px 24px rgba(0, 0, 0, .5);
	overflow:hidden
}
.fformtitle{
	height:22px;padding:10px 15px 15px 15px;text-align:left;color:#333;font:15px }
.fformct{
	text-align:left;padding:5px 10px;
}
.ffload{
	width:18px;height:18px;margin-top:1px;
	background:url('<?=IMGR?>iclite.gif') 2px 2px no-repeat;
	float:right;
}
.fftab1{
	cursor:pointer;color:#444;font:14px 'Segoe UI',Verdana;float:left;padding:0px 4px 0px 4px;border-bottom:3px solid #01a8f7;margin-right:10px
}
.fftab{
	cursor:pointer;color:#999;font:14px 'Segoe UI',Verdana;float:left;padding:0px 4px 3px 4px;margin-right:10px
}
.fftab:hover{
	color:#444;
}
.fftabbar{
	float:left;margin-bottom:14px;width:100%
}
</style><style type="text/css">
.xtable_norm{
	border-collapse:collapse;
	border:1px solid #000;
}
.xtable_norm tr td{
	/*border:1px solid #000 !important;*/
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	background:#fff !important;
}

.xtable{
	margin-top:2px;
	border-collapse:collapse;
	border:1px solid #88d9ff;
}
.xtable .xtrx td{
	background:#ffffff;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtd {
	background:#ffffff;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr td {
	background:#ffffff;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr:hover td {
	background:#edf0ff;
	border:1px solid #88d9ff;
}

/* row strip */
.xtable .xtr0 td {
	background:#ffffff;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr0:hover td {
	background:#edf0ff;
}
.xtable .xtr1 td {
	background:#f7f7f7;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr1:hover td {
	background:#edf0ff;
}

/* selected */
.xtable .xtrs td {
	background:#fcffab;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtrs:hover td {
	background:#fcffab;
}


/* active row */
.xtable .xtr0a td {
	background:#fafafa;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr0a:hover td {
	background:#edf0ff;
}
.xtable .xtr0a:active td {
	background:#edf0ff;
}
.xtable .xtr1a td {
	background:#f0f0f0;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr1a:hover td {
	background:#edf0ff;
}
.xtable .xtr1a:active td {
	background:#edf0ff;
}

.xtable .xtr2 td {
	background:#fff;
	color:#444;
	font:12px 'Segoe UI',Verdana,Tahoma;	cursor:default;
	line-height:150%;
	border:1px solid #88d9ff;
}
.xtable .xtr2:hover td {
	background:#fff95e;
}
.xtable .xtr2:hover .xtrtd {
	background:#fff95e;
}
.xtable tr th{
	background:#01a8f7;
	color:#fff;
	cursor:default;
	border:1px solid #88d9ff;
	font:13px 'Segoe UI',Verdana,Tahoma;}
.xtable tr .sortASC{
	background:url('<?=IMGR?>sort1.png') right center no-repeat #0be300;
	cursor:pointer;
}
.xtable tr .sortASC:hover{
	background-color:#0ad700;
}
.xtable tr .sortDESC{
	background:url('<?=IMGR?>sort0.png') right center no-repeat #0be300;
	cursor:pointer;
}
.xtable tr .sortDESC:hover{
	background-color:#0ad700;
}
.xtable tr .sort0{
	cursor:pointer;
}
.xtable tr .sort0:hover{
	background-color:#008ff4;
}
.xtable tr .alc{
	text-align:center;
}
.xtable tr .alr{
	text-align:right;
}

.plink{
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#2c73f5;
	text-decoration:none;
	text-align:center;
	display:block;
	width:18px;
	height:16px;
	min-width:20px;
	border:1px solid #6ca0ff;
	padding-top:2px;
	background:#ffffff;
}
.plink:hover {	
	font:12px 'Segoe UI',Verdana,Tahoma;	border:1px solid #303942;
}
.plinka {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#ffffff;
	text-decoration:none;
	text-align:center;
	display:block;
	width:18px;
	height:16px;
	min-width:20px;
	border:1px solid #01a8f7;
	background:#01a8f7;
	padding-top:2px;
	cursor:default;
}
.plinko {
	font:12px 'Segoe UI',Verdana,Tahoma;	color:#999999;
	text-decoration:none;
	text-align:center;
	display:block;
	width:18px;
	height:16px;
	min-width:20px;
	border:1px solid #dddddd;
	padding-top:2px;
	cursor:default;
}
.imgcover:hover{
	width:112px;
	margin-left:-6px;
}
.imgcoverx:hover{
	width:96px !important;
	height:108px !important;
	margin-left:-4px;
	font:13px <?=VFONT?> !important;
	border-left:10px solid #666 !important;
}
</style><style type="text/css">#pendataan_dps .xlabel{width:140px;float:left}</style><script type="text/javascript" language="javascript" src="../../shared/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jkquery.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.categories.js"></script>
<script type="text/javascript" language="javascript" src="../shared/jquery.flot.pie.js"></script>
<script type="text/javascript" language="javascript">
var HomeTitle="Home"; var pagetitle=new Array(); var tiletitle=new Array();
pagetitle["katalog"]="Katalog";pagetitle["daftarbuku"]="Daftar Koleksi";pagetitle["peminjaman"]="Peminjaman";pagetitle["pengembalian"]="Pengembalian";pagetitle["stocktake"]="Stock Opname";pagetitle["statistik"]="Statistik Perpustakaan";pagetitle["lokasi"]="Lokasi";pagetitle["tingkatbuku"]="Tingkat Koleksi";pagetitle["jenisbuku"]="Jenis Koleksi";pagetitle["klasifikasi"]="Klasifikasi";pagetitle["pengarang"]="Pengarang";pagetitle["penerbit"]="Penerbit";pagetitle["bahasa"]="Bahasa";pagetitle["satuan"]="Satuan Mata Uang";tiletitle["home"]="Home";tiletitle["master"]="Master";function fadeTiles(){fadeTileset(0);fadeTileset(1);}var CSLIDE=1;var CSLIDE0=1;var tpos=new Array();tpos[1]="20px";tpos[2]="-960px";</script>
<script type="text/javascript" src="../../shared/maincontrol.js"></script>
<script type="text/javascript" src="../controller.js"></script>
<script type="text/javascript" language="javascript">
function opac_cari(){
	E("search_form").submit();
}
</script>
<script type="text/javascript" src="../../shared/tinymce/tiny_mce.js"></script>
</head><body style="">
<div id="topsection">
	<div id="logo"></div>
	<div id="ltitle">Perpustakaan</div>
</div>
<div id="global">
<div id="cbox" style="display:none">
<?php
$keyw=gets('keyword');

$db=new xdb("pus_katalog","replid,judul");
if($keyw!='') $db->where_and("pus_katalog.judul LIKE '%".$keyw."%'");
$t=$db->query();
$ndata=mysql_num_rows($t);
?>
</div>
<div id="maincontainer" style="overflow: hidden; margin-right: 20px; margin-left: 20px;">
	<input type="hidden" id="cpage" value="katalog">
	<div style="float:left;width:100%;height:30px;">
		<div style="float:left">
			<?php
			if($keyw!=''){
				if($ndata>0){
					$info='Hasil pencarian koleksi dengan judul  "<b>'.$keyw.'</b>". Ditemukan '.$ndata.' item.';
				} else {
					$info='Tidak ditemukan koleksi dengan judul  "<b>'.$keyw.'</b>".';
				}
				echo '<div class="infobox" style="border-radius:4px;background-color:#fff;box-shadow:0px 1px 4px rgba(0,0,0,0.5);color:#">';
					echo $info;
				echo ' <a href="index.php" class="linkb" style="color:">Tampilkan semua...</a></div>';
			}
			
			?>
		</div>
		<form id="search_form" action="index.php" method="get">
		<?php 
			$ffun='opac_cari()';
			echo iTextSrc('keyword',gets('keyword'),'float:right~width:200px','Cari judul koleksi...',$ffun,'onkeyup="gpage_cari(event,function(){'.$ffun.'})"');
		?>
		</form>
	</div>
	<div id="pagebox" style="box-shadow:0px 4px 10px rgba(0,0,0,0.5)">
		<table width="100%" cellspacing="0px" cellpadding="0"><tbody><tr><td>
			<div id="loader" style="position: relative; width: 1246px; text-align: center; background-image: url(<?=IMGR?>loader8.gif); height: 450px; display: none; background-position: 0% 0%; background-repeat: no-repeat no-repeat;"></div>
			<div id="page" style="overflow: visible;">
			<?php

function photof($d=0,$f='$',$t=''){
	$photodir='../photo/';
	if(empty($d))$d=0;
	echo '<div style="position:relative;width:100px;height:155px;float:left;margin:10px 20px 35px 20px">';
	echo '<div style="position:absolute;bottom:0px;float:left;width:100px;background:#fff;box-shadow:0px 2px 10px rgba(0,0,0,0.7)">';
	if($d!=0 && file_exists($photodir.$f.'.php')){
		$sz='width="100px"';
		echo '<img class="imgcover" style="position:relative;cursor:pointer;float:left" src="'.$photodir.$f.'.php?id='.$d.'" '.$sz.' style="display:"/>';
		
	} else {
		echo '<div class="imgcoverx" style="position:relative;cursor:pointer;border-left:8px solid #666;width:90px;height:100px;background:#f0f0ff;font:11px '.VFONT.';text-align:center;padding:15px 6px"><b>'.$t.'</b></div>';
	}
	echo '</div></div>';
}

$row=0; $kol=0;
echo '<table cellspacing="0" cellpadding="0" style="border:10px solid #eebd46;" width="100%"><tr><td>';
echo '<div style="float:left;width:100%;height:600px;max-height:600px;overflow:auto;background:url(\''.IMGR.'/shelfbg.png\')">';
echo '<div style="float:left;background:url(\''.IMGR.'/shelfbg.png\')">';
	//echo '<div style="float:left;height:180px;width:100%; repeat-x">';
	while($r=mysql_fetch_array($t)){
		for($i=0;$i<15;$i++){
			//if($r['replid']==4) $r['replid']=0;
			photof($r['replid'],'katalog',buku_judul($r['judul']));
		}
	}
	//echo '</div>';
echo '</div></div>';
echo '</td></tr></table>';

			?>
			</div>
		</td></tr></tbody></table>
	</div>
</div>
</div>
<script type="text/javascript" language="javascript">
/** Floating Form **/
function close_fform(){
	if(E('fform').style.display!='none'){
		$('#fform_bg').animate({ opacity: '0' }, 100 , function(){ E('fform_bg').style.display='none'; });
		$('#fform').animate({ opacity: '0' }, 100 , function(){ E('fform').style.display='none'; });
		E('fform').innerHTML='';
	}
}
function open_fform(r){
	r = typeof r !=='undefined'?r:'';
	if(r!=''){
		E('fform').innerHTML=r;
	}
	if(E('fform').style.display=='none'){
		E('fform_bg').style.opacity='0';
		E('fform').style.opacity='0';
		
		E('fform_bg').style.display='';
		E('fform').style.display='';
		
		$('#fform_bg').animate({ opacity: '1' }, 100);
		$('#fform').animate({ opacity: '1' }, 100);
	}
}
function bFBa(a){
	E('fformbox').style.border='1px solid #fff';
	if(a>0){
		a--;
		setTimeout('bFBb('+a+')',80);
	}
}
function bFBb(a){
	E('fformbox').style.border='';
	if(a>0){
		a--;
		setTimeout('bFBa('+a+')',80);
	}
}
function blinkFbox(e){
	 if(e.target.id=='fform'||e.target.id=='fformt') bFBa(3);
}
/** End of Floating Form **/
</script>
<div id="fform_bg" class="fform_bg" style="display:none;opacity:0"></div>
<div id="fform" class="fform" style="display:none;opacity:0" onclick="blinkFbox(event)"></div><script type="text/javascript" language="javascript">
/** Floating Form **/
function close_fform2(){
	if(E('fform2').style.display!='none'){
		$('#fform_bg2').animate({ opacity: '0' }, 100 , function(){ E('fform_bg2').style.display='none'; });
		$('#fform2').animate({ opacity: '0' }, 100 , function(){ E('fform2').style.display='none'; });
		E('fform2').innerHTML='';
	}
}
function open_fform2(r){
	r = typeof r !=='undefined'?r:'';
	if(r!=''){
		E('fform2').innerHTML=r;
	}
	if(E('fform2').style.display=='none'){
		E('fform_bg2').style.opacity='0';
		E('fform2').style.opacity='0';
		
		E('fform_bg2').style.display='';
		E('fform2').style.display='';
		
		$('#fform_bg2').animate({ opacity: '1' }, 100);
		$('#fform2').animate({ opacity: '1' }, 100);
	}
}
function bFBa2(a){
	E('fformbox2').style.border='1px solid #fff';
	if(a>0){
		a--;
		setTimeout('bFBb2('+a+')',80);
	}
}
function bFBb2(a){
	E('fformbox2').style.border='';
	if(a>0){
		a--;
		setTimeout('bFBa2('+a+')',80);
	}
}
function blinkFbox2(e){
	 if(e.target.id=='fform2'||e.target.id=='fformt2') bFBa2(3);
}
/** End of Floating Form **/
</script>
<div id="fform_bg2" class="fform_bg" style="display:none;opacity:0"></div>
<div id="fform2" class="fform" style="display:none;opacity:0" onclick="blinkFbox2(event)"></div><script type="text/javascript" language="javascript">
/** Floating Form **/
function close_fform3(){
	if(E('fform3').style.display!='none'){
		$('#fform_bg3').animate({ opacity: '0' }, 100 , function(){ E('fform_bg3').style.display='none'; });
		$('#fform3').animate({ opacity: '0' }, 100 , function(){ E('fform3').style.display='none'; });
		E('fform3').innerHTML='';
	}
}
function open_fform3(r){
	r = typeof r !=='undefined'?r:'';
	if(r!=''){
		E('fform3').innerHTML=r;
	}
	if(E('fform3').style.display=='none'){
		E('fform_bg3').style.opacity='0';
		E('fform3').style.opacity='0';
		
		E('fform_bg3').style.display='';
		E('fform3').style.display='';
		
		$('#fform_bg3').animate({ opacity: '1' }, 100);
		$('#fform3').animate({ opacity: '1' }, 100);
	}
}
function bFBa3(a){
	E('fformbox3').style.border='1px solid #fff';
	if(a>0){
		a--;
		setTimeout('bFBb3('+a+')',80);
	}
}
function bFBb3(a){
	E('fformbox3').style.border='';
	if(a>0){
		a--;
		setTimeout('bFBa3('+a+')',80);
	}
}
function blinkFbox3(e){
	 if(e.target.id=='fform3'||e.target.id=='fformt3') bFBa3(3);
}
/** End of Floating Form **/
</script>
<div id="fform_bg3" class="fform_bg" style="display:none;opacity:0"></div>
<div id="fform3" class="fform" style="display:none;opacity:0" onclick="blinkFbox3(event)"></div><div id="pagepreview" style="width: 1246px;"></div>
<textarea id="fformload" style="display:none">&lt;table cellspacing="0" cellpadding="0" width="100%"&gt;&lt;tr&gt;&lt;td id="fformt" align="center" style="padding-top:150px"&gt;&lt;div id="fformbox" class="fformbox" style="padding:5px;width:400px"&gt;&lt;div class="fformtitle"&gt;&lt;span style="margin-left:-2px;float:left"&gt;###&lt;/span&gt;&lt;div id="ffload" class="ffload" style=""&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;</textarea>
<div id="copyright" style="display: none;"></div>
</body></html>