<?php
function pegawai_name($a){
	dbFetch("nama","hrd_pegawai","W/replid='$a'");
}
function bagian_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_bagian ORDER BY bagian");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['bagian'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function bagian_name($a){
	if(is_array($a))$b=$a['bagian'];
	else $b=$a;
	return dbFetch("bagian","hrd_m_bagian","W/replid='$b'");
}

function kelompok_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_kelompok ORDER BY kelompok");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kelompok'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function kelompok_name($a){
	if(is_array($a))$b=$a['kelompok'];
	else $b=$a;
	return dbFetch("kelompok","hrd_m_kelompok","W/replid='$b'");
}

function marital_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_marital ORDER BY marital");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['marital'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function marital_name($a){
	if(is_array($a))$b=$a['marital'];
	else $b=$a;
	return dbFetch("marital","hrd_m_marital","W/replid='$b'");
}

function posisi_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_posisi ORDER BY posisi");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['posisi'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function posisi_name($a){
	if(is_array($a))$b=$a['posisi'];
	else $b=$a;
	return dbFetch("posisi","hrd_m_posisi","W/replid='$b'");
}

function status_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_status ORDER BY status");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['status'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function status_name($a){
	if(is_array($a))$b=$a['status'];
	else $b=$a;
	return dbFetch("status","hrd_m_status","W/replid='$b'");
}

function tingkat_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_tingkat ORDER BY tingkat");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['tingkat'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function tingkat_name($a){
	if(is_array($a))$b=$a['tingkat'];
	else $b=$a;
	return dbFetch("tingkat","hrd_m_tingkat","W/replid='$b'");
}

function jenistraining_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM hrd_m_jenistraining ORDER BY jenistraining");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['jenistraining'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function jenistraining_name($a){
	if(is_array($a))$b=$a['jenistraining'];
	else $b=$a;
	return dbFetch("jenistraining","hrd_m_jenistraining","W/replid='$b'");
}

function pegawai_db($f=""){
	$db=new xdb("hrd_pegawai");
	$db->field("hrd_pegawai:replid,nip,nama".($f==""?"":",".$f));
	return $db;
}
function pegawai_db_byID($id=0,$f=""){
	$db=new xdb("hrd_pegawai");
	$db->field("hrd_pegawai:replid,nip,nama".($f==""?"":",".$f));
	$db->where("hrd_pegawai.replid='$id'");
	return $db;
}
?>