<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran','aka/tingkat');
// form Module
$fmod='kelas';
$dbtable='aka_kelas';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('tahunajaran','tingkat','kelas','wali','kapasitas','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("aka_siswa","kelas='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('kelas','tingkat','kapasitas','wali','keterangan');
		$r['tahunajaran']=gpost('tahunajaran');
		$r['tingkat']=gpost('tingkat');
		$r['kapasitas']=1;
	}
	$fform->dimension(450,100);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fl('Departemen',departemen_name(gpost('departemen')));
		$fform->fl('Tahun ajaran',tahunajaran_name($r['tahunajaran']));
		$fform->fl('Tingkat',tingkat_name($r['tingkat']));
		$fform->fi('Nama kelas',iText($fmod,$r['kelas'],$fform->rwidths));
		$fform->fi('Kapasitas',iText('kapasitas',$r['kapasitas'],'width:40px;text-align:center').' &nbsp;siswa');
		$fform->fi('Wali',app_form_getguru('wali',$r,'kelas_setwali'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		if(dbSRow("aka_siswa","W/kelas='$cid'")>0){
			$fform->reg['dlg_del']='<idata> masih digunakan. Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r[$fmod],'Data-data siswa yang termasuk dalam kelas ini juga akan dihapus. Data yang sudah dihapus tidak dapat dikembalikan.');
		}
		else {
			$fform->dlg_del($r[$fmod]);
		}
		
	} $fform->foot();
}?>