<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid',0);

// form Module
$fmod='kelompok';
$dbtable='hrd_m_kelompok';
$fform=new fform($fmod,$opt,$cid,'kelompok pegawai');

$inp=app_form_gpost('kelompok','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['urut']=urut_getlast($dbtable)+1;
		$q=dbInsert($dbtable,$inp);
		$cid=mysql_insert_id();
	}
	else if($opt=='u'){ // edit
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
		$r=farray('kelompok','keterangan');
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Nama kelompok',iText('kelompok',$r['kelompok'],$fform->rwidths));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form
	
		$fform->dlg_delw($r['kelompok'],'Data kelompok pada pegawai akan menjadi kosong.');
		
	} $fform->foot();
} 
?>