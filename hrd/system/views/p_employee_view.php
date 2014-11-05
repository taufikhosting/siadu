<?php
/** Global Variables */
$mstr_status=MstrGet("mstr_status");
$mstr_level=MstrGet("mstr_level");
$mstr_group=MstrGet("mstr_group");
$mstr_division=MstrGet("mstr_division");
$mstr_traintype=MstrGet("mstr_traintype");

/* Pre Data Processing */
$dcid=gets('nid');

// Queries:
$t=dbSel("*","employee","W/dcid='$dcid' LIMIT 0,1");
$ndata=mysql_num_rows($t);

?>
<table cellspacing="0" cellpadding="0" width="940px" style="margin-bottom:2px"><tr height="30px">
<td>
	<div class="sfont">
		<button class="btn" onclick="jumpTo('<?=RLNK?>employee.php')" style="margin-right:6px">
			<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px;padding-right:4px">Back</div>
		</button><button class="btn" onclick="jumpTo('<?=RLNK?>employee_edit.php?nid=<?=$dcid?>')" style="margin-right:20px">
			<div style="background:url('<?=IMGR?>bi_pencil.png') no-repeat;padding-left:16px;padding-right:4px">Edit profile</div>
		</button>
	</div>
</td>
</tr></table>
<?php if($ndata>0){
	$r=dbFA($t);
?>
	<input type="hidden" id="empid" value="<?=$r['dcid']?>"/>
	<input type="hidden" id="empfname" value="<?=$r['fname']?>"/>
	<div class="pf_name">
	<span style="font:bold 28px 'Segoe UI','Cambria', 'Trebuchet MS',Verdana,Tahoma;color:#0070d8;text-shadow: 1px 2px rgba(0,0,0,0.25);"><i><?=$r['name']?></i></span>
	</div>
	<div class="pf_box">
	<table class="stable" cellspacing="0" cellpadding="0" width="918">
		<tr valign="top" height="300px">
			<td style="padding-left:5px">
				<div id="tpf_info1" class="ipfbox" onmouseover="E('eipf1').style.display=''" onmouseout="E('eipf1').style.display='none'">
					<?php require_once(VWDIR.'pf_info1.php');?>
				</div>
				<span style="color:#444444;font:bold 11px Verdana,Tahoma">Personal Information</span>
				<div id="pf_less" style="display:">
				<table class="pf_table" cellspacing="5px" cellpadding="0">
					<tr><td width="140px">Address</td><td>: <?=$r['address']?></td></tr>
					<tr><td>Phone/fax</td><td>: <?=$r['phonefax']?></td></tr>
					<tr><td>Email</td><td>: <?=$r['email']?></td></tr>
					<tr><td>Birth place and date</td><td>: <?=$r['birthplace']?>. <?=fftgl($r['birthdate'])?></td></tr>
				</table>
				<div style="padding-left:5px;margin-top:15px">
					<a id="pf_smore" class="linkl11" href="javascript:void(0)" onclick="jumpTo('<?=RLNK?>employee_edit.php?nid=<?=$r['dcid']?>&opt=show')">Show advanced information...</a>
				</div>
			</td>
			<td align="right" width="180px">
				<div id="tpf_summary" style="padding-top:10px">
					<?php require_once(VWDIR.'pf_summary.php');?>
				</div>
			</td>
			<td width="165px" align="center" style="padding-top:10px">
				<?php 
				$np=dbSRow("emp_photo","W/empid='".$r['dcid']."'");
				if($np>0){ ?>
					<div id="pf_photo"><img src="<?=RLNK?>photo.php?id=<?=$r['dcid']?>"/></div><br/>
					<button id="pfp_btn" class="btn" onclick="open_uform()">
						<div id="pfp_lbl" style="background:url('<?=IMGR?>bi_photo.png') no-repeat;padding-left:16px">Change profile picture</div>
					</button><br/>
				<?php } else {?>
					<div id="pf_photo"><img src="<?=IMGR?>nophoto.png"/></div><br/>
					<button id="pfp_btn" class="btn" onclick="open_uform()">
						<div id="pfp_lbl" style="background:url('<?=IMGR?>bi_photo.png') no-repeat;padding-left:16px">Add profile picture</div>
					</button><br/>
				<?php } ?>
			</td>
		</tr>
	</table>
	</div>
	<br/>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>
			<table cellspacing="0" cellpadding="0"><tr><?php $pfb=0;?>
				<td><button id="pft_<?=$pfb?>" class="pf_tab1" onclick="switch_tab(<?=($pfb++)?>)">Status</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Day off</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Training</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Document</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Education</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Family</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">Reward</button></td>
				<td><button id="pft_<?=$pfb?>" class="pf_tab" onclick="switch_tab(<?=($pfb++)?>)">File</button></td>
			</tr></table>
			</td>
		</tr>
		<tr><td><?php $pfb=0;?>
			<!-- Status -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:">
				<div id="tpf_status">
				<?php require_once(VWDIR.'pf_status.php');?>
				</div>
				<button id="addStatBtn" class="btn" onclick="pf_status('af')" style="margin-top:10px">Add new status</button>
			</div>
			<!-- Cuti -->
			<input type="hidden" id="cutibox" value="pfb_<?=$pfb?>"/>
			<input type="hidden" id="cmonth" value="<?=date("m")?>"/>
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_dayoff">
				<?php $cmonth = date("m"); require_once(VWDIR.'pf_dayoff.php');?>
				</div>
			</div>
			<!-- Training -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_train">
				<?php require_once(VWDIR.'pf_train.php');?>
				</div>
				<button id="addStatBtn" class="btn" onclick="pf_train('af')" style="margin-top:10px">Add new training</button>
			</div>
			<!-- Document -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_document">
				<?php require_once(VWDIR.'pf_document.php');?>
				</div>
				<button id="addStatBtn" class="btn" onclick="pf_document('af')" style="margin-top:10px">Add new document</button>
			</div>
			<!-- Education -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_education">
				<?php require_once(VWDIR.'pf_education.php');?>
				</div>
				<button id="addStatBtn" class="btn" onclick="pf_education('af')" style="margin-top:10px">Add new education</button>
			</div>
			<!-- Family -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_family">
				<?php require_once(VWDIR.'pf_family.php');?>
				</div>
				<button id="addStatBtn" class="btn" onclick="pf_family('af')" style="margin-top:10px">Add new family</button>
			</div>
			<!-- Reward -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_reward">
				<?php require_once(VWDIR.'pf_reward.php');?>
				</div>
				<button class="btn" title="Show all employee" onclick="pf_reward('af')" style="margin-right:20px;margin-top:10px">
					<div style="background:url('<?=IMGR?>bi_star.png') no-repeat;padding-left:16px">Give reward</div>
				</button>
			</div>
			<!-- Files -->
			<div id="pfb_<?=($pfb++)?>" class="pf_pbox" style="display:none">
				<div id="tpf_files">
				<?php require_once(VWDIR.'pf_files.php');?>
				</div>				
				<button class="btn" onclick="pf_files('af')" style="margin-right:20px;margin-top:10px">
					<div style="background:url('<?=IMGR?>bi_filep.png') no-repeat;padding-left:16px">Add file</div>
				</button>
			</div>
			<input type="hidden" id="pfbnum" value="<?=$pfb?>" />
		</td></tr>
	</table>
<?php }
?>