<?php
function tahunlulus_r(&$a,$b=0){
	$res=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_tahunlulus WHERE departemen='$b' ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'].($r['aktif']=='1'?' (Aktif)':'');
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in){
		//$c=tahunlulus_aktif($b);
		$a=$d;
	}
	return $res;
}
function tahunlulus_name($a){
	if(is_array($a))$a=$a['tahunlulus'];
	return dbFetch("nama","aka_tahunlulus","W/replid='$a'");
}
function tahunlulus_warn($a=0,$f='float:left'){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan <a class="linkb" href="#&tahunlulus" onclick="PCBCODE=102;openPage('.app_page_getindex('tahunlulus').',\'tahunlulus\',false,\'departemen=\'+E(\'departemen\').value)">membuat data tahun ajaran</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahun ajaran pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data tahun ajaran baru.</div>';
	}
}
?>