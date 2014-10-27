<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='alumni_tahunlulus';
$dbtable='aka_tahunlulus';
$fform=new fform($fmod,$opt,$cid,'tahun kelulusan');

$inp=app_form_gpost('departemen','nama');

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
		$r['departemen']=$inp['departemen'];
	}
	$fform->dimension(400,100);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fi('Tahun kelulusan',iText('nama',$r['nama'],$fform->rwidths));
		//$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r[$fmod]);
		
	} $fform->foot();
}?>