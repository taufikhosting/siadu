<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/siswa','aka/kelas','aka/pelajaran');

// form Module
$fmod="daftarnilai";
$fform=new fform($fmod,$opt,$cid,'nilai');
$dbtable='aka_daftarnilai';
if($opt=='u'){ $q=false;
	$pel=gpost('pelajaran');
	$kls=gpost('kelas');
	$peni=gpost('penilaian');
	$data=gpost('data');
	if($data!=""){
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$nilai=gpost('nilai_'.$cid);
			$q=dbQSql("UPDATE aka_daftarnilai SET nilai='$nilai' WHERE penilaian='$peni' AND siswa='$cid'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
	$fform->notif($q);
}
else if($opt=='uf'){
	//$fform->reg['title_af']='<idata>';
	//$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	//$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(600);
	$fform->ptop=20;
	$fform->globalkey='0';
	$fform->head();
	$fform->rheight='';
	$fform->fl('Pelajaran',pelajaran_name(gpost('pelajaran')));
	$fform->fl('Kelas',kelas_name(gpost('kelas')));
	$fform->fl('Penilaian',guru_penilaian_name(gpost('penilaian')));
	echo '<tr><td colspan="2"><div id="box_daftarnilai_list" style="margin-top:4px">';
		require_once(APPDIR.'daftarnilai_list_get.php');
	echo '</div></td></tr>';
	$fform->foot();
}
?>