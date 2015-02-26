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
	// $inp=app_form_gpost('tahunbuku','nama','nominal','keterangan','id_department');
	$inp=app_form_gpost('tahunbuku','nama','nominal','keterangan','departemen');

	// proses db : add , update, delete
	if($opt=='a'||$opt=='u'||$opt=='d'){  
		$q=false;
		if($opt=='a'){ // add
			$q=dbInsert($dbtable,$inp);
			// var_dump($inp);
		}else if($opt=='u') { // edit
			$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		}else if($opt=='d'){ // delete
			$q=dbDel($dbtable,"replid='$cid'");
		}
		$fform->notif($q);
	} else { // view form : update , delete , add  
		$a=0;
		if($opt=='uf'||$opt=='df'){ // update / delete form 
			/*$sel = $dbtable.'.*';
			$r=dbSFA($sel,$dbtable.',departemen',"W/keu_budget.replid='$cid' and keu_budget.id_department=departemen.replid");  // shared/db.php
			$a=0;
			$departemen = departemen_r($a);*/
			$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		} else { // opt == 'af' //  add form 
			// $r                  = farray('tahunbuku','nama','nominal','keterangan','id_department'); //shared/libraries/common.php 
			// $r['id_department'] = gpost('sid_department'); // shared/libraries/common.php
			// $departemen      = departemen_r($r['id_department']); //shared/libraries/modules/app/keu/rekening.php 
			// $departemen      = departemen_r($r['departemen']); //shared/libraries/modules/app/keu/rekening.php 
/*			$r               = farray('tahunbuku','nama','nominal','keterangan','departemen'); //shared/libraries/common.php 
			$r['departemen'] = gpost('departemen'); // shared/libraries/common.php

			$fform->fl('Departemen',departemen_name($r['departemen']));
*/
			$r['departemen']=$inp['departemen'];
		}

		$fform->dimension(400,120);
		$fform->head(); //shared/
		if($opt=='af' || $opt=='uf'){ 
			require_once(MODDIR.'control.php'); // Add or Edit form
			// $fform->fi('Departemen',iSelect('id_department',$departemen,$r['id_department'],'','','',1)); // (tambahan) 
			// $fform->fi('Departemen',iSelect('departemen',$departemen,$r['departemen'],'','','',1)); // (tambahan) 

			// $fform->fi('Departemen',iSelect('departemen',$departemen,$r['departemen'],'','',1)); // (tambahan) 

			$fform->fl('Departemen',departemen_name($r['departemen']));
			$fform->fi('Nama anggaran',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Nominal anggaran',iTextC('nominal',$r['nominal'],'width:120px'));
			$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		} else if($opt=='df'){ // Delete form 
			$fform->dlg_del($r['nama']);
		} $fform->foot();
	} 
?>