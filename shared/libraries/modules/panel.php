<?php
function panel_tile($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="border-radius:3px;width:253px;left:'.($x*253).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="border-radius:6px !important;background:'.$p['color'].';width:205px;height:110px">';
	echo '<div class="tiletitle">'.$p['title'].'</div>';
	if($p['desc']!='') echo '<div class="tiledesc">'.$p['desc'].'</div>';
	echo '</a></div>';
}
function panel_tile2($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="width:288px;left:'.($x*288).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="border-radius:6px !important;background:url(\''.(IMGR.$p['icon']).'\') 20px 22px no-repeat '.$p['color'].';width:240px;height:110px"><div style="margin-left:'.($p['icon']==''?'0':'40').'px">';
	echo '<div class="tiletitle">'.$p['title'].'</div>';
	if($p['desc']!='')echo '<div class="tiledesc"'.((strlen($p['title'])>21&&strlen($p['desc'])>50)?' style="margin-left:-40px"':'').' >'.$p['desc'].'</div>';
	echo '</div></a></div>';
}
function panel_tile3($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="width:288px;left:'.($x*288).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="border-radius:6px !important;background:url(\''.(IMGR.$p['icon']).'\') center 20px no-repeat '.$p['color'].';width:240px;height:110px">';
	echo '<div class="tiletitle2">'.$p['title'].'</div></a></div>';
}
function panel_tile4($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="width:253px;left:'.($x*253).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile"  style="background:url(\''.(IMGR.$p['icon']).'\') center 20px no-repeat '.$p['color'].';width:205px;height:110px">';
	echo '<div class="tiletitle2">'.$p['title'].'</div>';
	echo '</a></div>';
}
function panel_tile5($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']); $tw=153;
	echo '<div class="tilebox" style="width:'.$tw.'px;left:'.($x*$tw).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="border-radius:6px !important;background:'.$p['color'].';width:'.($tw-48).'px;height:110px">';
	echo '<div class="tiletitle">'.$p['title'].'</div>';
	if($p['desc']!='') echo '<div class="tiledesc">'.$p['desc'].'</div>';
	echo '</a></div>';
}
function panel_tile7($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="width:248px;left:'.($x*248).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="border-radius:6px !important;background:url(\''.(IMGR.$p['icon']).'\') 20px 22px no-repeat '.$p['color'].';width:200px;height:110px"><div style="margin-left:'.($p['icon']==''?'0':'40').'px">';
	echo '<div class="tiletitle">'.$p['title'].'</div>';
	if($p['desc']!='')echo '<div class="tiledesc"'.((strlen($p['title'])>21&&strlen($p['desc'])>50)?' style="margin-left:-40px"':'').' >'.$p['desc'].'</div>';
	echo '</div></a></div>';
}
function panel_tile8($t,$p,$x=0,$y=0){
	global $tilecount; $act=str_replace('std','openPage('.$t.',\''.$p['key'].'\',true)',$p['action']);
	echo '<div class="tilebox" style="width:248px;left:'.($x*248).'px;top:'.($y*143).'px">';
	echo '<a id="tile'.($tilecount++).'" href="#&'.$p['key'].'" onclick="'.$act.'" class="tile" style="background:url(\''.(IMGR.$p['icon']).'\') center 20px no-repeat '.$p['color'].';width:200px;height:110px">';
	echo '<div class="tiletitle2">'.$p['title'].'</div></a></div>';
}
function panel_tile100($t,$p,$x=0,$y=0){
	global $tilecount;
	require_once(APPDIR.$p['action'].'.php');
}
function panel_draw(){
	global $tilecount,$APP_PAGES,$APP_TILE_FADE;
	$n1=count($APP_PAGES);
	for($t=0;$t<$n1;$t++){
		$tile=&$APP_PAGES[$t]['tileset'];
		$pages=&$APP_PAGES[$t]['pages'];
		echo '<div class="tileset" style="top:0px;left:'.$tile['pos'].'">';
		$x=0;$y=0;
		if($tile['tipe']==5) $nx=3;
		else if($tile['tipe']==6) $nx=4;
		else if($tile['tipe']==7) $nx=3;
		else $nx=2;
		//if(isset($tile['ncol']) && !empty($tile['ncol'])) $nx=$tile['ncol'];
		$t0=$tilecount;
		$n2=count($pages);
		for($i=0;$i<$n2;$i++){
			if($x==$nx){$x=0;$y++;}
			$tip=$pages[$i]['tipe']==0?$tile['tipe']:$pages[$i]['tipe'];
			if($tip==2) panel_tile2($t,$pages[$i],$x,$y);
			else if($tip==3) panel_tile3($t,$pages[$i],$x,$y);
			else if($tip==4) panel_tile4($t,$pages[$i],$x,$y);
			else if($tip==5||$tip==6) panel_tile5($t,$pages[$i],$x,$y);
			else if($tip==7) panel_tile7($t,$pages[$i],$x,$y);
			else if($tip==8) panel_tile8($t,$pages[$i],$x,$y);
			else if($tip==100) panel_tile100($t,$pages[$i],$x,$y);
			else panel_tile($t,$pages[$i],$x,$y);
			$x++;
		}
		echo '</div>';
		
		$t2=$tilecount; $s="";
		for($i=$t1;$i<$t2;$i++){
			if($i % 2==0){
				if($s!='')$s.='-';
				$s.=$i;
			}
		}
		
		for($i=$t1;$i<$t2;$i++){
			if(($t2-$i-1) % 2!=0){
				if($s!='')$s.='-';
				$s.=($t2-$i-1);
			}
		}
		
		//for($i=($t2-1);$i>=$t1;$i--){
			/*if($i % 2!=0){
				if($s!='')$s.='-';
				$s.=$i;
			}*/
		//}		
		echo '<input type="hidden" id="tilesetid'.$t.'" value="'.$s.'" />';
		
	}
	echo '<input type="hidden" id="ntile" value="'.$APP_TILE_FADE.'" />';
}
?>