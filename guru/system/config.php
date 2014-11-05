<?php
/* Links */
define('RLNK',ROOTLNK.'guru/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'guru/');
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
require_once(MODDIR.'apps/aka.php');
require_once(MODDIR.'apps/gur.php');
	
define('APID','gur');
define('ASID',APID.'_');

$APP_TITLE='Akademik - Guru';
$APP_HOMETITLE='Penilaian';
$APP_PLUGIN="flot|tinymce";
$APP_PAGES=Array(
	0=>Array(
		'tileset'=>Array('key'=>'Home','title'=>'Home','slide'=>'1','pos'=>'0px','tipe'=>2),
		'pages'=>Array(
			app_page('rpp','Rencana Pembelajaran','Penyusunan rencana pembelajaran.',$APP_COLOR_THEME1[0],'puzzle.png'),
			app_page('penilaian','Penilaian','Jenis-jenis penilaian.',$APP_COLOR_THEME1[1],'file.png'),
			app_page('daftarnilai','Daftar nilai','Daftar nilai siswa.',$APP_COLOR_THEME1[3],'penbook.png'),
			app_page('nilairapor','Nilai rapor','Laporan nilai akhir siswa.',$APP_COLOR_THEME1[2],'book.png'),
			app_page('jurnal','Jurnal Kelas','Jurnal dan agenda mengajar.',$APP_COLOR_THEME1[4],'penbook.png'),
			//app_page('cetakpenilaian','Cetak Form Penilaian','Mencetak form penilaian siswa',$APP_COLOR_THEME1[2],'penbook.png'),
			//app_page('penilaian','Penilaian','Melakukan penilaian siswa',$APP_COLOR_THEME1[3],'pencek.png')
		)
	)
);
$APP_CSLIDE=1;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages'])+count($APP_PAGES[2]['pages']);
$APP_PANEL_POS=Array(1=>'20px');
?>