<?php

include 'includes/config.php';
include 'includes/mysql.php';
$tgl1		= $_GET['tgl1'];
$tgl2			= $_GET['tgl2'];
global $koneksi_db,$url_situs;
echo "<html><head><title>Laporan Peminjaman $tgl1 - $tgl2</title>";
echo '<style type="text/css">
   table { page-break-inside:auto }
   tr    { page-break-inside:avoid; page-break-after:auto }
	table {
    border-collapse: collapse;}
	table, th, td {
    border: 1px solid black;}
	th,td {
    padding: 5px;
	}
.borderbawah {
border-bottom:1px solid black;
	padding			: 2px;
    margin			: 2px 0 5px 0;
}
}
</style>';
$logoslip="<img src='images/logoslip.png'>";
echo'<div align="left" class="borderbawah">'.$logoslip.'</div>';
echo "</head><body>";
echo'<h3>Laporan Peminjaman '.datetimes($tgl1).' Sampai Dengan '.datetimes($tgl2).'</h3>';
echo '<table>
<thead><tr>
<td class="text-center">No</td>
<td>Nama</td>
<td>Tanggal</td>
<td>Pinjaman</td>
<td>Bayar</td>
<td>Sisa Bayar</td>
</tr></thead><tbody>';
$no =1;
$s = mysql_query ("SELECT  * FROM  `hrd_pinjaman`where tgl between '$tgl1' and '$tgl2' order by tgl ASC ");	
while($datas = mysql_fetch_array($s)){
$pid = $datas['id'];
$tgl = $datas['tgl'];
$pinjaman 	= $datas['pinjaman'];
$idkary = $datas['karyawan'];
$urutan = $no + 1;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
$hasilb =  $koneksi_db->sql_query( "SELECT sum(bayar) as bayar FROM hrd_bayar where pid='$pid'" );
$datab = $koneksi_db->sql_fetchrow($hasilb);
$bayar = $datab['bayar'];
//$cetak = '<a href="cetak_slip.php?id='.$idphoto.'&idkary='.$idkary.'" target="new"onclick="return confirm(\'Apakah Anda Ingin Mencetak Penggajian Ini ?\')" style="color:blue"><span class="btn btn-warning">Slip</span></a>';
$sisabayar = $pinjaman - $bayar;
if(!$bayar){
$bayar='0';
}
echo '
<tr align="left">
<td class="text-center">'.$no.'</td>
<td>'.$nama.'</td>
<td>'.datetimes($tgl,false,false).'</td>
<td>'.rupiah_format($pinjaman).'</td>
<td>'.rupiah_format($bayar).'</td>
<td>'.rupiah_format($sisabayar).'</td>
</tr>';
$no++;
$tsisabayar += $sisabayar;
$tpinjaman += $pinjaman;
$tbayar += $bayar;
}
echo '
<tr align="left">
<td colspan="3"><div align="right"><b>Total</b></div></td>
<td><b>'.rupiah_format($tpinjaman).'</b></td>
<td><b>'.rupiah_format($tbayar).'</b></td>
<td><b>'.rupiah_format($tsisabayar).'</b></td></tr>';
echo '</table>';
echo "</body</html>";

if (isset($_GET['tgl1'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
