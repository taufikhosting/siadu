<?php
function kriteria_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	//if($c==1)$res['-']='Pilih kriteria:';
	if($s==1)$res[0]='- Semua -';
	$sql="SELECT * FROM  psb_kriteria ORDER BY urut";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kriteria'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function kriteria_name($a){
	return dbFetch("kriteria"," psb_kriteria","W/replid='$a'");
}
function kriteria_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kriteria calon siswa.<br/>Silahkan <a class="linkb" href="#&kriteria" onclick="PCBCODE=6;openPage('.app_page_getindex('kriteria').',\'kriteria\',false)">menambah data kriteria penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kriteria calon siswa.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data kriteria calon siswa baru.</div>';
	}
}
?>