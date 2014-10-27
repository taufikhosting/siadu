<?php
function guru_db($f=""){
	$db=new xdb("aka_guru");
	$db->field("aka_guru:replid","aka_pelajaran:nama as npelajaran","hrd_pegawai:nip,nama as npegawai".($f==""?"":", ".$f));
	$db->join("pegawai","hrd_pegawai");
	$db->join("pelajaran","aka_pelajaran");
	return $db;
}
function guru_db_bytahunajaran($ta,$f=""){
	$db=new xdb("aka_guru");
	$db->field("aka_guru:replid","aka_pelajaran:nama as npelajaran","hrd_pegawai:nip,nama as npegawai".($f==""?"":", ".$f));
	$db->join("pegawai","hrd_pegawai");
	$db->join("pelajaran","aka_pelajaran");
	$db->where_and("aka_guru.tahunajaran='$ta'");
	return $db;
}
function guru_db_byID($id,$f=""){
	$db=new xdb("aka_guru");
	$db->field("aka_guru:replid","aka_pelajaran:nama as npelajaran","hrd_pegawai:nip,nama as npegawai".($f==""?"":", ".$f));
	$db->join("pegawai","hrd_pegawai");
	$db->join("pelajaran","aka_pelajaran");
	$db->where_and("aka_guru.replid='$id'");
	return $db;
}
?>