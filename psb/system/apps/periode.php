<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
require_once(APPMOD.'aka/angkatan.php');
// form Module
$fmod="periode";
$dbtable="psb_proses";
$fform=new fform($fmod,$opt,$cid,'periode penerimaan siswa');

$inp=app_form_gpost('departemen','proses','kodeawalan','angkatan','tglmulai','tglselesai','kapasitas','aktif','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
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
		$r=farray('proses','kodeawalan','angkatan','tglmulai','tglselesai','kapasitas','departemen','aktif','keterangan');
		$r['tglmulai']=date("Y-m-d");
		$r['tglselesai']=date("Y-m-d",strtotime("+7 day"));
		$r['departemen']=gpost('departemen');
		$r['aktif']='1';
		$r['kapasitas']=1;
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		$fform->fl('Departemen',departemen_name($r['departemen']),$fform->rwidths);
		$fform->fi('Nama periode',iText('proses',$r['proses'],$fform->rwidths));
		$fform->fi('Kode awalan',iText('kodeawalan',$r['kodeawalan'],"width:80px"));
		$fform->fi('Angkatan',iSelect('angkatan',angkatan_opt($r['departemen']),$r['angkatan']));
		//$fform->fi('Tanggal dibuka',inputTanggal('tglmulai',$r['tglmulai']));
		//$fform->fi('Tanggal ditutup',inputTanggal('tglselesai',$r['tglselesai']));
		$fform->fi('Kapasitas',iText('kapasitas',$r['kapasitas'],"width:40px;text-align:center").' &nbsp;siswa');
		$fform->fi('Status',iSelect('aktif',array('1'=>'Dibuka','0'=>'Ditutup'),$r['aktif']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form
	
		if($r['aktif']=='1'){
			$fform->dlg_delw($r['proses'],'Periode ini masih aktif.<br/>Semua data calon siswa yang termasuk dalam periode ini juga akan dihapus.','');
		} else {
			$fform->dlg_delw($r['proses'],'Semua data calon siswa yang termasuk dalam periode ini juga akan dihapus.');
		}
		
	} else if($opt=='hf'){
		$fform->fh('Periode penerimaan merupakan proses penerimaan yang dibuka untuk tahun ajaran tertentu. Pada umumnya periode pendaftaran dilakukan satu kali dalam satu tahun.<br/>Contoh: "Penerimaan Siswa Baru Tahun 2013"');
	} $fform->foot();
}
?>