<?php
$opt=gpost('opt');
if($opt=='getcurrent'){
	$t=mysql_query("SELECT * FROM pus_stockhist WHERE status='1'");
	if(mysql_num_rows($t)>0){
		echo "0";
	} else {
		echo "1";
	}
}
else if($opt=='cekbarkode'){
	$barkode=gpost('barkode');
	$tbl=stocktake_ctable();
	$t=mysql_query("SELECT * FROM ".$tbl." WHERE barkode='$barkode' LIMIT 0,1");
	//log_print("stocktake_cek: SELECT * FROM ".$tbl." WHERE barkode='$barkode' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		if($r['cek']=='N'){
			$buku=$r['buku'];
			$t=mysql_query("SELECT pus_buku.replid,pus_buku.barkode,pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='$buku'");
			//log_print("stocktake_cek: SELECT pus_buku.barkode,pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='$buku'"); 
			$r=mysql_fetch_array($t);
			echo $r['replid']."`".$r['barkode']." : ".buku_judul($r['judul']);
		} else {
			echo "2";
		}
	} else {
		echo "1";
	}
}
else if($opt=='cekbuku'){
	$cid=gpost('cid');
	$tbl=stocktake_ctable();
	$ts=date("Y-m-d H:i:s");
	$q=mysql_query("UPDATE ".$tbl." SET cek='Y',ts='$ts' WHERE buku='$cid'");
	if($q){
		$t=mysql_query("SELECT pus_buku.barkode,pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='$cid'");
		$r=mysql_fetch_array($t);
		echo $ts.": ".$r['barkode']." : ".buku_judul($r['judul']).", sudah dicek.".chr(13);
	} else {
		echo $ts.": ".$r['barkode']." : ".buku_judul($r['judul']).", gagal.".chr(13);
	}
	$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='Y'"));
	$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));
	$w=intval($ncek_y*400/$ncek);
	echo "`".$ncek_y."`".$ncek."`".$w."px";
}
else {
	
}