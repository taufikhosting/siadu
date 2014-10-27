<?php 
$jenisbuku = jenisbuku_opt();
foreach($jenisbuku as $k=>$v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>