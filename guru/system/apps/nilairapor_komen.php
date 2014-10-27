<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/pelajaran');
// form Module
$fmod='nilairapor_komen';
$dbtable='aka_komennilai';
$fform=new fform($fmod,$opt,$cid,'Keterangan penilaian');

$inp=app_form_gpost('komen');
$pel=gpost('pelajaran');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		
		//if($q) echo nl2br($inp['komen']);
	}
	else if($opt=='u') { // edit
		$n=dbSRow($dbtable,"W/siswa='$cid' AND pelajaran='$pel'");
		if($n==0){
			$inp['siswa']=$cid;
			$inp['pelajaran']=$pel;
			$q=dbInsert($dbtable,$inp);
		} else {
			$q=dbUpdate($dbtable,$inp,"siswa='$cid' AND pelajaran='$pel'");
		}
		if($q) echo nl2br($inp['komen']);
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	//$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=app_form_gpost('departemen','pelajaran');
		$r['bobot']='1.0';
		$r['keterangan']='';
	}
	//$fform->ptop=50;
	$fform->dimension(400,80);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fa('Keterangan',iTextarea('komen',$r['komen'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>