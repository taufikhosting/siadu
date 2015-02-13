<?php
/* Links */
define('RLNK',ROOTLNK.'akademik/');
define('IMGR',ROOTLNK.'shared/images/');

/* Database */
define('DBNAME','sister_siadu');

/* System Directory */
define('ROTDIR',ROOTDIR.'akademik/');
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
	
define('APID','aka');
define('ASID',APID.'_');

$th=0;
$APP_TITLE='Akademik';
$APP_HOMETITLE='Mata Pelajaran';
$APP_PLUGIN="flot|tinymce";
$APP_PAGES=Array(
	0=>Array(
		'tileset'=>Array('key'=>'referensi','title'=>'Referensi','slide'=>'1','pos'=>'-980px','tipe'=>5),
		'pages'=>Array(
			app_page('departemen','Departemen','',$APP_COLOR_THEME2[0],''),
			app_page('angkatan','Angkatan','',$APP_COLOR_THEME2[1],''),
			app_page('tahunajaran','Tahun Ajaran','',$APP_COLOR_THEME2[2],''),
			app_page('tingkat','Tingkat','',$APP_COLOR_THEME2[3],''),
			app_page('kelas','Kelas','',$APP_COLOR_THEME2[4],''),
			//app_page('kelompok','Kelompok Siswa','',$APP_COLOR_THEME1[5],''),
			//app_page('tesakademik','Jenis Penilaian Akademik','',$APP_COLOR_THEME2[0],''),
			app_page('semester','Semester','',$APP_COLOR_THEME2[5],''),
			//app_page('kegiatan','Kegiatan Akademik','',$APP_COLOR_THEME2[0],''),
			//app_page('ruang','Ruang Belajar','',$APP_COLOR_THEME2[2],'')
		)
	),
	1=>Array(
		'tileset'=>Array('key'=>'home','title'=>'Kesiswaan','slide'=>'2','pos'=>'0px','tipe'=>2),
		'pages'=>Array(
			app_page('siswa_pendataan','Pendataan Siswa','Mendata siswa aktif per kelas, per angkatan di sekolah.',$APP_COLOR_THEME1[0],'userp.png'),
			//app_page('siswakelas','Siswa Rombel/Kelas','Mendata siswa dalam rombongan belajar/kelas.',$APP_COLOR_THEME1[1],'userg.png'),
			//app_page('penempatan','Penempatan Siswa Angkatan Baru','Menempatkan siswa yang diterima pada kelas.',$APP_COLOR_THEME1[1],'userp.png'),
			//app_page('siswakelompok','Pengelompokan Siswa','Pengelompokan siswa berdasarkan kategori tertentu.',$APP_COLOR_THEME1[2],'userg.png'),
			//app_page('siswaguru','Coaching Siswa','Pengelompokan siswa berdasarkan coach.',$APP_COLOR_THEME1[3],'userg.png'),
			app_page('presensi','Presensi Siswa','Presensi siswa.',$APP_COLOR_THEME1[1],'usercek.png'),
			app_page('nilairapor','Rapor Siswa','Rapor penilaian siswa.',$APP_COLOR_THEME1[3],'book.png'),
			//app_page('rombongan','Rombongan Belajar','Pendataan rombongan belajar siswa.',$APP_COLOR_THEME1[2],'userg.png'),
			//app_page('pelajaran','Pelajaran','Mendata pelajaran yang diajarkan di sekolah.',$APP_COLOR_THEME1[3],'book.png'),
			//app_page('guru','Guru','Mendata guru pengajar pelajaran di sekolah.',$APP_COLOR_THEME1[4],'userp.png'),
			//app_page('jampelajaran','Jam Pelajaran','Mendata pegawai yang menjadi guru mata pelajaran',$APP_COLOR_THEME1[3],'clock.png'),
			//app_page('jadwal','Jadwal Pelajaran','Menyusun jadwal pelajaran.',$APP_COLOR_THEME1[3],'cal.png')
			//app_page('rpp','Rencana Program Pembelajaran','Penyusunan rencana program pembelajaran (RPP)',$APP_COLOR_THEME1[1],'puzzle.png'),
			//app_page('aspekpenilaian','Aspek Penilaian','Mendata aspek penilaian yang digunakan untuk membantu melakukan penilaian',$APP_COLOR_THEME1[$th++],'pencek.png'),
			//app_page('jenispengujian','Jenis-jenis Pengujian','Mendata jenis-jenis pengujian setiap pelajaran',$APP_COLOR_THEME1[$th++],'pencir.png')
			//app_page('grading','Aturan Grading Nilai Rapor Siswa','Grading merupakan huruf mutu yang ditentukan berdasarkan range nilai',$APP_COLOR_THEME1[4],'grade.png'),
			//app_page('perhitungannilai','Aturan Perhitungan Nilai Rapor Siswa','Menyusun aturan perhitungan nilai rapor',$APP_COLOR_THEME1[5],'penbook.png')
			app_page('alumni','Pendataan Alumni','Mendata alumni.',$APP_COLOR_THEME1[2],'userp.png'),
			app_page('mutasi','Pendataan Mutasi Siswa','Mendata siswa yang meninggalkan sekolah.',$APP_COLOR_THEME1[4],'userp.png'),
			//app_page('pelajaran','Pelajaran','Mendata pelajaran yang diajarkan di sekolah.',$APP_COLOR_THEME1[3],'book.png'),
			//app_page('guru','Guru','Mendata guru pengajar pelajaran di sekolah.',$APP_COLOR_THEME1[2],'userp.png'),
			//app_page('kbm','Kegiatan Belajar Mengajar','Mendata kegiatan belajar mengajar.',$APP_COLOR_THEME2[2],'clock.png'),
			//app_page('jadwal','Jadwal Pelajaran','Menyusun jadwal pelajaran.',$APP_COLOR_THEME1[4],'cal.png')
		)
	),
	2=>Array(
		'tileset'=>Array('key'=>'gurudanpelajaran','title'=>'Guru dan Pelajaran','slide'=>'3','pos'=>'980px','tipe'=>2),
		'pages'=>Array(
			app_page('pelajaran','Pelajaran','Mendata pelajaran yang diajarkan di sekolah.',$APP_COLOR_THEME2[0],'book.png'),
			app_page('guru','Guru','Mendata guru pengajar pelajaran di sekolah.',$APP_COLOR_THEME2[1],'userp.png'),
			//app_page('kbm','Kegiatan Belajar Mengajar','Mendata kegiatan belajar mengajar.',$APP_COLOR_THEME2[2],'clock.png'),
			app_page('jadwal','Jadwal Pelajaran','Menyusun jadwal pelajaran.',$APP_COLOR_THEME2[2],'cal.png'),
			app_page('kegiatan','Kegiatan Akademik','Menyusun kegiatan akademik.',$APP_COLOR_THEME2[3],'cal.png'),
			app_page('presensiguru','Presensi Guru','Presensi Guru.',$APP_COLOR_THEME2[4],'usercek.png')
			//app_page('siswa','Pendataan Siswa','Mendata siswa di sekolah','#2694eb','useri.png')
		)
	)
);
$APP_CSLIDE=2;
$APP_TILE_FADE=count($APP_PAGES[0]['pages'])+count($APP_PAGES[1]['pages'])+count($APP_PAGES[2]['pages']);
$APP_PANEL_POS=Array(1=>'1000px',2=>'20px',3=>'-960px');
$APP_CONTROLSCR=array('ctrl_referensi.js','ctrl_siswa.js','ctrl_presensi.js','ctrl_presensiguru.js','ctrl_jadwal.js','ctrl_sks.js','ctrl_alumni.js','ctrl_mutasi.js','ctrl_nilairapor.js');

$APP_CSS.='.presensi_tgl_btn{font:11px '.SFONT.';color:#fff;display:block;text-aign:center;cursor:pointer;border-radius:4px;padding:4px 0px}';
$APP_CSS.='.presensi_tgl_btn:hover{background:#fff;color:#000;font-weight:bold}';
$APP_CSS.='.presensi_btn{'.SFONT12.';color:'.CDARK.';height:24px;width:24px;text-align:center;border-radius:4px;border:1px solid #ccc;cursor:pointer;background:#fff;color:'.CDARK.'}';
$APP_CSS.='.presensi_btn:hover{border:1px solid #99eaff;background:#f0faff}';
$APP_CSS.='.presensi_btn_H{'.SFONT12.';color:'.CDARK.';height:24px;width:24px;text-align:center;border-radius:4px;border:1px solid #fff;cursor:pointer;color:#000;background:#00ff00}';
$APP_CSS.='.presensi_btn_S{'.SFONT12.';color:'.CDARK.';height:24px;width:24px;text-align:center;border-radius:4px;border:1px solid #fff;cursor:pointer;color:#000;background:#ffff00}';
$APP_CSS.='.presensi_btn_I{'.SFONT12.';color:'.CDARK.';height:24px;width:24px;text-align:center;border-radius:4px;border:1px solid #fff;cursor:pointer;color:#000;background:#ff9000}';
$APP_CSS.='.presensi_btn_A{'.SFONT12.';color:'.CDARK.';height:24px;width:24px;text-align:center;border-radius:4px;border:1px solid #fff;cursor:pointer;color:#000;background:#ff0000}';

$APP_CSS.='.jadwal_row td{border:1px solid #999;font:10px '.SFONT.';color:#444;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;cursor:default;}';
$APP_CSS.='.jadwal_row_on td{background:#f1ffef;border:1px solid #00ff00 !important;font:10px '.SFONT.';color:#444;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;cursor:default;}';
$APP_CSS.='.jadwal_row_off td{background:#ddd;border:1px solid #999;font:10px '.SFONT.';color:#444;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;cursor:default;}';
$APP_CSS.='.jadwal_td_in{font:10px '.SFONT.';color:#444;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;cursor:default;background:#ffff00 !important;padding-top:2px;height:28px}';

$APP_CSS.='.jadwal_stock{float:left;width:108px;margin:5px;border:1px solid;border-color:#ddd;background:#ffffff}';
$APP_CSS.='.jadwal_stock_on{float:left;width:108px;margin:5px;border:1px solid;border-color:#00ff00}';
$APP_CSS.='.jadwal_stock_off{float:left;width:108px;margin:5px;border:1px solid;border-color:#ddd;background:#ddd}';

$APP_CSS.='.jadwal_trash{position:absolute;left:30px;bottom:5px;width:60px;height:60px;background:url(\''.IMGR.'trashcan.png\') center no-repeat #eaeaea;border:1px solid #c0c0c0}';
$APP_CSS.='.jadwal_trash_on{position:absolute;left:30px;bottom:5px;width:60px;height:60px;background:url(\''.IMGR.'trashcan.png\') center no-repeat #eaeaea;border:1px solid #00ff00}';
?>