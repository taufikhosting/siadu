<?php
$opt=gpost('opt');
$val=gpost('v');
if($opt=='author'){
$t=dbSel("*","mstr_author","O/ prefix");
	echo '<option value="0" >any author</option>';
while($r=dbFA($t)){
	echo '<option value="'.$r['dcid'].'" >'.$r['name'].' ('.$r['prefix'].')</option>';
}
} else if($opt=='publisher'){
$t=dbSel("*","mstr_publisher","O/ name");
	echo '<option value="0" >any publisher</option>';
while($r=dbFA($t)){
	echo '<option value="'.$r['dcid'].'" >'.$r['name'].'</option>';
}
}
?>