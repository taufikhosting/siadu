<?php
$opt=gpost('opt');
$dcid=gpost('dcid');

$t=dbSel("*","employee","W/dcid='$dcid' LIMIT 0,1");
$r=dbFA($t);
$mstr_status=MstrGet("mstr_status");

require_once(APPDIR.'pf_summary_data.php');
?>
