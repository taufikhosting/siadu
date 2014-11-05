<?php
// Page Selection bar >>
// Page selection bar Tipe 1: Satu select sejajar dengan tombol option
class PSBar_1{
	public $selw;
	public $lblw;
	private $bbo;
	public $pass;
	function __construct($lw='140px',$sw='300px'){
		$this->lblw=$lw;
		$this->selw=$sw;
		$this->bbo=false;
		$this->pass=true;
	}
	function begin($a='',$fmod='',$dept=0){
		echo '<table class="stable" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom:5px"><tr>';
		if($a!=''){
			if($a=='Departemen'){
				$this->lblw='100px';
				$this->label($a);
				$this->selection_departemen($fmod,$dept);
			} else {
				$this->label($a);
			}
		}
	}
	function end(){
		if($this->bbo) echo '</td>';
		echo '</tr></table>';
	}
	function label($a){
		echo '<td width="'.$this->lblw.'" align="left"><b>'.$a.':</b></td>';
	}
	function optbtns(){
		$this->bbo=true;
		echo '<td align="right">';
	}
	function selection($a){
		echo '<td align="left" width="'.$this->selw.'">';
		echo $a;
		echo '</td>';
		$this->optbtns();
	}
	function selection_departemen($fmod,$dept){
		$a=0;
		$departemen=departemen_r($a);
		if(admin_is_alldept()) $s=iSelect('departemen',$departemen,$dept,'width:'.$this->selw,$fmod."_get()");
		else $s='<b>'.departemen_name($dept).'</b><input type="hidden" id="departemen" value="'.$dept.'"/>';
		$this->selection($s);
	}
}

// Page selection bar Tipe 2: Beberapa select berjajar ke bawah dengan garis putih di bawah
class PSBar_2{
	public $selw;
	public $selws;
	public $lblw;
	private $bbo;
	private $tbegin;
	public $pass;
	public $label_bold;
	function __construct($lw='80px',$sw='300px'){
		$this->lblw=$lw;
		$this->selw=$sw;
		$this->selws='width:'.$sw;
		$this->bbo=false;
		$this->pass=true;
		$this->tbegin=false;
		$this->label_bold=true;
	}
	function begin(){
		echo '<div class="tbltopmbar" style="width:100%"><table class="stable" cellspacing="0" cellpadding="0" width="100%">';
		$this->tbegin=true;
	}
	function end(){
		if($this->bbo) $this->selection_end();
		if($this->tbegin){
			echo '</table></div>';
			$this->tbegin=false;
		}
	}
	function set_selw($sw){
		$this->selw=$sw;
		$this->selws='width:'.$sw;
	}
	function label($a){
		if($this->label_bold)
			echo '<td width="'.$this->lblw.'" align="left"><b>'.($a!=''?$a.':':'').'</b></td>';
		else
			echo '<td width="'.$this->lblw.'" align="left">'.($a!=''?$a.':':'').'</td>';
	}
	function selection($a='',$s='',$w=''){
		$this->bbo=true;
		echo '<tr height="28px">';
		$this->label($a);
		if($s!=''){
			$w=$w==''?$this->selw:$w;
			echo '<td width="'.$w.'">'.$s.'</td>';
		}
		$this->selection_end();
	}
	function selection_end(){
		$this->bbo=false;
		echo '<td width="*">&nbsp;</td></tr>';
	}
	function selection_departemen($fmod,$dept){
		$a=0; $departemen=departemen_r($a);
		echo '<tr height="26px"><td width="100px" align="left"><b>Departemen:</b></td>';
			if(admin_is_alldept()){
			echo '<td width="'.$this->lblw.'">'.iSelect('departemen',$departemen,$dept,"width:".$this->selw,$fmod."_get()").'</td>';
			} else {
			echo '<td width="150px" align="left"><b>'.departemen_name($dept).'</b><input type="hidden" id="departemen" value="'.$dept.'"/></td>';
			}
		echo '<td width="*">&nbsp;</td></tr>';
	}
	function info($a){
		echo '<tr><td colspan="2">'.$a.'</td></tr>';
	}
}

// Page selection bar Tipe 3: Beberapa select berjajar ke kanan
class PSBar_3{
	public $selw;
	public $selws;
	public $lblw;
	private $bbo;
	public $lblm;
	public $selm;
	public $pass;
	function __construct($lw='80px',$sw='300px'){
		$this->lblw=$lw;
		$this->selw=$sw;
		$this->selws='width:'.$sw;
		$this->bbo=false;
		$this->lblm=20;
		$this->selm=20;
		$this->pass=true;
	}
	function begin(){
		if($this->bbo)$this->end();
		echo '<div class="tbltopbar" style="float:left;width:100%;maring-bottom:2px">';
		$this->bbo=true;
	}
	function end(){
		echo '</div>';
		$this->bbo=false;
	}
	function set_selw($sw){
		$this->selw=$sw;
		$this->selws='width:'.$sw;
	}
	function label($a='',$m=''){
		if($m===0) $this->lblm=20;
		else if($m>0) $this->lblm=$m;
		
		echo '<div style="padding-top:4px;float:left;margin-right:'. $this->lblm.'px"><b>'.$a.':</b></div>';
	}
	function selection($a='',$b='',$m1='',$m2=''){
		if($a!='') $this->label($a,$m1);
		
		if($m2===0) $this->selm=20;
		else if($m2>0) $this->selm=$m2;
		echo '<div style="float:left;margin-right:'.$this->selm.'px">'.$b.'</div>';
	}
}
// End of Page Selection bar >>
?>