<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

stocktake_ptrack(1);

$tbl=stocktake_ctable();
$a=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));
$b=mysql_num_rows(mysql_query("SELECT * FROM pus_buku"));
$p=intval($a*400/$b);
$c=intval($a*100/$b);
?>
<div class="sfont" style="float:left;width:100%;margin-bottom:6px">Mempersiakan data base...</div>
<div style="float:left;width:100%">
<table cellspacing="0" cellpadding="0" border="0"><tr>
<td>
	<div id="pbar0" style="width:400px;height:9px;border:1px solid #008ee8;border-radius:3px">
		<div id="pbar1" style="width:<?=$p?>px;height:9px;background:#008ee8">
		</div>
	</div>
</td>
<td style="padding-left:6px">
	<div id="pbarp" class="sfont"><?=$c?>%</div>
</td>
</table>
</div>