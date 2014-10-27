<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/pelajaran');
// form Module
$fmod='penilaian';
$dbtable='aka_penilaian';
$fform=new fform($fmod,$opt,$cid,'Penilaian');

$inp=app_form_gpost('pelajaran','kelas','nama','kode','kkm','bobot','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['guru']=guru_SID();
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
		$r=app_form_gpost('departemen','pelajaran');
		$r['bobot']='1.0';
		$r['kkm']=70;
	}
	$fform->ptop=50;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fi('Nama penilaian',iText('nama',$r['nama'],$fform->rwidths,'','','onkeyup="EmakeKode(this.value,\'kode\')"'));
		$fform->fi('Kode',iText('kode',$r['kode'],'width:100px'));
		//$fform->fi('SKM',iText('kkm',$r['kkm'],'width:50px'));
		hiddenval('kkm',0);
		$fform->fi('Bobot penilaian',iText('bobot',$r['bobot'],'width:50px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>