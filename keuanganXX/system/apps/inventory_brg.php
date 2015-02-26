<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('keu/inventory');
// form Module
$fmod="inventory_brg";
$dbtable="keu_brg";
$fform=new fform($fmod,$opt,$cid,'barang');

$inp=app_form_gpost('kelompokbrg','kode','nama','tanggal','unit','satuan','keterangan');

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
		$r=farray('kode','nama','keterangan');
		$r['kelompokbrg']=gpost('kelompokbrg');
		$r['tanggal']=date("Y-m-d");
		$r['unit']=1;
		$r['satuan']='unit';
	}
	$fform->dimension(400,110);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fl('Jenis barang',kelompokbrg_name($r['kelompokbrg']));
		$fform->fi('Kode',iText('kode',$r['kode'],'width:100px'));
		$fform->fi('Nama barang',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fi('Jumlah barang',iText('unit',$r['unit'],'width:100px').' &nbsp;&nbsp;&nbsp;satuan:&nbsp;&nbsp;'.iText('satuan',$r['satuan'],'width:50px'));
		$fform->fi('Tanggal diperoleh',inputTanggal('tanggal',$r['tanggal']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>