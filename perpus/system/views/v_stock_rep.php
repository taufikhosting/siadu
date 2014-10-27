<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";
$t=dbSel("*","so_history","W/status='4' LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
$ntable=$r['ntable'];
$tblid=$r['dcid'];
$btot=mysql_num_rows(mysql_query("SELECT * FROM `book`"));
$bdue=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."`"));
//$bcek=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
$bcekY=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."cek`"));
$bcekN=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."` WHERE cek='N'"));
$bcek=$bcekY+$bcekN; $bcekYp=round($bcekY*100/$bcek,2); $bcekNp=round($bcekN*100/$bcek,2);
$buli=mysql_num_rows(mysql_query("SELECT * FROM `".$r['ntable']."new`"));
?>
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
		<td id="ps2a" class="ptracknumber0" align="center">3</td>
		<td id="ps2b" class="ptracktext0">Synchronize<br/>book</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber" align="center">4</td>
		<td id="ps2b" class="ptracktext">Finish<br/>stock take</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div class="sfont" style="line-height:200%;width:600px;margin-top:30px;margin-bottom:10px">Stock take process is now complete.</div>
<input type="hidden" id="ntable" value="<?=$ntable?>"/>
<form action="<?=RLNK?>sofinish.php" method="post" target="_blank">
<input type="hidden" name="nid" value="<?=$r['dcid']?>"/>
<table class="stable24" cellspacing="0" cellpadding="0" style="margin-bottom:20px">
<tr>
	<td align="right"><input type="submit" class="btnz" value="Finish" style="width:80px;margin-top:30px"/></td>
</tr>
</table>
</form>
<?php
	//require_once(VWDIR.'v_stock_lost.php');
?>
<br/>
<?php } else {
$pass=true;
}?>