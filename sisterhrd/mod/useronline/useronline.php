<?php

$perintah = "SELECT * FROM useraura WHERE is_online = '1'";
$hasil = mysql_query( $perintah );
$jumlah = $koneksi_db->sql_numrows( $perintah );

?>