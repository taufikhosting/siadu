<?php
function gpage_tabs(){
	$gptab=gpost('gptab_index','1');
	$a=func_get_args();
	$n=count($a);
	$tabs=array(); $pages=array();
	for($i=1;$i<=$n;$i++){
		$k=explode(":",$a[$i-1]);
		$tabs[$i]=$k[0];
		if(count($k)>1) $pages[$i]=$k[1];
		else $pages[$i]='';
	}
	
	hiddenval('gptab_index',$gptab);
	hiddenval('gptab_num',$n);
	
	echo '<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">';
	for($i=1;$i<=$n;$i++){
		echo '<div id="gptab'.$i.'" class="gptab'.($gptab==$i?'1':'').'" onclick="gpage_tab_get('.$i.')">'.$tabs[$i].'</div>';
	}
	echo '</div>';
	
	for($i=1;$i<=$n;$i++){
		echo '<div id="gpage_tab_'.$i.'" style="float:left;width:100%;display:'.($gptab==$i?'':'none').'">';
			if($pages[$i]!=''){
				if(strpos($pages[$i],'.php')!==false){
					$fv=VWDIR.$pages[$i];
				} else {
					$fv=APPDIR.$pages[$i].'.php';
				}
				if(file_exists($fv)){
					require_once($fv);
				} else {
					echo $pages[$i];
				}
			}
		echo '</div>';
	}
}

function gpage_tabs_singlebox(){
	$gptab=gpost('gptab_index','1');
	$a=func_get_args();
	$n=count($a);
	$tabs=array(); $pages=array();
	for($i=1;$i<=$n;$i++){
		$k=explode(":",$a[$i-1]);
		$tabs[$i]=$k[0];
		if(count($k)>1) $pages[$i]=$k[1];
		else $pages[$i]='';
	}
	
	hiddenval('gptab_index',$gptab);
	hiddenval('gptab_num',$n);
	
	echo '<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">';
	for($i=1;$i<=$n;$i++){
		echo '<div id="gptab'.$i.'" class="gptab'.($gptab==$i?'1':'').'" onclick="gpage_tab_singlebox_get('.$i.')">'.$tabs[$i].'</div>';
	}
	echo '</div>';
	
	for($i=1;$i<=$n;$i++){
		hiddenval('gptab_page'.$i,$pages[$i]);
	}
	
	echo '<div id="loader_gpage_tab" style="display:none"><img src="'.IMGR.'loader.gif" /></div>';
	echo '<div id="box_gpage_tab" style="float:left;width:100%">';
	for($i=1;$i<=$n;$i++){
		if($pages[$i]!='' && $gptab==$i){
			gpage_tab_show($pages[$i]);
		}
	}
	echo '</div>';
}

function gpage_tab_show($a){
	if(strpos($a,'.php')!==false){
		$fv=VWDIR.$a;
	} else {
		$fv=APPDIR.$a.'.php';
	}
	if(file_exists($fv)){
		require_once($fv);
	} else {
		echo $a;
	}
}

function gpage_tabs_singlebox2(){
	$a=func_get_args();
	$id=$a[0];
	$gptab=gpost('gptab'.$id.'_index','1');
	$n=count($a);
	$tabs=array(); $pages=array();
	for($i=1;$i<=$n;$i++){
		$k=explode(":",$a[$i-1]);
		$tabs[$i]=$k[0];
		if(count($k)>1) $pages[$i]=$k[1];
		else $pages[$i]='';
	}
	
	hiddenval('gptab'.$id.'_index',$gptab);
	hiddenval('gptab'.$id.'_num',$n);
	
	echo '<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">';
	for($i=1;$i<=$n;$i++){
		echo '<div id="gptab'.$id.'_'.$i.'" class="gptab'.($gptab==$i?'1':'').'" onclick="gpage_tab_singlebox2_get('.$id.','.$i.')">'.$tabs[$i].'</div>';
	}
	echo '</div>';
	
	for($i=1;$i<=$n;$i++){
		hiddenval('gptab'.$id.'_page'.$i,$pages[$i]);
	}
	
	echo '<div id="loader_gpage'.$id.'_tab" style="display:none"><img src="'.IMGR.'loader.gif" /></div>';
	echo '<div id="box_gpage'.$id.'_tab" style="float:left;width:100%">';
	for($i=1;$i<=$n;$i++){
		if($pages[$i]!='' && $gptab==$i){
			gpage_tab_show($pages[$i]);
		}
	}
	echo '</div>';
}
?>