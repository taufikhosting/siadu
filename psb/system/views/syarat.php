<?php
$fmod='syarat';
$xtable=new xtable($fmod,'persyaratan calon siswa');
$xtable->btnbar_f('add');
// Query
$sql="SELECT * FROM psb_syarat ORDER BY wajib";
$t=mysql_query($sql); $xtable->ndata=mysql_num_rows($t);

// Page sort and order
//$po=$xtable->pageorder_sql('kriteria','keterangan');
//$t=mysql_query($sql.$po);

if($xtable->ndata>0){
	// Table head
	$xtable->head('Persyaratan','Sifat','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['syarat'],200);
		$xtable->td($r['wajib']=='1'?'Wajib':'Tidak wajib',200);
		$xtable->td($r['keterangan']);
		if($r['replid']!=1&&$r['replid']!=2)	$xtable->opt_ud($r['replid']);
		else $xtable->opt($r['replid'],'u');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>