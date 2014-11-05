<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

if($opt=='cek'){
	$old=md5(gpost('old'));
	$new=md5(gpost('new'));
	$data=admin_get();
	$cid=$data['id'];
	//echo $data['id'];
	
	$t=mysql_query("SELECT passwd FROM admin WHERE replid='$cid' LIMIT 0,1");
	if(mysql_num_rows($t)==1){
		$r=mysql_fetch_row($t);
		if($r[0]==$old){
			if(mysql_query("UPDATE admin SET passwd='$new' WHERE replid='$cid'")){
				echo "0";
			}
			else{
				echo "3";
			}
		}
		else {
			echo "2";
		}
	} else {
		echo "1";
	}
	//echo "UPDATE admin SET passwd='$new' WHERE replid='$cid'";
	exit();
}

// form Module
$fmod="setting";
$dbtable="Pengaturan";

$admin = admin_get();
$fform=new fform($fmod,$opt,$admin['id'],'Pengaturan akun');
$fform->reg['title_uf']='<idata>';

$inp=app_form_gpost('cicilan','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		
	} else {
		
	}
	$fform->lwidth=150; $fform->fwidth=500; $fform->ptop=100;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fg('Ubah Password');
		$fform->fi('Password lama',iText('oldpassword','',$fform->rwidths));
		$fform->fi('Password baru',iPswd('newpassword','',$fform->rwidths));
		$fform->fi('Ulangi password baru',iPswd('rnewpassword','',$fform->rwidths));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->reg['dlg_del']='Apakah anda yakin untuk menghapus <idata> <data> bulan?';
		$fform->dlg_del($r['cicilan']);
		
	} $fform->foot();
} ?>