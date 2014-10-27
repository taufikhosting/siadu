<?php
$bcode=gpost('bcode');
$ntable=gpost('lst');
$p=true;
if($bcode!=''){
	//$p&=dbUpdate($ntable,Array('cek'=>'Y'),"barcode='".$bcode."'");
	$p&=dbInsert($ntable."new",Array('barcode'=>$bcode));
	if($p) echo "1";
	else echo "0";
} else echo "0";
?>