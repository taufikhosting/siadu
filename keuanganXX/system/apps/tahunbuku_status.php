<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="tahunbuku_status";
$dbtable="keu_tahunbuku";
$fform=new fform($fmod,$opt,$cid,'status tahun buku');
$aktif=gpost('aktif');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	// edit
	if($aktif==1){
		$q=mysql_query("UPDATE keu_tahunbuku SET aktif='0'");
		if($q){
			$q=mysql_query("UPDATE keu_tahunbuku SET aktif='1' WHERE replid='$cid'");
		}
	} else {
		$q=mysql_query("UPDATE keu_tahunbuku SET aktif='0' WHERE replid='$cid'");
	}
	$fform->notif($q);
} else {
	// Prepocessing form
	$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	
	$fform->reg['title_uf']='Ubah Status Tahun Buku';
	$fform->reg['btnlabel_u_y']='   Ya   ';
	$fform->reg['btnlabel_u_n']='Tidak';
	
	$fform->head();
	require_once(MODDIR.'control.php'); // Add or Edit form
		
	if($r['aktif']=='1'){
		$fform->dlg('Non-aktifkan tahun buku <b>'.$r['nama'].'</b>?',$s);
		hiddenval('aktif',0);
	} else {
		$fform->dlg('Aktifkan tahun buku <b>'.$r['nama'].'</b>, dan non aktifkan tahun buku lainnya?',$s);
		hiddenval('aktif',1);
	}
	$fform->foot();
} ?>