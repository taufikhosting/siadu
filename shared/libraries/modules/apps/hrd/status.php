<?php
function status_opt($s=1){
	$res=Array();
	if($s==1)$res[0]='';
	$sql="SELECT * FROM  hrd_m_status ORDER BY urut";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['status'];
	}
	return $res;
}
?>