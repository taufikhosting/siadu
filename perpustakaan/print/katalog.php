<?php
session_start();
/*
header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
header('Content-Type: application/x-msexcel'); // Other browsers  
header('Content-Disposition: attachment; filename=SIADU_PUS_Katalog.xls');
header('Expires: 0');  
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
*/

// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');

function callback($buffer)
{
  $buffer=(preg_replace("/<input\s+type=\"hidden\"[^>]+\/>/", "", $buffer));
  return $buffer;
}

ob_start("callback");

require_once(VWDIR.'katalog.php');

ob_end_flush();



?>