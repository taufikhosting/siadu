<?php
$keyw=trim(getsx('k'));
$npf=0; $ids="ALL";
if($keyw!=''){
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<strong>\$0</strong>", $v);}

if(preg_match("/^[0-9]+$/",$keyw)){ // find by barcode
	$bcl=Array();
	$t=dbSel("book","p_loan");
	while($r=dbFA($t)){
		$bcl[$r['book']]='1';
	}
	$sql="SELECT * FROM book WHERE barcode='$keyw' AND available='Y' LIMIT 0,1";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){ $l=1; ?>
		<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
			<table class="stable" border="0" cellspacing="0" width="410px">
			<?php $i=0;
			while($f=mysql_fetch_array($q)){
			$h=mysql_query("SELECT * FROM catalog WHERE dcid='".$f['catalog']."' LIMIT 0,1");
			$r=mysql_fetch_array($h);
			if($bcl[$f['dcid']]!='1'){ $i++; 
			$tit=stripslashes($r['title']);
			$tit=str_replace('"','',$tit); $tit=str_replace("'","",$tit);?>
			<tr class="srow" id="vir<?=$f['dcid']?>" height="30px" style="background:<?=$k?>">
				<td width="*"><div style="overflow:hidden;width:100%;height:15px" title="<?=$tit?>"><?=$tit?></div></td>
				<td width="120px">&nbsp;&nbsp;<?=$f['nid']?></td>
				<td width="100px">&nbsp;<?=$f['callnumber']?></td>
				<td width="50px" align="right">
				<button class="btn" onclick="pqueue('aq',<?=$f['dcid']?>)">
					<div class="bi_out">Borrow</div>
				</button>
				</td>
			</tr>
			<?php }} ?>
			</table>
			<?php 
				if($n>0 && $i==0){?>
				<div class="sfont" style="color:#008ee8;width:430px">All available book which barcode match with <b><?=$keyw?></b> already in the loan list.</div>
			<?php } ?>
		</div>
		<?php
	} else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> does not match with any available book barcode.</div>
	<?php
	}
} else { // find by title
if($keyw!=''){
	$bcl=Array();
	$t=dbSel("book","p_loan");
	while($r=dbFA($t)){
		$bcl[$r['book']]='1';
	}
	$sql="SELECT dcid,title FROM catalog WHERE title LIKE '$keyw %' OR title LIKE '% $keyw' OR title LIKE '% $keyw %' OR title='$keyw' ORDER BY title";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){ $l=1; ?>
		<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
			<table class="stable" border="0" cellspacing="0" width="410px">
			<?php $i=0;
			while($f=mysql_fetch_array($q)){
			$h=mysql_query("SELECT * FROM book WHERE catalog='".$f['dcid']."' ORDER BY barcode");
			while($r=mysql_fetch_array($h)){ if($bcl[$r['dcid']]!='1' && $r['available']=='Y'){ $i++; $tit=stripslashes(dbFetch("title","catalog","W/dcid='".$r['catalog']."'"));
			$tit=str_replace('"','',$tit); $tit=str_replace("'","",$tit);?>
			<tr class="srow" id="vir<?=$r['dcid']?>" height="30px" style="background:<?=$k?>">
				<td width="*"><div style="overflow:hidden;width:100%;height:15px" title="<?=$tit?>"><?=$tit?></div></td>
				<td width="120px" title="<?=$tit?>">&nbsp;&nbsp;<?=$r['nid']?></td>
				<td width="100px" title="<?=$tit?>">&nbsp;<?=$r['callnumber']?></td>
				<td width="50px" align="right">
				<button class="btn" onclick="pqueue('aq',<?=$r['dcid']?>)">
					<div class="bi_out">Borrow</div>
				</button>
				</td>
			</tr>
			<?php }}} ?>
			</table>
			<?php 
				if($n>0 && $i==0){?>
				<div class="sfont" style="color:#008ee8;width:430px">All available book which title match with <b><?=$keyw?></b> already in the loan list.</div>
			<?php } ?>
		</div>
		<?php
	} else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> does not match with any available book title.</div>
	<?php
	}
}}} ?>