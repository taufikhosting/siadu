<?php
function semester_aktif($d){
	$t=mysql_query("SELECT replid FROM aka_semester WHERE tahunajaran='$d' AND aktif='1' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$h=mysql_fetch_array($t);
		return $h['replid'];
	} else {
		return 0;
	}
}
function semester_r(&$a,$b){
	$dept=Array(); $in=false; $d=0;
	$t=mysql_query("SELECT * FROM aka_semester WHERE tahunajaran='$b' ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'].($r['aktif']=='1'?' (Aktif)':'');
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in){
		$c=semester_aktif($b);
		$a=$c!=0?$c:$d;
	}
	return $dept;
}
function semester_name($a){
	if(is_array($a))$b=$a['semester'];
	else $b=$a;
	return dbFetch("nama","aka_semester","W/replid='$b'");
}
function semester_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data semester pada departemen ini.<br/>Silahkan <a class="linkb" href="#&semester" onclick="PCBCODE=103;openPage('.app_page_getindex('semester').',\'semester\',false,\'departemen=\'+E(\'departemen\').value)">membuat data semester</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data semester.<br/>Silahkan menghubungi bagian akademik untuk membuat data semester baru.</div>';
	}
}
function semester_status($a){
	if($a==0) return 'Tidak aktif';
	else return 'Aktif';
}
?>