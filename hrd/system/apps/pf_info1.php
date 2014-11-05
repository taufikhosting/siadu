<?php
// Default Post Variables
$opt=gpost('opt');
$dcid=gpost('dcid'); if($dcid=='') $dcid=0;
$cid=gpost('cid'); if($cid=='') $cid=0;
$fname=gpost('fname');

// Form Title
if($opt=='af') $mtitle="Add new employe status for ".$fname;
else if($opt=='uf') $mtitle="Edit ".$fname."'s employe status";
else $mtitle="Delete ".$fname."'s employe status";
// Function Module 
$fmod="pf_info1";
// db Table
$dbtable="employee";

// Global Variables
$mstr_level=MstrGet("mstr_level");
$mstr_division=MstrGet("mstr_division");
$mstr_group=MstrGet("mstr_group");
$mstr_position=MstrGet("mstr_position");

if($opt=='a'||$opt=='u'||$opt=='d'||$opt=='up'||$opt=='dn'){
	// Post Variables
	$inp=Array();
	$inp['nip']=gpost('nip');
	$inp['level']=gpost('level');
	$inp['division']=gpost('division');
	$inp['group']=gpost('group');
	$inp['position']=gpost('position');
	if($opt=='a'){
		$t=dbUpdate($dbtable,Array('active'=>'N'),"empid='$dcid'");
		dbInsert($dbtable,Array('empid'=>$dcid,'status'=>$status,'date1'=>$date1,'date2'=>$date2,'position'=>$position));
		dbUpdate("employee",Array('status'=>$status),"dcid='$dcid'");
	}
	else if($opt=='u'){
		dbUpdate($dbtable,$inp,"dcid='$cid'");
	}
	else if($opt=='d'){
		if($active=='Y'){
			dbUpdate("employee",Array('status'=>0),"dcid='$dcid'");
		}
		dbDel($dbtable,"dcid='$cid'");
	}
	$t=dbSel("*","employee","W/dcid='$dcid' LIMIT 0,1");
	$r=dbFA($t);
	require_once(VWDIR.$fmod.'.php');
} else {
	$sx=str_replace('f','',$opt); $nobtn="Cancel";
	// Form dimension
	$fwidth=330; $lwidth=100;
	$iTextFw="width:".($fwidth-$lwidth-30)."px";
	// Preprocessing form
	if($opt=='uf'||$opt=='df'){
		$r=dbSFA("*",$dbtable,"W/dcid='$cid'");
		$date1=$r['date1']; $date2=$r['date2'];
	} else {
		$date1=date("Y-m-d"); $date2=date("Y-m-d");
	}
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:<?=($fwidth+30)?>px;overflow:hidden">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><?=$mtitle?><br/></b>
		</div>
		<div style="text-align:left;padding:15px 15px;width:<?=$fwidth?>px">
			<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<?php if($opt=='af' || $opt=='uf'){ $okbtn = ($opt=='af')?"Save":"OK"; $gd='true';
			// Add or Edit form ?>
			<tr><td>NIP:</td><td><?=iText('nip',$r['nip'],$iTextFw)?></td></tr>
			<tr><td width="<?=$lwidth?>px">Level:</td>
				<td><?=iSelect('level',$mstr_level,$r['level'],"width:175px;float:left")?><?=iAddMstrx2('level','level','level name')?></td>
			</tr>
			<tr><td width="<?=$lwidth?>px">Division:</td>
				<td><?=iSelect('division',$mstr_division,$r['division'],"width:175px;float:left")?><?=iAddMstrx2('division','division','division name')?></td>
			</tr>
			<tr><td width="<?=$lwidth?>px">Group:</td>
				<td><?=iSelect('group',$mstr_group,$r['group'],"width:175px;float:left")?><?=iAddMstrx2('group','group','group name')?></td>
			</tr>
			<tr><td width="<?=$lwidth?>px">Position:</td>
				<td><?=iSelect('position',$mstr_position,$r['position'],"width:175px;float:left")?><?=iAddMstrx2('position','position','position name')?></td>
			</tr>
		<?php } else if($opt=='df'){ $okbtn = "Yes"; $nobtn="   No   "; $gd='false';
			// Delete form ?>
			<tr><td><p class="line150">Are you sure you want to delete "<b><?=$mstr_status[$r['status']]?></b>" in period <?=ftgl($r['date1'])." to ".ftgl($r['date2'])?>?<?php if($r['active']=='Y'){?> This status is <span style="color:#008000"><b>active</b></span>. If it deleted, status of <?=$fname?> will set to "No Status".<?php }?></p></td></tr>
		<?php }?>
			</table>
			<input type="hidden" id="active" name="active" value="<?=$r['active']?>"/>
			<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:30px"><tr>
				<td align="center">
					<input type="button" class="btn" onclick="close_fform()" value="<?=$nobtn?>"/>
					<input type="button" class="btnx" value="<?=$okbtn?>" onclick="<?=$fmod?>('<?=$sx?>',<?=$cid?>,<?=$gd?>)"/>
				</td>
			</tr></table>
		</div>
	</div>
	</td></tr></table>
<?php 
} ?>