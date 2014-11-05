<?php 
	require_once(MODDIR.'xform/xform.php');
	$opt=gpost('opt'); 
	$cid=gpost('cid'); 
	if($cid=='')
		$cid=0;
	require_once(APPMOD.'psb/kriteria.php');
	require_once(APPMOD.'psb/golongan.php');
	require_once(APPMOD.'psb/disctunai.php');
	require_once(APPMOD.'psb/cicilan.php');

	dbDel("psb_tmp_saudara","sesid='".session_id()."'");

	$fmod       ='pendataan';
	$xform      =new xform($fmod,$opt,$cid);
	
	$pros       =gpost('proses');
	$kel        =gpost('kelompok');
	
	// departemen >>
	$dept       =gpost('departemen');
	$departemen =departemen_r($dept);
	
	// kriteria >>
	$krit       =gpost('kriteria');
	$kriteria   =kriteria_r($krit);
	
	// golongan >>
	$gol        =gpost('golongan');
	$golongan   =golongan_r($gol);
	
	// disctunai >>
	$disc       =gpost('disctunai');
	$discount   =disctunai_r($disc);
	
	// cicilan >>
	$cicil      =gpost('cicilan');
	$cicilan    =cicilan_r($cicil);

	if($opt=='uf'){ $ttl='Edit'; // Nilai field editan
		$t=mysql_query("SELECT * FROM psb_calonsiswa WHERE replid='$cid' LIMIT 0,1");
		$data=mysql_fetch_array($t);
	}
	else { 
		$ttl='Tambah'; // Nilai field default
		$data=Array();
		$data['replid']=0;
		$data['kriteria']=$krit;
		$data['golongan']=$gol;
		$data['proses']=$pros;
		$data['kelompok']=$kel;
		$data['jmlangsur']=$cicil;
		$data['disctb']=0;
		$data['discsaudara']=0;
		$data['disctotal']=0;
		$data['discount']=$disc;
		$data['denda']=0;
		$data['noformulir']='';
		$data['nama']='';
		$data['kelamin']='L';
		$data['tmplahir']='';
		$data['tgllahir']='0000-00-00';
		$data['agama']='';
		$data['alamat']='';
		$data['telpon']='';
		$data['sekolahasal']='';
		$data['darah']='';
		$data['kesehatan']='';
		$data['ketkesehatan']='';
	}

	$xform->title($ttl.' Data Calon Siswa Baru');
	$xform->table_begin();
	$xform->col_begin('50%');
	$xform->group_begin('Kriteria calon',140);
	$xform->fi('Kriteria calon',iSelect('kriteria',$kriteria,$data['kriteria'],'width:200px','pendataan_getSumPokok()'));
	$xform->fi('Glongan',iSelect('golongan',$golongan,$data['golongan'],'width:200px','pendataan_getSumPokok()'));
			
		$xform->group_begin('Sumbangan');
			if($opt=='af'){
				$tq=mysql_query("SELECT * FROM psb_setbiaya WHERE pros='".$data['proses']."' AND kel='".$data['kelompok']."' AND krit='".$data['kriteria']."' AND gol='".$data['golongan']."' LIMIT 0,1");
				if(mysql_num_rows($tq)>0){
					$rq=mysql_fetch_array($tq);
					$biaya=$rq['nilai'];
					$spp=$rq['spp'];
				} else{
					$biaya=0;
					$spp=0;
				}
			} else {
				$biaya=$data['sumpokok'];
				$spp=$data['sppbulan'];
			}
			
			$xform->fi('Uang pangkal',iTextC('sumpokok',$biaya,'width:200px','','onblur="pendataan_countnet()"').'&nbsp;<div id="loader3" class="loader3" style="margin-left:4px;display:none"></div>');
			$xform->fi('Uang pangkal net',iTextC('sumnet',$biaya,'width:200px','','','disabled'));
		
			$xform->group_begin('Angsuran');
			$xform->fi('Lama angsuran',iSelect('jmlangsur',$cicilan,$data['jmlangsur'],'width:200px','pendataan_countnet()'));
			if($opt=='af') 
				$cicilpb=$data['jmlangsur']>0?$biaya/$data['jmlangsur']:0;
			else 
				$cicilpb=$data['angsuran'];
			$xform->fi('Angsuran per bulan',iTextC('angsuran',$cicilpb,'width:200px','','','disabled'));
			
			$xform->group_begin('Uang Sekolah');
			$xform->fi('Uang sekolah per bulan',iTextC('sppbulan',$spp,'width:200px'));
		
			$xform->col_begin('50%');
			$xform->group_begin('Discount');
			$xform->fi('Discount subsidi',iTextC('disctb',$data['disctb'],'width:200px','','onblur="pendataan_countnet()"'));
			$xform->fi('Discount saudara',iTextC('discsaudara',$data['discsaudara'],'width:200px','','onblur="pendataan_countnet()"'));
			//$xform->fi('Discount tunai',iTextC('disctunai',$data['disctunai'],'width:200px','','onblur="pendataan_countnet()"'));
			$xform->fi2('Discount tunai',
						iSelect(
							'disctunai',
							$discount,
							$data['discount'],
							'xwidth:200px',
							'pendataan_countnet()'
						),iTextC('disctunai2',
							$data['disctunai2'],
							'width:120px',
							'',
							'',
							'disabled'
						)
					);
			$xform->fi('Total discount',
							iTextC('disctotal',
									$data['disctotal'],
									'width:200px',
									'',
									'',
									'disabled'
								)
					);
		
			$xform->group_begin('Denda');
			$xform->fi('Denda keterlambatan',iTextC('denda',$data['denda'],'width:200px'));
			
	$xform->table_end(0);

	$xform->table_begin();
		$xform->col_begin('50%');
		$xform->group_begin('Data Pribadi Siswa');
			if($opt=='af'){
			// No Pendaftaran
			$sql="SELECT * FROM psb_calonsiswa WHERE proses='$pros' ORDER BY replid DESC LIMIT 0,1";
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);
			$nom=$row['replid'];
			$sql="SELECT kodeawalan FROM psb_proses WHERE replid='$pros'";
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);
			$kode_no=$row['kodeawalan'];
			$thn_no=substr(date("Y"), 2, 2);
			$nomor=sprintf("%04d",intval($nom) + 1);
			$no=sprintf("%s%02d%04d", $kode_no, $thn_no, $nomor);
			$data['nopendaftaran']=$no;
			}
			//if($opt=='uf'){
			$xform->fi('Nomor pendaftaran',iText('nopendaftaran',$data['nopendaftaran'],$xform->fieldws));
			//}
			//$xform->fi('Nomor Formulir',iText('noformulir',$data['noformulir'],$xform->fieldws));
			$xform->fi('Nama lengkap',iText('nama',$data['nama'],$xform->fieldws));
			$xform->fi('Jenis kelamin',iSelect('kelamin',Array('L'=>'Laki-laki','P'=>'Perempuan'),$data['kelamin']));
			$xform->fi('Tempat lahir',iText('tmplahir',$data['tmplahir'],$xform->fieldws));
			$xform->fi('Tanggal lahir',inputDate('tgllahir',$data['tgllahir']));
			$xform->fi('Agama',iSelect('agama',agama_r(0),$data['agama']));
			$xform->fi('Alamat rumah',iTextarea('alamat',$data['alamat'],$xform->fieldws,3));
			$xform->fi('Nomor telepon',iText('telpon',$data['telpon'],'width:120px'));
			$xform->fi('Sekolah asal',iText('sekolahasal',$data['sekolahasal'],$xform->fieldws));
		
		if($opt=='uf'){
			$t=mysql_query("SELECT * FROM psb_calonsiswa_ayah WHERE calonsiswa='".$data['replid']."'");
			$ayah=mysql_fetch_array($t);
		} else {
			$ayah['nama']='';
			$ayah['warga']='';
			$ayah['tmplahir']='';
			$ayah['tgllahir']='0000-00-00';
			$ayah['pekerjaan']='';
			$ayah['telpon']='';
			$ayah['pinbb']='';
			$ayah['email']='';
		}
		$xform->group_begin('Data Ayah Siswa');
			$xform->fi('Nama Ayah',iText('ayah-nama',$ayah['nama'],$xform->fieldws));
			$xform->fi('Kebangsaan',iText('ayah-warga',$ayah['warga'],$xform->fieldws));
			$xform->fi('Tempat lahir',iText('ayah-tmplahir',$ayah['tmplahir'],$xform->fieldws));
			$xform->fi('Tanggal lahir',inputDate('ayah-tgllahir',$ayah['tgllahir']));
			$xform->fi('Pekerjaan',iText('ayah-pekerjaan',$ayah['pekerjaan'],$xform->fieldws));
			$xform->fi('Nomor telepon',iText('ayah-telpon',$ayah['telpon'],'width:120px'));
			$xform->fi('Pin BB',iText('ayah-pinbb',$ayah['pinbb'],'width:120px'));
			$xform->fi('Email',iText('ayah-email',$ayah['email'],$xform->fieldws));
			
		if($opt=='uf'){
			$t=mysql_query("SELECT * FROM psb_calonsiswa_ibu WHERE calonsiswa='".$data['replid']."'");
			$ibu=mysql_fetch_array($t);
		} else {
			$ibu['nama']='';
			$ibu['warga']='';
			$ibu['tmplahir']='';
			$ibu['tgllahir']='0000-00-00';
			$ibu['pekerjaan']='';
			$ibu['telpon']='';
			$ibu['pinbb']='';
			$ibu['email']='';
		}
		$xform->group_begin('Data Ibu Siswa');
			$xform->fi('Nama Ibu',iText('ibu-nama',$ibu['nama'],$xform->fieldws));
			$xform->fi('Kebangsaan',iText('ibu-warga',$ibu['warga'],$xform->fieldws));
			$xform->fi('Tempat lahir',iText('ibu-tmplahir',$ibu['tmplahir'],$xform->fieldws));
			$xform->fi('Tanggal lahir',inputDate('ibu-tgllahir',$ibu['tgllahir']));
			$xform->fi('Pekerjaan',iText('ibu-pekerjaan',$ibu['pekerjaan'],$xform->fieldws));
			$xform->fi('Nomor telepon',iText('ibu-telpon',$ibu['telpon'],'width:120px'));
			$xform->fi('Pin BB',iText('ibu-pinbb',$ibu['pinbb'],'width:120px'));
			$xform->fi('Email',iText('ibu-email',$ibu['email'],$xform->fieldws));
		
		if($opt=='uf'){
			$t=mysql_query("SELECT * FROM psb_calonsiswa_keluarga WHERE calonsiswa='".$data['replid']."'");
			$keluarga=mysql_fetch_array($t);
		} else {
			$keluarga['tglnikah']='0000-00-00';
			$keluarga['kakek-nama']='';
			$keluarga['nenek-nama']='';
		}
		$xform->group_begin('Data Keluarga &nbsp;(opsional)');
			$xform->fi('Tanggal perkawinan orang tua',inputDate('keluarga-tglnikah',$keluarga['tglnikah']));
			$xform->fi('Nama Kakek',iText('keluarga-kakek-nama',$keluarga['kakek-nama'],$xform->fieldws));
			$xform->fi('Nama Nenek',iText('keluarga-nenek-nama',$keluarga['nenek-nama'],$xform->fieldws));
		
		$xform->col_begin('50%');
		$xform->group_begin('Foto Siswa');
			$xform->fphoto($data['replid']);
			
		$xform->group_begin('Riwayat Kesehatan Siswa',170);
			$xform->fi('Golongan darah',iSelect('darah',goldarah_r(),$data['darah']));
			$xform->fi('Penyakit yang pernah diderita',iTextarea('kesehatan',$data['kesehatan'],$xform->fieldws,5));
			$xform->fi('Catatan kesehatan',iTextarea('ketkesehatan',$data['ketkesehatan'],$xform->fieldws,5));
		
		if($opt=='uf'){
			$t=mysql_query("SELECT * FROM psb_calonsiswa_kontakdarurat WHERE calonsiswa='".$data['replid']."'");
			$darurat=mysql_fetch_array($t);
		} else {
			$darurat['nama']='';
			$darurat['hubungan']='';
			$darurat['telpon']='';
		}
		$xform->group_begin('Kontak Darurat (selain orang tua)');
			$xform->fi('Nama',iText('kontakdarurat-nama',$darurat['nama'],$xform->fieldws));
			$xform->fi('Hubungan',iText('kontakdarurat-hubungan',$darurat['hubungan'],$xform->fieldws));
			$xform->fi('Nomor yang dapat dihubungi',iText('kontakdarurat-telpon',$darurat['telpon'],'width:120px'));
		
		if($opt=='uf'){
			$t=mysql_query("SELECT * FROM psb_calonsiswa_saudara WHERE calonsiswa='".$data['replid']."'");
			$sesid=session_id();
			while($r=mysql_fetch_array($t)){
				mysql_query("INSERT INTO psb_tmp_saudara SET sesid='$sesid',nama='".$r['nama']."',tgllahir='".$r['tgllahir']."',sekolah='".$r['sekolah']."'");
			}
		}
		$xform->grupclass=''; $xform->grupstyle='float:left';
		$xform->group_begin('Data Saudara');
			echo '<div id="data_saudara" style="width:450px;max-height:300px;overflow:auto;margin-bottom:4px">';
			echo '<div style="float:none !important">';
				require_once(APPDIR.'pendataan_saudara_get.php');
			echo '</div>';
			echo '</div>';
			echo '<a class="linkb" href="javascript:void(0)" onclick="pendataan_saudara_form(\'af\')">Tambah data saudara...</a>';
		
		
		
	$xform->table_end();
?>