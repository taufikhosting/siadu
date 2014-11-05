<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran','aka/pelajaran');
// form Module
$fmod='guru';
$dbtable='aka_guru';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('tahunajaran','pegawai','pelajaran','aktif','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		$y=mysql_query("SELECT * FROM admin WHERE pegawai='".$inp['pegawai']."'");
		if(mysql_num_rows($y)==0){
			$y=mysql_query("SELECT hrd_pegawai.nip,hrd_pegawai.nama FROM hrd_pegawai WHERE hrd_pegawai.replid='".$inp['pegawai']."'");
			$u=mysql_fetch_array($y);
			$q=mysql_query("INSERT INTO admin SET app='gur', nama='".$u['nama']."', uname='".$u['nip']."', passwd='".md5('admin')."', pegawai='".$inp['pegawai']."', level='2'");
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$t=mysql_query("SELECT pegawai FROM aka_guru WHERE replid='$cid'");
		$r=mysql_fetch_array($t);
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("admin","pegawai='".$r['pegawai']."'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$r['departemen']=gpost('departemen');
		$q=mysql_query("SELECT * FROM hrd_pegawai WHERE replid='".$r['pegawai']."' LIMIT 0,1");
		if(mysql_num_rows($q)>0){
			$h=mysql_fetch_array($q);
			$r['nama']=$h['nama'];
		}
	} else {
		$r=app_form_gpost('departemen','tahunajaran','pegawai','pelajaran','aktif','keterangan');
		$r['pelajaran']=gpost('spelajaran');
		$r['aktif']='1';
	}
	$fform->dimension(450);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		//$fform->fl('Departemen',departemen_name($r['departemen']));
		//$fform->fl('Tahun ajaran',tahunajaran_name($r['tahunajaran']));
		$fform->fi('Mata Pelajaran',iSelect('pelajaran',pelajaran_opt(gpost('tahunajaran')),$r['pelajaran']));
		$fform->fi('Pegawai',app_form_getpegawai('pegawai',$r));
		//$fform->fi('Status',iSelect('aktif',array('1'=>'Aktif','0'=>'Tidak aktif'),$r['aktif']));
		//$fform->fa('Kode',iText('kode',$r['kode'],'width:40px'));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		hiddenval('aktif',1);
		
	} else if($opt=='df'){ // Delete form 
	
		if(0>0){
			$fform->reg['dlg_del']='Data <idata> masih digunakan. Apakah anda yakin untuk menghapus <idata> <data>?';
			$fform->dlg_delw($r['nama'],'Data-data kelas dan siswa yang termasuk dalam tingkat ini juga akan dihapus. Data yang sudah dihapus tidak dapat dikembalikan.');
		}
		else {
			$fform->dlg_del($r['nama']);
		}
		
		//$fform->dlg_del($r['nilai']);
		
	} $fform->foot();
} ?>