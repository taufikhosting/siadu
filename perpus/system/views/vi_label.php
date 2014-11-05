<?php
$keyw=trim(getsx('k'));
$npf=0; $ids="ALL";
if($keyw!=''){
function src_replace($v){global $keyw;return preg_replace("/".$keyw."/i", "<strong>\$0</strong>", $v);}
function strBC($a){
	$s=strval($a);
	if(strlen($s)<5){
		for($i=strlen($s);$i<5;$i++) $s='0'.$s;
	}
	return $s;
}
if(preg_match("/^[0-9]+$/",$keyw)){ // find by barcode
	$bcl=Array();
	$t=dbSel("barcode","p_label");
	while($r=dbFA($t)){
		$bcl[$r['barcode']]='1';
	}
	
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
else if(preg_match("/^[0-9]+\-[0-9]*$/",$keyw)){ // find by barcode range
	$bcl=Array();
	$t=dbSel("barcode","p_label");
	while($r=dbFA($t)){
		$bcl[$r['barcode']]='1';
	}
	
	$nn=0;
	$bcode=explode('-',$keyw);
	$a=intval($bcode[0]); $b=$a;
	if(!empty($bcode[1])){
		$b=intval($bcode[1]);
		if($b<=0) $b=$a;
	}
	if($a>$b){
		$c=$b;
		$b=$a;
		$a=$c;
	}
	$keyw=strBC($a).'-'.strBC($b);
	/*
	echo $a.'-'.$b.'<br/>';
	for($i=$a;$i<=$b;$i++){
	$kw=strBC($i);
	echo $kw.'<br/>';
	}
	//if(false)*/
	$f=0; $blis='0';
	for($j=$a;$j<=$b;$j++){
	$kw=strBC($j);
	$sql="SELECT * FROM book WHERE barcode='$kw' LIMIT 0,1";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){ $r=mysql_fetch_array($q);
	if($bcl[$r['barcode']]!='1'){
	if($f==0){?>
	<div class="pfsub">Select book to add to print queue: <?php if($a<$b){?><a id="aatq" class="linkb" style="margin-left:65px" href="javascript:void(0)" onclick="EHide('aatq');addAlltoQueue()">Add all to queue</a><?php }?></div>
	<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
		<table class="stable" border="0" cellspacing="0" width="410px">
	<?php $f=1;}
		$i++; $tit=stripslashes(dbFetch("title","catalog","W/dcid='".$r['catalog']."'")); $blis.='^'.$r['dcid'].'~'.$tit.'~'.$r['barcode'];
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
	<?php }
	}
	$nn+=$n;
	}
	if($nn>0){
		if($i==0){?>
			<div class="sfont" style="color:#008ee8;width:430px">All book which barcode within range <?=$keyw?> already in the print queue.</div>
		<?php
		} else {?>
		</table>
	</div>
	<div id="bliss" style="display:none"><?=$blis?></div>
	<?php }}
	
	if($nn==0) { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px">There is no book which barcode within range <b><?=$keyw?></b>.</div>
	<?php
	}
}
else { // find by title
if($keyw!=''){
	$bcl=Array();
	$t=dbSel("barcode","p_label");
	while($r=dbFA($t)){
		$bcl[$r['barcode']]='1';
	}
	$sql="SELECT dcid,title FROM catalog WHERE title LIKE '$keyw %' OR title LIKE '% $keyw' OR title LIKE '% $keyw %' OR title='$keyw' ORDER BY title";
	$q=mysql_query($sql);
	$n=mysql_num_rows($q);
	if($n>0){ $l=1; ?>
		<div class="pfsub">Select book to add to print queue:</div>
		<div style="width:430px;height:240px;overflow:auto;margin-top:10px">
			<table class="stable" border="0" cellspacing="0" width="410px">
			<?php $i=0;
			while($f=mysql_fetch_array($q)){
			$h=mysql_query("SELECT * FROM book WHERE catalog='".$f['dcid']."' ORDER BY barcode");
			while($r=mysql_fetch_array($h)){ if($bcl[$r['barcode']]!='1'){ $i++; $tit=stripslashes(dbFetch("title","catalog","W/dcid='".$r['catalog']."'"));
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
			<?php }}} ?>
			</table>
			<?php 
				if($n>0 && $i==0){?>
				<div class="sfont" style="color:#008ee8;width:430px">All book which title match with <b><?=$keyw?></b> already in the print queue.</div>
			<?php } ?>
		</div>
		<?php
	} else { ?>
	<div class="sfont" style="color:#008ee8;padding-top:20px;width:430px"><b><?=$keyw?></b> does not match with any book title.</div>
	<?php
	}
}}} ?>