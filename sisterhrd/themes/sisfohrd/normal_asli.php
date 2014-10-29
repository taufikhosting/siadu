<?php
if(preg_match('/'.basename(__FILE__).'/',$_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
global $koneksi_db,$maxdata,$maxkonten,$maxgalleri,$maxadmindata;
$tengah='';
// Headline Lainnya =========================
$tengah .='<h4 class="bg">Tentang Kami</h4>';
$tengah .= '<table class="border" width="100%">';
$no =0;
$s = mysql_query ("SELECT * FROM `halaman` WHERE seftitle ='promo'");	
while($data = mysql_fetch_array($s)){
$id = $data['id'];
$judul = $data['judul'];
$konten = $data['konten'];

$tengah .= '<tr><td valign="top">'.$konten.'</td></tr>';
}
$tengah .= '</table>';

///////////////////////////
$hasil = $koneksi_db->sql_query( "SELECT * FROM topik WHERE topik='selebriti'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$topik = $data['topik'];
$topikid = $data['id'];
$tengah .='<h4 class="bg">'.$topik.'</h4>';
$tengah .= '<table class="border" width="100%"><tr><td>';

$query = $koneksi_db->sql_query( "SELECT * FROM artikel WHERE topik in($topikid) and publikasi=1 ORDER BY id DESC LIMIT 0,1" );
$no = 0;
while ($datas = $koneksi_db->sql_fetchrow($query)) {
$oleh = $datas['user'];
$id = $datas['id'];
$judul = $datas['judul'];
$tgl 	= $datas['tgl'];
$hits 	= $datas['hits'];
$seftitle 	= $datas['seftitle'];
$gambar = ($datas['gambar'] == '') ? '<img style="float:left; margin-right:10px; border:1px solid #dddddd;" src="mod/news/images/normal/news-default.jpg"height="60"width="80" title="'.$datas['judul'].'" />' : '<img style="float:left; margin-right:10px; border:1px solid #dddddd;" src="mod/news/images/normal/'.$datas['gambar'].'"height="60"width="80" title="'.$datas['judul'].'" />';
$tengah .= '<div class="date">'.datetimes($tgl).'</div>
<h4><a href="article-'.$seftitle.'.html" title="'.$judul.'">'.$datas['judul'].'</a></h4>
'.$gambar.''.limitTXT(strip_tags($datas[2]),280).'';
}
$tengah .='<div class="box"><ul>';
$query = $koneksi_db->sql_query( "SELECT * FROM artikel WHERE topik in($topikid) and publikasi=1 ORDER BY id DESC LIMIT 1,3" );
$no = 0;
while ($datas = $koneksi_db->sql_fetchrow($query)) {
$id = $datas['id'];
$judul = $datas['judul'];
$konten = $datas['konten'];
$hits 	= $datas['hits'];
$seftitle 	= $datas['seftitle'];

$tengah .= '<li><a href="article-'.$seftitle.'.html"  title ="'.limitTXT(strip_tags($konten),280).'">'.$datas['judul'].'</a></li>';
}
$tengah .='</ul></div>';
$tengah .='</div></td></tr></table>';

///////////////////////////
///////////////////////////
$hasil = $koneksi_db->sql_query( "SELECT * FROM topik WHERE topik='hukum'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$topik = $data['topik'];
$topikid = $data['id'];
$tengah .='<h4 class="bg">'.$topik.'</h4>';
$tengah .= '<table class="border" width="100%"><tr><td>';

$query = $koneksi_db->sql_query( "SELECT * FROM artikel WHERE topik in($topikid) and publikasi=1 ORDER BY id DESC LIMIT 0,1" );
$no = 0;
while ($datas = $koneksi_db->sql_fetchrow($query)) {
$oleh = $datas['user'];
$id = $datas['id'];
$judul = $datas['judul'];
$tgl 	= $datas['tgl'];
$hits 	= $datas['hits'];
$seftitle 	= $datas['seftitle'];
$gambar = ($datas['gambar'] == '') ? '<img style="float:left; margin-right:10px; border:1px solid #dddddd;" src="mod/news/images/normal/news-default.jpg"height="60"width="80" title="'.$datas['judul'].'" />' : '<img style="float:left; margin-right:10px; border:1px solid #dddddd;" src="mod/news/images/normal/'.$datas['gambar'].'"height="60"width="80" title="'.$datas['judul'].'" />';
$tengah .= '<div class="date">'.datetimes($tgl).'</div>
<h4><a href="article-'.$seftitle.'.html" title="'.$judul.'">'.$datas['judul'].'</a></h4>
'.$gambar.''.limitTXT(strip_tags($datas[2]),280).'';
}
$tengah .='<div class="box"><ul>';
$query = $koneksi_db->sql_query( "SELECT * FROM artikel WHERE topik in($topikid) and publikasi=1 ORDER BY id DESC LIMIT 1,3" );
$no = 0;
while ($datas = $koneksi_db->sql_fetchrow($query)) {
$id = $datas['id'];
$judul = $datas['judul'];
$konten = $datas['konten'];
$hits 	= $datas['hits'];
$seftitle 	= $datas['seftitle'];

$tengah .= '<li><a href="article-'.$seftitle.'.html"  title ="'.limitTXT(strip_tags($konten),280).'">'.$datas['judul'].'</a></li>';
}
$tengah .='</ul></div>';
$tengah .='</div></td></tr></table>';

///////////////////////////
echo $tengah;
?>