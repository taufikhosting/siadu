<?php
session_start();
$back='bg5.jpg';
?>
<html>
<head>
<title>SIADU :: SISTEM INFORMASI AKADEMIK TERPADU</title>
<script type="text/javascript" language="javascript">
function jumpTo(a){
	document.location=a;
}
</script>
<style type="text/css">
body{
	padding:0;margin:0;
	background:url('<?=$back?>') center top no-repeat;
}
.blok{
	width:180px;height:100px;
	margin:5px;
	font:12px 'Segoe UI',Verdana,Tahoma,Arial;
	color:#fff;
}
.blok:hover{
	width:190px;height:110px;
	margin:0px;
}
.blok:active{
	width:186px;height:106px;
	margin:2px;
	opacity:0.75
}
.blbl{
	font:12px 'Segoe UI',Verdana,Tahoma,Arial;
	color:#fff; cursor:default;
	text-shadow:0px 1px 1px rgba(0,0,0,0.75);
}
.bgbtn{
	width:12px;height:12px;
	float:right;
	margin-right:4px;
	text-decoration:none;
	display:block;
}
.bgbtn:hover{
	width:10px;height:10px;
	border:1px solid #fff;
}
</style>
</head>
<body>
<table class="main" cellspacing="10px" cellpadding="0" style="margin:auto;margin-top:80px">
<tr valign="bottom">
	<td colspan="3" style="padding-bottom:20px">
		<img src="siadu.png" style="margin-left:5px" />
	</td>
	<td align="right" style="padding-bottom:20px">
		<div style="width:100px;height:12px">
			<a title="Change background to purple light" class="bgbtn" href="?background=purplelight" style="background:#a22ac0"></a>
			<a title="Change background to retro green" class="bgbtn" href="?background=retrogreen" style="background:#004050"></a>
			<a title="Change background to blue" class="bgbtn" href="?background=blue" style="background:#298cef"></a>
		</div>
	</td>
</tr>
<tr height="110px">
	<td align="center" width="160px">
		<div class="blok" style="background:url('akademik.png') center no-repeat #5a35b6" onclick="jumpTo('../akademik/')"></div>
	</td>
	<td align="center" width="160px">
		<div class="blok" style="background:url('psb.png') center no-repeat #298cef" onclick="jumpTo('../psb/')"></div>
	</td>
	<td align="center" width="160px">
		<!--div class="blok" style="background:url('perpus.png') center no-repeat #0858c6" onclick="jumpTo('../perpus/login.php')"></div-->
		<div class="blok" style="background:url('perpus.png') center no-repeat #0858c6" onclick="jumpTo('../perpustakaan/')"></div>
	</td>
	<td align="center" width="160px">
		<div class="blok" style="background:url('sarpras.png') center no-repeat #009400" onclick="jumpTo('../sarpras/')"></div>
	</td>
</tr>
<tr>
	<td align="center"><div class="blbl" >Akademik</div></td>
	<td align="center"><div class="blbl" >Penerimaan Siswa Baru</div></td>
	<td align="center"><div class="blbl" >Perpustakaan</div></td>
	<td align="center"><div class="blbl" >Sarana Prasarana</div></td>
</tr>
<tr height="20px">
	<td colspan="4"></td>
</tr>
<tr height="110px">
	<td align="center" width="160px">
		<div class="blok" style="background:url('employee.png') center no-repeat #0858c6" onclick="jumpTo('../sisfohrd/')"></div>
	</td>
	<td align="center" width="160px">
		<div class="blok" style="background:url('keuangan.png') center no-repeat #009400" onclick="jumpTo('../keuangan/')"></div>
	</td>
	<td align="center" width="160px">
		<!--div class="blok" style="background:url('repo.png') center no-repeat #2173b6" onclick="jumpTo('../smsgateway/login.php')"></div-->
		<div class="blok" style="background:url('repo.png') center no-repeat #2173b6" onclick="jumpTo('../repository')"></div>
	</td>
	<td align="center" width="160px">
		<div class="blok" style="background:url('report.png') center no-repeat #da5632" onclick="jumpTo('../manajemen/')"></div>
	</td>
</tr>
<tr>
	<td align="center"><div class="blbl" >Kepegawaian</div></td>
	<td align="center"><div class="blbl" >Keuangan</div></td>
	<td align="center"><div class="blbl" >Repository</div></td>
	<td align="center"><div class="blbl" >Manajemen</div></td>
</tr>
</table>
</body>
</html>
