<?php if(empty($xtableid)) $xtableid=''; ?>
<script type="text/javascript" language="javascript">
function xtable<?=$xtableid?>_ceknum(){
	var ncek=0; var cekall=0;
	var n=parseInt(E('xt<?=$xtableid?>ceknum').value);
	var s="";
	for(var i=0;i<n;i++){
		if(E('xt<?=$xtableid?>cek'+i).checked){
			ncek++;
			if(s!="")s+=",";
			s+=E('xt<?=$xtableid?>cek'+i).value;
		}
	}
	E('xtable<?=$xtableid?>_selectedid').value=s;
	if(ncek==n){
		E('xt<?=$xtableid?>cekt').checked=true;
		cekall=1;
	} else {
		E('xt<?=$xtableid?>cekt').checked=false;
	}
	if(ncek>0){
		E("xtable<?=$xtableid?>_cek_opt").style.display='';
	} else {
		E("xtable<?=$xtableid?>_cek_opt").style.display='none';
	}
	var cf=E("xtable<?=$xtableid?>_cek_opt_func").value;
	if(cf!=""){
		var param=cekall+","+ncek;
		cf=cf.replace("param",param);
		setTimeout(cf,50);
	}
	return ncek;
}
function xtable<?=$xtableid?>_sel(n){
	var a=!E('xt<?=$xtableid?>cek'+n).checked;
	xtable<?=$xtableid?>_cek(n,a);
}
function xtable<?=$xtableid?>_cek(n,a){
	var id=E('xt<?=$xtableid?>cek'+n).value;
	var rc=0;
	if(E('xtable<?=$xtableid?>_row_strip').value=='1'){
		rc=n%2;
	}
	if(a){
		E('xt<?=$xtableid?>cek'+n).checked=true;
		E('xt<?=$xtableid?>r'+id).className='xtrs';
	} else {
		E('xt<?=$xtableid?>cek'+n).checked=false;
		E('xt<?=$xtableid?>r'+id).className='xtr'+rc;
	}
	xtable<?=$xtableid?>_ceknum();
}
function xtable<?=$xtableid?>_cekall(a){
	var n=parseInt(E('xt<?=$xtableid?>ceknum').value);
	for(var i=0;i<n;i++){
		xtable<?=$xtableid?>_cek(i,a);
	}
	xtable<?=$xtableid?>_ceknum();
}
function xtable<?=$xtableid?>_getceknum(){
	var n=parseInt(E('xt<?=$xtableid?>ceknum').value);
	return n;
}
function xtable<?=$xtableid?>_urut(o,id){
	id = typeof id !== 'undefined' ? id : 0;
	var a=E('xtable<?=$xtableid?>_dbtable').value;
	var p=E('xtable<?=$xtableid?>_fmod').value;
	if(o=='up' || o=='dn'){
		_("_apps&app=urut&table="+a+"&id="+id+"&act="+o+"&page="+p+"&opt=urut",function(r){
			E('page').innerHTML=r;
		});
	} else {
		page_sort=0;
		gPage(p,"&opt="+o);
	}
}
function xtable<?=$xtableid?>_pageparam(){
	var d="";
	var e_usesearch=E("xtable<?=$xtableid?>_usesearch");
	var v_usesearch='0';
	if(e_usesearch!=null){
		v_usesearch=E("xtable<?=$xtableid?>_usesearch").value;
	}
	//alert(E("xtable<?=$xtableid?>_usesearch").value);
	if(v_usesearch=='1'){
		var f=['xtable<?=$xtableid?>_keyword','xtable<?=$xtableid?>_keyon','xtable<?=$xtableid?>_page_number','xtable<?=$xtableid?>_page_sort','xtable<?=$xtableid?>_page_sort_dir','xtable<?=$xtableid?>_page_search'];
	} else {
		var f=['xtable<?=$xtableid?>_page_number','xtable<?=$xtableid?>_page_sort','xtable<?=$xtableid?>_page_sort_dir','xtable<?=$xtableid?>_page_search'];
	}
	for(var i=0;i<f.length;i++){
		var ev=E(f[i]);
		var val='';
		if(ev!=null){
			val=E(f[i]).value;
		}
		d+="&"+f[i]+"="+val;
	}
	return d;
}
function xtable<?=$xtableid?>_cari(event,f){
	//alert(event.which);
	if(event.which == 13){
		f();
	}
}
</script>