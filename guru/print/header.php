<?php
if($departemen['nama']!=''){
if($departemen['photo']!=''){
$imgdata = base64_decode($departemen['photo']);
$pdf->Image('@'.$imgdata);
}
$pdf->SetFont('dejavusans', 'B', 16, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['nama'], 0, 'C', 0, 1, '', '', true);
dc_YDown(2);
$pdf->SetFont('dejavusans', '', 8, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['alamat'].($departemen['telpon']==''?'':'.   Telepon: '.$departemen['telpon']), 0, 'C', 0, 1, '', '', true);
dc_Linebar();
dc_YDown(5);
}
?>