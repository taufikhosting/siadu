<?php
function guru_pegawaiId(){
	$a=admin_get();
	return $a['pegawai'];
}
function guru_SID(){
	$pid=guru_pegawaiId();
	$t=mysql_query("SELECT replid FROM aka_guru WHERE pegawai='$pid' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return $r['replid'];
	} else {
		return 0;
	}
}
function guru_pelajaran_r(&$a,$s=0){
	$gid=guru_SID();
	$res=Array(); $in=false; $d=0;
	if($s==1){
		$res[0]='- Semua -';
	}
	$t=mysql_query("SELECT aka_pelajaran.replid,aka_pelajaran.nama FROM aka_guru LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_guru.pelajaran WHERE aka_guru.replid='$gid' ORDER BY aka_pelajaran.nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function guru_tingkat_r(&$a,$s=0){
	$gid=guru_SID();
	$res=Array(); $in=false; $d=0;
	if($s==1){
		$res[0]='- Semua -';
	}
	$t=mysql_query("SELECT aka_tingkat.replid,aka_tingkat.tingkat FROM aka_sks LEFT JOIN aka_kelas ON aka_kelas.replid=aka_sks.kelas LEFT JOIN aka_tingkat ON aka_tingkat.replid=aka_kelas.tingkat WHERE aka_sks.guru='$gid' ORDER BY aka_tingkat.tingkat");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['tingkat'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function guru_kelas_r(&$a,$s=0){
	$gid=guru_SID();
	$res=Array(); $in=false; $d=0;
	if($s==1){
		$res[0]='- Semua -';
	}
	$t=mysql_query("SELECT aka_kelas.replid,aka_kelas.kelas as nkelas FROM aka_sks LEFT JOIN aka_kelas ON aka_kelas.replid=aka_sks.kelas WHERE aka_sks.guru='$gid' ORDER BY aka_kelas.kelas");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nkelas'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function guru_penilaian_r(&$a,$pel,$kls){
	$gid=guru_SID();
	$res=Array();
	$t=mysql_query("SELECT aka_penilaian.replid,aka_penilaian.nama,aka_penilaian.kode FROM aka_penilaian WHERE aka_penilaian.guru='$gid' AND aka_penilaian.pelajaran='$pel' AND aka_penilaian.kelas='$kls' ORDER BY aka_penilaian.replid");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'].' ('.$r['kode'].')';
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function guru_penilaian_name($a){
	if(is_array($a))$b=$a['penilaian'];
	else $b=$a;
	return dbFetch("nama","aka_penilaian","W/replid='$b'");
}
?>