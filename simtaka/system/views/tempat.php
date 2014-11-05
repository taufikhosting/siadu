<?php
require_once(MODDIR.'control.php');

$fmod='tempat';
$xtable=new xtable($fmod);

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);
if(count($lokasi)>0){

// Query
$t=mysql_query("SELECT * FROM sar_tempat WHERE lokasi='$lok' ORDER BY nama");
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
	$xtable->head('Nama Tempat','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nama'],250);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
} else lokasi_warn();
?>