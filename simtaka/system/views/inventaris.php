<?php
require_once(MODDIR.'control.php');

$fmod='inventaris';
$xtable=new xtable($fmod,'Grup barang');

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);
if(count($lokasi)>0){

// Query
$sql="SELECT * FROM sar_grup WHERE lokasi='$lok'";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

// Page sort and order
$po=$xtable->pageorder_sql('kode','nama');
$t=mysql_query($sql.$po);

$xtable->btnbar_sth();?>
	<td width="80px" align="left"><b>Lokasi:</b></td>
	<td width="120px"><?=iSelect('lokasi',$lokasi,$lok,'',$fmod."_get()")?></td>
	<td align="right">
	<?php $xtable->btnbar_add();?>
	</td>
<?php $xtable->btnbar_stf();

notifbox();
?>
<div class="tbltopmbar" style="float:left;margin-top:10px">
<table class="stable" cellspacing="0" cellpadding="0" width="100%">
	<tr height="24px"><td width="100px">Total aset:</td><td><?=fRp(lokasi_aset($lok))?></td></tr>
</table>
</div>
<?php
if($xtable->ndata>0){
	// Table head
	$xtable->head('@kode','@nama Grup barang','Jumlah unit~C','Unit tersedia~C','Unit dipinjam~C','Total aset~R','Keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_click($r['replid'],'v',$r['nama']); $xtable->row_begin();
		
		$n=mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE grup='".$r['replid']."'"));
		
		$xtable->td($r['kode'],100);
		$xtable->td($r['nama'],200);
		$xtable->td($n,100,'c');
		$xtable->td(0,100,'c');
		$xtable->td(0,100,'c');
		$xtable->td(fRp(grup_aset($r['replid'])),120,'r');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt($r['replid'],'v','u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}else lokasi_warn();?>