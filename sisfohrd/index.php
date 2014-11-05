<?php
/**
 * Teamworks v2.3
 * http://www.teamworks.co.id
 * December 03, 2007 07:29:56 AM 
 * Author: Teamworks Creative - reky@teamworks.co.id - +6285732037068 - pin 25b7edd4
 */
	class microTimer {
    function start() {
        global $starttime;
        $mtime = microtime ();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $starttime = $mtime;
    }
    function stop() {
        global $starttime;
        $mtime = microtime ();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $endtime = $mtime;
        $totaltime = round (($endtime - $starttime), 5);
        return $totaltime;
    }
}


include 'includes/session.php';
@header("Content-type: text/html; charset=utf-8;");
ob_start("ob_gzhandler");
//session_register ('mod_ajax');
$_SESSION['mod_ajax']='';
$_SESSION['mod_ajax'] = true;

$timer = new microTimer;
$timer->start();



if (file_exists("install.php")){
header ("location:install.php");
}

define('AURACMS_MODULE', true);
define('AURACMS_CONTENT', true);
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
include "includes/template.php";
//include "includes/statistik.inc.php";
global $judul_situs,$theme,$publishsitus;
cek_situs();
$_GET['aksi'] = !isset($_GET['aksi']) ? null : $_GET['aksi'];
$_GET['mod'] = !isset($_GET['mod']) ? null : $_GET['mod'];
$_GET['pilih'] = !isset($_GET['pilih']) ? null : $_GET['pilih'];
$_GET['act'] = !isset($_GET['act']) ? null : $_GET['act'];

$COOKIE['stats'] ='';
if ($COOKIE['stats'] != 'okdech'){
include 'includes/statistik.inc.php';
stats();
setcookie('stats', 'okdech', time()+ 3600);	
}


if(isset($_GET['lang'])){

$style_include[] = <<<Iwan
<script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">

    google.load("language", "1");

    function initialize() {
      var text = document.getElementById("text").innerHTML;
      google.language.detect(text, function(result) {
        if (!result.error && result.language) {
	  google.language.translate(text, result.language, "en",
	                            function(result) {
	    var translated = document.getElementById("translation");
	    if (result.translation) {
	      translated.innerHTML = result.translation;
            }
          });
        }
      });
    }
    google.setOnLoadCallback(initialize);

    </script>

Iwan;

}

$old_modules = !isset($old_modules) ? null : $old_modules;

ob_start();

$script_include[] = '';

switch($_GET['mod']) {
	
case 'yes':
	if (file_exists('mod/'.$_GET['pilih'].'/'.$_GET['pilih'].'.php') 
		&& !isset($_GET['act']) 
		&& !preg_match('/\.\./',$_GET['pilih'])) {
		include 'mod/'.$_GET['pilih'].'/'.$_GET['pilih'].'.php';
	} 	else if (file_exists('mod/'.$_GET['pilih'].'/act_'.$_GET['act'].'.php') 
				&& !preg_match('/\.\./',$_GET['pilih'])
				&& !preg_match('/\.\./',$_GET['act'])
				) 
				{
				include 'mod/'.$_GET['pilih'].'/act_'.$_GET['act'].'.php';
			
				} else {
				header("location:index.php");
				exit;
				 } 
break;	
	
default:
	if (!isset($_GET['pilih'])) {
		include 'themes/'.$theme.'/normal.php';
	} else if (file_exists('content/'.$_GET['pilih'].'.php') && !preg_match("/\.\./",$_GET['pilih'])){
		include 'content/'.$_GET['pilih'].'.php';	
	} else {
		header("location:index.php");
		exit;		
	}
break;	
}

$content = ob_get_contents();
ob_end_clean();

// left menu ========================
ob_start();
//Blok Menu
include "content/menu.php";
include "content/topikbox.php";
echo "<!-- akhir blok //-->";
$leftmenu = ob_get_contents();
ob_end_clean(); 
// left menu ========================

// left side ========================

ob_start();
//Blok Menu
echo "<!-- modul //-->";
modul(0);
echo "<!-- blok kiri //-->";
blok(0);
echo "<!-- akhir blok //-->";
$leftside = ob_get_contents();
ob_end_clean(); 

// left side ========================

// right side ========================
ob_start();
//include "content/cari.php";
echo "<!-- modul -->";
modul(1);
echo "<!-- blok kanan -->";
blok(1);
$rightside = ob_get_contents();
ob_end_clean(); 
// right side ========================

if ($_GET['aksi'] == 'logout') {
logout ();
}

//===== slideshow =====
if (!isset($index_hal)){
ob_start();
include "content/slideshow.php";
$slideshow = ob_get_contents();
ob_end_clean();
} else {
	
}
//===== slideshow =====

//===== CEK LOGIN =====
ob_start();
include "content/ceklogin.php";
$login = ob_get_contents();
ob_end_clean();
//===== CEK LOGIN =====

//===== MENU KATEGORI =====
ob_start();
include "content/menukat.php";
$menukat = ob_get_contents();
ob_end_clean();
//===== MENU KATEGORI =====

//===== HEADLINE =====
if (!isset($index_hal)){
ob_start();
include "content/headline.php";
$style_include[] = '
<style type="text/css">
/*<![CDATA[*/
#share {
display : none;
}
/*]]>*/
</style>';
$headline = ob_get_contents();
ob_end_clean();
} else {
$style_include[] = '
<style type="text/css">
/*<![CDATA[*/
#main {
float: left;
margin-left: 10px;
padding: 0;
width: 65%;
}
#rightbar {
float: right;
}
/*]]>*/
</style>';
}
//===== HEADLINE =====

//===== iklanslideratas =====
ob_start();
include "content/iklanslideratas.php";
$iklanslideratas = ob_get_contents();
ob_end_clean();
//===== iklanslideratas =====

//===== widget =====
ob_start();
include "content/widget.php";
$widget = ob_get_contents();
ob_end_clean();
//===== widget =====

$style_include_out = !isset($style_include) ? '' : implode("",$style_include);
$script_include_out = !isset($script_include) ? '' : implode("",$script_include);
$rightside = !isset($rightside) ? '' : $rightside;
$leftside = !isset($leftside) ? '' : $leftside;
$login = !isset($login) ? '' : $login;
$leftmenu = !isset($leftmenu) ? '' : $leftmenu;
$headline = !isset($headline) ? '' : $headline;
$menukat = !isset($menukat) ? '' : $menukat;
$slideshow = !isset($slideshow) ? '' : $slideshow;
$members = !isset($members) ? '' : $members;
$iklanslideratas = !isset($iklanslideratas) ? '' : $iklanslideratas;
$widget = !isset($widget) ? '' : $widget;

$define = array (
	'widget'    => $widget,
	'iklanslideratas'    => $iklanslideratas,
	'leftmenu'    => $leftmenu,
	'headline'    => $headline,
	'menukat'    => $menukat,
	'login'    => $login,
	'slideshow'    => $slideshow,
	'members'    => $members,
	'leftside'    => $leftside,
		'theme'     => $theme,
	'url'     => $url_situs,
	'content'     => $content,
	'rightside'  => $rightside,
	'judul_situs' => $judul_situs,
	'slogan' => $slogan,
	'style_include' => $style_include_out,
	'script_include' => $script_include_out,
	'meta_description' => $_META['description'],
	'meta_keywords' => $_META['keywords'],
	'meta_author' => $_META['author'],
	'timer' => $timer->stop()
	);
	
$tpl = new template ('themes/'.$theme.'/'.$theme.'.html');

$tpl-> define_tag($define);

$tpl-> cetak();
?>