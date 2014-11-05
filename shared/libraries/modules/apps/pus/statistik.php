<?php
function statistik_r(&$a){
	$res=Array('1'=>'Judul yang paling sering dipinjam','2'=>'Member dengan peminjaman terbanyak'); $in=false; $d=0;
	foreach($res as $k=>$v){
		if($d==0)$d=$k; if($k==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
?>