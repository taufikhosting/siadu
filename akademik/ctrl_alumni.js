/** Halaman alumni **/
function alumni_get(r){
	var d=['departemen','tahunlulus'];
	gPage("alumni",gpage_purl(d));
}
function alumni_list_get(){
	var d=['ff_departemen','ff_angkatan','tahunlulus'];
	
	_("alumni_list_get"+fform_purl(d)+xtable2_pageparam(),function(r){
		EHtml("box_alumni_list",r);
	});
}
function alumni_list_cek(cekall,ncek){
	EDisplay("fform_yes_btn",(ncek>0));
}
function alumni_form(o,cid,g){
	var d=['tahunlulus'];
	var s=fform_purl(d);
	var f=[];
	if(o=='a'){
		s+="&data="+E("xtable2_selectedid").value;
	} else if(o=='u'){
		f.push(['keterangan','',false]);
	}
	fform_std(o,cid,g,"alumni",alumni_get,f,s,0,function(){
		if(o=='af') EHide("fform_yes_btn");
	});
}

/** Halaman alumni_tahunlulus **/
function alumni_tahunlulus_get(r){
	var d=['departemen','tahunlulus'];
	gPage("alumni",gpage_purl(d));
}
function alumni_tahunlulus_form(o,cid,g){
	var d=['departemen'];
	var f=[['nama','Tahun kelulusan']];
	fform_std(o,cid,g,"alumni_tahunlulus",alumni_tahunlulus_get,f,fform_purl(d));
}