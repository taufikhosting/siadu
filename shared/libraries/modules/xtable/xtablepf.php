<?php
class xtable{
	// basic:
	public $fmod;
	public $idata;
	public $ndata;
	public $xtopt;
	public $dbtable;
	// actions:
	public $act_add;
	// table
	public $tbl_style;
	public $tbl_width;
	public $xtablebox_style;
	public $btnbar_isbegin;
	// heading:
	public $head_tr_attr;
	public $head_tr_style;
	public $head_mxcs;
	public $head_mxrs;
	public $head_r;
	public $head_rnum;
	public $head_thnum;
	// rows:
	public $row_isbegin;
	public $row_strip;
	public $row_valign;
	public $row_num;
	public $row_id;
	public $xr=0;
	// columns:
	public $col_num;
	public $noopt=false;
	public $opt_w='*';
	// pagging:
	public $rpp;
	public $page;
	public $usepaggging;
	// sorting:
	public $useurut=false;
	public $pageorder='';
	public $pageorder_dir='';
	// selection:
	public $useselect;
	public $select_opt;
	public $select_noopt;
	// searching
	public $keyw;
	public $keyn;
	public $keyons;
	public $keycol;
	public $page_search;
	public $search_sql;
	public $search_box_style;
	public $search_box_pos;
	public $search_box_w;
	public $search_hl;
	public $keyph;
	public $search_infodisp;

	public $viewlbl='';
	
	public $stdfont;
	
	public $printable;

	// xtable(fmod, idata, [opt])
	function __construct($f='',$d='',$op=''){
		$this->stdfont='font:10pt Calibri,Arial,Ubuntu;';
		$this->printable=true;
		$this->fmod=$f;
		$this->idata=$d==''?$this->fmod:$d;
		$this->ndata=0;
		$this->xtopt=$op==''?gpost('opt'):$op;
		$this->dbtable='';
		// actions
		$this->act_add=$this->fmod.'_form(\'af\')';
		// table
		$this->tbl_style='float:left';
		$this->tbl_width='100%';
		$this->xtablebox_style='';
		$this->btnbar_isbegin=false;
		// heading
		$this->head_tr_attr='';
		$this->head_tr_style='float:none !important';
		$this->head_mxcs=1;
		$this->head_mxrs=1;
		$this->head_r=array();
		$this->head_rnum=0;
		$this->head_thnum=0;
		// row
		$this->row_isbegin=false;
		$this->row_strip=true;
		$this->row_valign='top';
		$this->row_num=0;
		$this->row_id=0;
		$this->xr=0;
		// sorting
		$this->useurut=false;
		$this->pageorder='';
		$this->pageorder_dir='';
		// column
		$this->col_num=0;
		$this->noopt=false;
		$this->opt_w='*';
		// selection
		$this->useselect=false;
		$this->select_noopt=false;
		$this->select_opt='<button class="btn" onclick="'.$this->fmod.'_cek_form(\'df\')"><div class="bi_del">Hapus yang dipilih</div></button>';
		// pagging
		$this->pagging_set(20,gpost('page_number'));
		$this->usepaggging=true;
		// searching
		$this->keyw=gpost('keyword');
		$this->keyn=gpost('keyon');
		if($this->lang=='en') $this->keyph='keyword';
		else $this->keyph='kata kunci pencarian';
		$this->keyons=array();
		$this->keycol=array();
		$this->page_search=gpost('page_search');
		$this->cari=gpost('page_search');
		$this->search_box_style='float:right;margin-left:4px';
		$this->search_box_pos='r';
		$this->search_box_w='300px';
		$this->search_infodisp=false;
		$this->search_hl=true;
		
	}
	// Text formatting for display
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
	function use_urut($t,$op=''){
		$this->dbtable=$t;
		$this->pageorder='urut';
		if($op!='')$this->xtopt=$op;
		$this->useurut=true;
	}
	// Heading
	function begin(){
		if($this->btnbar_isbegin) $this->btnbar_end();
		/*hiddenval('xtable_row_strip',($this->row_strip?'1':'0'));
		hiddenval('xtable_fmod',$this->fmod);
		hiddenval('xtable_idata',$this->idata);
		hiddenval('xtable_dbtable',$this->dbtable);*/
		if($this->cari!=0 && !$this->search_infodisp) $this->search_info();
		echo '<table cellspacing="0" cellpadding="2px" border="1" style="border-collapse:collapse">';
		if($this->ndata<=2)$this->row_strip=false;
	}
	function head_addrow(){
		$a=func_get_args();
		$this->head_r[$this->head_rnum]=$a;
		//echo 'count($this->head_r)='.count($this->head_r[0]);
		$this->head_rnum++;
	}
	function head_multi(){
		$this->begin();
		$frow=true;
		
		//echo '$mxcs:$mxrs='.$this->head_mxcs.':'.$this->head_mxrs;
		$sr=1;
		for($hi=0;$hi<$this->head_rnum;$hi++){
			echo '<tr>';
			
			/*
			if($this->useurut && $this->xtopt=='urut'){
				echo '<th width="" style="text-align:center">&nbsp;</th>';
			}
			
			if($this->useselect && $frow){
				echo '<th rowspan="'.$rs.'" width="1" style="text-align:center"><input id="xtcekt" type="checkbox" onclick="xtable_cekall(this.checked)" /></th>';
			}
			*/
			
			$a=$this->head_r[$hi];
			if(is_array($a[0])){
				$a=$a[0];
			}
			$n=count($a);
			
			for($i=0;$i<$n;$i++){
				$thf=$this->head_thf($a[$i],$sr);
				$this->head_th($thf);
				$sr++;
			}
			
			if(!$this->noopt && $this->xtopt!='urut' && $frow){
				$this->opt_th();
			}
			echo '</tr>';
			$frow=false;
		}
	}
	
	function head_thf($k,$sr=''){
		$thf=array('title'=>'','width'=>'*','align'=>'l','sortby'=>'','sort'=>false,'hidden'=>'');
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
			
			$al=strtolower($al);
			if($al=='r')$thf['align']='right';
			else if($al=='c')$thf['align']='center';
			else $thf['align']='left';
			
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
	
	function head_th($t){
		$hw=$t['width'];
		$al=$t['align'];
		$sort=$t['sort'];
		$sr=$t['sr'];
		$l=$t['sortby'];
		$rs=$t['rs'];
		$cs=$t['cs'];
		$ttl=$t['title'];
		$hidden=$t['hidden'];
		//echo 'hidden('.$t['hidden'].')';
		if($hidden==''){
			$al=strtolower($al);
			if($al=='right')$al='right';
			else if($al=='center')$al='center';
			else $al='left';
			
			$stl='style="'.$this->stdfont.'background:#f5f5f5;font-weight:bold"';
			if($sort){
				if(gpost('page_sort')==($sr)){
					echo '<th rowspan="'.$rs.'" colspan="'.$cs.'" width="'.$hw.'" align="'.$al.'" '.$stl.'>'.$ttl.'</th>';
					
				} else {
					echo '<th rowspan="'.$rs.'" colspan="'.$cs.'" width="'.$hw.'" align="'.$al.'" '.$stl.'>'.$ttl.'</th>';
				}
			}
			else {
				echo '<th rowspan="'.$rs.'" colspan="'.$cs.'" width="'.$hw.'" align="'.$al.'" '.$stl.' >'.$ttl.'</th>';
			}
		}
		$this->head_thnum++;
	}
	
	function head(){ // '<title>~<alignment>~<width>~<c,r>'
		$this->begin();
		echo '<tr '.$this->head_tr_attr.' style="'.$this->head_tr_style.'">';
		
		if($this->useurut && $this->xtopt=='urut'){
			echo '<th width="" style="text-align:center">&nbsp;</th>';
		}
		
		if($this->useselect && $this->xtopt!='urut'){
			echo '<th width="1" style="text-align:center"><input id="xtcekt" type="checkbox" onclick="xtable_cekall(this.checked)" /></th>';
		}
		
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
		
		if(!$this->noopt && $this->xtopt!='urut') $this->opt_th();
		echo '</tr>';
	}
	// foot
	function foot(){
		if($this->row_isbegin) $this->row_end();
		
		echo '</table>';
		/*
		hiddenval('xtceknum',$this->row_num);
		hiddenval('xtable_selectedid','');
		
		// pagging
		echo '<table style="float:left" width="100%" cellspacing="0" cellpadding="0"><tr>';
		if($this->useselect){
			if($this->select_noopt){
				$this->select_opt='';
			}
			echo '<td><div style="float:left;height:26px;margin-top:4px"><div id="xtable_cek_opt" style="display:none">'.$this->select_opt.'</div></div></td>';
		}
		if($this->ndata>$this->rpp && $this->usepaggging){ $fp=true;
			echo '<td align="right">';
			echo '<table cellspacing="4px" cellpadding="0" style="margin-top:2px"><tr>';
			echo '<td width="40px"><span class="sfont">Halaman:</span></td>';
				$np=ceil($this->ndata/$this->rpp);
				$page=$this->page;//=gpost('page_number');
				
				echo '<td width="24px" align="center">';
				if($page>1) echo '<a class="plink" title="Halaman sebelumnya" href="#&'.$this->fmod.'" onclick="page_number='.($page-1).';'.$this->fmod.'_get()"><</a>';
				else echo '<a class="plinko" href="#&'.$this->fmod.'"><</a>';
				echo '</td>';
				
				for($n=1;$n<=$np;$n++){
					if(($n>=($page-3) && $n<=($page+3)) || $n==$np || $n==1){ $fp=true;
						echo '<td width="24px" align="center"><a onclick="page_number='.$n.';'.$this->fmod.'_get()" class="plink'.(($n!=$page)?'" title="Halaman '.$n.'" href="#&'.$this->fmod.'"':'a').'">'.$n.'</a></td>';
					}
					else if($fp){ $fp=false;
						echo '<td width="24px" align="center"><span class="sfont">...</span></td>';
					}
				}
				
				echo '<td width="24px" align="center">';
				if($page<$np) echo '<a class="plink" title="Halaman berikutya" href="#&'.$this->fmod.'" onclick="page_number='.($page+1).';'.$this->fmod.'_get()">></a>';
				else echo '<a class="plinko" href="#&'.$this->fmod.'">></a>';
				echo '</td>';
				
				echo '</tr></table>';
			echo '</td>';
		}
		echo '</tr></table>';
		*/
	}
	
	// row_begin([id],[number],[attibute])
	function row_begin($id=0,$atr=''){
		if($this->row_isbegin) $this->row_end();
		$this->row_id=$id;
		
		echo '<tr valign="'.$this->row_valign.'" '.$atr.'>';
		
		/*
		if($this->useurut && $this->xtopt=='urut'){
			$this->td_urut();
		}
		if($this->useselect){
			echo '<td width="20px" align="center" onclick="xtable_sel('.$this->row_num.')"><input id="xtcek'.$this->row_num.'" value="'.$this->row_id.'" type="checkbox" onclick="xtable_sel('.$this->row_num.')" /></td>';
		}
		*/
		
		$this->row_isbegin=true;
		$this->col_num=0;
	}
	
	function row_end(){
		echo '</tr>';
		$this->row_num++;
		$this->row_isbegin=false;
	}
	// columns
	function opt_ud($id=0){
		/*
		if($this->xtopt!='urut'){
		if(admin_isoperator()){
			$s='';
			$s.='<td width="65px" align="center">';
			$s.='<button class="btn" title="Edit" onclick="'.$this->fmod.'_form(\'uf\',\''.$id.'\')"><div class="bi_editb">&nbsp;</div></button>&nbsp;';
			$s.='<button class="btn" title="Hapus" onclick="'.$this->fmod.'_form(\'df\',\''.$id.'\')"><div class="bi_delb">&nbsp;</div></button>';
			$s.='</td>';
			echo $s;
		}}
		*/
	}
	
	function td($a='',$b='',$c='',$atr=''){
		$c=strtolower($c);
		if($c=='c')$c='text-align:center';
		else if($c=='r')$c='text-align:right';
		else if($c=='j')$c='text-align:justify';
		else if($c=='l')$c='text-align:left';
		else $c='text-align:general';
		
		$b=$b==0?'*':$b;
		if($this->cari && $this->search_hl){
			//echo "cko:".count($this->keyons);
			if(count($this->keyons)>0){
				//print_r($this->keycol);
				//echo " this->keyn:".$this->keyn."; colnum:".$this->col_num." ";
				if(is_array($this->keycol[$this->keyn])){
					$kc=$this->keycol[$this->keyn];
					if(in_array($this->col_num,$kc)) $a=srcrep($this->keyw,$a);
				} else {
					if($this->keycol[$this->keyn]==$this->col_num) $a=srcrep($this->keyw,$a);
				}
			} else {
				//echo "kw:".$this->keyw." a:".$a;
				$a=srcrep($this->keyw,$a);
			}
		}
		if($this->useselect){
			$tda='onclick="xtable_sel('.$this->row_num.')"';
		} else {
			$tda='';
		}
		$pats="/style=\"[^\"]+\"/"; $tdsy="";
		if(preg_match($pats,$atr,$mat)){
			$tdsy=$mat[0];
			$tdsy=str_replace("style=","",$tdsy);
			$tdsy=str_replace('"','',$tdsy);
			$tdsy=";".$tdsy;
			$atr=preg_replace($pats,"",$atr);
		}
		echo '<td width="'.($b=='*'?'*':$b.'px').'" '.$atr.' style="'.$this->stdfont.$c.$tdsy.';white-space:nowrap;">'.$a.'</td>';
		$this->col_num++;
	}
	function opt_th(){
		/*
		if(admin_isoperator()){
		echo '<th rowspan="'.$this->head_mxrs.'" width="'.$this->opt_w.'" class="alc">Pilihan</th>';
		}
		*/
	}
	function td_urut(){
		/*
		$id=$this->row_id;
		if($this->xtopt=='urut' && $this->useurut){
			$s='<div style="width:26px;">';
			if(urut_getid_before($this->dbtable,$id)!=0){
				$s.='<button class="btn_c" style="width:25px;height:16px" title="Pindah ke atas." onclick="xtable_urut(\'up\',\''.$id.'\')"><img src="'.IMGR.'bi_up.png?asd" /></button>';
			} else {
				$s.='<div style="border-radius:2px;border:1px solid #ddd;width:23px;height:14px"></div>';
			}
			if(urut_getid_after($this->dbtable,$id)!=0){
				$s.='<button class="btn_c" style="width:25px;height:16px;margin-top:1px" title="Pindah ke bawah." onclick="xtable_urut(\'dn\',\''.$id.'\')"><img src="'.IMGR.'bi_dn.png?asd" /></button>';
			} else {
				$s.='<div style="border-radius:2px;border:1px solid #ddd;width:23px;height:14px;margin-top:1px"></div>';
			}
			$s.='</div>';
			$s='<td width="30px" align="center"><div style="width:30px">'.$s.'</div></td>';
			echo $s;
		}
		*/
	}
	function opt(){
		/*
		if($this->xtopt!='urut'){
		$a=func_get_args();
		$id=$a[0]; $n=0; $s=''; $w=0;
		for($i=1;$i<count($a);$i++){
			if($a[$i]=='u' && admin_isoperator()){
				if($n>0)$s.='&nbsp;';
				$s.='<button class="btn" title="Edit" onclick="'.$this->fmod.'_form(\'uf\',\''.$id.'\')"><div class="bi_editb">&nbsp;</div></button>';
				$n++; $w+=30;
			}
			else if($a[$i]=='d' && admin_isoperator()){
				if($n>0)$s.='&nbsp;';
				$s.='<button class="btn" title="Hapus" onclick="'.$this->fmod.'_form(\'df\',\''.$id.'\')"><div class="bi_delb">&nbsp;</div></button>';
				$n++; $w+=30;
			}
			else if($a[$i]=='p'){
				if($n>0)$s.='&nbsp;';
				$s.='<button class="btn" title="Cetak" onclick="'.$this->fmod.'_form_print(\''.$id.'\')"><div class="bi_prib">&nbsp;</div></button>';
				$n++; $w+=30;
			}
			else if($a[$i]=='l'){
				if($n>0)$s.='&nbsp;';
				$s.='<button class="btn" title="Download" onclick="'.$this->fmod.'_form_download(\''.$id.'\')"><div class="bi_binb">&nbsp;</div></button>';
				$n++; $w+=30;
			}
			else if($a[$i]=='v'){
				if($n>0)$s.='&nbsp;';
				$this->viewlbl=$this->viewlbl==''?'Lihat '.$this->format_label($this->idata):$this->viewlbl;
				$s.='<button class="btn" title="'.$this->viewlbl.'" onclick="'.$this->fmod.'_form_view(\''.$id.'\')"><div class="bi_srcb">&nbsp;</div></button>';
				$n++; $w+=30;
			}
			else {
				if($n>0)$s.='&nbsp;';
				$k=$a[$i];
				$k=str_replace('<id>',$id,$k);
				$l=explode('~',$k);
				if(count($l)>1){
					$k=$l[0];
					$w+=intval($l[1]);
				} else {
					$w+=30;
				}
				$s.=$k;
				$n++;
			}
		}
		$s='<td width="'.($w+4).'px" align="center"><div style="width:'.$w.'px">'.$s.'</div></td>';
		echo $s;
		}
		*/
	}
	// pagging
	function pagging_set($r=20,$p=1){
		$this->rpp=$r;
		$this->page=$p!=0?$p:1;
	}
	// selection
	function use_select($o=1){
		$this->useselect=true;
		$this->select_noopt=$o==1?false:true;
	}
	// sorting
	function pageorder_sql(){
		$a=func_get_args();
		$n=count($a);
		if($n>0){
			$k=array();
			$k[0]=$a[0];
			for($i=0;$i<$n;$i++){
				$k[$i+1]=$a[$i];
			}
			
			$d=gpost('page_sort_dir');
			if(gpost('page_sort_dir')=='' || gpost('page_sort_dir')=='ASC'){
				if($this->pageorder_dir!='') $d=$this->pageorder_dir;
			}
			
			$s=$k[gpost('page_sort')];
			if(gpost('page_sort')==0){
				if($this->pageorder!=''){
					$s=$this->pageorder;
					if(strpos($s,"ASC")!==0 || strpos($s,"DESC")!==0){
						$d="";
					}
				}
			}
			
			if($s!=""){
				$s1=explode(",",$s); $n=count($s1);
				if($n>0){
					$s="";
					for($i=0;$i<$n;$i++){
						if($s!="")$s.=",";
						$fld=$s1[$i];
						if(substr($fld,0,1)=="@"){
							$fld=substr($fld,1);
							$s.=$fld;
						} else {
							$s.=$fld." ".$d;
						}
					}
					$po=" ORDER BY ".$s;
				} else {
					$po=" ORDER BY ".$s.' '.$d;
				}
			}
			else $po="";
		} else {
			$po=$this->pageorder==""?"":" ORDER BY ".$this->pageorder;
		}
		if($this->ndata>$this->rpp && $this->usepaggging){
			$nps=$this->rpp*(intval($this->page)-1);
			$po.=" LIMIT ".$nps.",".$this->rpp;
		}
		
		return $po;
	}
	// no data
	function nodata($b='',$c=''){
		if($this->cari!=0 && !$this->search_infodisp) $this->search_info();
		if($this->cari==0){
		echo '<div class="infobox2" style="margin-top:10px"><div style="float:left;margin-right:4px">Belum ada data '.$this->format_word($this->idata).($c==''?'':' '.$c).'.</div>';
		if(admin_isoperator()){
			echo ' <div style="float:left">Silahkan <a class="linkb" href="javascript:" onclick="'.$this->act_add.'"> '.($b==''?'menambah data':$b).' '.strtolower($this->idata).'</a>.</div>';
		}
		echo '</div>';
		}
	}
	function nodata_cust($b=''){
		if($this->cari!=0 && !$this->search_infodisp) $this->search_info();
		if($this->cari==0){
		echo '<div class="infobox2" style="margin-top:10px">'.$b.'</div>';
		}
	}
	// button bar
	function btnbar_begin(){
		//echo '<div class="tbltopbar" style="width:100%">';
		//$this->btnbar_isbegin=true;
	}
	function btnbar_end(){
		//echo '</div>';
		//$this->btnbar_isbegin=false;
		// if($this->cari!=0 && !$this->search_infodisp) $this->search_info();
	}
	function btnbar_add($a='',$l='',$t=''){
		/*
		if(admin_isoperator()){
			if($a=='')$a=$this->act_add;
			if($t=='')$t='Tambah data '.$this->format_word($this->idata);
			if($l=='')$l=$this->format_label($this->idata);
			echo '<button class="btn" title="'.$t.'" style="float:left;margin-right:4px" onclick="'.$a.'"><div class="bi_add">'.$l.'</div></button>';
		} else echo '&nbsp;';
		*/
	}
	function btnbar_updn(){
		/*
		if($this->ndata>0){
		if($this->xtopt=='urut'){
			echo '<button class="btn" style="float:left;margin-right:4px" onclick="xtable_urut(\'done\')"><div class="bi_cek">Selesai</div></button>';
		} else {
			echo '<button class="btn" title="Ubah urutan" style="float:right;margin-left:4px" onclick="xtable_urut(\'urut\')"><div class="bi_updnb">&nbsp;</div></button>';
		}}
		*/
	}
	function btnbar_print(){
		/*
		if($this->ndata>0){
		echo '<button class="btn" style="float:left;margin-right:4px" onclick="'.$this->fmod.'_print()"><div class="bi_pri">Cetak</div></button>';
		}
		*/
	}
	function btnbar_help(){
		/*
		echo '<button class="btn" title="Bantuan" style="float:left;margin-right:4px" onclick="'.$this->fmod.'_form(\'hf\')"><div class="bi_helpb">&nbsp;</div></button>';
		*/
	}
	
	/*
	btnbar_f( mixed $option )
	$option = Pilihan tombol
	'add' 	: Tombol tambah
	'print'	: Tombol cetak
	'updn'	: Tombol cetak
	'srcbox': SearchBox
	string	: Function or Custom
	*/
	function btnbar_f(){
		/*
		echo '<div class="tbltopbar" style="width:100%">'; $this->btnbar_isbegin=true;
		if($this->xtopt!='urut'){
		$a=func_get_args();
		$n=count($a);
		for($i=0;$i<$n;$i++){
			if($a[$i]=='add') $this->btnbar_add();
			else if($a[$i]=='print') $this->btnbar_print();
			else if($a[$i]=='updn') $this->btnbar_updn();
			else if($a[$i]=='help') $this->btnbar_help();
			else if($a[$i]=='srcbox') $this->search_box();
			else echo $a[$i];
		}} else {
			$this->btnbar_updn();
		}
		echo '</div>'; $this->btnbar_isbegin=false;
		if($this->cari!=0 && !$this->search_infodisp) $this->search_info();
		*/
	}
	function search_kformat($a1){
		//$a1="nopendaftaran(no pendaftaran)=>nama:EQ-1";
		//echo " a1:".$a1."; ";
		$skf=array();
		$pindex="/^[\w]+(\([\w ]+\))?/";
		$pfield="/\=\>[\w\.]+(\:|\-)/";
		$pmfield="/\=\>[\w\.\:]+(\s*(\&|\|)\s*[\w\.\:]+)+\-/";
		$pcond="/(EQ|LIKE)/";
		$pcol="/\-[0-9,]+/";
		$index="";$opt="";$field="";$cond="LIKE";$col='';$mf='NO';
		if(preg_match($pindex,$a1,$mat)){
			$index=str_replace("=>","",$mat[0]);
			$popt="/\([\w ]+\)/";
			if(preg_match($popt,$a1,$mat)){
				$opt=str_replace("(","",$mat[0]);
				$opt=str_replace(")","",$opt);
				$index=preg_replace($popt,"",$index);
			} else {
				$opt=$index;
			}
		}
		if(preg_match($pcol,$a1,$mat)){
			//echo "asd";
			$col=str_replace("-","",$mat[0]);
			//echo "COL: ".$col."; ";
			$tcol=explode(",",$col);
			$ncol=count($tcol);
			if($ncol>1) $col=$tcol;
		}
		if(preg_match($pmfield,$a1,$mat)){
			$field=$mat[0];
			$field=str_replace("=>","",$mat[0]);
			$field=str_replace("-","",$field);
			$mf='MULTI';
			$cond='MULTI';
		} else {
			if(preg_match($pcond,$a1,$mat)){
				$cond=$mat[0];
				$a1=preg_replace($pcond,"",$a1);
			}
			if(preg_match($pfield,$a1,$mat)){
				$field=str_replace("=>","",$mat[0]);
				$field=str_replace(":","",$field);
				$field=str_replace("-","",$field);
				$mf='ORIG';
			}
			if($field==""){
				$field=$index;
				$mf='INDEX';
			}
		}
		$skf=array('index'=>$index,'field'=>$field,'cond'=>$cond,'col'=>$col,'opt'=>$opt);
		return $skf;
	}
	// searching
	function search_keyon(){
		$a=func_get_args();
		$n=count($a); $ksql=array();
		for($i=0;$i<$n;$i++){
			$skf=$this->search_kformat($a[$i]);
			$this->keyons[$skf['index']]=$skf['opt'];
			if($i==0 && $this->keyn=='')$this->keyn=$skf['index'];
			//echo " skf[index]=".$skf['index'].";";
			//echo " count this->keyon:".count($this->keyons)."; ";
			$this->keycol[$skf['index']]=$skf['col'];
			if($skf['cond']=='MULTI'){
				$sql=$skf['field'];
			} else {
				$sql=$skf['field'].':'.str_replace("EQ","=",$skf['cond']);
			}
			$ksql[$skf['index']]=$sql;
		}
		$this->search_sql_set($ksql);
	}
	function search_info($fi='',$l=1){
		if($this->cari!=0){
			if($l===1){
				$a='<a style="float:left" class="linkb" href="#&'.$this->fmod.'" onclick="page_number=1;page_search=0;'.$this->fmod.'_get()">Tampilkan semua...</a>';
			} else if($l===0){
				$a=='';
			} else {
				$a='<a style="float:left" class="linkb" href="javascript:void(0)" onclick="page_search=0;'.$l.'">Tampilkan semua...</a>';
			}
			if($fi==''){
			if(count($this->keyons)>0){
				$fi='data '.$this->format_word($this->idata).' dengan '.$this->keyons[$this->keyn].' "<b>'.$this->keyw.'</b>"';
			} else {
				$fi='data '.$this->format_word($this->idata).' dengan '.$this->keyph.' "<b>'.$this->keyw.'</b>"';
			}} else {
				$fi=str_replace("{keyon}",$this->keyons[$this->keyn],$fi);
				$fi=str_replace("{keyph}",$this->keyph,$fi);
				$fi=str_replace("{keyw}",$this->keyw,$fi);
			}
			if($this->ndata>0){
				echo '<div class="tbltopbar" style="width:100%"><div class="sfont" style="float:left;margin-top:4px">'.($fi!=''?'<div style="float:left;margin-right:5px">Hasil pencarian '.$fi.'</div> ':'').$a.'</div></div>';
			} else {
				echo '<div class="tbltopbar" style="width:100%"><div class="sfont" style="float:left;margin-top:4px">'.($fi!=''?'<div style="float:left;margin-right:5px">Tidak ditemukan '.$fi.'</div> ':'').$a.'</div></div>';
			}
			$this->search_infodisp=true;
		}
	}
	function search_box_pos($p='r',$w=0){
		$p=strtolower($p);
		if($p=='l'||$p='left'){
			$this->search_box_style='float:left;margin-right:4px';
			$this->search_box_pos='l';
		} else {
			$this->search_box_style='float:right;margin-left:4px';
			$this->search_box_pos='r';
		}
		if($w===0){
			$this->search_box_w='300px';
		} else {
			$this->search_box_w=$w;
		}
	}
	function search_box($f='',$c=""){
		/*
		$obtnbar=false;
		if(!$this->btnbar_isbegin){
			$this->btnbar_begin(); $obtnbar=true;
		}
		$nkey=count($this->keyons);
		//echo " search_box count this->keyon:".$nkey."; ";
		
		if($c=="")$c="page_search=1;".$this->fmod."_get(1)";
		$this->keyph=$f==''?$this->keyph:$f;
		if($this->search_box_pos=='r'){
			echo '<div style="'.$this->search_box_style.'">';
			$kw=$this->cari==0?"":$this->keyw;
			echo iTextSrc('keyword',$kw,$this->search_box_style.'~width:'.$this->search_box_w,$this->keyph.'...',$c,'onkeyup="gpage_cari(event,function(){'.$c.'})"');
			if($nkey>1){
				if($this->lang=='en') $label='Find by';
				else $label='Cari berdasarkan';
				echo iSelect('keyon',$this->keyons,$this->keyn,$this->search_box_style);
				echo '<div class="sfont" style="margin-top:4px;'.$this->search_box_style.'"><b>'.$label.':</b></div>';
			} else {
				hiddenval('keyon',$this->keyons[$this->keyn]);
			}
			echo '</div>';
		} else {
			echo '<div style="'.$this->search_box_style.'">';
			$kw=$this->cari==0?"":$this->keyw;
			if(count($this->keyons)>1){
				if($this->lang=='en') $label='Find by';
				else $label='Cari berdasarkan';
				echo '<div class="sfont" style="margin-top:4px;'.$this->search_box_style.'"><b>'.$label.':</b></div>';
				echo iSelect('keyon',$this->keyons,$this->keyn,$this->search_box_style);
			} else {
				//print_r($this->keyons);
				hiddenval('keyon',$this->keyons[$this->keyn]);
			}
			echo iTextSrc('keyword',$kw,$this->search_box_style.'~width:'.$this->search_box_w,$this->keyph.'...',$c,'onkeyup="gpage_cari(event,function(){'.$c.'})"');
			echo '</div>';
		}
		
		if($obtnbar){
			$this->btnbar_end();
		}
		*/
	}
	function search_fetchsql($s){
		$sq=explode(":",$s);
		if(count($sq)>1){
			if($sq[1]=="LIKE"){
				$sql=($this->keyw===""?$sq[0]." IS NULL OR ".$sq[0]." = ''":$sq[0]." LIKE '%".$this->keyw."%'");
			} else {
				$sql=$sq[0]." ".$sq[1]." '".$this->keyw."'";
			}
		} else {
			$sql=$sq[0]." = '".$this->keyw."'";
		}
		return $sql;
	}
	function search_sql_set($a){
		$pmfield="/^[\w\.\:]+(\s*(\&|\|)\s*[\w\.\:]+)+$/";
		
		if(is_array($a)){
			//print_r($a);
			$s=$a[$this->keyn];
			//echo " keyn:".$this->keyn."; ";
		} else {
			$s=$a;
		}
		
		$sql=$this->search_sql;
		
		$a1=$s;
		if(preg_match($pmfield,$a1,$mat)){
			preg_match_all("/[\w\.\:\=]+/",$a1,$mat1);
			preg_match_all("/(\||\&)/",$a1,$mat2);
			$n1=count($mat1[0]);
			$n2=count($mat2[0]);
			$sql=$this->search_fetchsql($mat1[0][0]);
			for($i=1;$i<$n1;$i++){
				$co=$mat2[0][$i-1];
				$sql.=" ".($co=="&"?"AND":"OR")." ".$this->search_fetchsql($mat1[0][$i]);
			}
			//echo "SQL: <span style=\"color:blue\"><b>".str_replace("EQ","=",$sql)."</b></span><br/>";
			$sql=str_replace("EQ","=",$sql);
		} else {
			//echo " s:".$s."; ";
			$sql=$this->search_fetchsql($s);
		}
		$this->search_sql=" ( ".$sql." ) ";
	}
	
	function search_sql_get($a="WHERE"){
		if($this->cari!=0){
			return $a." ".$this->search_sql;
		} else {
			return "";
		}
	}
	
	function printable_info($title,$cs=1,$info=''){
		echo '<table style="border-collapse:collapse" border="0">';
		echo '<tr><td colspan="'.$cs.'" style="'.$this->stdfont.'" align="center"><b>'.$title.'</b></td></tr>';
		if(is_array($info)){
			foreach($info as $k=>$v){
				echo '<tr><td colspan="'.$cs.'" style="'.$this->stdfont.'" align="left">'.$k.': '.$v.'</td></tr>';
			}
		}
		echo '<tr height="24">';
			for($i=0;$i<$cs;$i++){
				echo '<td></td>';
			}
		echo '</tr>';
		echo '</table>';
	}
}
?>