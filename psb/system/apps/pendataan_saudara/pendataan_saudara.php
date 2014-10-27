<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="pendataan_saudara";
$dbtable="psb_tmp_saudara";
$fform=new fform($fmod,$opt,$cid,'Data saudara calon siswa');

$inp['sesid']=session_id();
$inp['nama']=gpost('psnama');
$inp['tgllahir']=gpost('pstgllahir');
$inp['sekolah']=gpost('pssekolah');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	//$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$s='<button class="find21" title="Cari siswa" style="float:left;margin-top:2px" onclick="pendataan_saudara_getsiswa()"></button>';
		//$fform->fi('Nama',iText('psnama',$r['nama'],'float:left;margin-right:4px;width:'.($fform->fwidth-$fform->lwidth-48).'px').$s);
		//function ffval($id,$v='',$v1='',$act='',$ttl='Cari')
		$fform->fi('Nama',$fform->ffval('psnama',$r['nama'],$r['nama'],'pendataan_saudara_popup()','Cari siswa'));
		$fform->fi('Tanggal lahir',inputDate('pstgllahir',$r['tgllahir']));
		$fform->fi('Sekolah',iText('pssekolah',$r['sekolah'],$fform->rwidths));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>