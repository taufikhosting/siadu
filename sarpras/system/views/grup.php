<?php
require_once(MODDIR.'control.php');
$fmod='grup';
$xtable=new xtable($fmod,'Grup barang');

$rak=gpost('rak');
$gudang=rak_r($rak);

if(count($gudang)>0){
// Query
$t=mysql_query("SELECT * FROM sar_katalog WHERE rak='$rak' ORDER BY kode");
$xtable->ndata=mysql_num_rows($t);
?>
<table class="stable" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom:5px">
<tr>
	<td width="80px" align="left"><b>Gudang:</b></td>
	<td width="120px"><?=iSelect('rak',$gudang,$rak,"margin-left:10px",$fmod."_get()")?></td>
	<td align="right">
	<?php $xtable->btnbar_add(); /*$xtable->btnbar_print();*/?>
	</td>
</tr>
</table>
<?php $xtable->btnbar_tf('notifbox');
if($xtable->ndata>0){
	// Table head
	$xtable->head('Kode','Nama','Item Barang','Jumlah Barang','Keterangan');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$num_judul = @mysql_num_rows(mysql_query("SELECT * FROM sar_pustaka p, sar_katalog k WHERE k.replid=".$r['replid']." AND k.replid=p.katalog"));
		$num_pustaka = @mysql_fetch_row(mysql_query("SELECT COUNT(d.replid) FROM sar_pustaka p, sar_daftarpustaka d, sar_katalog k WHERE d.pustaka=p.replid AND k.replid=".$r['replid']." AND p.katalog=k.replid"));
	
		$xtable->td($r['kode'],60);
		$xtable->td($r['nama'],200);
		$xtable->td($num_judul,100);
		$xtable->td($num_pustaka[0],100);
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}else rak_warn(1);
?>