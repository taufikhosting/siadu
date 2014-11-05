<?php
session_start();
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(LIBDIR.'common.php');

$filetoprint=VWDIR.gpost('file').'.php';

if(file_exists($filetoprint)){

header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
header('Content-Type: application/x-msexcel'); // Other browsers  
header('Content-Disposition: attachment; filename=SIADU_PUS_Katalog.xls');
header('Expires: 0');  
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');


require_once(DBFILE);
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');

function callback($buffer)
{
  $buffer=(preg_replace("/<input\s+type=\"hidden\"[^>]+\/>/", "", $buffer));
  return $buffer;
}

ob_start("callback");

/*
$info=gpost('info',strtoupper(gpost('file')));
if($info!=''){
echo '<table style="border-collapse:collapse"><tr><td colspan="2" style="font:bold 11pt Calibri,Arial,Ubuntu">'.$info.'</td></tr>';
//for($i=1;$i<=5;$i++) $infos[$i]=gpost('info'.$i);
echo '</table>';
}
*/

require_once($filetoprint);

ob_end_flush();
} else {
	echo 'Maaf, file tidak tersedia!';
}
?>