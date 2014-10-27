<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
// form Module
$fmod='pendataan';
$dbtable='psb_calonsiswa';
$fform=new fform($fmod,$opt,$cid,'Calon siswa');

// Data calon siswa
$inp=app_form_gpost('proses','kelompok','kriteria','golongan','sumpokok','sumnet','sppbulan','denda','disctb','discsaudara','disctunai','disctotal','angsuran','jmlangsur','nopendaftaran','nama','kelamin','tmplahir','tgllahir','agama','alamat','telpon','sekolahasal','darah','kesehatan','ketkesehatan','photo');

// Data ayah calon siswa
$ia=array('ayah-nama','ayah-warga','ayah-tmplahir','ayah-tgllahir','ayah-pekerjaan','ayah-telpon','ayah-pinbb','ayah-email');
$n=count($ia); $ayah=array();
for($i=0;$i<$n;$i++){
$ayah[substr($ia[$i],5)]=gpost($ia[$i]);
}

// Data ibu calon siswa
$ia=array('ibu-nama','ibu-warga','ibu-tmplahir','ibu-tgllahir','ibu-pekerjaan','ibu-telpon','ibu-pinbb','ibu-email');
$n=count($ia); $ibu=array();
for($i=0;$i<$n;$i++){
$ibu[substr($ia[$i],4)]=gpost($ia[$i]);
}

// Data keluarga calon siswa
$ia=array('keluarga-tglnikah','keluarga-kakek-nama','keluarga-nenek-nama');
$n=count($ia); $keluarga=array();
for($i=0;$i<$n;$i++){
$keluarga[substr($ia[$i],9)]=gpost($ia[$i]);
}

// Data kontak darurat calon siswa
$ia=array('kontakdarurat-nama','kontakdarurat-hubungan','kontakdarurat-telpon');
$n=count($ia); $darurat=array();
for($i=0;$i<$n;$i++){
$darurat[substr($ia[$i],14)]=gpost($ia[$i]);
}
//,,,'photo','darah','kesehatan','ketkesehatan','kontakdarurat-nama','kontakdarurat-hubungan','kontakdarurat-telpon');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false; $ec=0;
	$ec=0;
	if($opt=='a'){ // add
		/*/ Data nomor pendaftaran
		$proses = gpost('proses');
		$sql="SELECT * FROM psb_calonsiswa WHERE proses='$proses' ORDER BY replid DESC LIMIT 0,1";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		$nom=$row['replid'];
		$sql="SELECT kodeawalan FROM psb_proses WHERE replid='$proses'";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		$kode_no=$row['kodeawalan'];
		$thn_no=substr(date("Y"), 2, 2);
		$nomor=sprintf("%04d",intval($nom) + 1);
		$no=sprintf("%s%02d%04d", $kode_no, $thn_no, $nomor);
		$inp['nopendaftaran']=$no;
		*/
		$q=dbInsert($dbtable,$inp);
		$cid=mysql_insert_id();
		$ec=1;
		
		if($q){
			$ts=mysql_query("SELECT * FROM psb_syarat");
			while($rs=mysql_fetch_array($ts)){
				$q=mysql_query("INSERT INTO psb_calonsiswa_syarat SET calonsiswa='$cid',syarat='".$rs['replid']."'");
			}
		}
		if($q){
			$ayah['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_ayah",$ayah);
		}
		if($q){
			$ibu['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_ibu",$ibu);
		}
		if($q){
			$keluarga['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_keluarga",$keluarga);
		}
		if($q){
			$darurat['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_kontakdarurat",$darurat);
		}
		if($q){
			$sesid=session_id();
			$t=mysql_query("SELECT * FROM psb_tmp_saudara WHERE sesid='$sesid'");
			while($r=mysql_fetch_array($t)){
				$q&=dbInsert("psb_calonsiswa_saudara",array('calonsiswa'=>$cid,'nama'=>$r['nama'],'tgllahir'=>$r['tgllahir'],'sekolah'=>$r['sekolah']));
				if($q) dbDel("psb_tmp_saudara","replid='".$r['replid']."'");
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		
		if($q){
			$q=dbDel("psb_calonsiswa_ayah","calonsiswa='$cid'");
			$ayah['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_ayah",$ayah);
		}
		if($q){
			$q=dbDel("psb_calonsiswa_ibu","calonsiswa='$cid'");
			$ibu['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_ibu",$ibu);
		}
		if($q){
			$q=dbDel("psb_calonsiswa_keluarga","calonsiswa='$cid'");
			$keluarga['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_keluarga",$keluarga);
		}
		if($q){
			$q=dbDel("psb_calonsiswa_kontakdarurat","calonsiswa='$cid'");
			$darurat['calonsiswa']=$cid;
			$q=dbInsert("psb_calonsiswa_kontakdarurat",$darurat);
		}
		if($q){
			$q=dbDel("psb_calonsiswa_saudara","calonsiswa='$cid'");
			$sesid=session_id();
			$t=mysql_query("SELECT * FROM psb_tmp_saudara WHERE sesid='$sesid'");
			while($r=mysql_fetch_array($t)){
				$q&=dbInsert("psb_calonsiswa_saudara",array('calonsiswa'=>$cid,'nama'=>$r['nama'],'tgllahir'=>$r['tgllahir'],'sekolah'=>$r['sekolah']));
				if($q) dbDel("psb_tmp_saudara","replid='".$r['replid']."'");
			}
		}
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		$q=dbDel("psb_calonsiswa_ayah","calonsiswa='$cid'");
		$q=dbDel("psb_calonsiswa_ibu","calonsiswa='$cid'");
		$q=dbDel("psb_calonsiswa_keluarga","calonsiswa='$cid'");
		$q=dbDel("psb_calonsiswa_kontakdarurat","calonsiswa='$cid'");
		$q=dbDel("psb_calonsiswa_saudara","calonsiswa='$cid'");
		$q=dbDel("psb_calonsiswa_syarat","calonsiswa='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
	}
	$fform->head();
	if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>