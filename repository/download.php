<?php session_start(); require_once('../shared/config.php'); require_once('system/config.php');

$ctype=Array();
$ctype['gif']='image/gif';
$ctype['jpg']='image/jpeg';
$ctype['jpeg']='image/pjpeg';
$ctype['png']='image/png';
$ctype['pdf']='application/pdf';
$ctype['txt']='image/plain';
$ctype['xls']='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
$ctype['xlsx']='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
$ctype['doc']='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
$ctype['docx']='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

$fid=gpost('fid');
if($fid!=''){
$t=mysql_query("SELECT * FROM rep_file WHERE replid='$fid' LIMIT 0,1");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	header('Content-type: '.$ctype[$r['tipe']]);
	header('Content-Disposition: attachment; filename="'.$r['fname'].'"');
	readfile('upload/'.$r['ufile']);
}}
?>