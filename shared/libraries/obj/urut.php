<?php
function urut_getlast($a){
	$t=mysql_query("SELECT urut FROM `$a` ORDER BY urut DESC LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return intval($r['urut']);
	} else {
		return 0;
	}
}
function urut_getid_before($a,$u){
	$id=0;
	$t=mysql_query("SELECT replid,urut FROM `$a` ORDER BY urut,replid");
	while($r=mysql_fetch_array($t)){
		if($r['replid']==$u){
			return $id;
		}
		$id=$r['replid'];
	}
	return $id;
}
function urut_getid_after($a,$u){
	$id=0;
	$t=mysql_query("SELECT replid,urut FROM `$a` ORDER BY urut DESC,replid DESC");
	while($r=mysql_fetch_array($t)){
		if($r['replid']==$u){
			return $id;
		}
		$id=$r['replid'];
	}
	return $id;
}
function urut_geturut($a,$id){
	$t=mysql_query("SELECT urut FROM `$a` WHERE replid='$id'");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return intval($r['urut']);
	} else {
		return 0;
	}
}
function urut_seturut($a,$id,$u){
	//log_print("urut_seturut: UPDATE `$a` SET urut='$u' WHERE replid='$id'");
	return mysql_query("UPDATE `$a` SET urut='$u' WHERE replid='$id'");
}
function urut_tukar($a,$id1,$id2){
	//log_print('urut_tukar: a:'.$a.', id1:'.$id1.', id2:'.$id2);
	$u1=urut_geturut($a,$id1);
	$u2=urut_geturut($a,$id2);
	//log_print('urut_tukar: u1:'.$u1.', u2:'.$u2);
	urut_seturut($a,$id1,$u2);
	urut_seturut($a,$id2,$u1);
}
function urut_up($a,$id){
	$uid=urut_getid_before($a,$id);
	//log_print('urut_up: uid:'.$uid);
	if($uid!=0){
		urut_tukar($a,$id,$uid);
	}
}
function urut_dn($a,$id){
	$uid=urut_getid_after($a,$id);
	//log_print('urut_dn: uid:'.$uid);
	if($uid!=0){
		urut_tukar($a,$id,$uid);
	}
}
?>