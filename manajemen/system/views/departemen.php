<?php
$fmod='departemen';
$xtable=new xtable($fmod);

// Query
$t=$xtable->use_db(new xdb("departemen"),$xtable->pageorder_sql('nama','alamat','telepon'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama Departemen','@Alamat','@Telepon');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$xtable->td($r['nama'],200);
		$xtable->td(nl2br($r['alamat']));
		$xtable->td($r['telepon'],150);
		
		/*
		$q=mysql_query("SELECT LENGTH(photo) AS psize FROM departemen WHERE replid='".$r['replid']."'");
		$h=mysql_fetch_array($q);
		if($h['psize']>0){
			$p='<img src="photo/$.php?id='.$r['replid'].'" width="100px"/>';
		}else{
			$p='';
		}
		*/
		
		//$xtable->td('',150,'c');
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>