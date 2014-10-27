<?php
require_once(MODDIR.'control.php');

$fmod='aktivitas';
$xtable=new xtable($fmod);

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);

// Query
$t=mysql_query("SELECT * FROM sar_aktivitas WHERE lokasi='$lok' ORDER BY tanggal1 DESC,tanggal2 DESC");
$xtable->ndata=mysql_num_rows($t);

$xtable->btnbar_sth();?>
	<td width="80px" align="left"><b>Lokasi:</b></td>
	<td width="120px"><?=iSelect('lokasi',$lokasi,$lok,'',$fmod."_get()")?></td>
	<td align="right">
	<?php $xtable->btnbar_add();?>
	</td>
<?php $xtable->btnbar_stf();
notifbox();

if($xtable->ndata>0){
	// Table head
	$xtable->head('Aktivitas','Tanggal mulai','Tanggal selesai','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td(nl2br($r['aktivitas']),250);
		$xtable->td(fftgl($r['tanggal1']),120);
		$xtable->td(fftgl($r['tanggal2']),120);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>