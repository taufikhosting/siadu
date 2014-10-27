<?php
$barkode=gpost('barkode');
$t=mysql_query("SELECT pus_peminjaman.* FROM pus_peminjaman LEFT JOIN pus_buku ON pus_buku.replid=pus_peminjaman.buku WHERE pus_buku.barkode='$barkode' AND pus_peminjaman.status='1'");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	echo $r['replid']."-".$r['member']."-".$r['mtipe'];
} else {
	echo "0";
}
?>