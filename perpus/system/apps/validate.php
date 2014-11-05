<?php
$t=gpost('t');
$v=gpost('v');
$cid=gpost('cid');
if($t=='barcode'){
	$t=mysql_query("SELECT dcid FROM book WHERE barcode='$v' AND dcid!='$cid'");
	if(mysql_num_rows($t)>0){
		$r=mysql_fetch_array($t);
		echo 'That barcode has been used by another <a class="linkb" href="javascript:viewbookinfo(\''.$r['dcid'].'\',\'Book that using barcode '.$v.'\')">book</a>.';
	}
}
?>