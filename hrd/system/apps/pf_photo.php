<?php
$dcid=gpost('id');

$tmpimg = PHODIR."ptmp.jpg";

$src = imagecreatefromjpeg($tmpimg);
list($width,$height)=getimagesize($tmpimg);
$tmp=imagecreatetruecolor($width,$height);
imagecopyresampled($tmp,$src,0,0,0,0,$width,$height,$width,$height);
$filename = PHODIR."pp_".$dcid."_".date("YmdHis").".jpg";
imagejpeg($tmp,$filename,100);
imagedestroy($src);
imagedestroy($tmp);

$image = chunk_split(base64_encode(file_get_contents($tmpimg)));
$n=dbSRow("emp_photo","W/empid='$dcid'");
if($n>0){
	$res=dbUpdate("emp_photo",Array('photo'=>$image),"empid='$dcid'");
	$res=dbUpdate("employee",Array('photo'=>$filename),"empid='$dcid'");
} else {
	$res=dbInsert("emp_photo",Array('empid'=>$dcid,'photo'=>$image));
}
?>
<img id="pp<?=date("YmdHis")?>" src="<?=RLNK?>photo.php?id=<?=$dcid?>&arg=<?=date("YmdHis")?>"/>