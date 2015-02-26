<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$modul=gpost('modul');
$reftipe=gpost('reftipe');
$refid=gpost('refid');
$siswaid=gpost('siswa',0);

$pemb=pembayaran_getdatabysubj($modul,$siswaid);
hiddenval('pembayaran',$pemb['replid']);

$db=siswa_db_byID($siswa);
$t=$db->query();
$siswa=mysql_fetch_array($t);

$fmod='pembayaran_data';
$xform=new xform($fmod);

$xform->table_begin();
	$xform->col_begin();
	$s='<button title="Edit data pembayaran" onclick="pembayaran_data_form(\'uf\','.$pemb['replid'].')" style="float:left;margin-left:100px" class="btn"><div class="bi_edit">Edit</div></button>';
	$xform->group_begin('Pembayaran yang harus dilunasi ',100,150);
	echo '<div class="xrowl"><div class="xlabel" style="width:100px">Pembayaran:</div><div class="xlabel" style="position:relative;height:20px;width:px">'.$pemb['modul']['nama'].'<div style="position:absolute;top:-32px;right:-80px">'.$s.'</div></div></div>';
	$xform->fl('Jml pembayaran',fRp($pemb['nominal']));
	$xform->fl('Besar cicilan',fRp($pemb['cicilan']));
	$xform->fl('Status',$pemb['lunas']==1?'<span style="color:#00a000"><b>Lunas</b></span>':'<span style="color:#ff8000"><b>Belum lunas</b></span>');
	
	
	if($pemb['keterangan']!=''){
	echo '<div class="xrowl" style="margin-top:4px"><div class="infobox" style="float:left;width:100%">Perubahan terakhir pada '.fftgl($pemb['tanggal']).'. Keterangan: <i style="float:none !important">'.$pemb['keterangan'].'.</i></div></div>';
	}

$xform->table_end(0);
?>