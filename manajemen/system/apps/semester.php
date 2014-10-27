<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran');
// form Module
$fmod='semester';
$dbtable='aka_semester';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('tahunajaran','nama','keterangan');
$tajar=$inp['tahunajaran'];

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=mysql_query("UPDATE aka_semester SET aktif='0' WHERE tahunajaran='$tajar'");
		$inp['urut']=urut_getlast($dbtable)+1;
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("aka_kelas","tingkat='$cid'");
		$q&=dbDel("aka_siswa","tingkat='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r['departemen']=gpost('departemen');
		$r['tahunajaran']=gpost('tahunajaran');
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fl('Departemen',tahunajaran_name($r['tahunajaran']));
		$fform->fi('Semester',iText('nama',$r['nama'],'width:100px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		if(intval($r['aktif'])==1){
			$fform->reg['dlg_del']='Semester ini masih aktif.<br/ >Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r['nama']);
		}
		else {
			$fform->dlg_del($r['nama']);
		}
		
		//$fform->dlg_del($r['nilai']);
		
	} $fform->foot();
}?>