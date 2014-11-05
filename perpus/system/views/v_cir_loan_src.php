<form action="<?=RLNK?>request.php" style="margin:o;padding:0" method="post" >
<input type="hidden" name="req" value="findmember" />
<div class="hl2" style="margin-bottom:6px">Member who wants to borrow:</div>
<div style="border-bottom:1px solid #eaeaea;padding-bottom:20px;margin-bottom:20px;width:1000px">
<table class="stable" cellspacing="0" cellpadding="0" border="0" width=""><tr>
	<td width="270px"><?=iText('keyw',gets('k'),'width:350px','member id or name','onkeyup="elookUp(event)"')?></td>
	<td width="26px" align="right"><input title="find" type="submit" class="find21" value=""/></td>
</tr>
</table>
<div id="emp_result" style="420px;margin-top:20px">
	<?php require_once(VWDIR.'vi_cir_loan.php');?>
</div>
</div>
</form>
<script type="text/javascript" language="javascript">
$('document').ready(function(){
	E('keyw').focus();
});
</script>