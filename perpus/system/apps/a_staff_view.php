<?php
$opt=gpost('opt');
if($opt=='lookup'){
	require_once(VWDIR.'vi_loan.php');
}
if($opt=='lookup'){
	require_once(VWDIR.'vi_loan.php');
}
else if($opt=='aq'){
	$cid=gpost('cid');
	dbInsert("p_loan",Array('book'=>$cid));
	require_once(VWDIR.'vi_loan_list.php');
}
else if($opt=='rq'){
	$cid=gpost('cid');
	dbDel("p_loan","dcid='$cid'");
	require_once(VWDIR.'vi_loan_list.php');
}
else if($opt=='uq'){
	require_once(VWDIR.'vi_loan_list.php');
}
else if($opt=='cq'){
	$sql="TRUNCATE TABLE  `p_loan`";
	mysql_query($sql);
	require_once(VWDIR.'vi_loan_list.php');
}
?>