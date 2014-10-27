<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="siswakelas";
$fform=new fform($fmod,'af',$cid,'Cari siswa');
$fform->reg['title_af']='<idata>';
//$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
$fform->reg['btnlabel_a_n']='Tutup';
$fform->dimension(500);
$fform->ptop=50;
$fform->head('Pilih Siswa',0);
echo '<tr><td><div id="data_member" style="height:350px;overflow:auto">';
	require_once(APPDIR.'pengembalian_member_get_siswa.php');
echo '</div></td></tr>';
$fform->foot(0);
?>