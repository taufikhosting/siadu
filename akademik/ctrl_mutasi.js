/** Halaman mutasi **/
function mutasi_get(r){
	var d=['departemen'];
	gPage("mutasi",gpage_purl(d));
}
function mutasi_form(o,cid,g){
	var d=['departemen'];
	var s=fform_purl(d);
	var f=[['siswa','Siswa'],['jenismutasi','Jenis mutasi',true,'s'],['tanggal','Tanggal',true,'t'],['keterangan','',false]];
	fform_std(o,cid,g,"mutasi",mutasi_get,f,s,0,function(){Efoc("mutasi_siswa_btn");});
}

function mutasi_jenismutasi_form(o,cid,g){
	var f=[['nama','Jenis mutasi']];
	fform_std2(o,cid,g,"mutasi_jenismutasi",function(r){
		E("jenismutasi").innerHTML=r;
	},f);
}

function mutasi_siswa_formlist(){
	var d=['departemen'];
	_("mutasi_siswa"+fform_purl(d),function(r){
		open_fform2(r);
	});
}
function mutasi_siswa_list_get(){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	_("mutasi_siswa_list_get"+fform_purl(d)+xtable2_pageparam(),function(r){
		EHtml("box_mutasi_siswa_list",r);
	});
}
function mutasi_siswa_set(id,nis,nama){
	E("siswa").value=id;
	E("snis").value=nis;
	E("ssiswa").value=nama;
	close_fform2();
}