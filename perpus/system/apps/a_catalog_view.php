<?php
$opt=gpost('opt');
$cid=gpost('cid');

if($opt=='df'){
require_once(MODDIR.'control.php');

// Query
$r=dbSFA("nid","book","W/dcid='$cid'");

// Form dimension
$fwidth=400; $lwidth=120;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		Delete book
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td>Are you sure want to delete book number "<b><?=$r['nid']?></b>"?</td></tr>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btn" onclick="doDel(<?=$cid?>)" value="Delete"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($opt=='d'){
	dbDel("book","dcid='$cid'");
	require_once(VWDIR.'v_catalog_view.php');
}
?>