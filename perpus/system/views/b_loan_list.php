<?php
$t=mysql_query("SELECT * FROM `book` WHERE `brid`='$brid'");
$n=mysql_num_rows($t);
$df=Array(); $i=0;
while($r=dbFA($t)){
	$df[$i++]=$r;
}
?>
<div style="width:508px">
<table id="teb_education" class="preftbl" cellspacing="0px" cellpadding="8px" style="margin:0 0 5px 0">
<?php for($b=0;$b<10;$b++){?>
	<tr id="loanlist<?=$b?>" style="display:none"></tr>
<?php }?>
</table>
</div>
