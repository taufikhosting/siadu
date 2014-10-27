<?php
function golongan_r(&$a){
	$res=Array(); $in=false; $d=0;
	$sql="SELECT * FROM  psb_golongan ORDER BY urut";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['golongan'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function golongan_name($a){
	return dbFetch("golongan"," psb_golongan","W/replid='$a'");
}
?>