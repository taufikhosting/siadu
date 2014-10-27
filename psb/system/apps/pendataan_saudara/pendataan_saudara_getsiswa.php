<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="kriteria";
$dbtable="psb_".$fmod;
$fform=new fform($fmod,'af',$cid,'Cari siswa');
$fform->fformid='2';
$fform->reg['title_af']='<idata>';
$fform->reg['btnlabel_no']='Tutup';
$fform->dimension(500);
$fform->ptop=50;
$fform->head('',0);
echo '<tr><td><div id="data_siswa" style="height:350px;overflow:auto">';
	require_once(APPDIR.'pendataan_saudara_siswacari.php');
echo '</div></td></tr>';
$fform->foot(0);
?>