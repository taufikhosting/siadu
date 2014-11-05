<?php
function kategori_r($s=0){
	$res=Array();
	if($s==1)$res[0]='- Semua -';
	$res[1]='Iuran wajib siswa';
	$res[2]='Iuran sukarela siswa';
	$res[3]='Iuran wajib calon siswa';
	$res[4]='Iuran sukarela calon siswa';
	return $res;
}
function kategori_name($a){
	$res=Array();
	$res[1]='Iuran wajib siswa';
	$res[2]='Iuran sukarela siswa';
	$res[3]='Iuran wajib calon siswa';
	$res[4]='Iuran sukarela calon siswa';
	
	return $res[$a];
}
?>