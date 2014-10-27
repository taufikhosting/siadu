<?php
$filetype=gets('filetype');
$file=gets('file');
$doc=gets('doc');
$doprint=gets('doprint');
$content=$doc!=''?ROTDIR.'print/'.$doc.'.php':VWDIR.$file.'.php';
$docname=gets('docname','SIADU-Akademik');

if($filetype=='xls'){
define('DOCPAPERWIDTH','1000');
define('FRP_DISABLE',1);
define('DOCBORDER','0.5pt solid');
define('DOCTYPE','xls');
define('DOCUNIT','pt');
} else {
define('DOCPAPERWIDTH','100%');
define('DOCBORDER','1px solid #000');
define('DOCTYPE','web');
define('DOCUNIT','px');
}

if($filetype=='xls'){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
	header('Content-Type: application/x-msexcel'); // Other browsers  
	header('Content-Disposition: attachment; filename='.$docname.'.xls');
	header('Expires: 0');  
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}

echo '<html><head><title>'.$docname.'</title>';
//require_once(SHAREDSTYLE.'main.php');
require_once(SHAREDSTYLE.'print'.($filetype=='xls'?'xls':'').'.php');
echo '</head><body onload="'.($filetype=='xls'?'':($doprint=='0'?'':'print()')).'">';

// Printable Document function >>
class doc {
	public $style;
	public $RIB;
	public $cellformat;
	function __construct($b=0){
		$this->style='';
		$this->RIB=false;
		$this->table_begin($b);
		$this->cell_format_reset();
	}
	function end(){
		$this->table_end();
	}
	function nofile(){
		echo 'File tidak tersedia.';
	}
	function table_begin($b=0){
		echo '<table '.($b==1?'class="btable"':'').' cellspacing="0px" cellpadding="4px" width="'.DOCPAPERWIDTH.'" style="border-collapse:collapse" '.($b==1?'border="1"':'').'>';
		$this->row_begin();
	}
	function table_end(){
		if($this->RIB)$this->row_end();
		echo '</table>';
	}
	function head_thf($k,$sr=''){
		$thf=array('title'=>'','width'=>'*','align'=>'l','sortby'=>'','sort'=>false,'hidden'=>'','cs'=>1,'rs'=>1);
		if(substr($k,0,1)=='@'){$thf['sort']=true; $k=substr($k,1);}
		else {$thf['sort']=false;}
		$s=explode("~",$k);
		$ns=count($s);
		if($ns>1){
			$al='left'; $hw='';
			if($ns>1){
				$al=strtolower($s[1]);
				if($al=='c')$al='center';
				else if($al=='r')$al='right';
				else $al='left';
				$k=$s[0];
			}
			if($ns>2){
				$hw=$s[2];
			}
			$thf['width']=$hw;
			$thf['align']=$al;
		} else {
			$pat="/\{[0-9,clrpxh\%]+\}/i";
			if(preg_match($pat,$k,$mathces)){
				$fmt=$mathces[0];
				//echo 'Format:'.$fmt.'<br/>';
				if(preg_match("/h/i",$fmt,$match)){
					//echo 'width:'.$match[0].'<br/>';
					$thf['hidden']=$match[0];
					$fmt=preg_replace("/h/i","",$fmt);
				}
				if(preg_match("/[0-9]+(px|\%)/",$fmt,$match)){
					//echo 'width:'.$match[0].'<br/>';
					$thf['width']=$match[0];
					$fmt=preg_replace("/[0-9]+(px|\%)/","",$fmt);
				}
				if(preg_match("/[clr]/i",$fmt,$match)){
					//echo 'align:'.strtolower($match[0]).'<br/>';
					$al=strtolower($match[0]);
					if($al=='r')$thf['align']='right';
					else if($al=='c')$thf['align']='center';
					else $thf['align']='left';
					$fmt=preg_replace("/[clr]/i","",$fmt);
				}
				if(preg_match_all("/[0-9]+/",$fmt,$match)){
					$nm=count($match[0]);
					//echo 'rs:'.$match[0][0].'<br/>';
					$thf['rs']=intval($match[0][0]);
					if($nm>1){
						//echo 'cs:'.$match[0][1].'<br/>';
						$thf['cs']=intval($match[0][1]);
					}
					else {
						//echo 'cs:1<br/>';
						$thf['cs']=1;
					}
					if($thf['cs']>$this->head_mxcs)$this->head_mxcs=$thf['cs'];
					if($thf['rs']>$this->head_mxrs)$this->head_mxrs=$thf['rs'];
				}
				$k=preg_replace($pat,"",$k);
			}
		}
		$thf['title']=$this->format_title($k);
		$thf['sortby']=$this->format_word($k);
		$thf['sr']=$sr;
		return $thf;
	}
	
	function format_title($a){
		if(substr($a,0,1)!='!'){
			$a=ucwords(strtolower($a));
		} else {
			$a=substr($a,1);
		}
		return $a;
	}
	function format_label($a){
		if(substr($a,0,1)!='!'){
			$a=ucfirst(strtolower($a));
		} else {
			$a=substr($a,1);
		}
		return $a;
	}
	function format_word($a){
		if(substr($a,0,1)!='!'){
			$a=strtolower($a);
		} else {
			$a=substr($a,1);
		}
		return $a;
	}
	function head_th($t){
		$hw=$t['width'];
		$al=$t['align'];
		$rs=$t['rs'];
		$cs=$t['cs'];
		$ttl=$t['title'];
		$al=strtolower($al);
		if($al=='l'||$al=='left')$al='l';
		else if($al=='r'||$al=='right')$al='r';
		else if($al=='c'||$al=='center')$al='c';
		else $al='l';
		
		$this->cell('<b>'.$ttl.'</b>',$hw,$al,$cs,$rs);
	}
	
	function head(){ // '<title>~<alignment>~<width>~<c,r>'
		$this->cell_format('border:1');
		$this->nl(30);
		
		$a=func_get_args();
		if(is_array($a[0])) $a=$a[0];
		$n=count($a); $sr=1; $oih=false;
		if(preg_match("/^\{[0-9]+px\}$/",$a[$n-1])){
			$k=str_replace("{","",$a[$n-1]);
			$k=str_replace("}","",$k);
			$n-=1;
			$this->opt_w=$k;
		}
		for($i=0;$i<$n;$i++){
			$k=$a[$i];
			if($k!=''){
			$thf=$this->head_thf($a[$i],$sr);
			$this->head_th($thf);
			$sr++;
			}
		}
		
		//$this->cell_format_reset();
	}
	
	function dochead($a,$c=1){
		echo '<td class="dochead1" colspan="'.$c.'" align="center"><b>'.$a.'</b></td>';
	}
	function row_begin($h=0,$v='middle'){
		if($this->RIB)$this->row_end();
		echo '<tr '.($h>0?'height="'.$h.'"':'').' valign="'.$v.'">';
		$this->RIB=true;
	}
	function row_end(){
		echo '</tr>';
		$this->RIB=false;
	}
	function nl($h=20,$v='middle'){
		$this->row_begin($h,$v);
	}
	function row_blank($c=1,$h=0){
		$a=$this->cell_format_get();
		$this->cell_format_reset();
		$this->nl($h);
		$this->cell('',0,'',$c);
		$this->cell_format_set($a);
	}
	function cell($a,$w=0,$al='',$c=1,$r=1,$b=-1,$bg='',$s='',$atr=''){
		if($al=='')$al=$this->cellformat['align'];
		if($b==-1)$bo=$this->cellformat['border'];
		else $bo='';
		if($bg=='')$bg=$this->cellformat['background'];
		
		if($b===1||$b===0){
			$bo=$b==1?';border:'.DOCBORDER:'';
		} else {
			$b=strtolower($b);
			if(strpos($b,"t")!==false) $bo.=';border-top:'.DOCBORDER;
			if(strpos($b,"b")!==false) $bo.=';border-bottom:'.DOCBORDER;
			if(strpos($b,"l")!==false) $bo.=';border-left:'.DOCBORDER;
			if(strpos($b,"r")!==false) $bo.=';border-right:'.DOCBORDER;
			//echo $b;
		}
		
		$fz=$this->cellformat['font-size']!=''?';font-size:'.$this->cellformat['font-size']:'';
		$cl=$this->cellformat['color']!=''?';color:'.$this->cellformat['color']:'';
		
		$sy='style="background:'.$bg.$bo.($s==''?'':';'.$s).$fz.$cl.'"';
		
		$al=strtolower($al);
		if($al=='c')$al='center';
		if($al=='r')$al='right';
		if($al=='l')$al='left';
		if($al=='j')$al='justify';
		if($al=='')$al='left';
		
		$pat="/\[x\:.+$/";
		if(preg_match($pat,$a,$mat)){
			$xn=str_replace("[","",$mat[0]);
			$xn=str_replace("]","",$xn);
			$atr.=' '.$xn;
			$a=preg_replace($pat,"",$a);
		}
		if(!is_numeric($w)){
			if(DOCTYPE=='xls') $w=intval($w);
		}
		echo '<td colspan="'.$c.'" rowspan="'.$r.'" '.($w>0?' width="'.$w.'px" ':'width="*"').' align="'.$al.'" '.$sy.' '.$atr.' >'.$a.'</td>';
	}
	function cell_format($f){
		$pat="/border:[01]/i";
		if(preg_match($pat,$f,$mat)){
			$this->cellformat['border']=substr($mat[0],strpos($mat[0],":")+1);
		}
		$pat="/align:[clrj]/i";
		if(preg_match($pat,$f,$mat)){
			$this->cellformat['align']=substr($mat[0],strpos($mat[0],":")+1);
		}
		$pat="/font-size:[0-9]+(p[xt])?/i";
		if(preg_match($pat,$f,$mat)){
			$this->cellformat['font-size']=substr($mat[0],strpos($mat[0],":")+1);
		}
		$pat="/color:#[0-9a-f]+/i";
		if(preg_match($pat,$f,$mat)){
			$this->cellformat['color']=substr($mat[0],strpos($mat[0],":")+1);
		}
	}
	function cell_format_get(){
		return $this->cellformat;
	}
	function cell_format_set($a=0){
		if($a===0) $this->cel_format_reset();
		else $this->cellformat=$a;
	}
	function cell_format_reset(){
		$this->cellformat=array(
			'border'=>0,
			'align'=>'left',
			'background'=>'#ffffff',
			'font-size'=>'',
			'color'=>'#000000',
		);
	}
}

if(file_exists($content)){
	require_once($content);
} else {
	echo 'Dokumen Tidak tersedia';
}

echo '</body>';
?>