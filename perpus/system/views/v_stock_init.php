<?php require_once(SYDIR.'ptrack.php');$txtWidth="width:344px";?>
<div style="padding:10px 0 10px 0">
<table id="prog_track" cellspacing="5px" cellpadding="0"><tr>
<td>
	<div class="ptrackbox">
	<table cellspacing="0" cellpadding="0"><tr>
		<td id="ps1a" class="ptracknumber" align="center">1</td>
		<td id="ps1b" class="ptracktext">Initialize<br/>stock take</td>
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
		<td id="ps2a" class="ptracknumber0" align="center">4</td>
		<td id="ps2b" class="ptracktext0">Generate<br/>report</td>
	</tr></table>
	</div>
</td>
</tr></table>
</div>
<div class="hl2" style="margin-top:10px;margin-bottom:10px">Stock take informations</div>
<form action="soinit.php" method="post">
<table class="stable" cellspacing="0" cellpadding="4px" border="0">
	<tr><td width="120px" align="left">Initalization date:</td><td><?=fftgl(date("Y-m-d"))?><input type="hidden" name="date" id="date" value="<?=date("Y-m-d")?>"/></td></tr>
	<tr><td  align="left">Stock take name:</td><td><?=iText('name','',$txtWidth)?></td></tr>
	<tr><td  align="left" valign="top">Description:</td><td><?=iTextArea('description','',$txtWidth,4)?></td></tr>
	<tr><td  align="left">&nbsp;</td><td align="right">
		<input type="button" class="btn" value="Cancel" onclick="jumpTo('<?=RLNK?>stockopname.php')"/>
		<input type="submit" class="btnx" value="Start" />
		</td></tr>
</table>
</form>