<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
$ssid=session_id();
// form Module
$fmod='sirkulasi_pengembalian_item';
$dbtable='pus_peminjaman';
$fform=new fform($fmod,$opt,$cid,'item');
$fform->reg['btnlabel_u_y']='Kembalikan';

$inp=app_form_gpost('status','tanggal3');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	$ec=0;
	if($opt=='u'){ // add
		$tanggal3=date("Y-m-d");
		$t1=mysql_query("SELECT buku,tanggal2 FROM pus_peminjaman WHERE replid='".$cid."' LIMIT 0,1");
		$r1=mysql_fetch_array($t1);
		$telat=diffDay($r1['tanggal2']);
		$telat=$telat<0?-$telat:0;
		$q=dbUpdate($dbtable,array('status'=>0,'tanggal3'=>$tanggal3,'telat'=>$telat),"replid='".$cid."'");
		if($q){
			dbUpdate("pus_buku",array('status'=>1),"replid='".$r1['buku']."'");
		}
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
		
		$fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		$fform->head();
		
		$db=new xdb("pus_peminjaman");
		$db->field('pus_peminjaman:*','pus_buku:barkode','pus_katalog:judul');
		$db->join('buku','pus_buku');
		$db->joinother('pus_buku','katalog','pus_katalog','replid');
		$db->where("pus_peminjaman.replid='$cid'");
		$t=$db->query();
		$r=mysql_fetch_array($t);
		
		//$tglsekarang = date("Y-m-d");
		$denda = diffDay(date("Y-m-d"),$r['tanggal2']);
		//$denda1 = diffDay($r['tanggal2'],$r['tanggal1']);
		if ($denda == 0){
			$tdenda = 0;
		}else {
			$tdenda = $denda * 200;
		} 
		
		$fform->fc('Kembalikan item berikut ini?');
		$fform->fr('Judul','<b>'.buku_judul($r['judul']).'</b>');
		$fform->fr('Barkode','<b>'.$r['barkode'].'</b>');
		$fform->fr('Denda','<b>'.$tdenda.'</b>');
		
		hiddenval('buku_id',$r['buku']);
		hiddenval('status',0);
		hiddenval('tanggal3',date("Y-m-d"));
		
		$fform->foot();
	}
		
} ?>