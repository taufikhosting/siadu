<?php
$un=dbFetch("alias","mstr_user","W/dcid='1'");
?>
<style type="text/css">
#topsection{
background:<?=CBLUE?>;
height: 60px; /*Height of top section*/
position:fixed;top:0;left:0;width:100%
}

#topsection h1{
margin: 0;
padding-top: 15px;
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
.logo{
	height:23px;width:250px;background:url('<?=IMGR?>siadu_46.png') no-repeat;
	color:#eeeeff;
	padding-left:54px;
	padding-top:37px;
	font:bold 11px Arial;
}
</style>
<div id="topsection"><div class="innertube">
<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr valign="top">
<td rowspan="2">
	<div class="logo">Library Management System</div>
</td>
<td align="right" style="<?=SFONT12?>;color:#fff" colspan="2">
	<div style="padding-top:4px">
	Welcome: <b><?=$un?></b>&nbsp;&bull;&nbsp;
	Login at: <?=ftgl(date("Y-m-d"))?>, <?=date("H:i:s")?>&nbsp;&bull;&nbsp;
	<a class="linkw" style="text-decoration:underline" href="<?=RLNK?>login.php">Logout</a>
	</div>
</td>
<tr valign="bottom">
	<td style="padding-bottom:6px">
		<a class="tab_link" href="<?=RLNK?>bibliographic.php?tab=catalog&act=new" style="background:url('<?=IMGR?>main.png') no-repeat;background-position:0 0;">New Book Catalog</a>
		<a class="tab_link" href="javascript:void(0)" style="background:url('<?=IMGR?>main.png') no-repeat;background-position:0 -20px;margin-left:30px">Member Registration</a>
	</td>
	<td align="right" width="250px" style="padding-bottom:6px">
		<?php require_once(WGDIR.'search.php');?>
	</td>
</tr>
</tr></table>
</div></div>