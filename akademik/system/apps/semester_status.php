<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="semester_status";
$dbtable="aka_semester";
$fform=new fform($fmod,$opt,$cid,'status semester');
$aktif=gpost('aktif');
$tajar=gpost('tahunajaran');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	// edit
	if($aktif==1){
		$q=mysql_query("UPDATE aka_semester SET aktif='0' WHERE tahunajaran='$tajar'");
		if($q){
			$q=mysql_query("UPDATE aka_semester SET aktif='1' WHERE replid='$cid'");
		}
	} else {
		$q=mysql_query("UPDATE aka_semester SET aktif='0' WHERE replid='$cid'");
	}
	$fform->notif($q);
} else {
	// Prepocessing form
	$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	
	$fform->reg['title_uf']='Ubah Status Semester';
	$fform->reg['btnlabel_u_y']='   Ya   ';
	$fform->reg['btnlabel_u_n']='Tidak';
	
	$fform->head();
	require_once(MODDIR.'control.php'); // Add or Edit form
		
	if($r['aktif']=='1'){
		$fform->dlg('Non-aktifkan semester <b>'.$r['nama'].'</b>?',$s);
		hiddenval('aktif',0);
	} else {
		$fform->dlg('Aktifkan semester <b>'.$r['nama'].'</b>, dan non aktifkan semester lainnya?',$s);
		hiddenval('aktif',1);
	}
	$fform->foot();
} ?>