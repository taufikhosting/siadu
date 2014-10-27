<?php
function app_form_notif($a,$b){
	global $app_form_t,$idata;
	if($a) $_SESSION[ASID.'notifbox']='<div id="notifbox" class="infobox" >Data '.strtolower($idata).' telah '.$app_form_t[$b].'.</div>';
	else $_SESSION[ASID.'notifbox']='<div id="notifbox" class="warnbox" style="float:left">Data '.strtolower($idata).' tidak dapat '.$app_form_t[$b].'. Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.</div>';
}
?>