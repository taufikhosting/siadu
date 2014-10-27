<?php
$MNTHN=Array('','January','February','March','April','May','June','July','August','September','October','November','December');
$MNTHS=Array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

function diffDay($t1,$t2="",$a=false){
	if($t2=="") $t2=date("Y-m-d");
	$stamp1 = strtotime($t1);
	$stamp2 = strtotime($t2);
	$difstamp = $stamp1-$stamp2;
	$difday = intval(ceil($difstamp/86400));
	if($a) $difday=abs($difday);
	return $difday;
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
	return $MNTHN[intval($b[1])]." ".intval($b[2]).", ".$b[0];
	}
}
function fhtgl($a){
	global $MNTHN;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return intval($b[1])."/".intval($b[2])."/".$b[0];
	}
}
?>