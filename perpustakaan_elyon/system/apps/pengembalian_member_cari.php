<?php
$keyw=gpost('keyword');
$mid=0;
$mtipe=0;
$mnama='';
//log_print('peminjaman_member_cari: keyw='.$keyw);
if(preg_match("/^[0-9]+$/", $keyw)){
	//log_print('peminjaman_member_cari: match [0-9]+');
	$t=dbSel("replid,nis","aka_siswa","W/nis='$keyw' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		//log_print('peminjaman_member_cari: get siswa by nis='.$r['replid']);
		$mid=$r['replid'];
		$mtipe=1;
		$mnama=$r['nis'];
	}
	if($mid==0){
		$t=dbSel("replid,nip","hrd_pegawai","W/nip='$keyw' LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			//log_print('peminjaman_member_cari: get pegawai by nip');
			$r=mysql_fetch_array($t);
			$mid=$r['replid'];
			$mtipe=2;
			$mnama=$r['nip'];
		}
	}
}
else {
	$t=dbSel("replid,nama","aka_siswa","W/nama LIKE '$keyw%' LIMIT 0,1");
	if(mysql_num_rows($t)>0){
		//log_print('peminjaman_member_cari: get siswa by nama');
		$r=mysql_fetch_array($t);
		$mid=$r['replid'];
		$mtipe=1;
		$mnama=$r['nama'];
	}
	if($mid==0){
		$t=dbSel("replid,nama","hrd_pegawai","W/nama LIKE '$keyw%' LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			//log_print('peminjaman_member_cari: get pegawai by nama');
			$r=mysql_fetch_array($t);
			$mid=$r['replid'];
			$mtipe=2;
			$mnama=$r['nama'];
		}
	}
}
echo ($mid==0?0:$mid."-".$mtipe."-".$mnama);
?>