<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid',0);
// form Module
$fmod='file';
$dbtable='rep_file';
$fform=new fform($fmod,$opt,$cid,'File');

$inp=app_form_gpost('nama','keterangan','ufile','fname');
$inp['tipe']=end(explode(".", $inp['ufile']));

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['admin']=admin_getID();
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
		$r['passwd']='';
	} else {
		$r=farray('nama','keterangan','ufile','fname');
	}
	$fform->dimension(450,120);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fi('Judul',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fa('Deskripsi',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		app_form_fu();
		
	} else if($opt=='df'){ // Delete form
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
}?>