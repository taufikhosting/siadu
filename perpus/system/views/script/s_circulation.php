<script type="text/javascript">
function lookUp(){
	var k=E('keyw').value;
	k=k.trim();
	if(k!=''){
	_("a_staff_view&opt=lookup&k="+k,function(r){
		E('emp_result').innerHTML=r;
	});
	}
}
function pqueue(o,k){
	var v="&cid="+k;
	v="a_staff_view&opt="+o+v;
	//alert(v); //return 0;
	_(v,function(r){
		E('qtbl').innerHTML=r;
		lookUp();
		if(r.length>80) EShow('okbtn');
		else EHide('okbtn');
		if(o!='cq') E('keyw').focus();
	});
}
function bookreturn(o,cid,g){
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var ps="a_return&opt="+o+"&cid="+cid;
	if(g){
		ps+="&status="+E('status').value;
		ps+="&dater="+E('dater').value;
		ps+="&fine="+E('fine').value;
	}
	if(o=='af' || o=='uf' || o=='df'||o=='mf')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform()});}
	else{_(ps,function(r){document.location.reload()});}
}
function clearQueue(){
	pqueue('cq',0);
}
</script>