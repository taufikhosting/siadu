<?php
$opt=gpost('opt');
$dcid=gpost('id');
$cid=gpost('cid');
$keterangan=gpost('keterangan');
$tanggal1=gpost('tanggal1');
$tanggal2=gpost('tanggal2');

$cmonth=gpost('cmonth');

$tgl1=explode("-",$tanggal1);
$tgl2=explode("-",$tanggal2);

$stamp1 = strtotime($tanggal1);
$stamp2 = strtotime($tanggal2);

$difstamp = abs($stamp1-$stamp2);
$difday = intval($difstamp/86400);

$jmlhari=$difday+1;
	
$empstatus=MstrGet("mstr_status");

if($opt=='u'){
	$res=dbUpdate("emp_dayoff",Array('note'=>$keterangan, 'date1y'=>$tgl1[0], 'date1m'=>$tgl1[1], 'date1d'=>$tgl1[2], 'date2y'=>$tgl2[0], 'date2m'=>$tgl2[1], 'date2d'=>$tgl2[2], 'date1'=>$tanggal1, 'date2'=>$tanggal2, 'count'=>$jmlhari),"`dcid`='$cid'");
	echo EmpDayoffGroup($tanggal1,$tanggal2)."~";
} else if($opt=='d'){
	$res=dbDel("emp_dayoff","dcid='$cid'");
} else if($opt=='a') {
	$res=dbInsert("emp_dayoff",Array('empid'=>$dcid, 'note'=>$keterangan, 'date1y'=>$tgl1[0], 'date1m'=>$tgl1[1], 'date1d'=>$tgl1[2], 'date2y'=>$tgl2[0], 'date2m'=>$tgl2[1], 'date2d'=>$tgl2[2], 'date1'=>$tanggal1, 'date2'=>$tanggal2, 'count'=>$jmlhari));
	echo EmpDayoffGroup($tanggal1,$tanggal2)."~";
}

$t=mysql_query("SELECT * FROM employee WHERE dcid='$dcid'");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	//$nm=explode(" ",$r['name']); if($r['gender']=='Pria') $r['fname']="Mr. ".$nm[0]; else $r['fname']="Mrs. ".$nm[0];
	require_once(VWDIR.'pf_dayoff.php');
}
?>