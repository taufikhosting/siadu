<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran');
// form Module
$fmod='kegiatan';
$dbtable='aka_kegiatan';
$fform=new fform($fmod,$opt,$cid,'kegiatan akademik');

$inp=app_form_gpost('tahunajaran','tanggal1','tanggal2','efektif','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		//$q&=dbDel("aka_kelas","kegiatan='$cid'");
		//$q&=dbDel("aka_siswa","kegiatan='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('nama','tanggal1','tanggal2','keterangan','efektif');
		$r['efektif']=0;
	}
	$fform->ptop=60;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		//$fform->fl('Departemen',departemen_name($r['departemen']));
		//$fform->fl('Tahun ajaran',tahunajaran_name($r['tahunajaran']));
		//$fform->fi('Nama Kegiatan',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fi('Tanggal',inputTanggal('tanggal1',$r['tanggal1']));
		$fform->fi('sampai',inputTanggal('tanggal2',$r['tanggal2']));
		$fform->fi('',iCheckx('efektif','Hari efektif',$r['efektif'],'margin:6px 0px'));
		$fform->fa('Uraian kegiatan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,8));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
	} $fform->foot();
}?>