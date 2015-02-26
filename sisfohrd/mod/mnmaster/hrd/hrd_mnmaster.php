<?php

if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}


$admin  .='<legend>MASTER</legend>';

if($_GET['aksi']==""){
$admin .= '<div align="center">
<table width="50%" class="border3">
<tr align="center">
<td>
<a href="admin.php?pilih=agama&mod=yes">
<img src="images/agama.jpg" width="50px"><br>
</a></td>
<td>
<a href="admin.php?pilih=pendidikan&mod=yes">
<img src="images/pendidikan.jpg" width="50px"><br>
</a></td>
<td>
<a href="admin.php?pilih=departemen&mod=yes">
<img src="images/departemen.jpg" width="50px"><br>
</a></td>
<td>
<a href="admin.php?pilih=jabatan&mod=yes">
<img src="images/jabatan.jpg" width="50px"><br>
</a></td>
<td>
<a href="admin.php?pilih=statuskaryawan&mod=yes">
<img src="images/status.jpg" width="50px"><br>
</a></td>
</tr>
<tr align="center">
<td>
<a href="admin.php?pilih=agama&mod=yes"><br>AGAMA
</a></td>
<td>
<a href="admin.php?pilih=pendidikan&mod=yes"><br>PENDIDIKAN
</a></td>
<td>
<a href="admin.php?pilih=departemen&mod=yes"><br>DEPARTEMEN
</a></td>
<td>
<a href="admin.php?pilih=jabatan&mod=yes"><br>JABATAN
</a></td>
<td>
<a href="admin.php?pilih=statuskaryawan&mod=yes"><br>STATUS KARYAWAN
</a></td>
</tr>
</table></div><br><br>
';
}
echo $admin;

?>