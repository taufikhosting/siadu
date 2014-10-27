<?php
$cid=gpost('cid',0);
$lok=gpost('lokasi');
$tingb=gpost('tingkatbuku');
$sumber=gpost('sumber');
$nbuku=intval(gpost('nbuku'));
if($cid==0){
	$data=array('kodelokasi'=>$lok,'kodetingkat'=>$tingb,'sumber'=>$sumber,'nomorauto'=>($nbuku>1?"[auto]":0));
} else {
	$t=mysql_query("SELECT pus_buku.* FROM pus_buku WHERE pus_buku.replid='$cid' LIMIT 0,1");
	$r=mysql_fetch_array($t);
	$data=array('kodelokasi'=>$lok,'kodetingkat'=>$tingb,'sumber'=>$sumber,'nomorauto'=>$r['urut']);
}
$barkode=buku_makebarkode($data);
$idbuku=buku_makeid($data);
echo $barkode.'~'.$idbuku.'~'.$cid;
?>