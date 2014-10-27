function nilairapor_get(r){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	gPage("nilairapor",gpage_purl(d));
}
function nilairapor_komen_form(o,cid,g){
	var d=['tahunajaran'];
	var f=[['komen','',true]];
	fform_std(o,cid,g,"nilairapor_komen",function(r){
		E("ket_"+cid).innerHTML=r;
		//callNotifbox("page");
	},f,fform_purl(d));
}
function nilairapor_print(a,nis){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	window.open("print.php?doc=nilairapor&docname=Rapor Siswa - NIS: "+nis+"&token="+a+fform_purl(d),"_blank");
}
function nilairapor_download(a,nis){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	window.open("print.php?filetype=xls&doc=nilairapor&docname=Rapor Siswa - NIS: "+nis+"&token="+a+fform_purl(d),"_blank");
}