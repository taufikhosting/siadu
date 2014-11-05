<?php
$sql="SELECT * FROM p_loan ORDER BY dcid";

// Queries:
$t=mysql_query($sql);
$ndata=mysql_num_rows($t);

if($ndata>0){
$tablew='450px';
?>
<table class="xtable" border="0" cellspacing="0" width="<?=$tablew?>">
	<tr>
		<td class="xtdh" width="30px" style="text-align:left"></td>
		<td class="xtdh" width="180px">Title</td>
		<td class="xtdh" width="120px">Book number</td>
		<td class="xtdh" width="120px">Call number</td>
	</tr>
<?php
$n=$nps; $rc=1; $m=1; $rh=$cover?'height="100px"':'';
while($k=dbFAx($t)){ if($rc==0){$rc=1;}else{$rc=0;};
	$r=mysql_fetch_array(mysql_query("SELECT * FROM book WHERE dcid='".$k['book']."' LIMIT 0,1"));
	$y=mysql_query("SELECT * FROM catalog WHERE dcid='".$r['catalog']."' LIMIT 0,1");
	$f=mysql_fetch_array($y);
	?>
	<tr id="xrow<?=$r['dcid']?>" class="xxr<?=$rc?>" <?=$rh?>>
		<td width="30px" align="left">
			<button class="btn" title="Remove from list" onclick="event.preventDefault();pqueue('rq',<?=$k['dcid']?>)">
				<div class="bi_canb">&nbsp;</div>
			</button>
			<input type="hidden" name="sbook<?=$m?>" value=<?=$k['book']?>"/>
		</td>
		<td width="180px"><?=$f['title']?></td>
		<td width="120px"><?=$r['nid']?></td>
		<td width="120px"><?=$r['callnumber']?></td>
	</tr>
<?php $n++;$m++;} ?>
</table>
<input type="hidden" name="xnrow" id="xnrow" value="<?=$m?>"/>
<?php } else {?>
<div class="sfont" style="width:460px"><i>No book selected.</i></div>
<?php }?>