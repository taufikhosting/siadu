<?php
$dept=gets('token');
$pros=gets('proc');

if($dept==$PSB_ADMIN_DEPT||$PSB_ADMIN_DEPT==0){
$t=mysql_query("SELECT * FROM  `departemen` WHERE replid='$dept'");
if(mysql_num_rows($t)>0){
$departemen=mysql_fetch_array($t);

// Queries:
$t=mysql_query("SELECT * FROM psb_kelompok WHERE proses='$pros' ORDER BY kelompok");

// add a page
$pdf->AddPage();
page_header();
require_once('header.php');

$pdf->SetFont(mydeffont, '', 12, '', true);
$pdf->MultiCell($dcPageW, 0, 'DATA KELOMPOK CALON SISWA BARU', 0, 'C', 0, 1, '', '', true);
dc_YDown(3);

if(mysql_num_rows($t)>0){

$pdf->SetFont(mydeffont, '', 8, '', true);

$pdf->MultiCell(30, 0, 'Departemen', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$departemen['departemen'], 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(30, 0, 'Proses Penerimaan', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.dbFetch("proses","psb_proses","W/replid='$pros'"), 0, 'L', 0, 1, '', '', true);

dc_YDown(2);
$thx=Array('No.','Kelompok','Kapasitas','Terisi','Keterangan');
$twx=Array(   11,        40,         20,      20,           0);
$tax=Array(  'C',       'L',        'L',     'C',         'L');

$tx=0;
for($i=0;$i<count($twx);$i++){
	$tx+=$twx[$i];
}
$twx[4]=$dcPageW-$tx;
$pdf->SetFont(mydeffont, '', 8, '', true);
$pdf->setCellPaddings(1, 1, 1, 1);

// Table head
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->SetTextColor(255);
$pdf->SetFillColor(0);
for($i=0;$i<count($thx);$i++){
	$pdf->MultiCell($twx[$i], 0, $thx[$i], 1, $tax[$i], 1, 0, '', '', true);
}
$pdf->Ln();
$pdf->SetTextColor(0);
// End of table head

// Table body formatting
$pdf->SetFont(mydeffont, '', 8, '', true);
$pdf->setCellPaddings(1, 1, 1, 1);

$row=1;

while($r=dbFA($t)){ $i=0;
	if($pdf->GetY()>180) {
		$pdf->AddPage();
		page_header();
		
		// Table head
		$pdf->SetTextColor(255);
		$pdf->SetFillColor(0);
		for($i=0;$i<count($thx);$i++){
			$pdf->MultiCell($twx[$i], 0, $thx[$i], 1, $tax[$i], 1, 0, '', '', true);
		}
		$pdf->Ln();
		$pdf->SetTextColor(0);
		// End of table head
		//dc_YDown(2);
	}
	
	// Row data:	
	$ny=$pdf->GetY();
	$my=0; $i=0;
	$pdf->MultiCell($twx[$i], 0, $row++, 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['kelompok'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['kapasitas'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$q = "SELECT * FROM psb_calonsiswa WHERE kelompok='".$r['replid']."' AND aktif = '1'";
	$res = mysql_query($q);
	$n = mysql_num_rows($res);
	
	$pdf->MultiCell($twx[$i], 0, $n, 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['keterangan'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$tx=$dcMarginL;
	$pdf->Line($tx,$ny,$tx,$ny+$my);
	//$tx=$tw[0]+$dcMarginL;
	for($l=0;$l<$i;$l++){
		$pdf->Line($tx+$twx[$l],$ny,$tx+$twx[$l],$ny+$my);
		$tx+=$twx[$l];
	}
	$pdf->Line($dcMarginL,$ny+$my,$tx,$ny+$my);
	$pdf->Ln();
	$pdf->setY($ny+$my);
}

$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
// reset pointer to the last page
} else {
	$pdf->SetFont(mydeffont, '', 8, '', true);

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->MultiCell($dcPageW, 0, 'Tidak ada data proses penerimaan calon siswa baru.', 0, 'C', 0, 1, '', '', true);
}
$pdf->lastPage();

// ---------------------------------------------------------
$pdf->Output('PSB Kriteria Calon Siswa.pdf', 'I');
} else echo "Dokumen tidak tersedia!";
} else echo "Dokumen tidak tersedia!";
?>