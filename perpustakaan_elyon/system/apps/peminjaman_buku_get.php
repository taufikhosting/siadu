<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="peminjaman_buku";
$fform=new fform($fmod,'af',$cid,'Cari item');
$fform->reg['title_af']='<idata>';
$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
$fform->reg['btnlabel_a_n']='Batal';
$fform->dimension(600);
$fform->ptop=50;
$fform->globalkey='0';
$fform->head('Pilih Item yang Tersedia');
echo '<tr><td><div id="data_buku" style="height:350px;overflow:auto">';
	require_once(APPDIR.'peminjaman_buku_get_cari.php');
echo '</div></td></tr>';
$fform->foot();
?>