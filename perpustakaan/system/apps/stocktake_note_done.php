<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xtable/xtable.php');
$opt=gpost('opt');
if($opt=='a'){
	$q=mysql_query("UPDATE pus_stockhist SET status='4' WHERE status='3' LIMIT 1");
	if($q) echo "1";
	else echo "0";
}
else if($opt=='d'){
	$q=mysql_query("UPDATE pus_stockhist SET status='2' WHERE status='3' LIMIT 1");
	if($q) echo "2";
	else echo "0";
}
else if($opt=='af'){
	$fmod="stocktake_note_done";
	$fform=new fform($fmod,'af',$cid,'Cari siswa');
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='  Ya  ';
	$fform->reg['btnlabel_a_n']='Tidak';
	$fform->yes_act='stocktake_note_done(\'a\')';
	$fform->dimension(500);
	$tbl=stocktake_ctable();
	$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='N' AND note<>''"));
	$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='N'"));
	
	$fform->head('Akhiri pemberian catatan');
	
	if($ncek_y<$ncek){
		$fform->dlg(($ncek-$ncek_y).' item hilang tanpa keterangan. Apakah anda yakin untuk menyelesaikan proses stock opname?');
	} else {
		$fform->dlg('Akhiri pemberian catatan item dan selesaikan proses stock opname?');
	}
	$fform->foot();
}
else if($opt=='df'){
	$fmod="stocktake_note_done";
	$fform=new fform($fmod,'df',$cid,'Cari siswa');
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_d_y']='  Ya  ';
	$fform->reg['btnlabel_d_n']='Tidak';
	$fform->yes_act='stocktake_note_done(\'d\')';
	$fform->dimension(500);
	$tbl=stocktake_ctable();
	$ncek_y=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='N' AND note<>''"));
	$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='N'"));
	
	$fform->head('Kembali ke Proses Pengecekan');
	
	//if($ncek_y<$ncek){
	//	$fform->dlg(($ncek-$ncek_y).' item hilang tanpa keterangan. Apakah anda yakin untuk menyelesaikan proses stock opname?');
	//} else {
		$fform->dlg('Kembali ke proses pengecekan item?');
	//}
	$fform->foot();
}
?>