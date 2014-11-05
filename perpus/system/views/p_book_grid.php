<?php
$filt="";
if($get!=''){
	if($get=='author'){
		$filt.=$filt==""?" WHERE ":"";
		$filt.="`author`='$cid'";
	}
}
$t=dbSel("dcid,title,cover","catalog",$filt."O/ dcid DESC LIMIT 0,30");
$ndata=dbNRow($t);
$shrow=ceil($ndata/6);
$sr=0; $nr=0; $dcid=-1;
//border:10px solid #b6550f;
?>
<table cellspacing="0" cellpadding="0"><tr valign="top"><td>
<div style="width:780px;height:600px;overflow:auto;">
<table cellspacing="0" cellpadding="0" style="border:10px solid #eebd46;">
<?php while($r=dbFA($t)){
if($sr==0){ $nr++;?>
<tr style="background:url('<?=IMGR?>shelfbg.png') repeat-x">
<?php
} if($dcid==-1)$dcid=$r['dcid']; ?>
<td style="padding:40px 10px 20px 10px">
<?php if($r['cover']!=''){?>
<div style="width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat;cursor:pointer" title="<?=$r['title']?>" onclick="getBookDetail(<?=$r['dcid']?>)">
<div style="width:104px;height:138px;background:url('<?=IMGC.$r['cover']?>') center top no-repeat">
<img src="<?=IMGC.'cvshade'.$r['newbook']?>.png"/>
</div>
</div>
<?php } else {?>
<div id="pf_photo" style="width:104px;background:url('<?=IMGC?>cvbg.png') center no-repeat;cursor:pointer" title="<?=$r['title']?>" onclick="getBookDetail(<?=$r['dcid']?>)">
	<div style="width:104px;height:138px;background:url('<?=IMGC?>nocover.png') center top no-repeat">
	<div style="font:bold 14px 'Cambria',Verdana;color:#1c64d1;text-align:center;width:92px;padding:6px;padding-top:30px"><div id="cvtitle" style="width:86px;background:;padding:2px 2px"><?=$r['title']?></div></div>
	</div>
</div>
<?php }?>
</td>
<?php $sr++; if($sr==6){ $sr=0;?>
</tr>
<?php }
}
if($sr>0 && $sr<6){
for($i=$sr;$i<6;$i++){?>
<td style="padding:40px 10px 20px 10px">
<div style="width:104px;height:138px">
	
</div>
</td>
<?php } ?>
</tr>
<?php }
if($nr<5){
for($r=$nr;$r<5;$r++){?>
<tr style="background:url('<?=IMGR?>shelfbg.png') repeat-x">
<?php for($i=0;$i<6;$i++){?>
<td style="padding:40px 10px 20px 10px">
<div style="width:104px;height:138px">
	
</div>
</td>
<?php }?>
</tr>
<?php
}} ?>
</table>
</div>
</td>
<td style="padding-left:5px">
<div style="width:300px;border:1px solid #1c64d1;border-top:10px solid #1c64d1;background:url('<?=IMGR?>loader2.gif') center no-repeat">
<div id="book_info" style="width:300px;background:#fff;padding-bottom:20px">
<?php
require_once(VWDIR.'p_book_detail.php');
?>
</div>
</div>
</td>
</tr></table>