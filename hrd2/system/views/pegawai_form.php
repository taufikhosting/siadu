<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
appmod_use('hrd/status');

$opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='pegawai';
$xform=new xform($fmod,$opt,$cid);

$status=status_opt();

if($opt=='uf'){ // Nilai field editan
	$t=mysql_query("SELECT * FROM hrd_pegawai WHERE replid='$cid' LIMIT 0,1");
	$data=mysql_fetch_array($t);
	$ttl='Edit';
}
else { // Nilai field default
	$data=array();
	//$data['halaman']=1;
	//$data['pengarang']='-';
	//$data['tahunterbit']=date("Y");
	$ttl='Tambah';
}

$xform->title($ttl.' Data Pagawai');
$xform->table_begin();
	$xform->col_begin();
	//$xform->set_fieldw(280);
	$xform->group_begin('Data Pribadi');
		$xform->fi('NIP',iText('nip',$data['nip'],$xform->fieldws));
		$xform->fi('Nama',iText('nama',$data['nama'],$xform->fieldws));
		$xform->fi('Tempat lahir',iText('tmplahir',$data['tmplahir'],$xform->fieldws));
		$xform->fi('Tanggal lahir',inputTanggal('tgllahir',$data['tgllahir']));
		
	$xform->group_begin('Data Kepegawaian');
		$xform->fi('Status',iSelect('status',$status,$data['status']));
$xform->table_end();
?>