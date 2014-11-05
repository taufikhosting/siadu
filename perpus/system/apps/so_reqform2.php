<?php
$cid=gpost('cid');
$bcode=gpost('barcode');
$_SESSION['formbarcode']=$bcode;
$t=mysql_query("SELECT * FROM catalog WHERE dcid='$cid' LIMIT 0,1");
$r=dbFA($t);
require_once(VWDIR.'p_book_form4.php');

?>