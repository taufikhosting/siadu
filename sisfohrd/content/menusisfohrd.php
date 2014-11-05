<?php
global $koneksi_db;
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= aura_login ();
}
if (cek_login ()){

$username	= $_SESSION['UserName'];
$levelakses = $_SESSION['LevelAkses'];

if ($levelakses=="Administrator"){
echo '<div class="border2">
<table width="100%"><tr align="center">
<td>
<a href="admin.php"><img src="images/home.jpg" width="50px"><br>HOME</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=mnmaster&mod=yes"><img src="images/master.jpg" width="50px"><br>MASTER</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=mnkaryawan&mod=yes"><img src="images/karyawan.jpg" width="50px"><br>KARYAWAN</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=kelengkapanberkas&mod=yes"><img src="images/berkas.jpg" width="50px"><br>BERKAS</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=historykaryawan&mod=yes"><img src="images/history.jpg" width="50px"><br>HISTORY</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=absensi&mod=yes"><img src="images/absensi.jpg" width="50px"><br>ABSENSI</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=cuti&mod=yes"><img src="images/cuti.jpg" width="50px"><br>CUTI</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=mnpenggajian&mod=yes"><img src="images/penggajian.jpg" width="50px"><br>PENGGAJIAN</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=pinjaman&mod=yes"><img src="images/pinjaman.jpg" width="50px"><br>PINJAMAN</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=user&mod=yes"><img src="images/departemen.jpg" width="50px"><br>USER</a>&nbsp;&nbsp;
</td>
<td>
<a href="admin.php?pilih=settingwebsite&mod=yes"><img src="images/password.jpg" width="50px"><br>PASSWORD</a>&nbsp;&nbsp;
</td>
<td>
<a href="index.php?aksi=logout"><img src="images/logout.jpg" width="50px"><br>KELUAR</a>&nbsp;&nbsp;
</td>
</tr></table>
</div>';
}
echo $login;
}
?>