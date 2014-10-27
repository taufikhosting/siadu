<?php
$target=gpost('t');
$opt=gpost('opt');

if($target=='language'){
	$dbtable="mstr_language";
	if($opt=='a'){
		$name=gpost('v');
		$code=strtolower(substr($name,0,2));
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut,'code'=>$code));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='author'||$target=='author2'){
	$dbtable="mstr_author";
	if($opt=='a'){
		$name=gpost('v');
		$prefix=substr($name,0,3);
		//$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'prefix'=>$prefix));
		$cid=mysql_insert_id();
		$t=dbSel("*","mstr_author","O/ prefix");
		while($r=dbFA($t)){
			echo '<option '.($r['dcid']==$cid?'selected':'').' value="'.$r['dcid'].'">'.$r['name'].'</option>';
		}
	}
}
else if($target=='class'){
	if($opt=='a'){
		$code=gpost('v');
		$name=gpost('v1');
		
		dbInsert("mstr_class",Array('code'=>$code,'name'=>$name));
		echo $code."~";
		$cid=mysql_insert_id();
		$t=dbSel("*","mstr_class","O/ code");
		while($r=dbFA($t)){
			echo '<option '.($r['dcid']==$cid?'selected':'').' value="'.$r['dcid'].'">('.$r['code'].') '.$r['name'].'</option>';
		}
	}
}
else if($target=='publisher'){
	$dbtable="mstr_publisher";
	if($opt=='a'){
		$name=gpost('v');
		//$prefix=strtolower(substr($name,0,3));
		//$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name));
		$cid=mysql_insert_id();
		$t=dbSel("*","mstr_publisher","O/ name");
		while($r=dbFA($t)){
			echo '<option '.($r['dcid']==$cid?'selected':'').' value="'.$r['dcid'].'">'.$r['name'].'</option>';
		}
	}
}
?>