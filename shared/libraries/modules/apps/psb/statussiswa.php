<?php
function statussiswa_r($a=1){
	$res=Array(); if($a==0)$res[0]='-';
	$t=mysql_query("SELECT * FROM psb_statussiswa ORDER BY urutan");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['status'];
	}
	return $res;
}
function statussiswa_name($a){
	return dbFetch("status","psb_statussiswa","W/replid='$a'");
}

function kondisisiswa_r($a=1){
	$res=Array(); if($a==0)$res[0]='-';
	$t=mysql_query("SELECT * FROM psb_kondisisiswa ORDER BY urutan");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kondisi'];
	}
	return $res;
}
?>