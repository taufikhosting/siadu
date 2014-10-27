<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran','aka/pelajaran');
// form Module
$fmod='pelajaran';
$dbtable='aka_pelajaran';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('tahunajaran','kode','nama','skm','keterangan');

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
		$r=app_form_gpost('departemen','tahunajaran','kode','nama','sifat','keterangan');
		$r['sifat']='1';
		$r['skm']=0;
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		//$fform->fl('Departemen',departemen_name($r['departemen']));
		//$fform->fl('Tahun ajaran',tahunajaran_name($r['tahunajaran']));
		$fform->fi('Nama Pelajaran',iText('nama',$r['nama'],$fform->rwidths,'','','onkeyup="pelajaran_form_getkode()"'));
		$fform->fi('Singkatan',iText('kode',$r['kode'],'width:60px','','onblur="this.value=this.value.toUpperCase()"'));
		$fform->fi('SKM',iText('skm',$r['skm'],'width:50px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		if(0>0){
			$fform->reg['dlg_del']='Tingkat masih digunakan. Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r[$fmod],'Data-data kelas dan siswa yang termasuk dalam tingkat ini juga akan dihapus. Data yang sudah dihapus tidak dapat dikembalikan.');
		}
		else {
			$fform->dlg_del(matapelajaran_name($r['matapelajaran']));
		}
		
		//$fform->dlg_del($r['nilai']);
		
	} $fform->foot();
}?>