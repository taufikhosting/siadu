<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('aka/tahunajaran');
// form Module
$fmod='tahunajaran';
$dbtable='aka_tahunajaran';
$fform=new fform($fmod,$opt,$cid,'Tahun Ajaran');

$inp=app_form_gpost('departemen','tahunajaran','tglmulai','tglakhir','keterangan');
$dept=$inp['departemen'];

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$taktif=tahunajaran_aktif($inp['departemen']);
		$q=mysql_query("UPDATE aka_tahunajaran SET aktif='0' WHERE departemen='$dept'");
		
		$q=dbInsert($dbtable,$inp);
		
		if(gpost('salin')=='1' && $taktif!=0){
			// salin tingkat
			$cid=mysql_insert_id();
			$t=mysql_query("SELECT * FROM  aka_tingkat WHERE  tahunajaran='$taktif'");
			while($r=mysql_fetch_array($t)){
				mysql_query("INSERT INTO aka_tingkat SET tahunajaran='$cid',tingkat='".$r['tingkat']."',keterangan='".$r['keterangan']."'");
				$ting=mysql_insert_id();
				$t1=mysql_query("SELECT * FROM aka_kelas WHERE tingkat='".$r['replid']."'");
				while($r1=mysql_fetch_array($t1)){
					mysql_query("INSERT INTO aka_kelas SET tingkat='$ting',kelas='".$r1['kelas']."',kapasitas='".$r1['kapasitas']."',wali='".$r1['wali']."',keterangan='".$r1['keterangan']."'");
				}
			}
			
			// salin pelajaran
			$t=mysql_query("SELECT * FROM  aka_pelajaran WHERE  tahunajaran='$taktif'");
			while($r=mysql_fetch_array($t)){
				mysql_query("INSERT INTO aka_pelajaran SET tahunajaran='$cid',kode='".$r['kode']."',nama='".$r['nama']."',sifat='".$r['sifat']."',skm='".$r['skm']."',keterangan='".$r['keterangan']."'");
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("aka_tingkat","tahunajaran='$cid'");
		//$q&=dbDel("aka_siswa","aka_tahunajaran='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('tahunajaran','tglmulai','tglakhir','keterangan');
		$r['departemen']=$inp['departemen'];
		$r['tahunajaran']=date("Y").'-'.date("Y",strtotime("+1 year"));
	}
	$fform->fwidth_del=600;
	$fform->head(); 
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fi('Tahun Ajaran',iText('tahunajaran',$r['tahunajaran'],$fform->rwidths));
		$fform->fi('Tanggal mulai',inpDate('tglmulai',$r['tglmulai']));
		$fform->fi('Tanggal akhir',inpDate('tglakhir',$r['tglakhir']));
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		if($opt=='af' && tahunajaran_aktif($r['departemen'])!=0){
			// iCheckbox (id, name, value, label, input value, style)
			$fform->fc(iCheckbox('salin','salin','1','Salin data Tingkat, Kelas, dan Pelajaran dari tahun ajaran aktif sebelumnya.','1'));
		} else {
			hiddenval('salin',0);
		}
		
	} else if($opt=='df'){ // Delete form 
	
		if($r['aktif']=='1'){
			$fform->dlg_delw($r['tahunajaran'],'<span style="color:#ff0000">Tahun ajaran ini masih aktif.</span><br/>Data-data akademik, siswa, dan semua data yang termasuk dalam tahun ajaran ini juga akan dihapus.','');
		} else {
			$fform->dlg_delw($r['tahunajaran'],'Data-data akademik, siswa, dan semua data yang termasuk dalam tahun ajaran ini juga akan dihapus.');
		}
		
	} $fform->foot();
}?>