<?php
	$t=dbSel("*","catalog","O/ `title`");
?>
	<table class="xtable" border="0" cellspacing="1px" width="850px">
	<tr>
		<td class="xtdh" style="text-align:center">Cover</td>
		<?=iThxp("Title",'title',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Author",'author',$page,$sortby,$smode,$keyw)?>
		<?=iThxp("Publisher",'publisher',$page,$sortby,$smode,$keyw)?>
		<td class="xtdh" style="text-align:center">Availability</td>
		<td class="xtdh" style="text-align:center">Options</td>
	</tr>
	<?php
	$n=0; $rc=1; //$p=Array('title','type','host','place','date1','date2','speaker','participant');
	while($r=dbFAx($t)){ if($n>=$nps && $n<$npl){ if($rc==0){$rc=1;}else{$rc=0;}; $date1=ftgl($r['date1']); $date2=ftgl($r['date2']);
		?>
		<tr id="p_train<?=$r['dcid']?>" class="xxr<?=$rc?>" height="100px">
			<td width="70px" align="center">
				<img src="<?=IMGC.($r['cover']==''?"nocover.jpg":$r['cover'])?>" width="60px"/>
			</td>
			<td width="*"><?=src_replace($r['title'])?></td>
			<td width="130px"><?=$mstr_author[$r['author']]?></td>
			<td width="120px"><?=$mstr_publisher[$r['publisher']]?></td>
			<td width="80px" align="center">
				<?php
					$nbook=dbSRow("book","W/`catalog`='".$r['dcid']."'"); $abook=0;
					if($nbook>0){
					$abook=dbSRow("book","W/`catalog`='".$r['dcid']."' AND `available`='Y'");
					echo $abook." of ".$nbook;
					} else echo "N/A";
				?>
			</td>
			<td width="140px" align="center">
				<button style="visibility:<?=($abook>0?"visible":"hidden")?>" title="View books" class="find16" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=view&nid=<?=$r['dcid']?>')"></button>&nbsp;
				<button class="btnedit" title="Edit" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=edit&nid=<?=$r['dcid']?>')"></button>
				<!--button class="btndel" title="Delete" onclick="b_class('df',<?=$r['dcid']?>)"></button-->&nbsp;
				<button class="btn" title="Add new book" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')">
					<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">Book</div>
				</button>
			</td>
		</tr>
	<?php } $n++; } ?>
	</table>