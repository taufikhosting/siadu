<script type="text/javascript" language="javascript">
function cekMID(e) {
	var mid=E('mid').value;
	if(mid!=''){
		if (e.keyCode == 13) {
			
		}
	} else {
		E('btnstart').style.display='none';
	}
}
</script>
<form action="<?=RLNK?>loan.php" method="get" style="padding:0;margin:0">
<table class="stable" cellspacing="0" cellpadding="0"><tr>
	<td width="150px">Begin transaction with:</td>
	<td><?=iText('mid','','width:200px;height:24px','member id')?></td>
	<td>
		<input id="btnstart" type="submit" class="btnx" value="Start" style="margin-left:5px"/>
	</td>
</tr></table>
</form>
<script type="text/javascript" language="javascript">
	$("document").ready(function (){
		E('mid').focus();
	});
</script>