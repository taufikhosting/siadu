<?php
function cicilan_r(&$a){
	$res=Array(); $in=false; $d=0;
	$sql="SELECT * FROM psb_angsuran ORDER BY cicilan";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['cicilan']]=$r['cicilan'].' bulan';
		if($d==0)$d=$r['cicilan']; if($r['cicilan']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function cicilan_name($a){
	return dbFetch("cicilan"," psb_angsuran","W/replid='$a'");
}
?>