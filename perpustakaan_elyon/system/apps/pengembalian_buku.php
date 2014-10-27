<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();
// form Module
$fmod='pengembalian_buku';
$dbtable='pus_peminjaman';
$fform=new fform($fmod,$opt,$cid,'item');
$fform->reg['btnlabel_u_y']='Kembalikan';

$inp=app_form_gpost('status','tanggal3');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	$ec=0;
	if($opt=='u'){ // add
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		$buku_id=gpost('buku_id');
		$q=dbUpdate("pus_buku",array('status'=>1),"replid='$buku_id'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	//$fform->notif($q);
} else {

	if($opt=='uf'){
		$fform->reg['title_uf']='Pengembalian';
		$fform->reg['btnlabel_u_n']='Tidak';
		$fform->reg['btnlabel_d_y']='   Ya   ';
		$fform->head();
		
		$db=new xdb("pus_peminjaman");
		$db->field('pus_peminjaman:*','pus_buku:callnumber,barkode','pus_katalog:judul');
		$db->join('buku','pus_buku');
		$db->joinother('pus_buku','katalog','pus_katalog','replid');
		$db->where("pus_peminjaman.replid='$cid'");
		$t=$db->query();
		$r=mysql_fetch_array($t);
		
		$fform->fc('Kembalikan item berikut ini?');
		$fform->fr('Judul','<b>'.buku_judul($r['judul']).'</b>');
		$fform->fr('Barkode','<b>'.$r['barkode'].'</b>');
		
		hiddenval('buku_id',$r['buku']);
		hiddenval('status',0);
		hiddenval('tanggal3',date("Y-m-d"));
		
		$fform->foot();
	}
		
} ?>