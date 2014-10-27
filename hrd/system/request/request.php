<?php
// REQUEST HANDLER
require_once('config.php');
require_once('db.php');
require_once('common.php');

// XMLHTTP Request
$q=gets('q');
if($q=="addemployee"){
    // Poin A
    $desired_emp='';
    for($k=1;$k<=8;$k++){
        if($desired_emp!='') $desired_emp.='~';
		if($_REQUEST['desired_emp'.$k]=='1')
			$desired_emp.='1';
		else
			$desired_emp.='0';
    }
    
    $desired_emp_other=$_REQUEST['desired_emp_other'];
    $desired_emp_subj=$_REQUEST['desired_emp_subj'];
    
    // Poin B
    // name,address,addresssby,email,home_phone,fax,cellphone,birth_place,birth_date_d,marital_stat,martial_date_d,religion,church_name,church_address,pastor_name,church_activity,hobbies
    // abroad,abroad_where
    $name=$_REQUEST['name'];
    $gender=$_REQUEST['gender'];
    $address=$_REQUEST['address'];
    $addresssby=$_REQUEST['addresssby'];
    $email=$_REQUEST['email'];
    $home_phone=$_REQUEST['home_phone'];
    $fax=$_REQUEST['fax'];
    $cellphone=$_REQUEST['cellphone'];
    $birth_place=$_REQUEST['birth_place'];
    $birth_date=reqYear($_REQUEST['birth_date_y']).'-'.$_REQUEST['birth_date_m'].'-'.$_REQUEST['birth_date_d'];
    $marital_stat=$_REQUEST['marital_stat'];
    $martial_date=reqYear($_REQUEST['martial_date_y']).'-'.$_REQUEST['martial_date_m'].'-'.$_REQUEST['martial_date_d'];
    $religion=$_REQUEST['religion'];
    $church_name=$_REQUEST['church_name'];
    $church_address=$_REQUEST['church_address'];
    $pastor_name=$_REQUEST['pastor_name'];
    $church_activity=$_REQUEST['church_activity'];
    $hobbies=$_REQUEST['hobbies'];
    $abroad=$_REQUEST['abroad'];
    $abroad_where=$_REQUEST['abroad_where'];
    
    // Poin D
    // healt_description,healt_hearing,healt_eyesight,healt_bloodtype,healt_disabilities,healt_lastex,healt_circumtance
    $healt_description=$_REQUEST['healt_description'];
    $healt_hearing=$_REQUEST['healt_hearing'];
    $healt_eyesight=$_REQUEST['healt_eyesight'];
    $healt_bloodtype=$_REQUEST['healt_bloodtype'];
    $healt_disabilities=$_REQUEST['healt_disabilities'];
    $healt_lastex=$_REQUEST['healt_lastex'];
    $healt_circumtance=$_REQUEST['healt_circumtance'];
    
    // Poin E
    // gi1
    $gi="";
    for($kk=1;$kk<=14;$kk++){
        if($gi!='') $gi.=", ";
        $gi=$gi."gi".$kk."='".$_REQUEST['gi'.$kk]."'";
    }
    
    // Poin F
    $job_data='';
    for($k=1;$k<=9;$k++){
        if($job_data!='') $job_data.='~';
        $job_data.=job_d($k);
    }
    
    // Poin I
    // ai1
    $ai="";
    for($kk=1;$kk<=5;$kk++){
        if($ai!='') $ai.=", ";
        $ai=$ai."ai".$kk."='".$_REQUEST['ai'.$kk]."'";
    }
    
    $job_data_comp=$_REQUEST['job_data_comp'];
    $job_data_other=$_REQUEST['job_data_other'];
	
    $catatan=$_REQUEST['catatan'];
    
    $query = "INSERT INTO jbssdm.employment_app SET desired_emp='$desired_emp', desired_emp_other='$desired_emp_other', desired_emp_subj='$desired_emp_subj', name='$name', gender='$gender', address='$address', addresssby='$addresssby', email='$email', home_phone='$home_phone',fax='$fax', cellphone='$cellphone', birth_date='$birth_date', birth_place='$birth_place', marital_stat='$marital_stat', martial_date='$martial_date',religion='$religion', church_name='$church_name', church_address='$church_address', pastor_name='$pastor_name', church_activity='$church_activity',hobbies='$hobbies', abroad='$abroad', abroad_where='$abroad_where', healt_description='$healt_description', healt_hearing='$healt_hearing', healt_eyesight='$healt_eyesight', healt_bloodtype='$healt_bloodtype', healt_disabilities='$healt_disabilities', healt_lastex='$healt_lastex' ,healt_circumtance='$healt_circumtance', job_data='$job_data', job_data_comp='$job_data_comp', job_data_other='$job_data_other', catatan='$catatan', ".$gi.", ".$ai;

    $result = mysql_query($query);
	
	$dcid=mysql_insert_id();
	
	if($result && !empty($_FILES['file']['name'])){
		$UFPATH="berkas/formdaftar/";
		$UFNAME="fd_".$dcid;
		
		require_once('uploader.php');
		
		if($errors==0){
			//header('location:'.RLNK.'viewemployee.php?nid='.$dcid);
			
			dbUpdate("employment_app",Array('berkas'=>$filename),"dcid='$dcid'");
		}
	}
	
	header('location:'.RLNK.'viewemployee.php?nid='.$dcid);
}
else if($q=="editemployee"){
	$dcid=gpost('dcid');
	
    // Poin A
    $desired_emp='';
    for($k=1;$k<=8;$k++){
        if($desired_emp!='') $desired_emp.='~';
		if($_REQUEST['desired_emp'.$k]=='1')
			$desired_emp.='1';
		else
			$desired_emp.='0';
    }
    
    $desired_emp_other=$_REQUEST['desired_emp_other'];
    $desired_emp_subj=$_REQUEST['desired_emp_subj'];
    
    // Poin B
    // name,address,addresssby,email,home_phone,fax,cellphone,birth_place,birth_date_d,marital_stat,martial_date_d,religion,church_name,church_address,pastor_name,church_activity,hobbies
    // abroad,abroad_where
    $name=$_REQUEST['name'];
	$gender=$_REQUEST['gender'];
    $address=$_REQUEST['address'];
    $addresssby=$_REQUEST['addresssby'];
    $email=$_REQUEST['email'];
    $home_phone=$_REQUEST['home_phone'];
    $fax=$_REQUEST['fax'];
    $cellphone=$_REQUEST['cellphone'];
    $birth_place=$_REQUEST['birth_place'];
    $birth_date=reqYear($_REQUEST['birth_date_y']).'-'.$_REQUEST['birth_date_m'].'-'.$_REQUEST['birth_date_d'];
    $marital_stat=$_REQUEST['marital_stat'];
    $martial_date=reqYear($_REQUEST['martial_date_y']).'-'.$_REQUEST['martial_date_m'].'-'.$_REQUEST['martial_date_d'];
    $religion=$_REQUEST['religion'];
    $church_name=$_REQUEST['church_name'];
    $church_address=$_REQUEST['church_address'];
    $pastor_name=$_REQUEST['pastor_name'];
    $church_activity=$_REQUEST['church_activity'];
    $hobbies=$_REQUEST['hobbies'];
    $abroad=$_REQUEST['abroad'];
    $abroad_where=$_REQUEST['abroad_where'];
    
    // Poin D
    // healt_description,healt_hearing,healt_eyesight,healt_bloodtype,healt_disabilities,healt_lastex,healt_circumtance
    $healt_description=$_REQUEST['healt_description'];
    $healt_hearing=$_REQUEST['healt_hearing'];
    $healt_eyesight=$_REQUEST['healt_eyesight'];
    $healt_bloodtype=$_REQUEST['healt_bloodtype'];
    $healt_disabilities=$_REQUEST['healt_disabilities'];
    $healt_lastex=$_REQUEST['healt_lastex'];
    $healt_circumtance=$_REQUEST['healt_circumtance'];
    
    // Poin E
    // gi1
    $gi="";
    for($kk=1;$kk<=14;$kk++){
        if($gi!='') $gi.=", ";
        $gi=$gi."gi".$kk."='".$_REQUEST['gi'.$kk]."'";
    }
    
    // Poin F
    $job_data='';
    for($k=1;$k<=9;$k++){
        if($job_data!='') $job_data.='~';
        $job_data.=job_d($k);
    }
    
    // Poin I
    // ai1
    $ai="";
    for($kk=1;$kk<=5;$kk++){
        if($ai!='') $ai.=", ";
        $ai=$ai."ai".$kk."='".$_REQUEST['ai'.$kk]."'";
    }
    
    $job_data_comp=$_REQUEST['job_data_comp'];
    $job_data_other=$_REQUEST['job_data_other'];
	
    $catatan=$_REQUEST['catatan'];
    
    $query = "UPDATE jbssdm.employment_app SET desired_emp='$desired_emp', desired_emp_other='$desired_emp_other', desired_emp_subj='$desired_emp_subj', name='$name', gender='$gender', address='$address', addresssby='$addresssby', email='$email', home_phone='$home_phone',fax='$fax', cellphone='$cellphone', birth_date='$birth_date', birth_place='$birth_place', marital_stat='$marital_stat', martial_date='$martial_date',religion='$religion', church_name='$church_name', church_address='$church_address', pastor_name='$pastor_name', church_activity='$church_activity',hobbies='$hobbies', abroad='$abroad', abroad_where='$abroad_where', healt_description='$healt_description', healt_hearing='$healt_hearing', healt_eyesight='$healt_eyesight', healt_bloodtype='$healt_bloodtype', healt_disabilities='$healt_disabilities', healt_lastex='$healt_lastex' ,healt_circumtance='$healt_circumtance', job_data='$job_data', job_data_comp='$job_data_comp', job_data_other='$job_data_other', catatan='$catatan', ".$gi.", ".$ai." WHERE dcid='$dcid'";

    $result = mysql_query($query);
	
	if($result && !empty($_FILES['file']['name'])){
		$UFPATH="berkas/formdaftar/";
		$UFNAME="fd_".$dcid;
		
		require_once('uploader.php');
		
		if($errors==0){
			//header('location:'.RLNK.'viewemployee.php?nid='.$dcid);
			
			dbUpdate("employment_app",Array('berkas'=>$filename),"dcid='$dcid'");
		}
	}
	
	header('location:'.RLNK.'viewemployee.php?nid='.$dcid);
	
} else {
	header('location:'.RLNK);
}
?>