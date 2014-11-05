<?php
$sql="SELECT * FROM loan WHERE member='$nid' AND status!='0'";
$t=mysql_query($sql);
if(mysql_num_rows($t)>0){
?>
<div class="hl2" style="margin-bottom:4px">Select book to return:</div>
<table class="xtable" border="0" cellspacing="1px" width="<?=$stablew?>">
	<tr>
		<td class="xtdh">Title</td>
		<td class="xtdh">Book number</td>
		<td class="xtdh">Call number</td>
		<td class="xtdh">Loan date</td>
		<td class="xtdh">Due date</td>
		<?php if($show!='1'){?>
		<td class="xtdh">Options</td>
		<?php }else{?>
		<td class="xtdh">Return date</td>
		<td class="xtdh">Status</td>
		<?php }?>
	</tr>
<?php
$n=0; $rc=1; $k=1;
while($h=mysql_fetch_array($t)){if($rc==0){$rc=1;}else{$rc=0;};
	$r=mysql_fetch_array(mysql_query("SELECT * FROM book WHERE dcid='".$h['book']."' LIMIT 0,1"));
	$y=mysql_query("SELECT * FROM catalog WHERE dcid='".$r['catalog']."' LIMIT 0,1");
	$f=mysql_fetch_array($y);
	$day=diffDay($h['date2']);
	if($day<0){
		$cl='style="color:#ff0000"';
	} else if($day<1){
		$cl='style="color:#0000ff"';
	} else {
		$cl="";
	}
	if($show=='1') $cl='';
	$dtt=fftgl($h['date2']);
	if($day==0) $dd="Today";
	else if($day==-1) $dd="Yesterday";
	else {$dd=$dtt; $dtt='';}
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>">
		<td width="*" <?=$cl?> ><?=$f['title']?></td>
		<td width="120px" <?=$cl?> ><?=$r['nid']?></td>
		<td width="120px" <?=$cl?> ><?=$r['callnumber']?></td>
		<td width="100px" <?=$cl?> ><?=fftgl($h['date1'])?></td>
		<?php if($show!='1'){?>
		<td width="100px" <?=$cl?> title="<?=$dtt?>" ><?=$dd?></td>
		<td width="70px">
			<button class="btn" style="float:left;width:70px" onclick="bookreturn('uf',<?=$h['dcid']?>)">
				<div class="bi_in">Return</div>
			</button>
		</td>
		<?php }else{?>
		<td width="100px" <?=$cl?> ><?=fftgl($h['date2'])?></td>
		<td width="100px" <?=$cl?> ><?=fftgl($h['dater'])?></td>
		<td width="80px" <?=$cl?> ><?=$status[$h['status']]?></td>
		<?php }?>
	</tr>
<?php $k++;} ?>
</table>
<?php } else {?>
<div class="sfont">There is no book in loan.</div>
<?php } ?>