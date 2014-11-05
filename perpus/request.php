<?php
session_start();

// System files
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$req=gpost('req');
$q=gets('q');

if($req=='donecekbook'){
	$cid=gpost('cid');
	//echo $cid;
	dbUpdate("so_history",Array('status'=>2),"dcid='$cid'");
	header('location:'.RLNK.'stockopname.php?tab=note');
}
else if($req=='gosyncbook'){
	$cid=gpost('cid');
	//echo $cid;
	dbUpdate("so_history",Array('status'=>3),"dcid='$cid'");
	header('location:'.RLNK.'stockopname.php?tab=init');
}
else if($req=='donenote'){
	$cid=gpost('cid');
	//echo $cid;
	dbUpdate("so_history",Array('status'=>3,'date2'=>date('Y-m-d')),"dcid='$cid'");
	header('location:'.RLNK.'stockopname.php?tab=sum');
}
else if($req=='findmember'){
	$keyw=trim(gpost('keyw'));
	$act=gpost('act');
	$act=$act==''?'loan':'return';
	if(preg_match("/^[a-zA-z ]+$/",$keyw)){
		$sql="SELECT * FROM ".DB_HRD." WHERE name LIKE '$keyw %' OR name LIKE '% $keyw' OR name LIKE '% $keyw %' OR name='$keyw' ORDER BY name";
		$q=mysql_query($sql);
		$n=mysql_num_rows($q);
		if($n==1){
			$r=mysql_fetch_array($q);
			header('location:'.RLNK.'circulation.php?tab='.$act.'&act='.$act.'&nid='.$r['nip']);
		} else {
			header('location:'.RLNK.'circulation.php?tab='.$act.'&act=findmember&k='.$keyw);
		}
	}
	else {
		header('location:'.RLNK.'circulation.php?tab='.$act);
	}
}
else if($q=="newcatalog"){    
    $a=Array('title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	dbInsert("catalog",$inp);
	$dcid=mysql_insert_id();
	
	header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$dcid);
} else if($q=="editcatalog"){    
	$dcid=gpost('dcid');
    $a=Array('title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	dbUpdate("catalog",$inp,"dcid='$dcid'");
	
	header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$dcid);
} else if($q=="addbook"){
	$a=Array('catalog','barcode','nid','cla','aut','tit','callnumber','shelf','source');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	$inp['sourceval']=gpost('source'.$inp['source']);
	dbInsert("book",$inp);
	
	header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$inp['catalog']);
} else if($q=="revbook"){
	$dcid=gpost('dcid');
	$a=Array('catalog','barcode','nid','cla','aut','tit','callnumber','shelf','source');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	$inp['sourceval']=gpost('source'.$inp['source']);
	dbUpdate("book",$inp,"dcid='$dcid'");
	
	header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$inp['catalog']);
}
else if($req=='loan'){
	$n=intval(gpost('xnrow'));
	$member=intval(gpost('member'));
	$date2=gpost('date2');
	for($i=1;$i<$n;$i++){
		$cid=gpost('sbook'.$i);
		if($cid!=''){
			if(dbInsert("loan",Array('member'=>$member,'book'=>$cid,'date1'=>date("Y-m-d"),'date2'=>$date2))){
				dbUpdate("book",Array('available'=>'N'),"dcid='$cid'");
			}
		}
	}
	header('location:'.RLNK.'members.php?tab=staff&act=view&nid='.$member);
}
else {
	header('location:'.RLNK);
}

?>