<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='tools_label';
$dbtable='pus_setting';
$fform=new fform($fmod,$opt,$cid,'Cetak Label');

$inp=app_form_gpost('nilai');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=setting_setnilai('labelt',gpost('judul'));
		$q=setting_setnilai('labeld',gpost('deskripsi'));
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$judul=setting_getnilai('labelt');
		$deskripsi=setting_getnilai('labeld');
	} else {
		
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$fform->fi('Judul',iText('judul',$judul,$fform->rwidths));
		$fform->fi('Deskripsi',iText('deskripsi',$deskripsi,$fform->rwidths));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del('['.$r['kode'].'] '.$r['nama']);
		
	} $fform->foot();
} ?>