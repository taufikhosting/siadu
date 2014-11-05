<?php
// Stats
$loan_limit=intval(dbFetch("val","mstr_setting","W/dcid=5"));
$nloan=mysql_num_rows(mysql_query("SELECT * FROM loan WHERE member='$nid' AND status='1'"));
$nlate=mysql_num_rows(mysql_query("SELECT * FROM loan WHERE member='$nid' AND status='2'"));
$intime=mysql_num_rows(mysql_query("SELECT * FROM loan WHERE member='$nid' AND status='0'"));
$fine=0.0;
$tfine=mysql_query("SELECT fine FROM loan WHERE member='$nid' AND status!='1'");
while($rf=mysql_fetch_array($tfine)){
$fine+=$rf['fine'];
}
?>
<table class="stable" cellspacing="0" cellpadding="2px" width="" style="margin-top:0px" border="0">
<tr valign="top">
	<td width="80px" style="padding-top:10px" rowspan="5">
		<?php 
		$np=mysql_num_rows(mysql_query("SELECT * FROM ".DB_HRD_PHOTO." WHERE empid='".$f['dcid']."'"));
		if($np>0){ ?>
			<div id="pf_photo"><img src="<?=HRD_RLNK?>photo.php?id=<?=$f['dcid']?>" width="60px"/></div><br/>
		<?php } else {?>
			<div id="pf_photo"><img src="<?=HRD_IMGR?>nophoto.png" width="60px"/></div><br/>
		<?php } ?>
	</td>
	<td colspan="4">
		<div style="font-size:15px;margin-top:4px"><b><?=$f['name']?></b></div>
	</td>
</tr>
<tr>
	<td width="100px">
		NIP
	</td>
	<td>
		: <?=$f['nip']?>
	</td>
	<td width="120px" style="padding-left:20px">
		Total book in loan
	</td>
	<td>
		: <span style="color:<?=($nloan<$loan_limit?'#008000':'#ff0000')?>"><?=$nloan." book".($nloan>1?"s":"")?></span>
	</td>
</tr>
<tr>
	<td>
		Member type
	</td>
	<td>
		: Staff
	</td>
	<td style="padding-left:20px">
		Loan limit
	</td>
	<td>
		: <?=$loan_limit." book".($loan_limit>1?"s":"")?>
	</td>
</tr>
<tr>
	<td>
		Address
	</td>
	<td>
		: <?=$f['address']?>
	</td>
	<td style="padding-left:20px">
		Total fine
	</td>
	<td>
		: Rp <?=number_format($fine,2,',','.')?>
	</td>
</tr>
<tr height="40px" valign="top">
	<td>		
		Phone
	</td>
	<td>		
		: <?=$f['phonefax']?>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>