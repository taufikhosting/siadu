<?php require_once(APPMOD.'aka/angkatan.php');
$fmod='periode';
$xtable=new xtable($fmod,'Periode penerimaan');

$dept=gpost('departemen');
$departemen=departemen_r($dept);

if(count($departemen)>0){
// Query
$t=mysql_query("SELECT * FROM psb_proses WHERE departemen='$dept'");
$xtable->ndata=mysql_num_rows($t);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
	// Option buttons
$PSBar->end();

$xtable->btnbar_f('add','print','help');

if($xtable->ndata>0){
	// Table head
	$xtable->head('Periode penerimaan{200px}','Kode Awalan{120px}','Angkatan{120px}','Kapasitas{C,100px}','Calon Siswa{C,100px}','Siswa Diterima{C,100px}','status{C,80px}','keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE proses = '".$r['replid']."'");
		$n = mysql_num_rows($q);
		$q = mysql_query("SELECT replid FROM psb_calonsiswa WHERE proses = '".$r['replid']."' AND status<>0");
		$n1 = mysql_num_rows($q);
		
		//if(diffDay($r['tglselesai'])<0) $s='<br/><span style="color:#ff9000">(lewat dari tgl penutupan)</span>';
		//else $s='';
	
		$xtable->td($r['proses'],200);
		$xtable->td($r['kodeawalan'],120);
		$xtable->td(angkatan_name($r['angkatan']),120);
		$xtable->td($r['kapasitas'],100,'c');
		$xtable->td($n,100,'c');
		$xtable->td($n1,100,'c');
		$xtable->td(($r['aktif']=='1'?'<span style="color:#00A000"><b>Dibuka</b></span>':'Ditutup'),80,'c');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}else departemen_warn(1);
?>