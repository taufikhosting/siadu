<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='katalog';
$dbtable='pus_katalog';
$fform=new fform($fmod,$opt,$cid,'Katalog Buku');

$inp=app_form_gpost('klasifikasi-kode','klasifikasi','pengarang','penerjemah','editor','penerbit','tahunterbit','kota','isbn','issn','bahasa','seri','volume','edisi','jenisbuku','photo','deskripsi','halaman');
$inp['judul']=gpost('judul1').'`'.gpost('judul2');

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
		$q=dbDel("pus_buku","katalog='$cid'");
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
	
		$fform->dlg_del(buku_judul($r['judul']));
		
	} $fform->foot();
} ?>