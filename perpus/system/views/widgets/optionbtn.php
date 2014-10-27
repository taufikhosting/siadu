<?php 
function optionbtn_edit($a='',$b=0){
	$s ='<button class="btn" style="float:left;'.($b==0?'margin-right:2px;':'').'width:24px" title="Edit" onclick="'.$a.'">';
	$s.='<div class="bi_editb">&nbsp;</div></button>';
	return $s;
}
function optionbtn_del($a='',$b=0){
	$s ='<button class="btn" style="float:left;'.($b==0?'margin-right:2px;':'').'width:24px" title="Delete" onclick="'.$a.'">';
	$s.='<div class="bi_delb">&nbsp;</div></button>';
	return $s;
}
function optionbtn_view($a='',$b=0){
	$s ='<button class="btn" style="float:left;'.($b==0?'margin-right:2px;':'').'width:24px" title="View details" onclick="'.$a.'">';
	$s.='<div class="bi_srcb">&nbsp;</div></button>';
	return $s;
}
?>