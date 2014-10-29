<?php

include 'includes/config.php';
include 'includes/mysql.php';

global $koneksi_db,$url_situs;
echo "<html><head><title>REKAP DATA KARYAWAN</title>";
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
echo '<link rel="shortcut icon" href="favicon.ico">';
echo "</head><body>";
$logoslip="<img src='images/logoslip.png'>";
echo'<div align="left" class="borderbawah">'.$logoslip.'</div>';
echo'<h3>REKAP KARYAWAN</h3>';
echo '<table>
<thead ><tr>
<th>Kode Guru</th>
<th>NIP/NUPTK</th>
<th>Nama</th>
<th>Tempat</th>
<th>TglLahir</th>
<th>Agama</th>
<th>Pendidikan</th>
<th>Jabatan</th>
<th>Jabatan Lain</th>
<th>Status</th>
<th>Lama Kerja</th>
</tr></thead><tbody>';
$no =1;
$s = mysql_query ("SELECT * FROM hrd_karyawan  where tipe='1' ORDER BY nip");	
while($data = mysql_fetch_array($s)){
$date2 = $data['tglditerima'];
$date3 = date("Y-m-d");
$lamakerja =  floor(daysBetween($date2, $date3));
$lamakerja2 = floor($lamakerja/365);
$tgllahir 	= datetimes($data['tgllahir'],False,False);
//$lamakerja2 = dateDifference($date2, $date3,'%y Tahun,%m Bulan');
$urutan = $no + 1;
$jabatanlain = $data['jabatanlain'];
echo '
<tr align="left">
<td class="text-center">'.$data['nip'].'</td>
<td>'.$data['nuptk'].'</td>
<td>'.$data['nama'].'</td>
<td>'.$data['kotalahir'].'</td>
<td>'.$tgllahir.'</td>
<td>'.getagama($data['agama']).'</td>
<td>'.getpendidikan($data['pendidikan_terakhir']).'</td>
<td>'.getjabatan($data['jabatan']).'</td>
<td>'.$jabatanlain.'</td>
<td>'.getstatus($data['status']).'</td>
<td>'.$lamakerja2.' Tahun</td>
</tr>';
$no++;
}
echo "</body</html>";

echo "<script language=javascript>
window.print();
</script>";

?>
