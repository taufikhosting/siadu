<?php
$rekkas=gpost('rekkas');
$jtrans=gpost('jtrans');
$tanggal=gpost('tanggal');
$ct=intval(gpost('ct'));
if($jtrans==JT_INCOME || $jtrans==JT_OUTCOME){
	$t=mysql_query("SELECT * FROM keu_rekening WHERE replid='$rekkas' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	if($r['kategorirek']==1) $kode=$jtrans==JT_INCOME?'BKM':'BKK';
	else if($r['kategorirek']==2) $kode=$jtrans==JT_INCOME?'BBM':'BBK';
} else {
	$kode="MMJ";
}
$tgl=explode("-",$tanggal);
$thn=intval($tgl[0]);
$bln=intval($tgl[1]);
$nomer=$kode."-".sprintf("%04d",$ct)."/".sprintf("%02d",$bln)."/".sprintf("%02d",$thn);
echo $nomer;
?>