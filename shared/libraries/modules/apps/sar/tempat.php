<?php
	// function tempat_opt($b,$s=0){
	// 	$a=0;
	// 	return tempat_r($a,$b,$s);
	// }
	// function tempat_r(&$a,$b=0,$s=0){
	// 	$dept =Array(); 
	// 	$in   =false; 
	// 	$d    =0;
	// 	if($s==1)
	// 		$dept[0]='- Semua -';
	// 	$s='SELECT replid,nama as tempat FROM sar_tempat WHERE lokasi='.$b.' ORDER BY tempat';
	// 	$t=mysql_query($s);
	// 	while($r=mysql_fetch_array($t)){
	// 		$dept[$r['replid']]=$r['tempat'];
	// 		if($d==0)
	// 			$d=$r['replid']; 
	// 		if($r['replid']==$a)
	// 			$in=true;
	// 	}
	// 	if(!$in)
	// 		$a=$s==1?0:$d;
	// 	return $dept;
	// }
	// function tempat_name($a){
	// 	if(is_array($a)) 
	// 		$b=$a['tempat'];
	// 	else 
	// 		$b=$a;
	// 	return dbFetch("tempat","sar_tempat","W/replid='$b'");
	// }
?>