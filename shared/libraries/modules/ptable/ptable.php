<?php
class xtable{
	public $row_isbegin;
	function __construct(){
		$this->row_isbegin=false;
	}
	function begin(){
		echo '<table cellspacing="0" cellpadding="0" style="border-collapse:collapse">';
	}
	function row_begin(){
		if($this->row_isbegin) $this->row_end();
		echo '<tr>';
		$this->row_isbegin=true;
	}
	function row_end(){
		echo '</tr>';
		$this->row_isbegin=false;
	}
	function td($t,$w='',$a='',$at='',$cl=''){
		$a=strtolower($a);
		if($a=='c'||$a=='center')$a='center';
		else if($a=='r'||$a=='right')$a='right';
		else if($a=='j'||$a=='justify')$a='justify';
		else $a='left';
		echo '<td width="'.($w==''?'':$w.'px').'" '.($cl=''?'':'class="'.$cl.'"').' '.$at.' >'.$t.'</td>';
	}
	function head(){
		$a=func_get_args(
	}
	function end(){
		if($this->row_isbegin) $this->row_end();
		echo '</table>';
	}
}
?>