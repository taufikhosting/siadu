<?php
if($departemen['departemen']!=''){
if($departemen['photo']!=''){
$imgdata = base64_decode($departemen['photo']);
$pdf->Image('@'.$imgdata,'','',0,30);
dc_YDown(3);
}
$pdf->SetFont(mydeffont, 'B', 26, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['departemen'], 0, 'C', 0, 1, '', '', true);
dc_YDown(2);
$pdf->SetFont(mydeffont, '', 11, '', true);
$pdf->MultiCell($dcPageW, 0, $departemen['alamat'].($departemen['telpon']==''?'':'.   Telepon: '.$departemen['telpon']), 0, 'C', 0, 1, '', '', true);
dc_YDown(3);
dc_Linebar('','',2,0.5);
dc_Linebar('','',0,2);
dc_YDown(5);
}
?>