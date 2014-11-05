<?php
/***** Paging *****/
function pageLink($pg="",$sb="",$sm="",$q=""){
	global $page_link;
	$f=0;
	if($pg!="") {
		if($f==0) $lnk.="?page=".$pg;
		else $lnk.="&page=".$pg;
		$f++;
	}
	if($sb!="") {
		if($f==0) $lnk.="?sortby=".$sb;
		else $lnk.="&sortby=".$sb;
		$f++;
	}
	if($sm!="") {
		if($f==0) $lnk.="?mode=".$sm;
		else $lnk.="&mode=".$sm;
		$f++;
	}
	if($q!="") {
		if($f==0) $lnk.="?q=".$q;
		else $lnk.="&q=".$q;
		$f++;
	}
	return $lnk;
}

function pageLinkp($pg="",$sb="",$sm="",$q=""){
	global $page_link;
	$f=1;
	if($pg!="") {
		if($f==0) $lnk.="?page=".$pg;
		else $lnk.="&page=".$pg;
		$f++;
	}
	if($sb!="") {
		if($f==0) $lnk.="?sortby=".$sb;
		else $lnk.="&sortby=".$sb;
		$f++;
	}
	if($sm!="") {
		if($f==0) $lnk.="?mode=".$sm;
		else $lnk.="&mode=".$sm;
		$f++;
	}
	if($q!="") {
		if($f==0) $lnk.="?q=".$q;
		else $lnk.="&q=".$q;
		$f++;
	}
	return $page_link.$lnk;
}
function getCPageLink(){
	$pg=getsx('page'); $sb=getsx('sortby'); $sm=getsx('mode'); $q=getsx('q');
	return pageLink($pg,$sb,$sm,$q);
}
function getCPageLinkp(){
	$pg=getsx('page'); $sb=getsx('sortby'); $sm=getsx('mode'); $q=getsx('q');
	return pageLinkp($pg,$sb,$sm,$q);
}

require_once(SYDIR.'pagelink.php');

?>