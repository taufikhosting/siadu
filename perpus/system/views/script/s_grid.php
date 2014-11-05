<script type="text/javascript" language="javascript">
function retDetail(a){
	_('pb_detail&cid='+a,function(r){E('book_info').innerHTML=r;ffade('book_info',0.3)});
	//E('book_info').style.opacity='1';
}
function getBookDetail(a){
	var cid=E('bookid').value;
	if(cid!=a){
	E('book_info').style.opacity='0.25';
	setTimeout("retDetail("+a+")",250);
	}
}
</script>