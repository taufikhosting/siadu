<?php 
	require_once(MODDIR.'control.php'); 
	require_once(MODDIR.'xtable/xtable.php');
	appmod_use('aka/angkatan','aka/siswa');

	$fmod   = 'siswa_pendataan_kelas_list';
	$xtable = new xtable($fmod,'siswa','',2);
	$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
	$xtable->search_box_pos('l');
	$xtable->pageorder="aka_siswa.nis";
	$xtable->use_select();
	$xtable->select_noopt=true;
	$xtable->select_cekfunc="siswa_pendataan_kelas_list_cek(param)";

	$dept       =gpost('ff_departemen');
	$departemen =departemen_r($dept);
	$angk       =gpost('ff_angkatan');
	$angkatan   =angkatan_r($angk,$dept);
	$kls        =gpost('kelas');
	$PSBar      = new PSBar_2(100);

	// view : combo box (awal) 
	$PSBar->begin();
	if(count($departemen)>0){
		$PSBar->selection('Departemen',iSelect('ff_departemen',$departemen,$depat,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff_departemen',$dept);
		hiddenval('ff_angkatan',$angk);
		departemen_warn(0);
		$PSBar->pass=false;
	}

	if(count($angkatan)>0){
		$PSBar->selection('Angkatan',iSelect('ff_angkatan',$angkatan,$angk,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff_angkatan',$angk);
		angkatan_warn(0);
		$PSBar->pass=false;
	}$PSBar->end();
	
	if($PSBar->pass){
		$xtable->search_box('nis atau nama siswa');
		$db=siswa_db_byangkatan($angk);
		$db->where_and("!( NOT EXISTS (SELECT aka_siswa_kelas.replid FROM aka_siswa_kelas WHERE aka_siswa_kelas.siswa=aka_siswa.replid AND aka_siswa_kelas.kelas='$kls') )");
		$db->where_and($xtable->search_sql_get());
		$t=$db->query();
		// echo '<pre>'.var_dump($db).'</pre>';exit();
		$s='SELECT
				aka_siswa.replid,
				aka_siswa.nis,
				aka_siswa.nama,
				aka_kelas.kelas AS nkelas,
				departemen.nama AS ndepartemen
			FROM
				aka_siswa
			LEFT JOIN aka_siswa_kelas ON aka_siswa_kelas.siswa = aka_siswa.replid
			LEFT JOIN aka_angkatan ON aka_angkatan.replid = aka_siswa.angkatan
			LEFT JOIN aka_kelas ON aka_kelas.replid = aka_siswa_kelas.kelas
			LEFT JOIN aka_tingkat ON aka_tingkat.replid = aka_kelas.tingkat
			LEFT JOIN aka_tahunajaran ON aka_tahunajaran.replid = aka_tingkat.tahunajaran
			LEFT JOIN departemen ON departemen.replid = aka_angkatan.departemen
			WHERE
				aka_siswa.angkatan = '.$angk.'
			AND aka_siswa.aktif = 1';
		// var_dump($s);exit();
		$xtable->ndata=mysql_num_rows($t);
		$t=$db->query($xtable->pageorder_sql('aka_siswa.nis','aka_siswa.nama'));

		if($xtable->ndata>0){
			// echo 'ada data';exit();
			echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
			$xtable->head('@nis','@nama','{44px}');
				$n=0;
			while($r=mysql_fetch_array($t)){
				$xtable->row_begin($r['replid']);
				$xtable->td($r['nis'],100);
				$xtable->td($r['nama']);
				if(admin_isoperator()) 
					$s='<button class="btn" onclick="xtable2_cekall(false);xtable2_sel('.$n.');siswa_pendataan_kelas_siswa_form(\'a\',\'0\',true)"">Pilihx</button>~40px';
				else 
					$s='<div style="height:23px;width:40px"></div>';
				$xtable->opt($r['replid'],$s);
				$n++;
				$xtable->row_end();
			}$xtable->foot();
			echo '</div>';
		} else { 
			// echo 'gak ada data';exit();
			$xtable->nodata_cust(); 
		} 
	}
?>