<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/guru','aka/tahunajaran');
$ssid=session_id();

// form Module
$fmod="presensiguru";
$dbtable='aka_absen_guru';
if($opt=='a'){ $q=false;
	$tanggal=gpost('tanggal');
	$data=gpost('data');
	//log_print("DATA: ".$data);
	if($data!=""){
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$absen=gpost('absen_'.$cid);
			$keterangan=gpost('keterangan_'.$cid);
			dbDel("aka_absen_guru","guru='$cid' AND tanggal='$tanggal'");
			$q=dbQSql("INSERT INTO aka_absen_guru SET absen='$absen',keterangan='$keterangan',guru='$cid',tanggal='$tanggal'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
}
if($opt=='u'){ $q=false;
	$tanggal=gpost('tanggal');
	$tgl=explode("-",$tanggal);
	$dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
	$tgl_f=$tgl[0]."-".$tgl[1]."-1";
	$tgl_c=date("Y-m-d");
	$tgl_l=$tgl[0]."-".$tgl[1]."-".$dim;
	$tgl_cm=$tgl[0]."-".$tgl[1]."-";
	
	$data=gpost('data');
	//log_print("DATA: ".$data);
	if($data!=""){
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$tgl=$did[$i];
			$tanggal=$tgl_cm.$tgl;
			$absen=gpost('absen_'.$tgl);
			$keterangan=gpost('keterangan_'.$tgl);
			dbDel("aka_absen_guru","guru='$cid' AND tanggal='$tanggal'");
			$q=dbQSql("INSERT INTO aka_absen_guru SET absen='$absen',keterangan='$keterangan',guru='$cid',tanggal='$tanggal'");
			//log_print("INSERT INTO aka_siswa_kelas SET kelas='$kls',siswa='$cid'");
		}
	}
}
else if($opt=='d'){ // delete
	$kls=gpost('kelas');
	$q=dbDel($dbtable,"guru='$cid' AND kelas='$kls'");
}
else if($opt=='af'||$opt=='uf'){
	$fform=new fform($fmod,$opt,$cid,'Data presensi guru');
	$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(600);
	$fform->ptop=5;
	$fform->globalkey='0';
	$fform->reg['title_af']='Edit <idata>';
	$fform->head();
	//$fform->fl('Departemen',departemen_name(gpost('departemen')));
	//$fform->fl('Tingkat',tingkat_name(gpost('tingkat')));
	//$fform->fl('Tahun ajaran',tahunajaran_name(gpost('tahunajaran')));
	$fform->rheight='';
	if($opt=='af'){
		//$fform->fl('Kelas',kelas_name(gpost('kelas')));
		$fform->fl('Tanggal',fftgl(gpost('tanggal')));
	} else {
		$tanggal=gpost('tanggal');
		$db=guru_db_byID($cid);
		$r=$db->gofetch();
		$fform->fl('Nama',$r['npegawai']);
		//$fform->fl('Kelas',$r['nkelas']);
		$fform->fl('Bulan',ftgl_namabulan(intval(date("m",$tanggal))));
	}
	$fform->rheight='30px';
	echo '<tr><td colspan="2"><div id="box_presensiguru_list">';
		require_once(APPDIR.'presensiguru_list_get.php');
	echo '</div></td></tr>';
	$fform->foot();
}
?>