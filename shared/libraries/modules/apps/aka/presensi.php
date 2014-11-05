<?php
function presensi_icon($a,$s=''){
	$a=strtoupper($a);
	if($a=='H')$cl='#00ff00';
	else if($a=='S')$cl='#ffff00';
	else if($a=='I')$cl='#ff9000';
	else if($a=='A')$cl='#ff0000';
	else {
		$cl='#fff';
		$a='&nbsp;';
	}
	return '<span class="sfont" style="display:inline-block;height:12px;width:12px;padding:2px;font-size:11px;text-align:center;background:'.$cl.';'.$s.'">'.$a.'</span>';
}
?>