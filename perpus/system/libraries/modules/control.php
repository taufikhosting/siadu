<?php //>
function isCheck($a,$b){
	if($a==$b) return ' checked ';
	return '';
}
function isSelect($a,$b){
	if($a==$b) return ' selected ';
	return '';
}
function iText($d='',$v='',$s='',$p='',$cb='',$at=''){ $bc="";
	if($cb!=""){$n=preg_match("/onblur=\".+\"/", $cb,$m); 
	if($n>0){
		$bc=str_replace("\"","",$m[0]);
		$bc=";".str_replace("onblur=","",$bc);
		$cb=str_replace($m[0],"",$cb);
	}}
	$v=str_replace('"',"''",$v);
	$v=str_replace("\\","",$v);
	return "<input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"":" style=\"".$s."\" ").(($s=="")?"":" value=\"".$v."\" ").(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ").($at==""?"":" ".$at." ")."onfocus=\"this.className='iTextx'\" onblur=\"this.className='iText'".$bc."\"/>";
}
function iSelect($d,$a,$s='',$y='',$cb=''){
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
function inputYear($dn,$val="0000",$cb=""){
	$s="<select class=\"iSelect\" id=\"".$dn."\" name=\"".$dn."\" onchange=\"".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">year:</option>";
	for($kk=intval(date("Y"))+3;$kk>=1945;$kk--) {
		$s.="<option value=\"".$kk."\" ".(($kk==$val)?"selected":"")." >".$kk."</option>";
	}
	$s.="</select>";
	return $s;
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

require_once(SYDIR.'control.php');
?>