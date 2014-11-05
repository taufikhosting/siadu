<?php 
$barang=gpost('barang');if($barang=='')$barang=0;

mysql_query("DELETE FROM sar_dftp WHERE barang='$barang'");

require_once(APPDIR.'peminjaman_tabelpinjam.php');
?>