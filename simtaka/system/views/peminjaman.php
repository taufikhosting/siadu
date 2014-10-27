<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$fmod='peminjaman';
$xtable=new xtable($fmod);

$lok=gpost('lokasi');
$lokasi=lokasi_opt($lok);

if(count($lokasi)>0){
if($opt=='af'||$opt=='uf') require_once(VWDIR.'peminjaman_form.php');
else{

// Query
$sql="SELECT sar_peminjaman.*,sar_barang.kode,sar_barang.katalog,sar_katalog.nama FROM sar_peminjaman LEFT JOIN sar_barang ON sar_barang.replid=sar_peminjaman.barang LEFT JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE sar_peminjaman.lokasi='$lok'";
//echo $sql;
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

// Page sort and order
//$po=$xtable->pageorder_sql('peminjam','nama');
//$t=mysql_query($sql.$po);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();

	if(count($lokasi)>0){
		$PSBar->selection('Lokasi',iSelect('lokasi',$lokasi,$lok,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('lokasi',$lok);
		lokasi_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
$PSBar->end();

if($PSBar->pass){
$xtable->btnbar_f('add');
if($xtable->ndata>0){
	// Table head
	$xtable->optw='50px';
	$xtable->head('Peminjam','Barang','Tanggal Peminjaman','Tanggal pengembalian','Tempat Peminjaman','Keterangan');
	while($r=mysql_fetch_array($t)){ $xtable->row_begin();
		
		$xtable->td($r['peminjam'],120);
		$xtable->td('Kode: <b>'.$r['kode'].'</b><br/ >Nama barang: '.$r['nama'],250);
		$xtable->td(fftgl($r['tanggal1']),140);
		$xtable->td(fftgl($r['tanggal2']),140);
		$xtable->td($r['tempat'],200);
		$xtable->td(nl2br($r['keterangan']));
		if($r['status']==1){
		$xtable->opt($r['replid'],'<button class="btn" title="Kembalikan barang ini." onclick="PCBCODE=-1;openPage('.app_page_getindex('pengembalian').',\'pengembalian\',false,\'peminjaman=<id>\')"><div class="bi_inb">&nbsp;</div></button>~30');
		} else {
			$xtable->td('&nbsp');
		}
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}}}else lokasi_warn(); ?>