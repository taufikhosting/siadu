<?php
$opt=gpost('opt');
if($opt=='lookup'){
	require_once(VWDIR.'vi_label.php');
}
else if($opt=='sethead'){
	$r=dbUpdate("mstr_setting",Array('val'=>gpost('title')),"`kiy`='htitle'");
	$r&=dbUpdate("mstr_setting",Array('val'=>gpost('description')),"`kiy`='hdesc'");
	if($r) echo "Header has been set as default.";
	else echo "Unable to set new default header.";
}
else if($opt=='aq'){
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	if($nr<50){
	$cid=gpost('cid');
	$ctt=gpost('ctt');
	$bcd=gpost('bcd');
	dbInsert("p_label",Array('book'=>$cid,'title'=>$ctt,'barcode'=>$bcd));
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	while($r=dbFA($t)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; ?>
		<tr height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['title']?></div></td>
			<td width="80px">&nbsp;<?=$r['barcode']?><input type="hidden" id="vib<?=$i++?>" value="<?=$r['book']?>"/></td>
			<td width="26px">
				<button class="btn" title="Remove from print queue" onclick="pqueue('rq',<?=$r['dcid']?>)">
					<div class="bi_canb">&nbsp;</div>
				</button>
			</td>
		</tr>
	<?php }} else { echo "<span></span>";} ?>
	<input type="hidden" id="qtrn" value="<?=$nr?>" /><?php
}
else if($opt=='bq'){
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	if($nr<50){
		$bcs=explode("^",gpost('cid'));
		for($ii=1;$ii<count($bcs);$ii++){
			$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
			if($nr<50){
			$kk=explode('~',$bcs[$ii]);
			$cid=$kk[0];
			$ctt=$kk[1];
			$bcd=$kk[2];
			dbInsert("p_label",Array('book'=>$cid,'title'=>$ctt,'barcode'=>$bcd));
			} else { break; }
		}
		$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
		while($r=dbFA($t)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; ?>
			<tr height="24px" style="background:<?=$k?>">
				<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['title']?></div></td>
				<td width="80px">&nbsp;<?=$r['barcode']?><input type="hidden" id="vib<?=$i++?>" value="<?=$r['book']?>"/></td>
				<td width="26px">
					<button class="btn" title="Remove from print queue" onclick="pqueue('rq',<?=$r['dcid']?>)">
						<div class="bi_canb">&nbsp;</div>
					</button>
				</td>
			</tr>
		<?php }
	} else { echo "<span></span>"; } ?>
	<input type="hidden" id="qtrn" value="<?=$nr?>" /><?php
}
else if($opt=='rq'){
	$cid=gpost('cid');
	dbDel("p_label","dcid='$cid'");
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	while($r=dbFA($t)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; ?>
		<tr height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['title']?></div></td>
			<td width="80px">&nbsp;<?=$r['barcode']?><input type="hidden" id="vib<?=$i++?>" value="<?=$r['book']?>"/></td>
			<td width="26px">
				<button class="btn" title="Remove from print queue" onclick="pqueue('rq',<?=$r['dcid']?>)">
					<div class="bi_canb">&nbsp;</div>
				</button>
			</td>
		</tr>
	<?php } ?><input type="hidden" id="qtrn" value="<?=$nr?>" /><?php
}
else if($opt=='uq'){
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	while($r=dbFA($t)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; ?>
		<tr height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['title']?></div></td>
			<td width="80px">&nbsp;<?=$r['barcode']?><input type="hidden" id="vib<?=$i++?>" value="<?=$r['book']?>"/></td>
			<td width="26px">
				<button class="btn" title="Remove from print queue" onclick="pqueue('rq',<?=$r['dcid']?>)">
					<div class="bi_canb">&nbsp;</div>
				</button>
			</td>
		</tr>
	<?php } ?><input type="hidden" id="qtrn" value="<?=$nr?>" /><?php
}
else if($opt=='cq'){
	$sql="TRUNCATE TABLE  `p_label`";
	mysql_query($sql);
	$t=dbSel("*","p_label"); $i=0; $nr=mysql_num_rows($t);
	while($r=dbFA($t)){ $k=$k=="#f4f4f4"?"#ffffff":"#f4f4f4"; ?>
		<tr height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['title']?></div></td>
			<td width="80px">&nbsp;<?=$r['barcode']?><input type="hidden" id="vib<?=$i++?>" value="<?=$r['book']?>"/></td>
			<td width="26px">
				<button class="btn" title="Remove from print queue" onclick="pqueue('rq',<?=$r['dcid']?>)">
					<div class="bi_canb">&nbsp;</div>
				</button>
			</td>
		</tr>
	<?php } ?><input type="hidden" id="qtrn" value="<?=$nr?>" /><?php
}
?>