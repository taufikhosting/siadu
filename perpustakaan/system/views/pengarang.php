<?php
$fmod='pengarang';
$xtable=new xtable($fmod);
$xtable->btnbar_f('add');

// Query
$sql="SELECT * FROM pus_pengarang";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('nama','nama2'));

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama Pengarang','@Nama bibliografi','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['nama'],200);
		$xtable->td($r['nama2'],200);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>