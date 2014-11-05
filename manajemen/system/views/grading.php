<?php
require_once(MODDIR.'control.php');
$fmod='grading';
$xtable = new xtable($fmod);

$guru=gpost('guru');
$dguru=guru_get($guru);

$pel=gpost('pelajaran');
$pelajaran=Array(); $in=0; $tp=0; $td="";
$t=mysql_query("SELECT * FROM aka_guru WHERE pegawai='".$dguru['pegawai']."'");
while($r=mysql_fetch_array($t)){
	$q=mysql_query("SELECT * FROM aka_pelajaran WHERE replid='".$r['pelajaran']."' LIMIT 0,1");
	$nq=mysql_num_rows($q);
	if($nq>0){
		$h=mysql_fetch_array($q);
		$pelajaran[$r['pelajaran']]=$h['pelajaran'];
		if($tp==0){
			$tp=$r['pelajaran'];
			$td=$h['departemen'];
		}
		if($pel==$r['pelajaran']){
			$in=1;
			$td=$h['departemen'];
		}
	}
}
if($in==0)$pel=$tp;

$dept=$td;
$ting=gpost('tingkat');
$tingkat=tingkat_r($ting,$dept);

?>
<div class="tbltopmbar">
<table class="stable" cellspacing="0" cellpadding="0" width="100%">

<tr height="26px">
	<td width="100px" align="left"><b>Guru:</b></td>
	
	<td width="*"><?=app_form_getguru('guru',$guru,'grading_setguru')?></td>
	
	<?php if($guru==''){?>
	<td width="*">&nbsp;</td></tr></table>
	<input type="hidden" id="pelajaran" value="<?=$pel?>"/>
	<input type="hidden" id="tingkat" value="<?=$ting?>"/>
	<div class="infobox">Pilih guru.</div>	
	<?php exit();}?>
	
	<td width="150px" align="left"><b><?=departemen_name($dept)?></b><input type="hidden" id="departemen" value="<?=$dept?>"/></td>
<td width="*">&nbsp;</td></tr>

	<?php if($guru==''){?>
	<td width="*">&nbsp;</td></tr></table>
	<input type="hidden" id="pelajaran" value="<?=$pel?>"/>
	<input type="hidden" id="tingkat" value="<?=$ting?>"/>
	<div class="infobox">Pilih guru.</div>
	<?php exit();}?>

	<?php if(count($pelajaran)>0){?>
	<td width="70px" align="left"><b>Pelajaran:</b></td>
	<td width="150px"><?=iSelect('pelajaran',$pelajaran,$pel,"margin-right:30px",$fmod."_get()")?></td>
	<?php } else { ?>
	<td width="*">&nbsp;</td></tr></table></div>
	<input type="hidden" id="pelajaran" value="<?=$pel?>"/>
	<input type="hidden" id="tingkat" value="<?=$ting?>"/>
	<?php exit();}?>
	
	<?php if(count($tingkat)>0){?>
	<td width="70px" align="left"><b>Tingkat:</b></td>
	<td width="150px"><?=iSelect('tingkat',$tingkat,$ting,"margin-right:30px",$fmod."_get()")?></td>
	<?php } else { ?>
	<td width="*">&nbsp;</td></tr></table></div>
	<input type="hidden" id="tingkat" value="<?=$ting?>"/>
	<?php exit();}?>
	
</table></div>
<?php $xtable->btnbar_f('notifbox','add');

$ta=mysql_query("SELECT * FROM aka_aspekpenilaian ORDER BY KODE");
$xtable->ndata=mysql_num_rows($ta);
if($xtable->ndata>0){
$xtable->head('Aspek Penilaian',$xtable->idata);
$x=$xtable->frow_color();
while($ra=mysql_fetch_array($ta)){ $xtable->frow_change($x);
	/*
	$tg=mysql_query("SELECT * FROM aka_grading WHERE guru='$guru' AND tingkat='$ting' AND pelajaran='$pel' AND aspekpenilaian='".$ra['replid']."'");
	if(mysql_num_rows($tg)>0){
		$rg=mysql_fetch_array($tg);
	} else {
		mysql_query("INSERT INTO aka_grading SET guru='$guru',tingkat='$ting',pelajaran='$pel',aspekpenilaian='".$ra['replid']."'");
		$rid=mysql_insert_id();
	}*/
?>
	<tr class="xtr<?=$x?>"><?php
		$xtable->td($ra['aspekpenilaian'],200);
		$xtable->td($r[$fmod]);
		$xtable->opt_ud($ra['replid']);
	?></tr>
<?php }?>
</table>
<?php }else{echo '<div class="infobox">Tidak ditemukan data aspek penilaian. Silahkan <a class="linkb" href="#&aspekpenilaian" onclick="PCBCODE=1;openPage('.app_page_getindex('aspekpenilaian').',\'aspekpenilaian\',false)">menambah data aspek penilaian</a>.</div>';}
 ?>