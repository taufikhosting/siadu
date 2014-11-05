<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="tahunbuku";
$dbtable="keu_tahunbuku";
$fform=new fform($fmod,$opt,$cid,'tahun buku');

$inp=app_form_gpost('nama','kode','tanggal1','keterangan','saldoawal');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbUpdate($dbtable,array('aktif'=>0));
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
		$r=farray('nama','kode','tanggal1','keterangan');
		$r['tanggal1']=date("Y-m-d");
	}
	$fform->dimension(400,120);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Nama tahun buku',iText('nama',$r['nama'],$fform->rwidths));
		hiddenval('kode',$r['kode']);
		//$fform->fi('Kode awalan kwitansi',iText('kode',$r['kode'],'width:80px'));
		$fform->fi('Tanggal mulai',inputDate('tanggal1',$r['tanggal1']));
		$fform->fi('Saldo awal',iTextC('saldoawal',$r['saldoawal'],'width:120px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>