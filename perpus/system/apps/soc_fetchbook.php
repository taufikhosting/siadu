<?php
$tbl=gpost('lst');
$n=gpost('cn');
$ns=gpost('tn');
//$n=mysql_num_rows(mysql_query("SELECT * FROM `".$tbl."`"));
//$ns=mysql_num_rows(mysql_query("SELECT * FROM `book`"));
//echo intval(100*$n/$ns);
if($n<$ns){
	$r=mysql_fetch_array(mysql_query("SELECT * FROM `book` ORDER BY dcid LIMIT $n,1"));
	dbInsert($tbl,Array('catalog'=>$r['catalog'],'barcode'=>$r['barcode']));
	echo mysql_insert_id();
}
?>