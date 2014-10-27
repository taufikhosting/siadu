<?php
$opt=gpost('opt');
$sks=gpost('sks');
$kelas=gpost('kelas');
$hari=gpost('hari');
$jam=gpost('jam');

$NA="x";
if($opt=="d"){
	// Data sks yang akan dihapus
	if(mysql_query("DELETE FROM aka_jadwal WHERE sks='$sks'") && mysql_query("DELETE FROM aka_sks WHERE replid='$sks'")) $NA=0;
	else $NA=4;
} else if($opt=="u"){
	// Data sks yang akan dikembalikan
	if(mysql_query("DELETE FROM aka_jadwal WHERE sks='$sks'")) $NA=0;
	else $NA=3;
} else {
	// Data sks yang akan dimasukkan
	$t=mysql_query("SELECT aka_sks.*,aka_pelajaran.kode,hrd_pegawai.nama as npegawai FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran LEFT JOIN aka_guru ON aka_guru.replid=aka_sks.guru LEFT JOIN hrd_pegawai ON hrd_pegawai.replid=aka_guru.pegawai WHERE aka_sks.replid='$sks'");
	$r=mysql_fetch_array($t);
	$tahunajaran=$r['tahunajaran'];
	$guru=$r['guru'];
	$kode=$r['kode'].'<br/ >'.substr($r['npegawai'],0,3);

	$NA=0;
	// Cek hari jam sudah terisi
	if($NA==0){
	$tg=mysql_query("SELECT aka_jadwal.* FROM aka_jadwal LEFT JOIN aka_sks ON aka_sks.replid=aka_jadwal.sks WHERE aka_jadwal.kelas='$kelas' AND aka_jadwal.hari='$hari' AND aka_jadwal.jam='$jam' AND aka_jadwal.sks<>'$sks'");
	if(mysql_num_rows($tg)>0){
		$NA=1;
	}}

	// Cek guru bentrok (hari jam guru sama, sks beda)
	if($NA==0){
	$tg=mysql_query("SELECT aka_jadwal.* FROM aka_jadwal LEFT JOIN aka_sks ON aka_sks.replid=aka_jadwal.sks WHERE aka_jadwal.hari='$hari' AND aka_jadwal.jam='$jam' AND aka_sks.guru='$guru' AND aka_jadwal.sks<>'$sks'");
	if(mysql_num_rows($tg)>0){
		$NA=2;
	}}

	if($NA==0){
		mysql_query("DELETE FROM aka_jadwal WHERE sks='$sks'");
		//$t1=mysql_query("SELECT * FROM aka_jadwal WHERE sks='$sks'");
		mysql_query("INSERT INTO aka_jadwal SET tahunajaran='$tahunajaran', kelas='$kelas', hari='$hari', jam='$jam', sks='$sks'");
		$id=mysql_insert_id();
	}
}
echo $NA;
?>