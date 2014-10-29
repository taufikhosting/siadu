<?php

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}
global $maxadmindata;
if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;

$total2 =  $koneksi_db->sql_query( "SELECT * FROM shoutbox" );
$jumlah2 = $koneksi_db->sql_numrows( $total2 );
$admin  ='<h4 class="bg">Administrasi Berita</h4>';
$admin .="<div class='border'><a href='admin.php?pilih=shoutbox&amp;mod=yes'>Home</a>";
$admin .='</div>';

if($_GET['aksi']==""){
if (isset($_POST['submit'])){
$tot     .= $_POST['tot'];
$pcheck ='';
			for($i=1;$i<=$tot;$i++)
			{
				$check = $_POST['check'.$i] ;
				if($check <> "")
				{
					$pcheck .= $check . ",";
				}
			}
$pcheck = substr_replace($pcheck, "", -1, 1);
$error = '';
if ($error){
$admin.='<div class="error">'.$error.'</div>';
}
if ($pcheck)  $sukses .= "Sukses: shoutbox dengan id $pcheck  Telah di hapus !<br />";
$koneksi_db->sql_query("DELETE FROM shoutbox WHERE id in($pcheck)");
if ($sukses){
$admin.='<div class="sukses">'.$sukses.'</div>';
}
}

$admin .= '<div class="border"><b>List Shoutbox </b></div>';
$admin .= '<div class="border">
<form method="get"action="admin.php">
Title/User : <input type="text" name="query" class="textbox" />
<input type="submit" name="submit" class="button" value="Cari" />
<input type="hidden" name="pilih" value="shoutbox" />
<input type="hidden" name="mod" value="yes" />
</form></div>';
$query = $_GET['query'];
$topik = $_GET['topik'];

$limit = $maxadmindata;

if($query){
$total = $koneksi_db->sql_query( "SELECT * FROM shoutbox WHERE isi like '%$query%' or nama like '%$query%' ORDER BY `id` desc");
}
else{
$total = $koneksi_db->sql_query( "SELECT * FROM shoutbox ORDER BY `id`desc");
}
$jumlah = $koneksi_db->sql_numrows( $total );

if (!isset ($_GET['offset'])) {
	$offset = 0;
}

$a = new paging ($limit);
if ($jumlah<1){
$admin.='<div class="error">Tidak Ada shoutbox </div>';
}else{
if($query){
$hasil = $koneksi_db->sql_query( "SELECT * FROM shoutbox WHERE isi like '%$query%' or nama like '%$query%' ORDER BY `id` DESC LIMIT $offset,$limit ");
}else{
$hasil = $koneksi_db->sql_query( "SELECT * FROM shoutbox  ORDER BY `id` DESC LIMIT $offset,$limit");
}
if($offset){
$no = $offset;
}else{
$no = 1;
}
$admin .='<div class="border">';
$admin .="<form method='post' action=''>";
$admin .= '
<table cellspacing="0" style="width:100%">
	<tr bgcolor="#d1d1d1">
	<th style="width:5px;text-align:center;padding:10px 5px 10px 5px;border-left:1px solid #ccc;border-top:1px solid #ccc;">No.</th>
	<th style="width:20%;text-align:center;padding:10px 5px 10px 5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">Waktu</th>
	<th style="width:20%;text-align:center;padding:10px 5px 10px 5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">Nama</th>
	<th style="width:30%;text-align:center;padding:10px 5px 10px 5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">Isi</th>
	<th style="width:30%;text-align:left;padding:10px 5px 10px 5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">Jawab</th>
	<th colspan="2" style="text-align:center;padding:10px 5px 10px0 5px;border-right:1px solid #ccc;border-top:1px solid #ccc;border-left:1px solid #ccc;width:100px;">Aksi</th>
	</tr>';

$no=1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$gambar = $data['gambar'];
$waktu = $data['waktu'];
$nama = $data['nama'];
$isi = $data['isi'];
$jawab = $data['jawab'];
$admin .='
	<tr>
	<td style="text-align:center;padding:5px;border-left:1px solid #ccc;border-top:1px solid #ccc;"><input type=checkbox name=check'.$no.' value='.$data[0].'></td>
	<td style="text-align:left;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">'.$waktu.'</td>
	<td style="text-align:left;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">'.$nama.'</td>
	<td style="text-align:left;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">'.$isi.'</td>
	<td style="text-align:left;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;">'.$jawab.'</td>
	<td style="text-align:center;padding:5px;border-top:1px solid #ccc;border-left:1px solid #ccc;width:5px;"><a href=admin.php?pilih=shoutbox&amp;mod=yes&aksi=delshoutbox&id='.$data[0].'><img src="images/delete.gif"></a></td>
	<td style="text-align:center;padding:5px;border-right:1px solid #ccc;border-top:1px solid #ccc;border-left:1px solid #ccc;width:5px;"> <a href=admin.php?pilih=shoutbox&amp;mod=yes&aksi=editshoutbox&id='.$data[0].'><img src="images/edit.gif"></a></td>
	</tr>';		
$no++;
	}
$admin .="<input type=hidden name='tot' value='$jumlah'>";
$admin .="<tr><td style='text-align:left;padding:5px;border-right:1px solid #ccc;border-top:1px solid #ccc;'></td><td colspan=6 style='text-align:left;padding:5px;border-right:1px solid #ccc;border-top:1px solid #ccc;border-bottom:1px solid #ccc;border-left:1px solid #ccc;width:55px;'><input type='submit' value='delete' name='submit'></td></tr>";
$admin .="</table>";
$admin .="</form>";
$admin .='</div>';
}
if($jumlah>$maxadmindata){
if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
$offset = 0;
}
if (empty($_GET['pg']) and !isset ($_GET['pg'])) {
$pg = 1;
}
if (empty($_GET['stg']) and !isset ($_GET['stg'])) {
$stg = 1;
}
$admin .= '<div class="border"><center>';
$admin .= $a-> getPaging($jumlah, $pg, $stg);
$admin .= '</center></div>';


}

}

if($_GET['aksi']=="editshoutbox"){

$id = int_filter($_GET['id']);

$admin .='<div class="border">';
$admin .='<b>Menjawab Shoutbox dengan Id = '.$id.'</b>';
$admin .='</div>';

if (isset($_POST['submit'])) {
$isi 		= $_POST['isi'];
$jawab 		= $_POST['jawab'];
$error = '';
if (!$jawab) $error .= "Error: Harap isi Jawaban!<br />";
if ($error){
$admin.='<div class="error">'.$error.'</div>';
}else{

$hasil = $koneksi_db->sql_query( "UPDATE shoutbox SET isi='$isi', jawab='$jawab' WHERE id='$id'" );
$admin.='<div class="sukses"><b>Shoutbox Berhasil di Update.</b></div>';
}
}
$isi 		= !isset($isi) ? '' : $isi;
$jawab	= !isset($jawab) ? '' : $jawab;

$hasil = $koneksi_db->sql_query( "SELECT * FROM shoutbox WHERE id=$id" );
$data = $koneksi_db->sql_fetchrow($hasil);
$waktu  	= $data['waktu'];
$nama    	= $data['nama'];
$isi   = $data['isi'];
$ket  = $data['ket'];
$jawab  = $data['jawab'];
$admin .='<div class="border">';
$admin .='
<form method="post" action="" id="posts">
    <label><b>Waktu</b></label><br />'.$waktu.'<br />
    <label><b>Nama</b></label><br />'.$nama.'<br />
	<label><b>Keterangan</b></label><br />'.$ket.'<br />
    <label><b>Isi</b></label><br /><textarea rows="10" cols="40" name="isi">'.$isi.'</textarea><br />
    <label><b>Jawab</b></label><br /><textarea rows="10" cols="40" name="jawab">'.$jawab.'</textarea><br /><br />
    <input type="submit" name="submit" value="Edit">
</form>   ';
$admin .='</div>';

}













echo $admin;
?>