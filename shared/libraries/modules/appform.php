<?php
class appform{
	public $fmod='';
	public $idata='';
	public $ndata=0;
	public $registry=0;
	public $lwidth=100;
	public $fwidth=400;
	public $ptop=150;
	
	$app_form_t=Array('a'=>'ditambahkan','u'=>'diedit','d'=>'dihapus');
	
	function __construct($f,$d=''){
	   $this->fmod=$f;
	   if($d=='') $this->idata=ucfirst($this->fmod);
	   else $this->idata=$d;
	}
	function fi($a,$b,$c=''){ // Std Input field (label, field [, field unit])
		echo '<tr><td width="'.$this->lwidth.'px">'.($a==''?'':$a.':').'</td><td>'.$b.($c==''?'':' &nbsp;'.$c).'</td></tr>';
	}
	function fml($a,$b){ // Multi line input field (label, field)
		echo '<tr valign="top"><td width="'.$this->lwidth.'px" style="padding-top:6px">'.$a.':</td><td>'.$b.'</td></tr>';
	}
	function fw($a,$b){ // Wide input field (label, field)
		echo '<tr height="30px"><td colspan="2">'.$a.':</td></tr>';
		echo '<tr><td colspan="2">'.$b.'</td></tr>';
	}
	function fl($a,$b){ // Label field (label, field)
		echo '<tr height="30px"><td width="'.$this->lwidth.'px">'.$a.':</td><td>'.$b.'</td></tr>';
	}
	function ffile($a='File'){ // File field ([label])
		echo '<tr height="30px"><td width="'.$this->lwidth.'px">'.$a.':</td><td>';
		echo '<div style="float:left;position:relative">';
		echo '<input type="hidden" id="ufile" name="ufile" value=""/>';
		echo '<input type="hidden" id="fname" name="ufile" value=""/>';
		echo '<iframe id="imgframe" name="imgframe" scrolling="no" style="float:left;border:none;height:25px;width:230px;overflow:hidden;margin:0;padding:0;" src="fuform.php"></iframe>';
		echo '</div>';
		echo '</td></tr>';
	}
	function gpost_r(){
		$s=Array();
		$a=func_get_args();
		for($i=0;$i<count($a);$i++)$s[$a[$i]]=$this->gpost($a[$i]);
		return $s;
	}
	function inptrim(&$s,$a){
		if(is_array($a)&&is_array($s)){
			for($i=0;$i<count($a);$i++)unset($s[$a[$i]]);
		}
	}
	function head($t){
		echo '<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:'.$ptop.'px"><div id="fformbox" class="fformbox" style="width:'.($fwidth+20).'px"><div class="fformtitle"><span style="float:left">'.ucwords(strtolower($t)).'</span><div id="ffload" class="ffload" style="display:none"></div></div><div id="fformct" class="fformct" style="width:'.$fwidth.'px"><div id="fformcb"><table class="stable" cellspacing="0" cellpadding="4px" width="'.$fwidth.'px">';
	}
	function app_form_foot(){
		global $fmod,$sx,$cid,$gd,$okbtn,$nobtn,$fwidth;
		echo '</table><table cellspacing="0" cellpadding="3px" width="'.$fwidth.'px" style="margin-top:20px"><tr><td align="right"><input type="button" class="btn" onclick="close_fform()" value="'.$nobtn.'"/>&nbsp;<input type="button" class="btnx" value="'.$okbtn.'" onclick="'.$fmod.'_form(\''.$sx.'\','.$cid.','.$gd.')"/></td></tr></table></div></div></div></td></tr></table>';
	}

	function app_form_dlgw($a,$b=''){
		$s='<tr><td><table cellspacing="0" cellpadding="0"><tr valign="top"><td><img src="'.IMGR.'error.png" /></td><td style="padding-left:12px"><div class="psf1215'.($b==''?'0':'5').'">'.$a.'</div>';
		if($b!='')$s.='<div class="psf12150">'.$b.'</div>';
		$s.='</td></tr></table></td></tr>';
		echo $s; 
	}
	function app_form_dlg($a,$b=''){
		$s='<tr><td><div class="ps1215'.($b==''?'0':'5').'">'.$a.'</div>';
		if($b!='')$s.='<div class="ps12150">'.$b.'</div>';
		$s.='</td></tr>';
		echo $s;
	}
	function app_form_del_w($a){
		global $idata;
		return 'Apakah anda yakin untuk menghapus data '.strtolower($idata).' <b>'.$a.'</b>?';
	}
	function app_form_title($a=''){
		global $idata;
		$a=$a==''?$idata:$a;
		$a=ucfirst(strtolower($a));
		return Array('af'=>'Tambah Data '.$a,'uf'=>'Edit Data '.$a,'df'=>'Hapus Data '.$a);
	}
	function gpost($a){
		if(!isset($_POST($a))) return '';
		if(empty($_POST($a))) return '';
		return $_POST[$a];
	}
}
class appform_notif{
	
}
?>