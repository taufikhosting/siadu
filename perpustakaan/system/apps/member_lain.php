<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='member_lain';
$dbtable='pus_member';
$fform=new fform($fmod,$opt,$cid,'member');

$inp=app_form_gpost('nid','nama','kontak','alamat');

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
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('No ID member',iText('nid',$r['nid'],$fform->rwidths));
		$fform->fi('Nama',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fi('Kontak',iText('kontak',$r['kontak'],$fform->rwidths));
		$fform->fa('Alamat',iTextarea('alamat',$r['alamat'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>