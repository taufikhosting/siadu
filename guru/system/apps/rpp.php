<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/semester','aka/tingkat','aka/tahunajaran','aka/pelajaran');
// form Module
$fmod='rpp';
$dbtable='aka_rpp';
$fform=new fform($fmod,$opt,$cid,'!RPP');

$guru=guru_SID();
$pel=gpost('pelajaran');
$ting=gpost('tingkat');
$unit=gpost('unit');
$deskripsi=gpost('deskripsi');

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='m'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		$q=mysql_query("INSERT INTO aka_rpp SET guru='$guru',pelajaran='$pel',tingkat='$ting',unit='$unit',deskripsi='$deskripsi'");
	}
	else if($opt=='u') { // edit
		$q=mysql_query("UPDATE aka_rpp SET unit='$unit',deskripsi='$deskripsi' WHERE replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
}
else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$r['departemen']=gpost('departemen');
	} else {
		$r=app_form_gpost('departemen','semester','tingkat','pelajaran');
	}
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$fform->dimension(700,100,20);
		$fform->head();
		/*$fform->rheight='24px';
		$fform->fl('Departemen',departemen_name($r));
		$fform->fl('Semester',semester_name($r));
		$fform->fl('Tingkat',tingkat_name($r));
		$fform->fl('Pelajaran',pelajaran_name($r['pelajaran']));
		$fform->rheight='30px';*/
		$fform->fi('Unit',iText('unit',$r['unit'],$fform->rwidths));
		//$fform->fa('Standar',iTextArea('standar',$r,$fform->rwidths,3));
		//$fform->fa('Standar',iTexteditLite('standar',$r,$fform->rwidth.'px',5));
		//$fform->fa('Obyektif',iTexteditLite('tujuan',$r,$fform->rwidth.'px',5));
		//$fform->fa('Obyektif',iTextArea('tujuan',$r,$fform->rwidths,5));
		//$fform->fi('Kode',iText('kode',$r,'width:150px'));
		echo '<tr><td colspan="2">';
		echo iTextedit('deskripsi',$r['deskripsi'],($fform->fwidth-8).'px',25);
		echo '</td></tr>';
		
	} else if($opt=='df'){ // Delete form 
		$fform->head();
		
		if(0>0){
			$fform->reg['dlg_del']='<idata> masih digunakan. Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r[$fmod],'Data-data siswa yang termasuk dalam kelas ini juga akan dihapus. Data yang sudah dihapus tidak dapat dikembalikan.');
		}
		else {
			$fform->dlg_del($r[$fmod]);
		}
		
	} $fform->foot();
}
?>