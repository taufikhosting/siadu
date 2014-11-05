<?php
$page_link=RLNK."bibliographic.php?tab=catalog";
?>
<script type="text/javascript" language="javascript">
	function finishStock(){
		_("a_stock_rep&opt=dn",function(r){
			E('fform').innerHTML=r;
			open_fform();
		});
	}
	function doFinishStock(){
		_("a_stock_rep&opt=finish",function(r){
			if(r!=''){
				E('fform').innerHTML=r;
				setTimeout("jumpTo('<?=RLNK?>stockopname.php')",1000);
			} else {
				close_fform();
				alert('Failed to finish current stock opname. Please contact your administrator!');
			}
		});
	}
</script>
