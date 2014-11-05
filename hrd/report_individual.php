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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
$dcPaperW=210;
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

define('dp_Employeedata',1);
define('dp_Personalinformation',2);
define('dp_Familyinformation',3);
define('dp_Educationalhistory',4);
define('dp_Jobhistory',5);
define('dp_Selfdescription',6);
define('dp_Healtcircumtance',7);
define('dp_Reference',8);
define('dp_Generalinformation',9);
define('dp_Additionalinformation',10);

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
for($id=1;$id<count($ids);$id++){
$dcid=$ids[$id];

// Queries:
$t=dbSel("*","employee","W/`dcid`='$dcid' LIMIT 0,1");
$ndata=mysql_num_rows($t);
$r=dbFA($t);

// add a page
$pdf->AddPage();

// Title : Comprehensive Report **
$pdf->SetFont('dejavusans', 'B', 12, '', true);
$pdf->MultiCell($dcPageW, 0, 'Comprehensive Report', 0, 'C', 0, 1, '', '', true);
dc_YDown(5);
// Name **
$pdf->SetFont('dejavusans', 'B', 13, '', true);
$txt=$r['name'];
$pdf->MultiCell($dcPageW, 0, $txt, 0, 'C', 0, 1, '', '', true);
$pdf->Ln();

$cy=$pdf->GetY();

if($dps[dp_Employeedata]=='1'){
// Photo **
$rimg=dbFetch("photo","emp_photo","W/`empid`='$dcid'");
if(!empty($rimg)){
$imgdata = base64_decode($rimg);
$pdf->Image('@'.$imgdata);
} else {
	$pdf->Image('images/nophoto.png');
}

// Employee Data **
$pdf->SetFont('dejavusans', '', 9, '', true);

dc_EmployeeData('NIP',$r['nip']);
dc_EmployeeData('Level',$mstr_level[$r['level']]);
dc_EmployeeData('Division',$mstr_division[$r['division']]);
dc_EmployeeData('Group',$mstr_group[$r['group']]);
dc_EmployeeData('Position',$mstr_position[$r['position']]);
$a=dbSFA("date1,date2","emp_status","W/empid='$dcid'");
dc_EmployeeData('Status',$mstr_status[$r['status']]);
if($r['status']!=0) dc_EmployeeData('Status period',ftgl($a['date1']).($r['status']==1?'':' - '.ftgl($a['date2'])));

$cy=dc_YDown(2);
$pdf->Line(65,$cy,($dcPaperW-$dcMarginR),$cy);
$cy=dc_YDown(2);

}

if($dps[dp_Personalinformation]=='1'){
$dlbl=Array();
$dlbl['Gender']=$r['gender'];
$dlbl['Address']=$r['address'];
$dlbl['Telepon/fax']=$r['phonefax'];
$dlbl['Email']=$r['email'];
$dlbl['Birth']=$r['birthplace'].", ".fftgl($r['birthdate']);
$dlbl['Marital status']=$mstr_marital[$r['marital']];
$dlbl['Religion']=$mstr_religion[$r['religion']];

foreach($dlbl as $k=>$v){
	dc_EmployeeData($k,$v);
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}

if($dps[dp_Familyinformation]=='1'){
// Family Information **
$q=dbSel("*","emp_family","W/empid='$dcid'");
if(dbNRow($q)==0){
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Family Information: N/A", 0, 'L', 0, 1, '', '', true);
$pdf->Ln();
} else {
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Family Information", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_YDown(1);

$th=Array('Relation','Name','Address','Education','Birth','job');
$tw=Array(20,35,0,25,25,20);

$pdf->setCellPaddings(0.5, 0.5, 0.5, 0.5);
dc_tableHead($th,$tw);

while($f=dbFA($q)){ $i=0;
	$pdf->MultiCell($tw[$i++], 0, $mstr_family[$f['family']], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['name'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['address'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['education'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, fstgl($f['birthdate']), 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['job'], 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}}



if($dps[dp_Educationalhistory]=='1'){
// Education Information ** empid	university	year	title	field	score
$q=dbSel("*","emp_education","W/empid='$dcid'");
if(mysql_num_rows($q)==0){
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Education History: N/A", 0, 'L', 0, 1, '', '', true);
$pdf->Ln();
} else {
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Education History", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_YDown(1);

$th=Array('University','Year','Title','Field','Score');
$tw=Array(0,20,30,30,20);

$pdf->setCellPaddings(0.5, 0.5, 0.5, 0.5);
dc_tableHead($th,$tw);
while($f=dbFA($q)){ $i=0;
	$pdf->MultiCell($tw[$i++], 0, $f['university'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['year'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['title'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['field'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['score'], 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}}

if($dps[dp_Jobhistory]=='1'){
// Job History ** dcid	empid	name	address	date1	date2	position	salary	reason
$q=dbSel("*","emp_jobhis","W/empid='$dcid'");
if(mysql_num_rows($q)==0){
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Job History: N/A", 0, 'L', 0, 1, '', '', true);
$pdf->Ln();
} else {
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Job History", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_YDown(1);

$th=Array('Company Name','Company Address','Period','Posiiton','Salary');
$tw=Array(0,50,30,30,20);

$pdf->setCellPaddings(0.5, 0.5, 0.5, 0.5);
dc_tableHead($th,$tw);

while($f=dbFA($q)){ $i=0;
	$pdf->MultiCell($tw[$i++], 0, $f['name'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['address'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, fhtgl($f['date1']).' - '.fhtgl($f['date2']), 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['position'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['salary'], 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}}


if($dps[dp_Selfdescription]){
// Self Description
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Self Description", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_LineBar('','',1);

$f=dbSFAx("*","emp_desc","W/empid='$dcid'");

for($i=1;$i<=20;$i++){
	if($f['desc'.$i]!=''){
	if($pdf->GetY()>260) $pdf->AddPage();
	$pdf->MultiCell(10, 0, $i.'.', 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(0, 0, $f['desc'.$i], 0, 'L', 0, 1, '', '', true);
	}
}
$pdf->Ln();
}

if($dps[dp_Healtcircumtance]=='1'){
// Healt Circumtance
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Healt Circumtance", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_LineBar('','',1);

$pdf->setCellPaddings(0,0,0,0.5);

$f=dbSFAx("*","emp_healt","W/empid='$dcid'");
$lbl=Array( 'Jelaskan bagaimana kesehatan anda secara umum',
			'Bagaimana pendengaran anda',
			'Bagaimana penglihatan anda',
			'Golongan darah anda',
			'Adakah kecacatan, atau kondisi khusus lainnya',
			'Tanggal pemeriksaan dokter terakhir',
			'Apakah pernah menjalani perawatan di rumah sakit?, Untuk keperluan apa dan selama berapa lama');
for($i=0;$i<count($lbl);$i++){
	dc_EmployeeHealt($lbl[$i],$f['info'.($i+1)],80);
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}



if($dps[dp_Reference]=='1'){
// Reference** name	address	phone	job	know	relation
$q=dbSel("*","emp_reference","W/empid='$dcid'");
if(dbNRow($q)==0){
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "References: N/A", 0, 'L', 0, 1, '', '', true);
$pdf->Ln();
} else {
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "References", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_YDown(1);

$th=Array('Name','Address','Phone','Job','Since','Relation');
$tw=Array(0,60,20,30,20,20);

$pdf->setCellPaddings(0.5, 0.5, 0.5, 0.5);
dc_tableHead($th,$tw);


while($f=dbFA($q)){ $i=0;
	$pdf->MultiCell($tw[$i++], 0, $f['name'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['address'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['phone'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['job'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['know'], 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($tw[$i++], 0, $f['relation'], 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}}

if($dps[dp_Generalinformation]){
// General Info
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "General Info", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_LineBar('','',1);

$pdf->setCellPaddings(0,0,0,0.5);

$f=dbSFAx("*","emp_ginfo","W/empid='$dcid'");
$lbl=Array( 'Apakah anda pernah melamar pekerjaan di sini',
			'Apakah anda mempunyai teman atau anggota keluarga yang bekerja di sini',
			'Apakah anda pernah mengikuti tes pekerjaan: Kapan dan di mana: Apakah nama tes-tes tersebut',
			'Pada jenjang yang manakah anda mampu dan bersedia mengajar (khusus guru)',
			'Apakah tujuan profesional anda yang paling tinggi dan apakah rencana anda untuk meraihnya',
			'Apakah anda memiliki rumah sendiri',
			'Apakah anda memiliki kendaraan sendiri (tentukan)',
			'Bisakan anda memainkan alat musik (tentukan)',
			'Apakah anda berkebiasaan merokok, minum munuman keras, menggunakan napza/narkoba, berjudi',
			'Apakah anda pernah terlibat dalam masalah krimina: Jelaskan bila ya. Tuliskan tahun dan tempat di mana itu terjadi',
			'Apakah anda bersedia mengikuti semua peraturan dan prosedur Sekolah VITA, termasuk mengenai moral, seragam, dan kekristenan',
			'Apakah anda bersedia bekerja melebihi jam kerja bila diperlukan',
			'Kapan anda bisa mulai bekerja',
			'Perkiraan gaji yang diharapkan');
			
for($i=0;$i<count($lbl);$i++){
	dc_EmployeeHealt($lbl[$i],$f['info'.($i+1)],80);
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}

if($dps[dp_Additionalinformation]=='1'){
// Additional Info
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->MultiCell($dcPageW, 0, "Additional Info", 0, 'L', 0, 1, '', '', true);
$pdf->SetFont('dejavusans', '', 9, '', true);
dc_LineBar('','',1);

$pdf->setCellPaddings(0,0,0,0.5);

$f=dbSFAx("*","emp_ainfo","W/empid='$dcid'");
$lbl=Array( 'Apakah anda sudah lahir kembali dalam Kristus? (bila ya, tuliskan kapan anda mengalaminya)',
			'Jelaskan mengenai keadaan kelahiran baru tersebut dan apa dampaknya bagi kehidupan anda',
			'Tuliskan ungkapan/pernyataan iman anda',
			'Tuliskan pendapat anda mengenai Tritunggal',
			'Tuliskan pendapat anda mengenai pendidikan berdasarkan Kristiani');
			
for($i=0;$i<count($lbl);$i++){
	dc_EmployeeHealt($lbl[$i],$f['info'.($i+1)],80);
}
$pdf->setCellPaddings(0,0,0,0);
$pdf->Ln();
}


} // End Employee Loop


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
