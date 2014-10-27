<input type="hidden" name="dcid" value="<?=$empp['dcid']?>"/>
		<div style="border:1px solid #dedede;padding:30px;background:#f4f4ff;position:relative">
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px" border="0">
			<tr><td colspan="3" style="border-bottom:1px solid #aeaeae;padding-bottom:10px"><b>SELF DESCRIPTION</b></td></tr>
			<?php
			$emps=dbSFAx("*","emp_desc","W/empid='$dcid'");
			?>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr><td colspan="3" width="140px"><b>Name</b><?=iText('sd_name',$emps['name'],"margin-left:30px;width:794px")?></td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px"><td colspan="3"><b>Write 20 statements that describe you:</b></td></tr>
			<?php for($i=1;$i<=20;$i++){?>
			<tr id="sd<?=$i?>" style="display:<?=($i<6||$emps['desc'.$i]!='')?"":"none"?>"><td width="28px"><?=$i?>.</td><td colspan="2"><?=iText('sd_desc'.$i,$emps['desc'.$i],"width:830px")?></td></tr>
			<?php }?>
			<tr><td>&nbsp;</td><td colspan="2" style="padding-top:10px"><a class="linkl11" href="javascript:addSdRow()">Add more description...</a></td></tr> <!-- Separator -->
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="24px"><td colspan="3"><b>Place a checkmark in the appropriate box</b></td></tr>
			<tr height="24px"><td colspan="3">Overall, I feel:</td></tr>
			<tr><td colspan="3">
				<table id="sdopt" cellspacing="0x" cellpadding="0" border="0">
					<tr height="24px">
						<td width="20px"><input id="sdo1" type="radio" name="sd_option" <?=isCheck($emps['option'],1)?> value="1"/></td><td width="185px"><label for="sdo1">very unsatisfied</label></td>
						<td width="20px"><input id="sdo2" type="radio" name="sd_option" <?=isCheck($emps['option'],2)?> value="2"/></td><td width="*"><label for="sdo2">unsatisfied
					</tr>
					<tr height="24px">
						<td width="20px"><input id="sdo3" type="radio" name="sd_option" <?=isCheck($emps['option'],3)?> value="3"/></td><td width="*"><label for="sdo3">rather unsatisfied</label></td>
						<td width="20px"><input id="sdo4" type="radio" name="sd_option" <?=isCheck($emps['option'],4)?> value="4"/></td><td width="*"><label for="sdo4">satisfied enough</label></td>
					</tr>
					<tr height="24px">
						<td width="20px"><input id="sdo5" type="radio" name="sd_option" <?=isCheck($emps['option'],5)?> value="5"/></td><td width="*"><label for="sdo5">very satisfied</label></td>
						<td width="20px"></td><td width="*"></td>
					</tr>
					<tr height="24px">
						<td></td><td colspan="3">with my self, because: <?=iText('sd_reason',$emps['reason'],"margin-left:45px;width:660px")?></td>
					</tr>
				</table>
			</td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
		</table>
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px">
			<tr height="30px"><td colspan="3"><b>I know this school from:</b></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Newspaper")?><td><?=iText('sd_info1',$emps['info1'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Friends/relation")?><td><?=iText('sd_info2',$emps['info2'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Multimedia, ex")?><td><?=iText('sd_info3',$emps['info3'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Family")?><td><?=iText('sd_info4',$emps['info4'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr><td colspan="3" style="border-bottom:1px solid #aeaeae;padding-bottom:10px"><b>EMPLOYMENT APPLICATION</b></td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="20px" valign="top"><td width="20px"><b>A.</b></td><td colspan="2"><b>Check Desired Employment (check all that applies):</b></td></tr>
			<tr><td>&nbsp;</td><td colspan="3">
			<?php
			$empap=dbSFA("*","emp_apos","W/empid='$dcid'");
			$apos=explode("~",$empap['option']);
			$aposi=Array('Playschool Principal/Teacher','Senior High Principal/Teacher','Kindergarten Principal/Teacher','Secretary/Administration','Elementary Principal/Teacher','Part Time Teacher','Junior High Principal/Teacher','Other:');
			?>
				<table id="apospt" cellspacing="0px" cellpadding="0" border="0">
				<?php for($i=0;$i<8;$i+=2){?>
					<tr height="24px">
						<td width="20px"><input id="apos<?=($i+1)?>" type="checkbox" name="apos<?=($i+1)?>" <?=isCheck($apos[$i],1)?> value="1"/></td><td width="225px"><label for="apos<?=($i+1)?>"><?=$aposi[$i]?></label></td>
						<td width="20px"><input id="apos<?=($i+2)?>" type="checkbox" name="apos<?=($i+2)?>" <?=isCheck($apos[$i+1],1)?> value="1"/></td><td width="*"><label for="apos<?=($i+2)?>"><?=$aposi[$i+1]?></label> <?=($i==6)?iText('apos_other',$empap['other'],"width:230px"):""?></td>
					</tr>
				<?php }?>
					<tr height="24px">
						<td colspan="4">Which subjects are you willing and capable to teach (teachers only):</td>
					</tr>
					<tr height="24px">
						<td colspan="4"><?=iText('apos_specific',$empap['specific'],"width:832px")?></td>
					</tr>
				</table>
			</td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>B.</b></td><td colspan="2"><strong>Personal Data</strong></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Name")?><td><?=iText('name',$empp['name'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Gender")?><td><?=iSelect('gender',Array('Male'=>'Male','Female'=>'Female'),$empp['gender'])?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Address")?><td><?=iText('address',$empp['address'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Postcode")?><td><?=iText('postcode',$empp['postcode'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Email")?><td><?=iText('email',$empp['email'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Phone/fax")?><td><?=iText('phonefax',$empp['phonefax'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Birth date and place")?>
				<td><?=inputDate('birthdate',$empp['birthdate'])?> &nbsp;at&nbsp; <?=iText('birthplace',$empp['birthplace'],"width:120px")?></td>
			</tr>
			<tr><td>&nbsp;</td><?=tdLabel("Nationality")?><td><?=iText('nationality',$empp['nationality'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Marital status")?><td>
				<?=iSelect('marital',$mstr_marital,$empp['marital'],"float:left;width:128px")?>
				<?=iAddMstr('marital','marital status')?>
			</td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Religion")?><td>
				<?=iSelect('religion',$mstr_religion,$empp['religion'],"float:left;width:128px")?>
				<?=iAddMstr('religion','religion','religion name')?>
			</td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Name of church")?><td><?=iText('churchname',$empp['churchname'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Address of church")?><td><?=iText('churchaddress',$empp['churchaddress'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Name of Pastor/Priest")?><td><?=iText('pastorname',$empp['pastorname'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Church activities")?><td><?=iText('churchactv',$empp['churchactv'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Hobbies and recreational activities")?><td><?=iText('hobby',$empp['hobby'],"width:680px")?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("International trip")?><td><?=iText('abroad',$empp['abroad'],"width:680px")?></td></tr>
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Family relation","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_family","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_family" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
					if($b<$i){?>
					<tr id="reb_family<?=$b?>" style="display:">
						<td width="615px"><div class="pdiv"><b><?=$mstr_family[$df[$b]['family']]?>: <?=$df[$b]['name']?></b></div>Birth: <?=$df[$b]['birthplace']?>, <?=ftgl($df[$b]['birthdate'])?>. Education: <?=$df[$b]['education']?>. Job: <?=$df[$b]['job']?></td>
						<td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(0,<?=$b?>)"/></div>
						<input type="hidden" name="family_family<?=$b?>" value="<?=$df[$b]['family']?>"/>
						<input type="hidden" name="family_name<?=$b?>" value="<?=$df[$b]['name']?>"/>
						<input type="hidden" name="family_address<?=$b?>" value="<?=$df[$b]['address']?>"/>
						<input type="hidden" name="family_education<?=$b?>" value="<?=$df[$b]['education']?>"/>
						<input type="hidden" name="family_birthplace<?=$b?>" value="<?=$df[$b]['birthplace']?>"/>
						<input type="hidden" name="family_birthdate<?=$b?>" value="<?=$df[$b]['birthdate']?>"/>
						<input type="hidden" name="family_job<?=$b?>" value="<?=$df[$b]['job']?>"/>
						</td>
					</tr>
				<?php } else {?>
					<tr id="reb_family<?=$b?>" style="display:none"></tr>
				<?php }}?>
				</table><input type="hidden" id="ceb_family" value="0"/>
				<div id="aeb_family" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:addEntry('family',0)">Add family relation...</a></div>
			</td></tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>C.</b></td><td colspan="2"><strong>Educational Background</strong></td></tr>
			
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Formal Education","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_education","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_education" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
				if($b<$i){
				$ttile=$df[$b]['title']!=""?"Title: <b>".$df[$b]['title']."</b> ":"";
				$tscore=$df[$b]['score']!=""?"Score: <b>".$df[$b]['score']."</b>.":"";
				?>
					<tr id="reb_education<?=$b?>" style="display:">
						<td width="615px"><div class="pdiv"><b><?=$df[$b]['university']?> (<?=$df[$b]['year']?>)</b></div><?=$ttile?> Field: <b><?=$df[$b]['field']?></b>. <?=$tscore?>
						</td><td align="right"><div class="prefopt" style="width:120px"><input type="button" title="Edit" class="prefedit" onclick="m_status('uf',1)"> <input type="button" title="Remove" class="prefdel" onclick="removeEntry(1,<?=$b?>)"/></div>
						<input type="hidden" name="education_university<?=$b?>" value="<?=$df[$b]['university']?>"/>
						<input type="hidden" name="education_year<?=$b?>" value="<?=$df[$b]['year']?>"/>
						<input type="hidden" name="education_title<?=$b?>" value="<?=$df[$b]['title']?>"/>
						<input type="hidden" name="education_field<?=$b?>" value="<?=$df[$b]['field']?>"/>
						<input type="hidden" name="education_score<?=$b?>" value="<?=$df[$b]['score']?>"/>
						</td>
					</tr>
				<?php } else {?>
					<tr id="reb_education<?=$b?>" style="display:none"></tr>
				<?php } }?>
				</table><input type="hidden" id="ceb_education" value="0"/>
				<div id="aeb_education" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:editEntry('education',0)">Add formal education...</a></div>
			</td></tr>
			
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Courses/Seminars","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_course","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_course" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
				if($b<$i){?>
					<tr id="reb_course<?=$b?>" style="display:">
						<td width="615px"><div class="pdiv"><b>"<?=$df[$b]['title']?>"</b> by <b><?=$df[$b]['organizer'].($df[$b]['certified']=='Y'?" (Certified)":"")?></b></div>
						Place: <b><?=$df[$b]['place']?></b>. on: <b><?=$df[$b]['year']?></b>
						</td><td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(2,<?=$b?>)"/></div>
						<input type="hidden" name="course_title<?=$b?>" value="<?=$df[$b]['title']?>"/>
						<input type="hidden" name="course_organizer<?=$b?>" value="<?=$df[$b]['organizer']?>"/>
						<input type="hidden" name="course_place<?=$b?>" value="<?=$df[$b]['place']?>"/>
						<input type="hidden" name="course_year<?=$b?>" value="<?=$df[$b]['year']?>"/>
						<input type="hidden" name="course_certified<?=$b?>" value="<?=$df[$b]['certified']?>"/>
						</td>
					</tr>
				<?php }else{?>
					<tr id="reb_course<?=$b?>" style="display:none"></tr>
				<?php }}?>
				</table><input type="hidden" id="ceb_course" value="0"/>
				<div id="aeb_course" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:addEntry('course',0)">Add seminar or course...</a></div>
			</td></tr>
			
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Organizations","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_organization","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_organization" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
				if($b<$i){
				$p=strtolower(substr($df[$b]['position'],0,1));
				$q=($p=='a'||$p=='i'||$p=='u'||$p=='e'||$p=='o')?"an":"a";
				?>
					<tr id="reb_organization<?=$b?>" style="display:">
					<td width='615px'><div class='pdiv'>In <b>"<?=$df[$b]['name']?>"</b> as <?=$q?> <b><?=$df[$b]['position']?></b></div>
					on: <b><?=$df[$b]['year']?></b>
					</td><td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(3,<?=$b?>)"/></div>
					<input type="hidden" name="organization_name<?=$b?>" value="<?=$df[$b]['name']?>"/>
					<input type="hidden" name="organization_position<?=$b?>" value="<?=$df[$b]['position']?>"/>
					<input type="hidden" name="organization_year<?=$b?>" value="<?=$df[$b]['year']?>"/>
					</td>
					</tr>
				<?php }else{?>
					<tr id="reb_organization<?=$b?>" style="display:none"></tr>
				<?php }}?>
				</table><input type="hidden" id="ceb_organization" value="0"/>
				<div id="aeb_organization" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:addEntry('organization',0)">Add organization...</a></div>
			</td></tr>
		</table>
		<?php
		$th=dbSel("*","emp_healt","W/empid='$dcid'");
		$emph=dbFAx($th);
		?>
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px">			
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>D.</b></td><td colspan="2"><strong>Health</strong></td></tr><?php $lwidth="250px"; $rwidth="width:580px"; ?>
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("How would you describe your<br/>general health","",$lwidth)?><td><?=iTextarea('hinfo1',$emph['info1'],$rwidth,5)?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("How's your hearing","",$lwidth)?><td><?=iText('hinfo2',$emph['info2'],$rwidth)?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Eyesight","",$lwidth)?><td><?=iText('hinfo3',$emph['info3'],$rwidth)?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("What is your blood type","",$lwidth)?><td><?=iText('hinfo4',$emph['info4'],$rwidth)?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Physical disabilities, or special conditions,<br/>if any","",$lwidth)?><td><?=iText('hinfo5',$emph['info5'],$rwidth)?></td></tr>
			<tr><td>&nbsp;</td><?=tdLabel("Date of last physical examination","",$lwidth)?><td><?=iText('hinfo6',$emph['info6'],$rwidth)?></td></tr>
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Have you ever been hospitalized for more than a month? If yes, please explain the circumstances","",$lwidth)?><td><?=iTextarea('hinfo7',$emph['info7'],$rwidth,5)?></td></tr>
		</table>
		<?php
		$tgi=dbSel("*","emp_ginfo","W/empid='$dcid'");
		$empgi=dbFAx($tgi);
		?>
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px">			
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>E.</b></td><td colspan="2"><strong>General Information</strong></td></tr><?php $rwidth="width:838px";
			$gilbl=Array('','Have you ever applied for any position in this institution:',
			'Do you have any friends or relatives working in this institutions (please specify):',
			'Have you ever taken any work related test? What were they called (list the names/types of the test if known)? When and where were they taken:',
			'Whet level would you like to teach and what level have you thaught (teachers only):',
			'What are your ultimate goals professionally and what are your plans for reaching those goal:',
			'Do you own a house:',
			'Do you own a vehicle (please specify):',
			'Do you play any musical instruments (plase specify):',
			'Do you have a habit of smoking, drinking, drug abuse, or gambling:',
			'Have you ever been arrested, cited, or convicted of any crime? If yes, please describe the circumstances surrounding the crime(s). Indicate the year and place in which the crime occured:',
			'Are you willing to follow all our rules and procedures, icluding our morality, uniform, and Christianity guidelines:',
			'Are you willing to work overtime if required:',
			'When can you start:',
			'Approximate salary expected:');
			for($i=1;$i<count($gilbl);$i++){?>
			<tr><td>&nbsp;</td><td colspan="2"><?=$gilbl[$i]?></td></tr>
				<tr><td>&nbsp;</td><td colspan="2"><?=iText('ginfo'.$i,$empgi['info'.$i],$rwidth)?></td>
			</tr>
			<?Php }?>
		</table>
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px">
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>F.</b></td><td colspan="2"><strong>Job Data</strong></td></tr>
			<tr><td><b>&nbsp;</b></td><td colspan="2"><strong>Check all areas in which you have had training or experience:</strong></td></tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">
				<?php
					$tjd=dbSel("*","emp_jobdata","W/empid='$dcid'");
					$empjd=dbFAx($tjd);
					$job_data=explode("~",$empjd['jobdata']);
				?>
				<table cellspacing="2px" cellpadding="0" width="100%">
					<tr>
						<td width="20px"><input id="jd1" type="checkbox" <?=isCheck($job_data[0],"1")?> name="job_data1" id="job_data1" value="1"/></td><td width="300px"><label for="jd1">Library management</label></td>
						<td width="20px"><input id="jd2" type="checkbox" <?=isCheck($job_data[1],"1")?> name="job_data2" id="job_data2" value="1"/></td><td><label for="jd2">Book keeping</label></td>
					</tr>
					<tr>
						<td width="20px"><input id="jd3" type="checkbox" <?=isCheck($job_data[2],"1")?> name="job_data3" id="job_data3" value="1"/></td><td><label for="jd3">Teaching</label></td>
						<td width="20px"><input id="jd4" type="checkbox" <?=isCheck($job_data[3],"1")?> name="job_data4" id="job_data4" value="1"/></td><td><label for="jd4">Teacher's assistant</label></td>
					</tr>
					<tr>
						<td width="20px"><input id="jd5" type="checkbox" <?=isCheck($job_data[4],"1")?> name="job_data5" id="job_data5" value="1"/></td><td><label for="jd5">Writing and editing</label></td>
						<td width="20px"><input id="jd6" type="checkbox" <?=isCheck($job_data[5],"1")?> name="job_data6" id="job_data6" value="1"/></td><td><label for="jd6">Counseling</label></td>
					</tr>
					<tr>
						<td width="20px"><input id="jd7" type="checkbox" <?=isCheck($job_data[6],"1")?> name="job_data7" id="job_data7" value="1"/></td><td colspan="3"><label for="jd7">Student council</label></td>
					</tr>
					<tr>
						<td width="20px"><input id="jd8" type="checkbox" <?=isCheck($job_data[7],"1")?> name="job_data8" id="job_data8" value="1"/></td><td colspan="3"><label for="jd8">Computer skills (please specify)</label></td>
					</tr>
					<tr>
						<td width="20px">&nbsp;</td><td colspan="3"><input type="text" class="iText" style="width:100%" value="<?=$empjd['computer']?>" name="empjd_computer" id="empjd_computer"/></td>
					</tr>
					<tr>
						<td width="20px"><input id="jd9" type="checkbox" <?=isCheck($job_data[8],"1")?> name="job_data9" id="job_data9" value="1"/></td><td colspan="3"><label for="jd9">Other skills (please specify)</label></td>
					</tr>
					<tr>
						<td width="20px">&nbsp;</td><td colspan="3"><input type="text" class="iText" style="width:100%" value="<?=$empjd['other']?>" name="empjd_other" id="empjd_other"/></td>
					</tr>
				</table>
				</td>
			</tr>
					
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>G.</b></td><td colspan="2"><strong>Employment History (starting with the most recent)</strong></td></tr>
			
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Employment history","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_jobhis","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_jobhis" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
				if($b<$i){
				$p=strtolower(substr($df[$b]['position'],0,1));
				$q=($p=='a'||$p=='i'||$p=='u'||$p=='e'||$p=='o')?"an":"a";
				?>
					<tr id="reb_jobhis<?=$b?>" style="display:">
					<td width="615px"><div class="pdiv">Work at <b><?=$df[$b]['name']?></b> as <?=$q?> <b><?=$df[$b]['position']?></b></div>
					<div class="pdiv">Company address: <b><?=$df[$b]['address']?></b>.</div><div class="pdiv">Period: <b><?=ftgl($df[$b]['date1'])?></b> until <b><?=ftgl($df[$b]['date2'])?></b>. Salary:<b><?=$df[$b]['salary']?></b>.</div>Reason for leaving this job: <i><?=$df[$b]['reason']?></i>
					</td><td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(4,<?=$b?>)"/></div>
					<input type="hidden" name="jobhis_name<?=$b?>" value="<?=$df[$b]['name']?>"/>
					<input type="hidden" name="jobhis_address<?=$b?>" value="<?=$df[$b]['address']?>"/>
					<input type="hidden" name="jobhis_date1<?=$b?>" value="<?=$df[$b]['date1']?>"/>
					<input type="hidden" name="jobhis_date2<?=$b?>" value="<?=$df[$b]['date2']?>"/>
					<input type="hidden" name="jobhis_position<?=$b?>" value="<?=$df[$b]['position']?>"/>
					<input type="hidden" name="jobhis_salary<?=$b?>" value="<?=$df[$b]['salary']?>"/>
					<input type="hidden" name="jobhis_reason<?=$b?>" value="<?=$df[$b]['reason']?>"/>
					</td>
					</tr>
				<?php }else{?>
					<tr id="reb_jobhis<?=$b?>" style="display:none"></tr>
				<?php }}?>
				</table><input type="hidden" id="ceb_jobhis" value="0"/>
				<div id="aeb_jobhis" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:addEntry('jobhis',0)">Add employment history...</a></div>
			</td></tr>
			
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>H.</b></td><td colspan="2"><strong>Character References: professionals (do not list relatives, families, and friends)</strong></td></tr>
			
			<tr valign="top"><td>&nbsp;</td><?=tdLabel("Reference","padding-top:10px")?><td>
			<?php
			$tf=dbSel("*","emp_reference","W/empid='$dcid'");
			$nf=dbNRow($tf);
			$df=Array(); $i=0;
			while($rf=dbFAx($tf)) $df[$i++]=$rf;
			?>
				<table id="teb_reference" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
				<?php for($b=0;$b<10;$b++){
				if($b<$i){?>
					<tr id="reb_reference<?=$b?>" style="display:">
					<td width="615px"><div class="pdiv">Name: <b><?=$df[$b]['name']?></b></div>
						<div class="pdiv">Address <b><?=$df[$b]['address']?></b>. Phone: <b><?=$df[$b]['phone']?></b>.</div>Job: <b><?=$df[$b]['job']?></b>. Know since: <b><?=$df[$b]['know']?></b>. Relation: <b><?=$df[$b]['relation']?></b>
						</td><td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(5,<?=$b?>)"/></div>
						<input type="hidden" name="reference_name<?=$b?>" value="<?=$df[$b]['name']?>"/>
						<input type="hidden" name="reference_address<?=$b?>" value="<?=$df[$b]['address']?>"/>
						<input type="hidden" name="reference_phone<?=$b?>" value="<?=$df[$b]['phone']?>"/>
						<input type="hidden" name="reference_job<?=$b?>" value="<?=$df[$b]['job']?>"/>
						<input type="hidden" name="reference_know<?=$b?>" value="<?=$df[$b]['know']?>"/>
						<input type="hidden" name="reference_relation<?=$b?>" value="<?=$df[$b]['relation']?>"/>
					</td>					
					</tr>
				<?php }else{?>
					<tr id="reb_reference<?=$b?>" style="display:none"></tr>
				<?php }}?>
				</table><input type="hidden" id="ceb_reference" value="0"/>
				<div id="aeb_reference" style="margin:9px 0 15px 0"><a class="linkl11" href="javascript:addEntry('reference',0)">Add reference...</a></div>
			</td></tr>
		</table>
		<?php
		$tia=dbSel("*","emp_ainfo","W/empid='$dcid'");
		$empai=dbFAx($tia);
		?>
		<table class="stable" cellspacing="0" cellpadding="2px" width="875px">
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr height="30px" valign="top"><td width="20px"><b>I.</b></td><td colspan="2"><strong>Additional Information</strong></td></tr><?php $rwidth="width:838px";
			$ailbl=Array('','Are you born again Christian? (If yes mention the approximate date):',
			'Please give us the details of your rebirth and its effects upon your life:',
			'Write your statement of faith:',
			'Write your concepts and opinions regarding the Holy Trinity:',
			'What is your philosophy regarding Christian Education:');
			for($i=1;$i<count($ailbl);$i++){?>
			<tr><td>&nbsp;</td><td colspan="2"><?=$ailbl[$i]?></td></tr>
				<tr><td>&nbsp;</td><td colspan="2"><?=iText('ainfo'.$i,$empai['info'.$i],$rwidth)?></td>
			</tr>
			<?Php }?>
			<!-- Separator Cancel OK button-->
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<tr>
				<td>&nbsp;</td><td colspan="2" style="text-align:justify;padding-right:14px"><!--I have reviewed and fully completed all five pages of this form. I give VITA School permission to verify any and all information I have provided on this form. By my signature, I affirm that all the information I've provided, on all five pages of this form, to be true and correct to the best of my knowledge and beliefs. I understand that by signing this form, I authorize VITA School to obtain information about me (if applicable) form character reference contact, or other applicable sources. I understand that any willful misstatement may lead to disqualification, termitation, or other disciplinary actions.--></td></tr>
			</tr>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <!-- Separator -->
			<?php if(gets('opt')==''){?>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <tr height="30px"><td align="center" colspan="3"><input type="button" class="btn" onclick="jumpTo('<?=RLNK?>employee.php')" value="Cancel" />&nbsp;<input type="submit" class="btnx" id="simpan" value="Save" /></td></tr>
			<?php }else{?>
			<tr><td>&nbsp;</td><td colspan="2"></td></tr> <tr height="30px"><td align="center" colspan="3"><input type="button" class="btn" onclick="jumpTo('<?=RLNK?>employee_view.php?nid=<?=$dcid?>')" value="Back to profile" /></td></tr>
			<?php }?>
		</table>
		<?php if(!empty($_SESSION['joshreditinfo']) && $_SESSION['joshreditinfo']!=''){ ?>
		<div id="notifx" style="text-align:;width:930px;position:absolute;top:0;left:0;padding:6px 4px;font:11px Verdana,Tahoma,Arial;color:#444444;background:#d6edff"><?=$_SESSION['joshreditinfo']?></div>
		<script>
			$("document").ready(function(){
				setTimeout("$('#notifx').animate({ opacity: '0' }, 500)",3000);
			});
		</script>
		<?php $_SESSION['joshreditinfo']='';  }?>
		</div>
