<?php
$mstr_status=MstrGet("mstr_status");
$mstr_level=MstrGet("mstr_level");
$mstr_division=MstrGet("mstr_division");
$mstr_group=MstrGet("mstr_group");
$mstr_position=MstrGet("mstr_position");
?>
<div style="color:#444444;font:bold 11px Verdana,Tahoma;padding-bottom:5px">Employee Data</div>
<table class="pf_table" cellspacing="5px" cellpadding="0">
	<tr><td width="140px">NIP</td><td>: <?=$r['nip']?></td></tr>
	<tr><td width="140px">Level</td><td>: <?=$mstr_level[$r['level']]?></td></tr>
	<tr><td width="140px">Division</td><td>: <?=$mstr_division[$r['division']]?></td></tr>
	<tr><td width="140px">Group</td><td>: <?=$mstr_group[$r['group']]?></td></tr>
	<tr><td width="140px">Position</td><td>: <?=$mstr_position[$r['position']]?></td></tr>
</table>
<button id="eipf1" class="btn" title="Edit employee data" style="display:none;position:absolute;top:-1px;right:-1px" onclick="pf_info1('uf',<?=$r['dcid']?>)">
	<div style="background:url('<?=IMGR?>bi_pencil.png') no-repeat;padding-left:16px">Edit</div>
</button>