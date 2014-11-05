<?php
function tingkat_r(&$a,$c=0,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM aka_tingkat WHERE tahunajaran='$c' ORDER BY tingkat");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['tingkat'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $dept;
}
function tingkat_name($a){
	if(is_array($a))$b=$a['tingkat'];
	else $b=$a;
	return dbFetch("tingkat","aka_tingkat","W/replid='$b'");
}

function tingkat_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data tingkat pada tahun ajaran ini.<br/>Silahkan <a class="linkb" href="#&tingkat" onclick="PCBCODE=101;openPage('.app_page_getindex('tingkat').',\'tingkat\',false,\'departemen=\'+E(\'departemen\').value)">membuat data tingkat</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tingkat.<br/>Silahkan menghubungi bagian akademik untuk membuat data tingkat baru.</div>';
	}
}
?>