<?php
class fform{
	public $fmod='';
	public $idata='';
	public $ndata=0;
	public $registry=0;
	public $lwidth=100;
	public $fwidth=0;
	public $fwidth_del=0;
	public $rwidth;
	public $rwidths;
	public $rheight;
	public $ptop=150;
	public $fformid='';
	public $cid=0;
	public $opt='';
	public $reg=Array();
	public $yes_act='';
	public $globalkey='1';
	public $box_isbegin;
	public $optional_button;
	public $title_style;
	public $nobtn_action='';
	
	function __construct($f,$o='af',$id=0,$d=''){
		global $APPREG_fform;
		$this->fmod=$f;
		if($d=='') $this->idata=ucfirst($this->fmod);
		else $this->idata=$d;
		$this->opt=$o;
		$this->cid=$id;
		$this->dimension();
		$this->yes_act='';
		$this->box_isbegin=false;
		$this->rheight='30px';
		$this->optional_button='';
		$this->title_style='';
		
		// Registry
		$this->reg['title_af']='Tambah <idata>';
		$this->reg['title_uf']='Edit <idata>';
		$this->reg['title_df']='Hapus <idata>';
		$this->reg['title_hf']='<div style="margin-right:5px;float:left;width:16px;height:16px;background:url(\''.IMGR.'helpico.png\')"></div><div style="float:left;margin-top:-2px"><idata></div>';
		$this->reg['dlg_del']='Apakah anda yakin untuk menghapus <idata> <data>?';
		$this->reg['notif_a']='Data <idata> telah ditambahkan.';
		$this->reg['notif_u']='Data <idata> telah diedit.';
		$this->reg['notif_d']='Data <idata> telah dihapus.';
		$this->reg['notif_a_fail']='Data <idata> tidak dapat ditambahkan. Terjadi kesalahan teknis program, silahkan menghubungi administrator.';
		$this->reg['notif_u_fail']='Data <idata> tidak dapat diedit. Terjadi kesalahan teknis program, silahkan menghubungi administrator.';
		$this->reg['notif_d_fail']='Data <idata> tidak dapat dihapus. Terjadi kesalahan teknis program, silahkan menghubungi administrator.';
		$this->reg['btnlabel_a_y']='Simpan';
		$this->reg['btnlabel_a_n']='Batal';
		$this->reg['btnlabel_u_y']='Simpan';
		$this->reg['btnlabel_u_n']='Batal';
		$this->reg['btnlabel_d_y']='Hapus';
		$this->reg['btnlabel_d_n']='Tidak';
		$this->reg['btnlabel_h_y']=' OK ';
		$this->reg['btnlabel_yes']='Ya';
		$this->reg['btnlabel_no']='Tidak';
		
		foreach($this->reg as $k=>$v){
			if(isset($APPREG_fform[$k]) && !empty($APPREG_fform[$k])){
				$this->reg[$k]=$APPREG_fform[$k];
			}
		}
		
		$this->globalkey='1';
	}
	function dimension($a=400,$b=100,$c=100){
		$this->fwidth=$a;
		$this->fwidth_del=$a+100;
		$this->lwidth=$b;
		$this->ptop=$c;
		$this->rwidth=$this->fwidth-$this->lwidth-18;
		$this->rwidths="width:".$this->rwidth."px";
	}
	function fg($a,$b=''){ // Std Input group (label)
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr><td width="*" colspan="2"><b>'.($a==''?'':$a.':').'</b>'.($b==''?'':'&nbsp'.$b).'</td></tr>';
	}
	function fi($a,$b,$c=''){ // Std Input field (label, field [, field unit])
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr><td width="'.$this->lwidth.'px">'.($a==''?'':$a.':').'</td><td>'.$b.($c==''?'':' &nbsp;'.$c).'</td></tr>';
	}
	function fa($a,$b){ // Multi line input field (label, field)
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr valign="top"><td width="'.$this->lwidth.'px" style="padding-top:6px">'.$a.':</td><td>'.$b.'</td></tr>';
	}
	function fw($a,$b){ // Wide input field (label, field)
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr height="'.$this->rheight.'"><td colspan="2">'.$a.':</td></tr>';
		echo '<tr><td colspan="2">'.$b.'</td></tr>';
	}
	function fl($a,$b){ // Label field (label, field)
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr valign="top" height="'.$this->rheight.'"><td width="'.$this->lwidth.'px">'.$a.':</td><td>'.nl2br($b).'</td></tr>';
	}
	function fr($a,$b){ // Label field (label, field)
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		echo '<tr><td width="'.$this->lwidth.'px">'.$a.':</td><td>'.$b.'</td></tr>';
	}
	function ft($a,$b){
		echo '<tr height="'.$this->rheight.'"><td colspan="2">'.$a.':</td></tr>';
		echo '<tr><td colspan="2">'.$b.'</td></tr>';
	}
	function fc($a,$ds=''){ // One row one column
		echo '<tr height="'.$this->rheight.'"><td colspan="2"><div style="'.$ds.'">'.$a.'</div></td></tr>';
	}
	function fh($a){ // Help
		echo '<tr><td colspan="2"><div class="psf12150" style="text-align:justify">'.$a.'</div></td></tr>';
	}
	function ffval($id,$v='',$v1='',$act='',$ttl='Cari',$sv=1,$atr='readonly',$w=0){
		$act1=$act;
		if($sv!=1){
			$atr=str_replace("readonly","",$atr);
			$act1="";
		}
		$w=$w===0?($this->rwidth-30).'px':$w;
		$s=iText(($sv==1?'ffval_'.$id:$id),$v,'width:'.$w.';float:left;margin-right:4px','','onclick="'.$act1.'"',$atr);
		$s.='<button title="'.$ttl.'" class="btn" style="float:left;margin-right:4px" onclick="'.$act.'"><div class="bi_srcb">&nbsp;</div></button>';
		if($sv==1) $s.='<input type="hidden" id="'.$id.'" value="'.$v1.'" />';
		return $s;
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
	function head($t='',$ut=1){
		$t=$t==''?$this->idata:$t;
		$t=substr($this->idata,0,1)=='!'?substr($this->idata,1):ucwords(strtolower($t));
		$t=str_replace('<idata>',$t,$this->reg['title_'.$this->opt]);
		$fw=$this->opt=='df'?$this->fwidth_del:$this->fwidth;
		$fw=$this->opt=='hf'?500:$fw;
	
		echo '<table cellspacing="0" cellpadding="0" width="100%"><tr>',
		'<td id="fformt'.$this->fformid.'" align="center" style="padding-top:'.$this->ptop.'px">',
		'<div id="fformbox'.$this->fformid.'" class="fformbox" style="padding:5px;width:'.($fw+20).'px;margin-bottom:30px">';
		if($ut==1)
		echo '<div id="fform_title'.$this->fformid.'" class="fformtitle" style="'.$this->title_style.'"><span style="margin-left:-2px;float:left">'.$t.'</span><div id="ffload'.$this->fformid.'" class="ffload" style="display:none"></div></div>';
		else echo '<div id="fform_title'.$this->fformid.'" class="fformtitle" style="display:none"><span style="margin-left:-2px;float:left">'.$t.'</span><div id="ffload" class="ffload" style="display:none"></div></div>';		
		echo '<div id="fformct'.$this->fformid.'" class="fformct" style="width:'.$fw.'px"><div id="fformcb"><div style="">',
		'<table class="stable" cellspacing="0" cellpadding="4px" width="'.$fw.'px">';
		
		$this->rwidths="width:".($this->fwidth-$this->lwidth-18)."px";
		
		$this->nobtn_action='close_fform'.$this->fformid.'();';
	}
	function foot($y=1,$no=1){
		if($this->box_isbegin) $this->box_end();
		
		$sx=str_replace('f','',$this->opt);
		$g=$this->opt=='df'?'false':'true';
		$fw=$this->opt=='df'?$this->fwidth_del:$this->fwidth;
		$fw=$this->opt=='hf'?500:$fw;
		$this->yes_act=$this->yes_act==''?$this->fmod.'_form(\''.$sx.'\',\''.$this->cid.'\','.$g.')':$this->yes_act;
		
		if($this->opt=='hf'){
			$this->yes_act='close_fform()'; $no=0;
		}
		
		echo '</table></div>',
		'<table cellspacing="0" cellpadding="3px" width="'.$fw.'px" style="margin-top:10px"><tr>'.($this->optional_button==''?'':'<td>'.$this->optional_button.'</td>').'<td style="" align="right" width="140px">';
		if($no==1) echo'<input id="fform_no_btn" type="button" class="btn" onclick="'.$this->nobtn_action.'" value="'.$this->btnlabel_n().'"/>';
		if($y==1) echo '&nbsp;<input id="fform'.$this->fformid.'_yes_btn" type="button" class="btnz" value="'.$this->btnlabel_y().'" onclick="'.$this->yes_act.'"/>';
		echo '<input type="hidden" id="fform'.$this->fformid.'_action" value="'.$this->yes_act.'"/>',
		'<input type="hidden" id="fform'.$this->fformid.'_option" value="'.$this->opt.'"/>',
		'<input type="hidden" id="fform'.$this->fformid.'_globalkey" value="'.$this->globalkey.'"/>',
		'</td></tr></table>',
		'</div></div></div></td></tr></table>';
	}

	function dlgw($a,$b=''){
		$s='<tr><td coslpan="2">';
		$s.='<table cellspacing="0" cellpadding="0"><tr valign="top"><td><img src="'.(defined('IMGR')?IMGR:'').'error.png" /></td>';
		$s.='<td style="padding-left:12px">';
		$s.='<div class="psf1215'.($b==''?'0':'5').'">'.$a.'</div>';
		if($b!='')$s.='<div class="psf12150">'.$b.'</div>';
		$s.='</td></tr></table></td></tr>';
		echo $s; 
	}
	function dlg($a,$b=''){
		$s='<tr><td coslpan="2"><div class="ps1215'.($b==''?'0':'5').'">'.$a.'</div>';
		if($b!='')$s.='<div class="ps12150">'.$b.'</div>';
		$s.='</td></tr>';
		echo $s;
	}
	function dlg_del($a=''){
		$t=substr($this->idata,0,1)=='!'?substr($this->idata,1):strtolower($this->idata);
		$t=str_replace('<idata>',$t,$this->reg['dlg_del']);
		if($a!='')
			$t=str_replace('<data>','<b>'.$a.'</b>',$t);
		else
			$t=str_replace('<data>','',$t);
		$this->dlg($t);
	}
	function dlg_delw($a='',$b='',$c=''){
		$t=substr($this->idata,0,1)=='!'?substr($this->idata,1):strtolower($this->idata);
		$t=str_replace('<idata>',$t,$this->reg['dlg_del']);
		$b=$b==''?'':$b.'<br/>';
		if($a!='')
			$t=str_replace('<data>','<b>'.$a.'</b>',$t);
		else
			$t=str_replace('<data>','',$t);
		$this->dlgw($b.$t,$c);
	}
	function btnlabel_y(){
		$o=$this->opt;
		if($o=='af') return $this->reg['btnlabel_a_y'];
		if($o=='uf') return $this->reg['btnlabel_u_y'];
		if($o=='df') return $this->reg['btnlabel_d_y'];
		if($o=='hf') return $this->reg['btnlabel_h_y'];
		return $this->reg['btnlabel_yes'];
	}
	function btnlabel_n(){
		$o=$this->opt;
		if($o=='af') return $this->reg['btnlabel_a_n'];
		if($o=='uf') return $this->reg['btnlabel_u_n'];
		if($o=='df') return $this->reg['btnlabel_d_n'];
		return $this->reg['btnlabel_no'];;
	}
	// Plug in function
	function notif($a,$c=0,$s=0,$m=''){
		$t=substr($this->idata,0,1)=='!'?substr($this->idata,1):strtolower($this->idata);
		if($a){
			$r=$this->reg['notif_'.$this->opt];
			$r=str_replace('<idata>',$t,$r);
			if($c!=0) $r.=' Error code:'.$c;
			if($s!=0){
				$r.=' '.$_SESSION['libdb_dbIsert'];
				log_print($_SESSION['libdb_dbIsert']);
			}
			if($m!='') $r.=' Message:'.$m;
			//$_SESSION[ASID.'notifbox']='<div id="notifbox" class="infobox" >'.$r.'</div>';
			$_SESSION[ASID.'notifbox']='<div id="notifbox" style="position:fixed;width:100%;top:140px;left:0px"><table style="position:relative;margin:auto" cellspacing="0" cellpadding="0"><tr><td><div style="position:relative;'.SFONT12.';color:'.CDARK.';cursor:default;padding:4px 8px 2px 20px;border:1px solid #ffc000;border-radius:2px;background:url(\''.IMGR.'info.png\') 4px 6px no-repeat #fff8d6;line-height:150%;box-shadow:0px 2px 5px rgba(0,0,0,0.4);margin:auto"><b>'.$r.'</b></div></td></tr></table></div>';
			if($s!=0) $r.=' '.$_SESSION['libdb_dbIsert'];
		}
		else{
			$r=$this->reg['notif_'.$this->opt.'_fail'];
			$r=str_replace('<idata>',$t,$r);
			if($c!=0) $r.=' Error code:'.$c;
			if($s!=0) $r.=' '.$_SESSION['libdb_dbIsert'];
			if($m!='') $r.=' Message:'.$m;
			//$_SESSION[ASID.'notifbox']='<div id="notifbox" class="warnbox" style="float:left">'.$r.'</div>';
			$_SESSION[ASID.'notifbox']='<div id="notifbox" style="position:fixed;width:100%;top:140px;left:0px"><table style="position:relative;margin:auto" cellspacing="0" cellpadding="0"><tr><td><div style="position:relative;'.SFONT12.';color:'.CDARK.';cursor:default;padding:4px 8px 2px 20px;border:1px solid #ffc000;border-radius:2px;background:url(\''.IMGR.'info.png\') 4px 6px no-repeat #fff8d6;line-height:150%;box-shadow:0px 2px 5px rgba(0,0,0,0.4);margin:auto"><b>'.$r.'</b></div></td></tr></table></div>';
		}
	}
	
	function tab($l,$a='',$c=''){
		echo '<div class="fftab'.$a.'" onclick="'.$c.'">'.$l.'</div>';
	}
	function tabbar(){
		$a=func_get_args();
		$n=count($a);
		if($n>0){
			echo '<div class="fftabbar">';
			for($i=0;$i<$n;$i++){
				tab($a[$i][0],$a[$i][1],$a[$i][2]);
			}
			echo '</div>';
		}
	}
	
	function box_begin(){
		echo '<tr><td><div id="data_siswa" style="height:350px;overflow:auto">';
		$this->box_isbegin=true;
	}
	function box_end(){
		echo '</div></td></tr>';
		$this->box_isbegin=false;
	}
}
?>