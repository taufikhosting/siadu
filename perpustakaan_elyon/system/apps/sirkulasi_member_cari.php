<?php
$keyw=gpost('keyword');
$mid=0;
$mtipe=0;
$mnama='';
////log_print('peminjaman_member_cari: keyw='.$keyw);
if(preg_match("/^[0-9]+$/", $keyw)){
	////log_print('peminjaman_member_cari: match [0-9]+');
	//$t=dbSel("replid,nis","aka_siswa","W/nis='$keyw' AND kelas<>0");
	$t=mysql_query("SELECT aka_siswa.replid,aka_siswa.nama,aka_siswa.nis FROM aka_siswa_kelas LEFT JOIN aka_siswa ON aka_siswa.replid=aka_siswa_kelas.siswa WHERE aka_siswa.nama nis='$keyw' GROUP BY aka_siswa_kelas.siswa");
	$n=mysql_num_rows($t);
	if($n>0){
		//log_print('peminjaman_member_cari: get siswa '.$n);
		if($n==1){
			$r=mysql_fetch_array($t);
			//log_print('peminjaman_member_cari: get siswa by nis='.$r['replid']);
			$mid=$r['replid'];
			$mnama=$r['nis'];
		}
		$mtipe=1;
	}
	//log_print('after siswa nis mid='.$mid);
	if($mid==0 && $mtipe==0){
		$t=dbSel("replid,nip","hrd_pegawai","W/nip='$keyw'");
		$n=mysql_num_rows($t);
		if($n>0){
			//log_print('peminjaman_member_cari: get pegawai by nip '.$n);
			if($n==1){
				$r=mysql_fetch_array($t);
				//log_print('peminjaman_member_cari: get pegawai by nip='.$r['replid']);
				$mid=$r['replid'];
				$mnama=$r['nip'];
			}
			$mtipe=2;
		}
	}
	//log_print('after pegawai nip mid='.$mid);
}
else {
	$t=mysql_query("SELECT aka_siswa.replid,aka_siswa.nama,aka_siswa.nis FROM aka_siswa_kelas LEFT JOIN aka_siswa ON aka_siswa.replid=aka_siswa_kelas.siswa WHERE aka_siswa.nama LIKE '%$keyw%' GROUP BY aka_siswa_kelas.siswa");
	//dbSel("replid,nama","aka_siswa","W/nama LIKE '%$keyw%'");
	$n=mysql_num_rows($t);
	if($n>0){
		//log_print('peminjaman_member_cari: get siswa by nama '.$n);
		if($n==1){
			$r=mysql_fetch_array($t);
			//log_print('peminjaman_member_cari: get siswa by nama='.$r['replid']);
			$mid=$r['replid'];
			$mnama=$r['nama'];
		}
		$mtipe=1;
	}
	//log_print('after siswa nama mid='.$mid);
	if($mid==0 && $mtipe==0){
		$t=dbSel("replid,nama","hrd_pegawai","W/nama LIKE '%$keyw%'");
		$n=mysql_num_rows($t);
		if($n>0){
			//log_print('peminjaman_member_cari: get pegawai by nama '.$n);
			if($n==1){
				$r=mysql_fetch_array($t);
				//log_print('peminjaman_member_cari: get pegawai by nama='.$r['replid']);
				$mid=$r['replid'];
				$mnama=$r['nama'];
			}
			$mtipe=2;
		}
	}
	//log_print('after pegawai nama mid='.$mid);
}
echo ($mid==0?$mtipe:$mid."-".$mtipe."-".$mnama);
?>