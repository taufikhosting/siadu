<?php 
	require_once(MODDIR.'fform/fform.php'); 
	$opt=gpost('opt');
	$cid=gpost('cid');
	if($cid=='')
		$cid=0;
	// require_once(APPMOD.'sar/tempat.php');
	// require_once(APPMOD.'sar/sar.php');

	// form Module
	$fmod    = "katalog_unit";
	$dbtable = "sar_barang";
	$fform   = new fform($fmod,$opt,$cid,'Unit Barang');

	$inp            =app_form_gpost('lokasi','grup','katalog','kode','barkode','sumber','harga','kondisi','keterangan','tempat');
	$inp['urut']    =intval($inp['barkode']);
	$inp['barkode'] =sprintf("%05d",$inp['urut']); //cetak angka barkode 5 digit ex : 00224
	$nunit          =intval(gpost('nunit'));
	// print_r($inp['tempat']);exit();
	// interaction with db
	if($opt=='a'||$opt=='u'||$opt=='d'){ 
		$q=false;
		if($opt=='a'){ // add
			if($nunit>1){
				for($i=0;$i<$nunit;$i++){
					$l              =barang_lbarkode();
					$inp['kode']    =lokasi_kode($inp['lokasi']).'/'.grup_kode($inp['grup']).'/'.katalog_kode($inp['katalog']).'/'.tempat_kode($inp['tempat']).'/'.sprintf("%05d",$l);
					// $inp['kode']    .=sprintf("%05d",$l);
					$inp['barkode'] =sprintf("%05d",$l);
					$inp['urut']    =$l;
					$q              =dbInsert($dbtable,$inp);
				}
			} else {
				$q=dbInsert($dbtable,$inp);
			}
		}else if($opt=='u') { // edit
			$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		}else if($opt=='d'){ // delete
			$q=dbDel($dbtable,"replid='$cid'");
		}$fform->notif($q);
	} else { // display with UI
		// print_r($inp);exit();
		$tk=mysql_query("SELECT nama FROM sar_katalog WHERE replid='".$inp['katalog']."'");
		$rk=mysql_fetch_array($tk);
			
		if($opt=='uf'||$opt=='df'){ // update or delete form
			$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		} else { //add
			$r            =array();
			// $r            =array('kode','barkode','kondisi','lokasi','grup','tempat','katalog');
			// $inp            =app_form_gpost('lokasi','grup','katalog','kode','barkode','sumber','harga','kondisi','keterangan','tempat');
			// $r            =array('lokasi','grup','katalog','kode','barkode','sumber','harga','kondisi','keterangan','tempat');
			// $r            =farray('lokasi','grup','katalog','kode','barkode','sumber','harga','kondisi','keterangan','tempat');
			$r['sumber']  =0;

			// lokasi / grup / tempat / katalog / barang
			// 020/IT/LT2_IT/SKE/00001 
			$l            =barang_lbarkode();
			// $r['tempat']  =tempat_a($lok);
			$r['kode']    =lokasi_kode($inp['lokasi']).'/'.grup_kode($inp['grup']).'/'.tempat_kode($inp['tempat']).'/'.katalog_kode($inp['katalog']).'/'.(sprintf("%05d",$l));
			// $r['kode'].=sprintf("%05d",$l);
			// $r['kode'] =lokasi_kode($inp['lokasi']).'.'.grup_kode($inp['grup']).'.'.katalog_kode($inp['katalog']).'.';
			$r['barkode'] =sprintf("%05d",$l);
			$r['kondisi'] =1;
			// $r['tempat']=$inp['tempat']; //epiii
		}

		$fform->ptop=100;
		$fform->head();
		if($opt=='af' || $opt=='uf'){ 
			require_once(MODDIR.'control.php'); // Add or Edit form
			$fform->fl('Nama barang',$rk['nama']);
			// var_dump($r['tempat']);exit();
			// var_dump($inp['tempat']);exit();
			if($opt=='af'){
				//echo '<textarea>';
				$fform->fi('Jumlah unit baru',iText('nunit',1,'width:50px','','onblur="katalog_unit_cek(this)"'));
				hiddenval('tkode',$r['kode']);
				hiddenval('tbarkode',$r['barkode']);
				//echo '</textarea>';
			}

			$fform->fi('Kode',iText('kode',$r['kode'],$fform->rwidths,'','','disabled'));
			$fform->fi('Barkode',iText('barkode',$r['barkode'],'width:150px','','','disabled'));

							// iSelect (id, array_option, selected_value, style, function, attribute)
			// iRadio($d,$n,$v,$l='',$a='',$s=''){

			// $fform->fi('Tempat',iSelect('tempat',$tempat_a()));
			// $fform->fi('Tempat',iSelect('tempat',$r['tempat']));

			// tempat_r(&$a,$b=0,$s=0){
			// $fform->fi('Tempat',iSelect('tempat',tempat_opt($r['lokasi']),$r['tempat']));
			$fform->fi('Tempat',iSelect('tempat',tempat_opt($inp['lokasi']),$r['tempat']));

			$fform->fi('Sumber',iRadio('sumber1','sumber',0,'Beli',$r['sumber']));
			$fform->fi('',iRadio('sumber2','sumber',1,'Pemberian',$r['sumber']));
			$fform->fi('',iRadio('sumber3','sumber',2,'Membuat sendiri',$r['sumber']));
			$fform->fi('Harga',iTextC('harga',$r['harga']));
			$fform->fi('Kondisi',iSelect('kondisi',kondisi_a(),$r['kondisi']));
			$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		} else if($opt=='df'){ // Delete form 
			$fform->dlg_del($r['kode']);
		} $fform->foot();
	}
	?>