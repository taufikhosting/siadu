<?php
$un=dbFetch("alias","mstr_user","W/dcid='1'");
?>
<style type="text/css">
#topsection{ position:absolute; top:0px;left:0px; background:<?=CBLUE?>; height:50px; width:100% }

#topsection h1{ margin: 0; padding-top: 15px }

.inner10{
margin: 10px; /*Margins for inner DIV inside each column (to provide padding)*/
margin-top: 0;
}

.tab_link { <?=SFONT12?>; color:#fff; text-decoration:none; display:block;height:16px; float:left; padding:2px 0 0 20px }

.tab_link:hover {
	text-decoration:underline;
}
.vitalogo{
	height:23px;width:174px;background:url('<?=IMGR?>logo.png') no-repeat;
	color:#fff;
	<?=SFONT12?>;
	padding-left:50px;
	padding-top:30px;
}
</style>
<div id="topsection"><div class="inner10">
	<div class="vitalogo">Library Management Software</div>
</div></div>