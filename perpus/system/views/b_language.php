<?php
$t=dbSel("*","mstr_language","O/ urut");
$k=1;
$n=dbNRow($t);
while($r=dbFA($t)){?>
<tr><td width="380px"><?=$r['name']?> (<?=$r['code']?>)</td><td align="right">
	<div class="prefopt">
	<?php if($k!=1) {?><input type="button" title="Move up" class="prefup" onclick="b_language('up',<?=$r['dcid']?>)"/> &nbsp;<?php } ?>
	<?php if($k!=$n) {?><input type="button" title="Move down" class="prefdn" onclick="b_language('dn',<?=$r['dcid']?>)"/><?php } else {?><button style="width:15px;height:15px;border:none;background:none"></button><?php } ?> &nbsp;
	<input type="button" title="Edit" class="prefedit" onclick="b_language('uf',<?=$r['dcid']?>)"/> &nbsp;
	<input type="button" title="Delete" class="prefdel" onclick="b_language('df',<?=$r['dcid']?>)"/>
	</div>
	</td>
</tr>
<?php $k++; } ?>