<?php
session_start();

header("Content-type: image/jpg");

// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');

$id=gets('id');

/*<img src="photo/$.php?id=<?=$r['replid']?>" width="140px"/>*/
$t=mysql_query("SELECT photo FROM psb_calonsiswa WHERE replid='$id'");
// $t=mysql_query("SELECT photo2 FROM psb_calonsiswa WHERE replid='$id'");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	//echo $r['photo'];
	if(strlen($r['photo'])>0)
	// if(strlen($r['photo2'])>0){
		// echo base64_decode(chunk_split($r['photo2']));
		echo base64_decode(chunk_split($r['photo']));
	}else{ 
		echo file_get_contents('nophoto.jpg');
	}//echo base64_decode($r['photo']);
} else {
	echo file_get_contents('nophoto.jpg');
}

?>