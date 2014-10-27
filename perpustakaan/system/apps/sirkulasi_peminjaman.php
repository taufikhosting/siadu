<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();
// form Module
$fmod='sirkulasi_peminjaman';
$dbtable='pus_peminjaman';
$fform=new fform($fmod,$opt,$cid,'Data Peminjaman');
$fform->globalkey='0';

$inp=app_form_gpost('tanggal1','tanggal2','keterangan');
$inp['member']=gpost('member_id');
$inp['mtipe']=gpost('member_tipe');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	if($opt=='a'){ // add
		$t=mysql_query("SELECT * FROM pus_tpjm WHERE ssid='$ssid'");
		while($r=mysql_fetch_array($t)){
			$inp['buku']=$r['buku'];
			$q=dbInsert($dbtable,$inp);
			if($q){
				dbUpdate("pus_buku",array('status'=>0),"replid='".$r['buku']."'");
				dbDel("pus_tpjm","replid='".$r['replid']."'");
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
	$fform->dimension(800);
	$fform->ptop=10;
	
	$fform->title_style='background:#008aff;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
	$fform->head();
	if($opt=='af'||$opt=='uf'){
		echo '<tr><td>';
		require_once(APPDIR.'sirkulasi_peminjaman_form.php');
		echo '</td></tr>';
	}
	else if($opt=='df'){ // Delete form 
		$b=barang_get($r['barang']);
		$fform->dlg_del('['.$b['kode'].'] '.$b['nama']);
		
	} $fform->foot();
} ?>