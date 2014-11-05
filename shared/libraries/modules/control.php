<?php //>
$MNTHN=Array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$MNTHS=Array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
function isCheck($a,$b){
	if($a==$b) return ' checked ';
	return '';
}
function isSelect($a,$b){
	if($a==$b) return ' selected ';
	return '';
}
function iText($d='',$v='',$s='',$p='',$cb='',$at=''){ $bc=""; $bc2="";
	if($cb!=""){$n=preg_match("/onblur=\".+\"/", $cb,$m); 
	if($n>0){
		$bc=str_replace("\"","",$m[0]);
		$bc=";".str_replace("onblur=","",$bc);
		$cb=str_replace($m[0],"",$cb);
	}}
	if($cb!=""){$n=preg_match("/onfocus=\".+\"/", $cb,$m); 
	if($n>0){
		$bc2=str_replace("\"","",$m[0]);
		$bc2=";".str_replace("onfocus=","",$bc2);
		$cb=str_replace($m[0],"",$cb);
	}}
	if(is_array($v)) $v=$v[$d];
	$v=str_replace('"',"''",$v);
	$v=str_replace("\\","",$v);
	return "<input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"":" style=\"".$s."\" ").(($v=="")?"":" value=\"".$v."\" ").(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ").($at==""?"":" ".$at." ")."onfocus=\"this.className='iTextx'".$bc2."\" onblur=\"this.className='iText'".$bc."\"/>";
}

function iTextSrc($d='',$v='',$s='',$p='',$act='',$cb='',$at=''){ $bc=""; $bc2="";
	$lang=admin_getLang();
	if($cb!=""){$n=preg_match("/onblur=\".+\"/", $cb,$m); 
	if($n>0){
		$bc=str_replace("\"","",$m[0]);
		$bc=";".str_replace("onblur=","",$bc);
		$cb=str_replace($m[0],"",$cb);
	}}
	if($cb!=""){$n=preg_match("/onfocus=\".+\"/", $cb,$m); 
	if($n>0){
		$bc2=str_replace("\"","",$m[0]);
		$bc2=";".str_replace("onfocus=","",$bc2);
		$cb=str_replace($m[0],"",$cb);
	}}
	if(is_array($v)) $v=$v[$d];
	$v=str_replace('"',"''",$v);
	$v=str_replace("\\","",$v);
	$sx=explode("~",$s);
	$s1=$sx[0];
	if(count($sx)>1)$s2=$sx[1];
	else $s2="";
	if($lang=='en') $lbl='Find';
	else $lbl='Cari';
	return "<div style=\"".($s1==''?'float:left':$s1)."\"><input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ")." style=\"".($s2==''?'':$s2.';')."float:left;border-radius:3px 0px 0px 3px\" ".(($v=="")?"":" value=\"".$v."\" ").(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ").($at==""?"":" ".$at." ")."onfocus=\"this.className='iTextx'".$bc2."\" onblur=\"this.className='iText'".$bc."\"/><button class=\"btn\" style=\"border-radius:0px 3px 3px 0px;border-left:none\" title=\"".$lbl."\" onclick=\"".$act."\" style=\"float:left\"><div class=\"bi_srcb\">&nbsp;</div></button></div>";
}

function iTextC($d='',$v='',$s='',$p='',$cb='',$at=''){ $bc=""; $bc2="";
	if($cb!=""){$n=preg_match("/onblur=\".+\"/", $cb,$m); 
	if($n>0){
		$bc=str_replace("\"","",$m[0]);
		$bc=";".str_replace("onblur=","",$bc);
		$cb=str_replace($m[0],"",$cb);
	}}
	if($cb!=""){$n=preg_match("/onfocus=\".+\"/", $cb,$m); 
	if($n>0){
		$bc2=str_replace("\"","",$m[0]);
		$bc2=";".str_replace("onfocus=","",$bc2);
		$cb=str_replace($m[0],"",$cb);
	}}
	if(is_array($v)) $v=$v[$d];
	if(!is_numeric($v)) $v=0;
	if($p==''){
		if(defined('ITEXTC_SHOW_NUL')){
			if(ITEXTC_SHOW_NUL==0) $p='Rp';
		}
	}
	return "<input type=\"text\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"style=\"width:150px\"":" style=\"".$s."\" ")." value=\"".fRp($v)."\" ".(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ").($at==""?"":" ".$at." ")."onfocus=\"this.className='iTextx';ufRpt(this);".$bc2."\" onblur=\"this.className='iText';fRpt(this)".$bc."\"/>";
}

// iPswd (id, input value, style, input value, callback)
function iPswd($d='',$v='',$s='',$p='',$cb='',$at=''){ $bc=""; $bc2="";
	if($cb!=""){$n=preg_match("/onblur=\".+\"/", $cb,$m); 
	if($n>0){
		$bc=str_replace("\"","",$m[0]);
		$bc=";".str_replace("onblur=","",$bc);
		$cb=str_replace($m[0],"",$cb);
	}}
	if($cb!=""){$n=preg_match("/onfocus=\".+\"/", $cb,$m); 
	if($n>0){
		$bc2=str_replace("\"","",$m[0]);
		$bc2=";".str_replace("onfocus=","",$bc2);
		$cb=str_replace($m[0],"",$cb);
	}}
	if(is_array($v)) $v=$v[$d];
	$v=str_replace('"',"''",$v);
	$v=str_replace("\\","",$v);
	return "<input type=\"password\" class=\"iText\"".(($d=="")?"":" id=\"".$d."\" name=\"".$d."\" ").(($s=="")?"":" style=\"".$s."\" ").(($s=="")?"":" value=\"".$v."\" ").(($p=="")?"":" placeholder=\"".$p."\" ").($cb==""?"":" ".$cb." ").($at==""?"":" ".$at." ")."onfocus=\"this.className='iTextx'".$bc2."\" onblur=\"this.className='iText'".$bc."\"/>";
}

// iTextarea (id, array option, value, style, callback)
function iSelect($d,$a,$s='',$y='',$cb='',$atr=''){
	if(is_array($s)) $s=$s[$d];
	$r="<select class=\"iSelect\" id=\"".$d."\" name=\"".$d."\" ".($y==""?"":" style=\"".$y."\" ").($cb==""?"":" onchange=\"".$cb."\" ")." onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\" ".$atr." >";
	if(is_array($a)){if(count($a)>0){foreach($a as $k=>$v){
		$r.="<option value=\"".$k."\"".isSelect($k,$s).">".$v."</option>";
	}}}
	$r.="</select>";
	return $r;
}

// iSOpt array option, value
function iSelectOpt($a,$s=''){
	if(is_array($s)) $s=$s[$d];
	$r="";
	if(is_array($a)){if(count($a)>0){foreach($a as $k=>$v){
		$r.="<option value=\"".$k."\"".isSelect($k,$s).">".$v."</option>";
	}}}
	return $r;
}

// iTextarea (id, value, style, rows)
function iTextarea($d,$v="",$s="",$r=3){
	if(is_array($v)) $v=$v[$d];
	return "<textarea class=\"iTextA\" style=\"".$s."\" rows=\"".$r."\" id=\"".$d."\" name=\"".$d."\" onfocus=\"this.className='iTextAx';iTextA=true\" onblur=\"this.className='iTextA';iTextA=false\">".$v."</textarea>";
}

function iTextedit($d,$v="",$w="",$r=20){
	if(is_array($v)) $v=$v[$d];
	return '<textarea class="mceEditor" id="'.$d.'" name="'.$d.'" rows="'.$r.'" style="width:'.$w.'">'.$v.'</textarea>';
}
function iTexteditLite($d,$v="",$w="",$r=20){
	if(is_array($v)) $v=$v[$d];
	return '<textarea class="mceEditorLite" id="'.$d.'" name="'.$d.'" rows="'.$r.'" style="width:'.$w.'">'.$v.'</textarea>';
}
// inputYear (id, value, callback)
function inputYear($dn,$val="0000",$cb=""){
	$s="<select class=\"iSelect\" id=\"".$dn."\" name=\"".$dn."\" onchange=\"".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">year:</option>";
	for($kk=intval(date("Y"))+3;$kk>=1945;$kk--) {
		$s.="<option value=\"".$kk."\" ".(($kk==$val)?"selected":"")." >".$kk."</option>";
	}
	$s.="</select>";
	return $s;
}
// inputTanggal (id, value, callback)
function inputTanggal($dn,$val="0000-00-00",$cb="",$show="dmY"){
	global $MNTHS;
	$show=strtolower($show);
	if(is_array($val)) $val=$val[$dn];
	if($val=='')$val="0000-00-00";
	$tgl=explode("-",$val); $s=""; if(intval($tgl[1])!=0) $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]))+1; else $dim=32;
	$s.="<div style=\"float:left;margin-right:4px\">";
	$s.="<input type=\"hidden\" id=\"".$dn."\" name=\"".$dn."\" value=\"".$val."\" />";
	$s.="<input type=\"hidden\" id=\"".$dn."f\" name=\"".$dn."f\" value=\"".$val."\" />";
	$s.="<input type=\"hidden\" id=\"".$dn."s\" name=\"".$dn."s\" value=\"".$val."\" />";
	$s.="<select class=\"iSelect\" id=\"".$dn."_d\" name=\"".$dn."_d\" style=\"margin-right:2px".(strpos($show,"d")===false?';display:none':'')."\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">tgl:</option>";
	for($kk=1;$kk<$dim;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[2])?"selected":"")." >".$kk."</option>";
	}
	$s.="</select>";
	$s.="<select class=\"iSelect\" id=\"".$dn."_m\" name=\"".$dn."_m\" style=\"margin-right:2px".(strpos($show,"m")===false?';display:none':'')."\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">bln:</option>";
	for($kk=1;$kk<=12;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[1])?"selected":"")." >".$MNTHS[$kk]."</option>";
	}
	$s.="</select>";
	$s.="<select class=\"iSelect\" id=\"".$dn."_y\" name=\"".$dn."_y\" style=\"".(strpos($show,"y")===false?'display:none':'')."\" onchange=\"inputdateChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\"><option value=\"0\">tahun:</option>";
	for($kk=intval(date("Y"))+5;$kk>=1945;$kk--) {
		$s.="<option value=\"".$kk."\" ".(($kk==$tgl[0])?"selected":"")." >".$kk."</option>";
	}
	$s.="</select>";
	$s.="</div>";
	return $s;
}
// inputDate (id, value, callback)
function inputDate($d,$v="0000-00-00",$cb=""){
	return inputTanggal($d,$v,$cb);
}
function inpDate($d,$v="0000-00-00",$cb=""){
	return inputTanggal($d,$v,$cb);
}
// iRadio (id, name, value, label, input value, style)
function iRadio($d,$n,$v,$l='',$a='',$s='',$attr=''){
	$s='<div '.($s==''?'':'style="'.$s.'"').'><table cellspacing="0" cellpadding="0"><tr>';
	$s.='<td><input type="radio" class="iCheck" id="'.$d.'" name="'.$n.'" value="'.$v.'" '.($v==$a?'checked':'').' '.$attr.' /></td>';
	if($l!='') $s.='<td><label for="'.$d.'" calss="sfont"><div class="sfont" style="padding-left:4px">'.$l.'</div></label></td>';
	$s.='</tr></table></div>';
	return $s;
}
// iCheckbox (id, name, value, label, input value, style, attribute)
function iCheckbox($d,$n,$v,$l='',$a='',$s='',$attr=''){
	$s='<div '.($s==''?'':'style="'.$s.'"').'><table cellspacing="0" cellpadding="0"><tr valign="top">';
	$s.='<td><input type="checkbox" class="iCheck" id="'.$d.'" name="'.$n.'" value="'.$v.'" '.($v==$a?'checked':'').' '.$attr.' /></td>';
	if($l!='') $s.='<td><label for="'.$d.'" calss="sfont"><div class="sfont" style="padding-left:4px">'.$l.'</div></label></td>';
	$s.='</tr></table></div>';
	return $s;
}
// iChecks(id, label, input value, style, attribute)
function iCheckx($d,$l,$v=0,$s='',$atr=''){
	return iCheckbox($d,$d,1,$l,$v,$s,$atr);
}

function inputJamMenit($dn,$val="00:00:00",$cb=""){
	if(is_array($val)) $val=$val[$dn];
	if($val=='')$val="00:00:00";
	$jam=explode(":",$val); $s="";
	$s.="<div style=\"float:left\">";
	
	$s.="<input type=\"hidden\" id=\"".$dn."\" name=\"".$dn."\" value=\"".$val."\" />";
	
	$s.="<select class=\"iSelect\" id=\"".$dn."_h\" name=\"".$dn."_h\" style=\"margin-right:2px\" onchange=\"inputJMChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\">";
	for($kk=0;$kk<24;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$jam[0])?"selected":"")." >".sprintf("%02d",$kk)."</option>";
	}
	$s.="</select>";
	
	$s.="<span style=\"\">&nbsp;:&nbsp;</span>";
	
	$s.="<select class=\"iSelect\" id=\"".$dn."_m\" name=\"".$dn."_m\" style=\"margin-right:2px\" onchange=\"inputJMChange('".$dn."');".$cb."\" onfocus=\"this.className='iSelectx'\" onblur=\"this.className='iSelect'\">";
	for($kk=0;$kk<60;$kk++) {
		$s.="<option value=\"".$kk."\" ".(($kk==$jam[1])?"selected":"")." >".sprintf("%02d",$kk)."</option>";
	}
	$s.="</select>";
	
	$s.="</div>";
	return $s;
}
function iLookupval($id,$v='',$v1='',$act='',$ttl='Cari',$w='250px',$sv=1,$atr='readonly'){
	$act1=$act;
	if($sv!=1){
		$atr=str_replace("readonly","",$atr);
		$act1="";
	}
	$s=iText(($sv==1?'ilv_'.$id:$id),$v,'width:'.$w.';float:left;margin-right:4px','','onclick="'.$act1.'"',$atr);
	$s.='<button title="'.$ttl.'" class="btn" style="float:left;margin-right:4px" onclick="'.$act.'"><div class="bi_srcb">&nbsp;</div></button>';
	if($sv==1) $s.='<input type="hidden" id="'.$id.'" value="'.$v1.'" />';
	return $s;
}

function iBtn($l,$c='',$a='',$s=-1){
	if($s==-1){
		if(defined(SFLOATL)) $s=SFLOATL;
		else $s='float:left;margin-right:4px';
	}
	return '<button '.$a.' class="btn" style="'.$s.'">'.($c==''?$l:'<div class="'.$c.'">'.$l.'</div>').'</button>';
}
?>