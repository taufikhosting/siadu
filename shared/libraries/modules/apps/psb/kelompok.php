<?php
function kelompok_r(&$a,$b="",$s=0){
	$res=Array(); $in=false; $d=0;
	//if($c==1)$res['-']='Pilih kelompok:';
	if($s==1)$res[0]='- Semua -';
	$sql="SELECT * FROM  psb_kelompok".($b!=""?" WHERE proses='$b'":""." ORDER BY kelompok");
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kelompok'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function kelompok_name($a){
	return dbFetch("kelompok"," psb_kelompok","W/replid='$a'");
}
function kelompok_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelompok calon siswa pada periode ini.<br/>Silahkan <a class="linkb" href="#&kelompok" onclick="PCBCODE=4;openPage('.app_page_getindex('kelompok').',\'kelompok\',false,\'departemen=\'+E(\'departemen\').value+\'&proses=\'+E(\'proses\').value)">menambah data kelompok penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kelompok calon siswa pada periode ini.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data kelompok calon siswa baru.</div>';
	}
}
?>