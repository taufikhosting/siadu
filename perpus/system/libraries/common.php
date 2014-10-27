<?php
define("SFONT","'Segoe UI',Verdana,Tahoma");
define("SFONT11","font:11px ".SFONT.";");
define("SFONT12","font:12px ".SFONT.";");
define("SFONT12B","font:bold 12px ".SFONT.";");
define("SFONT14","font:14px ".SFONT.";");
define("SFONT14B","font:bold 14px ".SFONT.";");
define("VFONT","Verdana,Tahoma,Arial");
define("VFONT11","font:11px ".VFONT.";");
define("VFONT11B","font:bold 12px ".VFONT.";");
define("CBLUE","#1c64d1");
define("CLGREY","#999");
define("CDARK","#646464");
define("CLBLUE","#468ad2");

define("TBORDER","border:1px dotted red !important;");
define("STBORDER",'style="border:1px dotted red !important"');

function gets($n){
if(isset($_GET[$n])){return $_GET[$n];}else{return "";}
}
function gpost($n){
if(isset($_POST[$n])){return $_POST[$n];}else{return "";}
}
function getsx($n){
if(isset($_GET[$n])){return $_GET[$n];}else{return gpost($n);}
}
function getExtension($str){
$i=strrpos($str,".");if(!$i){return "";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;
}
//require_once(SYSDIR.'request/xmlhttprequest.php');
/***** Misc... *****/
function getStrA($a,$d){
	$k=0; $res="";
	foreach($a as $key=>$val){
		if($k>0) $res.=$d;
		$res.="'$val'"; $k++;
	}
	return $res;
}
function getStrAK($a,$d){
	$k=0; $res="";
	foreach($a as $key=>$val){
		if($k>0) $res.=$d;
		$res.="'$key'"; $k++;
	}
	return $res;
}
?>