<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='lokasi';
$dbtable='sar_lokasi';
$fform=new fform($fmod,$opt,$cid,'Lokasi Barang');

$inp=app_form_gpost('kode','nama','alamat','kontak','keterangan');

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
	
		$fform->fi('Kode',iText('kode',$r['kode'],"width:60px"));
		$fform->fi('Nama Lokasi',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fa('Alamat',iTextarea('alamat',$r['alamat'],$fform->rwidths,3));
		$fform->fi('Kontak',iText('kontak',$r['kontak'],$fform->rwidths));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['kode']);
		
	} $fform->foot();
} ?>