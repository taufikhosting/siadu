<?php require_once(MODDIR.'apps/aka.php'); require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod="penempatan";
$dbtable="aka_siswa";
$fform=new fform($fmod,$opt,$cid,'penempatan siswa');

$departemen=gpost('departemen');
$tahunajaran=gpost('tahunajaran');
$angkatan=gpost('angkatan');
$tingkat=gpost('tingkat');
$kelas=gpost('kelas');
$nisn=gpost('nisn');
$nis=gpost('nis');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$t=mysql_query("SELECT `nopendaftaran`,`noformulir`,`nama`,`kelas`,`panggilan`,`aktif`,`tahunmasuk`,`proses`,`kelompok`,`kriteria`,`golongan`,`suku`,`agama`,`status`,`kondisi`,`kelamin`,`tmplahir`,`tgllahir`,`warga`,`anakke`,`jsaudara`,`bahasa`,`berat`,`tinggi`,`darah`,`photo`,`alamat`,`kodepos`,`telpon`,`pinbb`,`email`,`kesehatan`,`ketkesehatan`,`asalsekolah`,`ketsekolah`,`diterimadikelas`,`ijazah`,`keterangan`,`sumpokok`,`sumnet`,`disctb`,`discsaudara`,`disctunai`,`disctotal`,`denda`,`angsuran`,`jmlangsur`,`sppbulan`,`ujian1`,`ujian2`,`ujian3` FROM psb_calonsiswa WHERE replid='$cid'");
		$r=mysql_fetch_array($t);
		$inp=Array();
		foreach($r as $k=>$v){
			if(!is_numeric($k))
			$inp[$k]=$v;
		}
		$inp['angkatan']=$angkatan;
		$inp['kelas']=$kelas;
		$inp['nis']=$nis;
		$inp['nisn']=$nisn;
		
		$q=dbInsert($dbtable,$inp);
		if($q){
			$id=mysql_insert_id();
			dbUpdate("psb_calonsiswa",Array('idsiswa'=>$id,'kelas'=>$kelas),"replid='$cid'");
			
			$t=mysql_query("SELECT `nama`,`tmplahir`,`tgllahir`,`agama`,`warga`,`pendidikan`,`pekerjaan`,`penghasilan`,`telpon`,`pinbb`,`email` FROM psb_calonsiswa_ayah WHERE calonsiswa='$cid'");
			$r=mysql_fetch_array($t);
			$inp=Array();
			foreach($r as $k=>$v){
				if(!is_numeric($k))
				$inp[$k]=$v;
			}
			$inp['siswa']=$id;
			dbInsert($dbtable.'_ayah',$inp);
			
			$t=mysql_query("SELECT `nama`,`tmplahir`,`tgllahir`,`agama`,`warga`,`pendidikan`,`pekerjaan`,`penghasilan`,`telpon`,`pinbb`,`email` FROM psb_calonsiswa_ibu WHERE calonsiswa='$cid'");
			$r=mysql_fetch_array($t);
			$inp=Array();
			foreach($r as $k=>$v){
				if(!is_numeric($k))
				$inp[$k]=$v;
			}
			$inp['siswa']=$id;
			dbInsert($dbtable.'_ibu',$inp);
			
			$t=mysql_query("SELECT `kakek-nama`,`kakek-tgllahir`,`nenek-nama`,`nenek-tgllahir`,`tglnikah` FROM psb_calonsiswa_keluarga WHERE calonsiswa='$cid'");
			$r=mysql_fetch_array($t);
			$inp=Array();
			foreach($r as $k=>$v){
				if(!is_numeric($k))
				$inp[$k]=$v;
			}
			$inp['siswa']=$id;
			dbInsert($dbtable.'_keluarga',$inp);
			
			$t=mysql_query("SELECT `nama`,`hubungan`,`telpon` FROM psb_calonsiswa_kontakdarurat WHERE calonsiswa='$cid'");
			$r=mysql_fetch_array($t);
			$inp=Array();
			foreach($r as $k=>$v){
				if(!is_numeric($k))
				$inp[$k]=$v;
			}
			$inp['siswa']=$id;
			dbInsert($dbtable.'_kontakdarurat',$inp);

			for($i=1;$i<=3;$i++){
				$t=mysql_query("SELECT `nama`,`tgllahir`,`kelas`,`sekolah`,`ord` FROM psb_calonsiswa_saudara WHERE calonsiswa='$cid' AND ord='$i'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				dbInsert($dbtable.'_saudara',$inp);
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
		if($q){
			dbUpdate("psb_calonsiswa",Array('idsiswa'=>0,'kelas'=>0),"idsiswa='$cid'");
			
			dbDel($dbtable.'_ayah',"siswa='$cid'");
			dbDel($dbtable.'_ibu',"siswa='$cid'");
			dbDel($dbtable.'_keluarga',"siswa='$cid'");
			dbDel($dbtable.'_kontakdarurat',"siswa='$cid'");
			dbDel($dbtable.'_saudara',"siswa='$cid'");
		}
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=farray('nis','nisn');
		$r['departemen']=gpost('departemen');
		$r['tahunajaran']=gpost('tahunajaran');
		$r['kelas']=gpost('kelas');
	}
	$fform->reg['title_af']='<idata>';
	$fform->reg['title_uf']='Edit <idata>';
	$fform->reg['title_df']='Batalkan <idata>';
	$fform->dimension(350);
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		$pros=gpost('proses');
		$tp=mysql_query("SELECT angkatan FROM psb_proses WHERE replid='$pros'");
		$rp=mysql_fetch_array($tp);
		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fl('Angkatan',angkatan_name($rp['angkatan']));
		$fform->fl('Tahun ajaran',tahunajaran_name($r['tahunajaran']));
		$fform->fl('Kelas',kelas_name($r['kelas']));
		$fform->fi('No Induk',iText('nis',$r['nis'],'width:120px'));
		$fform->fi('NISN',iText('nisn',$r['nisn'],$fform->rwidths));
	
	} else if($opt=='df'){ // Delete form 
	
		$fform->reg['btnlabel_d_y']='   Ya   ';
		$fform->dlg('Batalkan penempatan siswa <b>'.$r['nama'].'</b>?');
		
	} $fform->foot();
} ?>