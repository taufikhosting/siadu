<?php 
	require_once(MODDIR.'fform/fform.php'); 
	$opt=gpost('opt');
	$cid=gpost('cid');
	if($cid=='')
		$cid=0;
	appmod_use('keu/rekening');

	// form Module
	$fmod    = "budget";
	$dbtable = "keu_budget";
	$fform   = new fform($fmod,$opt,$cid);
	
	// $inp=app_form_gpost('tahunbuku','nama','nominal','keterangan');
	$inp=app_form_gpost('tahunbuku','nama','nominal','keterangan','id_department');


	if($opt=='a'||$opt=='u'||$opt=='d'){  
		$q=false;
		if($opt=='a'){ // add
			$q=dbInsert($dbtable,$inp);
		}else if($opt=='u') { // edit
			$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		}else if($opt=='d'){ // delete
			$q=dbDel($dbtable,"replid='$cid'");
		}$fform->notif($q);
	} else { 
		$a=0;
		if($opt=='uf'||$opt=='df'){ // Prepocessing form
			$r=dbSFA("*",$dbtable,"W/replid='$cid'");  // shared/db.php
			$a=0;
			$kategorirek=kategorirek_r($a);
		} else { // opt == 'af'
			$r                =farray('kategorirek','kode','nama','keterangan');
			$r['kategorirek'] =gpost('skategorirek');
			$kategorirek      =kategorirek_r($r['kategorirek']);
			if($r['kategorirek']!=0){
				//$r['kode']=$r['kategorirek'];
			}
		}
		$departemen=departemen_r($a,1);

		$fform->dimension(400,120);
		$fform->head();
		if($opt=='af' || $opt=='uf'){ 
			require_once(MODDIR.'control.php'); // Add or Edit form
			$fform->fi('Departemen',iSelect('departemen',$departemen,$dept));

			// $fform->fi('Department',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Nama anggaran',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Nominal anggaran',iTextC('nominal',$r['nominal'],'width:120px'));
			$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		} else if($opt=='df'){ // Delete form 
			$fform->dlg_del($r['nama']);
		} $fform->foot();
	} 
?>