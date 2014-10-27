<?php
function rapor_pelajaran_nilai($pel,$kls,$siswa){
	$nilai=0; $bobot=0;
	$t1=dbSel("*","aka_penilaian","W/pelajaran='$pel' AND kelas='$kls'");
	while($r1=dbFA($t1)){
		$t2=dbSel("nilai","aka_daftarnilai","W/siswa='$siswa' AND penilaian='".$r1['replid']."'");
		//echo $_SESSION['libdb_dbQsql'];
		while($r2=dbFA($t2)){
			$nilai+=$r2['nilai']*$r1['bobot'];
		}
		$bobot+=$r1['bobot'];
	}
	if($bobot>0){
		$nilai=$nilai/$bobot;
	} else {
		$nilai=0;
	}
	return $nilai;
}
function rapor_peringkatkelas_siswa($kls,$siswa){
	$db=siswa_db_bykelas($kls);
	
	$db->field("aka_komenrapor:komen");
	$db->join_cust("aka_komenrapor ON aka_komenrapor.siswa=aka_siswa.replid AND aka_komenrapor.tahunajaran=aka_tahunajaran.replid");
	
	$sna=""; $phn=array(); $SSKM=array(); $npeni=0;
	$t0=dbQSql("SELECT * FROM aka_sks WHERE kelas='$kls' GROUP BY pelajaran");
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
	
	$db->order("TNRAPOR DESC");
	$s=$db->query();
	$rank=array(); $rk=1;
	while($v=dbFA($s)){
		$rank[$v['replid']]=$rk++;
	}
	
	return $rank[$siswa];
}
?>