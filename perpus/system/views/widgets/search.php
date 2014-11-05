<?php
$search_txt="find book...";
$search_action=RLNK.'bookshelf.php';
?>
<style type="text/css">
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
	background:url('<?=IMGR?>find.png')no-repeat;
	background-position:0 0;
	cursor:pointer;
	border:none;
}
#srcbtn:hover {
	background-position:0 -22px;
}
#srcbtn:active {
	background-position:0 -44px;
}
</style>
<script type="text/javascript" language="javascript">function search_foc(){if(E('search_input').value=='<?=$search_txt?>'){E('search_input').value='';}E('search_input').style.color='black';if(E('search_input').style.width!='200px') $("#search_input").animate({"width": "200px"},{queue:false,duration:200});}function search_blur(){if(E('search_input').value==''){E('search_input').value='<?=$search_txt?>';E('search_input').style.color='#999999';$("#search_input").animate({"width": "170px"},{queue:false,duration:200});}}function doSearch(){if(E('search_input').value!=''&&E('search_input').value!='<?=$search_txt?>'){E('srcform').submit();}}</script><div style="margin-right:0px"><form id="srcform" action="<?=$search_action?>" method="get" style="margin:0;padding:0"><table cellspacing="0" cellpadding="0"><tr><td align="right"><input type="text" id="search_input" name="q" value="<?=$search_txt?>" onfocus="search_foc()" onblur="search_blur()" /></td><td width="24px" align="right"><input type="button" id="srcbtn" title="Search" onclick="doSearch()"/></td></tr></table></form></div>