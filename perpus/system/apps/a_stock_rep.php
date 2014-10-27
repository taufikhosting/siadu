<?php
$opt=gpost('opt');
$cid=gpost('cid');
$ntable=gpost('lst');

if($opt=='nf'){
require_once(MODDIR.'control.php');

// Query
$r=dbSFA("*",$ntable,"W/dcid='$cid' LIMIT 0,1");
$y=mysql_query("SELECT * FROM catalog WHERE dcid='".$r['catalog']."' LIMIT 0,1");
$f=mysql_fetch_array($y);
$y1=mysql_query("SELECT * FROM book WHERE barcode='".$r['barcode']."' LIMIT 0,1");
$f1=mysql_fetch_array($y1);
// Form dimension
$fwidth=400; $lwidth=120;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
<div id="fformbox" class="fformbox" style="margin-top:-100px;width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		Finish Stock Take
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td><span style="font-size:15px">"<?=$f['title']?>"</span></td></tr>
		<tr><td>Author: <b><?=dbFetch("name","mstr_author","W/dcid='".$f['author']."'")?></b></td></tr>
		<tr><td>Barcode: <b><?=$r['barcode']?></b></td></tr>
		<tr><td>Call number: <b><?=$f1['callnumber']?></b></td></tr>
		<tr><td style="padding-top:10px">Note:</td></tr>
		<tr><td><?=iTextArea("note",$r['note'],"width:390px",6)?></td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="Cancel"/>
				<input type="button" class="btn" onclick="doAddNote(<?=$r['dcid']?>)" style="width:50px" value="OK"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php }
else if($opt=='finish'){
	$cid=dbFetch("dcid","so_history","W/status='4'");
	if(dbUpdate("so_history",Array('status'=>5,'date2'=>date("Y-m-d")),"dcid='".$cid."'")){
	dbUpdate("mstr_setting",Array('val'=>'N'),"dcid=3");
	$fwidth=400; $lwidth=120;
	$iTextFw="width:".($fwidth-$lwidth-16)."px";
	?>
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
	<div id="fformbox" class="fformbox" style="margin-top:0px;width:<?=($fwidth+20)?>px;overflow:hidden">
		<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
			Current stock take has finished.
		</div>
	</div>
	</td></tr></table>
	<?php }
} else if($opt=='dn'){
$fwidth=400; $lwidth=120;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:220px">
<div id="fformbox" class="fformbox" style="margin-top:0px;width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		Finish Stock Opname
	</div>
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td>Finish current stock take proceess?</td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=($fwidth-1)?>px" style="margin:20px 0 12px 0"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" style="width:50px" value="No"/>
				<input type="button" class="btn" onclick="doFinishStock()" style="width:50px" value="Yes"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>
<?php
}
?>