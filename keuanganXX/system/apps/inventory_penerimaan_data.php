<?php
$nomerbukti=gpost('nomerbukti');
$kodebrg=gpost('kodebrg');
$unit=gpost('unit');
$satuan=gpost('satuan');
$namabrg=gpost('namabrg');
$t=mysql_query("SELECT nama,satuan FROM keu_brg WHERE kode='$kodebrg' LIMIT 0,1");
if(mysql_num_rows($t)>0){
	$r=mysql_fetch_array($t);
	$namabrg=$r['nama'];
	$satuan=$r['satuan'];
}
$uraian='Penerimaan barang.';
if($nomerbukti!='')$uraian.=chr(13).'Kode bukti penerimaan: '.$nomerbukti.'.';
if($kodebrg!='')$uraian.=chr(13).'Kode barang: '.$kodebrg.'.';
if($namabrg!='')$uraian.=chr(13).'Nama barang: '.$namabrg.'.';
if(intval($unit)>0)$uraian.=chr(13).'Jumlah barang: '.$unit.($satuan==''?'':' '.$satuan).'.';

echo $uraian.'~'.$namabrg;
?>