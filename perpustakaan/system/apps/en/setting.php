<?php require_once(MODDIR.'fform/fform.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

if($opt=='cek'){
	$old=md5(gpost('old'));
	$new=md5(gpost('new'));
	$bahasa=gpost('bahasa');
	$data=admin_get();
	$cid=$data['id'];
	//echo $data['id'];
	
	$t=mysql_query("SELECT passwd FROM admin WHERE replid='$cid' LIMIT 0,1");
	if(mysql_num_rows($t)==1){
		$r=mysql_fetch_row($t);
		if($r[0]==$old){
			if(mysql_query("UPDATE admin SET passwd='$new' WHERE replid='$cid'")){
				echo "0";
			}
			else{
				echo "3";
			}
		}
		else {
			echo "2";
		}
	} else {
		echo "1";
	}
	// echo "UPDATE admin SET passwd='$new' WHERE replid='$cid'";
	// exit();
} else {

// form Module
$fmod="setting";
$dbtable="Setting";

$admin = admin_get();
$adminid = $admin['id'];
$fform=new fform($fmod,$opt,$admin['id'],'Setting');
$fform->reg['title_uf']='<idata>';

if($opt=='u'){ $q=false;
	$inp=array();
	$inp['bahasa']=gpost('bahasa');
	log_print($inp['bahasa'].' admin id:'.$adminid);
	if(gpost('newpassword')!=''){
		$inp['password']=gpost('newpassword');
	}
	
	$q=dbUpdate("admin",$inp,"replid='$adminid'");
	
	$fform->reg['notif_u']='Pengaturan telah disimpan. Silahkan login kembali.';
	$fform->notif($q);
} else {
	$t=mysql_query("SELECT * FROM admin WHERE replid='$adminid'");
	$r=mysql_fetch_array($t);
	
	$fform->lwidth=150; $fform->fwidth=500; $fform->ptop=100;
	$fform->head();
	require_once(MODDIR.'control.php'); // Add or Edit form

		$fform->fg('Application Setting');
		$fform->fi('Language',iSelect('bahasa',array('id'=>'Indonesian (Bahasa)','en'=>'English'),$r['bahasa']));
		//'pwx'	Password ganti (o,'r'+o,'x'+o)
		$fform->fg('Change Passowrd','(<i>leave these fields to keep current password</i>)');
		$fform->fi('Current password',iText('oldpassword','',$fform->rwidths));
		$fform->fi('New password',iPswd('newpassword','',$fform->rwidths));
		$fform->fi('Retype new password',iPswd('rnewpassword','',$fform->rwidths));
	
	$fform->foot();
} }?>