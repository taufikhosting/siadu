<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='pegawai';
$dbtable='hrd_pegawai';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('nip','nama','tmplahir','tgllahir','status');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		$cid=mysql_insert_id();
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	echo $cid;
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
	}
	$fform->head();
	if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>