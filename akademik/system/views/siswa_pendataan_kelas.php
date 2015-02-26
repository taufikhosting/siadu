<?php 
	appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');
	$opt        =gpost('opt'); 
	$cid        =gpost('cid',0);
	$fmod       ='siswa_pendataan_kelas';
	$dept       =gpost('departemen');
	$departemen =departemen_r($dept);

	if(count($departemen)>0){
		$tajar       =gpost('tahunajaran');
		$tahunajaran =tahunajaran_r($tajar,$dept);
		$ting        =gpost('tingkat');
		$tingkat     =tingkat_r($ting,$tajar);
		$kls         =gpost('kelas');
		$kelas       =kelas_r($kls,$ting,1);

		$PSBar = new PSBar_2();
		$PSBar->begin();

		/*filtering combo*/ 
		$PSBar->selection_departemen($fmod,$dept); // departemen

		// tahun ajaran  
		if(count($tahunajaran)>0){ // jika ada 
			$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
		} else { //jika kosong
			$PSBar->end();
			hiddenval('tahunajaran',$tajar);
			hiddenval('tingkat',$ting);
			hiddenval('kelas',$kls);
			tahunajaran_warn(0,'float:left');
			$PSBar->pass=false;
		}
		
		// tingkat 
		if($PSBar->pass){ //default = true
			if(count($tingkat)>0){
				$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
			} else {
				$PSBar->end();
				hiddenval('tingkat',$ting);
				hiddenval('kelas',$kls);
				tingkat_warn(0,'float:left');
				$PSBar->pass=false;
			}
		}
		
		// kelas
		if($PSBar->pass){
			if(count($kelas)>0){
				$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
			} else {
				$PSBar->end();
				hiddenval('kelas',$kls);
				kelas_warn(0,'float:left');
				$PSBar->pass=false;
			}
		}$PSBar->end();
		
		// view 
		if($PSBar->pass){
			if($opt=='af'||$opt=='uf') //form :: add n edit 
				require_once(VWDIR.'siswa_form.php');
			else{ // tabel :: view
				$xtable=new xtable($fmod,'siswa');
				$xtable->search_keyon('nis=>aka_siswa.nis:EQ','nama=>aka_siswa.nama:LIKE');
				$xtable->docname="Data Siswa Kelas ".kelas_name($kls)." T.A. ".tahunajaran_name($tajar);
				$xtable->printparams=array('kelas'=>kelas_name($kls),'tahunajaran'=>tahunajaran_name($tajar));
				$db=siswa_db_bykelas($kls,$ting,"nisn,tmplahir,tgllahir");
				$db->where_and($xtable->search_sql_get());
				$t=$xtable->use_db($db,$xtable->pageorder_sql('nis','nisn','nama'));
				$xtable->btnbar_f('add','print','srcbox');
				
				if($xtable->ndata>0){
					$xtable->head('@!NIS','@!NISN','@nama','Tempat Tanggal lahir');
					while($r=mysql_fetch_array($t)){$xtable->row_begin();
						$xtable->td($r['nis'],80);
						$xtable->td($r['nisn'],200);
						$xtable->td($r['nama']);
						$xtable->td($r['tmplahir'].', '.fftgl($r['tgllahir']),100);
						$s='<button class="btn" title="Keluarkan siswa dari kelas ini." onclick="siswa_pendataan_kelas_form(\'df\',\''.$r['replid'].'\')"><div class="bi_canb">&nbsp;</div></button>';
						$xtable->opt($r['replid'],'v',$s);
						$xtable->row_end();
					}$xtable->foot();
				}else{
					$xtable->nodata();}
				}
			}
		} else { 
			departemen_warn(); 
		}
?>