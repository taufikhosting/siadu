<?php
$bcode=gpost('barcode');
$cid=gpost('bookid');
$info=gpost('info');
//$r=dbSFA("*","book","W/`dcid`='$cid' OR barcode='$bcode' LIMIT 0,1");
$b=dbSFA("*","book","W/`dcid`='$cid' OR barcode='$bcode' LIMIT 0,1");
$c=dbSFA("*","catalog","W/`dcid`='".$b['catalog']."' LIMIT 0,1");
$m=mysql_fetch_array(mysql_query("SELECT * FROM ".DB_HRD." WHERE `nip`='".$r['member']."' LIMIT 0,1"));
$author=stripslashes(dbFetch("name","mstr_author","W/`dcid`='".$c['author']."'"));
$publisher=dbFetch("name","mstr_publisher","W/`dcid`='".$c['publisher']."'");
$cla=dbSFA("name,code","mstr_class","W/`dcid`='".$c['class']."' LIMIT 0,1");
// Form dimension
$fwidth=400; $lwidth=100;
$iTextFw="width:".($fwidth-$lwidth-16)."px";
?>
<table cellspacing="0" cellpadding="0" width="100%"><tr><td id="fformt" align="center" style="padding-top:115px">
<div id="fformbox" class="fformbox" style="width:<?=($fwidth+20)?>px;overflow:hidden">
	<div class="sfont" style="padding:12px;text-align:left;color:#646464;font-size:15px">
		<?=$info!=''?$info:"Book Information"?> <!--span style="font-size:11px;color:<?=CLGREY?>"> : <?=$info?></span-->
	</div>
	<!--div class="sfont" style="width:<?=($fwidth+20)?>px;overflow:hidden;text-align:left;padding-left:12px"><?=$info?></div-->
	<div style="text-align:left;padding:5px 10px;width:<?=$fwidth?>px">
		<table class="stable" cellspacing="0" cellpadding="4px" width="<?=$fwidth?>px">
		<tr><td>
			<!--div class="sfont" style="width:<?=($fwidth+20)?>px;overflow:hidden;text-align:left;margin-bottom:4px"><?=$info?></div-->
			<table class="stable2" border="0" cellspacing="0" cellpadding="5px" width="400px" style="cursor:default;margin-bottom:20px">
			<tr valign="top">
				<td width="70px" align="left">
					<img src="<?=IMGC.($c['cover']==''?"nocover.jpg":$c['cover'])?>" width="60px"/>
				</td>
				<td>
					<div style="font:15px <?=SFONT?>;color:<?=CDARK?>"><b><?=stripslashes($c['title'])?></b></div>
					<div style="font:12px <?=SFONT?>;color:<?=CDARK?>;margin-top:4px">by <a class="linkb" target="_blank" href="<?=RLNK?>book.php?get=author&getid=<?=$r['author']?>" title="View all book by <?=$author?>"><?=$author?></a></div>
					<table cellspacing="0" cellpadding="0" style="margin-top:14px">
					<tr>
						<td width="100px"><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Book number</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <span style="color:<?=CLBLUE?>"><?=$b['nid']?></span></div></td>
					</tr>
					<tr>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">Call number</div></td>
						<td><div style="<?=SFONT12?>color:<?=CDARK?>;margin-top:4px">: <span style="color:<?=CLBLUE?>"><?=$b['callnumber']?></span></div></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td></tr>
		</table>
		<table cellspacing="0" cellpadding="3px" width="<?=$fwidth?>px" style="margin-top:20px"><tr>
			<td align="right">
				<input type="button" class="btn" onclick="close_fform()" value="Close"/>
			</td>
		</tr></table>
	</div>
</div>
</td></tr></table>