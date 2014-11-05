<?php
$token=explode("-",gets('token'));
$dept=$token[0];
$pros=$token[1];
$kel=$token[2];

if($dept==$PSB_ADMIN_DEPT||$PSB_ADMIN_DEPT==0){
$t=mysql_query("SELECT * FROM  `departemen` WHERE replid='$dept'");
if(mysql_num_rows($t)>0){
$departemen=mysql_fetch_array($t);

// Queries:
$t=mysql_query("SELECT * FROM psb_calonsiswa WHERE proses='$pros' AND kelompok='$kel' ORDER BY nopendaftaran");

// add a page
$pdf->AddPage();
page_header();
require_once('header.php');

$pdf->SetFont(mydeffont, '', 12, '', true);
$pdf->MultiCell($dcPageW, 0, 'DATA CALON SISWA BARU', 0, 'C', 0, 1, '', '', true);
dc_YDown(3);

if(mysql_num_rows($t)>0){

$pdf->SetFont(mydeffont, '', 8, '', true);

$pdf->MultiCell(30, 0, 'Departemen', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$departemen['departemen'], 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(30, 0, 'Proses Penerimaan', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.proses_name($pros), 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(30, 0, 'Kelompok', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.kelompok_name($kel), 0, 'L', 0, 1, '', '', true);

dc_YDown(2);
$thx=Array('No.','No Daftar','Nama','Uang Pangkal','Subsidi','Saudara','Tunai','Denda','Uang Pangkal Net','Angsuran','#1','#2','#3','Status');
$twx=Array(   11,         25,     0,            23,       23,       23,     16,    23,                 23,        23,  10,  10, 10,       15);
$tax=Array(  'C',        'L',   'L',           'C',      'C',      'C',    'C',   'C',                'C',       'C', 'C', 'C','C',      'L');

$tx=0;
for($i=0;$i<count($twx);$i++){
	$tx+=$twx[$i];
}
$twx[2]=$dcPageW-$tx;
$tcx=Array();
$tcx[0]=$dcMarginL;
for($i=1;$i<count($twx);$i++){
	$tcx[$i]=$tcx[$i-1]+($twx[$i-1]);
}
$pdf->SetFont(mydeffont, '', 8, '', true);
$pdf->setCellPaddings(1, 1, 1, 1);

// Table head
$pdf->SetTextColor(255);
$pdf->SetFillColor(80);
$cy=$pdf->GetY();

$pdf->setCellPaddings(1, 4, 1, 1);
$i=0; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
$pdf->setCellPaddings(1, 1, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
      $pdf->MultiCell($twx[$i], 6, 'No Formulir', 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
$pdf->setCellPaddings(1, 4, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
$pdf->setCellPaddings(1, 2, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
$pdf->setCellPaddings(1, 1, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true); $ti=$i;
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
	  $pdf->MultiCell($twx[$ti]+$twx[$ti+1]+$twx[$ti+2], 6, 'Discount', 0, 'C', 1, 0, $tcx[$ti], $cy, true);
$pdf->setCellPaddings(1, 4, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
$pdf->setCellPaddings(1, 2, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
$pdf->setCellPaddings(1, 1, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);
      $pdf->MultiCell($twx[$i], 6, 'x bulan', 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true); $ti=$i;
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
$i++; $pdf->MultiCell($twx[$i], 6, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy+6, true);
	  $pdf->MultiCell($twx[$ti]+$twx[$ti+1]+$twx[$ti+2], 6, 'Nilai Ujian', 0, 'C', 1, 0, $tcx[$ti], $cy, true);
$pdf->setCellPaddings(1, 4, 1, 1);
$i++; $pdf->MultiCell($twx[$i], 12, $thx[$i], 0, $tax[$i], 1, 0, $tcx[$i], $cy, true);

$pdf->Line($dcMarginL,$cy,$dcMarginRX,$cy);
$pdf->Line($dcMarginL,$cy+12,$dcMarginRX,$cy+12);
for($i=0;$i<count($tcx);$i++){
	if($i!=5&&$i!=6&&$i!=11&&$i!=12)
	$pdf->Line($tcx[$i],$cy,$tcx[$i],$cy+12);
	else
	$pdf->Line($tcx[$i],$cy+6,$tcx[$i],$cy+12);
}
$pdf->Line($tcx[1],$cy+6,$tcx[2],$cy+6);
$pdf->Line($tcx[4],$cy+6,$tcx[7],$cy+6);
$pdf->Line($tcx[10],$cy+6,$tcx[13],$cy+6);
$pdf->Line($dcMarginRX,$cy,$dcMarginRX,$cy+12);

$pdf->SetY($cy+12);
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
	
	$pdf->MultiCell($twx[$i], 0, $r['nopendaftaran'].$lnbr.$r['noformulir'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['nama'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, fRp($r['sumpokok']), 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, fRp($r['disctb']), 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, fRp($r['discsaudara']), 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, $r['disctunai'].' %', 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, fRp($r['denda']), 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, fRp($r['sumnet']), 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;

	$pdf->MultiCell($twx[$i], 0, fRp($r['angsuran']).$lnbr.'x '.$r['jmlangsur'].' bulan', 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH(); $i++;
	
	$pdf->MultiCell($twx[$i], 0, $r['ujian1'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['ujian2'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, $r['ujian3'], 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	$pdf->MultiCell($twx[$i], 0, ($r['aktif']=='1'?'Aktif':'Tidak aktif'), 0, $tax[$i++], 0, 0, '', '', true);
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
	$pdf->MultiCell($dcPageW, 0, 'Tidak ada data calon siswa baru.', 0, 'C', 0, 1, '', '', true);
}
$pdf->lastPage();

// ---------------------------------------------------------
$pdf->Output('PSB Kriteria Calon Siswa.pdf', 'I');
} else echo "Dokumen tidak tersedia!";
} else echo "Dokumen tidak tersedia!";
?>