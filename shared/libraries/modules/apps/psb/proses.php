<?php
function proses_r(&$a,$dept="",$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$sql="SELECT * FROM  psb_proses".($dept!=""?" WHERE departemen='$dept'":"");
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['proses'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function proses_name($a){
	return dbFetch("proses"," psb_proses","W/replid='$a'");
}
function proses_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data periode penerimaan siswa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&proses" onclick="PCBCODE=3;openPage('.app_page_getindex('periode').',\'periode\',false,\'departemen=\'+E(\'departemen\').value)">menambah data proses penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data periode penerimaan pada departemen ini.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data proses penerimaan siswa baru.</div>';
	}
}
?>