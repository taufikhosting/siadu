<?php
session_start();
$loginpage=false;
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="employee";  // current view
$ct_bg="folderico.png";
$ct_title="Add new employee";
function tdLabel($a,$s="",$w="150px",$cs=0){
	$s=($s=="L")?"text-align:left":$s;
	return "<td width=\"".$w."\"".(($cs==0)?"":" colspan=\"".$cs."\"")." align=\"right\" style=\"padding-right:6px;".$s."\">$a:</td>";
}
// Global Variables
$mstr_marital=MstrGet("mstr_marital");
$mstr_religion=MstrGet("mstr_religion");
$mstr_family=MstrGet("mstr_family");
?>
<html><head>
<?php require_once(VWDIR.'style.php');?>

<style type="text/css">.preftbl{border-radius:2px;padding:1px;border-collapse:collapse}.preftbl tr{border:1px solid #d0d0d0; height:16px;background:#ffffff}.preftbl td{font:11px 'Segoe UI', Tahoma, sans-serif;color:#303942}.preftbl tr:hover{background:#e4ecf7}.prefdel{border:none;width:15px;height:15px;background:url('<?=IMGR?>pfr_del0.png')center no-repeat;cursor:pointer}.prefdel:hover{background:url('<?=IMGR?>pfr_del1.png')center no-repeat}.prefopt{visibility:hidden;width:100px}.preftbl tr:hover .prefopt{visibility:visible}
#sdopt input {
	margin:0;padding:0;
}
#sdopt tr td{
	<?=cssFontBody()?>
}
#apospt input {
	margin:0;padding:0;
}
#apospt tr td{
	<?=cssFontBody()?>
}
</style>

<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript">
var eb_count=1;
function close_fform2(){
	$("#fform_bg2").animate({ opacity: "0" }, 100 , function(){ E('fform_bg2').style.display='none'; });
	$("#fform").animate({ opacity: "0" }, 100 , function(){ E('fform').style.display='none'; });
	E('fform').innerHTML='';
}

function open_fform2(){
	E('fform_bg2').style.opacity='1'; E('fform').style.opacity='1';
	E('fform_bg2').style.display=''; E('fform').style.display='';
	//$("#fform_bg2").animate({ opacity: "1" }, 50);
	//$("#fform").animate({ opacity: "1" }, 50);
}
/***** Pop Box *****/
function open_popbox(a){
	E('popd_'+a).style.position='relative';
	E('popb_'+a).style.display=''; E('popx_'+a).style.display='';
	E('popi_'+a).focus();
}
function close_popbox(a){
	E('popb_'+a).style.display='none'; E('popx_'+a).style.display='none';
	E('popd_'+a).style.position='static';
	E('popi_'+a).value='';
}
function popbox_save(a){
	var v=E('popi_'+a).value;
	_('popbox&t='+a+'&opt=a&v='+v,function(r){E(a).innerHTML=r;close_popbox(a);});
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
function addEntry(t,a){
	_("entrybox&t="+t+"&opt="+a,function(r){
		E('fform').innerHTML=r;
		open_fform2()
	});
}
function saveEntry(r){
	r();close_fform2();
}
function removeEntry(a,c){
	var regentry = new Array('eb_family','eb_education','eb_course','eb_organization','eb_jobhis','eb_reference');
	E('r'+regentry[a]+c).style.display='none';
	E('r'+regentry[a]+c).innerHTML='';
	E('a'+regentry[a]).style.display='';
}
/* Add entry family */
function feb_family(){
	<?=getJsArray('mstr_family',$mstr_family)?>
	
	//<input type="hidden" id="eb_inparray" value="eb_family,eb_name,eb_address,eb_education,eb_birthplace,eb_birthdate,eb_job"/>
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_family'+i).style.display=='none'){
			a=i; break;
		}
	}
	var familyid=E('eb_family').value;
	var family=mstr_family[familyid];
	var name=E('eb_name').value;
	var address=E('eb_address').value;
	var education=E('eb_education').value;
	var birthplace=E('eb_birthplace').value;
	var birthdate=E('eb_birthdate').value;
	var birthdatef=E('eb_birthdatef').value;
	var job=E('eb_job').value; 
	var line2=(address!=""?"<div class='pdiv'>Address: "+address+".</div>":"");
	var respon="<td width='615px'><div class='pdiv'><b>"+family+": "+name+"</b></div>"+line2+"Birth: "+birthplace+", "+birthdatef+". Education: "+education+". Job: "+job+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(0,"+a+")'/></div>"+
	"<input type='hidden' name='family_family"+a+"' value='"+familyid+"'/>"+
	"<input type='hidden' name='family_name"+a+"' value='"+name+"'/>"+
	"<input type='hidden' name='family_address"+a+"' value='"+address+"'/>"+
	"<input type='hidden' name='family_education"+a+"' value='"+education+"'/>"+
	"<input type='hidden' name='family_birthplace"+a+"' value='"+birthplace+"'/>"+
	"<input type='hidden' name='family_birthdate"+a+"' value='"+birthdate+"'/>"+
	"<input type='hidden' name='family_job"+a+"' value='"+job+"'/>"+
	"</td>";
	
	E('reb_family'+a).innerHTML=respon;
	E('reb_family'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_family'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_family').style.display='none';
	}
}

/* Add entry education */
function feb_education(){	
	//<input type="hidden" id="eb_inparray" value="eb_university,eb_year,eb_title,eb_field,eb_score"/>
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_education'+i).style.display=='none'){
			a=i; break;
		}
	}
	
	var university=E('eb_university').value;
	var year=E('eb_year').value;
	var title=E('eb_title').value;
	var field=E('eb_field').value;
	var score=E('eb_score').value;
	
	var ttile=title!=""?"Title: <b>"+title+"</b> ":"";
	var tscore=score!=""?"Score: <b>"+score+"</b>.":"";

	var respon="<td width='615px'><div class='pdiv'><b>"+university+" ("+year+")</b></div>"+ttile+
	"Field: <b>"+field+"</b>. "+tscore+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(1,"+a+")'/></div>"+
	"<input type='hidden' name='education_university"+a+"' value='"+university+"'/>"+
	"<input type='hidden' name='education_year"+a+"' value='"+year+"'/>"+
	"<input type='hidden' name='education_title"+a+"' value='"+title+"'/>"+
	"<input type='hidden' name='education_field"+a+"' value='"+field+"'/>"+
	"<input type='hidden' name='education_score"+a+"' value='"+score+"'/>"+
	"</td>";
	
	E('reb_education'+a).innerHTML=respon;
	E('reb_education'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_education'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_education').style.display='none';
	}
}

/* Add entry course */
function feb_course(){	
	//eb_title,eb_organizer,eb_place,eb_year,eb_certified
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_course'+i).style.display=='none'){
			a=i; break;
		}
	}
	
	var title=E('eb_title').value;
	var organizer=E('eb_organizer').value;
	var place=E('eb_place').value;
	var year=E('eb_year').value;
	var certified=(E('eb_certified').checked)?'Y':'N';

	var respon="<td width='615px'><div class='pdiv'><b>\""+title+"\"</b> by <b>"+organizer+((E('eb_certified').checked)?" (Certifed)":"")+"</b></div>"+
	"Place: <b>"+place+"</b>. on: <b>"+year+"</b>"+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(2,"+a+")'/></div>"+
	"<input type='hidden' name='course_title"+a+"' value='"+title+"'/>"+
	"<input type='hidden' name='course_organizer"+a+"' value='"+organizer+"'/>"+
	"<input type='hidden' name='course_place"+a+"' value='"+place+"'/>"+
	"<input type='hidden' name='course_year"+a+"' value='"+year+"'/>"+
	"<input type='hidden' name='course_certified"+a+"' value='"+certified+"'/>"+
	"</td>";
	
	E('reb_course'+a).innerHTML=respon;
	E('reb_course'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_course'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_course').style.display='none';
	}
}

/* Add entry organization */
function feb_organization(){	
	//eb_name,eb_position,eb_year
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_organization'+i).style.display=='none'){
			a=i; break;
		}
	}
	
	var name=E('eb_name').value;
	var position=E('eb_position').value;
	var year=E('eb_year').value;
	var p=position.substr(0,1).toLowerCase();
	var q=(p=='a'||p=='i'||p=='u'||p=='e'||p=='o')?"an":"a";
	var respon="<td width='615px'><div class='pdiv'>In <b>"+name+"</> as "+q+" </b>"+position+"</b></div>"+
	"on: <b>"+year+"</b>"+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(3,"+a+")'/></div>"+
	"<input type='hidden' name='organization_name"+a+"' value='"+name+"'/>"+
	"<input type='hidden' name='organization_position"+a+"' value='"+position+"'/>"+
	"<input type='hidden' name='organization_year"+a+"' value='"+year+"'/>"+
	"</td>";
	
	E('reb_organization'+a).innerHTML=respon;
	E('reb_organization'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_organization'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_organization').style.display='none';
	}
}

/* Add entry jobhis */
function feb_jobhis(){
	//eb_name,eb_address,eb_date1,eb_date2,eb_position,eb_salary,eb_reason
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_jobhis'+i).style.display=='none'){
			a=i; break;
		}
	}
	
	var name=E('eb_name').value;
	var address=E('eb_address').value;
	var date1=E('eb_date1').value;
	var date1f=E('eb_date1f').value;
	var date2=E('eb_date2').value;
	var date2f=E('eb_date2f').value;
	var position=E('eb_position').value;
	var salary=E('eb_salary').value;
	var reason=E('eb_reason').value;
	
	var p=position.substr(0,1).toLowerCase();
	var q=(p=='a'||p=='i'||p=='u'||p=='e'||p=='o')?"an":"a";

	var respon="<td width='615px'><div class='pdiv'>Work at <b>"+name+"</b> as "+q+" <b>"+position+"</b></div>"+
	"<div class='pdiv'>Company address: <b>"+address+"</b>.</div><div class='pdiv'>Periode: <b>"+date1f+"</b> until <b>"+date2f+
	"</b>. Salary:<b>"+salary+"</b>.</div>Reason for leaving this job: <i>"+reason+"</i>"+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(4,"+a+")'/></div>"+
	"<input type='hidden' name='jobhis_name"+a+"' value='"+name+"'/>"+
	"<input type='hidden' name='jobhis_address"+a+"' value='"+address+"'/>"+
	"<input type='hidden' name='jobhis_date1"+a+"' value='"+date1+"'/>"+
	"<input type='hidden' name='jobhis_date2"+a+"' value='"+date2+"'/>"+
	"<input type='hidden' name='jobhis_position"+a+"' value='"+position+"'/>"+
	"<input type='hidden' name='jobhis_salary"+a+"' value='"+salary+"'/>"+
	"<input type='hidden' name='jobhis_reason"+a+"' value='"+reason+"'/>"+
	"</td>";
	
	E('reb_jobhis'+a).innerHTML=respon;
	E('reb_jobhis'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_jobhis'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_jobhis').style.display='none';
	}
}

/* Add entry reference */
function feb_reference(){
	//eb_name,eb_address,eb_phone,eb_job,eb_know,eb_relation
	var a=0;
	for(var i=0;i<10;i++){
		if(E('reb_reference'+i).style.display=='none'){
			a=i; break;
		}
	}
	
	var name=E('eb_name').value;
	var address=E('eb_address').value;
	var phone=E('eb_phone').value;
	var job=E('eb_job').value;
	var know=E('eb_know').value;
	var relation=E('eb_relation').value;

	var respon="<td width='615px'><div class='pdiv'>Name: <b>"+name+"</b></div>"+
	"<div class='pdiv'>Address <b>"+address+"</b>. Phone: <b>"+phone+"</b>.</div>Job: <b>"+job+"</b>. Know since: <b>"+know+"</b>. Relation: <b>"+relation+"</b>"+
	"</td><td align='right'><div class='prefopt' style='width:30px'><input type='button' title='Remove' class='prefdel' onclick='removeEntry(5,"+a+")'/></div>"+
	"<input type='hidden' name='reference_name"+a+"' value='"+name+"'/>"+
	"<input type='hidden' name='reference_address"+a+"' value='"+address+"'/>"+
	"<input type='hidden' name='reference_phone"+a+"' value='"+phone+"'/>"+
	"<input type='hidden' name='reference_job"+a+"' value='"+job+"'/>"+
	"<input type='hidden' name='reference_know"+a+"' value='"+know+"'/>"+
	"<input type='hidden' name='reference_relation"+a+"' value='"+relation+"'/>"+
	"</td>";
	
	E('reb_reference'+a).innerHTML=respon;
	E('reb_reference'+a).style.display='';
	
	a=0;
	for(var i=0;i<10;i++){
		if(E('reb_reference'+i).style.display=='none'){
			a++;
		}
	}
	if(a==0){
		E('aeb_reference').style.display='none';
	}
}
var sdrow=6;
function addSdRow(){
	if(sdrow<=20){
		E('sd'+sdrow).style.display='';
		sdrow++;
	}
}
</script>
</head><body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top"><?php require_once(VWDIR.'banner.php');?></tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr><td><?php require_once(VWDIR.'tabs.php');?></td><td align="right"><?php require_once(WGDIR.'search.php');?></td></tr>
	<tr><td colspan="2">
	<div id="ct_box"> 
		<div class="tview"><b><?=$ct_title?></b></span></div>
		<!-- ========= CONTENT ========= -->
		<table cellspacing="0" cellpadding="0" width="940px" style="margin-bottom:2px"><tr height="30px"><td>
			<button class="btn" title="Back to employee list" onclick="jumpTo('<?=RLNK?>employee.php')" style="margin-right:20px">
				<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">Employee list</div>
			</button>
		</td></tr></table>
		<form action="<?=RLNK?>request.php?q=addemployee" method="post" enctype="multipart/form-data" style="padding:0;margin:0">
		<?php require_once(VWDIR.'empform.php');?>
		</form>
		<!-- ========= END OF CONTENT ========= -->
	</div>
	</td></tr>
	</table>
</td></tr>
</table>
<?php require_once(VWDIR.'footer.php');?>
</div>
<div id="fform_bg" style="display:none;opacity:0"></div>
<div id="fform_bg2" style="display:none;opacity:0"></div>
<div id="fform" style="display:none;opacity:0"></div>
</body>
</html>