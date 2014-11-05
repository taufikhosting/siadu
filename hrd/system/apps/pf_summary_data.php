<?php // 1:: 
if(intval($r['status'])<2) $ls="";
else {
	$cs=EmpGetCStatus($r['dcid']);
	$dd=diffDay($cs['date2']);
	$dr=MstrGetReminder("status",$cs['status']);
	$dc=($dd<=$dr)?";color:#ff0000;font-weight:bold":"";
	$ls="<div style=\"color:#646464;padding-top:4px;font:10px Verdana,Tahoma".$dc."\">Ends at: ".fstgl($cs['date2'])."</span></div>";
}
?>
<span style="color:#008000"><b><?=$mstr_status[$r['status']]?></b></span><?=$ls?>~
<?php // 2::
$hc=EmpCountDayoff($r['dcid']);
$mc=EmpGetMaxDayoff($r['division']);
if($mc!="E") $sc=$mc-$hc;
?>
Cuti: <span style="color:#008000"><b><?=$hc?> Hari</b></span>
<?php if($mc!="E"){?><div style="padding-top:4px;font:10px Verdana,Tahoma">Sisa cuti: <span <?=(($sc<0)?"style=\"color:#ff0000\"":"")?>><?=$sc?> Hari</span><?php }?></div>~
<?php // 3::
$ntrn=dbSRow("emp_training","W/empid='".$r['dcid']."'");
?>
<b><?=$ntrn?> Training<?=($ntrn>1?"s":"")?></b>~
<?php // 4::
$nrwrd=dbSRow("emp_reward","W/empid='".$r['dcid']."'");
?>
<b><?=$nrwrd?> Reward<?=($nrwrd>1?"s":"")?></b>~<?=$r['status']?>