<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='user';
$dbtable='admin';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('uname','level','app','departemen');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['passwd']=md5('admin');
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$dept=$r['departemen'];
	} else {
		$r=farray('uname','level','departemen');
		$r['level']=2;
		$dept=0;
	}
	$departemen=departemen_r($a,1);
	$modul=array('psb'=>'Penerimaan Siswa Baru','aka'=>'Akademik','pus'=>'Perpustakaan','hrd'=>'Kepegawaian','sar'=>'Sarpras','keu'=>'Keuangan');
	$ulevel=array(1=>'Administrator',2=>'Operator',3=>'Guest');
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fi('Username',iText('uname',$r['uname'],$fform->rwidths));
		$fform->fi('Level',iSelect('level',$ulevel,$r['level']));
		$fform->fi('Modul',iSelect('app',$modul,$r['app']));
		$fform->fi('Departemen',iSelect('departemen',$departemen,$dept));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['uname']);		
	
	} $fform->foot();
}?>