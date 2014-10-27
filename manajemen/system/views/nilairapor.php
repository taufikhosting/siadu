<?php appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa','aka/pelajaran'); $opt=gpost('opt');
$fmod='nilairapor';
$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nis=>aka_siswa.nis:EQ','nama=>aka_siswa.nama:LIKE');

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$tajar);
$kls=gpost('kelas');
$kelas=kelas_r($kls,$ting);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tahunajaran_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$ting,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$ting);
		hiddenval('kelas',$kls);
		tingkat_warn(0,'float:left');
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		kelas_warn(0,'float:left');
		$PSBar->pass=false;
	}}
$PSBar->end();

if($PSBar->pass){
	//echo '<span style="color:red">'."SELECT * FROM aka_sks WHERE kelas='$kls' GROUP BY pelajaran".'</span>';
	
	$db=siswa_db_bykelas($kls);
	$t0=dbQSql("SELECT aka_sks.*,aka_pelajaran.kode as kodepel FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran WHERE kelas='$kls' GROUP BY aka_sks.pelajaran ORDER BY aka_pelajaran.nama");
	$db->field("aka_komenrapor:komen");
	$db->join_cust("aka_komenrapor ON aka_komenrapor.siswa=aka_siswa.replid AND aka_komenrapor.tahunajaran=aka_tahunajaran.replid");
	
	$sna=""; $phn=array(); $SSKM=array(); $npeni=0;
	while($r0=dbFA($t0)){
		$pelid=$r0['pelajaran'];
		$pel=$r0['pelajaran']; $gid=$r0['guru'];
		$SKM=pelajaran_skm($pel);
		$SSKM[$pelid]=$SKM;
		
		$db->field($SKM." as SKM_".$pelid);
		
		$t1=dbQSql("SELECT * FROM aka_penilaian WHERE guru='$gid' AND pelajaran='$pel' AND kelas='$kls'");
		//echo '<span style="color:red">'."SELECT * FROM aka_penilaian WHERE guru='$gid' AND pelajaran='$pel' AND kelas='$kls'".'</span>';
		if(dbNRow($t1)>0){
			$phn[$pelid]='@';
			$sk=""; $tbobot=0; $sb="";
			while($r1=dbFA($t1)){
				$db->field("@".$r1['kode']."_".$pelid." := IFNULL((SELECT aka_daftarnilai.nilai FROM aka_daftarnilai WHERE aka_daftarnilai.siswa=aka_siswa.replid AND aka_daftarnilai.penilaian='".$r1['replid']."'),0) as T".$r1['kode']."_".$pelid);
				
				$db->field($r1['bobot']." as B".$r1['kode']."_".$pelid);
				
				$tbobot+=$r1['bobot'];
				
				if($r1['bobot']>0){
					if($sk!="")$sk.=" + ";
					$sk.="@".$r1['kode']."_".$pelid;
					
					if($sb!="")$sb.=" + ";
					$sb.="@".$r1['kode']."_".$pelid." * ".$r1['bobot'];
				}
				
			}
			
			if($sk!="") $db->field("(".$sk.") as JMLNILAI_".$pelid);
			else $db->field("0 as JMLNILAI_".$pelid);
			if($tbobot>0){
				if($sb!="") $db->field("@TN_".$pelid." := ((".$sb.")/ ".$tbobot.") as TNILAI_".$pelid);
				else $db->field("@TN_".$pelid." := 0 as TNILAI_".$pelid);
			} else {
				$db->field("@TN_".$pelid." := 0 as TNILAI_".$pelid);
			}
			$db->field("IF( @TN_".$pelid." < ".$SKM.",0,1) as TLULUS_".$pelid);
			
			if($sna!="")$sna.=" + ";
			$sna.="@TN_".$pelid;
			
			$npeni++;
		} else {
			$phn[$pelid]='';
		}
	}
	
	if($sna!="") $db->field("(".$sna.") as TNRAPOR");
	else $db->field("0 as TNRAPOR");
	if($npeni>0) $db->field("((".$sna.")/".$npeni.") as AVGRAPOR");
	else $db->field("0 as AVGRAPOR");
	
	$db2= clone $db;
	$t=$db->query();
	$xtable->ndata_db($t);
	
	$posql=array('aka_siswa:nis,nama');
	$t0=dbQSql("SELECT aka_sks.*,aka_pelajaran.kode as kodepel FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran WHERE kelas='$kls' GROUP BY aka_sks.pelajaran ORDER BY aka_pelajaran.nama");
	while($r0=dbFA($t0)){
		$pelid=$r0['pelajaran'];
		array_push($posql,'TNILAI_'.$pelid);
	}
	$posql=array_merge($posql,array('TNRAPOR','TNRAPOR','NOT TNRAPOR'));
	$t=$db->query($xtable->pageorder_sql($posql));
	
	
	$db2->order("TNRAPOR DESC");
	$s=$db2->query();
	$rank=array(); $rk=1;
	while($v=dbFA($s)){
		$rank[$v['replid']]=$rk++;
	}
	
	/*
	$xtable->btnbar_begin();
		
		//echo '<button class="btn" style="float:left;margin-right:4px"><div class="bi_pri">Cetak</div></button>';
		//$nlulus=$xtable->ndata==0?0:$nlulus*100/$xtable->ndata;
		//echo '<div class="sfont" style="float:right;margin-top:4px;margin-left:40px">Persentase ketuntasan siswa: <b>'.$nlulus.' %</b></div>';
		echo '<div class="sfont" style="float:left;margin-top:4px;margin-right:10px">Standar Ketuntasan Minimum (SKM): <b>'.$SKM.'</b></div>';
		
	$xtable->btnbar_end();
	*/
	//echo $xtable->ndata;
	if($xtable->ndata>0){
		// Table head
		$heads=array('@!NIS{2}','@Nama{2}');
		$t0=dbQSql("SELECT aka_sks.*,aka_pelajaran.kode as kodepel FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran WHERE kelas='$kls' GROUP BY aka_sks.pelajaran ORDER BY aka_pelajaran.nama");
		while($r0=dbFA($t0)){
			$pelid=$r0['pelajaran'];
			$s=$phn[$pelid].'!'.$r0['kodepel'].'{C}';
			array_push($heads,$s);
		}
		$heads=array_merge($heads,array('@!JML Nilai{C,2}','@Rata-rata{C,2}','@Peringkat{C,2}','Keterangan{2}'));
		//array_push($heads,'Keterangan');
		$xtable->head_addrow($heads);
		$heads2=array();
		$n=count($SSKM);
		foreach($SSKM as $k=>$v){
			array_push($heads2,'!SKM: '.$v.'{C}');
		}
		$xtable->head_addrow($heads2);
		$xtable->head_multi();
	
		while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
			
			$xtable->td($r['nis'],60);
			$xtable->td($r['nama'],200);
			$t0=dbQSql("SELECT aka_sks.*,aka_pelajaran.kode as kodepel FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran WHERE kelas='$kls' GROUP BY aka_sks.pelajaran ORDER BY aka_pelajaran.nama");
			while($r0=dbFA($t0)){
				$pelid=$r0['pelajaran'];
				if(isset($r["TNILAI_".$pelid])){
					$nil=number_format($r["TNILAI_".$pelid],2);
					if($r['TLULUS_'.$pelid]!=1) $nil='<span style="color:#ff0000">'.$nil.'</span>';
				} else $nil='';
				$xtable->td($nil,50,'c');
			}
			$xtable->td(number_format($r["TNRAPOR"],2),70,'c');
			$xtable->td(number_format($r["AVGRAPOR"],2),70,'c');
			$xtable->td($rank[$r['replid']],60,'c');
			$xtable->td(nl2br($r['komen']),'','','id="ket_'.$r['replid'].'"');
			
			$s='';
			$s.='&nbsp;<button class="btn" title="Cetak rapor siswa" onclick="nilairapor_print('.$r['replid'].',\''.$r['nis'].'\')"><div class="bi_prib">&nbsp;</div></button>';
			$s.='&nbsp;<button class="btn" title="Unduh rapor" onclick="nilairapor_download('.$r['replid'].',\''.$r['nis'].'\')"><div class="bi_fdlb">&nbsp;</div></button>';
			$xtable->td($s,90,'c');
			
		$xtable->row_end();}
	
	$xtable->foot();
		
	}else{$xtable->nodata();}
	
} } else { departemen_warn(); }
?>