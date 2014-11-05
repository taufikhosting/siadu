<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/siswa','aka/kelas');
$ssid=session_id();

// form Module
$fmod="alumni";
$fform=new fform($fmod,$opt,$cid);

$dbtable='aka_alumni';
if($opt=='a'){
	$q=false;
	$tlulus=gpost('tahunlulus');
	$data=gpost('data');
	if($data!=""){
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$q=dbQSql("INSERT INTO aka_alumni SET tahunlulus='$tlulus',siswa='$cid'");
			$q=dbQSql("UPDATE aka_siswa SET aktif='2' WHERE replid='$cid'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
	$fform->notif($q);
}
else if($opt=='u'){ // update
	$q=dbUpdate($dbtable,array('keterangan'=>gpost('keterangan')),"siswa='$cid'");
	$fform->notif($q);
}
else if($opt=='d'){ // delete
	$q=dbDel($dbtable,"siswa='$cid'");
	$q=dbQSql("UPDATE aka_siswa SET aktif='1' WHERE replid='$cid'");
	$fform->notif($q);
}
else if($opt=='af'){
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(500);
	$fform->ptop=20;
	$fform->globalkey='0';
	$fform->head('Pilih Siswa');
	echo '<tr><td><div id="box_alumni_list">';
		require_once(APPDIR.'alumni_list_get.php');
	echo '</div></td></tr>';
	$fform->foot();
}
else if($opt=='uf'){
	$r=dbSFA("*","aka_alumni","W/replid='$cid'");
	$r1=dbSFA("nama,nisn","aka_siswa","W/replid='".$r['siswa']."'");
	//$fform->reg['title_af']='<idata>';
	//$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	//$fform->reg['btnlabel_a_n']='Batal';
	//$fform->dimension(500);
	//$fform->ptop=20;
	//$fform->globalkey='0';
	$fform->head();
	$fform->fl('Nama alumni',$r1['nama']);
	$fform->fl('NISD',$r1['nisn']);
	$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	$fform->foot();
}
else if($opt=='df'){
	//$fform->reg['title_df']='Keluarkan Siswa Dari Rombongan Belajar';
	//$fform->reg['btnlabel_u_n']='Tidak';
	//$fform->reg['btnlabel_d_y']='   Ya   ';
	$fform->head();
	
	$r1=dbSFA("nama,nis","aka_siswa","W/replid='$cid'");
	
	$fform->dlg_del($r1['nama']);
	
	$fform->foot();
}
?>