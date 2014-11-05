<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$siswaid=gpost('siswa',0);

$fmod='pembayaran_siswa';
$xform=new xform($fmod);

$lbls='float:left;width:50px;margin-right:4px';
$fs='float:left;width:100px;margin-right:4px';

$xform->table_begin();
	$xform->col_begin();
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Data Siswa');

echo '<div style="float:left;margin-right:6px;width:62px;height:92px">';
$xform->photof($siswaid,'siswa',60,90,'h');
echo '</div>';
echo '<div style="float:left;width:180px">';

$db=siswa_db_byID($siswaid);
$t=$db->query();
$r=mysql_fetch_array($t);

echo '<div class="xrowl">';
	echo '<div class="sfont" style="font-size:14px;float:left:margin-right:4px;width:180px"><b>'.$r['nama'].'</b></div>';
echo '</div>';
echo '<div class="xrowl">';
	echo '<div class="sfont" style="'.$lbls.'">NIS:</div>';
	echo '<div class="sfont" style="'.$fs.'">'.$r['nis'].'</div>';
echo '</div>';
echo '<div class="xrowl">';
	echo '<div class="sfont" style="'.$lbls.'">Kelas:</div>';
	echo '<div class="sfont" style="'.$fs.'">'.$r['nkelas'].'</div>';
echo '</div>';
echo '</div>';
$xform->table_end(0);
?>