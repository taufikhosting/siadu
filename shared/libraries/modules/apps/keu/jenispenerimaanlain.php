<?php
function jenispenerimaanlain_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM keu_jenispenerimaanlain ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function jenispenerimaanlain_name($a){
	if(is_array($a))$b=$a['jenispenerimaanlain'];
	else $b=$a;
	return dbFetch("nama","keu_jenispenerimaanlain","W/replid='$b'");
}
function jenispenerimaanlain_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data jenis penerimaan pada kategori penerimaan ini.<br/>Silahkan <a class="linkb" href="#&jenispenerimaanlain" onclick="PCBCODE=\'jenispenerimaanlain_warn_add\';openPage('.app_page_getindex('jenispenerimaanlain').',\'jenispenerimaanlain\',false)">membuat data jenis penerimaan</a> baru.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data jenis penerimaan pada kategori penerimaan ini.<br/>Silahkan menghubungi bagian keuangan untuk membuat data jenis penerimaan baru.</div>';
	}
}
?>