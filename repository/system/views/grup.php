<?php
$fmod='grup';
$xtable=new xtable($fmod);

// Query
$t=mysql_query("SELECT * FROM admin WHERE app='".APID."' AND level='2' ORDER BY uname");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('User ID','Nama','Terakhir login');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['uname'],200);
		$xtable->td($r['nama']);
		$xtable->td(fftgljam($r['tlogin']),150);
		$xtable->opt_ud($r['replid']);
		
	} $xtable->foot();
}else{$xtable->nodata();}
exit(); ?>