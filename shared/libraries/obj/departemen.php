<?php
function departemen_r(&$a,$s=0){
	$ADMIN=admin_get();
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM departemen ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in){
		if(!empty($_SESSION['sdepartemen'])){ $a=$_SESSION['sdepartemen']; }
		else { $a=$s==0?$d:0; }
	}
	if($ADMIN['dept']!=0)$a=$ADMIN['dept'];
	$_SESSION['sdepartemen']=$a;
	return $dept;
}
function departemen_name($a){
	if(is_array($a))$b=$a['departemen'];
	else $b=$a;
	return dbFetch("nama","departemen","W/replid='$b'");
}
function departemen_warn($a=0){
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data departemen.<br/>Silahkan <a class="linkb" href="#&departemen" onclick="PCBCODE=\'dept_add\';openPage('.app_page_getindex('departemen').',\'departemen\',false)">membuat data departemen</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data departemen.<br/>Silahkan menghubungi bagian akademik untuk membuat data departemen baru.</div>';
	}
}
?>