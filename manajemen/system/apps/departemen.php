<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='departemen';
$dbtable='departemen';
$fform=new fform($fmod,$opt,$cid);

$inp=app_form_gpost('nama','alamat','telepon');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$inp['urut']=urut_getlast($dbtable)+1;
		$q=dbInsert($dbtable,$inp);
		$cid=mysql_insert_id();
		/*
		if($q){
			for($i=1;$i<=10;$i++){
				$q=mysql_query("INSERT INTO aka_jampelajaran SET departemen='$cid',jamke='$i'");
			}
		}
		*/
	}
	else if($opt=='u'){ // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("aka_ruang","departemen='$cid'");
		
		$t=mysql_query("SELECT replid FROM aka_tahunajaran WHERE departemen='$cid'");
		while($r=mysql_fetch_array($t)){
			$t1=mysql_query("SELECT replid FROM aka_tingkat WHERE tahunajaran='".$r['replid']."'");
			while($r1=mysql_fetch_array($t1)){
				$t2=mysql_query("SELECT * FROM aka_kelas WHERE tingkat='".$r1['replid']."'");
				while($r2=mysql_fetch_array($t2)){
					$q=dbDel("aka_siswa_kelas","kelas='".$r2['replid']."'");
				}
				$q=dbDel("aka_kelas","tingkat='".$r1['replid']."'");
			}
			$q=dbDel("aka_tingkat","tahunajaran='".$r['replid']."'");
			
			$t1=mysql_query("SELECT replid FROM aka_grup WHERE tahunajaran='".$r['replid']."'");
			while($r1=mysql_fetch_array($t1)){
				$q=dbDel("aka_siswa_grup","grup='".$r1['replid']."'");
			}
			$q=dbDel("aka_grup","tahunajaran='".$r['replid']."'");
			
			$q=dbDel("aka_nilai","tahunajaran='".$r['replid']."'");
		}
		$q=dbDel("aka_tahunajaran","departemen='$cid'");		
		
		$t=mysql_query("SELECT replid FROM aka_angkatan WHERE departemen='$cid'");
		while($r=mysql_fetch_array($t)){
			$t1=mysql_query("SELECT replid FROM aka_siswa WHERE angkatan='".$r['replid']."'");
			while($r1=mysql_fetch_array($t1)){
				$q=dbDel("aka_siswa_ayah","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_grup","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_guru","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_ibu","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_kelas","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_keluarga","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_kontakdarurat","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_saudara","siswa='".$r1['replid']."'");
				$q=dbDel("aka_siswa_tesakademis","siswa='".$r1['replid']."'");
			}
			$q=dbDel("aka_siswa","angkatan='".$r['replid']."'");
		}
		$q=dbDel("aka_angkatan","departemen='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	$fform->dimension(400,120);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$fform->fi('Nama departemen',iText('nama',$r['nama'],$fform->rwidths));
		$fform->fa('Alamat',iTextarea('alamat',$r['alamat'],$fform->rwidths,3));
		$fform->fi('Telepon',iText('telepon',$r['telepon'],$fform->rwidths));
		
	} else if($opt=='df'){ // Delete form
	
		$fform->dlg_delw($r['nama'],'Data-data akademik, siswa, keuangan, dan semua data yang termasuk dalam departemen ini juga akan dihapus. Penghapusan ini tidak dapat dikembalikan.');
		
	} $fform->foot();
} 
?>