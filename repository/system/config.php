<?php
/* Links */
define('RLNK',ROOTLNK.'repository/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPSWD','admin');
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'repository/');
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
	
define('APID','rep');
define('ASID',APID.'_');

$APP_TITLE='Repository';
$APP_HOMETITLE='Home';
$APP_PLUGIN="";
if(admin_isadministrator()){
	$APP_PAGES=Array(
		0=>Array(
			'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
			'pages'=>Array(
				app_page('file','File','Upload dan mengatur file dalam repository untuk dibagikan ke grup',$APP_COLOR_THEME1[0],'file.png'),
				app_page('grup','Grup','Atur anggota grup dan hak akses dalam grup',$APP_COLOR_THEME1[1],'userg.png')
			)
		)
	);
} else {
	$APP_PAGES=Array(
		0=>Array(
			'tileset'=>Array('key'=>'home','title'=>'Home','slide'=>1,'pos'=>'0px','tipe'=>2),
			'pages'=>Array(
				app_page('file','File','Upload dan mengatur file dalam repository untuk dibagikan ke grup',$APP_COLOR_THEME1[0],'file.png'),
			)
		)
	);
}
$APP_CSLIDE=1;
$APP_TILE_FADE=2;
$APP_PANEL_POS=Array(1=>'20px');
?>