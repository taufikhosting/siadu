<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid',0);
// form Module
$fmod='grup';
$dbtable='admin';
$fform=new fform($fmod,$opt,$cid,'Anggota Grup');

$inp=app_form_gpost('uname','nama');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['app']=APID;
		$inp['level']='2';
		$inp['passwd']=md5(gpost('passwd'));
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		if($inp['passwd']!='')$inp['passwd']=md5($inp['passwd']);
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$r['passwd']='';
	} else {
		$r=farray('nama','uname','passwd','rpasswd','keterangan');
	}
	$fform->dimension(450,120);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fi('Nama anggota',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fi('User ID',iText('uname',$r['uname'],$fform->rwidths));
		$fform->fi('Password',iPswd('passwd',$r['passwd'],$fform->rwidths));
		$fform->fi('Konfirmasi password',iPswd('rpasswd',$r['rpasswd'],$fform->rwidths));
		
	} else if($opt=='df'){ // Delete form
	
		$fform->dlg_del($r['uname']);
		
	} $fform->foot();
}?>