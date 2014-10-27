<?php
session_start();

// System files
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

$q=gets('q');
if($q=="addemployee"){    
    // Poin B: Personal Information
	$ia=Array('name','gender','address','postcode','email','phonefax','nationality','birthdate','birthplace','marital','religion','churchname','churchaddress','pastorname','churchactv','hobby','abroad');
	$inp=Array();
	foreach($ia as $k=>$v){
		$inp[$v]=gpost($v);
	}
	$nm=explode(" ",$inp['name']); $inp['fname']=(($inp['gender']=='Male')?"Mr. ":"Mrs. ").$nm[0];
	
	dbInsert("employee",$inp);
	$dcid=mysql_insert_id();
	
	// Self description
	$inp=Array();
	$inp['empid']=$dcid;
	$inp['name']=gpost('sd_name');
	for($i=1;$i<=20;$i++){
		$inp['desc'.$i]=gpost('sd_desc'.$i);
	}
	$inp['option']=gpost('sd_option');
	$inp['reason']=gpost('sd_reason');
	
	for($i=1;$i<=4;$i++){
		$inp['info'.$i]=gpost('sd_info'.$i);
	}
	dbInsert("emp_desc",$inp);
	
	// Application Position
	$inp=Array();
	$inp['empid']=$dcid;
	for($i=1;$i<=8;$i++){
		if($i>1)$inp['option'].='~';
		$inp['option'].=gpost('apos'.$i)=='1'?'1':'0';
	}
	$inp['other']=gpost('apos_other');
	$inp['specific']=gpost('apos_specific');
	dbInsert("emp_apos",$inp);
	
	// Family Relation
	for($i=0;$i<10;$i++){
		if(gpost('family_family'.$i)!=''){
			$family=gpost('family_family'.$i);
			$name=gpost('family_name'.$i);
			$address=gpost('family_address'.$i);
			$education=gpost('family_education'.$i);
			$birthplace=gpost('family_birthplace'.$i);
			$birthdate=gpost('family_birthdate'.$i);
			$job=gpost('family_job'.$i);
			dbInsert("emp_family",Array('empid'=>$dcid,'family'=>$family,'name'=>$name,'address'=>$address,'education'=>$education,'birthplace'=>$birthplace,'birthdate'=>$birthdate,'job'=>$job));
		}
	}
	
	// Education
	for($i=0;$i<10;$i++){
		if(gpost('education_university'.$i)!=''){
			$university=gpost('education_university'.$i);
			$year=gpost('education_year'.$i);
			$title=gpost('education_title'.$i);
			$field=gpost('education_field'.$i);
			$score=gpost('education_score'.$i);
			dbInsert("emp_education",Array('empid'=>$dcid,'university'=>$university,'year'=>$year,'title'=>$title,'field'=>$field,'score'=>$score));
		}
	}	

	// Course
	for($i=0;$i<10;$i++){
		if(gpost('course_title'.$i)!=''){
			$title=gpost('course_title'.$i);
			$organizer=gpost('course_organizer'.$i);
			$place=gpost('course_place'.$i);
			$year=gpost('course_year'.$i);
			$certified=gpost('course_certified'.$i);
			dbInsert("emp_course",Array('empid'=>$dcid,'title'=>$title,'organizer'=>$organizer,'place'=>$place,'year'=>$year,'certified'=>$certified));
		}
	}
	
	// Organization
	for($i=0;$i<10;$i++){
		if(gpost('organization_name'.$i)!=''){
			$name=gpost('organization_name'.$i);
			$position=gpost('organization_position'.$i);
			$year=gpost('organization_year'.$i);
			dbInsert("emp_organization",Array('empid'=>$dcid,'name'=>$name,'position'=>$position,'year'=>$year));
		}
	}
	
	// Healt_info
	$inp=Array();
	for($i=1;$i<=7;$i++){
		$inp['info'.$i]=gpost('hinfo'.$i);
	}
	$inp['empid']=$dcid;
	dbInsert("emp_healt",$inp);
	
	// General info
	$inp=Array();
	for($i=1;$i<=14;$i++){
		$inp['info'.$i]=gpost('ginfo'.$i);
	}
	$inp['empid']=$dcid;
	dbInsert("emp_ginfo",$inp);
	
	// Job data
	$jobdata="";
	for($i=1;$i<=9;$i++){
		if($i>1) $jobdata.="~";
		$a=gpost('job_data'.$i);
		$jobdata.=($a=='1')?'1':'0';
	}
	$computer=gpost('empjd_computer');
	$other=gpost('empjd_other');
	dbInsert("emp_jobdata",Array('empid'=>$dcid,'jobdata'=>$jobdata,'computer'=>$computer,'other'=>$other));
	
	// Job History
	for($i=0;$i<10;$i++){
		if(gpost('jobhis_name'.$i)!=''){
			$name=gpost('jobhis_name'.$i);
			$address=gpost('jobhis_address'.$i);
			$date1=gpost('jobhis_date1'.$i);
			$date2=gpost('jobhis_date2'.$i);
			$position=gpost('jobhis_position'.$i);
			$salary=gpost('jobhis_salary'.$i);
			$reason=gpost('jobhis_reason'.$i);
			dbInsert("emp_jobhis",Array('empid'=>$dcid,'name'=>$name,'address'=>$address,'date1'=>$date1,'date2'=>$date2,'position'=>$position,'salary'=>$salary,'reason'=>$reason));
		}
	}
	
	// References
	for($i=0;$i<10;$i++){
		if(gpost('reference_name'.$i)!=''){
			$name=gpost('reference_name'.$i);
			$address=gpost('reference_address'.$i);
			$phone=gpost('reference_phone'.$i);
			$job=gpost('reference_job'.$i);
			$know=gpost('reference_know'.$i);
			$relation=gpost('reference_relation'.$i);
			
			dbInsert("emp_reference",Array('empid'=>$dcid,'name'=>$name,'address'=>$address,'phone'=>$phone,'job'=>$job,'know'=>$know,'relation'=>$relation));
		}
	}
	
	// Additional info
	$inp=Array();
	for($i=1;$i<=5;$i++){
		$inp['info'.$i]=gpost('ainfo'.$i);
	}
	$inp['empid']=$dcid;
	dbInsert("emp_ainfo",$inp);
	
	header('location:'.RLNK.'employee_view.php?nid='.$dcid);
} else if($q=="editemployee"){    
	$dcid=gpost('dcid');
	
    // Poin B: Personal Information
	$ia=Array('name','gender','address','postcode','email','phonefax','nationality','birthdate','birthplace','marital','religion','churchname','churchaddress','pastorname','churchactv','hobby','abroad');
	$inp=Array();
	foreach($ia as $k=>$v){
		$inp[$v]=gpost($v);
	}
	$nm=explode(" ",$inp['name']); $inp['fname']=(($inp['gender']=='Male')?"Mr. ":"Mrs. ").$nm[0];
	$fname=$inp['fname'];
	dbUpdate("employee",$inp,"dcid='$dcid'");
	
	// Self description
	$inp=Array();
	$inp['name']=gpost('sd_name');
	for($i=1;$i<=20;$i++){
		$inp['desc'.$i]=gpost('sd_desc'.$i);
	}
	$inp['option']=gpost('sd_option');
	$inp['reason']=gpost('sd_reason');
	
	for($i=1;$i<=4;$i++){
		$inp['info'.$i]=gpost('sd_info'.$i);
	}
	dbUpdate("emp_desc",$inp,"empid='$dcid'");
	
	// Application Position
	$inp=Array();
	for($i=1;$i<=8;$i++){
		if($i>1)$inp['option'].='~';
		$inp['option'].=gpost('apos'.$i)=='1'?'1':'0';
	}
	$inp['other']=gpost('apos_other');
	$inp['specific']=gpost('apos_specific');
	dbUpdate("emp_apos",$inp,"empid='$dcid'");
	
	// Family Relation
	dbDel("emp_family","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('family_family'.$i)!=''){
			$family=gpost('family_family'.$i);
			$name=gpost('family_name'.$i);
			$address=gpost('family_address'.$i);
			$education=gpost('family_education'.$i);
			$birthplace=gpost('family_birthplace'.$i);
			$birthdate=gpost('family_birthdate'.$i);
			$job=gpost('family_job'.$i);
			dbInsert("emp_family",Array('empid'=>$dcid,'family'=>$family,'name'=>$name,'address'=>$address,'education'=>$education,'birthplace'=>$birthplace,'birthdate'=>$birthdate,'job'=>$job));
		}
	}
	
	// Education
	dbDel("emp_education","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('education_university'.$i)!=''){
			$university=gpost('education_university'.$i);
			$year=gpost('education_year'.$i);
			$title=gpost('education_title'.$i);
			$field=gpost('education_field'.$i);
			$score=gpost('education_score'.$i);
			dbInsert("emp_education",Array('empid'=>$dcid,'university'=>$university,'year'=>$year,'title'=>$title,'field'=>$field,'score'=>$score));
		}
	}	

	// Course
	dbDel("emp_course","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('course_title'.$i)!=''){
			$title=gpost('course_title'.$i);
			$organizer=gpost('course_organizer'.$i);
			$place=gpost('course_place'.$i);
			$year=gpost('course_year'.$i);
			$certified=gpost('course_certified'.$i);
			dbInsert("emp_course",Array('empid'=>$dcid,'title'=>$title,'organizer'=>$organizer,'place'=>$place,'year'=>$year,'certified'=>$certified));
		}
	}
	
	// Organization
	dbDel("emp_organization","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('organization_name'.$i)!=''){
			$name=gpost('organization_name'.$i);
			$position=gpost('organization_position'.$i);
			$year=gpost('organization_year'.$i);
			dbInsert("emp_organization",Array('empid'=>$dcid,'name'=>$name,'position'=>$position,'year'=>$year));
		}
	}
	
	// Healt_info
	$inp=Array();
	for($i=1;$i<=7;$i++){
		$inp['info'.$i]=gpost('hinfo'.$i);
	}
	dbUpdate("emp_healt",$inp,"empid='$dcid'");
	
	// General info
	$inp=Array();
	for($i=1;$i<=14;$i++){
		$inp['info'.$i]=gpost('ginfo'.$i);
	}
	dbUpdate("emp_ginfo",$inp,"empid='$dcid'");
	
	// Job data
	$jobdata="";
	for($i=1;$i<=9;$i++){
		if($i>1) $jobdata.="~";
		$a=gpost('job_data'.$i);
		$jobdata.=($a=='1')?'1':'0';
	}
	$computer=gpost('empjd_computer');
	$other=gpost('empjd_other');
	dbUpdate("emp_jobdata",Array('jobdata'=>$jobdata,'computer'=>$computer,'other'=>$other),"empid='$dcid'");
	
	// Job History
	dbDel("emp_jobhis","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('jobhis_name'.$i)!=''){
			$name=gpost('jobhis_name'.$i);
			$address=gpost('jobhis_address'.$i);
			$date1=gpost('jobhis_date1'.$i);
			$date2=gpost('jobhis_date2'.$i);
			$position=gpost('jobhis_position'.$i);
			$salary=gpost('jobhis_salary'.$i);
			$reason=gpost('jobhis_reason'.$i);
			dbInsert("emp_jobhis",Array('empid'=>$dcid,'name'=>$name,'address'=>$address,'date1'=>$date1,'date2'=>$date2,'position'=>$position,'salary'=>$salary,'reason'=>$reason));
		}
	}
	
	// References
	dbDel("emp_reference","empid='$dcid'");
	for($i=0;$i<10;$i++){
		if(gpost('reference_name'.$i)!=''){
			$name=gpost('reference_name'.$i);
			$address=gpost('reference_address'.$i);
			$phone=gpost('reference_phone'.$i);
			$job=gpost('reference_job'.$i);
			$know=gpost('reference_know'.$i);
			$relation=gpost('reference_relation'.$i);
			
			dbInsert("emp_reference",Array('empid'=>$dcid,'name'=>$name,'address'=>$address,'phone'=>$phone,'job'=>$job,'know'=>$know,'relation'=>$relation));
		}
	}
	
	// Additional info
	$inp=Array();
	for($i=1;$i<=5;$i++){
		$inp['info'.$i]=gpost('ainfo'.$i);
	}
	dbUpdate("emp_ainfo",$inp,"empid='$dcid'");
	
	$_SESSION['joshreditinfo']="Employee's information has been updated.";
	
	header('location:'.RLNK.'employee_edit.php?nid='.$dcid);
} else {
	header('location:'.RLNK);
}

?>