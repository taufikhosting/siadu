<?php
$keyw=trim(getsx('k'));
$npf=0;
if($keyw!=''){
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<strong>\$0</strong>", $v);}
if(preg_match("/^[0-9]+$/",$keyw)){ // find by member id	
	$sql="SELECT * FROM book WHERE barcode='$keyw' LIMIT 0,1";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){ $r=mysql_fetch_array($q);
	if($bcl[$r['barcode']]!='1'){?>
	<div class="pfsub">Select book to add to print queue:</div>
	<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
		<table class="stable" border="0" cellspacing="0" width="410px">
		<?php 
		$tit=stripslashes(dbFetch("title","catalog","W/dcid='".$r['catalog']."'")); $blis.='^'.$r['dcid'].'~'.$tit.'~'.$r['barcode'];
		$tit=str_replace('"','',$tit); $tit=str_replace("'","",$tit);?>
		<tr id="vir<?=$r['dcid']?>" height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$tit?></div></td>
			<td width="80px">&nbsp;<?=$r['barcode']?></td>
			<td width="80px">
			<button class="btn" title="Add to print queue" onclick="pqueue('aq','<?=$r['dcid'].'~'.$tit.'~'.$r['barcode']?>')">
				<div class="bi_add">Queue</div>
			</button>
			</td>
		</tr>
		</table>
	</div>
	<?php } else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> already in print queue.</div>
	<?php }} else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> does not match with any book barcode.</div>
	<?php
	}
}
else { // find by member name
	$sql="SELECT * FROM ".DB_HRD." WHERE name LIKE '$keyw %' OR name LIKE '% $keyw' OR name LIKE '% $keyw %' OR name='$keyw' ORDER BY name";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){?>
	<div class="sfont">Choose member who wants to borrow:</div>
	<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
		<table class="stable" border="0" cellspacing="0" width="410px">
	<?php while($r=mysql_fetch_array($q)){?>
		<tr class="srow" id="vir<?=$r['dcid']?>" height="24px" style="background:<?=$k?>">
			<td width="*"><div style="overflow:hidden;width:100%;height:15px"><?=$r['name']?></div></td>
			<td width="80px">&nbsp;<?=$r['nip']?></td>
			<td width="80px" align="right">
			<button class="btn" onclick="jumpTo('<?=RLNK?>circulation.php?tab=loan&act=loan&nid=<?=$r['nip']?>')">Choose</button>
			</td>
		</tr>
	<?php }?>
		</table>
	</div>
	<?php } else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> does not match with any member name.</div>
	<?php
	}
}} ?>