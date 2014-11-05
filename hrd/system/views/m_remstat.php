<?php
$t=dbSel("*","mstr_status","O/ urut");
while($r=dbFA($t)){if($r['dcid']!=1){?>
<tr><td width="300px">
	<table class="prefsfont" cellspacing="0" width="300px"><tr>
	<td width="200px"><?=$r['name']?></td>
	<td align="right"><?=$r['reminder']?> day<?=(($r['reminder']>1)?"s":"")?></td>
	</tr></table>
</td></tr>
<?php }} ?>