<?php
function kondisisiswa_name($a){
	return dbFetch("kondisi","psb_kondisisiswa","W/replid='$a'");
}
?>