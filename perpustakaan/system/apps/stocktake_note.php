<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='stocktake_note';
$dbtable=stocktake_ctable();
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('note');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	//$fform->notif($q);
	if($q) echo nl2br($inp['note']);
	else echo "-0-";
} else {
	$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	$t1=mysql_query("SELECT pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='".$r['buku']."' LIMIT 0,1");
	$r1=mysql_fetch_array($t1);
	
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fc('Tambahkan catatan untuk item:');
		$fform->fl('Barkode',$r['barkode']);
		$fform->fl('Judul',buku_judul($r1['judul']));
		$fform->fa('Keterangan',iTextarea('note',$r['note'],$fform->rwidths,3));
	
	}
	$fform->foot();
} ?>