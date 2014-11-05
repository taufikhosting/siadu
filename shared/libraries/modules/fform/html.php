<?php if(empty($fformid)) $fformid=''; ?>
<script type="text/javascript" language="javascript">
/** Floating Form **/
function close_fform<?=$fformid?>(){
	if(E('fform<?=$fformid?>').style.display!='none'){
		$('#fform_bg<?=$fformid?>').animate({ opacity: '0' }, 100 , function(){ E('fform_bg<?=$fformid?>').style.display='none'; });
		$('#fform<?=$fformid?>').animate({ opacity: '0' }, 100 , function(){ E('fform<?=$fformid?>').style.display='none'; });
		E('fform<?=$fformid?>').innerHTML='';
	}
}
function open_fform<?=$fformid?>(r,p){
	r = typeof r !=='undefined'?r:'';
	p = typeof p !=='undefined'?p:'fixed';
	E('fform<?=$fformid?>').style.position=p;
	if(r!=''){
		E('fform<?=$fformid?>').innerHTML=r;
	}
	if(E('fform<?=$fformid?>').style.display=='none'){
		E('fform_bg<?=$fformid?>').style.opacity='0';
		E('fform<?=$fformid?>').style.opacity='0';
		
		E('fform_bg<?=$fformid?>').style.display='';
		E('fform<?=$fformid?>').style.display='';
		
		$('#fform_bg<?=$fformid?>').animate({ opacity: '1' }, 100);
		$('#fform<?=$fformid?>').animate({ opacity: '1' }, 100);
	}
}
function bFBa<?=$fformid?>(a){
	E('fformbox<?=$fformid?>').style.border='1px solid #fff';
	if(a>0){
		a--;
		setTimeout('bFBb<?=$fformid?>('+a+')',80);
	}
}
function bFBb<?=$fformid?>(a){
	E('fformbox<?=$fformid?>').style.border='';
	if(a>0){
		a--;
		setTimeout('bFBa<?=$fformid?>('+a+')',80);
	}
}
function blinkFbox<?=$fformid?>(e){
	 if(e.target.id=='fform<?=$fformid?>'||e.target.id=='fformt<?=$fformid?>') bFBa<?=$fformid?>(3);
}
/** End of Floating Form **/
</script>
<div id="fform_bg<?=$fformid?>" class="fform_bg" style="display:none;opacity:0"></div>
<div id="fform<?=$fformid?>" class="fform" style="display:none;opacity:0" onclick="blinkFbox<?=$fformid?>(event)"></div>