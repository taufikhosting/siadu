<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid',0);
// form Module
$fmod='training';
$dbtable='hrd_training';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('judul','penyelenggara','tempat','tgl1','tgl2','pembicara','peserta','jenistraining');

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
		$r=farray('judul','penyelenggara','tempat','tgl1','tgl2','pembicara','peserta','jenistraining');
	}
	$fform->ptop=50;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fi('Judul',iText('judul',$r,$fform->rwidths));
		$fform->fi('Penyelenggara',iText('penyelenggara',$r,$fform->rwidths));
		$fform->fi('Tempat',iText('tempat',$r,$fform->rwidths));
		$fform->fi('Tanggal',inputDate('tgl1',$r));
		$fform->fi('',inputDate('tgl2',$r));
		$fform->fi('Pembicara',iText('pembicara',$r,$fform->rwidths));
		$fform->fi('Jenis training',iSelect('jenistraining',jenistraining_r($a),$r));
		$fform->fa('Peserta',iTextarea('peserta',$r,$fform->rwidths,5));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['judul']);
		
	} $fform->foot();
} exit();?>

