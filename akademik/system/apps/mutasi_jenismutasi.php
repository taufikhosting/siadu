<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid',0); require_once(MODDIR.'control.php');
appmod_use('aka/jenismutasi');
// form Module
$fmod='mutasi_jenismutasi';
$dbtable='aka_jenismutasi';

if($opt=='a'){
	$inp=app_form_gpost('nama');
	$q=dbInsert($dbtable,$inp);
	$cid=mysql_insert_id();
	$jenismutasi=jenismutasi_r($cid);
	echo iSelectOpt($jenismutasi,$cid);
} else {
	$fform=new fform($fmod,$opt,$cid);
	$fform->fformid=2;
	$fform->head();
		$fform->fi('Jenis mutasi',iText('nama','',$fform->rwidths));
	$fform->foot();
}?>