<?php
function biaya_daftar($p,$l,$k,$g){
	$tq=mysql_query("SELECT daftar FROM psb_setbiaya WHERE pros='$p' AND kel='$l' AND krit='$k' AND gol='$g' LIMIT 0,1");
	if(mysql_num_rows($tq)>0){
		$rq=mysql_fetch_array($tq);
		$daftar=$rq['daftar'];
	} else {
		$daftar=0;
	}
	return $daftar;
}

function biaya_uangpangkal($p,$l,$k,$g){
	$tq=mysql_query("SELECT nilai FROM psb_setbiaya WHERE pros='$p' AND kel='$l' AND krit='$k' AND gol='$g' LIMIT 0,1");
	if(mysql_num_rows($tq)>0){
		$rq=mysql_fetch_array($tq);
		$daftar=$rq['nilai'];
	} else {
		$daftar=0;
	}
	return $daftar;
}

function calonsiswa_syarat($d){
	$t=mysql_query("SELECT * FROM psb_syarat");
	$nsyarat=mysql_num_rows($t);
	$t=mysql_query("SELECT * FROM psb_syarat WHERE wajib='1'");
	$nwajib=mysql_num_rows($t);
	
	$syarat=0;
	$wajib=0;
	$t=mysql_query("SELECT psb_calonsiswa_syarat.*,psb_syarat.wajib FROM psb_calonsiswa_syarat LEFT JOIN psb_syarat ON psb_syarat.replid=psb_calonsiswa_syarat.syarat WHERE psb_calonsiswa_syarat.calonsiswa='$d'");
	while($r=mysql_fetch_array($t)){
		if($r['status']=='1'){
			if($r['wajib']=='1') $wajib++;
			$syarat++;
		}
	}
	
	if($syarat==$nsyarat) return 0;
	else if($wajib>=$nwajib) return 1;
	else return 2;
}
?>