<?php
$opt=gpost('opt');
if($opt=='avlist'){
	require_once(VWDIR.'b_loan_book.php');
}
else if($opt=='getbook'){
$barcode=gpost('code');
$t=mysql_query("SELECT * FROM book WHERE barcode='$barcode'");
if(mysql_num_rows($t)>0){
$r=dbFAx($t);
$ct=dbSFA("*","catalog","W/dcid='".$r['catalog']."'");
$ttile='<b>"'.str_replace("\\","",$ct['title']).'"</b>';
?>
	<td width="400px">
		<div style="float:left">
			<img src="<?=IMGC.($ct['cover']==''?"nocover.jpg":$ct['cover'])?>" width="50px"/>
		</div>
		<div style="float:left;margin-left:10px">
			<div style="margin-bottom:4px;line-height:150%"><?=$ttile?><br/> &nbsp; by <?=dbFetch("name","mstr_author","W/dcid='".$ct['author']."'")?></div>
			<div> &nbsp; ID number: <strong><?=$r['nid']?></strong></div>
		</div>
	</td>
	<td align="right"><div class="prefopt" style="width:30px"><input type="button" title="Remove" class="prefdel" onclick="removeEntry(1,<?=$b?>)"/></div>
	</td>
<?php } else echo $barcode;
}
?>