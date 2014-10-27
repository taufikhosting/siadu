<script type="text/javascript" language="javascript">
/** Floating Form **/
function close_fform(){
	$("#fform_bg").animate({ opacity: "0" }, 100 , function(){ E('fform_bg').style.display='none'; });
	$("#fform").animate({ opacity: "0" }, 100 , function(){ E('fform').style.display='none'; });
	E('fform').innerHTML='';
}
function open_fform(){
	E('fform_bg').style.opacity='1'; E('fform').style.opacity='1';
	E('fform_bg').style.display=''; E('fform').style.display='';
}
function bFBa(a){
	E('fformbox').style.border='1px solid #fff';
	if(a>0){
		a--;
		setTimeout("bFBb("+a+")",80);
	}
}
function bFBb(a){
	E('fformbox').style.border='';
	if(a>0){
		a--;
		setTimeout("bFBa("+a+")",80);
	}
}
function blinkFbox(e){
	 if(e.target.id=='fform'||e.target.id=='fformt') bFBa(3);
}
/** End of Floating Form **/
</script>
<div id="fform_bg" style="display:none;opacity:0"></div>
<div id="fform" style="display:none;opacity:0" onclick="blinkFbox(event)"></div>