<?php
$transid=gets('token');

$t=mysql_query("SELECT * FROM  `keu_transaksi` WHERE replid='$transid'");
if(mysql_num_rows($t)>0){
// Queries:
$transaksi=mysql_fetch_array($t);

$resolution=array(100,180);
// add a page
$pdf->AddPage('L',$resolution);
page_header();
require_once('header.php');

$JUDUL="";
if($transaksi['jenis']==JT_INCOME) $JUDUL="BUKTI PENERIMAAN KAS";
if($transaksi['jenis']==JT_OUTCOME) $JUDUL="BUKTI PENGELUARAN KAS";

$pdf->SetFont(mydeffont, '', 12, '', true);
$pdf->MultiCell(150, 0, $JUDUL, 0, 'C', 0, 1, '', '', true);
dc_YDown(5);

$pdf->SetFont(mydeffont, '', 8, '', true);

$pdf->MultiCell(30, 0, 'No. Transaksi', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$transaksi['nomer'], 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(30, 0, 'Tanggal', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.fftgl($transaksi['tanggal']), 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(30, 0, 'Diterima dari', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': ', 0, 'L', 0, 1, '', '', true);

dc_YDown(2);

// Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
$pdf->setCellPaddings(1, 1, 1, 1);

$pdf->Cell(20, 0, 'Perkiraan', 1, 0, 'C');
$pdf->Cell(100, 0, 'Uraian', 1, 0, 'C');
$pdf->Cell(30, 0, 'Jumlah', 1, 1, 'C');

$t=mysql_query("SELECT * FROM keu_transaksi WHERE keu_transaksi.ct='".$transaksi['ct']."'"); $total=0;
while($r=mysql_fetch_array($t)){
	$t1=mysql_query("SELECT keu_jurnal.rek,keu_jurnal.debet,keu_jurnal.kredit,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek WHERE keu_jurnal.transaksi='".$r['replid']."' ORDER BY keu_jurnal.replid");

	while($r1=mysql_fetch_array($t1)){
		if($r1['rek']!=1){
			$pdf->Cell(20, 0, $r1['koderek'], 1, 0, 'C');
			$pdf->Cell(100, 0, $r['uraian'], 1, 0, 'L');
			$pdf->Cell(30, 0,fRp($r['nominal']), 1, 1, 'R');
			$total+=$r['nominal'];
		}
	}
}
$pdf->Cell(20, 0, '', 1, 0, 'C');
$pdf->Cell(100, 0, 'Jumlah', 1, 0, 'R');
$pdf->Cell(30, 0, fRp($total), 1, 1, 'R');
$pdf->lastPage();

// ---------------------------------------------------------
$pdf->Output('SIADU - Bukti Transaksi.pdf', 'I');
} else echo "Dokumen tidak tersedia!";
?>