<?php appmod_use('pus/statistik');

$stat=gpost('statistik');
$statistik=statistik_r($stat);

require_once(VWDIR.'statistik'.$stat.'.php');
?>