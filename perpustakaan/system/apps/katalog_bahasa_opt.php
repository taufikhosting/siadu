<?php 
$bahasa = bahasa_opt();
foreach($bahasa as $k=>$v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>