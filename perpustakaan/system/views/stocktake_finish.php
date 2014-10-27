<?php
stocktake_ptrack(4);
$tbl=stocktake_ctable();
$tot=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl));
$ncek=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='Y'"));
$nnocek=$tot-$ncek;
$nwn=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." WHERE cek='N' AND note<>''"));
$nnn=$nnocek-$nwn;

$t=mysql_query("SELECT * FROM pus_stockhist WHERE status='4' LIMIT 0,1");
$r=mysql_fetch_array($t);
$tgl=date("Y-m-d");
mysql_query("UPDATE pus_stockhist SET status='5',nitem='$tot',nceky='$ncek',nnote='$nwn',tanggal2='$tgl' WHERE status='4' LIMIT 1");
?>
<div style="padding:10px">
<div class="infobox" style="width:100%;float:left;margin-top:10px;margin-bottom:20px;margin-left:-2px">
	Proses stock opname telah selesai.
</div>
<div class="sfont" style="width:100%;float:left;margin-bottom:10px">
	<b>Rangkuman proses stock opname:</b>
</div>
<div style="width:100%;float:left">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px"><td width="180px">Total item di database</td><td>: <?=$tot?> item</td></tr>
		<tr height="24px"><td>Item dicek</td><td>: <?=$ncek?> item</td></tr>
		<tr height="24px"><td>Item hilang</td><td>: <?=$nnocek?> item</td></tr>
		<tr height="24px"><td>Item hilang dengan keterangan</td><td>: <?=$nwn?> item</td></tr>
		<tr height="24px"><td>Item hilang tanpa keterangan</td><td>: <?=$nnn?> item</td></tr>
	</table>
</div>
<div style="width:100%;float:left;text-align:left;margin-top:20px">
	<button class="btnz" style="" onclick="stocktake_report(<?=$r['replid']?>)">Buat laporan</button>
</div>
</div>
