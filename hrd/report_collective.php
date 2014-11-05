<?php
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

require_once(LIBDIR.'tcpdf/config/lang/eng.php');
require_once(LIBDIR.'tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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

/* Page Setup */
$dcMarginT=15;
$dcMarginR=15;
$dcMarginL=15;
$dcPaperW=290;
$dcPaperH=210;
$dcPageW=$dcPaperW-$dcMarginR-$dcMarginL;
$dcMarginRX=$dcPaperW-$dcMarginR;

$mstr_status=MstrGet("mstr_status");
$mstr_level=MstrGet("mstr_level");
$mstr_group=MstrGet("mstr_group");
$mstr_division=MstrGet("mstr_division");
$mstr_traintype=MstrGet("mstr_traintype");
$mstr_family=MstrGet("mstr_family");
$mstr_marital=MstrGet("mstr_marital");
$mstr_religion=MstrGet("mstr_religion");

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
function dc_tableHead($h,&$w,$x=''){
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
		$pdf->MultiCell($w[$i], 0, $h[$i], 0, 'L', 1, 0, '', '', true);
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
	$t=dbSel("dcid","employee","O/ name");
	$i=1;
	while($r=dbFA($t)){
		$ids[$i++]=$r['dcid'];
	}
}

define('dp_Name',1);
define('dp_Nip',2);
define('dp_Status',3);
define('dp_Level',4);
define('dp_Group',5);
define('dp_Division',6);

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
$t=dbSel("*","employee","W/`dcid`='$dcid' LIMIT 0,1");
$ndata=mysql_num_rows($t);
$r=dbFA($t);

// add a page
$pdf->AddPage();

// Title : Comprehensive Report **
$pdf->SetFont('dejavusans', '', 11, '', true);
$pdf->MultiCell($dcPageW, 0, 'VITA School Human Resource Department', 0, 'C', 0, 1, '', '', true);
dc_YDown(5);
// Name **
$pdf->SetFont('dejavusans', '', 8, '', true);
$pdf->MultiCell(30, 0, 'Document name', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': Employee Report', 0, 'L', 0, 1, '', '', true);

$pdf->MultiCell(30, 0, 'Date', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, 0, ': '.fftgl(date("Y-m-d")), 0, 'L', 0, 1, '', '', true);
$pdf->Ln();

$thx=Array('','Name','NIP','Status','Level','Group','Division');
$twx=Array(0,0,30,30,30,30,30);
$th=Array();
$tw=Array();
$tc=Array();
$k=0;
for($i=1;$i<count($dps);$i++){
	if($dps[$i]=='1'){
		$th[$k]=$thx[$i];
		$tw[$k++]=$twx[$i];
		$tc[$i]=1;
	} else $tc[$i]=0;
}

$pdf->setCellPaddings(0.5, 0.5, 0.5, 0.5);
dc_tableHead($th,$tw);

$fstatus=gets('status');
$flevel=gets('level');
$fgroup=gets('group');
$fdivision=gets('division');

$filt="";
$fil.=$fstatus=="0"?"":" `status`='$fstatus'";
$filt.=$fil;
$fil.=$flevel=="0"?"":" `level`='$flevel'";
$filt.=$filt==""?$fil:" AND ".$fil;
$fil.=$fgroup=="0"?"":" `group`='$fgroup'";
$filt.=$filt==""?$fil:" AND ".$fil;
$fil.=$fgroup=="0"?"":" `division`='$fdivision'";
$filt.=$filt==""?$fil:" AND ".$fil;

$filt=$filt==""?"":" WHERE ".$filt;

$ord=gets('sortby');
$sql="SELECT * FROM employee ".$filt." ORDER BY ".$ord;
//echo $sql;
$t=mysql_query($sql);
while($f=dbFA($t)){ $i=0;
	if($pdf->GetY()>190) {
		$pdf->AddPage();
		dc_tableHead($th,$tw);
	}
	if($tc[dp_Name]=='1') $pdf->MultiCell($tw[$i++], 0, $f['name'], 0, 'L', 0, 0, '', '', true);
	if($tc[dp_Nip]=='1') $pdf->MultiCell($tw[$i++], 0, $f['nip'], 0, 'L', 0, 0, '', '', true);
	if($tc[dp_Status]=='1') $pdf->MultiCell($tw[$i++], 0, $mstr_status[$f['status']], 0, 'L', 0, 0, '', '', true);
	if($tc[dp_Level]=='1') $pdf->MultiCell($tw[$i++], 0, $mstr_level[$f['level']], 0, 'L', 0, 0, '', '', true);
	if($tc[dp_Group]=='1') $pdf->MultiCell($tw[$i++], 0, $mstr_group[$f['group']], 0, 'L', 0, 0, '', '', true);
	if($tc[dp_Division]=='1') $pdf->MultiCell($tw[$i++], 0, $mstr_division[$f['division']], 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
