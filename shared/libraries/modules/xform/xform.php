<?php
class xform{
	public $fmod;
	public $opt;
	public $cid;
	public $labelw=100;
	public $fieldw=250;
	public $fieldws='width:250px';
	private $tb=false;
	private $cb=false;
	private $gb=false;
	public $back_act='';
	private $ng=0;
	public $grupclass='flodiv';
	public $grupstyle='';
	public $tablestyle='';
	public $tablewidth='100%';
	public $btn_yes='';
	public $btn_no='';
	public $showtitle=1;
	public $photodir='photo/';
	
	function __construct($f,$o='',$c=0){
		$this->fmod=$f;
		$this->opt=$o==''?gpost('opt'):$o;
		$this->cid=$c==''?gpost('cid',0):$c;
		$this->set_labelw(100);
		$this->set_fieldw(250);
		$this->tb=false;
		$this->cb=false;
		$this->gb=false;
		$this->ng=0;
		$this->back_act=$this->fmod.'_get()';
		$this->grupclass='flodiv';
		$this->grupstyle='';
		$this->tablestyle='float:left;border:1px solid rgba(0, 0, 0, .3);background:#fcfcff;margin-bottom:10px';
		$this->tablewidth='100%';
		$this->btn_yes='';
		$this->btn_no='';
		$this->showtitle=1;
	}
	
	function title($a,$s=1){
		$this->showtitle=$s;
		echo '<input type="hidden" id="xform_title" value="'.$this->toTitle($a).'" />';
		if($this->showtitle==1){
		echo '<div class="hl1" style="margin-bottom:20px">'.$this->toTitle($a).'</div>';
		}
	}
	
	function table_begin($t=''){
		if($this->tb){
			$this->table_end(0);
		}
		//box-shadow: 0px 1px 1px rgba(0, 0, 0, .4)
		echo '<div style="'.$this->tablestyle.';width:'.$this->tablewidth.'">';
		if($t!=''){
			$pat="/\{.+\}/i";
			if(preg_match($pat,$t,$mat)){
				$sc=$mat[0];
				$sc=str_replace("{","",$sc);
				$sc=str_replace("}","",$sc);
				$t=preg_replace($pat,"",$t);
			} else {
				$sc="#01a8f7";
			}
			echo '<div style="float:left;width:100%;padding:3px 0px 4px 0px;background:'.$sc.';margin-bottom:4px"><div class="sfont" style="color:#fff;font-size:13px">&nbsp;&nbsp;'.$t.'</div></div>';
		}
		//echo '<div style="width:100%;float:left;padding:0px">';
		echo '<table style="" cellspacing="10px" cellpadding="0" width="100%"><tr valign="top"><td>';
		echo '<table style="" cellspacing="0" cellpadding="0" width="100%"><tr valign="top">';
		$this->tb=true;
	}
	function table_end($e=1){
		if($this->cb) $this->col_end();
		echo '</tr></table></td></tr></table></div>';
		$this->tb=false;
		
		if($e==1){
			$lang=admin_getLang();
			if($lang=='en'){
				$batal=$this->btn_no==''?'Cancel':$this->btn_no;
				$simpan=$this->btn_yes==''?'Save':$this->btn_yes;
			} else {
				$batal=$this->btn_no==''?'Batal':$this->btn_no;
				$simpan=$this->btn_yes==''?'Simpan':$this->btn_yes;
			}
			echo '<div style="float:left;width:100%;text-align:center;margin-bottom:10px;margin-top:10px">';
			echo '<button class="btn" style="margin-right:4px" onclick="'.$this->back_act.'">'.$batal.'</button>';
			echo '<button class="btnz" onclick="'.$this->fmod.'_form(\''.substr($this->opt,0,1).'\','.$this->cid.',true)">'.$simpan.'</button>';
			echo '</div>';
		}
		
	}
	function col_begin($w=''){
		if($this->cb) $this->col_end();
		echo '<td width="'.$w.'">';
		$this->cb=true;
		$this->ng=0;
	}
	function col_end(){
		if($this->gb) $this->group_end();
		echo '</td>';
		$this->cb=false;
	}
	
	function set_labelfieldw($w=0,$f=0){
		$this->set_labelw($w);
		$this->set_fieldw($f);
	}
	function set_fieldw($f){
		if($f===0){
			$this->fieldw=250;
			$this->fieldws='width:'.$this->fieldw.'px';
		}
		else if($f>0){
			$this->fieldw=$f;
			$this->fieldws='width:'.$this->fieldw.'px';
		}
	}
	function set_labelw($w){
		if($w===0){
			$this->labelw=100;
		}
		else if($w>0){
			$this->labelw=$w;
		}
	}

	function group_begin($a,$w='',$f=''){
		if($this->gb) $this->group_end();
		echo '<div class="'.$this->grupclass.'" style="width:100%;'.$this->grupstyle.'">';
		echo '<div class="sfont" style="margin-top:'.($this->ng>0?'14':'6').'px;height:24px;width:100%"><b>'.$this->toTitle($a).':</b></div>';
		$this->set_labelfieldw($w,$f);
		$this->gb=true;
		$this->ng=$this->ng+1;
	}
	
	function group_end(){
		echo '</div>';
		$this->gb=false;
	}
	
	function fi($a,$f){
		echo '<div class="xrowl"><div class="xlabel" style="width:'.$this->labelw.'px">'.($a==''?'':$a.':').'</div><div class="sfont" style="float:left;width:'.$this->fieldw.'px">';
		$f=str_replace('<l>','<div class="xlabel">',$f);
		$f=str_replace('</l>','</div>',$f);
		echo $f;
		echo '</div></div>';
	}
	
	// by : epiii ------------
	function fi2($a,$f,$f2){
		$out='<div class="xrowl">
				<div class="xlabel" style="width:'.$this->labelw.'px">
					'.($a==''?'':$a.':').'
				</div>
				<div class="sfont" style="float:left;width:'.$this->fieldw.'px">
					'.$f.$f2.'
				</div>
			</div>';
		echo $out;
	}
	//end of by : epiii ------------

	function fl($a,$f){
		echo '<div class="xrowl"><div class="xlabel" style="width:'.$this->labelw.'px">'.$a.':</div><div class="xlabel" style="height:20px;width:'.$this->feildw.'px">';
		echo $f;
		echo '</div></div>';
	}
	function photof($d=0,$f='$',$w=168,$h=224,$r='w'){
		if(empty($d))$d=0;
		if($d!=0 && file_exists($this->photodir.$f.'.php')){
			if($r=='w'){
				$sz='height="'.$h.'px"';
			} else {
				$sz='width="'.$w.'px"';
			}
			//$imgsz=getimagesize('photo/'.$f.'.php?id='.$d);
			//print_r($imgsz);
			echo '<div id="photoframe" style="float:left;border:1px solid #b7b7b7;background:url(\''.IMGR.'loader8.gif\') center no-repeat #ddd;margin-bottom:10px">';
			echo '<img id="tphoto" style="float:left" src="'.$this->photodir.$f.'.php?id='.$d.'" '.$sz.' style="display:"/>';
			echo '</div>';
		} else {
			echo '<div id="photoframe" style="float:left;border:1px solid #b7b7b7;width:'.($w==0?'150px':$w.'px').';height:'.$h.'px;background:url(\''.IMGR.'loader8.gif\') center no-repeat #ddd;margin-bottom:10px">';
			echo '<img id="tphoto" src="photo/nophoto.jpg" width="'.($w==0?'150px':$w.'px').'" height="'.$h.'px" style="display:"/>';
			echo '</div>';
		}
	}
	function fphoto($d=0,$f='$',$w=168,$h=224,$r='w'){
		$lang=admin_getLang();
		if($lang=='en')$lbl='Image';
		else $lbl='Foto';
		echo '<div class="xrowl">';
		$this->photof($d,$f,$w,$h,$r);
		echo '</div>';
		echo '<div class="xrowl">';
		echo '<div class="xlabel" style="width:60px">'.$lbl.':</div>';
		echo '<input type="hidden" id="photo" name="photo" value=""/>';
		echo '<div style="float:left;position:relative">';
		echo '<iframe id="imgframe" name="imgframe" scrolling="no" style="float:left;border:none;height:25px;width:230px;overflow:hidden;margin:0;padding:0;" src="trform.php?ow='.$w.'&oh='.$h.'&rel='.$r.'"></iframe>';
		echo '</div>';
		echo '</div>';
	}
	function toLabel($a){
		if(substr($a,0,1)!='!'){
			return strtolower($a);
		}
		else return substr($a,1);
	}
	function toTitle($a){
		if(substr($a,0,1)!='!'){
			return ucwords(strtolower($a));
		}
		else return substr($a,1);
	}
	
	function group_unflowdiv(){
		$this->grupclass=''; $this->grupstyle='float:left';
	}
	
	function group_reflowdiv(){
		$this->grupclass='flodiv';
		$this->grupstyle='';
	}
		
	
}
?>