<?php
$t=mysql_query("SELECT * FROM pus_stockhist WHERE status='1' LIMIT 0,1");
$r=mysql_fetch_array($t);
$cid=$r['replid'];
$tbl=$r['tabel'];
$t1=mysql_query("SELECT sister_siadu.pus_buku.* FROM sister_siadu.pus_buku WHERE ( NOT EXISTS (SELECT sister_siaduso.".$tbl.".* FROM sister_siaduso.".$tbl." WHERE sister_siaduso.".$tbl.".buku=sister_siadu.pus_buku.replid))");
if(mysql_num_rows($t1)>0){
$r1=mysql_fetch_array($t1);
$buk=$r1['replid'];
$bk=$r1['barkode'];
mysql_query("INSERT INTO sister_siaduso.".$tbl." SET buku='$buk',barkode='$bk'");
}
$a=mysql_num_rows(mysql_query("SELECT * FROM sister_siaduso.".$tbl));
$b=mysql_num_rows(mysql_query("SELECT * FROM pus_buku"));
if($a==$b){
	mysql_query("UPDATE pus_stockhist SET status='2' WHERE replid='$cid'");
}
echo $a."-".$b;
?>