<?php
$page_link=RLNK."bibliographic.php?tab=catalog";
?>
<script type="text/javascript" language="javascript">
	function del(a){
		_("a_catalog&opt=df&cid="+a,function(r){
			E('fform').innerHTML=r;
			open_fform();
		});
	}
	function doDel(a){
		var redir=E('redir').value;
		redir=redir.replace("?","&");
		var v="a_catalog&opt=d&cid="+a+"&redir="+redir;
		_(v,function(r){
			E('tcatalog').innerHTML=r;
			close_fform();
		});
	}
	function goSearch(a){
		jumpTo('<?=$page_link?>&q='+a);
	}
</script>
