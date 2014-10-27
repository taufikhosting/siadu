<?php
$t=dbSel("*","mstr_document","O/ urut");
if(dbNRow($t)>0){?>
<div class="pfsub">Document reminder</div>
<table class="preftbl2" cellspacing="1px" cellpadding="8px">
<?php while($r=dbFA($t)){?>
<tr><td width="300px">
	<table class="prefsfont" cellspacing="0" width="300px"><tr>
	<td width="200px"><?=$r['name']?></td>
	<td align="right"><?=$r['reminder']?> day<?=(($r['reminder']>1)?"s":"")?></td>
	</tr></table>
</td></tr>
<?php } ?>
</table>
<button class="btn" onclick="m_remdoc('uf')" style="margin:10px 0 0 20px">Set document reminders...</button>
<?php }?>