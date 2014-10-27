<?php
require_once(MODDIR.'control.php'); require_once(MODDIR.'apps/aka.php');
$dept=gpost('departemen');
$departemen=departemen_r($dept);

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen('penempatan',$dept);
$PSBar->end();

if(count($departemen)>0){
notifbox();
?><table cellspacing="0" cellpadding="0" width="100%"><tr valign="top">
<td width="45%" style="padding-right:10px">
	<div id="loader3" class="loader" style="display:none"></div>
	<div id="data_calon" style="width:100%">
	<?php require_once(APPDIR.'penempatan_calon_get.php');?>
	</div>
</td>
<td width="55%" style="border-left:1px solid #fff;padding-left:10px">
	<div id="loader2" class="loader" style="display:none"></div>
	<div id="data_kelas" style="width:100%">
	<?php require_once(APPDIR.'penempatan_kelas_get.php');?>
	</div>
</td>
</tr></table><?php
}else{
	hiddenval('proses',$pros);
	hiddenval('kelompok',$kel);
	
	hiddenval('tahunajaran',$tajar);
	hiddenval('tingkat',$ting);
	hiddenval('kelas',$kls);
	departemen_warn();
}?>