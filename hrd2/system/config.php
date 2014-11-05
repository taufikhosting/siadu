<?php
/* Links */
define('RLNK',ROOTLNK.'hrd2/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'hrd2/');
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

/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'apps/hrd.php');

define('APID','hrd');
define('ASID',APID.'_');

$APP_TITLE='Kepegawaian';
$APP_PLUGIN="flot|tinymce";
$APP_PAGES=Array(
	0=>Array(
		'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
		'pages'=>Array(
			app_page('pegawai','Pendataan Pegawai','Melakuan pendataan pegawai',$APP_COLOR_THEME1[0],'userp.png'),
			app_page('training','Training','Pendataan training yang telah diselenggarakan',$APP_COLOR_THEME2[4],'penbook.png'),
			app_page('reminder','Reminder','',CPURPLE,'info32.png',100,'tile1'),
			app_page('laporan','Laporan','Membuat laporan kepegawaian',CTBLUE1,'penbook.png',100,'tile2'),
			app_page('statistik','Statistik Pegawai','',CGREEN1,'stats.png',100,'tile3')
		)
	),
	1=>Array(
		'tileset'=>Array('key'=>'referensi','title'=>'Referensi','slide'=>2,'pos'=>'980px','tipe'=>5),
		'pages'=>Array(
			app_page('status','Status Pegawai','',$APP_COLOR_THEME2[0],''),
			app_page('tingkat','Tingkat Pegawai','',$APP_COLOR_THEME2[1],''),
			app_page('bagian','Divisi Pegawai','',$APP_COLOR_THEME2[2],''),
			app_page('kelompok','Kelompok Pegawai','',$APP_COLOR_THEME2[3],''),
			app_page('posisi','Posisi Pegawai','',$APP_COLOR_THEME2[4],'')
			//app_page('dokumen','Dokumen','',$APP_COLOR_THEME2[5],''),
			//app_page('keluarga','Keluarga','',$APP_COLOR_THEME2[0],''),
			//app_page('marital','Status Pernikahan','',$APP_COLOR_THEME2[1],''),
			//app_page('jenistraining','Jenis Training','',$APP_COLOR_THEME2[2],'')
		)
	)
);

$APP_CSLIDE=1;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages']);
$APP_PANEL_POS=Array(1=>'20px',2=>'-960px');
$APP_CONTROLSCR=array('ctrl_pegawai.js');
?>