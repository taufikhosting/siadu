<?php
set_time_limit(0);
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
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');

require_once('../shared/libraries/tcpdf/config/lang/eng.php');
require_once('../shared/libraries/tcpdf/tcpdf.php');

$pprint=gpost('pprint');

// create new PDF document
$psize=gpost('psize');
if($psize=='') $psize=PDF_PAGE_FORMAT;
$pdf = new TCPDF('L', PDF_UNIT, $psize, true, 'UTF-8', false);

$pdat=gpost('pdat');
$psum=gpost('psum');

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$paper=Array();
$sp=$psize;
$paper['F4']=Array(330,210);
$paper['A4']=Array(297,210);

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

$mstr_author=Array();
$t=dbSel("*","mstr_author","O/ prefix");
while($r=dbFA($t)){
	$mstr_author[$r['dcid']]=$r['name'];
}
$mstr_publisher=Array();
$t=dbSel("*","mstr_publisher","O/ name");
while($r=dbFA($t)){
	$mstr_publisher[$r['dcid']]=$r['name'];
}
//$mstr_class=MstrGetx("mstr_class","code");
//$mstr_language=MstrGet("mstr_language");

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

/* dc_Linebar() */
function dc_Linebar($x1='',$x2='',$a=2,$b=2){
global $pdf,$dcMarginL,$dcMarginRX;
$x1=$x1==''?$dcMarginL:$x1;
$x2=$x2==''?$dcMarginRX:$x2;
$cy=dc_YDown($a);
$pdf->Line($x1,$cy,$x2,$cy);
$cy=dc_YDown($b);
}

/* dc_EmployeeData() */
function dc_EmployeeData($lbl,$txt){
global $pdf;
$L=$dcMarginL+65; $wL=30;
$pdf->MultiCell($wL, 0, $lbl, 0, 'L', 0, 0, $L, '', true);
$txt=": ".$txt;
$pdf->MultiCell($dcMarginRX-$L-$wL, 0, $txt, 0, 'L', 0, 1, $L+$wL, '', true);
}

/* dc_tableHead() */
function dc_tableHead($h,&$w,$al,$x=''){
	global $pdf,$dcPageW; $x=$x==''?$dcPageW:$x;
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$cw=0; $y=-1;
	for($i=0;$i<count($h);$i++){
		$cw+=$w[$i];
		if($w[$i]==0) $y=$i;
	}
	if($y!=-1) $w[$y]=$x-$cw;
	for($i=0;$i<count($h);$i++){
		$pdf->MultiCell($w[$i], 0, $h[$i], 1, $al[$i], 1, 0, '', '', true);
	}
	$pdf->Ln();
	$pdf->SetTextColor(0);
}

/* Pre Data Processing */
if(gets('ids')!=ALL){
	$ids=explode("-",gets('ids'));
} else {
	$ids=Array();
	$ids[0]=0;
	$t=dbSel("dcid","catalog","O/ title");
	$i=1;
	while($r=dbFA($t)){
		$ids[$i++]=$r['dcid'];
	}
}

define('dp_Title',1);
define('dp_Callnumber',2);
define('dp_Idnumber',3);
define('dp_Author',4);
define('dp_Publisher',5);
define('dp_Classification',6);
define('dp_Isbn',7);
define('dp_Releasedate',8);
define('dp_Available',9);

$dps=explode("-",gets('dps'));

/* dc_EmployeeHealt() */
function dc_EmployeeHealt($lbl,$txt,$wL=50){
global $pdf,$dcMarginL;
if($pdf->GetY()>260) $pdf->AddPage();
$L=$dcMarginL;
$txt=": ".$txt; $cy=$pdf->GetY();
$pdf->MultiCell($wL, 0, $lbl,0, 'L', 0, 1, $L, $cy, true);
$ly=$pdf->GetY(); $pdf->SetY($cy);
$pdf->MultiCell(0, 0, $txt, 0, 'L', 0, 1, $L+$wL+2, $cy, true);
$ty=$pdf->GetY();
$pdf->SetY($ty>$ly?$ty:$ly);
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
if(gpost('pdat')=='1'){
$pdf->SetXY(10,10);
$pdf->SetFont('dejavusans', '', 7, '', true);
$pdf->MultiCell(0, 0, fftgl(date("Y-m-d"))." ".date("H:i:s"), 0, 'L', 0, 0, '', '', true);
$pdf->SetXY($dcMarginL,$dcMarginT);
}

if($pprint=='1'){$ppr=" WHERE cek='Y'"; $pttl=" - Book Checked";}
else if($pprint=='2'){$ppr=" WHERE cek='N' AND note!=''"; $pttl=" - Book Lost With Note";}
else if($pprint=='3'){$ppr=" WHERE cek='N' AND note=''"; $pttl=" -  Book Lost Without Note";}
else{$ppr=""; $pttl="";}

// Title : Comprehensive Report **
$pdf->SetFont('dejavusans', '', 11, '', true);
$pdf->MultiCell($dcPageW, 0, 'VITA School Library', 0, 'C', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->MultiCell($dcPageW, 0, 'Stock Opname Report'.$pttl, 0, 'C', 0, 1, '', '', true);
dc_YDown(5);


// Query stock table
$nid=gpost('nid');
$t=dbSel("*","so_history","W/dcid='$nid' LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
$sql="SELECT * FROM `".$r['ntable']."` ".$ppr." ORDER BY cek,barcode";
$t=mysql_query($sql);
//echo $sql;

// Summarize
$btot=mysql_num_rows(mysql_query("SELECT * FROM `book`"));
$bdue=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."`"));
//$bcek=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
$bcekY=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='Y'"));
$bcekN=$bdue-$bcekY;//mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N'"));
$bcek=$bcekY+$bcekN; $bcekYp=round($bcekY*100/$bcek,2); $bcekNp=round($bcekN*100/$bcek,2);
$buli=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."new`"));

$pdf->SetFont('dejavusans', '', 8, '', true);

$pdf->MultiCell(30, 0, 'Stock take name', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$r['name'], 0, 'L', 0, 0, '', '', true);
if($psum=='1'){
$pdf->SetX($dcPaperW-85);
$pdf->MultiCell(30, 0, 'Total book in list', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$btot.' book'.($btot>1?'s':''), 0, 'L', 0, 1, '', '', true);
} else {
$pdf->Ln();
}
$pdf->MultiCell(30, 0, 'Stock take date', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.fftgl($r['date']), 0, 'L', 0, 0, '', '', true);
if($psum=='1'){
$pdf->SetX($dcPaperW-85);
$pdf->MultiCell(30, 0, 'Total book checked', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$bcekY." ( ".$bcekYp." % )"." book".($bcekY>1?"s":""), 0, 'L', 0, 1, '', '', true);
} else {
$pdf->Ln();
}
$pdf->MultiCell(30, 0, 'Finished', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.fftgl($r['date2']), 0, 'L', 0, 0, '', '', true);
if($psum=='1'){
$pdf->SetX($dcPaperW-85);
$pdf->MultiCell(30, 0, 'Total book lost', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.$bcekN." ( ".$bcekNp." % )"." book".($bcekN>1?"s":""), 0, 'L', 0, 1, '', '', true);
} else {
$pdf->Ln();
}
//$pdf->Ln();
dc_YDown(2);
$thx=Array('No.','Book number','Title','Call number','Author','ISBN','Publisher','Year','Check','Note');
$twx=Array(   11,           35,     0,           30,      30,    30,         25,    20,     15,    30);
$tax=Array(  'C',    'L',    'L',          'L',     'L',   'L',        'L',   'L',    'C',   'L');

$tx=0;
for($i=0;$i<count($twx);$i++){
	$tx+=$twx[$i];
}
$twx[2]=$dcPageW-$tx;
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
$pdf->SetFont('dejavusans', '', 8, '', true);
$pdf->setCellPaddings(1, 1, 1, 1);

$row=1;

while($r=dbFA($t)){ $i=0;
	if($pdf->GetY()>180) {
		$pdf->AddPage();
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
	$y=mysql_query("SELECT * FROM catalog WHERE dcid='".$r['catalog']."' LIMIT 0,1");
	$f=mysql_fetch_array($y);
	$y1=mysql_query("SELECT * FROM book WHERE barcode='".$r['barcode']."' LIMIT 0,1");
	$f1=mysql_fetch_array($y1);
	
	
	$ny=$pdf->GetY();
	$my=0; $i=0;
	$pdf->MultiCell($twx[$i++], 0, $row++, 0, 'R', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $f1['nid'], 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, str_replace("\'","'",$f['title']), 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $f1['callnumber'], 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$auth=dbFetch("name","mstr_author","W/dcid='".$f['author']."'");
	$pdf->MultiCell($twx[$i++], 0, str_replace("\'","'",$auth), 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $f['isbn'], 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pub=dbFetch("name","mstr_publisher","W/dcid='".$f['publisher']."'");
	$pdf->MultiCell($twx[$i++], 0, $pub, 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $f['release'], 0, 'L', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $r['cek'], 0, 'C', 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	$pdf->MultiCell($twx[$i++], 0, $r['note'], 0, 'L', 0, 0, '', '', true);
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
	$pdf->MultiCell($dcPageW, 0, 'There is no current stock take.', 0, 'C', 0, 1, '', '', true);
}
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('stockreport.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+

exit();

?>