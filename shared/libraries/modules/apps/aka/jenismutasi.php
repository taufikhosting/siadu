<?php
function jenismutasi_opt(){
	$res=Array();
	$t=mysql_query("SELECT * FROM aka_jenismutasi ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
	}
	return $res;
}
function jenismutasi_r(&$a){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_jenismutasi ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in) $a=$d;
	return $res;
}
function jenismutasi_name($a){
	if(is_array($a))$a=$a['jenismutasi'];
	return dbFetch("nama","aka_jenismutasi","W/replid='$a'");
}
function jenismutasi_warn($a=0,$f='float:left'){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan <a class="linkb" href="#&jenismutasi" onclick="PCBCODE=102;openPage('.app_page_getindex('jenismutasi').',\'jenismutasi\',false,\'departemen=\'+E(\'departemen\').value)">membuat data tahun ajaran</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data tahun ajaran baru.</div>';
	}
}
?>