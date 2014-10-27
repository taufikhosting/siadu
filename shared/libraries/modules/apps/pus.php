<?php
function buku_getidbuku($lok,$tingb,$u=1,$l=0){
	$t1=mysql_query("SELECT kode FROM pus_lokasi WHERE replid='$lok' LIMIT 0,1");
	$r1=mysql_fetch_array($t1);
	$klok=$r1['kode'];

	$t1=mysql_query("SELECT kode FROM pus_tingkatbuku WHERE replid='$tingb' LIMIT 0,1");
	$r1=mysql_fetch_array($t1);
	$ktingb=$r1['kode'];

	$sep='.';
	$idbuku=$klok.$sep.$ktingb.$sep.date("Y");
	if($u==1){
		$l=$l==0?buku_getlasturut():$l;
		$bk=sprintf("%05d",$l);
		$idbuku.=$sep.$bk;
	}
	
	return $idbuku;
}
function buku_idbukutobarkode($a){
	return str_replace(".","",$a);
}
function buku_idbukugeturut($a){
	$b=explode(".",$a);
	$n=count($b);
	return intval($b[$n-1]);
}
function buku_getlasturut(){
	$l=0; $y=date("Y");
	$q=mysql_query("SELECT urut FROM pus_buku ORDER BY urut DESC LIMIT 0,1");
	if(mysql_num_rows($q)==1){
		$h=mysql_fetch_array($q);
		$l=$h['urut'];
	}
	return $l;
}
function klasifikasi_opt(){
	$res=Array();
	$res['-']='';
	$t=mysql_query("SELECT * FROM pus_klasifikasi ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid'];
	}
	return $res;
}
function klasifikasi_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_klasifikasi ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function klasifikasi_name($a){
	if(is_array($a))$b=$a['klasifikasi'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM pus_klasifikasi WHERE replid='$b' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return '['.$r['kode'].'] '.$r['nama'];
}
function klasifikasi_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data klasifikasi pada departemen ini.<br/>Silahkan <a class="linkb" href="#&klasifikasi" onclick="PCBCODE=106;openPage('.app_page_getindex('klasifikasi').',\'klasifikasi\',false,\'departemen=\'+E(\'departemen\').value)">membuat data klasifikasi</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data klasifikasi pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data klasifikasi baru.</div>';
	}
}

function pengarang_opt($s=0){
	$res=array();
	$res['-']='';
	$t=mysql_query("SELECT * FROM pus_pengarang ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
	}
	return $res;
}
function pengarang_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_pengarang ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function pengarang_name($a){
	if(is_array($a))$b=$a['pengarang'];
	else $b=$a;
	return dbFetch("nama","pus_pengarang","W/replid='$b'");
}
function pengarang_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data pengarang pada departemen ini.<br/>Silahkan <a class="linkb" href="#&pengarang" onclick="PCBCODE=106;openPage('.app_page_getindex('pengarang').',\'pengarang\',false,\'departemen=\'+E(\'departemen\').value)">membuat data pengarang</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data pengarang pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data pengarang baru.</div>';
	}
}

function penerbit_opt($s=0){
	$res=array();
	$res['-']='';
	$t=mysql_query("SELECT * FROM pus_penerbit ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
	}
	return $res;
}
function penerbit_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_penerbit ORDER BY nama");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function penerbit_name($a){
	if(is_array($a))$b=$a['penerbit'];
	else $b=$a;
	return dbFetch("nama","pus_penerbit","W/replid='$b'");
}
function penerbit_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data penerbit pada departemen ini.<br/>Silahkan <a class="linkb" href="#&penerbit" onclick="PCBCODE=106;openPage('.app_page_getindex('penerbit').',\'penerbit\',false,\'departemen=\'+E(\'departemen\').value)">membuat data penerbit</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data penerbit pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data penerbit baru.</div>';
	}
}

function bahasa_opt($s=0){
	$res=array();
	$res['-']='';
	$t=mysql_query("SELECT * FROM pus_bahasa ORDER BY replid");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
	}
	return $res;
}
function bahasa_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_bahasa ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function bahasa_name($a){
	if(is_array($a))$b=$a['bahasa'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM pus_bahasa WHERE replid='$b' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return '['.$r['kode'].'] '.$r['nama'];
}
function bahasa_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data bahasa pada departemen ini.<br/>Silahkan <a class="linkb" href="#&bahasa" onclick="PCBCODE=106;openPage('.app_page_getindex('bahasa').',\'bahasa\',false,\'departemen=\'+E(\'departemen\').value)">membuat data bahasa</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data bahasa pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data bahasa baru.</div>';
	}
}

function jenisbuku_opt($s=0){
	$a=0;
	return jenisbuku_r($a,$s);
}
function jenisbuku_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_jenisbuku ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function jenisbuku_name($a){
	if(is_array($a))$b=$a['jenisbuku'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM pus_jenisbuku WHERE replid='$b' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return '['.$r['kode'].'] '.$r['nama'];
}
function jenisbuku_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data jenisbuku pada departemen ini.<br/>Silahkan <a class="linkb" href="#&jenisbuku" onclick="PCBCODE=106;openPage('.app_page_getindex('jenisbuku').',\'jenisbuku\',false,\'departemen=\'+E(\'departemen\').value)">membuat data jenisbuku</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data jenisbuku pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data jenisbuku baru.</div>';
	}
}

function lokasi_opt($s=0){
	$a=0;
	return lokasi_r($a,$s);
}
function lokasi_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_lokasi ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function lokasi_name($a){
	if(is_array($a))$b=$a['lokasi'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM pus_lokasi WHERE replid='$b' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return '['.$r['kode'].'] '.$r['nama'];
}
function lokasi_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data lokasi pada departemen ini.<br/>Silahkan <a class="linkb" href="#&lokasi" onclick="PCBCODE=106;openPage('.app_page_getindex('lokasi').',\'lokasi\',false,\'departemen=\'+E(\'departemen\').value)">membuat data lokasi</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data lokasi pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data lokasi baru.</div>';
	}
}

function satuan_opt($s=0){
	$a=0;
	return satuan_r($a,$s);
}
function satuan_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_satuan ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['kode']]=$r['kode'];
		if($d==0)$d=$r['kode']; if($r['kode']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}


function tingkatbuku_opt($s=0){
	$a=0;
	return tingkatbuku_r($a,$s);
}
function tingkatbuku_r(&$a,$s=0){
	$dept=Array(); $in=false; $d=0;
	if($s==1)$dept[0]='- Semua -';
	$t=mysql_query("SELECT * FROM pus_tingkatbuku ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$dept[$r['replid']]='['.$r['kode'].'] '.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $dept;
}
function tingkatbuku_name($a){
	if(is_array($a))$b=$a['tingkatbuku'];
	else $b=$a;
	$t=mysql_query("SELECT * FROM pus_tingkatbuku WHERE replid='$b' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return '['.$r['kode'].'] '.$r['nama'];
}
function tingkatbuku_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tingkatbuku pada departemen ini.<br/>Silahkan <a class="linkb" href="#&tingkatbuku" onclick="PCBCODE=106;openPage('.app_page_getindex('tingkatbuku').',\'tingkatbuku\',false,\'departemen=\'+E(\'departemen\').value)">membuat data tingkatbuku</a> pada menu Referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data tingkatbuku pada departemen ini.<br/>Silahkan menghubungi bagian akademik untuk membuat data tingkatbuku baru.</div>';
	}
}

function cetaklabel_ptrack($a){
	echo '<div style="padding:10px 0 10px 0">',
	'<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps1a" class="ptracknumber'.($a==1?'':'0').'" align="center">1</td>',
			'<td id="ps1b" class="ptracktext'.($a==1?'':'0').'">Pilih<br/>item</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==2?'':'0').'" align="center">2</td>',
			'<td id="ps2b" class="ptracktext'.($a==2?'':'0').'">Pengecekan<br/>item</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==3?'':'0').'" align="center">3</td>',
			'<td id="ps2b" class="ptracktext'.($a==3?'':'0').'">Pemberian<br/>catatan</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==4?'':'0').'" align="center">4</td>',
			'<td id="ps2b" class="ptracktext'.($a==4?'':'0').'">Akhiri<br/>stock opname</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==5?'':'0').'" align="center">5</td>',
			'<td id="ps2b" class="ptracktext'.($a==5?'':'0').'">Membuat<br/>laporan</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'</tr></table>',
	'</div>';
}

function stocktake_ptrack($a){
	echo '<div style="padding:10px 0 10px 0">',
	'<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps1a" class="ptracknumber'.($a==1?'':'0').'" align="center">1</td>',
			'<td id="ps1b" class="ptracktext'.($a==1?'':'0').'">Inisialisasi<br/>stock opname</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==2?'':'0').'" align="center">2</td>',
			'<td id="ps2b" class="ptracktext'.($a==2?'':'0').'">Pengecekan<br/>item</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==3?'':'0').'" align="center">3</td>',
			'<td id="ps2b" class="ptracktext'.($a==3?'':'0').'">Pemberian<br/>catatan</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==4?'':'0').'" align="center">4</td>',
			'<td id="ps2b" class="ptracktext'.($a==4?'':'0').'">Akhiri<br/>stock opname</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'<td>',
		'<div class="ptrackbox">',
		'<table cellspacing="0" cellpadding="0"><tr>',
			'<td id="ps2a" class="ptracknumber'.($a==5?'':'0').'" align="center">5</td>',
			'<td id="ps2b" class="ptracktext'.($a==5?'':'0').'">Membuat<br/>laporan</td>',
		'</tr></table>',
		'</div>',
	'</td>',
	'</tr></table>',
	'</div>';
}

function stocktake_ctable(){
	$t=mysql_query("SELECT tabel FROM pus_stockhist WHERE status<>'5' LIMIT 0,1");
	//log_print("pus: SELECT tabel FROM pus_stockhist WHERE status='1' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return "joshso.".$r['tabel'];
}

function buku_judul($a){
	$b=explode("`",$a);
	$c=$b[0].($b[1]==''?"":" (".$b[1].")");
	return stripslashes($c);
}

function stocktake_unfinished(){
	$t=mysql_query("SELECT tabel FROM pus_stockhist WHERE status<>'5' LIMIT 0,1");
	return mysql_num_rows($t);
}
function stocktake_info(){
	echo '<div class="infobox">Perubahan katalog tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
}
function setting_setnilai($k,$v){
	return mysql_query("UPDATE pus_setting SET nilai='$v' WHERE kunci='$k'");
}
function setting_getnilai($k){
	$t=mysql_query("SELECT nilai FROM pus_setting WHERE kunci='$k' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return $r['nilai'];
	} else {
		return '';
	}
}
function setting_getid($k){
	$t=mysql_query("SELECT replid FROM pus_setting WHERE kunci='$k' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return $r['replid'];
	} else {
		return 0;
	}
}

function buku_makeid($data=0){
	return buku_makeformat('idfmt',$data);
}
function buku_makebarkode($data=0){
	return buku_makeformat('bkfmt',$data);
}
function buku_makeformat($f,$data=0){
	$fmt=setting_getnilai($f);
	// [nomorauto]
	$fnomorauto="/\[nomorauto(\.[0-9]+)?\]/i";
	if(preg_match($fnomorauto,$fmt,$mat)){
		$fmt1=$mat[0];
		$l=1;
		if(preg_match("/[0-9]+/",$fmt1,$mat1)){
			$l=intval($mat1[0]);
		}
		if(isset($data['nomorauto'])){
			if(is_numeric($data['nomorauto'])){
				$n=intval($data['nomorauto']);
				if($n>0){
					$nomorauto=sprintf("%0".$l."d",$n);
				} else {
					$n=buku_getlasturut()+1;
					$nomorauto=sprintf("%0".$l."d",$n);
				}
			} else {
				$nomorauto=$data['nomorauto'];
			}
		} else {
			$n=buku_getlasturut()+1;
			$nomorauto=sprintf("%0".$l."d",$n);
		}
	} else {
		$nomorauto='';
	}
	if($nomorauto!='') $fmt=preg_replace($fnomorauto,$nomorauto,$fmt);
	
	// [tahun]
	$ftahun="/\[tahun\]/i";
	if(preg_match($ftahun,$fmt,$mat)){
		$fmt1=$mat[0];
		if(isset($data['tahun']) && !empty($data['tahun'])){
			$th=$data['tahun'];
		} else {
			$th=date("Y");
		}
		$tahun=$th;
	} else {
		$tahun='';
	}
	if($tahun!='') $fmt=preg_replace($ftahun,$tahun,$fmt);
	
	// [sumber]
	$fsumber="/\[sumber\]/i";
	if(preg_match($fsumber,$fmt,$mat)){
		$fmt1=$mat[0];
		if(isset($data['sumber']) && !empty($data['sumber'])){
			$sumber=$data['sumber']==0?'B':'H';
		} else {
			$sumber='B';
		}
	} else {
		$sumber='';
	}
	if($sumber!='') $fmt=preg_replace($fsumber,$sumber,$fmt);
	
	// [kodelokasi]
	$fkodelokasi="/\[kodelokasi\]/i";
	if(preg_match($fkodelokasi,$fmt,$mat)){
		$fmt1=$mat[0];
		if(isset($data['kodelokasi']) && !empty($data['kodelokasi'])){
			$t=mysql_query("SELECT kode FROM pus_lokasi ".($data['kodelokasi']=='*'?"":"WHERE replid='".$data['kodelokasi']."'")." LIMIT 0,1");
			$r=mysql_fetch_array($t);
			$kodelokasi=$r['kode'];
		} else {
			$kodelokasi='';
		}
	} else {
		$kodelokasi='';
	}
	if($kodelokasi!='') $fmt=preg_replace($fkodelokasi,$kodelokasi,$fmt);
	
	// [kodetingkat]
	$fkodetingkat="/\[kodetingkat\]/i";
	if(preg_match($fkodetingkat,$fmt,$mat)){
		$fmt1=$mat[0];
		if(isset($data['kodetingkat']) && !empty($data['kodetingkat'])){
			$t=mysql_query("SELECT kode FROM pus_tingkatbuku ".($data['kodetingkat']=='*'?"":"WHERE replid='".$data['kodetingkat']."'")." LIMIT 0,1");
			$r=mysql_fetch_array($t);
			$kodetingkat=$r['kode'];
		} else {
			$kodetingkat='';
		}
	} else {
		$kodetingkat='';
	}
	if($kodetingkat!='') $fmt=preg_replace($fkodetingkat,$kodetingkat,$fmt);
	
	return $fmt;
}
?>