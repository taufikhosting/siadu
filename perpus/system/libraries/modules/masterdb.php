<?php
function MstrGet($a,$n=false,$b=""){
	$res=Array();
	if($n){
		$res[0]=$b;
	}
	$t=mysql_query("SELECT dcid,name FROM `$a` ORDER BY urut,name");
	while($r=mysql_fetch_array($t)){
		$res[$r['dcid']]=$r['name'];
	}
	return $res;
}
function MstrGetx($a,$c="urut",$d=true,$n=false,$b=""){
	$res=Array();
	if($n){
		$res[0]=$b;
	}
	$t=mysql_query("SELECT dcid,name,$c FROM `$a` ORDER BY `$c`");
	while($r=mysql_fetch_array($t)){
		$res[$r['dcid']]=$r['name'].($d==true?" (".$r[$c].")":"");
	}
	return $res;
}
function MstrGetReminder($a,$b){
	if(intval($b)==0) return 0;
	else return intval(dbFetch("reminder","mstr_".$a,"W/dcid='$b'"));
}
function MstrLastUrut($t){
	$ts=dbSel("urut",$t,"O/ urut DESC LIMIT 0,1");
	if(dbNRow($ts)>0){
		$rs=dbFA($ts);
		return $rs['urut'];
	}
	return 0;
}
function MstrGetNextUrut($t,$a,$o=""){
	$ts=dbSel("dcid,urut",$t,"O/ urut ".$o);
	$lid=Array(-1,0,0);
	while($rs=dbFA($ts)){
		if($rs['dcid']==$a){
			$lid[2]=$rs['urut'];
			return $lid;
		}
		$lid[0]=$rs['dcid'];
		$lid[1]=$rs['urut'];
	}
	return $lid;
}
function MstrGetName($t,$i,$f="dcid"){
	$q=mysql_query("SELECT name FROM mstr_".$t." WHERE ".$f."='".$i."' LIMIT 0,1");
	if(mysql_num_rows($q)==1){
		$r=mysql_fetch_array($q);
		return $r['name'];
	}
	return '';
}
?>