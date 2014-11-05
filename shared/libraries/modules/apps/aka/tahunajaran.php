<?php
function tahunajaran_aktif($d){
	$t=mysql_query("SELECT replid FROM aka_tahunajaran WHERE departemen='$d' AND aktif='1' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$h=mysql_fetch_array($t);
		return $h['replid'];
	} else {
		return 0;
	}
}
function tahunajaran_r(&$a,$b=0){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_tahunajaran WHERE departemen='$b' ORDER BY tglmulai DESC");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['tahunajaran'].($r['aktif']=='1'?' (Aktif)':'');
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in){
		$c=tahunajaran_aktif($b);
		$a=$c!=0?$c:$d;
	}
	return $res;
}
function tahunajaran_name($a){
	if(is_array($a))$a=$a['tahunajaran'];
	return dbFetch("tahunajaran","aka_tahunajaran","W/replid='$a'");
}
function tahunajaran_warn($a=0,$f='float:left'){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan <a class="linkb" href="#&tahunajaran" onclick="PCBCODE=102;openPage('.app_page_getindex('tahunajaran').',\'tahunajaran\',false,\'departemen=\'+E(\'departemen\').value)">membuat data tahun ajaran</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data tahun ajaran baru.</div>';
	}
}
?>