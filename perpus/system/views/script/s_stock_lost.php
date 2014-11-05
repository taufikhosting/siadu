<?php
$page_link=RLNK."bibliographic.php?tab=catalog";
?>
<script type="text/javascript" language="javascript">
	function addNote(a){
		var ntable=E('ntable').value;
		_("a_stock_lost&opt=nf&lst="+ntable+"&cid="+a,function(r){
			E('fform').innerHTML=r;
			open_fform();
			E('note').focus();
		});
	}
	function doAddNote(a){
		var n=E('note').value;
		var ntable=E('ntable').value;
		var v="a_stock_lost&opt=n&lst="+ntable+"&cid="+a+"&note="+n;
		//alert(v); return;
		_(v,function(r){
			E('xrn'+a).innerHTML=r;
			close_fform();
		});
	}
	function doneNote(){
		var ntable=E('ntable').value;
		var v="a_stock_lost&opt=dn&lst="+ntable;
		_(v,function(r){
			E('fform').innerHTML=r;
			open_fform();
		});
	}
	function goSearch(a){
		jumpTo('<?=$page_link?>&q='+a);
	}
</script>
