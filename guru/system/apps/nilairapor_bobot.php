<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/pelajaran');
// form Module
$fmod='nilairapor_bobot';
$dbtable='aka_penilaian';
$fform=new fform($fmod,$opt,$cid,'bobot penilaian');

$pel=gpost('pelajaran');
$kls=gpost('kelas');
$gid=guru_SID();

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$data=gpost('data');
		if($data!=""){
			$did=explode(",",$data);
			$n=count($did);
			for($i=0;$i<$n;$i++){
				$cid=$did[$i];
				$bobot=gpost('bobot_'.$cid);
				$q=dbQSql("UPDATE aka_penilaian SET bobot='$bobot' WHERE replid='$cid'");
			}
		}
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=app_form_gpost('departemen','pelajaran');
		$r['bobot']='1.0';
		$r['kkm']=70;
	}
	$fform->dimension(300,250);
	$fform->ptop=20;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		echo '<tr><td colspan="2"><div style="background:#fafafa;border:1px solid #d2d2d2;padding:5px;margin-bottom:10px;text-align:justify;line-height:130%"><p><b>Tips:</b></p><p>Untuk memperoleh nilai akhir sama dengan nilai rata-rata set semua penilaian dengan bobot yang sama.</p><p>Set bobot penilaian menjadi 0 jika penilaian tersebut tidak masuk dalam perhitungan nilai rapor.</p></div></td></tr>';
		
		$allid='';
		$t1=dbSel("*","aka_penilaian","W/guru='$gid' AND pelajaran='$pel' AND kelas='$kls'");
		while($r1=dbFA($t1)){
			$fform->fi($r1['nama'].' ('.$r1['kode'].')',iText('bobot_'.$r1['replid'],$r1['bobot'],'width:50px;text-align:center'));
			str_append($allid,$r1['replid']);
		}
		hiddenval('allid',$allid);
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>