<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
require_once(APPMOD.'psb/proses.php');
// form Module
$fmod="kelompok";
$dbtable="psb_kelompok";
$fform=new fform($fmod,$opt,$cid,'kelompok pendaftaran');

$inp=app_form_gpost('proses','kelompok','tglmulai','tglselesai','biaya','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		unset($inp['departemen']);
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("psb_kelompok","proses='$cid'");
		$q&=dbDel("psb_calonsiswa","proses='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=Array();
		$r['departemen']=gpost('departemen');
		$r['proses']=gpost('proses');
		$r['kapasitas']=0;
		$r['biaya']=0;
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		$fform->fl('Departemen',departemen_name(gpost('departemen')),$fform->rwidths);
		$fform->fl('Proses',proses_name($r['proses']),$fform->rwidths);
		$fform->fi('Nama kelompok',iText('kelompok',$r['kelompok'],$fform->rwidths));
		$fform->fi('Tanggal dibuka',inputTanggal('tglmulai',$r['tglmulai']));
		$fform->fi('Tanggal ditutup',inputTanggal('tglselesai',$r['tglselesai']));
		$fform->fi('Biaya pendaftaran',iTextC('biaya',$r['biaya'],'width:120px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['kelompok']);
		
	} else if($opt=='hf'){
		$fform->fh('Kelompok pendaftaran adalah pembagian tahap atau gelombang pendaftaran dalam satu periode penerimaan siswa baru.<br/>Contoh kelompok pendaftaran: "Early bird", "Reguler Gelombang 1", "Reguler Gelombang 2".');
	} $fform->foot();
}
?>