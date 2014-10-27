<?php
$lok=gpost('lokasi');
$tingb=gpost('tingkatbuku');
$opt=gpost('opt');
$lid=gpost('idbuku');
if($opt=='af'){
$idbuku=buku_getidbuku($lok,$tingb);
$barkode=buku_idbukutobarkode($idbuku);
} else {
$urut=buku_idbukugeturut($lid);
$idbuku=buku_getidbuku($lok,$tingb,1,$urut);
$barkode=buku_idbukutobarkode($idbuku);
}
echo $barkode.'-'.$idbuku;
?>