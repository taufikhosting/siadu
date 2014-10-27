<?php
/* Links */
define('RLNK',ROOTLNK.'perpustakaan/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'perpustakaan/');
define('SYSDIR',ROTDIR.'system/');

/* Apps Directory */
define('APPDIR',SYSDIR.'apps/');

/* Libraries Directory */
define('LIBDIR',SHAREDLIB);
define('MODDIR',LIBDIR.'modules/');
define('APPMOD',MODDIR.'apps/');

/* Views Directory */
define('VWDIR',SYSDIR.'views/');

/* Resources Directory */
define('IMGDIR',ROTDIR.'images/');
define('FILEDIR',ROTDIR.'upload/');
define('FOTODIR',ROTDIR.'photo/');
define('IMGC',ROTDIR.'cover/');

/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'apps/pus.php');

define('APID','pus');
define('ASID',APID.'_');
$admin = admin_get();

$APP_HOMETITLE='Home';
$APP_TITLE='Perpustakaan';
$APP_PLUGIN="flot|flot_pie|tinymce";
if($admin['bahasa']=='en'){
	$APP_PAGES=Array(
		0=>Array(
			'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
			'pages'=>Array(
				app_page('katalog','Catalog','Kataloging buku perpustakaan.',$APP_COLOR_THEME1[0],'book.png'),
				app_page('daftarbuku','Book List','Daftar semua buku perpustakaan.',$APP_COLOR_THEME1[1],'penbook.png'),
				app_page('peminjaman','Peminjaman','Mencatat sirkulasi peminjaman.',$APP_COLOR_THEME1[2],'bout.png')
				//app_page('pengembalian','Pengembalian','Mencatat sirkulasi pengembalian barang',$APP_COLOR_THEME1[3],'bin.png'),
				//app_page('pencarian','Pencarian Barang','',$APP_COLOR_THEME1[4],'search.png',3),
				//app_page('yyy','Statistik Aset Sarana Prasarana','',$APP_COLOR_THEME1[5],'stats.png',3)
			)
		),
		1=>Array(
			'tileset'=>Array('key'=>'master','title'=>'Master','slide'=>2,'pos'=>'980px','tipe'=>5),
			'pages'=>Array(
				app_page('perpustakaan','Perpustakaan','',$APP_COLOR_THEME2[0],''),
				app_page('rakbuku','Rak Buku','',$APP_COLOR_THEME2[1],''),
				app_page('klasifikasi','Klasifikasi','',$APP_COLOR_THEME2[2],''),
				app_page('pengarang','Pengarang','',$APP_COLOR_THEME2[3],''),
				app_page('penerbit','Penerbit','',$APP_COLOR_THEME2[4],''),
				app_page('bahasa','Bahasa','',$APP_COLOR_THEME2[5],''),
				app_page('satuan','Satuan','',$APP_COLOR_THEME2[0],''),
				app_page('jenisbuku','Jenis Buku','',$APP_COLOR_THEME2[1],''),
				//app_page('tingkatbuku','Tingkat','',$APP_COLOR_THEME2[2],''),
				//app_page('dendabuku','Denda Buku','',$APP_COLOR_THEME2[3],''),
				app_page('harilibur','Hari Libur','',$APP_COLOR_THEME2[4],'')
			)
		)
	);
} else {
	$APP_PAGES=Array(
		0=>Array(
			'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
			'pages'=>Array(
				app_page('katalog','Katalog','Kataloging koleksi perpustakaan.',$APP_COLOR_THEME1[0],'book.png'),
				app_page('daftarbuku','Daftar Koleksi','Daftar semua koleksi perpustakaan',$APP_COLOR_THEME1[1],'penbook.png'),
				app_page('member','Data Anggota','Pendataan anggota perpustakaan.',$APP_COLOR_THEME1[3],'userg.png'),
				app_page('sirkulasi','Sirkulasi','Mencatat sirkulasi koleksi perpustakaan.',$APP_COLOR_THEME1[2],'binout.png'),
				//app_page('peminjaman','Peminjaman','Mencatat sirkulasi peminjaman.',$APP_COLOR_THEME1[2],'bout.png'),
				//app_page('pengembalian','Pengembalian','Mencatat sirkulasi pengembalian.',$APP_COLOR_THEME1[3],'bin.png'),
				app_page('stocktake','Stock Opname','Melakukan kegiatan stock opname.',$APP_COLOR_THEME1[4],'penbook.png'),
				//app_page('opac','Opac','Mencetak label koleksi.',$APP_COLOR_THEME1[5],'print.png')
				// app_page($k,$t,$d='',$s='#68c010',$c='',$p=0,$b='std')
				app_page('opac','OPAC','',$APP_COLOR_THEME1[5],'opac.png',3,'window.open(\'opac.php\',\'_blank\');')
				//app_page('statistik','Statistik perpustakaan','',$APP_COLOR_THEME1[6],'stats.png')
				//app_page('pengembalian','Pengembalian','Mencatat sirkulasi pengembalian barang',$APP_COLOR_THEME1[3],'bin.png'),
				//app_page('pencarian','Pencarian Barang','',$APP_COLOR_THEME1[4],'search.png',3),
				//app_page('yyy','Statistik Aset Sarana Prasarana','',$APP_COLOR_THEME1[5],'stats.png',3)
			)
		),
		1=>Array(
			'tileset'=>Array('key'=>'master','title'=>'Master','slide'=>2,'pos'=>'980px','tipe'=>5),
			'pages'=>Array(
				app_page('tools','Perangkat','Pengaturan Format nomor ID, barkode item dan cetak label.',$APP_COLOR_THEME2[0],''),
				app_page('lokasi','Lokasi','',$APP_COLOR_THEME2[1],''),
				//app_page('rakbuku','Rak Buku','',$APP_COLOR_THEME2[1],''),
				app_page('tingkatbuku','Tingkat Koleksi','',$APP_COLOR_THEME2[2],''),
				app_page('jenisbuku','Jenis Koleksi','',$APP_COLOR_THEME2[3],''),
				app_page('klasifikasi','Klasifikasi','',$APP_COLOR_THEME2[4],''),
				app_page('pengarang','Daftar Pengarang','',$APP_COLOR_THEME2[5],''),
				app_page('penerbit','Daftar Penerbit','',$APP_COLOR_THEME2[0],''),
				app_page('bahasa','Daftar Bahasa','',$APP_COLOR_THEME2[1],''),
				app_page('satuan','Satuan Mata Uang','',$APP_COLOR_THEME2[2],''),
				//app_page('dendabuku','Denda Buku','',$APP_COLOR_THEME2[3],''),
				//app_page('harilibur','Hari Libur','',$APP_COLOR_THEME2[1],'')
			)
		)
	);
}
$APP_CSLIDE=1;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages']);
$APP_PANEL_POS=Array(1=>'20px',2=>'-960px');
$APP_CSS='#pendataan_dps .xlabel{width:140px;float:left} .katalog_box{margin-top:-1px;margin-left:-1px;border:1px solid #b2b2b2;background:#f9f9ff;height:250px;width:100%;} .katalog_box:hover{border:1px solid #37a8ff;box-shadow:0px 1px 4px rgba(0,0,0,0.4);}';
$APP_CONTROLSCR=array('ctrl_sirkulasi.js','ctrl_stocktake.js','ctrl_tools.js');
?>