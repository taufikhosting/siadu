<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='peminjaman';
$dbtable='sar_peminjaman';
$fform=new fform($fmod,$opt,$cid,'Peminjaman Barang');

$inp=app_form_gpost('lokasi','peminjam','tempat','tanggal1','tanggal2','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	if($opt=='a'){ // add
		$t=mysql_query("SELECT * FROM sar_dftp");
		while($r=mysql_fetch_array($t)){
			$inp['barang']=$r['barang'];
			$q=dbInsert($dbtable,$inp);
			if($q){
				dbUpdate("sar_barang",array('status'=>0),"replid='".$r['barang']."'");
				dbDel("sar_dftp","replid='".$r['replid']."'");
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("sar_peminjaman_barang","peminjaman='$cid'");
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