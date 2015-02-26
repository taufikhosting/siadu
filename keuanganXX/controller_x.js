/** Halaman modul **/
function modul_get(){
	var d=['kategori'];
	gPage("modul",gpage_purl(d));
}
function modul_form(o,cid,g){
	var d=['kategori','reftipe','refid','snama'];
	var k=E('reftipe').value;
	if(k==1||k==2||k==3){
		var f=[['rek1','Rekening kas',false,'s'],['rek2','Rekening pendapatan',false,'s'],['rek3','Rekening piutang',false,'s'],['nama','Nama pembayaran'],['nominal','Jml pembayaran',false,'c'],['cicilan','Besar cicilan',false,'c'],['keterangan','',false],['mod_reftipe'],['mod_refid']];
	} else {
		var f=[['nama','Nama pembayaran'],['rek1','Rekening kas',false,'s'],['rek2','Rekening pendapatan',false,'s'],['rek3','Rekening piutang',false,'s'],['nominal','Jml pembayaran',false,'c'],['cicilan','Besar cicilan',false,'c'],['keterangan','',false],['mod_reftipe'],['mod_refid']];
	}
	
	fform_std(o,cid,g,"modul",function(){
		var k=E('reftipe').value;
		if(k==1) modul_spp_get();
		else if(k==2) modul_psb_get();
		else if(k==3) modul_usp_get();
		else modul_get();
	},f,fform_purl(d));
}
function pembayaran_form(o,cid,g){
	var d=['modul','pembayaran'];
	var f=[['rekkas','Rek. Kas/Bank',true,'s'],['trans_tanggal','Tanggal',true,'t'],['trans_pembayaran'],['trans_jenis'],['trans_nomer'],['trans_ct'],['rekitem','Rek. perkiraan',true,'s'],['uraian','Uraian',false],['nominal','Nominal',false,'c']];
			
	fform_std(o,cid,g,"pembayaran",function(){
		var k=E('reftipe').value;
		if(k==1) {pembayaran_proses_get(); siswa_list_kelas_get(1);}
		else if(k==2) modul_psb_get();
		else if(k==3) pembayaran_proses_get();
	},f,fform_purl(d),0,function(){transaksi_getnomer();});
}
function siswa_list_kelas_get(b){
	b = typeof b !== 'undefined' ? b : 0;
	var d=['tahunajaran','tingkat','kelas'];
	_("siswa_list_kelas_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_pembayaran");
		EHtml("box_siswa",r);
		if(E('siswa_list_num').value==1){
			E('siswa').value=E('siswa_list_num').value;
			if(b==0) pembayaran_proses_get();
		}
	});
}
function siswa_list_angkatan_get(){
	var d=['angkatan'];
	_("siswa_list_angkatan_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_pembayaran");
		EHtml("box_siswa",r);
		if(E('siswa_list_num').value==1){
			E('siswa').value=E('siswa_list_num').value;
			pembayaran_proses_get();
		}
	});
}
function pembayaran_proses_get(){
	var d=['modul','reftipe','refid','siswa'];
	_("pembayaran_proses_get"+fform_purl(d),function(r){
		EHtml("box_pembayaran",r);
		EShow("box_pembayaran");
		callNotifbox("box_pembayaran");
	});
}
function pembayaran_data_form(o,cid,g){
	var f=[['nominal','Jumlah pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['keterangan','Keterangan perubahan',true]];
	fform_std(o,cid,g,"pembayaran_data",pembayaran_proses_get,f);
}
function pembayaran_transaksi(o,cid,g){
	
}
// Modul spp: ======================================= //
function modul_spp_get(){
	var d=['departemen','tahunajaran'];
	gPage("modul_spp",gpage_purl(d));
}
// Modul psb: ======================================= //
function modul_psb_get(){
	var d=['departemen','proses','kelompok','tampil'];
	gPage("modul_psb",gpage_purl(d));
}
// Modul usp: ======================================= //
function modul_usp_get(){
	var d=['departemen','angkatan'];
	gPage("modul_usp",gpage_purl(d));
}
