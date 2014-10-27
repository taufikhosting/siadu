<?php
session_start();
// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

require_once(LIBDIR.'tcpdf/config/lang/eng.php');
require_once(LIBDIR.'tcpdf/tcpdf.php');
define('mydeffont','dejavusans');
function page_header(){
	global $pdf,$dcMarginL,$dcMarginT,$dcMarginRX,$dcMarginBY;
	$pdf->SetXY($dcMarginL,5);
	$pdf->SetFont(mydeffont, '', 7, '', true);
	//$pdf->MultiCell(0, 0, fftgl(date("Y-m-d"))." ".date("H:i:s"), 0, 'R', 0, 0, '', '', true);
	$pdf->SetXY($dcMarginL,$dcMarginT);
}

// create new PDF document
$psize=gets('psize','A4');
$pori=gets('pori','P');

$sp=$psize;
if($pori=='L'){
if($sp=='F4')$sp='4F';
if($sp=='A4')$sp='4A';
}

$paper=Array();
$paper['F4']=Array(210,330);
$paper['4F']=Array(330,210);
$paper['A4']=Array(210,297);
$paper['4A']=Array(297,210);
$pdf = new TCPDF($pori, PDF_UNIT, $psize, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('(c) JohanKharisma');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetTitle('SIADU - Document reporting');

/* Page Setup */
$dcMarginT=10;
$dcMarginB=10;
$dcMarginR=15;
$dcMarginL=15;
$dcPaperW=$paper[$sp][0];
$dcPaperH=$paper[$sp][1];
$dcPageW=$dcPaperW-$dcMarginR-$dcMarginL;
$dcPageH=$dcPaperH-$dcMarginT-$dcMarginB;
$dcMarginRX=$dcPaperW-$dcMarginR;
$dcMarginBY=$dcPaperH-$dcMarginB;

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

$lnbr=chr(10);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

/* dc_YDown() */
function dc_YDown($a=0){
	global $pdf;
	$pdf->SetY($pdf->GetY()+$a); // Line break 2mm
	return $pdf->GetY();
}

/* dc_Linebar() */
function dc_Linebar($x1='',$x2='',$a=2,$b=2){
global $pdf,$dcMarginL,$dcMarginRX;
$x1=$x1==''?$dcMarginL:$x1;
$x2=$x2==''?$dcMarginRX:$x2;
$cy=dc_YDown($a);
$pdf->Line($x1,$cy,$x2,$cy);
$cy=dc_YDown($b);
}

// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// set font
$pdf->SetFont(mydeffont, '', 11, '', true);

// set cell padding
$pdf->setCellPaddings(0, 0, 0, 0.5); //$left='', $top='', $right='', $bottom='')

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

// set color for background
$pdf->SetFillColor(255, 255, 255);

$file=trim(gets('file'));
if(file_exists($file.'.php')){
	require_once($file.'.php');
} else {
echo "Dokumen tidak tersedia!";
}

?>