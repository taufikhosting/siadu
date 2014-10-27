<?php
// Standard fonts
define("SFONT","'Segoe UI',Verdana,Tahoma");
define("SFONTL","'Segoe UI Light','Segoe UI',Verdana,Tahoma");
define("VFONT","Verdana,Tahoma,Arial");
define("MSFONT","'Lucida Console',Consolas");
define("MSTYPEFONT","'Courier New',Consolas");
define("SFONT11","font:11px ".SFONT.";");
define("SFONT12","font:12px ".SFONT.";");
define("SFONT12L","font:12px ".SFONTL.";");
define("SFONT12B","font:bold 12px ".SFONT.";");
define("SFONT13","font:13px ".SFONT.";");
define("SFONT14","font:14px ".SFONT.";");
define("SFONT14B","font:bold 14px ".SFONT.";");
define("VFONT10","font:10px ".VFONT.";");
define("VFONT11","font:11px ".VFONT.";");
define("VFONT11B","font:bold 12px ".VFONT.";");
define("MSFONT10","font:10px ".MSFONT.";");

// Standard colors
define("CBLUE","#1c64d1");
define("CLGREY","#999");
define("CDARK","#444");
define("CLBLUE","#468ad2");
define('CPURPLE','#5a38b3');
define('CGREEN1','#019501');
define('CTBLUE1','#0768dd');
define("TBORDER","border:1px dotted red !important;");
define("STBORDER",'style="border:1px dotted red !important"');
define('cssBodyColor','color:#303942;');
define ('FMARK','<span class="fmark">*</span>');
define ('IMGCEK18','<img src="'.IMGR.'check18.png" border="0" />');
define ('IMGCEK16','<img src="'.IMGR.'check16.png" border="0" />');

// Standard style
define('SFLOATL','float:left;margin-right:4px');

// Global functions
function gets($n,$a=""){
if(isset($_GET[$n])){return $_GET[$n];}else{return $a;}
}
function gpost($n,$a=""){
if(isset($_POST[$n])){return $_POST[$n];}else{return gets($n,$a);}
}
function getsx($n){
if(isset($_GET[$n])){return $_GET[$n];}else{return gpost($n);}
}
//require_once(SHAREDDIR.'request/xmlhttprequest.php');

// Miscellanous Functions
function color_level($l,$k=0){
	$red=0; $green=255;
	$n=intval($k*510/$l);
	if($n>255){
		$green=255-$n+255;
		$red=255;
	} else {
		$green=255;
		$red=$n;
	}
	$clr=sprintf("#%02x%02x%02x",$red,$green,0);
	return $clr;
}
function qarea(){
	echo '<textarea style="width:100%">';
}
function earea(){
	echo '</textarea>';
}
function getExtension($str){
$i=strrpos($str,".");if(!$i){return "";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;
}
function str_firstword($a){
	$p=strpos($a," ");
	if($p!==false){
		return substr($a,0,$p);
	} else {
		return $a;
	}
}
function str_append(&$s,$d,$del=','){
	if($s!='')$s.=$del;
	$s.=$d;
}
function getStrA($a,$d){
	$k=0; $res="";
	foreach($a as $key=>$val){
		if($k>0) $res.=$d;
		$res.="'$val'"; $k++;
	}
	return $res;
}
function getStrAK($a,$d){
	$k=0; $res="";
	foreach($a as $key=>$val){
		if($k>0) $res.=$d;
		$res.="'$key'"; $k++;
	}
	return $res;
}
function fRp($a,$sc=-1,$sn=-1,$f=0){
	if(defined('FRP_DISABLE')){
		if(FRP_DISABLE==1) return $a;
	}
	if($sn==-1){
		if(defined('ITEXTC_SHOW_NUL')){
			$sn=ITEXTC_SHOW_NUL;
		} else {
			$sn=1;
		}
	}
	if($sc==-1){
		if(defined('ITEXTC_SHOW_CUR')){
			$sc=ITEXTC_SHOW_CUR;
		} else {
			$sc=1;
		}
	}
	if($sn==0){
		if($a>0) $fmt=($sc==1?'Rp ':'').number_format($a,0,',','.');
		else $fmt='';
	} else {
		$fmt=($sc==1?'Rp ':'').number_format($a,0,',','.');
	}
	if($f==1){
		if($a<0) $fmt='<span style="color:#ff0000">'.$fmt.'</span>';
	}
	return $fmt;
}
function srcrep($k,$v){
	$p1=stripos($v,$k);
	if($p1!==false){
		$pl=strlen($k);
		$k1=substr($v,0,$p1);
		$k2=substr($v,($p1+$pl));
		$k=substr($v,$p1,$pl);
		$v=$k1.'<span style="background:#fdff31">'.$k.'</span>'.$k2;
	}
	return $v;
}
/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string 
 */
function trim_textw($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        //$input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= ' ...';
    }
  
    return $trimmed_text;
}

// Admin
define('ADMIN_LEVEL_ADMINISTRATOR',1);
define('ADMIN_LEVEL_OPERATOR',2);
define('ADMIN_LEVEL_GUEST',3);

function admin_level_r(){
	return Array(1=>'Administrator',2=>'Operator',3=>'Viewer');
}
function admin_get(){
	$a=Array();
	if(isset($_SESSION[ASID.'admin_uname'])){
		$a['id']=$_SESSION[ASID.'admin_id'];
		$a['nama']=$_SESSION[ASID.'admin_name'];
		$a['uname']=$_SESSION[ASID.'admin_uname'];
		$a['level']=intval($_SESSION[ASID.'admin_level']);
		$a['dept']=intval($_SESSION[ASID.'admin_dept']);
		$a['pegawai']=intval($_SESSION[ASID.'admin_pegawai']);
		$a['bahasa']=$_SESSION[ASID.'admin_bahasa'];
	} else {
		$a['id']=0;
		$a['nama']='';
		$a['uname']='';
		$a['level']=9;
		$a['dept']=0;
		$a['pegawai']=0;
		$a['bahasa']='';
	}
	return $a;
}
function admin_getLang(){
	$a=admin_get();
	return $a['bahasa'];
}
function admin_getID(){
	$a=admin_get();
	return $a['id'];
}
function admin_isadministrator(){
	$ADMIN=admin_get();
	if($ADMIN['level']<=ADMIN_LEVEL_ADMINISTRATOR) return true;
	else return false;
}
function admin_isoperator(){
	$ADMIN=admin_get();
	if($ADMIN['level']<=ADMIN_LEVEL_OPERATOR) return true;
	else return false;
}
function admin_is_alldept(){
	$ADMIN=admin_get();
	if($ADMIN['dept']==0) return true;
	else return false;
}
// Common data:
function agama_r($a=1){
	$res=Array(); if($a==0)$res[0]='agama:';
	$t=mysql_query("SELECT * FROM mst_agama ORDER BY urutan");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['agama'];
	}
	return $res;
}
function agama_name($a){
	if(is_array($a))$b=$a['agama'];
	else $b=$a;
	return dbFetch("agama","mst_agama","W/replid='$b'");
}
function goldarah_r(){
	return Array('-'=>'-','O'=>'O','A'=>'A','B'=>'B','AB'=>'AB');
}
function warga_r(){
	return Array('WNI'=>'WNI','WNA'=>'WNA');
}
function suku_r($a=0){
	$res=Array(); if($a==0)$res[0]='-';
	$t=mysql_query("SELECT * FROM mst_suku ORDER BY urutan");
	while($r=mysql_fetch_array($t)){
		$res[$r['replid']]=$r['suku'];
	}
	return $res;
}
function suku_name($a){
	if(is_array($a))$b=$a['suku'];
	else $b=$a;
	return dbFetch("suku","mst_suku","W/replid='$b'");
}
function app_form_getguru($d='guru',$v='x',$c='',$s='float:left'){
	$ng='';
	$ag='';
	if($v=='x')$v=gpost($d);
	if(is_array($v))$v=$v[$d];
	if($v!=0&&$v!=''&&$v!='0'){
		$t=mysql_query("SELECT * FROM aka_guru WHERE replid='$v' LIMIT 0,1");
		if(mysql_num_rows($t)>0){
			$r=mysql_fetch_array($t);
			$q=mysql_query("SELECT * FROM ".DB_HRD." WHERE replid='".$r['pegawai']."' LIMIT 0,1");
			if(mysql_num_rows($q)>0){
				$h=mysql_fetch_array($q);
				$ng=$h['nip'];
				$ag=$h['nama'];
			}
		}
	}
	$k= '<div style="'.$s.'">';
	$k.= iText('nipguru',$ng,'float:left;width:100px;margin-right:5px;cursor:default','nip','onclick="aka_getguru(\''.$c.'\')"','readonly');
	$k.= iText('namaguru',$ag,'float:left;width:200px;margin-right:4px;cursor:default','nama','onclick="aka_getguru(\''.$c.'\')"','readonly');
	$k.= '<input type="hidden" id="'.$d.'" value="'.$v.'" />';
	$k.= '<button class="find21" style="float:left;margin-top:2px" onclick="aka_getguru(\''.$c.'\')"></button>';
	$k.= '</div>';
	return $k;
}
function app_form_getpegawai($d='pegawai',$v='x',$c='',$s='float:left'){
	$ng='';
	$ag='';
	if($v=='x')$v=gpost($d);
	if(is_array($v))$v=$v[$d];
	if($v!=0&&$v!=''&&$v!='0'){
		$q=mysql_query("SELECT * FROM hrd_pegawai WHERE replid='$v' LIMIT 0,1");
		if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$ng=$h['nip'];
		$ag=$h['nama'];}
	}
	$k= '<div style="'.$s.'">';
	$k.= iText('nippegawai',$ng,'float:left;width:100px;margin-right:5px;cursor:default','nip','onclick="aka_getpegawai(\''.$c.'\')"','readonly');
	$k.= iText('namapegawai',$ag,'float:left;width:200px;margin-right:4px;cursor:default','nama','onclick="aka_getpegawai(\''.$c.'\')"','readonly');
	$k.= '<input type="hidden" id="'.$d.'" value="'.$v.'" />';
	$k.= '<button class="find21" style="float:left;margin-top:2px" onclick="aka_getpegawai(\''.$c.'\')"></button>';
	$k.= '</div>';
	return $k;
}

// Common apps
function gpost_arr(){
	$s=Array();
	$a=func_get_args();
	$n=count($a);
	for($i=0;$i<$n;$i++){
		$s[$i]=gpost($a[$i]);
	}
	return $s;
}
function app_form_gpost(){
	$s=Array();
	$a=func_get_args();
	$n=count($a);
	for($i=0;$i<$n;$i++){
		if($a[$i]=='photo'){
			$id=gpost('photo');
			if($id!=''){
				if(intval($id)!=0){
					$p=dbFetch("photo","tmp_photo","W/replid='$id'")."'";
					dbDel("tmp_photo","replid='$id'");
					$s['photo']=$p;
				} else {
					$s['photo']='';
				}
			}
		}
		else {
			$s[$a[$i]]=gpost($a[$i]);
		}
	}
	return $s;
}

function notifbox(){
	if(isset($_SESSION[ASID.'notifbox'])){
		if($_SESSION[ASID.'notifbox']!=''){ echo $_SESSION[ASID.'notifbox']; $_SESSION[ASID.'notifbox']='';}
		//else {echo '<div id="notifbox" style="border:1px solid red;position:fixed;width:100%;top:140px;left:0px;display: "></div>';}
	} else {
		//echo '<div id="notifbox" style="border:1px solid red;position:fixed;width:100%;top:140px;left:0px;display: "></div>';
	}
}

$APP_COLOR_THEME1=Array('#fc9f13','#ff366d','#3ce700','#2694eb','#2546e9','#5a38b3'); //3eee00
$APP_COLOR_THEME2=Array('#68c010','#2694eb','#ff9111','#0768dd','#ff366d','#5a38b3');

function app_menu_home(){
	global $APP_CSLIDE;
	echo '<li><a href="#&home" onclick="openHome('.$APP_CSLIDE.')" style="border:none" title="Home"><img src="'.IMGR.'home.png"/></a></li>';
}
function app_page($k,$t,$d='',$s='#68c010',$c='',$p=0,$b='std'){
	return array('key'=>$k,'title'=>$t,'desc'=>$d,'color'=>$s,'icon'=>$c,'tipe'=>$p,'action'=>$b);
}
function app_page_view(){
	$lang=admin_getLang();
	$p=gpost('page');
	if($lang=='en'){
		$fpage=VWDIR.'en/'.$p.'.php';
		//log_print($fpage);
		if(file_exists($fpage)){
			notifbox();
			require_once($fpage);
		}
		else{
			echo '<div class="warnbox">Page is currently not available.</div>';
		}
	} else {
		$fpage=VWDIR.$p.'.php';
		//log_print($fpage);
		if(file_exists($fpage)){
			notifbox();
			require_once($fpage);
		}
		else{
			echo '<div class="warnbox">Halaman belum tersedia.</div>';
		}
	}
	//log_print('common: fpage='.$fpage);
}
function app_page_getindex($key){
	global $APP_PAGES;
	$n1=count($APP_PAGES);
	foreach($APP_PAGES as $k=>$v){
		$n=count($APP_PAGES[$k]['pages']);
		for($i=0;$i<$n;$i++){
			if($APP_PAGES[$k]['pages'][$i]['key']==$key) return $k;
		}
	}
	return 0;
}
function app_menu(){
	global $APP_PAGES;
	$menuid=gpost('set');
	if($menuid!=''){
	app_menu_home();
	for($i=0;$i<count($APP_PAGES[$menuid]['pages']);$i++){
		$page=&$APP_PAGES[$menuid]['pages'][$i];
		$act=str_replace('std','openPage('.$menuid.',\''.$page['key'].'\',false)',$page['action']);
		echo '<li><a '.($page['key']==gpost('page')?'class="active"':'').' href="#&'.$page['key'].'" onclick="'.$act.'" style="border-color:'.$page['color'].'">'.$page['title'].'</a></li>';
	}}else{
	for($i=0;$i<count($APP_PAGES);$i++){
	$p=$APP_PAGES[$i]['tileset'];
	echo '<li><a id="menu01" href="#&'.$p['key'].'" onclick="slide('.$p['slide'].',\''.$p['key'].'\')" style="border-color:'.$APP_PAGES[$i]['pages'][0]['color'].'">'.$p['title'].'</a></li>';
	}
	}
}
function app_checkuser(){
	$passwd=md5(gpost('passwd'));
	$uname=gpost('uname');
	$t=mysql_query("SELECT * FROM admin WHERE uname='$uname' AND passwd='$passwd'");
	if(mysql_num_rows($t)==1){
		$r=mysql_fetch_array($t);
		if($r['app']==APID || $r['level']==1){
		$_SESSION[ASID.'admin_id']=$r['replid'];
		$_SESSION[ASID.'admin_name']=$r['nama'];
		$_SESSION[ASID.'admin_uname']=$r['uname'];
		$_SESSION[ASID.'admin_level']=$r['level'];
		$_SESSION[ASID.'admin_dept']=$r['departemen'];
		$_SESSION[ASID.'admin_pegawai']=$r['pegawai'];
		$_SESSION[ASID.'admin_bahasa']=$r['bahasa'];
		dbUpdate("admin",Array('tlogin'=>date("Y-m-d H:i:s")),"replid='".$r['replid']."'");
		echo $r['nama'];
		} else {
		echo "0";
		//echo $r['nama'];
		}
	}
	else {
		//echo $r['nama'];
		echo "0";
	}
}

function log_print($somecontent=''){
	$filename = 'log_print.txt';
	$somecontent = ftgl(date("Y-m-d"))." : ".$somecontent."\r\n";
	
	// Let's make sure the file exists and is writable first.
	if (is_writable($filename)) {

		// In our example we're opening $filename in append mode.
		// The file pointer is at the bottom of the file hence
		// that's where $somecontent will go when we fwrite() it.
		if (!$handle = fopen($filename, 'a')) {
			 //echo "Cannot open file ($filename)";
			 exit;
		}

		// Write $somecontent to our opened file.
		if (fwrite($handle, $somecontent) === FALSE) {
			//echo "Cannot write to file ($filename)";
			exit;
		}

		//echo "Success, wrote ($somecontent) to file ($filename)";

		fclose($handle);

	} else {
		//echo "The file $filename is not writable";
	}
}

function hiddenval($id,$v='',$s=0){
	echo '<input type="'.($s==0?'hidden':'').'" id="'.$id.'" name="'.$id.'" value="'.$v.'" />';
}
function hiddenval_gpost(){
	$a=func_get_args();
	$n=count($a);
	for($i=0;$i<$n;$i++){
		hiddenval($a[$i],gpost($a[$i]));
	}
}

function app_form_fu($a='File'){
	global $lwidth;
	echo '<tr height="30px"><td width="'.$lwidth.'px">'.$a.':</td><td>';
	echo '<div style="float:left;position:relative">';
	echo '<input type="hidden" id="ufile" name="ufile" value=""/>';
	echo '<input type="hidden" id="fname" name="ufile" value=""/>';
	echo '<iframe id="imgframe" name="imgframe" scrolling="no" style="float:left;border:none;height:25px;width:230px;overflow:hidden;margin:0;padding:0;" src="fuform.php"></iframe>';
	echo '</div>';
	echo '</td></tr>';
}
function farray(){
	$s=array();
	$a=func_get_args();
	$n=count($a);
	for($i=0;$i<$n;$i++){
		$s[$a[$i]]='';
	}
	return $s;
}

function appmod_use(){
	$a=func_get_args();
	$n=count($a);
	for($i=0;$i<$n;$i++){
		require_once(APPMOD.$a[$i].'.php');
	}
}

function fftgl_namabulan($a){
	$MNTHN=Array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	return $MNTHN[$a];
}

function doc_encrypt($str)
{
	$res='';
	$sa=str_split($str);
	$ln=count($sa);
	for($i=0;$i<$ln;$i++){
		$res.=chr(ord($sa[$i])+1);
	}
	return $res;
}

function doc_decrypt($str)
{
	$res='';
	$sa=str_split($str);
	$ln=count($sa);
	for($i=0;$i<$ln;$i++){
		$res.=chr(ord($sa[$i])-1);
	}
	return $res;
}

require_once(SHAREDOBJ.'departemen.php');
require_once(SHAREDOBJ.'urut.php');
require_once(SHAREDOBJ.'psbar.php');
?>
