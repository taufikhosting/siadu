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
$golongan=getgolongan($data['golongan']);
$nip  			= $data['nip'];
$norek  			= $data['norek'];
$namarek  			= $data['namarek'];
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM hrd_penggajian WHERE id='$id'" );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$bulan=getbulan($data2['bulan']);
$tahun=$data2['tahun'];
$gajipokok  			= $data2['gajipokok'];
$tstruktural  			= $data2['tstruktural'];
$tfungsional  			= $data2['tfungsional'];
$tpengabdian  			= $data2['tpengabdian'];
$tistrianak  			= $data2['tistrianak'];
$tuangtransport  			= $data2['tuangtransport'];
$tbebantugas  			= $data2['tbebantugas'];
$twalikelas  			= $data2['twalikelas'];
$tkhusus  			= $data2['tkhusus'];
$tlain  			= $data2['tlain'];
$ppinjaman  			= $data2['ppinjaman'];
$jamsostek  			= $data2['jamsostek'];
$pph21  			= $data2['pph21'];
$gajibruto  			= $data2['gajibruto'];
$totalgaji  			= $data2['totalgaji'];
$gajibersih  			= $data2['gajibersih'];
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
	font		: 120% Arial, Helvetica, sans-serif;
	}
</style>';
$logoslip="<img src='images/logoslip.png'>";
echo "<table  class='border'>";
echo'<tr ><td colspan="2" align="center" class="borderbawah">'.$logoslip.'</td></tr>';
echo'<tr><td colspan="2" align="center"><h3>SLIP GAJI</h3></td></tr>';
echo "<tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Nama</td><td>:</td><td>$nama</td></tr>";
echo "<tr><td>Bulan, Tahun</td><td>:</td><td>$bulan, $tahun</td></tr>";
echo "<tr><td class='borderbawah'>Departemen</td><td class='borderbawah'>:</td><td class='borderbawah'>$departemen</td></tr>";
echo "</table>";
echo "</td><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Jabatan</td><td>:</td><td>$jabatan</td></tr>";
echo "<tr><td>Status Pegawai</td><td>:</td><td>$status</td></tr>";
echo "<tr><td class='borderbawah'></td><td class='borderbawah'>&nbsp;</td><td class='borderbawah'></td></tr>";
echo "</table>";
echo "</td></tr><tr><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td>Gaji Pokok</td><td>:</td><td>".rupiah_format($gajipokok)."</td></tr>";
if($tstruktural){
echo "<tr><td>Tunjangan Struktural</td><td>:</td><td>".rupiah_format($tstruktural)."</td></tr>";
}
if($tfungsional){
echo "<tr><td>Tunjangan Fungsional</td><td>:</td><td>".rupiah_format($tfungsional)."</td></tr>";
}
if($tpengabdian){
echo "<tr><td>Tunjangan Pengabdian</td><td>:</td><td>".rupiah_format($tpengabdian)."</td></tr>";
}
if($tistrianak){
echo "<tr><td>Tunjangan Istri/Anak</td><td>:</td><td>".rupiah_format($tistrianak)."</td></tr>";
}
if($tuangtransport){
echo "<tr><td>Tunjangan Transport</td><td>:</td><td>".rupiah_format($tuangtransport)."</td></tr>";
}
if($tbebantugas){
echo "<tr><td>Beban Tugas</td><td>:</td><td>".rupiah_format($tbebantugas)."</td></tr>";
}
if($twalikelas){
echo "<tr><td>Tunjangan WaliKelas</td><td>:</td><td>".rupiah_format($twalikelas)."</td></tr>";
}
if($tkhusus){
echo "<tr><td>Tunjangan Khusus</td><td>:</td><td>".rupiah_format($tkhusus)."</td></tr>";
}
if($tlain){
echo '<tr><td class="borderbawah"><b>Gaji Bruto</b></td><td class="borderbawah">:</td><td class="borderbawah">'.rupiah_format($gajibruto).'</td></tr>';}
else{
echo '<tr><td><b>Gaji Bruto</b></td><td>:</td><td>'.rupiah_format($gajibruto).'</td></tr>';
}
if($tlain){
echo "<tr><td>Tunjangan Lain-Lain</td><td>:</td><td>".rupiah_format($tlain)."</td></tr>";
}
echo "</table>";
echo "</td><td valign='top'>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo "<tr><td><b>Pengurangan / Potongan</b></td><td></td><td></td></tr>";
if($ppinjaman){
echo "<tr><td>Potongan Pinjaman</td><td>:</td><td>".rupiah_format($ppinjaman)."</td></tr>";
}
if($pph21){
echo "<tr><td>PPH21</td><td>:</td><td>".rupiah_format($pph21)."</td></tr>";
}
if($jamsostek){
echo "<tr><td>BPJS</td><td>:</td><td>".rupiah_format($jamsostek)."</td></tr>";
}

echo "</table>";
echo "</td></tr>";
echo "</td></tr>";
echo "<tr><td>";
echo "
<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo '<tr><td  class="borderbawah"></td><td class="borderbawah"></td><td class="borderbawah"></td></tr>';
echo "<tr><td><b>Total Gaji</td><td>:</td><td> ".rupiah_format($totalgaji)."</b></td>";
echo "</table>";
echo "</td><td>";
echo "<table align=\"left\" width='100%' cellspacing=\"1\" cellpadding=\"4\">";
echo '<tr><td class="borderbawah"></td><td class="borderbawah"></td><td class="borderbawah"></td></tr>';
echo "<tr><td><b>Take Home Pay</td><td>:</td><td> ".rupiah_format($gajibersih)."</b></td>";
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
