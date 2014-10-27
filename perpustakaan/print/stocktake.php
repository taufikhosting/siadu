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

// 1. Parameter: sesuaikan dg parameter di Page Selection Bar >> Edit
$cid=gets('token');
$lap_cetak=gets('lap_cetak',0);
$lap_tglcetak=gets('lap_tglcetak',0);
$lap_sum=gets('lap_sum',0);

// 2. Queries: samakan dg Query >> Edit
$t=mysql_query("SELECT * FROM pus_stockhist WHERE replid='$cid'");
$data_so=mysql_fetch_array($t);
$tbl="joshso.".$data_so['tabel'];
if($lap_cetak==0) $fl="";
else if($lap_cetak==1) $fl=" WHERE ".$tbl.".cek='Y'";
else if($lap_cetak==2) $fl=" WHERE ".$tbl.".cek='N'";
else if($lap_cetak==3) $fl=" WHERE ".$tbl.".cek='N' AND ".$tbl.".note<>''";
else if($lap_cetak==4) $fl=" WHERE ".$tbl.".cek='N' AND ".$tbl.".note=''";
$t=mysql_query("SELECT ".$tbl.".cek,".$tbl.".note,josh.pus_buku.barkode,josh.pus_buku.callnumber,josh.pus_katalog.isbn,josh.pus_katalog.judul,josh.pus_katalog.pengarang,josh.pus_katalog.tahunterbit,josh.pus_pengarang.nama as npengarang,josh.pus_penerbit.nama as npenerbit FROM ".$tbl." LEFT JOIN josh.pus_buku ON josh.pus_buku.replid=".$tbl.".buku LEFT JOIN josh.pus_katalog ON josh.pus_katalog.replid=josh.pus_buku.katalog LEFT JOIN josh.pus_pengarang ON josh.pus_pengarang.replid=josh.pus_katalog.pengarang LEFT JOIN josh.pus_penerbit ON josh.pus_penerbit.replid=josh.pus_katalog.penerbit".$fl." ORDER BY ".$tbl.".cek DESC, josh.pus_buku.barkode");


$pdf->AddPage();
if($lap_tglcetak=='1'){
$pdf->SetFont(mydeffont, '', 6, '', true);
$pdf->MultiCell(30, 0, fftgl(date("Y-m-d")).' '.date("H:i"), 0, 'L', 0, 0, $dcPaperW-40, 10, true);
}

page_header();
// require_once('header.php');

// 3. Judul Halaman: Contoh format "DATA <nama halaman>" >> Edit
$JUDUL_HALAMAN  = 'Data Stock Opname';
if($lap_cetak==1) $JUDUL_HALAMAN2 = 'Daftar Item Dicek';
else if($lap_cetak==2) $JUDUL_HALAMAN2 = 'Daftar Item Hilang';
else if($lap_cetak==3) $JUDUL_HALAMAN2 = 'Daftar Item Hilang Dengan Keterangan';
else if($lap_cetak==4) $JUDUL_HALAMAN2 = 'Daftar item Hilang Tanpa Keterangan';
else $JUDUL_HALAMAN2 = '';


$pdf->SetFont(mydeffont, '', 12, '', true);
$pdf->MultiCell($dcPageW, 0, strtoupper($JUDUL_HALAMAN), 0, 'C', 0, 1, '', '', true);
if($JUDUL_HALAMAN2!=''){
$pdf->SetFont(mydeffont, '', 8, '', true);
$pdf->MultiCell($dcPageW, 0, $JUDUL_HALAMAN2, 0, 'C', 0, 1, '', '', true);
}
dc_YDown(3);

if(mysql_num_rows($t)>0){

$pdf->SetFont(mydeffont, '', 8, '', true);

function cetak_infohalaman($label,$info){
	global $pdf;
	$pdf->MultiCell(30, 0, $label, 0, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(100, 0, ': '.$info, 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}

function cetak_infohalaman2($label,$info){
	global $pdf,$dcPageW;
	$pdf->MultiCell(30, 0, $label, 0, 'L', 0, 0, $dcPageW-50, '', true);
	$pdf->MultiCell(100, 0, ': '.$info, 0, 'L', 0, 0, '', '', true);
	$pdf->Ln();
}

// 4. Cetak info halaman: Sesuaikan Page Selection Bar >> Edit
$ty=$pdf->GetY();
cetak_infohalaman('Nama stock opname',$data_so['nama']);
cetak_infohalaman('Tanggal mulai',fftgl($data_so['tanggal1']));
cetak_infohalaman('Tanggal selesai',fftgl($data_so['tanggal2']));

if($lap_sum==1){
$pdf->SetY($ty);
cetak_infohalaman2('Total item',$data_so['nitem'].' item');
cetak_infohalaman2('Item dicek',$data_so['nceky'].' item');
cetak_infohalaman2('Item hilang',($data_so['nitem']-$data_so['nceky']).' item');
}
dc_YDown(2);

// 5. Header tabel: samakan di $xtable->head() >> Edit
$phead=array(
array('No.','C',11),
array('Barkode','L',32),
array('Judul','L',60),
array('Callnumber','L',25),
array('ISBN','L',30),
array('Pengarang','L',30),
array('Penerbit','L',30),
array('Cek','C',10),
array('Catatan','L',0)
);

$thx=array();
$tax=array();
$twx=array();
$n=count($phead);
for($i=0;$i<$n;$i++){
$thx[$i]=$phead[$i][0];
$tax[$i]=$phead[$i][1];
$twx[$i]=$phead[$i][2];
}
$thx_n=count($thx);
$tax_n=count($tax);
$twx_n=count($twx);

$idx_o = $thx_n-1; // 9. Index kolom yang lebar 0 (Lebar menyesuaikan) >> Edit

$tx=0;
for($i=0;$i<$twx_n;$i++){
	$tx+=$twx[$i];
} $newline=chr(10);
$twx[$idx_o]=$dcPageW-$tx;
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

function cetak_kolom($ik){
	global $pdf,$twx,$tax,$my,$i;
	$pdf->MultiCell($twx[$i], 0, $ik, 0, $tax[$i++], 0, 0, '', '', true);
	if($pdf->getLastH()>$my)$my=$pdf->getLastH();
}

$fst=true; $LCEK='';

while($r=dbFA($t)){ $i=0;
	if($pdf->GetY()>180) {
		$pdf->AddPage();
		page_header();
		
		$pdf->SetTextColor(255);
		$pdf->SetFillColor(0);
		for($i=0;$i<$thx_n;$i++){
			$pdf->MultiCell($twx[$i], 0, $thx[$i], 1, $tax[$i], 1, 0, '', '', true);
		}
		$pdf->Ln();
		$pdf->SetTextColor(0);
	}
	
	if($LCEK!=''){
		if($r['cek']!=$LCEK){
			$tx=$dcMarginL;
			
			for($l=0;$l<$twx_n;$l++){
				$tx=$tx+$twx[$l];
			}
			$gy=$pdf->GetY()+1;
			$pdf->SetY($gy);
			$pdf->Line($dcMarginL,$gy,$tx,$gy);
		}
	}
	
	$i=0;
	$ny=$pdf->GetY();$my=0; $i=0;$pdf->MultiCell($twx[$i], 0, $row++, 0, $tax[$i++], 0, 0, '', '', true);if($pdf->getLastH()>$my)$my=$pdf->getLastH();
	
	// 10. Row data: >> Edit
	
	cetak_kolom($r['barkode']);
	cetak_kolom(buku_judul($r['judul']));
	cetak_kolom($r['callnumber']);
	cetak_kolom($r['isbn']);
	cetak_kolom($r['npengarang']);
	cetak_kolom($r['npenerbit']);
	cetak_kolom($r['cek']);
	cetak_kolom($r['note']);
	
	// End of Row data (10): Udah :)
	
	
	$tx=$dcMarginL;
	$gy=$ny+$my;
	$pdf->Line($tx,$ny,$tx,$gy);
	
	for($l=0;$l<$i;$l++){
		$tx=$tx+$twx[$l];
		$pdf->Line($tx,$ny,$tx,$gy);
		//if($fst) $pdf->MultiCell(10, 0, $twx[$twx_n-1], 1, 'C');//, 1, 0, '', '', true);
	}
	
	//$pdf->Line($tx+$twx[$twx_n-1],$ny,$tx+$twx[$twx_n-1],$gy);
	
	//$pdf->MultiCell(10, 0, $tx, 1, 'C');//, 1, 0, '', '', true);
	
	$pdf->Line($dcMarginL,$gy,$tx,$gy);
	
	$pdf->Ln();
	
	$pdf->setY($ny+$my);
	
	$LCEK=$r['cek'];
	
	
	$fst=false;
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
$pdf->Output('SIADU '.strtoupper(APID).' - '.$JUDUL_HALAMAN.'.pdf', 'I');
?>