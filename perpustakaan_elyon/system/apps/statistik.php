<?php
$dept=gpost('departemen');
$optcari=gpost('optcari');
if($optcari=='')$optcari='buku';
$a=0;

$s="";
if($optcari=='buku'){
	$t1=mysql_query("SELECT replid FORM pus_buku");
	while($r1=mysql_fetch_array
	foreach($agama as $k=>$v){
		$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE departemen='$dept' AND agama='$k'";
		$t=mysql_query($sql);
		if($s!="")$s.="~";
		$s.=$v.";".mysql_num_rows($t);
	}
	$s="0~".$s;
}
echo $s;
?>