<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="tahunajaran_status";
$dbtable="aka_tahunajaran";
$fform=new fform($fmod,$opt,$cid,'status tahun ajaran');
$aktif=gpost('aktif');
$dept=gpost('departemen');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	// edit
	if($aktif==1){
		$q=mysql_query("UPDATE aka_tahunajaran SET aktif='0' WHERE departemen='$dept'");
		if($q){
			$q=mysql_query("UPDATE aka_tahunajaran SET aktif='1' WHERE replid='$cid'");
		}
	} else {
		$q=mysql_query("UPDATE aka_tahunajaran SET aktif='0' WHERE replid='$cid'");
	}
	$fform->notif($q);
} else {
	// Prepocessing form
	$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	
	$fform->reg['title_uf']='Ubah Status Tahun Ajaran';
	$fform->reg['btnlabel_u_y']='   Ya   ';
	$fform->reg['btnlabel_u_n']='Tidak';
	
	$fform->head();
	require_once(MODDIR.'control.php'); // Add or Edit form
		
	if($r['aktif']=='1'){
		$fform->dlg('Non-aktifkan tahun ajaran <b>'.$r['tahunajaran'].'</b>?',$s);
		hiddenval('aktif',0);
	} else {
		$fform->dlg('Aktifkan tahun ajaran <b>'.$r['tahunajaran'].'</b>, dan non aktifkan tahun ajaran lainnya?',$s);
		hiddenval('aktif',1);
	}
	$fform->foot();
} ?>