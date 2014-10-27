<?php
session_start();

header("Content-type: image/jpg");

// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');

$id=gets('id');
$d=explode('-',$id);
$mid=intval($d[0]);
$mtipe=$d[1];

$photo='';
if($mtipe==1){
	$t=mysql_query("SELECT photo FROM aka_siswa WHERE replid='$mid'");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		if(strlen($r['photo'])>0) $photo=$r['photo'];
	}
}
else if($mtipe==2){
	$t=mysql_query("SELECT photo FROM hrd_pegawai WHERE replid='$mid'");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		if(strlen($r['photo'])>0) $photo=$r['photo'];
	}
}
if($photo!=''){
	echo base64_decode(chunk_split($photo));
} else {
	echo file_get_contents('nophoto.jpg');
}

?>