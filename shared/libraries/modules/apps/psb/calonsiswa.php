<?php
function calonsiswa_db_byID($id=0,$f=""){
	$db=new xdb("psb_calonsiswa");
	$db->field("psb_calonsiswa:replid,nopendaftaran,nama,proses,kelompok".($f==""?"":",".$f),"psb_proses:proses as nproses","psb_kelompok:kelompok as nkelompok");
	$db->join("proses","psb_proses");
	$db->join("kelompok","psb_kelompok");
	//$db->joinother("aka_kelas","tingkat","aka_tingkat");
	//$db->joinother("aka_tingkat","tahunajaran","aka_tahunajaran");
	//$db->joinother("aka_tahunajaran","departemen","departemen");
	$db->where("psb_calonsiswa.replid='$id'");
	return $db;
}

function calonsiswa_bayar($id,$b=1){
	return mysql_query("UPDATE psb_calonsiswa SET bayar='$b' WHERE replid='$id' LIMIT 1");
}
?>