<?php
function pelajaran_opt($b,$s=0){
	$res=Array();
	if($s==1)$res['-']='';
	$sql="SELECT * FROM  aka_pelajaran WHERE tahunajaran='$b' ORDER BY nama";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
	}
	return $res;
}
function pelajaran_r(&$a,$b=0,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1) $res[0]='- Semua -';
	$t=mysql_query("SELECT aka_pelajaran.* FROM aka_pelajaran WHERE aka_pelajaran.tahunajaran='$b' ORDER BY aka_pelajaran.nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function pelajaran_r_pegawai(&$a,$b=0,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1){
		$res[0]='- Semua -';
	}
	$t=mysql_query("SELECT aka_pelajaran.replid,aka_pelajaran.nama FROM aka_guru LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_guru.pelajaran WHERE aka_guru.pegawai='$b' ORDER BY aka_pelajaran.nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function pelajaran_name($a){
	$a=$a==''?0:$a;
	$t=mysql_query("SELECT aka_pelajaran.nama FROM aka_pelajaran WHERE aka_pelajaran.replid='$a' LIMIT 0,1");
	if(mysql_num_rows($t)==1) {
		$r=mysql_fetch_array($t);
		return $r['nama'];
	}
	return '';
}
function pelajaran_sifat($a){
	if($a=='1') return 'Wajib';
	else return 'Tidak wajib';
}
function pelajaran_sifat_r(){
	return Array('1'=>'Wajib','0'=>'Tidak wajib');
}
function pelajaran_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran pada tahun ajaran ini.<br/>Silahkan <a class="linkb" href="#&pelajaran" onclick="PCBCODE=104;openPage('.app_page_getindex('pelajaran').',\'pelajaran\',false,\'departemen=\'+E(\'departemen\').value)">menambah data pelajaran</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran.<br/>Silahkan menghubungi bagian akademik untuk membuat data pelajaran baru.</div>';
	}
	else {
		echo '<div class="warnbox">'.$a.'</div>';
	}
}
function pelajaran_skm($a){
	$a=$a==''?0:$a;
	$t=mysql_query("SELECT aka_pelajaran.skm FROM aka_pelajaran WHERE aka_pelajaran.replid='$a' LIMIT 0,1");
	if(mysql_num_rows($t)==1) {
		$r=mysql_fetch_array($t);
		return $r['skm'];
	}
	return '';
}
?>