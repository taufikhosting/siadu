<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('psb','aka/angkatan');
// form Module
$fmod="pendataan_status";
$dbtable="psb_calonsiswa";
$fform=new fform($fmod,$opt,$cid,'status calon siswa');
$inp=app_form_gpost('status');

$departemen=gpost('departemen');
$tahunajaran=gpost('tahunajaran');
$angkatan=gpost('angkatan');
$tingkat=gpost('tingkat');
$kelas=gpost('kelas');
$nisn=gpost('nisn');
$nis=gpost('nis');

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='u') { // edit
		$ec=0;
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
		
		if(!$q) $ec=1;
		
		if($inp['status']=='1'){
			$dbtable="aka_siswa";
			$t=mysql_query("SELECT `nopendaftaran`,`noformulir`,`nama`,`panggilan`,`aktif`,`tahunmasuk`,`proses`,`kelompok`,`kriteria`,`golongan`,`suku`,`agama`,`status`,`kondisi`,`kelamin`,`tmplahir`,`tgllahir`,`warga`,`anakke`,`jsaudara`,`bahasa`,`berat`,`tinggi`,`darah`,`photo`,`alamat`,`kodepos`,`telpon`,`pinbb`,`email`,`kesehatan`,`ketkesehatan`,`asalsekolah`,`ketsekolah`,`diterimadikelas`,`ijazah`,`keterangan`,`sumpokok`,`sumnet`,`disctb`,`discsaudara`,`disctunai`,`disctotal`,`denda`,`angsuran`,`jmlangsur`,`sppbulan`,`ujian1`,`ujian2`,`ujian3` FROM psb_calonsiswa WHERE replid='$cid'");
			$r=mysql_fetch_array($t);
			$inp=Array();
			foreach($r as $k=>$v){
				if(!is_numeric($k))
				$inp[$k]=$v;
			}
			//$inp['departemen']=$departemen;
			$inp['angkatan']=$angkatan;
			//$inp['kelas']=$kelas;
			$inp['nis']=$nis;
			$inp['nisn']=$nisn;
			
			$q=dbInsert($dbtable,$inp);
			if($q){
				$id=mysql_insert_id();
				dbUpdate("psb_calonsiswa",Array('idsiswa'=>$id),"replid='$cid'");
				
				$t=mysql_query("SELECT `nama`,`tmplahir`,`tgllahir`,`agama`,`warga`,`pendidikan`,`pekerjaan`,`penghasilan`,`telpon`,`pinbb`,`email` FROM psb_calonsiswa_ayah WHERE calonsiswa='$cid'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				if(!dbInsert($dbtable.'_ayah',$inp)) $ec=3;
				
				$t=mysql_query("SELECT `nama`,`tmplahir`,`tgllahir`,`agama`,`warga`,`pendidikan`,`pekerjaan`,`penghasilan`,`telpon`,`pinbb`,`email` FROM psb_calonsiswa_ibu WHERE calonsiswa='$cid'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				if(!dbInsert($dbtable.'_ibu',$inp)) $ec=4;
				
				$t=mysql_query("SELECT `kakek-nama`,`kakek-tgllahir`,`nenek-nama`,`nenek-tgllahir`,`tglnikah` FROM psb_calonsiswa_keluarga WHERE calonsiswa='$cid'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				if(!dbInsert($dbtable.'_keluarga',$inp)) $ec=5;
				
				$t=mysql_query("SELECT `nama`,`hubungan`,`telpon` FROM psb_calonsiswa_kontakdarurat WHERE calonsiswa='$cid'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				if(!dbInsert($dbtable.'_kontakdarurat',$inp)) $ec=6;

				$t=mysql_query("SELECT `nama`,`tgllahir`,`sekolah` FROM psb_calonsiswa_saudara WHERE calonsiswa='$cid'");
				$r=mysql_fetch_array($t);
				$inp=Array();
				foreach($r as $k=>$v){
					if(!is_numeric($k))
					$inp[$k]=$v;
				}
				$inp['siswa']=$id;
				if(!dbInsert($dbtable.'_saudara',$inp)) $ec=7;
			} else {
				$ec=2;
			}
		} else {
			$ts=mysql_query("SELECT idsiswa FROM psb_calonsiswa WHERE replid='$cid'");
			$rs=mysql_fetch_array($ts);
			$idsiswa=$rs['idsiswa'];
			if($idsiswa!=0){
				$dbtable="aka_siswa";
				$q=dbDel($dbtable,"replid='$idsiswa'");
				if($q){
					dbUpdate("psb_calonsiswa",Array('idsiswa'=>0,'kelas'=>0),"replid='$cid'");
					
					dbDel($dbtable.'_ayah',"siswa='$idsiswa'");
					dbDel($dbtable.'_ibu',"siswa='$idsiswa'");
					dbDel($dbtable.'_keluarga',"siswa='$idsiswa'");
					dbDel($dbtable.'_kontakdarurat',"siswa='$idsiswa'");
					dbDel($dbtable.'_saudara',"siswa='$idsiswa'");
				}
			}
		}
	}
	$fform->notif($q);
} else {
	$r=dbSFA("replid,nama,status,nopendaftaran,noformulir",$dbtable,"W/replid='$cid'");
	
	//$fform->dimension(350,100);
	if($r['status']=='1'){
		$fform->reg['title_uf']='Batalkan Penerimaan Siswa';
		$fform->reg['btnlabel_u_y']='   Ya   ';
		$fform->reg['btnlabel_u_n']='Tidak';
	}
	else{
		$fform->reg['title_uf']='Penerimaan Calon Siswa';
		
		//$this->reg['btnlabel_u_y']='Simpan';
	}
	
	if($r['status']!='0'){
		$fform->dimension(400);
	}
	if($r['status']=='0') $fform->ptop=50;
	$fform->head();
	require_once(MODDIR.'control.php'); // Add or Edit form
	
	if($r['status']=='0'){
		$r['departemen']=gpost('departemen');
		$r['tahunajaran']=gpost('tahunajaran');
		$r['kelas']=gpost('kelas');
		$pros=gpost('proses');
		$tp=mysql_query("SELECT angkatan FROM psb_proses WHERE replid='$pros'");
		$rp=mysql_fetch_array($tp);
		$angkatan=$rp['angkatan'];
		/*
		$s='<table cellspacing="0" cellpadding="0"><tr>';
		$s.='<tr height="20px"><td width="100px">Nama:</td><td><b>'.$r['nama'].'</b></td></tr>';
		$s.='<tr height="20px"><td>No pendaftaran:</td><td>'.$r['nopendaftaran'].'</td></tr>';
		$cs=calonsiswa_syarat($r['replid']);
		if($cs>1){
			$s.='<tr><td colspan="2"><div class="warnbox" style="margin-top:6px">Persyaratan wajib belum dipenuhi. Apakah anda yakin untuk menerima siswa tersebut sebagai siswa aktif?</div></td></tr>';
			$fform->reg['btnlabel_u_y']='   Ya   ';
			$fform->reg['btnlabel_u_n']='Tidak';
		}
		$s.='</table>';
		*/
		//$fform->dlg('<div style="height:20px">Terima calon siswa berikut sebagai siswa aktif.</div>',$s);
		$fform->fc('Terima calon siswa berikut ini:');
		$fform->fl('Nama','<b>'.$r['nama'].'</b>');
		$fform->fl('No pendaftaran',$r['nopendaftaran']);
		$fform->fc('sebagai siswa aktif pada:');
		$fform->fl('Departemen',departemen_name($r['departemen']));
		$fform->fl('Angkatan',angkatan_name($angkatan));
		$fform->fi('No Induk',iText('nis',$r['nis'],'width:120px'));
		$fform->fi('NISN',iText('nisn',$r['nisn'],$fform->rwidths));
		hiddenval('status',1);
		hiddenval('angkatan',$angkatan);
		//if($cs>1) echo '<tr><td colspan="2"><div class="warnbox">Persyaratan wajib belum dipenuhi. Apakah anda yakin untuk menerima siswa tersebut sebagai siswa aktif?</div></td></tr>';
	} else {
		$fform->dlgw('Pembatalan penerimaan siswa ini juga menghapus data siswa aktif.','Apakah anda yakin untuk membatalkan penerimaan siswa:<br/><b>'.$r['nama'].'</b>?');
		hiddenval('nis',0);
		hiddenval('nisn',0);
		hiddenval('status',0);
		hiddenval('angkatan',0);
	}
	$fform->foot();
} ?>