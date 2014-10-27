<?php
$target=gpost('t');
$opt=gpost('opt');

if($target=='family'){
// Variables
$mstr_family=MstrGet("mstr_family");
// Form dimension
$fwidth=490; $lwidth=120;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add family relation
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Relation:</td><td><?=iSelect('eb_family',$mstr_family,'',"float:left")?>
			<?=iAddMstrx('eb_family','family relation','family relation')?>
		</td></tr>
		<tr><td width="<?=$lwidth?>px">Name:</td><td><?=iText('eb_name','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Address:</td><td><?=iText('eb_address','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Education:</td><td><?=iText('eb_education','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Birth date & place:</td><td><?=inputDate('eb_birthdate','')?> &nbsp;at&nbsp; <?=iText('eb_birthplace','',"width:100px")?></td></tr>
		<tr><td width="<?=$lwidth?>px">Job:</td><td><?=iText('eb_job','',$iTextFw)?></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_family,eb_name,eb_address,eb_education,eb_birthplace,eb_birthdate,eb_job"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_family)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($target=='education'){
// Variables

// Form dimension
$fwidth=490; $lwidth=160;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add education history
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Name of School:</td><td><?=iText('eb_university','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Year attended:</td><td><?=iText('eb_year','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Degree:</td><td><?=iText('eb_title','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Major:</td><td><?=iText('eb_field','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">GPA:</td><td><?=iText('eb_score','',"width:60px")?></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_university,eb_year,eb_title,eb_field,eb_score"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_education)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($target=='course'){
// Variables

// Form dimension
$fwidth=490; $lwidth=160;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add seminar or course
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Title:</td><td><?=iText('eb_title','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Organizer:</td><td><?=iText('eb_organizer','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Place:</td><td><?=iText('eb_place','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Year:</td><td><?=iText('eb_year','',"width:60px")?></td></tr>
		<tr><td width="<?=$lwidth?>px">Certified:</td><td><label style="padding:0;margin:0"><input style="padding:0;margin:0" type="checkbox" id="eb_certified" name="eb_certified"/> Certified</label></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_title,eb_organizer,eb_place,eb_year,eb_certified"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_course)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php } else if($target=='organization'){
// Variables

// Form dimension
$fwidth=490; $lwidth=160;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add organization
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Name of organization:</td><td><?=iText('eb_name','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Position:</td><td><?=iText('eb_position','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Year:</td><td><?=iText('eb_year','',"width:60px")?></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_name,eb_position,eb_year"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_organization)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php } else if($target=='jobhis'){
// Variables

// Form dimension
$fwidth=490; $lwidth=160;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add employment history
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Name of employer:</td><td><?=iText('eb_name','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Address:</td><td><?=iText('eb_address','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Work from:</td><td><?=inputDate('eb_date1','')?></td></tr>
		<tr><td width="<?=$lwidth?>px">Work to:</td><td><?=inputDate('eb_date2','')?></td></tr>
		<tr><td width="<?=$lwidth?>px">Position:</td><td><?=iText('eb_position','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Monthly salary:</td><td><?=iText('eb_salary','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Reason for leaving:</td><td><?=iText('eb_reason','',$iTextFw)?></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_name,eb_address,eb_date1,eb_date2,eb_position,eb_salary,eb_reason"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_jobhis)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php } else if($target=='reference'){
// Variables

// Form dimension
$fwidth=490; $lwidth=160;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:220px">
<div class="fformbox2" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:13px">
		Add character reference
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td width="<?=$lwidth?>px">Name:</td><td><?=iText('eb_name','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Phone:</td><td><?=iText('eb_phone','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Address:</td><td><?=iText('eb_address','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Occupation:</td><td><?=iText('eb_job','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Year known:</td><td><?=iText('eb_know','',$iTextFw)?></td></tr>
		<tr><td width="<?=$lwidth?>px">Relation:</td><td><?=iText('eb_relation','',$iTextFw)?></td></tr>
		</table>
		<input type="hidden" id="eb_inparray" value="eb_name,eb_address,eb_phone,eb_job,eb_know,eb_relation"/>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform2()" value="Cancel"/>
				<input type="button" class="btn" onclick="saveEntry(feb_reference)" value="  Add  "/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
?>