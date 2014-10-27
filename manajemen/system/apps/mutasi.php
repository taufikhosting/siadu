<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/jenismutasi');
// form Module
$fmod='mutasi';
$dbtable='aka_mutasi';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('jenismutasi','siswa','tanggal','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		$q=dbQSql("UPDATE aka_siswa SET aktif='3' WHERE replid='".$inp['siswa']."'");
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"siswa='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"siswa='$cid'");
		$q=dbQSql("UPDATE aka_siswa SET aktif='1' WHERE replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$db=new xdb("aka_mutasi");
		$db->field("aka_mutasi:replid,jenismutasi,siswa,tanggal,keterangan","aka_siswa:nis as snis,nama as ssiswa");
		$db->join("siswa","aka_siswa");
		$db->where("aka_mutasi.siswa='$cid'");
		$r=$db->gofetch();
	} else {
		$r=array();
		$r['tanggal']=date("Y-m-d");
	}
	$fform->dimension(500);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$jenismutasi=jenismutasi_opt();
		//$fform->fl('Departemen',departemen_name($r['departemen']));
		$s='<button id="mutasi_siswa_btn" title="Cari" class="btn" style="float:left" onclick="mutasi_siswa_formlist()"><div class="bi_srcb">&nbsp;</div></button>';
		$fform->fi('Siswa',iText('snis',$r['snis'],'float:left;margin-right:4px;width:80px','','readonly','onclick="mutasi_siswa_formlist()"').iText('ssiswa',$r['ssiswa'],'float:left;margin-right:4px;width:'.($fform->rwidth-110).'px','','readonly','onclick="mutasi_siswa_formlist()"').$s);
		hiddenval('siswa',$r['siswa']);
		
		$s='<button title="Tambah jenis mutasi" class="btn" style="float:left" onclick="mutasi_jenismutasi_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$fform->fi('Tanggal',inputTanggal('tanggal',$r['tanggal']));
		$fform->fi('Jenis mutasi',iSelect('jenismutasi',$jenismutasi,$r['jenismutasi'],'float:left;margin-right:4px;min-width:80px').$s);
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,4));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['ssiswa']);
		
	} $fform->foot();
}?>