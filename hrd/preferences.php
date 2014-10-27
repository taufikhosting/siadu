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
$ct_title="Preferences";
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<?php require_once(SYDIR.'preferences.php');?>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript">
/********** Master Status **********/
function m_status(o,cid,g){
	var fmod="m_status";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();m_remstat('rf')});}
}
/********** Master Level **********/
function m_level(o,cid,g){
	var fmod="m_level";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master position **********/
function m_position(o,cid,g){
	var fmod="m_position";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master Division **********/
function m_division(o,cid,g){
	var fmod="m_division";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}
/********** Master Group **********/
function m_group(o,cid,g){
	var fmod="m_group";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}
/********** Master Document **********/
function m_document(o,cid,g){
	var fmod="m_document";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();m_remdoc('rf')});}
}
/********** Master family **********/
function m_family(o,cid,g){
	var fmod="m_family";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master Religion **********/
function m_religion(o,cid,g){
	var fmod="m_religion";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}
/********** Master Marital **********/
function m_marital(o,cid,g){
	var fmod="m_marital";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master Traintype **********/
function m_traintype(o,cid,g){
	var fmod="m_traintype";
	var f=new Array('name');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master Remstat **********/
function m_remstat(o,cid,g){
	var fmod="m_remstat";
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){var f=E('inparray').value.split("-"); for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** Master Remdoc **********/
function m_remdoc(o,cid,g){
	var fmod="m_remdoc";
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){var f=E('inparray').value.split("-");for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform()});}
}

/********** MASTER USER **********/
function m_user(o,g,cid){
	var v="";
	var f=new Array('name','alias','password0','password1','password2');
	if(g){
	for(var i=0;i<f.length;i++){
		var fi=f[i];
		v=v+"&"+fi+"="+E(fi).value;
	}}
	
	if(o=='af' || o=='uf' || o=='df'){
		_POST('m_user&opt='+o+"&cid="+cid+v,function(r){
			E('fform').innerHTML=r;
			open_fform();
		});
	}
	else {
		_POST('m_user&opt='+o+"&cid="+cid+v,function(r){
			E('tm_user').innerHTML=r;
			close_fform();
		});
	}
}

function showadv(){
	if(E('advpref').style.display!='none'){
		E('advpref').style.display='none';
		E('advprefk').innerHTML='Show advanced preferences...';
	} else {
		E('advpref').style.display='';
		E('advprefk').innerHTML='Hide advanced preferences...';
	}
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
			<div id="prefbox" style="width:800px">
				<div class="pftitle">Master Data</div>
					<div class="pfsub">Employee status</div>
					<table id="tm_status" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_status.php'); ?>
					</table>
					<button class="btn" onclick="m_status('af')" style="margin:10px 0 0 20px">Add new employee status</button>
					
					<div class="pfsub">Employee level</div>
					<table id="tm_level" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_level.php'); ?>
					</table>
					<button class="btn" onclick="m_level('af')" style="margin:10px 0 0 20px">Add new employee level</button>
					
					<div class="pfsub">Employee division</div>
					<table id="tm_division" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_division.php'); ?>
					</table>
					<button class="btn" onclick="m_division('af')" style="margin:10px 0 0 20px">Add new employee division</button>
					
					<div class="pfsub">Employee group</div>
					<table id="tm_group" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_group.php'); ?>
					</table>
					<button class="btn" onclick="m_group('af')" style="margin:10px 0 0 20px">Add new employee group</button>
					
					<div class="pfsub">Employee position</div>
					<table id="tm_position" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_position.php'); ?>
					</table>
					<button class="btn" onclick="m_position('af')" style="margin:10px 0 0 20px">Add new employee position</button>
					
					<div class="pfsub">Employee document</div>
					<table id="tm_document" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_document.php'); ?>
					</table>
					<button class="btn" onclick="m_document('af')" style="margin:10px 0 0 20px">Add new employee document</button>
					
					<div class="pfsub">Employee family relation</div>
					<table id="tm_family" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_family.php'); ?>
					</table>
					<button class="btn" onclick="m_family('af')" style="margin:10px 0 0 20px">Add new employee family relation</button>
					
					<div class="pfsub">Marital status</div>
					<table id="tm_marital" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_marital.php'); ?>
					</table>
					<button class="btn" onclick="m_marital('af')" style="margin:10px 0 0 20px">Add new marital status</button>

					<div class="pfsub">Religion</div>
					<table id="tm_religion" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_religion.php'); ?>
					</table>
					<button class="btn" onclick="m_religion('af')" style="margin:10px 0 0 20px">Add new religion</button>
					
					<div class="pfsub">Training type</div>
					<table id="tm_traintype" class="preftbl" cellspacing="0px" cellpadding="8px">
						<?php require_once(VWDIR.'m_traintype.php'); ?>
					</table>
					<button class="btn" onclick="m_traintype('af')" style="margin:10px 0 0 20px">Add new training type</button>
				
				<div class="pftitle">Reminders</div>
					<div class="pfsub">Status reminder</div>
					<table id="tm_remstat" class="preftbl2" cellspacing="1px" cellpadding="8px">
						<?php require_once(VWDIR.'m_remstat.php'); ?>
					</table>
					<button class="btn" onclick="m_remstat('uf')" style="margin:10px 0 0 20px">Set status reminders...</button>
					
					<div id="tm_remdoc">
					<?php require_once(VWDIR.'m_remdoc.php'); ?>
					</div>
					
				<div id="advpref" style="display:none">
				<div class="pftitle">Users</div>
				<div style="width:600px;margin-left:20px;"><p style="fonnt-family:'Segoe UI', Tahoma, sans-serif;font-size:11px;line-height:200%">Admin have full acces to informations in this software, while Staff only able to view information in this application and not able to modify or delete.</p></div>
				<table id="tm_user" class="preftbl" cellspacing="0px" cellpadding="8px">
					<?php require_once(APPDIR.'m_user_table.php'); ?>
				</table>
				<button class="btn" onclick="m_user('af',false,0)" style="margin:10px 0 0 20px">Add new user</button>
				<br/><br/>
				</div>
				<br/><br/>
				<a id="advprefk" href="javascript:showadv()" class="linkl11">Show advanced preferences...</a>
				</div>
			</div><br/><br/><br/>
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