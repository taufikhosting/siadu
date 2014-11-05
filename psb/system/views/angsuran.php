<?php
$fmod='angsuran';
$xtable=new xtable($fmod);
$xtable->btnbar_f('add');

// Query
$sql="SELECT * FROM psb_angsuran";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

//echo "gpost('page_number')";
$t=mysql_query($sql.$xtable->pageorder_sql('cicilan','keterangan'));

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Jumlah angusran (bulan)~C','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['cicilan'],200,'c');
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>