<?php appmod_use('aka/guru','aka/tingkat','aka/siswa'); $gid=guru_SID(); $opt=gpost('opt');
$fmod='daftarnilai';
$xtable=new xtable($fmod,'penilaian');
//$xtable->pageorder="aka_penilaian.replid";
$xtable->tbl_width='800px';
$xtable->noopt=true;
$xtable->disabletextselection();

$pel=gpost('pelajaran');
$pelajaran=guru_pelajaran_r($pel);
$kls=gpost('kelas');
$kelas=guru_kelas_r($kls);
$peni=gpost('penilaian');
$penilaian=guru_penilaian_r($peni,$pel,$kls);

$t=mysql_query("SELECT * FROM aka_penilaian WHERE replid='$peni' LIMIT 0,1");
$dpeni=mysql_fetch_array($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	
	if(count($pelajaran)>0){
		$PSBar->selection('Pelajaran',iSelect('pelajaran',$pelajaran,$pel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('pelajaran',$pel);
		hiddenval('kelas',$kel);
		hiddenval('penilaian',$peni);
		echo '<div class="warnbox" style="float:left">Tidak ada pelajaran yang diajar.</div>';
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		hiddenval('penilaian',$peni);
		echo '<div class="warnbox" style="float:left">Tidak ada kelas yang diajar.</div>';
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($penilaian)>0){
		$PSBar->selection('Penilaian',iSelect('penilaian',$penilaian,$peni,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('penilaian',$peni);
		echo '<div class="warnbox" style="float:left">Tidak ada data penilaian.</div>';
		$PSBar->pass=false;
	}}
	
$PSBar->end();

if($PSBar->pass){
	// Query
	$t=siswa_db_bykelas($kls)->go();
	while($r=dbFA($t)){
		if(dbSRow("aka_daftarnilai","W/penilaian='$peni' AND siswa='".$r['replid']."'")==0){
			dbInsert("aka_daftarnilai",array('penilaian'=>$peni,'siswa'=>$r['replid']));
		}
	}
	$db=new xdb("aka_daftarnilai","*","penilaian='$peni'"); $nlulus=0;
	$t=$db->go();
	while($r=dbFA($t)){
		if($r['nilai']>=$dpeni['kkm'])$nlulus++;
	}
	$db=siswa_db_bykelas($kls);
	$db->field("aka_daftarnilai:nilai,keterangan as ketnilai","IF(aka_daftarnilai.nilai < ".$dpeni['kkm'].", 1, 0) as tuntas");
	$db->join("siswa","aka_daftarnilai","siswa");
	$db->where_and("aka_daftarnilai.penilaian='$peni'");
	$t=$db->query();
	$xtable->ndata_db($t);
	$t=$db->query($xtable->pageorder_sql("aka_siswa:nis,nama","aka_daftarnilai.nilai","tuntas"));

	echo '<div style="width:100%;float:left">';
	$xtable->btnbar_begin();
		echo '<button class="btn" style="float:left;margin-right:4px" onclick="daftarnilai_form(\'uf\',0)"><div class="bi_edit">Edit nilai</div></button>';
		//echo '<button class="btn" style="float:left;margin-right:4px"><div class="bi_pri">Cetak</div></button>';
		$nlulus=$xtable->ndata==0?0:$nlulus*100/$xtable->ndata;
		echo '<div class="sfont" style="float:right;margin-top:4px;margin-left:40px">Persentase ketuntasan siswa: <b>'.$nlulus.' %</b></div>';
		echo '<div class="sfont" style="float:right;margin-top:4px;margin-left:10px">SKM: <b>'.$dpeni['kkm'].'</b></div>';
		
	$xtable->btnbar_end();
	echo '</div>';
	
	//echo $xtable->ndata;
	if($xtable->ndata>0){
		// Table head
		$xtable->head('@!NIS','@Nama','@Nilai{C}','@Ketuntasan','Keterangan');
	
		while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
			
			$xtable->td($r['nis'],60);
			$xtable->td($r['nama'],250);
			$xtable->td($r['nilai'],80,'c');
			$xtable->td(($r['tuntas']!=1?'Tuntas ':'Belum tuntas '),80);
			$xtable->td($r['keterangan']);
			
		$xtable->row_end();}$xtable->foot();
		
	}else{$xtable->nodata();}
}
?>