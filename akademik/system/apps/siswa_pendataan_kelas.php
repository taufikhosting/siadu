<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/siswa','aka/kelas');
$ssid=session_id();

// form Module
$fmod="siswa_pendataan_kelas";
$dbtable='aka_siswa_kelas';
if($opt=='a'){
	$kls=gpost('kelas');
	$data=gpost('data');
	if($data!=""){
		$q=true;
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$q&=dbQSql("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
}
else if($opt=='d'){ // delete
	$kls=gpost('kelas');
	$q=dbDel($dbtable,"siswa='$cid' AND kelas='$kls'");
}
else if($opt=='af'){
	$fform=new fform($fmod,'af',$cid,'Cari item');
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(500);
	$fform->ptop=20;
	$fform->globalkey='0';
	$fform->head('Pilih Siswa');
	echo '<tr><td><div id="box_siswa_pendataan_kelas_list">';
		require_once(APPDIR.'siswa_pendataan_kelas_list_get.php');
	echo '</div></td></tr>';
	$fform->foot();
}
else if($opt=='df'){
	$fform=new fform($fmod,'df',$cid);
	$fform->reg['title_df']='Keluarkan Siswa Dari Rombongan Belajar';
	$fform->reg['btnlabel_u_n']='Tidak';
	$fform->reg['btnlabel_d_y']='   Ya   ';
	$fform->head();
	
	$r=dbSFA("*","aka_siswa_kelas","W/replid='$cid'");
	$r1=dbSFA("nama,nis","aka_siswa","W/replid='".$r['siswa']."'");
	
	$fform->fc('Apakah anda yakin untuk mengeluarkan siswa ini dari kelas '.kelas_name($r['kelas']).'?');
	$fform->fr('Nama','<b>'.$r1['nama'].'</b>');
	$fform->fr('NIS','<b>'.$r1['nis'].'</b>');
	
	$fform->foot();
}
?>