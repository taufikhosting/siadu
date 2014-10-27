<?php
function budget_getuses($cid){
	$uses=0;
	$t1=mysql_query("SELECT nominal FROM keu_transaksi WHERE budget='$cid'");
	while($r1=mysql_fetch_array($t1)){
		$uses+=$r1['nominal'];
	}
	return $uses;
}
function budget_getnominal($id){
	$nom=0;
	$t=mysql_query("SELECT nominal FROM keu_budget WHERE replid='$id' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		$nom=$r['nominal'];
	}
	return $nom;
}
function budget_opt($s=1,$i=0){
	$tbuku=tahunbuku_getaktifid();
	$res=Array();
	if($s==1)$res[0]='';
	$sql="SELECT * FROM  keu_budget WHERE tahunbuku='$tbuku' ORDER BY nama";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$sisa=budget_getnominal($r['replid'])-budget_getuses($r['replid']);
		$res[$r['replid']]=$r['nama'].($i!=1?'':' (sisa anggaran: '.fRp($sisa).')');
	}
	return $res;
}
function budget_r(&$a,$s=0){
	$res=Array(); $in=false; $d=0;
	//if($c==1)$res['-']='Pilih budget:';
	if($s==1)$res[0]='- Semua -';
	$sql="SELECT * FROM  keu_budget ORDER BY nama";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['nama'];
		if($d==0)$d=$r['replid']; if($r['replid']==$a)$in=true;
	}
	if(!$in)$a=$s==1?0:$d;
	return $res;
}
function budget_name($a){
	return dbFetch("budget","keu_budget","W/replid='$a'");
}
function budget_warn($a=0,$f=''){
	if(!admin_isoperator()) $a=1;
	if($a==0){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data budget calon siswa.<br/>Silahkan <a class="linkb" href="#&budget" onclick="PCBCODE=6;openPage('.app_page_getindex('budget').',\'budget\',false)">menambah data budget penerimaan siswa</a>.</div>';
	}
	else if($a==1){
		echo '<div class="warnbox" style="'.$f.'">Tidak ditemukan data budget calon siswa.<br/>Silahkan menghubungi bagian penerimaan siswa baru untuk membuat data budget calon siswa baru.</div>';
	}
}
?>