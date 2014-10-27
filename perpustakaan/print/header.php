<?php
if($departemen['nama']!=''){
if($departemen['photo']!=''){
$imgdata = base64_decode($departemen['photo']);
$pdf->Image('@'.$imgdata);
}
$pdf->SetFont(mydeffont, 'B', 16, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['nama'], 0, 'C', 0, 1, '', '', true);
dc_YDown(2);
$pdf->SetFont(mydeffont, '', 8, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['alamat'].($departemen['telpon']==''?'':'.   Telepon: '.$departemen['telpon']), 0, 'C', 0, 1, '', '', true);
dc_Linebar('','',2,0.5);
dc_Linebar('','',0,2);
dc_YDown(5);
}
?>