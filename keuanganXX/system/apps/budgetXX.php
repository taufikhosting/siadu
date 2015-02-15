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
	// $inp=app_form_gpost('tahunbuku','nama','nominal','keterangan','department');
	// var_dump($inp);exit();

	// proses db : add , update, delete
	if($opt=='a'||$opt=='u'||$opt=='d'){  
		$q=false;
		if($opt=='a'){ // add
			// var_dump($inp);exit();
			$q=dbInsert($dbtable,$inp);
		}else if($opt=='u') { // edit
			$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		}else if($opt=='d'){ // delete
			$q=dbDel($dbtable,"replid='$cid'");
		}
		// echo $q;
		$fform->notif($q);
		// var_dump($q);exit();
	} else { // view form : update , delete , add  
		$a=0;
		if($opt=='uf'||$opt=='df'){ // update / delete form 
			$sel = $dbtable.'.*';
			$r=dbSFA($sel,$dbtable.',departemen',"W/keu_budget.replid='$cid' and keu_budget.id_department=departemen.replid");  // shared/db.php
			// $r=dbSFA("*",$dbtable.','.'departemen',"W/keu_budget.replid='$cid' and keu_budget.id_department=departemen.replid");  // shared/db.php
			// $r=dbSFA("*",$dbtable,"W/replid='$cid'");  // shared/db.php
			// $r=dbLJoin($dbtable,'replid','departemen','replid');  // shared/db.php
			// var_dump($r);
			$a=0;
			// $kategorirek=kategorirek_r($a);
			$departemen = departemen_r($a);
			// print_r($departemen);
		} 
		else { // opt == 'af' //  add form 
			// $r                = farray('kategorirek','kode','nama','keterangan'); //shared/libraries/common.php 
			$r                = farray('tahunbuku','nama','nominal','keterangan','id_department'); //shared/libraries/common.php 
			// $r['kategorirek'] = gpost('skategorirek'); // shared/libraries/common.php
			$r['id_department'] = gpost('sid_department'); // shared/libraries/common.php
			// $kategorirek      = kategorirek_r($r['kategorirek']); //shared/libraries/modules/app/keu/rekening.php 
			$departemen      = departemen_r($r['id_department']); //shared/libraries/modules/app/keu/rekening.php 
			// // if($r['kategorirek']!=0){
			// // 	//$r['kode']=$r['kategorirek'];
			// // }
			// $departemen=departemen_r($a,1); //shared/libraries/obj/departmen.php (tambahan)
		}
		// $departemen=departemen_r($a,1); //shared/libraries/obj/departmen.php (tambahan)
		// }$departemen=departemen_r($a); //shared/libraries/obj/departmen.php

		$fform->dimension(400,120);
		$fform->head(); //shared/
		if($opt=='af' || $opt=='uf'){ 
			// print_r($departemen);
			// exit();
			require_once(MODDIR.'control.php'); // Add or Edit form
			// function iSelect($d,$a,$s='',$y='',$cb='',$atr='',$req=''){
			$fform->fi('Departemen',iSelect('id_department',$departemen,$r['id_department'],'','','',1)); // (tambahan) 
			// $fform->fi('Departemen',iSelect('id_department',$departemen,$dept)); // (tambahan) 
			// $fform->fi('Departemen',iSelect('departemen',$r['departemen'],$dept)); // (tambahan) 
			// fi() : shared/libraries/modules/fform/fform.php
			// iSelect() : shared/libraries/modules/control.php

			// $fform->fi('Department',iText('nama',$r['nama'],$fform->rwidths));
			// $fform->fi('MBUH',iText('mbuh',$r['nama'],$fform->rwidths));
			$fform->fi('Nama anggaran',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Nominal anggaran',iTextC('nominal',$r['nominal'],'width:120px'));
			$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		} else if($opt=='df'){ // Delete form 
			$fform->dlg_del($r['nama']);
		} $fform->foot();
	} 
?>