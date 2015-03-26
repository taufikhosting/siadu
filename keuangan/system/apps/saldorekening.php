<?php 
	require_once(MODDIR.'fform/fform.php'); 
	$opt=gpost('opt');
	// var_dump($opt);exit();
	$cid=gpost('cid');
	if($cid=='')
		$cid=0;
	appmod_use('keu/rekening');

	// form Module
	// $fmod    = "rekening";
	$fmod    = "saldorekening";
	$dbtable = "keu_saldorekening";
	// $dbtable = "keu_rekening";
	$fform   = new fform($fmod,$opt,$cid,'Saldo Awal');
	$inp     = app_form_gpost('nominal'); /*epiii*/
	// $inp     = app_form_gpost('kategorirek','kode','nama','nominal','keterangan'); /*epiii*/

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
			// function dbSFA($s,$t,$f=""){
			// $db->field("keu_saldorekening:replid,nominal",
			// 			"keu_rekening:kode,nama");
			// $db->join('replid','keu_saldorekening','rekening');
			// $db->where_ands("keu_saldorekening:tahunbuku='$tbuku'");
			$r=dbSFA("*",$dbtable." sr, keu_rekening r","W/sr.replid='$cid AND sr.rekening=r.replid '"); 
			// var_dump($r);exit();
			$a=0;
			$kategorirek=kategorirek_r($a);
		} else {
			$r                =farray('nominal'); /*epiii*/
			// $r                =farray('kategorirek','kode','nama','nominal','keterangan'); /*epiii*/
			$r['kategorirek'] =gpost('skategorirek');
			$kategorirek      =kategorirek_r($r['kategorirek']);
			if($r['kategorirek']!=0){
			// 	//$r['kode']=$r['kategorirek'];
			}
		}$fform->head();

		if($opt=='af' || $opt=='uf'){ 
			require_once(MODDIR.'control.php'); // Add or Edit form
			// $fform->fl('Departemen',departemen_name($r['departemen']));
			// $fform->fi('Kategori',iSelect('kategorirek',$kategorirek,$r['kategorirek'],'','rekening_setkode()'));
			// $fform->fi('Kategori',iSelect('kategorirek',$kategorirek,$r['kategorirek'],''));
			
			// $fform->fi('Kategori', kategorirek_name($r['kategorirek']));
			$fform->fi('Rekening', rekening_name($r['replid']));
			// $fform->fi('Kode',iText('kode',$r['kode'],'width:80px'));
			// $fform->fi('Rekening',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Saldo',iTextC('nominal',$r['nominal'],'width:120px')); /*epiii*/
			// $fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		} else if($opt=='df'){ // Delete form 
			$fform->dlg_del($r['nama']);
		} $fform->foot();
	} 
?>