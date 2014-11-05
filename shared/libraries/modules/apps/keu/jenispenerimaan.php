<?php
function jenispenerimaan_r(&$a,$b,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM keu_jenispenerimaan WHERE kategoripenerimaan='$b' ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function jenispenerimaan_name($a){
	if(is_array($a))$b=$a['jenispenerimaan'];
	else $b=$a;
	return dbFetch("nama","keu_jenispenerimaan","W/replid='$b'");
}
function jenispenerimaan_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data jenis penerimaan pada kategori penerimaan ini.<br/>Silahkan <a class="linkb" href="#&jenispenerimaan" onclick="PCBCODE=\'jenispenerimaan_warn_add\';openPage('.app_page_getindex('jenispenerimaan').',\'jenispenerimaan\',false,\'kategoripenerimaan=\'+E(\'kategoripenerimaan\').value)">membuat data jenis penerimaan</a> baru.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data jenis penerimaan pada kategori penerimaan ini.<br/>Silahkan menghubungi bagian keuangan untuk membuat data jenis penerimaan baru.</div>';
	}
}
?>