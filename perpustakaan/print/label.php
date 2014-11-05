<?php
session_start();
$ssid=session_id();
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2010-11-20
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

 // System files
//session_start();
// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

require_once(LIBDIR.'tcpdf/config/lang/eng.php');
require_once(LIBDIR.'tcpdf/tcpdf.php');
define('mydeffont','dejavusans');

// create new PDF document
$pori=gets('cetak_orientasi');
if($pori=='') $pori=PDF_PAGE_ORIENTATION;
$psize=gets('cetak_ukuran');
if($psize=='') $psize=PDF_PAGE_FORMAT;
$pdf = new TCPDF($pori, PDF_UNIT, $psize, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Elyon School - SIADU');
$pdf->SetTitle('Cetak Barcode');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//Array('F4'=>'F4 &nbsp; 210x330mm','A4'=>'A4 &nbsp; 210x297mm')
$paper=Array();
$sp=$psize.$pori;
$paper['F4P']=Array(210,330);
$paper['F4L']=Array(330,210);
$paper['A4P']=Array(210,297);
$paper['A4L']=Array(297,210);
$paper['A5P']=Array(148,210);
$paper['A5L']=Array(210,148);
/* Page Setup */
$dcMarginT=10;
$dcMarginB=10;
$dcMarginR=10;
$dcMarginL=10;
$dcPaperW=$paper[$sp][0];
$dcPaperH=$paper[$sp][1];
$dcPageW=$dcPaperW-$dcMarginR-$dcMarginL;
$dcPageH=$dcPaperH-$dcMarginT-$dcMarginB;
$dcMarginRX=$dcPaperW-$dcMarginR;

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

/* dc_YDown() */
function dc_YDown($a=0){
	global $pdf;
	$pdf->SetY($pdf->GetY()+$a); // Line break 2mm
	return $pdf->GetY();
}

// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// set font
$pdf->SetFont('dejavusans', '', 11, '', true);

// set cell padding
$pdf->setCellPaddings(0, 0, 0, 0.5); //$left='', $top='', $right='', $bottom='')

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


// START //////////////////////////

// Queries:
//$t=dbSel("*","catalog","W/`dcid`='$dcid' LIMIT 0,1");
//$ndata=mysql_num_rows($t);
//$r=dbFA($t);

// add a page
$pdf->AddPage();

// define barcode style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => false,
	'cellfitalign' => '',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 0,
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 7,
	'stretchtext' => 3
);

$title=gets('cetak_judul');
$desc=gets('cetak_deskripsi');
$plhead=gets('cetak_header');
$plcnum=gets('cetak_callnumber');
$plbcode=gets('cetak_barkode');

$lwidth=floatval(gets('cetak_lebar'))*10;
$lheight=1;
/*
if($plhead=='Y') $lheight+=9;
	if($plcnum=='Y') $lheight+=14;
	if($plbcode=='Y') $lheight+=10;
*/

$q=mysql_query("SELECT * FROM `pus_tpjm` WHERE ssid='$ssid'"); $k=0;
//$pdf->MultiCell(100, 0, mysql_num_rows($q), 'LTRB', 'C', 0, 1, '', '', true);
$kol=0; $row=0; $i=0; $nkol=floor($dcPageW/($lwidth+1)); $nrow=99; //$nrow=floor($dcPageH/$lheight);
while($r=mysql_fetch_array($q)){
	$t01=mysql_query("SELECT pus_buku.replid,pus_buku.idbuku,pus_buku.barkode,pus_katalog.callnumber FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.replid='".$r['buku']."' LIMIT 0,1");
	$b=mysql_fetch_array($t01);
	//$b=dbSFA("*","pus_buku","W/replid='".$r['buku']."'");
	// Print Label >>
	$x=($lwidth+1)*$kol+$dcMarginL; $y=$lheight*$row+$dcMarginT;
	$pdf->SetXY($x,$y); $pl=false;
	if($plhead=='1'){ $pl=true;
	$pdf->setCellPaddings(0, 0.5, 0, 0);
	$pdf->SetFont('dejavusans', '', 10, '', true);
	$pdf->MultiCell($lwidth, 0, $title, 'LTR', 'C', 0, 1, '', '', true);
	if($k==0) $lheight+=$pdf->getLastH();	
	$pdf->SetX($x);
	$pdf->setCellPaddings(0, 0, 0, 0.5);
	$pdf->SetFont('dejavusans', '', 7, '', true);
	$pdf->MultiCell($lwidth, 0, $desc, 'LBR', 'C', 0, 9, '', '', true);
	if($k==0) $lheight+=$pdf->getLastH();	
	}
	if($plcnum=='1'){ $pl=true;
	//dc_YDown(1);
	$pdf->SetX($x);
	$pdf->setCellPaddings(0,0.5,0,0.5);
	$pdf->SetFont('dejavusans', 'B', 10, '', true);
	$cx=str_replace(" ","\n",preg_replace("/\s+/"," ",$b['callnumber']));
	$pdf->MultiCell($lwidth, 0, $cx, 1, 'C', 0, 1, '', '', true);
	//dc_YDown(1);
	if($k==0) $lheight+=$pdf->getLastH();
	}
	if($plbcode=='1'){ $pl=true;
	dc_YDown(1);
	$pdf->SetX($x); $ty1=$pdf->GetY(); 
	$pdf->write1DBarcode($b['barkode'], 'C39', '', '', $lwidth, 9, 0.4, $style, 'N');
	$ty2=$pdf->GetY(); 
	//$pdf->Line($x,$ty1,$x+$lwidth,$ty1);
	//$pdf->Line($x,$ty1,$x,$ty2);
	$pdf->Line($x,$ty2,$x+$lwidth,$ty2);
	//$pdf->Line($x+60,$ty1,$x+60,$ty2);
	if($k==0) $lheight+=10;
	}
	// End of Print label >>
	
	if($pl){
	if($k==0){
		$k=1;
		$nrow=floor($dcPageH/$lheight);
	}
	$kol++; 
	if($kol==$nkol){$kol=0; $row++;}
	if($row==$nrow){
		$kol=0; $row=0;
		$pdf->AddPage();
	}
	}
}

$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('printlabel.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
