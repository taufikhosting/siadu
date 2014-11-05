<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";
$t=dbSel("*","so_history","W/status='3' ORDER BY dcid DESC LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
$btot=mysql_num_rows(mysql_query("SELECT * FROM `book`"));
$bdue=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."`"));
//$bcek=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
$bcekY=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
$bcekN=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N'"));
$bcekNY=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N' AND note!=''"));
$bcekNN=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N' AND note=''"));
$bcek=$bcekY+$bcekN; $bcekYp=round($bcekY*100/$bcek,2); $bcekNp=round($bcekN*100/$bcek,2);
$buli=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."new`"));
?>
<script type="text/javascript" language="javascript">
function doneChecking(){
	//if(confirm('Are you sure book cheking is done and proceed to next step?')){
		E('donecekform').submit();
	//}
}
</script>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber0" align="center">1</td>
		<td id="ps1b" class="ptracktext0">Initialize<br/>stock take</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">2</td>
		<td id="ps2b" class="ptracktext0">Books<br/>checking</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber" align="center">3</td>
		<td id="ps2b" class="ptracktext">Finish<br/>stock take</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber0" align="center">4</td>
		<td id="ps2b" class="ptracktext0">Generate<br/>report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div class="sfont" style="margin-bottom:10px;margin-top:20px">Stock take process is completed.</div>
<div class="hl2" style="margin-bottom:10px;margin-top:20px">Book cheking summarize</div>
<table class="stable24" cellspacing="0" cellpadding="0">
	<tr><td width="150px">Total book in database</td><td>: <?=$btot." book".($btot>1?"s":"")?></td></tr>
	<tr><td style="color:<?=CBLUE?>" width="150px">Book checked</td><td style="color:<?=CBLUE?>">: <?=$bcekY." ( ".$bcekYp." % ) book".($bcekY>1?"s":"")?></td></tr>
	<tr><td style="color:#888" width="150px">Book lost</td><td style="color:#888">: <?=$bcekN." ( ".$bcekNp." % ) book".($bcekN>1?"s":"")?></td></tr>
	<tr><td style="color:#ffa000" width="150px">Book lost with note</td><td style="color:#ffa000">: <?=$bcekNY." book".($bcekNY>1?"s":"")?></td></tr>
	<tr><td style="color:#ff0000" width="150px">Book lost without note</td><td style="color:#ff0000">: <?=$bcekNN." book".($bcekNN>1?"s":"")?></td></tr>
	<tr><td style="color:#008000" width="150px">Unlisted book</td><td style="color:#008000">: <?=$buli." book".($buli>1?"s":"")?></td></tr>
</table>
<table cellspacing="0" cellpadding="0" width="850px" border="0" style="margin-top:30px"><tr>
<td align="left">
	<button class="btnx" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=report&nid=<?=$r['dcid']?>')">
		Generate report
	</button>
</td>
</tr></table>
<?php } else { 
$pass=true;
}?>