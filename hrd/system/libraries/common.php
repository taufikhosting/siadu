<?php
/***** Request *****/
function gets($n){
	if(isset($_GET[$n])){
		return $_GET[$n];
	} else { return ""; }
}
function gpost($n){
	if(isset($_POST[$n])){
		return $_POST[$n];
	} else { return ""; }
}
function getsx($n){
	if(isset($_GET[$n])){
		return $_GET[$n];
	} else { return gpost($n); }
}
function gpostTgl($a){
	return gpost($a."_y").gpost($a."_m").gpost($a."_d");
}
/***** Date & Time *****/
$MNTHN=Array('','January','February','March','April','May','June','July','August','September','October','November','December');
$MNTHS=Array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
function diffDay($t1,$t2="",$a=false){
	if($t2=="") $t2=date("Y-m-d");
	$stamp1 = strtotime($t1);
	$stamp2 = strtotime($t2);
	$difstamp = $stamp1-$stamp2;
	$difday = intval($difstamp/86400);
	if($a) $difday=abs($difday);
	return $difday;
}
function ftgl($a){
	global $MNTHS;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return $MNTHS[intval($b[1])]." ".intval($b[2]).", ".$b[0];
	}
}
function fstgl($a){
	global $MNTHS;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	$c=substr($b[0],2,2);
	return $MNTHS[intval($b[1])]." ".intval($b[2]).", '".$c;
	}
}
function fftgl($a){
	global $MNTHN;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return $MNTHN[intval($b[1])]." ".intval($b[2]).", ".$b[0];
	}
}
function fhtgl($a){
	global $MNTHN;
	if($a=="" || $a=="0000-00-00") return "-";
	else{
	$b=explode("-",$a);
	return intval($b[1])."/".intval($b[2])."/".$b[0];
	}
}
/***** Controls *****/
function isCheck($a,$b){
	if($a==$b) return " checked ";
	return "";
}
function isSelect($a,$b){
	if($a==$b) return " selected ";
	return "";
}
function iText($d="",$v="",$s="",$p="",$cb=""){
	//return "<input type=\"text\" class=\"iText\" id=\"".$d."\"".(($s=="")?"":" style=\"".$s."\" ")."value=\"".$v."\"".(($p=="")?"":" placeholder=\"".$p."\" ")."/>";
	
	return "<input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"":" style=\"".$s."\" ").(($s=="")?"":" value=\"".$v."\" ").(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ")."onfocus=\"this.className='iTextx'\" onblur=\"this.className='iText'\"/>";
}
function iTextCb($d="",$v="",$s="",$c=""){
	//return "<input type=\"text\" class=\"iText\" id=\"".$d."\"".(($s=="")?"":" style=\"".$s."\" ")."value=\"".$v."\"".(($p=="")?"":" placeholder=\"".$p."\" ")."/>";
	
	return "<input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"":" style=\"".$s."\" ").(($s=="")?"":" value=\"".$v."\" ").(($c=="")?"":$c)." onfocus=\"this.className='iTextx'\" onblur=\"this.className='iText'\"/>";
}
function iSelect($d,$a,$s="",$y="",$cb=""){ // iSelect(id,array,value,style,callback)
	$r="<select class=\"iSelect\" id=\"".$d."\" name=\"".$d."\" ".($y==""?"":" style=\"".$y."\" ").($cb==""?"":" onchange=\"".$cb."\" ")." onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\">";
	foreach($a as $k=>$v){
		$r.="<option value=\"".$k."\"".isSelect($k,$s).">".$v."</option>";
	}
	$r.="</select>";
	return $r;
}
function iTextarea($d,$v="",$s="",$r=3){
	return "<textarea class=\"iTextA\" style=\"".$s."\" rows=\"".$r."\" id=\"".$d."\" name=\"".$d."\" onfocus=\"this.className='iTextAx'\" onblur=\"this.className='iTextA'\">".$v."</textarea>";
}
function inputTanggal($dn,$val="0000-00-00",$cb=""){ 
	global $MNTHN;
	$tgl=explode("-",$val); $s=""; if(intval($tgl[1])!=0) $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]))+1; else $dim=32;
	$s.="<input type=\"hidden\" id=\"".$dn."\" name=\"".$dn."\" value=\"".$val."\" />";
	$s.="<input type=\"hidden\" id=\"".$dn."f\" name=\"".$dn."f\" value=\"".$val."\" />";
	$s.="<input type=\"hidden\" id=\"".$dn."s\" name=\"".$dn."s\" value=\"".$val."\" />";
	$s.="<select class=\"iSelect\" id=\"".$dn."_m\" name=\"".$dn."_m\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">month:</option>";
	for($kk=1;$kk<=12;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[1])?"selected":"")." >".$MNTHN[$kk]."</option>";
	}
	$s.="</select>";
	$s.="<select class=\"iSelect\" id=\"".$dn."_d\" name=\"".$dn."_d\" style=\"margin-left:2px\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">date:</option>";
	for($kk=1;$kk<$dim;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[2])?"selected":"")." >".$kk."</option>";
	}
	$s.="</select> , ";
	$s.="<select class=\"iSelect\" id=\"".$dn."_y\" name=\"".$dn."_y\" style=\"margin-left:2px\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">year:</option>";
	for($kk=intval(date("Y"))+2;$kk>=1945;$kk--) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[0])?"selected":"")." >".$kk."</option>";
	}
	$s.="</select>";	
	return $s;
}
function inputDate($d,$v="0000-00-00",$cb=""){
	return inputTanggal($d,$v,$cb);
}
function iThx($t,$s,$p,$b,$m,$q){
	$img="";
	if($s==$b){
		$c="a";
		$img="<img src=\"".IMGR."sort".$m.".png\" style=\"float:right\" />";
	} else {
		$m=0;
		$c="";
	}
	return "<td class=\"xth\"><button class=\"xlink$c\" title=\"Sort by ".strtolower($t)."\" onclick=\"jumpTo('".pageLink($p,$s,$m,$q)."')\">".$t.$img."</button></td>";
}
function iAddMstr($d,$t,$p=""){
	if($p=="") $p=$t;
	$s="<div id=\"popd_".$d."\" style=\"float:left;margin-left:2px\">";
	$s.="<button type=\"button\" class=\"obtna\" title=\"Add new ".$t."\" onclick=\"open_popbox('".$d."')\" style=\"margin-left:2px\">";
	$s.="<img src=\"".IMGR."add.png\" /></button>";
	$s.="<div id=\"popb_".$d."\" class=\"popblock\" style=\"display:none;position:fixed;top:0;left:0\" onclick=\"close_popbox('".$d."')\"></div>";
	$s.="<div id=\"popx_".$d."\" class=\"popbox\" style=\"background-position:0 0;display:none\">";
	$s.="<table cellspacing=\"0\" cellpadding=\"0\" width=\"310px\"><tr height=\"58px\" style=\"padding-top:10px\">";
	$s.="<td width=\"35px\" align=\"right\"><input type=\"button\" class=\"popx\" title=\"Cancel\" onclick=\"close_popbox('".$d."')\"/></td>";
	$s.="<td align=\"center\">".iText("popi_".$d,'',"width:220px","New ".$p)."</td>";
	$s.="<td width=\"35px\" align=\"left\"><input type=\"button\" class=\"popy\" title=\"Add\" onclick=\"popbox_save('".$d."')\"/></td>";
	$s.="</tr></table>";
	$s.="</div>";
	$s.="</div>";
	return $s;
}
function iAddMstrx($d,$t,$p=""){
	if($p=="") $p=$t;
	$s="<div id=\"popd_".$d."\" style=\"float:left;margin-left:2px\">";
	$s.="<button type=\"button\" class=\"obtna\" title=\"Add new ".$t."\" onclick=\"open_popbox('".$d."')\" style=\"margin-left:2px\">";
	$s.="<img src=\"".IMGR."add.png\" /></button>";
	$s.="<div id=\"popb_".$d."\" class=\"popblock\" style=\"display:none;position:absolute;top:-400px;left:-500px\" onclick=\"close_popbox('".$d."')\"></div>";
	$s.="<div id=\"popx_".$d."\" class=\"popbox\" style=\"display:none\">";
	$s.="<table cellspacing=\"0\" cellpadding=\"0\" width=\"310px\"><tr height=\"58px\" style=\"padding-top:10px\">";
	$s.="<td width=\"35px\" align=\"right\"><input type=\"button\" class=\"popx\" title=\"Cancel\" onclick=\"close_popbox('".$d."')\"/></td>";
	$s.="<td align=\"center\">".iText("popi_".$d,'',"width:220px","New ".$p)."</td>";
	$s.="<td width=\"35px\" align=\"left\"><input type=\"button\" class=\"popy\" title=\"Add\" onclick=\"popbox_save('".$d."')\"/></td>";
	$s.="</tr></table>";
	$s.="</div>";
	$s.="</div>";
	return $s;
}
function iAddMstrx2($d,$t,$p=""){
	if($p=="") $p=$t;
	$s="<div id=\"popd_".$d."\" style=\"float:left;margin-left:2px\">";
	$s.="<button type=\"button\" class=\"obtna\" title=\"Add new ".$t."\" onclick=\"open_popbox('".$d."')\" style=\"margin-left:2px\">";
	$s.="<img src=\"".IMGR."add.png\" /></button>";
	$s.="<div id=\"popb_".$d."\" class=\"popblock\" style=\"display:none;position:absolute;top:-400px;left:-500px\" onclick=\"close_popbox('".$d."')\"></div>";
	$s.="<div id=\"popx_".$d."\" class=\"popbox2\" style=\"display:none\">";
	$s.="<table cellspacing=\"0\" cellpadding=\"0\" width=\"310px\"><tr height=\"58px\" style=\"padding-top:10px\">";
	$s.="<td width=\"35px\" align=\"right\"><input type=\"button\" class=\"popx\" title=\"Cancel\" onclick=\"close_popbox('".$d."')\"/></td>";
	$s.="<td align=\"center\">".iText("popi_".$d,'',"width:220px","New ".$p)."</td>";
	$s.="<td width=\"35px\" align=\"left\"><input type=\"button\" class=\"popy\" title=\"Add\" onclick=\"popbox_save('".$d."')\"/></td>";
	$s.="</tr></table>";
	$s.="</div>";
	$s.="</div>";
	return $s;
}
/***** Images & Files *****/
function getExtension($str) {
	$i = strrpos($str,".");
	if(!$i){return "";}
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}
/***** Master Data *****/
function MstrGet($a,$n=false,$b=""){
	$res=Array();
	if($n){
		$res[0]=$b;
	}
	$t=mysql_query("SELECT dcid,name FROM `$a` ORDER BY urut,name");
	while($r=mysql_fetch_array($t)){
		$res[$r['dcid']]=$r['name'];
	}
	return $res;
}
function MstrGetReminder($a,$b){
	if(intval($b)==0) return 0;
	else return intval(dbFetch("reminder","mstr_".$a,"W/dcid='$b'"));
}
function MstrLastUrut($t){
	$ts=dbSel("urut",$t,"O/ urut DESC LIMIT 0,1");
	if(dbNRow($ts)>0){
		$rs=dbFA($ts);
		return $rs['urut'];
	}
	return 0;
}
function MstrGetNextUrut($t,$a,$o=""){
	$ts=dbSel("dcid,urut",$t,"O/ urut ".$o);
	$lid=Array(-1,0,0);
	while($rs=dbFA($ts)){
		if($rs['dcid']==$a){
			$lid[2]=$rs['urut'];
			return $lid;
		}
		$lid[0]=$rs['dcid'];
		$lid[1]=$rs['urut'];
	}
	return $lid;
}
function MstrGetStatus(){ // used
	$res=Array();
	$t=mysql_query("SELECT * FROM mstr_status ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$res[$r['dcid']]=$r['name'];
	}
	$res[0]='No Status';
	return $res;
}
function MstrGetTraintype(){ // used
	$res=Array();
	$t=mysql_query("SELECT * FROM mstr_traintype ORDER BY urut");
	while($r=mysql_fetch_array($t)){
		$res[$r['dcid']]=$r['name'];
	}
	return $res;
}
function getJsArray($var,$a){
	$s="var ".$var."=new Array();"; $n=0;
	foreach($a as $k=>$v){
		if($n!=0) {$s.=",";$n=1;}
		$s.=$var."['".$k."']='".$v."';";
	}
	return $s;
}
/***** Employee *****/
function EmpCountDayoff($a){
	$cyear=intval(date("Y"));
	$t=mysql_query("SELECT * FROM emp_dayoff WHERE empid='$a' AND date1y='$cyear' AND date2y='$cyear'");
	$hcuti=0;
	while($r=mysql_fetch_array($t)){
		$hcuti+=$r['count'];
	}
	return $hcuti;
}

function EmpGetCStatus($a){
	$r=dbSFA("*","emp_status","W/empid='$a' AND active='Y'");
	return $r;
}

function EmpGetMaxDayoff($a){
	if($a==0) return "E";
	$n=dbFetch("maxdayoff","mstr_division","W/dcid='$a'");
	if($n!="E") return intval($n);
	return $n;
}
function EmpDayoffGroup($g1,$g2){
	$res="";
	$t1=explode("-",$g1);
	$t2=explode("-",$g2);
	$d1=intval($t1[2]);
	$d2=intval($t2[2]);
	if($t1[1]==$t2[1]){ // pd bulan yg sama
		for($i=$d1;$i<=$d2;$i++){
			if($i>$d1) $res.=",";
			$res.=$i;
		}
	}
	return $res;
}
/***** CSS *****/
define('cssBodyColor','color:#303942;');
function cssGradTop($a,$b){
	$rs ="background-color: ".$b.";";
	$rs.="background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(".$b."), to(".$a."));";
	$rs.="background:-webkit-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-moz-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-ms-linear-gradient(top, ".$a.", ".$b.");";
	$rs.="background:-o-linear-gradient(top, ".$a.", ".$b.");";
	return $rs;
}
function cssGrad($a,$b="",$d="bottom"){
	$rs ="background-color: ".$b.";";
	$rs.="background:-webkit-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-moz-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-ms-linear-gradient(".$d.", ".$a.");";
	$rs.="background:-o-linear-gradient(".$d.", ".$a.");";
	return $rs;
}
function cssFontBody($b=""){
	if($b!="") $b="bold";
	return "font:$b 11px 'Verdana',Tahoma;";
}
/***** Paging *****/
function pageLink($pg="",$sb="",$sm="",$q=""){
	global $page_link;
	$f=0;
	if($pg!="") {
		if($f==0) $lnk.="?page=".$pg;
		else $lnk.="&page=".$pg;
		$f++;
	}
	if($sb!="") {
		if($f==0) $lnk.="?sortby=".$sb;
		else $lnk.="&sortby=".$sb;
		$f++;
	}
	if($sm!="") {
		if($f==0) $lnk.="?mode=".$sm;
		else $lnk.="&mode=".$sm;
		$f++;
	}
	if($q!="") {
		if($f==0) $lnk.="?q=".$q;
		else $lnk.="&q=".$q;
		$f++;
	}
	return $lnk;
}
/***** Misc... *****/
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
?>