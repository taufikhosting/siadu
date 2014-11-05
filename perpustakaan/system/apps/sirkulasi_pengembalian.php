<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();
// form Module
$fmod='sirkulasi_pengembalian';
$dbtable='pus_peminjaman';
$fform=new fform($fmod,$opt,$cid,'Data pengembalian');
$fform->globalkey='0';

$inp=app_form_gpost('tanggal1','tanggal2','keterangan');
$inp['member']=gpost('member_id');
$inp['mtipe']=gpost('member_tipe');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	if($opt=='a'){ // add
		$tanggal3=date("Y-m-d");
		$t=mysql_query("SELECT * FROM pus_tpjm WHERE ssid='$ssid'");
		while($r=mysql_fetch_array($t)){
			$t1=mysql_query("SELECT buku,tanggal2 FROM pus_peminjaman WHERE replid='".$r['peminjaman']."' LIMIT 0,1");
			$r1=mysql_fetch_array($t1);
			$telat=diffDay($r1['tanggal2']);
			$telat=$telat<0?-$telat:0;
			$q=dbUpdate($dbtable,array('status'=>0,'tanggal3'=>$tanggal3,'telat'=>$telat),"replid='".$r['peminjaman']."'");
			if($q){
				dbUpdate("pus_buku",array('status'=>1),"replid='".$r1['buku']."'");
				dbDel("pus_tpjm","replid='".$r['replid']."'");
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("sar_pengembalian_barang","pengembalian='$cid'");
	}
	echo $cid;
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
	}
	$fform->dimension(800);
	$fform->ptop=10;
	$fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
	$fform->head();
	if($opt=='af'||$opt=='uf'){
		echo '<tr><td>';
		require_once(APPDIR.'sirkulasi_pengembalian_form.php');
		echo '</td></tr>';
	}
	else if($opt=='df'){ // Delete form 
		$b=barang_get($r['barang']);
		$fform->dlg_del('['.$b['kode'].'] '.$b['nama']);
		
	} $fform->foot();
} ?>