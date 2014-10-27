<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();

// form Module
$fmod="sirkulasi_peminjaman_form_buku";
$dbtable='pus_tpjm';
if($opt=='a'){
	$data=gpost('data');
	if($data!=""){
		$q=true;
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$q&=dbQSql("INSERT INTO pus_tpjm SET buku='$cid',ssid='$ssid'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
}
else if($opt=='d'){ // delete
	$q=dbDel($dbtable,"replid='$cid'");
}
else if($opt=='af'){
	$mtipe=gpost('mtipe',0);
	hiddenval('ff_mtipe',$mtipe);
	
	$fform=new fform($fmod,'af',$cid,'Cari item');
	$fform->fformid=2;
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(500);
	$fform->ptop=20;
	$fform->globalkey='0';
	$fform->head('Pilih Item yang Tersedia',0);
	echo '<tr><td><div id="box_sirkulasi_peminjaman_form_member_list">';
		if($mtipe==2) require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_lain_get.php');
		else if($mtipe==3) require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_lain_get.php');
		else require_once(APPDIR.'sirkulasi_peminjaman_form_member_list_siswa_get.php');
	echo '</div></td></tr>';
	$fform->foot(0);
}
?>