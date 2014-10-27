<table cellspacing="0" cellpadding="0" border="0" width=""><tr valign="top">
<td width="450px">
	<div class="hl2" style="margin-bottom:6px">Find available book with...</div>
	<table class="stable" cellspacing="0" cellpadding="0" border="0" width="450px"><tr>
		<td width="*">barcode or title:</td>
		<td width="250px"><?=iText('keyw','','width:240px','','onkeyup="lookUp()"')?></td>
		<td width="24px" align="left"><input title="find" type="button" class="find21" onclick="lookUp()"/></td>
		<td width="20px"></td>
	</tr>
	<tr>
		<td></td><td  width="250px" style="padding-top:2px;font:11px <?=SFONT?>;color:#aaa">Use numeric characters to find barcode or alphanumeric to find title.</td><td colspan="2"></td>
	</tr>
	</table>
	<div id="emp_result" style="width:420px;margin-top:20px;height:250px">
		<?php require_once(VWDIR.'vi_loan.php');?>
	</div>
	<input type="button" value="Cancel" class="btn" onclick="jumpTo('<?=RLNK?>circulation.php?tab=loan')" style="float:left;margin-top:6px"/>
</td>
<td width="450px" style="padding-left:10px">
	<form action="<?=RLNK?>request.php" method="post">
	<div class="hl1" style="margin-bottom:8px">&nbsp;</div>
	<div class="hl2">Loan list:</div>
	<div class="sfont" style="margin-top:10px">Books which <?=$membername?> wants to borrow</div>
	<input type="hidden" name="member" value="<?=$member?>"/>
	<input type="hidden" name="req" value="loan"/>
	<div id="qtbl" style="width:470px;margin-top:20px;height:273px;overflow:auto;">
		<?php require_once(VWDIR.'vi_loan_list.php'); $dd=date("Y-m-d",strtotime("+7 day"));?>
	</div>
	<table id="okbtn" cellspacing="0" cellpadding="0" style="display:none;width:450px;margin-top:16px;margin-bottom:4px"><tr>
		<td width="70px"><div class="sfont"><div class="sfont">Due date:</div></td>
		<td><?=inputDate('date2',date("Y-m-d"))?></td>
		<td align="right">
		<input type="submit" value="OK" class="btnx"/>
		</td>
	</tr></table>
	</form>
</td>
</tr></table>