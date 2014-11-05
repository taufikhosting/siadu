<?php
/* Links */
define('RLNK',ROOTLNK.'keuangan/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBNAME','josh');

/* System Directory */
define('ROTDIR',ROOTDIR.'keuangan/');
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
//require_once(MODDIR.'apps/aka_tingkat.php');
require_once(MODDIR.'apps/keu.php');

define('APID','keu');
define('ASID',APID.'_');

$APP_TITLE     ='Keuangan';
$APP_HOMETITLE ='Pembayaran Siswa';
$APP_PLUGIN    ="flot|flot_pie|tinymce";
$APP_PAGES=Array(
	0=>Array(
		'tileset'=>Array('key'=>'referensi','title'=>'Referensi','slide'=>'1','pos'=>'-980px','tipe'=>1),
		'pages'=>Array(
			app_page('tahunbuku','Tahun Buku','',$APP_COLOR_THEME2[0],''),
			app_page('rekening','Kode Rekening','',$APP_COLOR_THEME2[1],''),
			app_page('budget','Anggaran','',$APP_COLOR_THEME2[2],'')
		)
	),
	1=>Array(
		'tileset'=>Array('key'=>'administrasiakademik','title'=>'Transaksi Keuangan','slide'=>'2','pos'=>'0px','tipe'=>2),
		'pages'=>Array(
			app_page('transaksi','Transaksi','Transaksi keuangan dan akuntansi.',$APP_COLOR_THEME1[0],'penbook.png'),
			app_page('modul','Modul Pembayaran','Membuat modul pembayaran administrasi siswa dan calon siswa.',$APP_COLOR_THEME1[1],'book.png'),
			//app_page('modultransaksi','Pembayaran Siswa dan Calon Siswa','Mendata Transaksi pembayaran.',$APP_COLOR_THEME1[3],'penbook.png'),
			app_page('modul_psb','Pembayaran Pendaftaran','Mendata pembayaran biaya pendaftaran calon siswa.',$APP_COLOR_THEME1[3],'penbook.png'),
			app_page('modul_usp','Pembayaran Uang Pangkal','Mendata pembayaran uang pangkal siswa.',$APP_COLOR_THEME1[2],'penbook.png'),
			app_page('modul_spp','Pembayaran Uang Sekolah','Mendata pembayaran uang sekolah siswa perbulan.',$APP_COLOR_THEME1[4],'penbook.png'),
			app_page('invent','Inventory','Mendata barang inventory.',$APP_COLOR_THEME1[5],'dbox.png')
		)
	)/*,
	2=>Array(
		'tileset'=>Array('key'=>'akuntansi','title'=>'Transaksi dan Laporan Keuangan','slide'=>'3','pos'=>'980px','tipe'=>2),
		'pages'=>Array(
		)
	)*/
);
$APP_CSLIDE=2;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages']);//+count($APP_PAGES[2]['pages']);//+count($APP_PAGES[3]['pages']);
$APP_PANEL_POS=Array(1=>'1000px',2=>'20px',3=>'-960px',4=>'-1940px');
$APP_CONTROLSCR=array('controller_x.js','ctrl_inventory.js','ctrl_inventory_sarpras.js');
$APP_CSS="
.xtree_folder0{position:relative;float:left;height:12px;width:244px;border-radius:5px;padding:7px 0px 11px 36px;background:url('".IMGR."fol1.png?aa') left center no-repeat;font:12px ".SFONT.";font-weight:bold;cursor:default;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;}
.xtree_folder1{position:relative;float:left;height:12px;width:244px;border-radius:5px;padding:7px 0px 11px 36px;background:url('".IMGR."fol2.png?aa') left center no-repeat;font:12px ".SFONT.";font-weight:bold;cursor:default;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;}

.xtree_folder_info{float:right;height:14px;margin-right:2px;padding:1px 6px;border-radius:8px;background:rgba(0,0,0,0.4);font:11px ".SFONT.";color:#fff}
.xtree_folder_opt{position:absolute;top:3px;right:2px;cursor:default}

.xtree_file0{position:relative;float:left;margin-left:20px;height:12px;width:240px;border-radius:5px;padding:7px 0px 11px 20px;background:url('".IMGR."boxsmall2.png?aa') 2px center no-repeat;font:12px ".SFONT.";font-weight:bold;cursor:default;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;}
.xtree_file1{position:relative;float:left;margin-left:20px;height:12px;width:240px;border-radius:5px;padding:7px 0px 11px 20px;background:url('".IMGR."boxsmall2.png?aa') 2px center no-repeat;background-color:#eaeaea;font:12px ".SFONT.";font-weight:bold;cursor:default;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;}

.xtree_file_opt{position:absolute;top:3px;right:2px;cursor:default;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;}


.xtree_folder0:hover, .xtree_folder1:hover, .xtree_file0:hover {background-color:#eaeaea}
.xtree_folder0:active, .xtree_folder1:active, .xtree_file0:active, .xtree_file1:active{background-color:#eaeaea}

.xtree_folder1:hover .xtree_folder_opt{display:visible !important}
";
?>