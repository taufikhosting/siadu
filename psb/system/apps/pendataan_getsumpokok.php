<?php
	$pros =gpost('proses');
	$kel  =gpost('kelompok');
	$krit =gpost('kriteria');
	$gol  =gpost('golongan');
	$sql  ="SELECT * FROM psb_setbiaya WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol' LIMIT 0,1";
	$t    =mysql_query($sql);
	if(mysql_num_rows($t)>0){
		$r =mysql_fetch_assoc($t);
		echo $r['nilai'].'-'.$r['spp'].'-'.$r['joiningf'];
		// echo $r['nilai'].'-'.$r['spp'];
	} else
		// echo '0-0';
		echo '0-0-0';
?>