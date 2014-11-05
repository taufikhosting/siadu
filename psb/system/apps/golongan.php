<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="golongan";
$dbtable="psb_".$fmod;
$fform=new fform($fmod,$opt,$cid,'golongan calon siswa');

$inp=app_form_gpost('golongan','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("psb_setbiaya","krit='$cid'");
		$q&=dbUpdate("psb_calonsiswa",Array('golongan'=>0),"golongan='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Nama golongan',iText('golongan',$r,$fform->rwidths));
		$fform->fa('Keterangan',iTextarea('keterangan',$r,$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['golongan']);
		
	} $fform->foot();
} ?>