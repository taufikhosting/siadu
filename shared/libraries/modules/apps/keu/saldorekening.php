<?php
function rekening_name($a){
	$t=mysql_query("SELECT * FROM keu_rekening WHERE replid='$a' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		return "[".$r['kode']."] ".$r['nama'];
	}
	return "";
}
function rekening_nl($a=0){
	$res=Array();
	$t=mysql_query("SELECT * FROM keu_rekening ".($a==0?"":"WHERE kategorirek='$a'")." ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kode']." ".$r['nama'];
	}
	return $res;
}
function rekening_opt($a=0){
	$res=Array();
	$res['-']='';
	$t=mysql_query("SELECT * FROM keu_rekening ".($a==0?"":"WHERE kategorirek='$a'")." ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kode']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$r['nama'];
	}
	return $res;
}
function rekening_nokasbank_opt(){
	$res=Array();
	$res[0]='';
	$t=mysql_query("SELECT * FROM keu_rekening WHERE kategorirek<>'1' && kategorirek<>'2' ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kode']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$r['nama'];
	}
	return $res;
}
function rekening_kasbank_opt(){
	$res=Array();
	$t=mysql_query("SELECT * FROM keu_rekening WHERE kategorirek='1' || kategorirek='2' ORDER BY kode");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['kode']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$r['nama'];
	}
	return $res;
}

function kategorirek_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	if($s==1)$res[0]='- Semua -';
	$t=mysql_query("SELECT * FROM keu_kategorirek ORDER BY replid");
	while($r=mysql_fetch_array($t)){
		$p="";
		//for($i=0;$i<$r['level'];$i++) $p.="&nbsp;&nbsp;";
		$res[$r['replid']]=$p.$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==0?$d:0;
	return $res;
}
function kategorirek_name($a){
	if(is_array($a))$b=$a['kategorirek'];
	else $b=$a;
	return dbFetch("nama","keu_kategorirek","W/replid='$b'");
}
function kategorirek_sel($s=0){
	$a=0;
	return kategorirek_r($a,$s);
}
function kategorirek_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kategorirek pada departemen ini.<br/>Silahkan <a class="linkb" href="#&kategorirek" onclick="PCBCODE=101;openPage('.app_page_getindex('kategorirek').',\'kategorirek\',false)">membuat data kategori rekening</a> pada menu referensi.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data kategorirek.<br/>Silahkan menghubungi bagian keuangan untuk membuat data kategorirek baru.</div>';
	}
}
?>