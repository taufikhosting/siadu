<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";
$nid=getsx('nid');
$t=dbSel("*","so_history","W/dcid='$nid' LIMIT 0,1");
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
		<td id="ps2b" class="ptracktext0">Finish<br/>stock take</td>
	</tr></table>
	</div>
</td>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps2a" class="ptracknumber" align="center">4</td>
		<td id="ps2b" class="ptracktext">Generate<br/>report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div class="sfont" style="line-height:200%;width:600px;margin-top:30px;margin-bottom:10px">Report generation may take a minute or two. It is depends on your number of books and network connection.</div>
<input type="hidden" id="ntable" value="<?=$ntable?>"/>
<form action="<?=RLNK?>stockreport.php" method="post" target="_blank">
<input type="hidden" name="nid" value="<?=$nid?>"/>

<div class="hl2" style="margin-bottom:10px;margin-top:20px">Print:</div>
<table class="stable24" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
<tr><td width="24px"><input id="ppr0" name="pprint" checked class="iCheck" type="radio" value="0"/></td><td><label for="ppr0">All</label></td></tr>
<tr><td width="24px"><input id="ppr1" name="pprint" class="iCheck" type="radio" value="1"/></td><td><label for="ppr1">Book checked</label></td></tr>
<tr><td width="24px"><input id="ppr2" name="pprint" class="iCheck" type="radio" value="2"/></td><td><label for="ppr2">Book lost with note</label></td></tr>
<tr><td width="24px"><input id="ppr3" name="pprint" class="iCheck" type="radio" value="3"/></td><td><label for="ppr3">Book lost without note</label></td></tr>
</table>

<div class="hl2" style="margin-bottom:10px;margin-top:20px">Print option:</div>
<table class="stable24" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
<tr><td width="24px"><input id="rdat" name="pdat" checked class="iCheck" type="checkbox" value="1"/></td><td><label for="rdat">Print printing date.</label></td></tr>
<tr><td width="24px"><input id="rsum" name="psum" checked class="iCheck" type="checkbox" value="1"/></td><td><label for="rsum">Print summarize.</label></td></tr>
</table>

<table class="stable24" cellspacing="0" cellpadding="0" style="margin-bottom:20px">
<tr><td width="150px">Paper size:</td><td><?=iSelect('psize',Array('F4'=>'F4 &nbsp; 210x330mm','A4'=>'A4 &nbsp; 210x297mm'))?></td></tr>
</table>
<table class="stable24" cellspacing="0" cellpadding="0">
<tr>
	<!--td width="50px"><input type="button" class="btn" value="Back" style="margin-top:30px" onclick="jumpTo('<?=RLNK?>stockopname.php?tab=history')" /></td-->
	<td><input type="submit" class="btnx" value="Generate report" style="margin-top:30px" /></td>
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