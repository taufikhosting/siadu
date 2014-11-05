<?php
session_start();

require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find training title or type...";
$search_action=RLNK."training.php";
$cview="training";  // current view
$ct_bg="desktop.png";
$ct_title="Training";

?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'pagelink.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript">
function open_popbox(){
	E('popblock').style.display=''; E('popbox').style.display='';
}
function close_popbox(){
	E('popblock').style.display='none'; E('popbox').style.display='none';
	E('popinput').value='';
}
function popbox_save(){
	var v=E('popinput').value;
	_('popbox&t=p_train&opt=a&v='+v,function(r){E('type').innerHTML=r;close_popbox();});
}
/***** Fading  xfadeout('<id>',1,0,1); *****/
function fadeBg(a){
	var t=E(a).style.backgroundColor;
	E(a).style.backgroundColor='#fffea8';
	setTimeout("E('"+a+"').style.backgroundColor='"+t+"'",2000);
}
/********** Page Training **********/
function p_train(o,cid,g){
	var fmod="p_train";
	var f=new Array('title','type','host','place','date1','date2','speaker','participant');
	var pl=E('pagelink').value;
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v+pl;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();var ne=E('newentry').value;if(ne!='E') fadeBg(ne)});}
}

</script>
</head><body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top"><?php require_once(VWDIR.'banner.php');?></tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr>
		<td><?php require_once(VWDIR.'tabs.php');?></td>
		<td align="right"><?php require_once(WGDIR.'search.php');?></td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="ct_box"> 
				<div class="tview"><b><?=$ct_title?></b></span></div>
				<!-- ========= CONTENT ========= -->
				<div id="tp_train"><?php require_once(VWDIR.'p_train.php'); ?></div>
				<!-- ========= END OF CONTENT ========= -->
			</div>
		</td>
	</tr>
	</table>
</td></tr>
</table>
<?php require_once(VWDIR.'footer.php');?>
</div>
<div id="fform_bg" style="display:none;opacity:0"></div>
<div id="fform" style="display:none;opacity:0"></div>
</body>
</html>