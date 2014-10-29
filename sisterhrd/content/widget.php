<?php 
////////////ADD THIS////////////////////////////////////
$hasilw =  $koneksi_db->sql_query( "SELECT * FROM widget where id=$widgetshare " );
$dataw = $koneksi_db->sql_fetchrow($hasilw);
$widget=$dataw[2];
echo ''.$widget.'';
///////////////////////////////////////////////////////
?>