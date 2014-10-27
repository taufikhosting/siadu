<?php
require_once(MODDIR.'xtable/xtable.php');
require_once(MODDIR.'control.php');
$fmod='peminjaman_tabelpinjam';
$xtable = new xtable($fmod);
$xtable->noopt=true;

// Query
$sql="SELECT sar_dftp.*,sar_barang.kode,sar_barang.kondisi,sar_katalog.nama FROM sar_dftp LEFT JOIN sar_katalog ON sar_katalog.replid=sar_dftp.katalog JOIN sar_barang ON sar_barang.replid=sar_dftp.barang";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);

echo '<div style="float:none !important">';
if($xtable->ndata>0){
	// Table head
	$xtable->head('','Kode','Nama Barang','Kondisi');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td('<button class="btn" onclick="peminjaman_baliktabelpinjam('.$r['barang'].')" title="Hapus dari daftar barang yang dipinjam."><div class="bi_canb">&nbsp</div></button>',30,'c');
		$xtable->td($r['kode'],80);
		$xtable->td($r['nama']);
		$xtable->td(kondisi_name($r['kondisi']),80);
		
	$xtable->row_end();}$xtable->foot();
}else{
	$xtable->nodata_cust('<span style="color:'.CLGREY.'"><i>Belum ada barang yang dipilih.</i></span>');
}
echo '</div>';
?>