<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran','aka/pelajaran','aka/kelas');
// form Module
$fmod='sks';
$dbtable='aka_sks';
$fform=new fform($fmod,$opt,$cid,'Kontrak Pelajaran');

$inp=app_form_gpost('tahunajaran','pelajaran','guru');
$inp['kelas']=gpost('sks_kelas');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$njam=intval(gpost('njam',1));
		if(gpost('salin')=='1'){
			$t=dbSel("*","aka_kelas","W/tahunajaran='".$inp['tahunajaran']."'");
			while($r=dbFA($t)){
				$inp['kelas']=$r['replid'];
				for($i=0;$i<$njam;$i++){
					$q=dbInsert($dbtable,$inp);
				}
			}
		} else {
			for($i=0;$i<$njam;$i++){
				$q=dbInsert($dbtable,$inp);
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q&=dbDel("aka_siswa","kelas='$cid'");
	}
	//$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('kelas','tingkat','kapasitas','wali','keterangan');
		$r['tahunajaran']=gpost('tahunajaran');
		$r['tingkat']=gpost('tingkat');
		$r['kapasitas']=1;
	}
	$fform->dimension(450,100);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$pelajaran=pelajaran_opt(gpost('tahunajaran'));
		$fform->fl('Kelas',kelas_name(gpost('sks_kelas')));
		$fform->fi('Mata pelajaran',iSelect('pelajaran',$pelajaran,$r['kelas']));
		$s='<button title="Cari" class="btn" style="float:left" onclick="sks_guru_formlist()"><div class="bi_srcb">&nbsp;</div></button>';
		$fform->fi('Guru',iText('sguru',$r['sguru'],'float:left;margin-right:4px;width:'.($fform->rwidth-40).'px','','readonly','onclick="sks_guru_formlist()"').$s);
		hiddenval('guru',$r['guru']);
		if($opt=='af'){
			$fform->fi('Jumlah jam',iText('njam',1,'width:40px;text-align:center'));
			$fform->fi('','<div title="Cek opsi ini jika pengajar mata pelajaran untuk semua adalah sama." style="margin-top:10px">'.iCheckx('salin','Tambahkan juga ke semua kelas lainnya.',0).'</div>');
		} else {
			hiddenval('njam',1);
		}		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r[$fmod]);
		
	} $fform->foot();
}?>