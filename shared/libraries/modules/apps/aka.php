<?php
function matapelajaran_opt($b,$s=0){
	$res=array(); $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM aka_matapelajaran WHERE tahunajaran='$b' ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function matapelajaran_r(&$a,$b){
	$t=mysql_query("SELECT * FROM aka_matapelajaran WHERE departemen='$b' ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function matapelajaran_name($a){
	return dbFetch("nama","aka_matapelajaran","W/replid='$a'");
}
function ruang_r(&$a,$b=0,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM aka_ruang WHERE departemen='$b' ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function ruang_name($a){
	if(is_array($a))$b=$a['nama'];
	else $b=$a;
	return dbFetch("nama","aka_ruang","W/replid='$b'");
}
function ruang_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data ruang pada departemen ini.<br/>Silahkan <a class="linkb" href="#&ruang" onclick="PCBCODE=106;openPage('.app_page_getindex('ruang').',\'ruang\',false,\'departemen=\'+E(\'departemen\').value)">membuat data ruang</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data ruang pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data ruang baru.</div>';
	}
}

function aspekpenilaian_r(&$a){
	$dept=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_aspekpenilaian ORDER BY aspekpenilaian");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['aspekpenilaian'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $dept;
}
function aspekpenilaian_name($a){
	if(is_array($a))$b=$a['aspekpenilaian'];
	else $b=$a;
	return dbFetch("aspekpenilaian","aka_aspekpenilaian","W/replid='$b'");
}

function guru_get($a){
	$res=Array('nama'=>'','nip'=>'','pegawai'=>0,'pelajaran'=>0,'statusguru'=>0,'aktif'=>0);
	if(is_array($a))$b=$a['guru'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM aka_guru WHERE replid='$b' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$k=mysql_fetch_array($t); $v=$k['pegawai'];
		$q=mysql_query("SELECT * FROM hrd_pegawai WHERE replid='$v' LIMIT 0,1");
		if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$res['nip']=$h['nip'];
		$res['nama']=$h['nama'];
		$res['pegawai']=$h['replid'];
		}
		$res['pelajaran']=$k['pelajaran'];
		$res['statusguru']=$k['statusguru'];
		$res['aktif']=$k['aktif'];
	}
	return $res;
}
function guru_r(&$a,$b=0,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1) $res[0]='- Semua -';
	$t=mysql_query("SELECT aka_guru.replid,hrd_pegawai.nama FROM aka_guru LEFT JOIN hrd_pegawai ON hrd_pegawai.replid=aka_guru.pegawai WHERE aka_guru.tahunajaran='$b' ORDER BY hrd_pegawai.nama");
	//echo "SELECT aka_guru.replid,hrd_pegawai.nama FROM aka_guru LEFT JOIN hrd_pegawai ON hrd_pegawai.replid=aka_guru.pegawai WHERE aka_guru.tahunajaran='$b' ORDER BY hrd_pegawai.nama";
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}

function statusguru_name($a){
	if(is_array($a))$b=$a['statusguru'];
	else $b=$a;
	return dbFetch("statusguru","aka_statusguru","W/replid='$b'");
}
function statusguru_r($a=1){
	$res=Array(); if($a!=1)$res[0]='-';
	$t=mysql_query("SELECT * FROM aka_statusguru ORDER BY statusguru");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['statusguru'];
	}
	return $res;
}

function pegawai_name($a){
	dbFetch("nama","hrd_pegawai","W/replid='$a'");
}

function grupsiswa_r(&$a,$c=0){
	$dept=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_grup WHERE tahunajaran='$c' ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $dept;
}

function grupsiswa_name($a){
	if(is_array($a))$b=$a['grup'];
	else $b=$a;
	return dbFetch("nama","aka_grup","W/replid='$b'");
}

function grupsiswa_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelompok siswa pada tahu ajaran ini.<br/>Silahkan <a class="linkb" href="#&kelompok" onclick="PCBCODE=101;openPage('.app_page_getindex('kelompok').',\'kelompok\',false,gpage_purl([\'departemen\',\'departemen\']))">membuat data kelompok siswa</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelompok siswa.<br/>Silahkan menghubungi bagian akademik untuk membuat data kelompok siswa baru.</div>';
	}
}
?>