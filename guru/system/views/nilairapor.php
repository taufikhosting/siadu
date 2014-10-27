<?php appmod_use('aka/guru','aka/siswa','aka/pelajaran'); $gid=guru_SID(); $opt=gpost('opt');
$fmod='nilairapor';
$xtable=new xtable($fmod,'Nilai rapor');
//$xtable->pageorder="aka_penilaian.replid";
//$xtable->tbl_width='800px';
//$xtable->noopt=true;
//$xtable->disabletextselection();

$pel=gpost('pelajaran');
$pelajaran=guru_pelajaran_r($pel);
$kls=gpost('kelas');
$kelas=guru_kelas_r($kls);

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
	
$PSBar->end();

if($PSBar->pass){
	// Query
	
	$db=siswa_db_bykelas($kls);
	$SKM=pelajaran_skm($pel);
	$db->field("aka_komennilai:komen");
	$db->join_cust("aka_komennilai ON aka_komennilai.siswa=aka_siswa.replid AND aka_komennilai.pelajaran='$pel'");
	$t1=dbQSql("SELECT * FROM aka_penilaian WHERE guru='$gid' AND pelajaran='$pel' AND kelas='$kls'");
	$sk=""; $tbobot=0; $sb=""; $rpemb=""; $npemb=""; $tnpemb=""; $absama=1; $lbobot=-1;
	while($r1=dbFA($t1)){
		$db->field("@".$r1['kode']." := IFNULL((SELECT aka_daftarnilai.nilai FROM aka_daftarnilai WHERE aka_daftarnilai.siswa=aka_siswa.replid AND aka_daftarnilai.penilaian='".$r1['replid']."'),0) as T".$r1['kode']);
		
		$db->field($r1['bobot']." as B".$r1['kode']);
		
		//$db->field("@B".$r1['kode']." := ".$r1['bobot']);
		if($lbobot==-1) $lbobot=$r1['bobot'];
		$tbobot+=$r1['bobot'];
		
		if($rpemb!="")$rpemb.=" &#43; ";
		$rpemb.=$r1['kode']." &#215; bobot<sub>".$r1['kode']."</sub>";
		
		if($r1['bobot']>0){
			if($sk!="")$sk.=" + ";
			$sk.="@".$r1['kode'];
			
			if($sb!="")$sb.=" + ";
			$sb.="@".$r1['kode']." * ".$r1['bobot'];
		
			if($tnpemb!="")$tnpemb.=" &#43; ";
			$tnpemb.=$r1['kode'];
			
			if($npemb!="")$npemb.=" &#43; ";
			$npemb.=$r1['kode']." &#215; ".$r1['bobot'];
			
			if($lbobot!=$r1['bobot'])$absama=0;
			$lbobot=$r1['bobot'];
		}
		
	}
	if($absama==1)$npemb=$tnpemb;
	
	$db->field("(".$sk.") as JMLNILAI");
	$db->field("@TN := ((".$sb.")/ ".$tbobot.") as TNILAI");
	$db->field("IF( @TN < ".$SKM.",0,1) as TLULUS");
	//$db->where_and("aka_daftarnilai.penilaian='$peni'");
	//$db->group("aka_siswa.replid");
	$t=$db->query();
	$xtable->ndata_db($t);
	//$t=$db->query($xtable->pageorder_sql("aka_siswa:nis,nama","aka_daftarnilai.nilai","tuntas"),1);

	$xtable->btnbar_begin();
		echo '<div class="sfont" style="float:left;margin-top:4px;margin-right:10px">Standar Ketuntasan Minimum (SKM): <b>'.$SKM.'</b></div>';
	$xtable->btnbar_end();
	
	//echo $xtable->ndata;
	if($xtable->ndata>0){
		// Table head
		$heads=array('@!NIS','@Nama');
		$t1=dbQSql("SELECT * FROM aka_penilaian WHERE guru='$gid' AND pelajaran='$pel' AND kelas='$kls'");
		while($r1=dbFA($t1)){
			array_push($heads,'!'.$r1['kode'].'{C}');
		}
		$heads=array_merge($heads,array('!JML Nilai{C}','Nilai akhir{C}','@Ketuntasan','Keterangan'));
		//array_push($heads,'Keterangan');
		$xtable->head($heads);
	
		while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
			
			$xtable->td($r['nis'],60);
			$xtable->td($r['nama'],250);
			$t1=dbQSql("SELECT * FROM aka_penilaian WHERE guru='$gid' AND pelajaran='$pel' AND kelas='$kls'");
			while($r1=dbFA($t1)){
				//$db->field("IF(aka_daftarnilai.penilaian = '".$r1['replid']."', aka_daftarnilai.nilai, 0) as ".$r1['kode']);
				//$db->join_cust("aka_daftarnilai ON aka_daftarnilai.penilaian='".$r1['replid']."'");
				//array_push($heads,$r1['kode']);
				$nil=$r["T".$r1['kode']];
				if($nil<$SKM) $nil='<span style="color:#ff0000">'.$nil.'</span>';
				$xtable->td($nil,50,'c',$r['B'.$r1['kode']]==0?'style="color:#aaa;background:#eee"':'');
			}
			$xtable->td($r["JMLNILAI"],70,'c');
			$xtable->td(number_format($r["TNILAI"],2),70,'c');
			$xtable->td(($r['TLULUS']==1?'Tuntas ':'<span style="color:#ff0000">Belum tuntas</span>'),80);
			$xtable->td($r['komen'],'','','id="ket_'.$r['replid'].'"');
			
			$s='<button class="btn" title="Edit keterangan" onclick="nilairapor_komen_form(\'uf\','.$r['replid'].')"><div class="bi_editb">&nbsp;</div></button>';
			$xtable->td($s,50,'c');
			
		$xtable->row_end();}$xtable->foot();
		echo '<div style="float:left;width:100%;margin-top:10px">';
		echo '<div style="float:left"><div class="sfont" style="float:left">Nilai akhir diperoleh berdasarkan perhitungan sebagai berikut:</div><br/>',
		'<div style="float:left;margin-right:4px;display:inline-block;border:1px solid #777;padding:5px;padding-right:10px"><table class="xtable_clean" cellspacing="0" cellpadding="4px">',
		'<tr><td rowspan="2">Nilai akhir = </td><td align="center">'.$rpemb.'</td><td rowspan="2" align="center">=</td><td align="center">'.$npemb.'</td></tr>',
		'<tr><td style="border-top:1px solid #444" align="center">Total bobot</td><td style="border-top:1px solid #444" align="center">'.$tbobot.'</td></tr>',
		'</table></div>';
		echo '<button title="Edit bobot penilaian" class="btn" style="float:left;margin-right:4px" onclick="nilairapor_bobot_form(\'uf\',0)"><div class="bi_editb">&nbsp;</div></button>';
		echo '</div></div>';
	}else{$xtable->nodata();}
}
?>