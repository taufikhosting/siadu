<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/pelajaran');

// form Module
$fmod="sks_guru";
$dbtable='pus_tpjm';
$tajar=gpost('tahunajaran');

$fform=new fform($fmod,'af',$cid,'Cari item');
$fform->fformid=2;
$fform->reg['title_af']='<idata>';
$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
$fform->reg['btnlabel_a_n']='Tutup';
$fform->dimension(500);
$fform->ptop=20;
$fform->globalkey='0';
$fform->head('Guru '.pelajaran_name(gpost('pelajaran')));
echo '<tr><td><div id="box_sks_guru_list">';
	require_once(APPDIR.'sks_guru_list_get.php');
echo '</div></td></tr>';
$fform->foot(0);
?>