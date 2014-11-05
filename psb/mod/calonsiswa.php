<?php
function calonsiswa_get($id){
	$t=mysql_query("SELECT * FROM psb_calonsiswa WHERE replid='$id' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	return $r;
}
function calonsiswa_del($id){
	$q=mysql_query("DELETE FROM psb_calonsiswa_ayah WHERE calonsiswa='$id'");
	$q=mysql_query("DELETE FROM psb_calonsiswa_ibu WHERE calonsiswa='$id'");
	$q=mysql_query("DELETE FROM psb_calonsiswa_keluarga WHERE calonsiswa='$id'");	
	$q=mysql_query("DELETE FROM psb_calonsiswa_kontakdarurat WHERE calonsiswa='$id'");
	$q=mysql_query("DELETE FROM psb_calonsiswa_saudara WHERE calonsiswa='$id'");
	$q=mysql_query("DELETE FROM psb_calonsiswa_syarat WHERE calonsiswa='$id'");
	$q=mysql_query("DELETE FROM psb_calonsiswa WHERE replid='$id'");
	return $q;
}
?>