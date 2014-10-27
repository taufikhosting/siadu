<?php

include 'includes/config.php';
include 'includes/mysql.php';
$bulan = int_filter($_GET['bulan']);
$tahun = int_filter($_GET['tahun']);
$pbulan= getbulan($bulan);
global $koneksi_db,$url_situs;
echo "<html><head><title>Laporan Absensi Bulanan '.$pbulan.'-'.$tahun.'</title>";
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
</style>';
echo "</head><body>";
$logoslip="<img src='images/logoslip.png'>";
echo'<div align="left" class="borderbawah">'.$logoslip.'</div>';
echo'<h3>Laporan Absensi, Bulan / Tahun : '.$pbulan.' / '.$tahun.'</h3>';
echo '<table>
<thead><tr>
<td class="text-center">No</td>
<td>Nama</td>
<td>Masuk (Hari)</td>
<td>Lembur (Jam)</td>
<td>Sakit (Hari)</td>
<td>Alpha (Hari)</td>
<td>Terlambat(Menit)</td>
</tr></thead><tbody>';
$no =1;
$s = mysql_query ("SELECT * FROM `hrd_absensi`where bulan='$bulan' and tahun='$tahun'");	
while($datas = mysql_fetch_array($s)){
$idphoto = $datas['id'];
$idkary = $datas['karyawan'];
$masuk 	= $datas['masuk'];
$lembur = $datas['lembur'];
$sakit = $datas['sakit'];
$alpha = $datas['alpha'];
$telat  = $datas['telat'];
$urutan = $no + 1;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
echo '
<tr align="left">
<td class="text-center">'.$no.'</td>
<td>'.$nama.'</td>
<td>'.$masuk.'</td>
<td>'.$lembur.'</td>
<td>'.$sakit.'</td>
<td>'.$alpha.'</td>
<td>'.$telat.'</td></tr>';
$no++;
}
echo '</table>';
echo "</body</html>";

if (isset($_GET['bulan'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
