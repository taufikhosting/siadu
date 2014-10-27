<?php
function lokasi_opt(&$a,$s=0){
	$res=Array();
	if($s==1) $res[0]='Semua';
	$in=false; $d=0;
	$sql="SELECT * FROM  sar_lokasi";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function lokasi_r(&$a,$s=0){
	$res=Array();
	if($s==1) $res[0]='- Semua lokasi -';
	$in=false; $d=0;
	$sql="SELECT * FROM  sar_lokasi";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function lokasi_name($a){
	return dbFetch("nama","sar_lokasi","W/replid='$a'");
}
function lokasi_kode($a){
	return dbFetch("kode"," sar_lokasi","W/replid='$a'");
}
function lokasi_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data lokasi.<br/>Silahkan <a class="linkb" href="#&lokasi" onclick="PCBCODE=2;openPage('.app_page_getindex('lokasi').',\'lokasi\',false)">menambah data lokasi</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data lokasi.<br/>Silahkan menghubungi bagian sarana prasarana untuk membuat data lokasi baru.</div>';
	}
}

function grup_r(&$a,$s=0){
	$res=Array();
	if($s==1) $res[0]='- Semua grup -';
	$in=false; $d=0;
	$sql="SELECT * FROM  sar_grup";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function grup_name($a){
	return dbFetch("nama"," sar_grup","W/replid='$a'");
}
function grup_kode($a){
	return dbFetch("kode"," sar_grup","W/replid='$a'");
}
function grup_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data grup.<br/>Silahkan <a class="linkb" href="#&grup" onclick="PCBCODE=2;openPage('.app_page_getindex('grup').',\'grup\',false)">menambah data grup</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data grup.<br/>Silahkan menghubungi bagian sarana prasarana untuk membuat data grup baru.</div>';
	}
}

function katalog_r(&$a){
	$res=Array(); $in=false; $d=0;
	$sql="SELECT * FROM  sar_katalog ORDER BY kode";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function katalog_name($a){
	return dbFetch("nama"," sar_katalog","W/replid='$a'");
}
function katalog_kode($a){
	return dbFetch("kode"," sar_katalog","W/replid='$a'");
}
function katalog_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data proses penerimaan siswa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&proses" onclick="PCBCODE=3;openPage('.app_page_getindex('periode').',\'periode\',false,\'departemen=\'+E(\'departemen\').value)">menambah data proses penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data proses penerimaan siswa baru.</div>';
	}
}

function barang_lbarkode(){
	$l=1;
	$q=mysql_query("SELECT urut FROM sar_barang ORDER BY urut DESC LIMIT 0,1");
	if(mysql_num_rows($q)==1){
		$h=mysql_fetch_array($q);
		$l=$h['urut']+1;
	}
	return $l;
}

function penulis_r(&$a){
	$res=Array(); $in=false; $d=0;
	$sql="SELECT * FROM  sar_penulis ORDER BY kode";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function penulis_name($a){
	return dbFetch("nama"," sar_penulis","W/replid='$a'");
}
function penulis_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data proses penerimaan siswa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&proses" onclick="PCBCODE=3;openPage('.app_page_getindex('periode').',\'periode\',false,\'departemen=\'+E(\'departemen\').value)">menambah data proses penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data proses penerimaan siswa baru.</div>';
	}
}

function penerbit_r(&$a){
	$res=Array(); $in=false; $d=0;
	$sql="SELECT * FROM  sar_penerbit ORDER BY kode";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
function penerbit_name($a){
	return dbFetch("nama"," sar_penerbit","W/replid='$a'");
}
function penerbit_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data proses penerimaan siswa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&proses" onclick="PCBCODE=3;openPage('.app_page_getindex('periode').',\'periode\',false,\'departemen=\'+E(\'departemen\').value)">menambah data proses penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data proses penerimaan siswa baru.</div>';
	}
}

function jenis_a(){
	$s=array();
	$t=mysql_query("SELECT * FROM  sar_jenis ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$s[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
	}
	return $s;
}
function jenis_r(&$a,$s=0){
	$res=Array();
	if($s==1) $res[0]='- Semua jenis -';
	$in=false; $d=0;
	$sql="SELECT * FROM  sar_jenis";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function jenis_name($a){
	return dbFetch("nama"," sar_jenis","W/replid='$a'");
}
function jenis_warn($a=0){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox">Tidak ditemukan data proses penerimaan siswa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&proses" onclick="PCBCODE=3;openPage('.app_page_getindex('periode').',\'periode\',false,\'departemen=\'+E(\'departemen\').value)">menambah data proses penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox">Tidak ditemukan data pelajaran.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data proses penerimaan siswa baru.</div>';
	}
}

function katalog_aset($d){
	$n=0;
	$t=mysql_query("SELECT harga FROM sar_barang WHERE katalog='$d'");
	while($r=mysql_fetch_array($t))
		$n+=$r['harga'];
	return $n;
}
function grup_aset($d){
	$n=0;
	$t=mysql_query("SELECT replid FROM sar_katalog WHERE grup='$d'");
	while($r=mysql_fetch_array($t)){
		$n+=katalog_aset($r['replid']);
	}
	return $n;
}
function lokasi_aset($d){
	$n=0;
	$t=mysql_query("SELECT replid FROM sar_grup WHERE lokasi='$d'");
	while($r=mysql_fetch_array($t)){
		$n+=grup_aset($r['replid']);
	}
	return $n;
}
function sumber_name($a){
	$s=array('Beli','Pemberian','Membuat sendiri');
	return $s[$a];
}

function kondisi_a(){
	return array(1=>'Sangat baik',2=>'Baik',3=>'Buruk',4=>'Sangat buruk');
}
function kondisi_name($a){
	$s=kondisi_a();
	return $s[$a];
}
function barang_get($a){
	$q=mysql_query("SELECT sar_barang.*,sar_katalog.nama FROM sar_barang JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE sar_barang.replid='$a'");
	$h=mysql_fetch_array($q);
	return $h;
}
?>