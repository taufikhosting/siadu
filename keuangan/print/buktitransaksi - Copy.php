<?php
session_start();
// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');


$xtable=new xtable();

$transid=gets('token');

$t=mysql_query("SELECT * FROM  `keu_transaksi` WHERE replid='$transid'");
if(mysql_num_rows($t)>0){
// Queries:
$trans=mysql_fetch_array($t);
$kodetrans=substr($trans['nomer'],0,3);
if($kodetrans=='BKM') $ttl='BUKTI KAS MASUK';
else if($kodetrans=='BKK') $ttl='BUKTI KAS KELUAR';
else if($kodetrans=='BBM') $ttl='BUKTI BANK MASUK';
else if($kodetrans=='BBK') $ttl='BUKTI BANK KELUAR';
else $ttl='BUKTI TRANSAKSI';
?>
<head>
<title>SIADU - Keuangan : Bukti Transaksi</title>
<style type="text/css">
.dochead1{
	font:bold 13pt Arial,Tahoma,Verdana;
}
</style>
</head>
<?php
$xtable->begin();
$xtable->row_begin();
	$xtable->td($ttl,'','c','colspan="5"');
	
$xtable->row_begin();
	$xtable->td($ttl,'','c','colspan="5"');
	
$xtable->foot();
} else {
echo 'File tidak tersedia.';
}
?>