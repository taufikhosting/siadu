<?php
$t=mysql_query("SELECT * FROM so_history WHERE status='1'");
if(mysql_num_rows($t)>0) $stocktaking=true;
else $stocktaking=false;

$r=dbSFA("*","catalog","W/`dcid`='$dcid' LIMIT 0,1");
if(!empty($r)){
$publisher=dbFetch("name","mstr_publisher","W/`dcid`='".$r['publisher']."'");
$lang=dbFetch("name","mstr_language","W/`dcid`='".$r['language']."'");
$author=dbFetch("name","mstr_author","W/`dcid`='".$r['author']."'");
?>
<table cellspacing="0" cellpadding="5px" width="240px" style="margin:auto;margin-top:10px">
<tr valign="top" style="height:110px">
	<td width="60px">
		<img src="<?=IMGC.($r['cover']==''?"nocover.jpg":$r['cover'])?>" width="60px"/>
	</td>
	<td style="padding-left:10px">
		<div class="sfont" style="font-size:16px;color:#444;margin-bottom:6px"><b><?=str_replace("\'","'",$r['title'])?></b></div>
		<div class="sfont" style="margin-bottom:6px">by <a class="linkb" href="<?=RLNK?>book.php?get=author&getid=<?=$r['author']?>" title="View all book by <?=$author?>"><?=$author?></a></div>
	</td>
</tr>
</table>
<div style="width:100%;border-top:1px solid #d0d0d0;margin-bottom:10px"></div>
<table class="stable" cellspacing="0" cellpadding="0" width="290px" style="margin-left:auto;margin-right:auto;margin-bottom:20px">
<tr><td align="right" width="120px">publisher :</td><td style="padding-left:10px"><?=$publisher?></td></tr>
<tr><td align="right">relase year :</td><td style="padding-left:10px"><?=$r['release']?></td></tr>
<tr><td align="right" colspan="2">&nbsp;</td></tr> <!-- separator -->
<tr><td align="right">ISBN :</td><td style="padding-left:10px"><?=$r['isbn']?></td></tr>
<tr><td align="right">series :</td><td style="padding-left:10px"><?=$r['series']?></td></tr>
<tr><td align="right">language :</td><td style="padding-left:10px"><?=$lang?></td></tr>
<tr><td align="right" colspan="2">&nbsp;</td></tr> <!-- separator -->
<tr><td align="right">availablity :</td><td style="padding-left:10px">
	<?php
		$nbook=dbSRow("book","W/`catalog`='".$r['dcid']."'");
		$abook=0;
		if($nbook>0){
			$abook=dbSRow("book","W/`catalog`='".$r['dcid']."' AND `available`='Y'");
			echo $abook." of ".$nbook;
		} else echo "N/A";
	?>
</td></tr>
</table>
<center>
	<?php if(!$stocktaking){?>
	<button class="btn" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=edit&nid=<?=$r['dcid']?>')" style="">
		<div class="bi_edit">Edit</div>
	</button>
<?php if($abook>0){?>
	<input type="button" class="btnx" value="Borrow" />
<?php }}?>
</center>
<input type="hidden" id="bookid" value="<?=$r['dcid']?>"/>
<?php }?>