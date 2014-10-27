<?php 
$penerbit = penerbit_opt();
foreach($penerbit as $k=>$v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>