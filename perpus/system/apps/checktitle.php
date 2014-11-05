<?php
$v=trim(gpost('v'));
$t=mysql_query("SELECT * FROM catalog WHERE title='$v'");
$n=mysql_num_rows($t);
if($n>0){ ?>
<div class="hl2" style="margin-top:10px;margin-bottom:10px;color:<?=CBLUE?>">This title already saved in book catalog!</div>
<div class="sfont" style="margin-bottom:6px">There <?=(($n>1)?"are ":"is ").$n." catalog".(($n>1)?"s has":" had")?> same title.</div>
<?php
while($r=mysql_fetch_array($t)){?>
<div style="padding:4px;margin-right:25px;border:1px solid #b2b2b2;margin-bottom:6px">
<table cellspacing="0" cellpadding="0" width="300px">
<tr><td>
<div class="sfont" style="margin-bottom:6px"><b>"<?=$r['title']?>"</b> by <?=dbFetch("name","mstr_author","W/dcid='".$r['author']."'")?></div>
</td></tr>
<tr><td>
<div class="sfont" style="margin-bottom:6px">Publisher: <?=dbFetch("name","mstr_publisher","W/dcid='".$r['publisher']."'")?></div>
</td>
</tr>
<tr><td>
<div class="sfont">ISBN: <?=$r['isbn']?></div>
</td></tr>
<tr>
<td align="right">
	<input type="button" class="btn" value="Add book to this catalog" onclick="jumpTo('<?=RLNK?>bibliographic.php?tab=catalog&act=add&nid=<?=$r['dcid']?>')"/>
</td>
</tr>
</table>
</div>
<?php } ?>
<input type="button" class="btn" value="Ignore" onclick="E('titlecheck').innerHTML=''" />
<?php }
?>