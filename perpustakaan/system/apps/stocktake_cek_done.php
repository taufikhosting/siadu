<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xtable/xtable.php');
$opt=gpost('opt');
if($opt=='a'){
	$q=mysql_query("UPDATE pus_stockhist SET status='3' WHERE status='2' LIMIT 1");
	if($q) echo "1";
	else echo "0";
}
else if($opt=='af'){
	$fmod="stocktake_cek_done";
	$fform=new fform($fmod,'af',$cid,'Cari siswa');
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='  Ya  ';
	$fform->reg['btnlabel_a_n']='Tidak';
	$fform->yes_act='stocktake_cek_done(\'a\')';
	$fform->dimension(500);
	$tbl=stocktake_ctable();
	$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='Y'"));
	$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));
	
	$fform->head('Akhiri pengecekan item');
	
	if($ncek_y<$ncek){
		$fform->dlg(($ncek-$ncek_y).' item belum dicek. Apakah anda yakin untuk melajutkan ke proses berikutnya?');
	} else {
		$fform->dlg('Akhiri pengecekan item dan lanjutkan ke proses berikutnya?');
	}
	$fform->foot();
}
?>