<?php
$fmod='training';
$xtable=new xtable($fmod);

// Query
$t=mysql_query("SELECT * FROM hrd_training ORDER BY tgl1");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('judul','penyelenggara','tempat','tanggal','pembicara','peserta','jenis training');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['judul'],200);
		$xtable->td($r['penyelenggara'],200);
		$xtable->td($r['tempat'],120);
		$xtable->td(ftgl($r['tgl1']).' s/d '.ftgl($r['tgl2']),200);
		$xtable->td($r['pembicara'],120);
		$xtable->td($r['peserta']);
		$xtable->td(jenistraining_name($r['jenistraining']),100);
		$xtable->opt_ud($r['replid']);
		
	} $xtable->foot();
}else{$xtable->nodata();}
?>