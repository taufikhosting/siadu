<?php
$pros=gpost('proses');
$kel=gpost('kelompok');
$krit=gpost('kriteria');
$gol=gpost('golongan');
$t=mysql_query("SELECT * FROM psb_setbiaya WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol' LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
echo $r['nilai'].'-'.$r['spp'];
} else echo '0-0';
?>