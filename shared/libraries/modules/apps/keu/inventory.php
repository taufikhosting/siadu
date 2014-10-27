<?php
function grupbrg_name($a){
	if(is_array($a))$b=$a['grupbrg'];
	else $b=$a;
	return dbFetch("nama","keu_grupbrg","W/replid='$b'");
}
function kelompokbrg_name($a){
	if(is_array($a))$b=$a['kelompokbrg'];
	else $b=$a;
	return dbFetch("nama","keu_kelompokbrg","W/replid='$b'");
}
?>