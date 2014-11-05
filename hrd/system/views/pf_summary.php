<table cellspacing="5px" cellpadding="0">
	<tr><td>
		<?php
		if(intval($r['status'])<2) $ls="";
		else {
			$cs=EmpGetCStatus($r['dcid']);
			$dd=diffDay($cs['date2']);
			$dr=MstrGetReminder("status",$cs['status']);
			$dc=($dd<=$dr)?";color:#ff0000;font-weight:bold":"";
			$ls="<div style=\"color:#646464;padding-top:4px;font:10px Verdana,Tahoma".$dc."\">Ends at: ".fstgl($cs['date2'])."</span></div>";
		}
		?>
		<button id="xsumfbtn1" class="pfnice" style="position:relative;overflow:hidden" onclick="switch_tab(0);E('pfb_0').scrollIntoView(true);pf_status('af')" <?=(($r['status']==0)?"title=\"".$r['fname']." is currently have no status. Click to add status.\"":"")?>>
			<div id="sumfbtn1" style="width:170px;height:45px;position:absolute;top:<?=(($r['status']==0)?"-45":"0")?>px">
				<table cellspacing="0" cellpadding="0"><tr height="45px"><td style="padding-left:6px">
					<table class="stable" cellspacing="0" cellpadding="0"><tr <?=(($r['status']=='1')?"":"valign=\"top\"")?>>
					<td width="24px"><img src="<?=IMGR?>iuser.png" style="margin-top:2px"/></td>
					<td id="sumf0"><span style="color:#008000"><b><?=$mstr_status[$r['status']]?></b></span><?=$ls?></td>
					</tr></table>
				</td></tr></table>
				<center>
				<table cellspacing="0" cellpadding="0"><tr height="45px">
				<td><img src="<?=IMGR?>sumplus.png"/></td><td>&nbsp;<span style="color:#00c000;font:bold 11px Verdana,Tahoma">Add Status</span></td>
				</tr></table>
				</center>
			</div>
		</button>
	</td></tr>
	<tr id="rsumfbtn2"><td>
		<?php
		$hc=EmpCountDayoff($r['dcid']);
		$mc=EmpGetMaxDayoff($r['division']);
		if($mc!="E") $sc=$mc-$hc;
		?>
		<button id="xsumfbtn2" class="pfnice" style="position:relative;overflow:hidden" onclick="switch_tab(1);E('pfb_1').scrollIntoView(true);addCuti()">
			<div id="sumfbtn2" style="width:170px;height:45px;position:absolute;top:0px">
				<table cellspacing="0" cellpadding="0"><tr height="45px"><td style="padding-left:6px">
					<table class="stable" cellspacing="0" cellpadding="0"><tr valign="top">
					<td width="24px"><img src="<?=IMGR?>calblu.png" style="margin-top:2px"/></td>
					<td id="sumf1">Day off: <span style="color:#008000"><b><?=$hc?> day<?=($hc>1?"s":"")?></b></span><?php if($mc!="E"){?><div style="padding-top:4px;font:10px Verdana,Tahoma">remaining: <span <?=(($sc<0)?"style=\"color:#ff0000\"":"")?>><?=$sc?> day<?=($sc>1?"s":"")?></span></div><?php }?></td>
					</tr></table>
				</td></tr></table>
				<center>
				<table cellspacing="0" cellpadding="0"><tr height="45px">
				<td><img src="<?=IMGR?>sumplus.png"/></td><td>&nbsp;<span style="color:#00c000;font:bold 11px Verdana,Tahoma">Add Day off</span></td>
				</tr></table>
				</center>
			</div>
		</button>
	</td></tr>
	<tr><td>
		<?php
			$ntrn=dbSRow("emp_training","W/empid='".$r['dcid']."'");
		?>
		<button id="xsumfbtn3" class="pfnice" style="position:relative;overflow:hidden" onclick="switch_tab(2);E('pfb_2').scrollIntoView(true);;pf_train('af')">
			<div id="sumfbtn3" style="width:170px;height:45px;position:absolute;top:0px">
				<table cellspacing="0" cellpadding="0"><tr height="45px"><td style="padding-left:6px">
					<table class="stable" cellspacing="0" cellpadding="0"><tr>
					<td width="24px"><img src="<?=IMGR?>rdoc.png"/></td>
					<td id="sumf2"><b><?=$ntrn?> Training<?=($ntrn>1?"s":"")?></b></td>
					</tr></table>
				</td></tr></table>
				<center>
				<table cellspacing="0" cellpadding="0"><tr height="45px">
				<td><img src="<?=IMGR?>sumplus.png"/></td><td>&nbsp;<span style="color:#00c000;font:bold 11px Verdana,Tahoma">Add Training</span></td>
				</tr></table>
				</center>
			</div>
		</button>
	</td></tr>
	<tr><td>
		<?php
			$nrwrd=dbSRow("emp_reward","W/empid='".$r['dcid']."'");
		?>
		<button id="xsumfbtn4" class="pfnice" style="position:relative;overflow:hidden" onclick="switch_tab(4);E('pfb_4').scrollIntoView(true);pf_reward('af')">
			<div id="sumfbtn4" style="width:170px;height:45px;position:absolute;top:0px">
				<table cellspacing="0" cellpadding="0"><tr height="45px"><td style="padding-left:6px">
					<table class="stable" cellspacing="0" cellpadding="0"><tr>
					<td width="24px"><img src="<?=IMGR?>star.png"/></td>
					<td id="sumf3"><b><?=$nrwrd?> Reward<?=(($nrwrd>1)?"s":"")?></b></td>
					</tr></table>
				</td></tr></table>
				<center>
				<table cellspacing="0" cellpadding="0"><tr height="45px">
				<td><img src="<?=IMGR?>sumstar.png"/></td><td>&nbsp;<span style="color:#00c000;font:bold 11px Verdana,Tahoma">Give Reward</span></td>
				</tr></table>
				</center>
			</div>
		</button>
	</td></tr>
</table>
<input type="hidden" id="pfflag" value="<?=$r['status']?>" />
<script type="text/javascript" language="javascript">
	$("#xsumfbtn1").mouseenter(function(){
	  if(E('pfflag').value!='0'){
		$("#sumfbtn1").animate({"top": "-45px"}, { queue: false, duration: 60 });
	  }
	}).mouseleave(function(){
	  if(E('pfflag').value!='0'){
		$("#sumfbtn1").animate({"top": "0px"}, { queue: false, duration: 60 });
	  }
	});
	$("#xsumfbtn2").mouseenter(function(){
	  $("#sumfbtn2").animate({"top": "-45px"}, { queue: false, duration: 60 });
	}).mouseleave(function(){
	  $("#sumfbtn2").animate({"top": "0px"}, { queue: false, duration: 60 });
	});
	$("#xsumfbtn3").mouseenter(function(){
	  $("#sumfbtn3").animate({"top": "-45px"}, { queue: false, duration: 60 });
	}).mouseleave(function(){
	  $("#sumfbtn3").animate({"top": "0px"}, { queue: false, duration: 60 });
	});
	$("#xsumfbtn4").mouseenter(function(){
	  $("#sumfbtn4").animate({"top": "-45px"}, { queue: false, duration: 60 });
	}).mouseleave(function(){
	  $("#sumfbtn4").animate({"top": "0px"}, { queue: false, duration: 60 });
	});
</script>