<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
// form Module
$fmod="daftarbuku_cek";
$dbtable="pus_buku";
$fform=new fform($fmod,$opt,$cid,'Buku');

$data=gpost('data');

if($opt=='d'){ $q=false;
	$d=explode(",",$data);
	$n=count($d);
	for($i=0;$i<$n;$i++){
		$cid=$d[$i];
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	$fform->head();
	if($opt=='df'){ // Delete form 
		$d=explode(",",$data);
		$n=count($d);
		$fform->dlg('Apakah anda yakin untuk menghapus '.$n.' buku yang dipilih?');
		
	} $fform->foot();
}
?>