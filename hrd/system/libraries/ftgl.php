<?php
$MNTHN=Array('','January','February','March','April','May','June','July','August','September','October','November','December');
$MNTHS=Array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
function diffDay($t1,$t2){
	$stamp1 = strtotime($t1);
	$stamp2 = strtotime($t2);
	$difstamp = abs($stamp1-$stamp2);
	$difday = intval($difstamp/86400);
	$jmlhari=$difday+1;
	return $jmlhari;
}
function ftgl($a){
	global $MNTHS;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return $MNTHS[intval($b[1])]." ".intval($b[2]).", ".$b[0];
	}
}
function fstgl($a){
	global $MNTHS;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	$c=substr($b[0],2,2);
	return $MNTHS[intval($b[1])]." ".intval($b[2]).", '".$c;
	}
}
function fftgl($a){
	global $MNTHN;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return $MNTHN[intval($b[1])]." ".intval($b[2])." ".$b[0];
	}
}
function fhtgl($a){
	global $MNTHN;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return $MNTHN[intval($b[1])]."/".intval($b[2])."/".$b[0];
	}
}?>