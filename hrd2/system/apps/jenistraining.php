<?php
// Default Post Variables
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='') $cid=0;
// form Module
$fmod=gpost('fmod');
$dbtable="hrd_m_".$fmod;
$idata='jenis training';
// Post Variables
$inp=app_form_gpost($fmod,'keterangan');
// Form Title
$mdialog=app_form_title();
if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='m'){ $q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	app_form_notif($q,$opt);
} else { if($opt!='df') require_once(MODDIR.'control.php'); $sx=str_replace('f','',$opt);
	// Form dimension
	$fwidth=$opt!='df'?400:500; $lwidth=110; $ptop=150; $rwidth="width:".($fwidth-$lwidth-18)."px";
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		
	}
	app_form_head($mdialog[$opt]);
	if($opt=='af' || $opt=='uf'){ $okbtn=($opt=='af')?"Simpan":"OK"; $nobtn=" Batal "; $gd='true'; // Add or Edit form 

		app_form_fi(ucfirst(strtolower($idata)),iText($fmod,$r,$rwidth));
		app_form_fa('Keterangan',iTextarea('keterangan',$r,$rwidth,3));
	
	} else if($opt=='df'){ $okbtn="Ya"; $nobtn="Tidak"; $gd='false'; // Delete form 
	
		$dcf=app_form_del_w($r[$fmod]);
		app_form_dlg($dcf);
		
	} app_form_foot();
} ?>