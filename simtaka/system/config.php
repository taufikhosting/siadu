<?php
/* Links */
define('RLNK',ROOTLNK.'sarpras/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPSWD','admin');
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'sarpras/');
define('SYSDIR',ROTDIR.'system/');

/* Apps Directory */
define('APPDIR',SYSDIR.'apps/');

/* Libraries Directory */
define('LIBDIR',SHAREDLIB);
define('MODDIR',LIBDIR.'modules/');

/* Views Directory */
define('VWDIR',SYSDIR.'views/');

/* Resources Directory */
define('IMGDIR',ROTDIR.'images/');
define('FILEDIR',ROTDIR.'upload/');
define('FOTODIR',ROTDIR.'photo/');

/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'apps/sar.php'); // 

define('APID','sar');
define('ASID',APID.'_');

$APP_HOMETITLE='Home';
$APP_TITLE='Sarana Prasarana';
$APP_PLUGIN="flot|flot_pie|tinymce";
$APP_PAGES=Array(
	0=>Array(
		'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
		'pages'=>Array(
			app_page('inventaris','Inventaris','Mengelola inventaris sarana prasarana',$APP_COLOR_THEME1[0],'dbox.png'),
			app_page('aktivitas','Aktivitas','Mencatat aktivitas penting terkait sarana prasarana',$APP_COLOR_THEME1[1],'cal.png'),
			app_page('peminjaman','Peminjaman','Mencatat sirkulasi peminjaman barang',$APP_COLOR_THEME1[2],'bout.png'),
			app_page('pengembalian','Pengembalian','Mencatat sirkulasi pengembalian barang',$APP_COLOR_THEME1[3],'bin.png'),
			app_page('pencarian','Pencarian Barang','',$APP_COLOR_THEME1[4],'search.png',3),
			app_page('yyy','Statistik Aset Sarana Prasarana','',$APP_COLOR_THEME1[5],'stats.png',3)
		)
	),
	1=>Array(
		'tileset'=>Array('key'=>'referensi','title'=>'Referensi','slide'=>2,'pos'=>'980px','tipe'=>5),
		'pages'=>Array(
			app_page('klasifikasi','Klasifikasi','',$APP_COLOR_THEME2[0],''),
			app_page('lokasi','Lokasi','',$APP_COLOR_THEME2[0],''),
			app_page('tempat','Tempat','',$APP_COLOR_THEME2[1],''),
			app_page('jenis','Jenis Barang','',$APP_COLOR_THEME2[2],'')
		)
	)
);
$APP_CSLIDE=1;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages']);
$APP_PANEL_POS=Array(1=>'20px',2=>'-960px');
$APP_CSS='#pendataan_dps .xlabel{width:140px;float:left}';
?>