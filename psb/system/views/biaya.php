<?php appmod_use('psb/proses','psb/kelompok');
$fmod='biaya';
$xtable=new xtable($fmod);

$dept=gpost('departemen');
$departemen=departemen_r($dept);

$pros=gpost('proses');
$proses=proses_r($pros,$dept);

$kel=gpost('kelompok');
$kelompok=kelompok_r($kel,$pros);

if(count($departemen)>0){

// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);

	if(count($proses)>0){
		$PSBar->selection('Proses',iSelect('proses',$proses,$pros,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('proses',$pros);
		hiddenval('kelompok',$kel);
		proses_warn(); exit();
	}
	
	if(count($kelompok)>0){
		$PSBar->selection('Kelompok',iSelect('kelompok',$kelompok,$kel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelompok',$kel);
		kelompok_warn(); exit();
	}

$PSBar->end();

?>
<div id="cbiaya" style="width:100%">
<?php require_once(VWDIR.'biaya_data.php');?>
</div>
<?php 

} else { departemen_warn(1); } ?>