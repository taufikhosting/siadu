<?php

include 'includes/config.php';
include 'includes/mysql.php';
$idkary = int_filter($_GET['idkary']);
$id = int_filter($_GET['id']);
global $koneksi_db,$translateKal,$url_situs;
$hasil = $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan WHERE id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
$jabatan=getjabatan($data['jabatan']);
$departemen=getdepartemen($data['departemen']);
$status=getstatus($data['status']);
$nip  			= $data['nip'];
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM hrd_penggajian WHERE id='$id'" );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$bulan=getbulan($data2['bulan']);
$tahun=$data2['tahun'];
$gajipokok  			= $data2['gajipokok'];
$tstruktural  			= $data2['tstruktural'];
$tfungsional  			= $data2['tfungsional'];
$tpengabdian  			= $data2['tpengabdian'];
$tistrianak  			= $data2['tistrianak'];
$tuangmakan  			= $data2['tuangmakan'];
$tuangtransport  			= $data2['tuangtransport'];
$tbebantugas  			= $data2['tbebantugas'];
$twalikelas  			= $data2['twalikelas'];
$tprestasi  			= $data2['tprestasi'];
$tlain  			= $data2['tlain'];
$thr  			= $data2['thr'];
$pph21  			= $data2['pph21'];
$jamsostek  			= $data2['jamsostek'];
$pterlambat  			= $data2['pterlambat'];
$plain  			= $data2['plain'];
$gajibersih  			= $data2['gajibersih'];
$ppinjaman  			= $data2['ppinjaman'];
$gajibruto =$gajipokok+$tstruktural+$tfungsional+$tpengabdian+$tistrianak+$tuangmakan+$tuangtransport+$tbebantugas+$twalikelas+$tprestasi+$tlain+$thr;
echo "<html><head><title>Slip Gaji NIP $nip</title></head><body>";
echo '<style type="text/css">
.border {
	border			: 1px solid black;
	padding			: 2px;
    margin			: 2px 0 5px 0;
}
.borderbawah {
border-bottom:1px solid black;
	padding			: 2px;
    margin			: 2px 0 5px 0;
}
	th,td {
    padding: 2px;
</style>';
$logoslip="<img src='images/logoslip.png'>";
echo "<table  class='border'>";
echo'<tr ><td colspan="2" align="center" class="borderbawah">'.$logoslip.'</td></tr>';
echo'<tr><td colspan="2" align="center"><h3>SLIP GAJI</h3></td></tr>';
echo "<tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Nama</td><td>:</td><td>$nama</td></tr>";
echo "<tr><td>Bulan</td><td>:</td><td>$bulan</td></tr>";
echo "<tr><td>Tahun</td><td>:</td><td>$tahun</td></tr>";
echo "<tr><td>Departemen</td><td>:</td><td>$departemen</td></tr>";
echo "</table>";
echo "</td></tr><tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Gaji Bruto</td><td>:</td><td></td></tr>";
echo "<tr><td>Gaji Pokok</td><td>:</td><td>".rupiah_format($gajipokok)."</td></tr>";
echo "<tr><td>Tunjangan Struktural</td><td>:</td><td>".rupiah_format($tstruktural)."</td></tr>";
echo "<tr><td>Tunjangan Fungsional</td><td>:</td><td>".rupiah_format($tfungsional)."</td></tr>";
echo "<tr><td>Tunjangan Masa Kerja</td><td>:</td><td>".rupiah_format($tpengabdian)."</td></tr>";
echo "<tr><td>Tunjangan Anak</td><td>:</td><td>".rupiah_format($tistrianak)."</td></tr>";
echo "<tr><td>Uang Makan</td><td>:</td><td>".rupiah_format($tuangmakan)."</td></tr>";
echo "<tr><td>Uang Transport</td><td>:</td><td>".rupiah_format($tuangtransport)."</td></tr>";
echo "<tr><td>Beban Tugas</td><td>:</td><td>".rupiah_format($tbebantugas)."</td></tr>";
echo "<tr><td>Tunjangan Wali Kelas</td><td>:</td><td>".rupiah_format($twalikelas)."</td></tr>";
echo "<tr><td>Tunjangan Reward</td><td>:</td><td>".rupiah_format($tprestasi)."</td></tr>";
echo "<tr><td>Tunjangan Lain-Lain</td><td>:</td><td>".rupiah_format($tlain)."</td></tr>";
echo "<tr><td>THR</td><td>:</td><td>".rupiah_format($thr)."</td></tr>";
echo "</table>";
echo "</td><td valign='top'>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Pengurangan / Potongan</td><td>:</td><td></td></tr>";
echo "<tr><td>PPH21</td><td>:</td><td>".rupiah_format($pph21)."</td></tr>";
echo "<tr><td>Jamsostek</td><td>:</td><td>".rupiah_format($jamsostek)."</td></tr>";
echo "<tr><td>Pot. karena Terlambat</td><td>:</td><td>".rupiah_format($pterlambat)."</td></tr>";
echo "<tr><td>Pot. Pinjaman</td><td>:</td><td>".rupiah_format($ppinjaman)."</td></tr>";
echo "<tr><td>Pot. Lain lain</td><td>:</td><td>".rupiah_format($plain)."</td></tr>";
echo "</table>";
echo "</td></tr>";
echo "</td></tr>";
echo "<tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr><td>Total Gaji Bruto</td><td>:</td><td> ".rupiah_format($gajibruto)."</td>";
echo "</table>";
echo "</td><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr><td>Total Gaji Bersih</td><td>:</td><td> ".rupiah_format($gajibersih)."</td>";
echo "</table>";
echo "</td></tr>";
echo "<tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr align='center'><td>TTD<br><br><br><br>(Pihak Sekolah)</td><td></td><td></td>";
echo "</table>";
echo "</td><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr align='center'><td>Karyawan<br><br><br><br>($nama)</td><td></td><td></td>";
echo "</table>";
echo "</td></tr>";
echo "</table>";
echo "</body</html>";

if (isset($_GET['id'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
