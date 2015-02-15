<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="pembayaran_data";
$dbtable="keu_pembayaran";
$fform=new fform($fmod,$opt,$cid,'Data pembayaran');

$inp=app_form_gpost('nominal','cicilan','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$inp['tanggal']=date("Y-m-d");
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else { $a=0;
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'"); $a=0;
	} else {
		
	}
	$fform->dimension(400,120);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Jumlah pembayaran',iTextC('nominal',$r['nominal'],'width:120px'));
		$fform->fi('Besar cicilan',iTextC('cicilan',$r['cicilan'],'width:120px'));
		$fform->fa('Keterangan perubahan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>