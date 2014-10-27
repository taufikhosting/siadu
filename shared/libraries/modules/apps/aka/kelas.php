<?php
function kelas_r(&$a,$c=0,$i=0,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM aka_kelas ".($c==0?"":"WHERE tingkat='$c'")." ORDER BY kelas");
	while($r=mysql_fetch_array($t)){
		$n=mysql_num_rows(mysql_query("SELECT replid FROM aka_siswa_kelas WHERE kelas='".$r['replid']."'"));
		$res[$r['replid']]=$r['kelas'].($i==0?'':'  (Terisi: '.$n.' dari '.$r['kapasitas'].' siswa)');
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function kelas_name($a){
	if(is_array($a))$b=$a['kelas'];
	else $b=$a;
	return dbFetch("kelas","aka_kelas","W/replid='$b'");
}
function kelas_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelas pada tingkat ini.<br/>Silahkan <a class="linkb" href="#&kelas" onclick="PCBCODE=105;openPage('.app_page_getindex('kelas').',\'kelas\',false,\'departemen=\'+E(\'departemen\').value+\'&tahunajaran=\'+E(\'tahunajaran\').value+\'&tingkat=\'+E(\'tingkat\').value)">membuat data kelas</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelas pada tingkat ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data kelas baru.</div>';
	}
}
function kelas_jumlahsiswa($kls){
	return dbSRow("aka_siswa_kelas","W/kelas='$kls'");
}
?>