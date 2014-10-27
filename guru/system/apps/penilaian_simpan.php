<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

// form Module
$fmod='penilaian';
$dbtable='aka_penilaian';
$fform=new fform($fmod,'u',$cid,'penilaian siswa');
$fform->reg['notif_u']='Data <idata> telah disimpan.';

$data=gpost('data');
$t=explode(";",$data);
$n=count($t);
for($i=0;$i<$n;$i++){
	$r=explode(",",$t[$i]);
	$sis=$r[0];
	$pel=$r[1];
	$jen=$r[2];
	$nil=$r[3];
	$sql="SELECT * FROM aka_penilaian WHERE siswa='$sis' AND pelajaran='$pel' AND jenispengujian='$jen'";
	$c=mysql_query($sql);
	if(mysql_num_rows($c)>0){
		$q=mysql_query("UPDATE aka_penilaian SET nilai='$nil' WHERE siswa='$sis' AND pelajaran='$pel' AND jenispengujian='$jen'");
	} else {
		$q=mysql_query("INSERT INTO aka_penilaian SET siswa='$sis' AND pelajaran='$pel' AND jenispengujian='$jen',nilai='$nil'");
	}
}

$fform->notif($q);

?>