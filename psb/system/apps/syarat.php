<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="syarat";
$dbtable="psb_".$fmod;
$fform=new fform($fmod,$opt,$cid,'persyaratan calon siswa');

$inp=app_form_gpost('syarat','wajib','keterangan');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		if($q){
			$cid=mysql_insert_id();
			$tc=mysql_query("SELECT replid FROM psb_calonsiswa");
			while($rc=mysql_fetch_array($tc)){
				$q=mysql_query("INSERT INTO psb_calonsiswa_syarat SET calonsiswa='".$rc['replid']."',syarat='$cid'");
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("psb_calonsiswa_syarat","syarat='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('syarat','wajib','keterangan');
		$r['wajib']='1';
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Persyaratan',iText('syarat',$r['syarat'],$fform->rwidths,'','',($cid=='1'||$cid=='2')?'disabled':''));
		$fform->fi('Sifat',iSelect('wajib',array('1'=>'Wajib','0'=>'Tidak wajib'),$r['wajib']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['syarat']);
		
	} $fform->foot();
} ?>