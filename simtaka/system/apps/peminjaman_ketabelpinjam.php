<?php 
$barang=gpost('barang');if($barang=='')$barang=0;
$katalog=gpost('katalog');if($katalog=='')$katalog=0;

mysql_query("INSERT INTO sar_dftp SET barang='$barang',katalog='$katalog'");

require_once(APPDIR.'peminjaman_tabelpinjam.php');
?>