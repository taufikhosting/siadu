<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='pengembalian';
$dbtable='sar_pengembalian';
$fform=new fform($fmod,$opt,$cid,'Peminjaman Barang');

$inp=app_form_gpost('peminjaman','keterangan');
$inp['tanggal']=date("Y-m-d");

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		if($q){
			$t=mysql_query("SELECT barang FROM sar_peminjaman WHERE replid='".$inp['peminjaman']."'");
			$p=mysql_fetch_array($t);
			dbUpdate("sar_barang",array('status'=>1),"replid='".$p['barang']."'");
			dbUpdate("sar_peminjaman",array('status'=>0),"replid='".$inp['peminjaman']."'");
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		//$q=dbDel("sar_peminjaman_barang","peminjaman='$cid'");
	}
	echo $cid;
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
	}
	$fform->head();
	if($opt=='df'){ // Delete form 
		$b=barang_get($r['barang']);
		$fform->dlg_del('['.$b['kode'].'] '.$b['nama']);
		
	} $fform->foot();
} ?>