<?php 
$pengarang = pengarang_opt();
foreach($pengarang as $k=>$v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>