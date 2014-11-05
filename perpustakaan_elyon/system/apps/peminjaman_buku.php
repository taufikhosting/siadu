<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();
// form Module
$fmod='peminjaman_buku';
$dbtable='pus_tpjm';
$fform=new fform($fmod,$opt,$cid,'item');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	$ec=0;
	if($opt=='a'){ // add
		$data=gpost('data');
		if($data!=""){
			$q=true;
			$did=explode(",",$data);
			$n=count($did);
			for($i=0;$i<$n;$i++){
				$cid=$did[$i];
				$q&=dbQSql("INSERT INTO pus_tpjm SET buku='$cid',ssid='$ssid'");
				//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
			}
		}
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	//$fform->notif($q);
} else {

	if($opt=='df'){ // Delete form 
		$fform->reg['title_df']='Keluarkan Item Dari Daftar Peminjaman';
		$fform->reg['btnlabel_u_n']='Tidak';
		$fform->reg['btnlabel_d_y']='   Ya   ';
		$fform->head();
		
		$r=dbSFA("*","aka_siswa_kelas","W/replid='$cid'");
		$r1=dbSFA("nama,nis","aka_siswa","W/replid='".$r['siswa']."'");
		
		$fform->fc('Apakah anda yakin untuk mengeluarkan item ini daftar peminjaman?');
		$fform->fr('Nama','<b>'.$r1['nama'].'</b>');
		$fform->fr('NIS','<b>'.$r1['nis'].'</b>');
		
		$fform->foot();
	}
		
} ?>