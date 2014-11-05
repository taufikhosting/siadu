<?php
function tahunbuku_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	//if($c==1)$res['-']='Pilih tahunbuku:';
	if($s==1)$res[0]='- Semua -';
	$sql="SELECT * FROM  keu_tahunbuku ORDER BY nama";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['tahunbuku'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function tahunbuku_name($a){
	return dbFetch("tahunbuku","keu_tahunbuku","W/replid='$a'");
}
function tahunbuku_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahunbuku calon siswa.<br/>Silahkan <a class="linkb" href="#&tahunbuku" onclick="PCBCODE=6;openPage('.app_page_getindex('tahunbuku').',\'tahunbuku\',false)">menambah data tahunbuku penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tahunbuku calon siswa.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data tahunbuku calon siswa baru.</div>';
	}
}
?>