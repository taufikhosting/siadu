<?php
require_once(MODDIR.'control.php');
$fmod='marital';
$xtable = new xtable($fmod,'status pernikahan pegawai');
?><div class="tbltopbar" style="width:100%"><?php notifbox(); $xtable->btnbar_add(); ?></div><?php
// Query golongan >>
$t=mysql_query("SELECT * FROM hrd_m_".$fmod." ORDER BY ".$fmod);
$xtable->ndata=mysql_num_rows($t);
if($xtable->ndata>0){
$xtable->head('Status pernikahan','keterangan');
$x=$xtable->frow_color();
while($r=mysql_fetch_array($t)){ $xtable->frow_change($x); ?>
	<tr class="xtr<?=$x?>"><?php
		$xtable->td($r[$fmod],200);
		$xtable->td($r['keterangan']);
		$xtable->opt_ud($r['replid']);
	?></tr>
<?php }?>
</table>
<?php }else $xtable->nodata(); ?>