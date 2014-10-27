<?php
function siswa_sql_bykelas($k=0,$t=0,$f="nis,nama"){
	$fi=explode(",",$f); $n=count($fi); $l="";
	for($i=0;$i<$n;$i++){
		$l.="aka_siswa.".$fi[$i].",";
	}
	if($k!=0) $w=" WHERE aka_siswa_kelas.kelas='$k'";
	else if($t!=0) $w=" WHERE aka_tingkat.replid='$t'";
	else $w="";	
	
	return "SELECT aka_siswa.replid,".$l."aka_kelas.kelas as nkelas,departemen.nama as ndepartemen FROM aka_siswa_kelas LEFT JOIN aka_siswa ON aka_siswa.replid=aka_siswa_kelas.siswa LEFT JOIN aka_kelas ON aka_kelas.replid=aka_siswa_kelas.kelas LEFT JOIN aka_tingkat ON aka_tingkat.replid=aka_kelas.tingkat LEFT JOIN aka_tahunajaran ON aka_tahunajaran.replid=aka_tingkat.replid LEFT JOIN departemen ON departemen.replid=aka_tahunajaran.departemen".$w;
}

function siswa_db_bykelas($k=0,$t=0,$f=""){
	$db=new xdb("aka_siswa_kelas");
	$db->field("aka_siswa:replid,nis,nama".($f==""?"":",".$f),"aka_kelas:replid as idkelas,kelas as nkelas","aka_tingkat:replid as idtingkat","aka_tahunajaran:replid as idtahunajaran","departemen:nama as ndepartemen");
	$db->join("siswa","aka_siswa");
	$db->join("kelas","aka_kelas");
	$db->joinother("aka_kelas","tingkat","aka_tingkat");
	$db->joinother("aka_tingkat","tahunajaran","aka_tahunajaran");
	$db->joinother("aka_tahunajaran","departemen","departemen");
	
	if($k!=0) $w="aka_siswa_kelas.kelas='$k'";
	else if($t!=0) $w="aka_tingkat.replid='$t'";
	else $w="";	
	
	$db->where($w);
	$db->where_and("aka_siswa.aktif='1'");
	
	return $db;
}

function siswa_db_byangkatan($ang=0,$f="",$ak=1){
	$db=new xdb("aka_siswa");
	$db->field("aka_siswa:replid,nis,nama".($f==""?"":",".$f),"aka_kelas:kelas as nkelas","departemen:nama as ndepartemen");
	//$db->join("departemen","departemen");
	$db->join("replid","aka_siswa_kelas","siswa");
	$db->join("angkatan","aka_angkatan");
	$db->joinother("aka_siswa_kelas","kelas","aka_kelas");
	$db->joinother("aka_kelas","tingkat","aka_tingkat");
	$db->joinother("aka_tingkat","tahunajaran","aka_tahunajaran");
	$db->joinother("aka_angkatan","departemen","departemen");
	$db->where("aka_siswa.angkatan='$ang'");
	$db->where_and("aka_siswa.aktif='".$ak."'");
	return $db;
}

function siswa_db_bytahunajaran($ta=0,$f=""){
	$db=new xdb("aka_siswa_kelas");
	$db->field("aka_siswa:replid,nis,nama".($f==""?"":",".$f),"aka_kelas:kelas as nkelas","departemen:nama as ndepartemen");
	$db->join("siswa","aka_siswa");
	$db->join("kelas","aka_kelas");
	$db->joinother("aka_kelas","tingkat","aka_tingkat");
	$db->joinother("aka_tingkat","tahunajaran","aka_tahunajaran");
	$db->joinother("aka_tahunajaran","departemen","departemen");
	$db->where("aka_tahunajaran.replid='$ta'");
	$db->where_and("aka_siswa.aktif='1'");
	return $db;
}


function siswa_db_byID($id=0,$f=""){
	$db=new xdb("aka_siswa_kelas");
	$db->field("aka_siswa:replid,nis,nama".($f==""?"":",".$f),"aka_kelas:replid as idkelas,kelas as nkelas","departemen:nama as ndepartemen","aka_angkatan.angkatan as nangkatan");
	$db->join("siswa","aka_siswa");
	$db->join("kelas","aka_kelas");
	$db->joinother("aka_siswa","angkatan","aka_angkatan");
	$db->joinother("aka_kelas","tingkat","aka_tingkat");
	$db->joinother("aka_tingkat","tahunajaran","aka_tahunajaran");
	$db->joinother("aka_tahunajaran","departemen","departemen");
	$db->where("aka_siswa.replid='$id'");
	return $db;
}

function siswa_absen($id=0,$tgl='0000-00-00'){
	$t=mysql_query("SELECT absen FROM aka_absen WHERE siswa='$id' AND tanggal='$tgl'");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return $r['absen'];
	} else {
		return '';
	}
}
function siswa_absen_icon($a,$s=''){
	$a=strtoupper($a);
	if($a=='H')$cl='#00ff00';
	else if($a=='S')$cl='#ffff00';
	else if($a=='I')$cl='#ff9000';
	else if($a=='A')$cl='#ff0000';
	else {
		$cl='#fff';
		$a='&nbsp;';
	}
	return '<span class="sfont" style="display:inline-block;height:12px;width:12px;padding:2px;font-size:11px;text-align:center;background:'.$cl.';'.$s.'">'.$a.'</span>';
}
?>