<?php 
$klasifikasi = klasifikasi_opt();
foreach($klasifikasi as $k=>$v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>