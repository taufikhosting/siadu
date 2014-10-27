<?php
session_start();

// System files
require_once('../shared/config.php');
require_once('system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');

function callback($buffer)
{
  $buffer=(preg_replace("/<input\s+type=\"hidden\"[^>]+\/>/", "", $buffer));
  $buffer=(str_replace("px", "", $buffer));
  return $buffer;
}

ob_start("callback");

require_once(SHAREDDIR.'print.php');

ob_end_flush();

?>