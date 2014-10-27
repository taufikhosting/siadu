<?php
$ssid=session_id();
$keyw=gpost('sbuku');
if($keyw!=''){
	$t=mysql_query("SELECT pus_peminjaman.replid FROM pus_peminjaman LEFT JOIN pus_buku ON pus_buku.replid=pus_peminjaman.buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_peminjaman.status='1' AND (pus_buku.barkode='$keyw' OR pus_katalog.judul LIKE '%".$keyw."%')");
	$n=mysql_num_rows($t);
	if($n==1){
		$r=mysql_fetch_array($t);
		if(mysql_query("INSERT INTO pus_tpjm SET ssid='$ssid',peminjaman='".$r['replid']."'")) echo "1";
		else echo "0";
	} else {
		echo "2";
	}
} else {
	echo "0";
}
?>