<?php
function angkatan_opt($b,$s=0){
	$a=0;
	return angkatan_r($a,$b,$s);
}
function angkatan_r(&$a,$b=0,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM aka_angkatan WHERE departemen='$b' ORDER BY angkatan");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['angkatan'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function angkatan_name($a){
	if(is_array($a))$b=$a['angkatan'];
	else $b=$a;
	return dbFetch("angkatan","aka_angkatan","W/replid='$b'");
}
function angkatan_warn($a=0,$f='float:left'){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data angkatan pada departemen ini.<br/>Silahkan <a class="linkb" href="#&angkatan" onclick="PCBCODE=106;openPage('.app_page_getindex('angkatan').',\'angkatan\',false,\'departemen=\'+E(\'departemen\').value)">membuat data angkatan</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data angkatan pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data angkatan baru.</div>';
	}
}
?>