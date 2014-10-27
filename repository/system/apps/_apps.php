<?php
$app=gpost('app');
if($app=='panel'){
	$tilecount=1; panel_draw();
}
else if($app=='menu'){
	app_menu();
}
else if($app=='view'){
	app_page_view();
}
else if($app=='checkuser'){
	app_checkuser();
}
?>