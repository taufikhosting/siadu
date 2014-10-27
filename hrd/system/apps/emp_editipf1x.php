<?php
$dcid=gpost('id');
$nip=gpost('nip');
$empbagian=gpost('empbagian');
$staff=gpost('staff');
$golongan=gpost('golongan');

$res=dbUpdate("employment_app",Array('nip'=>$nip,'nip'=>$nip,'empbagian'=>$empbagian,'staff'=>$staff,'golongan'=>$golongan),"dcid='$dcid'");

if($res && $golongan=="Lokal") echo "0~";
else echo "1~";
if($res && $empbagian=="Akademik") echo "0~";
else echo "1~";

$t=mysql_query("SELECT * FROM jbssdm.employment_app WHERE dcid='$dcid'");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	$nm=explode(" ",$r['name']); if($r['gender']=='Pria') $r['fname']="Mr. ".$nm[0]; else $r['fname']="Mrs. ".$nm[0];
	require_once('apps/ipf1.php');
}
?>
