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
	font		: 100% Arial, Helvetica, sans-serif;
}
th {
    text-align: center;
}
</style>';
$logoslip="<img src='images/logoslip.png'>";
echo "</head><body>";
echo'<div align="left">'.$logoslip.'</div>';
echo'<h3>Laporan Penggajian, Bulan / Tahun : '.$pbulan.' / '.$tahun.'</h3>';
echo '<table class="border">
<thead><tr>
<th>No</th>
<th>Account PaninBank</th>
<th>Nama Rek.Payroll</th>
<th>TKT</th>
<th>Nama</th>
<th>N.P.W.P</th>
<th>Position</th>
<th>Pangkat & Tahun</th>
<th>Status Pegawai</th>
<th>Gaji Pokok</th>
<th>T.Struktural</th>
<th>T.Fungsional</th>
<th>T.Pengabdian</th>
<th>T.Istri/Anak</th>
<th>T.Transport</th>
<th>T.Beban Tugas</th>
<th>T.WaliKelas</th>
<th>T.Khusus</th>
<th>Gaji Bruto</th>
<th>T.Lain-Lain</th>
<th>Total Gaji</th>
<th>Pot.Pinjaman</th>
<th>BPJS</th>
<th>PPH21</th>
<th>Gaji Bersih</th>
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
$tistrianak  = $datas['tistrianak'];
$tuangtransport  = $datas['tuangtransport'];
$tbebantugas  = $datas['tbebantugas'];
$twalikelas  = $datas['twalikelas'];
$tkhusus  = $datas['tkhusus'];
$gajibruto = $datas['gajibruto'];
$tlain  	=	 $datas['tlain'];
$totalgaji = $datas['totalgaji'];
$pph21  	= $datas['pph21'];
$jamsostek  = $datas['jamsostek'];
$ppinjaman  = $datas['ppinjaman'];
$gajibersih = $datas['gajibersih'];
$tkt = $datas['tkt'];
$urutan = $no + 1;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM hrd_karyawan where id='$idkary'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$nama=$data['nama'];
$norek=$data['norek'];
$namarek=$data['namarek'];
$npwp=$data['npwp'];
$golongan=$data['golongan'];
$jabatan=$data['jabatan'];
$status=$data['status'];
$cetak = '<a href="cetak_slip.php?id='.$idphoto.'&idkary='.$idkary.'" target="new"onclick="return confirm(\'Apakah Anda Ingin Mencetak Penggajian Ini ?\')" style="color:blue">Cetak Slip</a>';

echo '
<tr align="left">
<td>'.$no.'</td>
<td>'.$norek.'</td>
<td>'.$namarek.'</td>
<td>'.$tkt.'</td>
<td>'.$nama.'</td>
<td>'.$npwp.'</td>
<td>'.getjabatan($jabatan).'</td>
<td>'.getgolongan($golongan).'</td>
<td>'.getstatus($status).'</td>
<td>'.rupiah_format2($gajipokok).'</td>
<td>'.rupiah_format2($tstruktural).'</td>
<td>'.rupiah_format2($tfungsional).'</td>
<td>'.rupiah_format2($tpengabdian).'</td>
<td>'.rupiah_format2($tistrianak).'</td>
<td>'.rupiah_format2($tuangtransport).'</td>
<td>'.rupiah_format2($tbebantugas).'</td>
<td>'.rupiah_format2($twalikelas).'</td>
<td>'.rupiah_format2($tkhusus).'</td>
<td>'.rupiah_format2($gajibruto).'</td>
<td>'.rupiah_format2($tlain).'</td>
<td>'.rupiah_format2($totalgaji).'</td>
<td>'.rupiah_format2($ppinjaman).'</td>
<td>'.rupiah_format2($jamsostek).'</td>
<td>'.rupiah_format2($pph21).'</td>
<td>'.rupiah_format2($gajibersih).'</td></tr>';
$tgajibersih+=$gajibersih;
$no++;
}
echo '
<tr align="left">
<td colspan="24"><div align="right"><b>Total Gaji&nbsp;</b></div></td>
<td><b>'.rupiah_format2($tgajibersih).'</b></td></tr>';
echo '</table>';
echo "</body</html>";

if (isset($_GET['bulan'])){
echo "<script language=javascript>
window.print();
</script>";
}
?>
