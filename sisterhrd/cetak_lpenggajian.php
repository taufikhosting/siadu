<?php

include 'includes/config.php';
include 'includes/mysql.php';
$bulan = int_filter($_GET['bulan']);
$tahun = int_filter($_GET['tahun']);
$pbulan= getbulan($bulan);
global $koneksi_db,$url_situs;
echo "<html><head><title>Laporan Penggajian Bulanan  '.$pbulan.'-'.$tahun.'</title>";
//echo '<link rel="stylesheet" href="themes/administrator/css/print.css" type="text/css">';
//echo '<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.css" type="text/css">';
echo '<style>
table {
    border-collapse: collapse;
}
.borderbawah {
border-bottom:1px solid black;
	padding			: 2px;
    margin			: 2px 0 5px 0;
}
table, td, th {
    border: 1px solid black;
}
</style>';
$logoslip="<img src='images/logoslip.png'>";
echo "</head><body>";
echo'<div align="left" class="borderbawah">'.$logoslip.'</div>';
echo'<h3>Laporan Penggajian, Bulan / Tahun : '.$pbulan.' / '.$tahun.'</h3>';
echo '<table class="border">
<thead><tr>
<td class="text-center">No</td>
<td>Nama</td>
<td>Gaji Pokok</td>
<td>Tunjangan Struktural</td>
<td>Tunjangan Fungsional</td>
<td>Tunjangan Masa Kerja</td>
<td>Tunjangan Reward</td>
<td>Tunjangan Lain-Lain</td>
<td>THR</td>
<td>PPH21</td>
<td>Jamsostek</td>
<td>Pot.Terlambat</td>
<td>Pot.Lain</td>
<td>Gaji Bersih</td>
</tr></thead><tbody>';
$no =1;
$s = mysql_query ("SELECT * FROM `hrd_penggajian`where bulan='$bulan' and tahun='$tahun'");	
while($datas = mysql_fetch_array($s)){
$idphoto = $datas['id'];
$idkary = $datas['karyawan'];
$gajipokok 	= $datas['gajipokok'];
$tstruktural = $datas['tstruktural'];
$tfungsional = $datas['tfungsional'];
$tpengabdian = $datas['tpengabdian'];
$tprestasi  = $datas['tprestasi'];
$tlain  	=	 $datas['tlain'];
$thr  		= $datas['thr'];
$pph21  	= $datas['pph21'];
$jamsostek  = $datas['jamsostek'];
$pterlambat  = $datas['pterlambat'];
$plainlain  = $datas['plainlain'];
$gajibersih = $datas['gajibersih'];
$urutan = $no + 1;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
$cetak = '<a href="cetak_slip.php?id='.$idphoto.'&idkary='.$idkary.'" target="new"onclick="return confirm(\'Apakah Anda Ingin Mencetak Penggajian Ini ?\')" style="color:blue">Cetak Slip</a>';

echo '
<tr align="left">
<td class="text-center">'.$no.'</td>
<td>'.$nama.'</td>
<td>'.rupiah_format2($gajipokok).'</td>
<td>'.rupiah_format2($tstruktural).'</td>
<td>'.rupiah_format2($tfungsional).'</td>
<td>'.rupiah_format2($tpengabdian).'</td>
<td>'.rupiah_format2($tprestasi).'</td>
<td>'.rupiah_format2($tlain).'</td>
<td>'.rupiah_format2($thr).'</td>
<td>'.rupiah_format2($pph21).'</td>
<td>'.rupiah_format2($jamsostek).'</td>
<td>'.rupiah_format2($pterlambat).'</td>
<td>'.rupiah_format2($plainlain).'</td>
<td>'.rupiah_format2($gajibersih).'</td></tr>';
$tgajibersih+=$gajibersih;
$no++;
}
echo '
<tr align="left">
<td colspan="13"><div align="right"><b>Total Gaji</b></div></td>
<td><b>'.rupiah_format2($tgajibersih).'</b></td></tr>';
echo '</table>';
echo "</body</html>";

if (isset($_GET['bulan'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
