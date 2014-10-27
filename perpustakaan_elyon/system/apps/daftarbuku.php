<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
// form Module
$fmod="daftarbuku";
$dbtable="pus_buku";
$fform=new fform($fmod,$opt,$cid,'Buku');

$inp=app_form_gpost('katalog','idbuku','barkode','callnumber','sumber','harga','satuan','tanggal');
$nunit=intval(gpost('nbuku'));
$inp['lokasi']=gpost('tlokasi');
$inp['tingkatbuku']=gpost('ttingkatbuku');
$inp['tahun']=date("Y");

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$tk=mysql_query("SELECT judul,klasifikasi,pengarang FROM pus_katalog WHERE replid='".$r['katalog']."'");
		$rk=mysql_fetch_array($tk);
		
		$lok=$r['lokasi'];
		$sat=$r['satuan'];
		$tingb=$r['tingkatbuku'];
		
		$lokasi=lokasi_r($lok);
		$satuan=satuan_r($sat);
		$tingkatbuku=tingkatbuku_r($tingb);
	}

	$fform->ptop=20;
	$fform->head();
	if($opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		
		hiddenval('katalog',$r['katalog']);
		$fform->fg('Data buku');
		$fform->fl('Judul','<b>'.buku_judul($rk['judul']).'</b>');
		hiddenval('nbuku',0);
		//$fform->fi('ID buku',iText('idbuku',$r['idbuku'],$fform->rwidths,'','','disabled'));
		hiddenval('idbuku',$r['idbuku']);
		$fform->fi('Barkode',iText('barkode',$r['barkode'],$fform->rwidths,'','','disabled'));
		$fform->fi('Callnumber',iText('callnumber',$r['callnumber'],$fform->rwidths));
		$fform->fi('Sumber',iRadio('sumber1','sumber',0,'Beli',$r['sumber']));
		$fform->fi('',iRadio('sumber2','sumber',1,'Pemberian',$r['sumber']));
		$fform->fi('Harga',iSelect('satuan',$satuan,$sat).'&nbsp;'.iText('harga',$r['harga'],'width:120px'));
		$fform->fi('Tanggal diperoleh',inputTanggal('tanggal',$r['tanggal']));
		
		$fform->fg('Alokasi buku');
		$fform->fi('Lokasi',iSelect('tlokasi',$lokasi,$lok,'','katalog_buku_getkode(\''.$opt.'\')'));
		$fform->fi('Tingkat',iSelect('ttingkatbuku',$tingkatbuku,$tingb,'','katalog_buku_getkode(\''.$opt.'\')'));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['idbuku']);
		
	} $fform->foot();
}
?>