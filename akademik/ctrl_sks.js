function sks_get(){
	var d=['tahunajaran'];
	_("sks_get"+fform_purl(d),function(r){
		EHtml("box_sks",r);
	});
}
function sks_form(o,cid,g){
	var d=['tahunajaran','sks_kelas'];
	var f=[['pelajaran','Mata pelajaran',true,'s'],['guru','Guru',true,'s'],['njam','Jumlah jam',true,'dm',1],['salin','',false,'cx']];
	fform_std(o,cid,g,"sks",sks_get,f,fform_purl(d));
}

/* guru */
function sks_guru_formlist(){
	var d=['tahunajaran','pelajaran'];
	_("sks_guru"+fform_purl(d),function(r){
		open_fform2(r);
	});
}
function sks_guru_list_get(){
	var d=['tahunajaran','pelajaran'];
	_("sks_guru_list_get"+fform_purl(d)+xtable3_pageparam(),function(r){
		EHtml("box_sks_guru_list",r);
	});
}
function sks_guru_set(id,nama){
	E("guru").value=id;
	E("sguru").value=nama;
	close_fform2();
}