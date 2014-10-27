<?php
$q=getsx('q');
if($q=="newcatalog"){    
    $a=Array('title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbInsert("catalog",$inp)){
		$dcid=mysql_insert_id();
		echo "T".$dcid."~Catalog information has been saved.";
	} else {
		echo 'F0~<span style="colo:#ff0000">Failed to save book information.</span>';
	}
} else if($q=="editcatalog"){ 
	$dcid=gpost('dcid');
    $a=Array('title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbUpdate("catalog",$inp,"dcid='$dcid'")){
		echo "T".$dcid."~Catalog information has been saved.";
	} else {
		echo 'F0~<span style="colo:#ff0000">Failed to save book information.</span>';
	}
} else if($q=="addbook"){
	$a=Array('catalog','barcode','nid','callnumber','shelf','source','sourceval');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbInsert("book",$inp)){
		echo "TBook information has been saved.";
	} else {
		echo 'F<span style="colo:#ff0000">Failed to save book information.</span>';
	}
} else if($q=="addbook2"){
	$a=Array('catalog','barcode','nid','callnumber','shelf','source','sourceval');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbInsert("book",$inp)){
		$tbl=dbFetch("ntable","so_history","W/status!=0");
		dbInsert($tbl,Array('catalog'=>$inp['catalog'],'barcode'=>$inp['barcode']));
		echo "TBook information has been saved.";
	} else {
		echo 'F<span style="colo:#ff0000">Failed to save book information.</span>';
	}
} else if($q=="revbook"){
	$dcid=gpost('dcid');
	$a=Array('catalog','barcode','nid','callnumber','shelf','source','sourceval');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbUpdate("book",$inp,"dcid='$dcid'")){
		echo "TBook information has been saved.";
	} else {
		echo 'F<span style="colo:#ff0000">Failed to save book information.</span>';
	}
	
	//header('location:'.RLNK.'bibliographic.php?tab=catalog&act=view&nid='.$inp['catalog']);
}
else if($q=="addsyc"){  
    $a=Array('title','author','author2','publisher','class','classcode','isbn','release','series','language','cover');
	$inp=Array();
	foreach($a as $k=>$v){
		$inp[$v]=gpost($v);
	}
	if(dbInsert("catalog",$inp)){
		$dcid=mysql_insert_id();
		echo "T".$dcid."~Catalog information has been saved.";
	} else {
		echo 'F0~<span style="colo:#ff0000">Failed to save book information.</span>';
	}
} 
else {
	header('location:'.RLNK);
}

?>