<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php'); $opt=gpost('opt');$cid=gpost('cid',0);
$ssid=session_id();

// form Module
$fmod="tools_label_buku";
$dbtable='pus_tpjm';
if($opt=='a'){
	$data=gpost('data');
	if($data!=""){
		$q=true;
		$did=explode(",",$data);
		$n=count($did);
		for($i=0;$i<$n;$i++){
			$cid=$did[$i];
			$q&=dbQSql("INSERT INTO pus_tpjm SET buku='$cid',ssid='$ssid'");
		}
	}
}
else if($opt=='d'){ // delete
	$q=dbDel($dbtable,"replid='$cid'");
}
else if($opt=='af'){
	$fform=new fform($fmod,'af',$cid,'Cari item');
	$fform->reg['title_af']='<idata>';
	$fform->reg['btnlabel_a_y']='Pilih yg ditandai';
	$fform->reg['btnlabel_a_n']='Batal';
	$fform->dimension(600);
	$fform->ptop=20;
	$fform->globalkey='0';
	$fform->head('Pilih Item Yang Akan Dicetak');
	echo '<tr><td><div id="box_tools_label_buku_list">';
		require_once(APPDIR.'tools_label_buku_list_get.php');
	echo '</div></td></tr>';
	
	$fform->nobtn_action.='Efoc(\'sbuku\');';
	$fform->foot();
}
?>