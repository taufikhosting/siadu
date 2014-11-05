<?php
$opt=gpost('opt');
$val=gpost('v');
if($opt=='author'||$opt=='author2'){
$t=dbSel("*","mstr_author","O/ prefix");
while($r=dbFAx($t)){
	echo '<option value="'.$r['dcid'].'" '.($r['dcid']==$val?'selected':'').' >'.$r['name'].'</option>';
}
} else if($opt=='publisher'){
$t=dbSel("*","mstr_publisher","O/ name");
while($r=dbFAx($t)){
	echo '<option value="'.$r['dcid'].'" '.($r['dcid']==$val?'selected':'').'>'.$r['name'].'</option>';
}
}
?>