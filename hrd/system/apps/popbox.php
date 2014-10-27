<?php
$target=gpost('t');
$opt=gpost('opt');

if($target=='p_train'||$target=='type'){
	$dbtable="mstr_traintype";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr_traintype=MstrGet($dbtable);
		foreach($mstr_traintype as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='marital'){
	$dbtable="mstr_marital";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr_marital=MstrGet($dbtable);
		foreach($mstr_marital as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='religion'){
	$dbtable="mstr_religion";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='status'){
	$dbtable="mstr_status";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='level'){
	$dbtable="mstr_level";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='position'){
	$dbtable="mstr_position";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='division'){
	$dbtable="mstr_division";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='group'){
	$dbtable="mstr_group";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		foreach($mstr as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='docid'){
	$dbtable="mstr_document";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr=MstrGet($dbtable);
		$doctype=$mstr;
		$td=dbSel("*","emp_document");
		while($rd=dbFA($td)){
			unset($doctype[$rd['docid']]);
		}
		foreach($doctype as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
else if($target=='eb_family' || $target=='family'){
	$dbtable="mstr_family";
	if($opt=='a'){
		$name=gpost('v');
		$urut=MstrLastUrut($dbtable)+1;
		dbInsert($dbtable,Array('name'=>$name,'urut'=>$urut));
		$cid=mysql_insert_id();
		$mstr_family=MstrGet($dbtable);
		foreach($mstr_family as $k=>$v){
			echo "<option value=\"$k\"".(($k==$cid)?" selected ":"").">$v</option>";
		}
	}
}
?>