<?php
function xtable_opt($n,$a=''){
	$s='<div style="'.SFONT12.'">';
	if($n>1){
	$s.='Option:&nbsp;&nbsp;&nbsp;';
	$s.='<a class="linkb" href="javascript:checkAll(true)">Check all</a> / <a class="linkb" href="javascript:checkAll(false)">Uncheck all</a>';
	$s.='<span id="xdel" style="display:none">&nbsp;:&nbsp;&nbsp;<a class="linkb" href="javascript:void(0)" onclick="'.$a.'">Delete selected</a></span>';
	} else {
	$s.'<span id="xdel" style="display:none">Option:&nbsp;:&nbsp;&nbsp;<a class="linkb" href="javascript:checkAll(true)">Delete selected</a></span>';
	}
	$s.='</div>';
	return $s;
}
function iThx($t,$s,$p,$b,$m,$q,$y=""){
	$img="";
	if($s==$b){
		$c="a";
		$img="<img src=\"".IMGR."sort".$m.".png\" style=\"float:right\" />";
	} else {
		$m=0;
		$c="";
	}
	return "<td class=\"xth\"><button class=\"xlink$c\" ".($y==""?"":" style=\"".$y."\" ")."title=\"Sort by ".strtolower($t)."\" onclick=\"jumpTo('".pageLink($p,$s,$m,$q)."')\">".$t.$img."</button></td>";
}
function iThxp($t,$s,$p,$b,$m,$q,$y=""){
	$img="";
	if($s==$b){
		$c="a";
		$img="<img src=\"".IMGR."sort".$m.".png\" style=\"float:right\" />";
	} else {
		$m=0;
		$c="";
	}
	return "<td class=\"xth\"><button class=\"xlink$c\" ".($y==""?"":" style=\"".$y."\" ")."title=\"Sort by ".strtolower($t)."\" onclick=\"jumpTo('".pageLinkp($p,$s,$m,$q)."')\">".$t.$img."</button></td>";
}
?>
<style type="text/css">
.xtable {
	border-collapse:collapse;
	border-left:1px solid #a7c2fa;
	border-bottom:1px solid #a7c2fa;
	border-right:1px solid #a7c2fa;
}

.xtdh {
	color:#fff !important;
	background:url('<?=IMGR?>thbg.png') repeat-x #a7c2fa;
	padding:0 4px; margin:0;
	height:24px;
	font:bold 11px Verdana, Tahoma !important;
	border:none;
	cursor:default;
	text-align:left;
}

.xlinka {
	color:ffffff;
	font:bold 11px Verdana, Tahoma;
	background:url('<?=IMGR?>thbg1.png') repeat-x #a7c2fa;
	border:none;
	padding:0 4px; margin:0;
	height:100%;
	width:100%;
	cursor:pointer;
	text-align:left;
}
.xlink {
	color:ffffff;
	background:url('<?=IMGR?>thbg.png') repeat-x #a7c2fa;
	padding:0 4px; margin:0;
	height:100%;
	font:bold 11px Verdana, Tahoma;
	border:none;
	width:100%;
	cursor:pointer;
	text-align:left;
}
.xlink:hover {
	background:url('<?=IMGR?>thbg1.png') repeat-x #a7c2fa;
}
.xth{
	padding:0;
	height:24px;
}
.xr0 {
	background-color:#f4f4f4;
}
.xr0:hover{
	background-color:#ddedff;
}
.xr0:active{
	background-color:#bed6f1;
}
.xr0 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:36px;
	font-weight:inherit;
}
.xr1 {
	background-color:#ffffff;
}
.xr1:hover{
	background-color:#ddedff;
}
.xr1:active{
	background-color:#bed6f1;
}
.xr1 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:30px;
	font-weight:inherit;
}

.xxr0 {
	background-color:#f4f4f4;
}
.xxr0:hover{
	background-color:#ddedff;
}
.xxr0 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:30px;
	font-weight:inherit;
}
.xxr1 {
	background-color:#ffffff;
}
.xxr1:hover{
	background-color:#ddedff;
}
.xxr1 td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:30px;
	font-weight:inherit;
}

.xra,.xxra {
	background-color:#fff600;
}

.xra td,.xxra td {
	font:11px Verdana, Tahoma;
	padding:4px;
	color:#323232;
	cursor:default;
	height:30px;
	font-weight:inherit;
}
.btnbar{
	height:30px;
}
.btn_fl{
	height:24px;
	padding:0 6px 1px 6px;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0px 4px 0px 0px;
	float:left;
}
.btn_fl:hover {
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.btn_fl:active {
	<?=cssGrad("#ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%","#e2e2e2")?>
	box-shadow:none;
}
.optbar{
	padding-top:6px;
}
</style>
<script type="text/javascript" language="javascript">
function selectRow(r){
	var a=parseInt(r);
	var c=E('xcek'+a).checked;
	if(E('xcek'+a).checked){
		E('xcek'+a).checked=false;
		
		E('xrow'+E('xcek'+a).value).className='xxr'+((a+1)%2);
	} else {
		E('xcek'+a).checked=true;
		E('xrow'+E('xcek'+a).value).className='xxra';
	}
	var n=parseInt(E('xnrow').value); var l=0;
	for(var i=1;i<n;i++){
		if(E('xcek'+i).checked) l++;
	}
	E('xcek0').checked=(l==(n-1));
	if(l>0){
		E('xdel1').style.display='';
		E('xdel2').style.display='';
	} else {
		E('xdel1').style.display='none';
		E('xdel2').style.display='none';
	}
	EHide('newemsg');
}
function checkRow(r,c){
	var a=parseInt(r);
	if(E('xcek'+a).checked){
		E('xrow'+E('xcek'+a).value).className='xxra';
	} else {
		E('xrow'+E('xcek'+a).value).className='xxr'+((a+1)%2);
	}
	var n=parseInt(E('xnrow').value); var l=0;
	for(var i=1;i<n;i++){
		if(E('xcek'+i).checked) l++;
	}
	E('xcek0').checked=(l==(n-1));
	if(l>0){
		E('xdel1').style.display='';
		E('xdel2').style.display='';
	} else {
		E('xdel1').style.display='none';
		E('xdel2').style.display='none';
	}
	EHide('newemsg');
}
function checkAll(a){
	var n=parseInt(E('xnrow').value);
	E('xcek0').checked=a;
	for(var i=1;i<n;i++){
		E('xcek'+i).checked=a;
		if(a) E('xrow'+E('xcek'+i).value).className='xxra';
		else E('xrow'+E('xcek'+i).value).className='xxr'+((i+1)%2);
	}
	if(a){
		E('xdel1').style.display='';
		E('xdel2').style.display='';
	} else {
		E('xdel1').style.display='none';
		E('xdel2').style.display='none';
	}
}
</script>