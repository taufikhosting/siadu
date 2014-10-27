<?php require_once(MODDIR.'control.php'); ?>
<table cellspacing="0" cellpadding="0">
<tr height="30px">
	<td class="sfont" width="100px">Judul:</td>
	<td><?=iText('cetak_judul',setting_getnilai('labelt'),'width:300px','','readonly')?></td>
</tr>
<tr height="30px">
	<td class="sfont" width="100px">Deskripsi:</td>
	<td><?=iText('cetak_deskripsi',setting_getnilai('labeld'),'width:300px','','readonly')?></td>
</tr>
<tr height="30px">
	<td class="sfont" width="100px"></td>
	<td><button class="btn" style="float:left" onclick="tools_label_form('uf',1)"><div class="bi_edit">Edit</div></button></td>
</tr>
</table>