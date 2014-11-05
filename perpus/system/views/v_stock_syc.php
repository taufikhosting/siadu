<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";
$t=dbSel("*","so_history","W/status='1' OR status='2' LIMIT 0,1");
if(mysql_num_rows($t)>0){
$r=mysql_fetch_array($t);
dbUpdate("so_history",Array('status'=>1),"dcid='".$r['dcid']."'");
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
<script type="text/javascript" language="javascript">
function doneChecking(){
	//if(confirm('Are you sure done giving note?')){
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
		<td id="ps2a" class="ptracknumber" align="center">2</td>
		<td id="ps2b" class="ptracktext">Books<br/>checking</td>
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
</tr></table>
</div>
<input type="hidden" id="ntable" value="<?=$ntable?>"/>
<div class="sfont" style="margin-bottom:10px;margin-top:20px">There are <?=$bcekN.' book'.($bcekN>1?'s':'')?> not checked. Give note for that lost book<?=($bcekN>1?'s':'')?>.</div>
<?php
	require_once(VWDIR.'v_stock_lost.php');
?>
<br/>
<?php } else { 
$pass=true;
}?>