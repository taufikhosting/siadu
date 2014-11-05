<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$peminjaman=gpost('peminjaman'); if($peminjaman=='')$peminjaman=0;
hiddenval('peminjaman',$peminjaman);

$fmod='pengembalian';
$xtable=new xtable($fmod);

$lok=gpost('lokasi');
$lokasi=lokasi_opt($lok);

if(count($lokasi)>0){
if($opt=='af'||$opt=='uf') require_once(VWDIR.'pengembalian_form.php');
else{

// Query
$sql="SELECT sar_pengembalian.*,sar_peminjaman.peminjam,sar_peminjaman.tempat,sar_peminjaman.tanggal1,sar_peminjaman.tanggal2,sar_peminjaman.barang,sar_barang.kode,sar_barang.katalog,sar_katalog.nama FROM sar_pengembalian LEFT JOIN sar_peminjaman ON sar_peminjaman.replid=sar_pengembalian.peminjaman LEFT JOIN sar_barang ON sar_barang.replid=sar_peminjaman.barang LEFT JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE sar_peminjaman.lokasi='$lok'";
//echo $sql;
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

// Page sort and order
//$po=$xtable->pageorder_sql('peminjam','nama');
//$t=mysql_query($sql.$po);

$xtable->btnbar_sth();?>
	<td width="80px" align="left"><b>Lokasi:</b></td>
	<td width="120px"><?=iSelect('lokasi',$lokasi,$lok,'',$fmod."_get()")?></td>
	<td align="right">
	<?php $xtable->btnbar_add();?>
	</td>
<?php $xtable->btnbar_stf();

notifbox();
$xtable->noopt=true;
if($xtable->ndata>0){
	// Table head
	$xtable->optw='50px';
	$xtable->head('Peminjam','Barang','Tanggal Peminjaman','Jadwal pengembalian','Tanggal dikembalikan','Tempat Peminjaman','Keterangan');
	while($r=mysql_fetch_array($t)){ $xtable->row_begin();
		
		$xtable->td($r['peminjam'],120);
		$xtable->td('Kode: <b>'.$r['kode'].'</b><br/ >Nama barang: '.$r['nama'],250);
		$xtable->td(fftgl($r['tanggal1']),140);
		$xtable->td(fftgl($r['tanggal2']),140);
		$xtable->td(fftgl($r['tanggal']),140);
		$xtable->td($r['tempat'],200);
		$xtable->td(nl2br($r['keterangan']));
		//$xtable->opt($r['replid'],'<button class="btn" title="Kembalikan barang ini." onclick="peminjaman_kembalikan(<id>)"><div class="bi_inb">&nbsp;</div></button>~30');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}}else lokasi_warn(); ?>