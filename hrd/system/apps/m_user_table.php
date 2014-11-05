<?php
$t=dbSel("*","mstr_user","O/ dcid");
$k=1;
$n=dbNRow($t);
while($r=dbFA($t)){?>
<tr><td width="26px">
	<?php if($r['level']!='admin'){?><img src="<?=IMGR?>staff.png" title="Staff"/><?php } else { ?><img src="<?=IMGR?>admin.png" title="Admin"/><?php }?>
	</td><td width="400px"><b><?=$r['alias']?><?=(($r['level']=='admin')?" (Admin)":"")?></b>
		<?php if($_SESSION['joshr']==$r['name']) echo " (current user)";?>
	</td><td align="right">
	<div class="prefopt">
	<input type="button" title="Edit" class="prefedit" onclick="m_user('uf',false,<?=$r['dcid']?>)"/> &nbsp;
	<?php if($r['dcid']!=1){?><input type="button" title="Delete" class="prefdel" onclick="m_user('df',false,<?=$r['dcid']?>)"/><?php } else {?>
	<input type="button" title="This user can not be deleted" class="preflock"/>
	<?php }?>
	</div>
	</td>
</tr>
<?php $k++; } ?>