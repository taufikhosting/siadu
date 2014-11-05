<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/semester','aka/tingkat','aka/tahunajaran','aka/pelajaran');
// form Module
$fmod='jurnal';
$dbtable='aka_jurnal';
$fform=new fform($fmod,$opt,$cid,'jurnal');

$guru=guru_SID();
$pel=gpost('pelajaran');
$kls=gpost('kelas');
$tanggal=gpost('tanggal');
$keterangan=gpost('keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='m'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		$q=mysql_query("INSERT INTO aka_jurnal SET guru='$guru',pelajaran='$pel',kelas='$kls',tanggal='$tanggal',keterangan='$keterangan'");
	}
	else if($opt=='u') { // edit
		$q=mysql_query("UPDATE aka_rpp SET tanggal='$tanggal',keterangan='$keterangan' WHERE replid='$cid'");
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
		$r['tanggal']=date("Y-m-d");
	}
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$fform->dimension(700,100,20);
		$fform->head();
		$fform->fi('Tanggal',inputTanggal('tanggal',$r['tanggal']));
		echo '<tr><td colspan="2">';
		echo iTextedit('keterangan',$r['keterangan'],($fform->fwidth-8).'px',25);
		echo '</td></tr>';
		
	} else if($opt=='df'){ // Delete form 
		$fform->head();

		$fform->dlg_del($r[$fmod]);
		
	} $fform->foot();
}
?>