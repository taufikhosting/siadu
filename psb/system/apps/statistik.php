<?php
$dept=gpost('departemen');
$optcari=gpost('optcari');
$a=0;

$s="";
$t=mysql_query("SELECT * FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE departemen='$dept'");
if(mysql_num_rows($t)>0){
	if($optcari=='agama'){
		$agama=agama_r($a);
		foreach($agama as $k=>$v){
			$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE departemen='$dept' AND agama='$k'";
			$t=mysql_query($sql);
			if($s!="")$s.="~";
			$s.=$v.";".mysql_num_rows($t);
		}
		$s="0~".$s;
	}
	else if($optcari=='kelamin'){
		$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE psb_proses.departemen='$dept' AND psb_calonsiswa.kelamin='L'";
		$t=mysql_query($sql);
		$L=mysql_num_rows($t);
		$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE psb_proses.departemen='$dept' AND psb_calonsiswa.kelamin='P'";
		$t=mysql_query($sql);
		$P=mysql_num_rows($t);
		
		$s="Laki-laki;".$L."~Perempuan;".$P;
		$s="1~".$s;
	}
	else if($optcari=='kelompok'){
		$q=mysql_query("SELECT * FROM psb_kelompok");
		while($h=mysql_fetch_array($q)){
			$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE psb_proses.departemen='$dept' AND psb_calonsiswa.kelompok='".$h['replid']."'";
			$t=mysql_query($sql);
			if($s!="")$s.="~";
			$s.=$h['kelompok'].";".mysql_num_rows($t);
		}
		if($s!="")$s="2~".$s;
	}
	else if($optcari=='periode'){
		$q=mysql_query("SELECT * FROM psb_proses");
		while($h=mysql_fetch_array($q)){
			$sql="SELECT psb_calonsiswa.* FROM psb_calonsiswa LEFT JOIN psb_proses ON psb_calonsiswa.proses=psb_proses.replid WHERE psb_proses.departemen='$dept' AND psb_proses.replid='".$h['replid']."'";
			$t=mysql_query($sql);
			if($s!="")$s.="~";
			$s.=$h['proses'].";".mysql_num_rows($t);
		}
		if($s!="")$s="3~".$s;
	}
}
echo $s;
?>