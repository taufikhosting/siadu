<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='aktivitas';
$dbtable='sar_'.$fmod;
$fform=new fform($fmod,$opt,$cid,'aktivitas');

$inp=app_form_gpost('lokasi','aktivitas','tanggal1','tanggal2','keterangan');

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
		$r['tanggal1']=date("Y-m-d");
		$r['tanggal2']=date("Y-m-d");
	}
	$fform->dimension(450,100);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		$fform->fi('Aktivitas',iText('aktivitas',$r['aktivitas'],$fform->rwidths));
		$fform->fi('Tanggal mulai',inpDate('tanggal1',$r['tanggal1']));
		$fform->fi('Tanggal selesai',inpDate('tanggal2',$r['tanggal2']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,10));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['aktivitas']);
		
	} $fform->foot();
} ?>