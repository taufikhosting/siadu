<?php
$MNTHN=Array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$MNTHS=Array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Dec');

function ftgl_namabulan($a){
	global $MNTHN;
	return $MNTHN[$a];
}
function diffDay($t1,$t2="",$a=false){
	if($t2=="") $t2=date("Y-m-d");
	$stamp1 = strtotime($t1);
	$stamp2 = strtotime($t2);
	$difstamp = $stamp1-$stamp2;
	$difday = intval($difstamp/86400);
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
	return intval($b[2])." ".$MNTHN[intval($b[1])]." ".$b[0];
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
function fftgljam($d){
	$c=explode(" ",$d); $a=fftgl($c[0]);
	return $a.($a=='-'?'':', '.$c[1]);
}
function ftgljam($d){
	$c=explode(" ",$d); $a=ftgl($c[0]);
	return $a.($a=='-'?'':' '.$c[1]);
}
function ffjm($a=''){
	if($a=='') $a=date("H:i:s");
	$b=explode(":",$a);
	return $b[0].":".$b[1];
}
?>