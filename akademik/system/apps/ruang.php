<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='ruang';
$dbtable='aka_ruang';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('departemen','nama','kode','keterangan');

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
		$r=app_form_gpost('departemen','ruang','keterangan');
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fi('Kode ruang',iText('kode',$r['nama'],'width:60px'));
		$fform->fi('Nama ruang',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		if(dbSRow("aka_siswa","W/ruang='$cid'")>0){
			$fform->reg['dlg_del']='<idata> masih digunakan. Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r[$fmod],'Data-data kelas dan siswa yang termasuk dalam tingkat ini juga akan dihapus. Data yang sudah dihapus tidak dapat dikembalikan.');
		}
		else {
			$fform->dlg_del($r[$fmod]);
		}
		
		//$fform->dlg_del($r['nilai']);
		
	} $fform->foot();
}?>