<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('keu/rekening');

// form Module
$fmod="rekening";
$dbtable="keu_rekening";
$fform=new fform($fmod,$opt,$cid,'kode rekening');

$inp=app_form_gpost('kategorirek','kode','nama','keterangan');

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
} else { $a=0;
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'"); $a=0;
		$kategorirek=kategorirek_r($a);
	} else {
		$r=farray('kategorirek','kode','nama','keterangan');
		$r['kategorirek']=gpost('skategorirek');
		$kategorirek=kategorirek_r($r['kategorirek']);
		if($r['kategorirek']!=0){
			//$r['kode']=$r['kategorirek'];
		}
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Kategori',iSelect('kategorirek',$kategorirek,$r['kategorirek'],'','rekening_setkode()'));
		$fform->fi('Kode',iText('kode',$r['kode'],'width:80px'));
		$fform->fi('Rekening',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>