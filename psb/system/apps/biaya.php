<?php
require_once(MODDIR.'control.php');

$dept=gpost("departemen");
$pros=gpost("proses");
$kel=gpost("kelompok");

// Query Update
$t=mysql_query("SELECT * FROM psb_kriteria");
$ndata=mysql_num_rows($t);
while($r=mysql_fetch_array($t)){
	$q=mysql_query("SELECT * FROM psb_golongan");
	while($h=mysql_fetch_array($q)){
		$nilai=gpost('biaya'.$r['replid'].'_'.$h['replid']);
		$spp=gpost('spp'.$r['replid'].'_'.$h['replid']);
		$daftar=gpost('daftar'.$r['replid'].'_'.$h['replid']);
		
		$krit=$r['replid'];
		$gol=$h['replid'];
		$tq=mysql_query("SELECT * FROM psb_setbiaya WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol' LIMIT 0,1");
		if(mysql_num_rows($tq)>0){
			$sql="UPDATE psb_setbiaya SET daftar='$daftar',nilai='$nilai',spp='$spp' WHERE pros='$pros' AND kel='$kel' AND krit='$krit' AND gol='$gol'";
			if(mysql_query($sql));
			//echo $sql.'...OK<br/>'; else echo $sql.'...FAILED<br/>';
		}
		else {
			$sql="INSERT INTO psb_setbiaya SET departemen='$dept',pros='$pros', kel='$kel', krit='$krit', gol='$gol', daftar='$daftar', nilai='$nilai', spp='$spp'";
			if(mysql_query($sql));
			//echo $sql.'...OK<br/>'; else echo $sql.'...FAILED<br/>';
		}
	}
}

//$_SESSION['psb_notifbox']='<div id="notifbox" class="infobox">Pengaturan biaya telah disimpan</div>';

$_SESSION['psb_notifbox']='<div id="notifbox" style="position:fixed;width:100%;top:140px;left:0px"><table style="position:relative;margin:auto" cellspacing="0" cellpadding="0"><tr><td><div style="position:relative;'.SFONT12.';color:'.CDARK.';cursor:default;padding:4px 8px 2px 20px;border:1px solid #ffc000;border-radius:2px;background:url(\''.IMGR.'info.png\') 4px 6px no-repeat #fff8d6;line-height:150%;box-shadow:0px 2px 5px rgba(0,0,0,0.4);margin:auto"><b>Pengaturan biaya telah disimpan.</b></div></td></tr></table></div>';

require_once(VWDIR.'biaya_data.php');

?>