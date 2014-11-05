<?php
function disctunai_r(&$a){
	$res=Array(); $in=false; $d='';
	$sql="SELECT * FROM  psb_disctunai ORDER BY nilai";
	$t=mysql_query($sql); while($r=mysql_fetch_array($t)){
		$res[$r['nilai']]=$r['nilai'].' %';
		if($d=='')$d=$r['nilai']; if($r['nilai']==$a)$in=true;
	}
	if(!$in)$a=$d;
	return $res;
}
?>