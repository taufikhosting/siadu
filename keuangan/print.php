<?php
session_start();

// System files
require_once('../shared/config.php');
require_once('system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');

function doc_nofile(){
	echo 'File tidak tersedia.';
}

$filetype=gets('filetype');
$file=gets('file');
$doc=gets('doc');
$doprint=gets('doprint');
$content=$doc!=''?ROTDIR.'print/'.$doc.'.php':VWDIR.$file.'.php';
$docname=gets('docname','SIADU');

if($filetype=='xls'){
define('DOCPAPERWIDTH','1000');
define('FRP_DISABLE',1);
} else {
define('DOCPAPERWIDTH','100%');
}

if($filetype=='xls'){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
	header('Content-Type: application/x-msexcel'); // Other browsers  
	header('Content-Disposition: attachment; filename='.$docname.'.xls');
	header('Expires: 0');  
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}

function callback($buffer)
{
  $buffer=(preg_replace("/<input\s+type=\"hidden\"[^>]+\/>/", "", $buffer));
  $buffer=(str_replace("px", "", $buffer));
  return $buffer;
}

ob_start("callback");

echo '<html><head><title>SIADU - Keuangan</title>';
require_once(SHAREDSTYLE.'print'.($filetype=='xls'?'xls':'').'.php');
echo '</head><body onload="'.($filetype=='xls'?'':($doprint=='0'?'':'print()')).'">';

if(file_exists($content)){
	require_once($content);
} else {
	doc_nofile();
}
echo '</body>';
ob_end_flush();

?>