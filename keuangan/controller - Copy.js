/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		E("qcari").focus();
		E("qcari").value=E("qcari").value;
	}
	else if(PCBCODE=='jenispenerimaan_warn_add'){
		jenispenerimaan_form('af');
	}
	else if(PCBCODE=='tpo_focnominal'){
		var id=E("tpo_first_itemid").value;
		//alert(id);
		tpo_lain_transaksi_list_form('uf',id);
	}
	PCBCODE=0;
}
function EscapeFunction(){
	ESCCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman tahunbuku **/
function tahunbuku_get(){
	gPage("tahunbuku");
}
function tahunbuku_form(o,cid,g){
	var f=[['nama','Nama tahun buku'],['kode','Kode awalan kwitansi',true,'w',10],['tanggal1','Tanggal dibuka',true,'t'],['keterangan','',false]];
	fform_std(o,cid,g,"tahunbuku",tahunbuku_get,f);
}
function tahunbuku_status_form(o,cid,g){
	var f=[['aktif']];
	fform_std(o,cid,g,"tahunbuku_status",tahunbuku_get,f);
}
/** Halaman kategorirek **/
function kategorirek_get(){
	gPage("kategorirek");
}
function kategorirek_form(o,cid,g){
	var f=[['nama','Nama tahun buku'],['keterangan','',false]];
	fform_std(o,cid,g,"kategorirek",kategorirek_get,f);
}
/** Halaman rekening **/
function rekening_get(){
	var d=['skategorirek'];
	gPage("rekening",gpage_purl(d));
}
function rekening_form(o,cid,g){
	var d=['skategorirek'];
	var f=[['kategorirek'],['kode','',true,'w',10],['nama','Nama tahun buku'],['keterangan','',false]];
	if(E('skategorirek').value!='0'){
		f=[['kode','',true,'w',10],['kategorirek'],['nama','Nama tahun buku'],['keterangan','',false]];
	}
	fform_std(o,cid,g,"rekening",rekening_get,f,fform_purl(d));
}
function rekening_setkode(){
	var k=E('kategorirek').value;
	var ck=0;
	if(E('kode').value!='') ck=parseInt(E('kode').value);
	if(k!='0' && (E('kode').value=='' || (ck>=1 && ck<=7))){
		E('kode').value=k;
	}
}

/** Halaman pspendaftaran **/
function pspendaftaran_get(){
	var d=['departemen','proses','kelompok','modeview'];
	gPage("pspendaftaran",gpage_purl(d));
}
function pspendaftaran_form(o,cid,g){
	var d=['departemen','proses','kelompok'];
	var f=[['bayar','',false],['uang','Nominal pembayaran',true,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"pspendaftaran",pspendaftaran_get,f,fform_purl(d));
}
function pspendaftaran_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','calonsiswa','nominaljttcalon'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true; var conf=true;
	if(o=='a') conf=confirm("Data sudah benar?");
	if(conf) fform_std(o,cid,g,"pspendaftaran_transaksi",pspendaftaran_get,f,fform_purl(d));
}
function pspendaftaran_jenispenerimaan_form(o,cid,g){
	var d=['kategoripenerimaan','proses'];
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['rekpiutang','Rek. Piutang'],['keterangan','',false]];
	fform_std(o,cid,g,"pspendaftaran_jenispenerimaan",pspendaftaran_get,f,fform_purl(d));
}

/** Halaman psuangpangkal **/
function psuangpangkal_get(){
	var d=['departemen','angkatan'];
	gPage("psuangpangkal",gpage_purl(d));
}
function psuangpangkal_form(o,cid,g){
	var d=['departemen','proses','kelompok'];
	var f=[['bayar','',false],['uang','Nominal pembayaran',true,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"psuangpangkal",psuangpangkal_get,f,fform_purl(d));
}
function psuangpangkal_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa','nominaljtt'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"psuangpangkal_transaksi",psuangpangkal_get,f,fform_purl(d));
}
function psuangpangkal_jenispenerimaan_form(o,cid,g){
	var d=['kategoripenerimaan','angkatan'];
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['rekpiutang','Rek. Piutang'],['keterangan','',false],
			['departemen'],['angkatan']
		  ];
	fform_std(o,cid,g,"psuangpangkal_jenispenerimaan",psuangpangkal_get,f,fform_purl(d));
}
function psuangpangkal_siswa_get(){
	var d=['departemen','angkatan'];
	_("psuangpangkal_siswa_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_psuangpangkal_proses");
		EHtml("box_psuangpangkal_siswa_get",r);
	});
}
function psuangpangkal_siswa_proses(){
	var d=['jenispenerimaan','siswa','modeview'];
	_("psuangpangkal_siswa_proses"+fform_purl(d),function(r){
		EHtml("box_psuangpangkal_proses",r);
		EShow("box_psuangpangkal_proses");
		callNotifbox("box_psuangpangkal_proses");
	});
}
function psuangpangkal_siswa_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','siswa'];
	var f=[['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['keterangan','Alasan perubahan',false]];
	if(o=='u') f[2][2]=true;
	fform_std(o,cid,g,"psuangpangkal_siswa_pembayaran",psuangpangkal_siswa_proses,f,fform_purl(d));
}
function psuangpangkal_siswa_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa','nominaljtt'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"psuangpangkal_siswa_transaksi",psuangpangkal_siswa_proses,f,fform_purl(d));
}

/** Halaman psuangsekolah **/
function psuangsekolah_get(){
	var d=['departemen','tahunajaran'];//,'tingkat','kelas'];
	gPage("psuangsekolah",gpage_purl(d));
}
function psuangsekolah_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa','nominaljtt'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"psuangsekolah_transaksi",psuangsekolah_get,f,fform_purl(d));
}
function psuangsekolah_jenispenerimaan_form(o,cid,g){
	var d=['kategoripenerimaan','departemen','tahunajaran'];
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['rekpiutang','Rek. Piutang'],['keterangan','',false]];
	fform_std(o,cid,g,"psuangsekolah_jenispenerimaan",psuangsekolah_get,f,fform_purl(d));
}
function psuangsekolah_siswa_get(){
	var d=['departemen','tingkat','kelas','tahunajaran'];
	_("psuangsekolah_siswa_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_psuangsekolah_proses");
		EHtml("box_psuangsekolah_siswa_get",r);
	});
}
function psuangsekolah_siswa_proses(){
	var d=['jenispenerimaan','siswa','modeview'];
	_("psuangsekolah_siswa_proses"+fform_purl(d),function(r){
		EHtml("box_psuangsekolah_proses",r);
		EShow("box_psuangsekolah_proses");
		callNotifbox("box_psuangsekolah_proses");
	});
}
function psuangsekolah_siswa_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','siswa'];
	var f=[['keterangan','Alasan perubahan',false],['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['tanggal','',true,'t']]; if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"psuangsekolah_siswa_pembayaran",psuangsekolah_siswa_proses,f,fform_purl(d));
}
function psuangsekolah_siswa_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa','nominaljtt'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"psuangsekolah_siswa_transaksi",psuangsekolah_siswa_proses,f,fform_purl(d));
}

/** Halaman jenispenerimaan **/
function jenispenerimaan_get(){
	var d=['kategoripenerimaan'];
	gPage("jenispenerimaan",gpage_purl(d));
}
function jenispenerimaan_form(o,cid,g){
	var d=['kategoripenerimaan'];
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['rekpiutang','Rek. Piutang'],['keterangan','',false],['nominal','Jumlah pembayaran',false,'c'],['cicilan','Besar cicilan',false,'c']];
	fform_std(o,cid,g,"jenispenerimaan",jenispenerimaan_get,f,fform_purl(d));
}
function jenispenerimaan_rek_get(){
	var d=['kategorirek','rek'];
	_("jenispenerimaan_rek_get&xtable_pagenumber="+page_number+fform_purl(d),function(r){
		EHtml("data_rekening",r);
		Efoc("kategorirek");
	});
}
function jenispenerimaan_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	
	_("jenispenerimaan_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform2(r);
		Efoc("kategorirek");
	});
}
function jenispenerimaan_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform2();
}
function jenispenerimaan_uangpangkal_get(){
	var d=['departemen','angkatan'];
	_("jenispenerimaan_uangpangkal_get"+fform_purl(d),function(r){
		EHtml("box_jenispenerimaan_uangpangkal",r);
	});
}
function jenispenerimaan_pendaftaran_get(){
	var d=['departemen','proses','kelompok'];
	_("jenispenerimaan_pendaftaran_get"+fform_purl(d),function(r){
		EHtml("box_jenispenerimaan_pendaftaran",r);
	});
}
/** Halaman transaksipenerimaan **/
function transaksipenerimaan_get(){
	var d=['kategoripenerimaan','jenispenerimaan'];
	gPage("transaksipenerimaan",gpage_purl(d));
}
function transaksipenerimaan_form(o,cid,g){
	var d=['departemen','proses','kelompok'];
	var f=[['bayar','',false],['uang','Nominal pembayaran',true,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"transaksipenerimaan",transaksipenerimaan_get,f,fform_purl(d));
}
// Transakasi penerimaan siswa jtt
function tpi_siswa_get(){
	var d=['kategoripenerimaan','jenispenerimaan','psdepartemen','psangkatan','pstahunbuku','pstingkat','pskelas'];
	_("tpi_siswa_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_tpi_proses");
		EHtml("box_tpi_siswa_get",r);
	});
}
function tpi_siswa_proses(){
	var d=['jenispenerimaan','siswa'];
	_("tpi_siswa_proses"+fform_purl(d),function(r){
		EHtml("box_tpi_proses",r);
		EShow("box_tpi_proses");
		callNotifbox("box_tpi_proses");
	});
}
function tpi_siswa_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','siswa'];
	var f=[['keterangan','Alasan perubahan',false],['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['tanggal','',true,'t']]; if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_siswa_pembayaran",tpi_siswa_proses,f,fform_purl(d));
}
function tpi_siswa_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa','nominaljtt'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_siswa_transaksi",tpi_siswa_proses,f,fform_purl(d));
}

// Transakasi penerimaan siswa skr
function tpi_siswa_skr_get(){
	var d=['psdepartemen','pstahunbuku','pstingkat','pskelas'];
	_("tpi_siswa_skr_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_tpi_proses");
		EHtml("box_tpi_siswa_get",r);
	});
}
function tpi_siswa_skr_proses(){
	var d=['jenispenerimaan','siswa'];
	_("tpi_siswa_skr_proses"+fform_purl(d),function(r){
		EHtml("box_tpi_proses",r);
		EShow("box_tpi_proses");
		callNotifbox("box_tpi_proses");
	});
}
function tpi_siswa_skr_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','siswa'];
	var f=[['keterangan','Keterangan perubahan',false],['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['tanggal','',true,'t']]; if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_siswa_skr_pembayaran",tpi_siswa_skr_proses,f,fform_purl(d));
}
function tpi_siswa_skr_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','siswa'];
	var f=[['trans_nominal','Nominal pembayaran',true,'c'],['trans_keterangan','Keterangan perubahan',false],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[1][2]=true;
	fform_std(o,cid,g,"tpi_siswa_skr_transaksi",tpi_siswa_skr_proses,f,fform_purl(d));
}

// Transakasi penerimaan calonsiswa jtt
function tpi_calonsiswa_get(){
	var d=['kategoripenerimaan','jenispenerimaan','departemen','proses','kelompok','jenispenerimaan','calonsiswa'];
	_("tpi_calonsiswa_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_tpi_proses");
		EHtml("box_tpi_siswa_get",r);
	});
}
function tpi_calonsiswa_proses(){
	var d=['jenispenerimaan','calonsiswa'];
	_("tpi_calonsiswa_proses"+fform_purl(d),function(r){
		EHtml("box_tpi_proses",r);
		EShow("box_tpi_proses");
		callNotifbox("box_tpi_proses");
	});
}
function tpi_calonsiswa_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','calonsiswa'];
	var f=[['keterangan','Alasan perubahan',false],['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['tanggal','',true,'t']]; if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_calonsiswa_pembayaran",tpi_calonsiswa_proses,f,fform_purl(d));
}
function tpi_calonsiswa_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','calonsiswa','nominaljttcalon'];
	var f=[['trans_keterangan','Keterangan perubahan',false],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_calonsiswa_transaksi",tpi_calonsiswa_proses,f,fform_purl(d));
}

// Transakasi penerimaan calonsiswa skr
function tpi_calonsiswa_skr_get(){
	var d=['departemen','proses','kelompok'];
	_("tpi_calonsiswa_skr_get"+xtable_pageparam()+fform_purl(d),function(r){
		EHide("box_tpi_proses");
		EHtml("box_tpi_siswa_get",r);
	});
}
function tpi_calonsiswa_skr_proses(){
	var d=['jenispenerimaan','calonsiswa'];
	_("tpi_calonsiswa_skr_proses"+fform_purl(d),function(r){
		EHtml("box_tpi_proses",r);
		EShow("box_tpi_proses");
		callNotifbox("box_tpi_proses");
	});
}
function tpi_calonsiswa_skr_pembayaran_form(o,cid,g){
	var d=['jenispenerimaan','calonsiswa'];
	var f=[['keterangan','Keterangan perubahan',false],['nominal','Nominal pembayaran',true,'c'],['cicilan','Besar cicilan',true,'c'],['tanggal','',true,'t']]; if(o=='u') f[0][2]=true;
	fform_std(o,cid,g,"tpi_calonsiswa_skr_pembayaran",tpi_calonsiswa_skr_proses,f,fform_purl(d));
}
function tpi_calonsiswa_skr_transaksi_form(o,cid,g){
	var d=['jenispenerimaan','calonsiswa'];
	var f=[['trans_nominal','Nominal pembayaran',true,'c'],['trans_keterangan','Keterangan perubahan',false],['trans_tanggal','Tanggal pembayaran',true,'t']];
	if(o=='u') f[1][2]=true;
	fform_std(o,cid,g,"tpi_calonsiswa_skr_transaksi",tpi_calonsiswa_skr_proses,f,fform_purl(d));
}

/** Halaman jenispenerimaanlain **/
function jenispenerimaanlain_get(){
	gPage("jenispenerimaanlain");
}
function jenispenerimaanlain_form(o,cid,g){
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['keterangan','',false]];
	fform_std(o,cid,g,"jenispenerimaanlain",jenispenerimaanlain_get,f);
}
function jenispenerimaanlain_rek_get(){
	var d=['kategorirek','rek'];
	_("jenispenerimaanlain_rek_get&xtable_pagenumber="+page_number+fform_purl(d),function(r){
		EHtml("data_rekening",r);
		Efoc("kategorirek");
	});
}
function jenispenerimaanlain_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	_("jenispenerimaanlain_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform2(r);
		Efoc("kategorirek");
	});
}
function jenispenerimaanlain_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform2();
}

/** Halaman transaksipenerimaanlain **/
function transaksipenerimaanlain_get(){
	var d=['jenispenerimaanlain'];
	gPage("transaksipenerimaanlain",gpage_purl(d));
}
function transaksipenerimaanlain_form(o,cid,g){
	var d=['jenispenerimaanlain'];
	var f=[['trans_sumber','Sumber'],['trans_nominal','Nominal pembayaran',true,'c'],['trans_tanggal','Tanggal pembayaran',true,'t'],['trans_keterangan','Keterangan perubahan',false]];
	if(o=='u') f[2][2]=true;
	fform_std(o,cid,g,"transaksipenerimaanlain",transaksipenerimaanlain_get,f,fform_purl(d));
}

/** Halaman Pengeluaran Lain **/
function tpo_lain_get(){
	_("tpo_lain_get",function(r){
		EHtml("box_tpo_lain",r);
		callNotifbox("box_tpo_lain_proses");
	});
}
function tpo_lain_form(o,cid,g){
	var f=[['nama','Nama jenis pengeluaran'],['rekkas','Rek. Kas'],['rekbeban','Rek. Beban'],['keterangan','',false],['periode','Periode',false,'s']];
	fform_std(o,cid,g,"tpo_lain",tpo_lain_get,f);
}
function tpo_lain_rek_get(){
	var d=['kategorirek','rek'];
	_("tpo_lain_rek_get&xtable_pagenumber="+page_number+fform_purl(d),function(r){
		EHtml("data_rekening",r);
		Efoc("kategorirek");
	});
}
function tpo_lain_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	_("tpo_lain_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform2(r);
		Efoc("kategorirek");
	});
}
function tpo_lain_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform2();
}
function tpo_lain_proses(){
	var d=['jenispengeluaran','modeview'];
	_("tpo_lain_proses"+fform_purl(d),function(r){
		EHtml("box_tpo_lain_proses",r);
		EShow("box_tpo_lain_proses");
		callNotifbox("box_tpo_lain_proses");
		if(PCBCODE=='tp_trans'){
			tpo_lain_transaksi_form('af');
			PCBCODE=0;
		}
		if(E('jenispengeluaran').value!='0') EShow('tpo_showallbtn');
		else EHide('tpo_showallbtn');
	});
}
function tpo_lain_transaksi_form(o,cid,g){
	var d=['jenispengeluaran'];
	var f=[['rekkas','Rekening Kas/Bank',true,'fv'],['trans_tanggal','Tanggal pembayaran',true,'t'],['trans_num','Item pengeluaran',true,'dm']];
	if(E('jenispengeluaran').value!='0'||o=='u'){
		f=[['trans_nominal','Nominal pembayaran',true,'c'],['trans_keterangan','Keterangan perubahan',false],['trans_transaksi','Transaksi'],['rekkas','Rekening Kas/Bank',true,'fv'],['rekbeban','Rekening beban',true,'fv'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	}
	fform_std(o,cid,g,"tpo_lain_transaksi",tpo_lain_proses,f,fform_purl(d));
}
function tpo_lain_transaksi_list_get(){
	_("tpo_lain_transaksi_list_get",function(r){
		EHtml("box_tpo_lain_transaksi_list",r);
	});
}
function tpo_lain_transaksi_list_form(o,cid,g){
	var d=['jenispengeluaran'];
	var f=[['trans_list_transaksi','Transaksi'],['rekbeban','Rekening beban',true,'fv'],['trans_list_nominal','Nominal pembayaran',true,'c'],['trans_list_keterangan','Keterangan perubahan',false]];
	if(E('jenispengeluaran').value!='0'){
		f=[['trans_list_nominal','Nominal pembayaran',true,'c'],['trans_list_transaksi','Transaksi'],['rekbeban','Rekening beban',true,'fv'],['trans_list_keterangan','Keterangan perubahan',false]];
	}
	fform_std2(o,cid,g,"tpo_lain_transaksi_list",tpo_lain_transaksi_list_get,f,fform_purl(d));
}
function tpo_lain_transaksi_list_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	_("tpo_lain_transaksi_list_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform3(r);
		Efoc("kategorirek");
	});
}
function tpo_lain_transaksi_list_rekauto(){
	var trans=E('trans_list_transaksi').value;
	if(trans.length>2){
		_("tpo_lain_transaksi_list_rek_auto&trans="+trans,function(r){
			if(r!=""){
				var d=r.split("~");
				tpo_lain_transaksi_list_rek_set("beban",d[0],d[1]);
			}
		});
	} else if(trans==""){
		if(E("rekbeban").value!="0"){
			tpo_lain_transaksi_list_rek_set("beban",0,"");
		}
	}
}
function tpo_lain_transaksi_list_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform3();
}


/** Halaman Penerimaan Lain **/
function tpi_lain_get(){
	_("tpi_lain_get",function(r){
		EHtml("box_tpi_lain",r);
		callNotifbox("box_tpi_lain_proses");
	});
}
function tpi_lain_form(o,cid,g){
	var f=[['nama','Nama jenis penerimaan'],['rekkas','Rek. Kas'],['rekpendapatan','Rek. Pendapatan'],['keterangan','',false],['periode','Periode',false,'s']];
	fform_std(o,cid,g,"tpi_lain",tpi_lain_get,f);
}
function tpi_lain_rek_get(){
	var d=['kategorirek','rek'];
	_("tpi_lain_rek_get&xtable_pagenumber="+page_number+fform_purl(d),function(r){
		EHtml("data_rekening",r);
		Efoc("kategorirek");
	});
}
function tpi_lain_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	_("tpi_lain_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform2(r);
		Efoc("kategorirek");
	});
}
function tpi_lain_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform2();
}
function tpi_lain_proses(){
	var d=['jenispenerimaan','modeview'];
	_("tpi_lain_proses"+fform_purl(d),function(r){
		EHtml("box_tpi_lain_proses",r);
		EShow("box_tpi_lain_proses");
		callNotifbox("box_tpi_lain_proses");
		if(PCBCODE=='tp_trans'){
			tpi_lain_transaksi_form('af');
			PCBCODE=0;
		}
		if(E('jenispenerimaan').value!='0') EShow('tpi_showallbtn');
		else EHide('tpi_showallbtn');
	});
}
function tpi_lain_transaksi_form(o,cid,g){
	var d=['jenispenerimaan'];
	var f=[['rekkas','Rekening Kas/Bank',true,'fv'],['trans_tanggal','Tanggal pembayaran',true,'t'],['trans_num','Item penerimaan',true,'dm']];
	if(E('jenispenerimaan').value!='0'||o=='u'){
		f=[['trans_nominal','Nominal pembayaran',true,'c'],['trans_keterangan','Keterangan perubahan',false],['trans_transaksi','Transaksi'],['rekkas','Rekening Kas/Bank',true,'fv'],['rekpendapatan','Rekening pendapatan',true,'fv'],['trans_tanggal','Tanggal pembayaran',true,'t']];
	}
	fform_std(o,cid,g,"tpi_lain_transaksi",tpi_lain_proses,f,fform_purl(d));
}
function tpi_lain_transaksi_list_get(){
	_("tpi_lain_transaksi_list_get",function(r){
		EHtml("box_tpi_lain_transaksi_list",r);
	});
}
function tpi_lain_transaksi_list_form(o,cid,g){
	var d=['jenispenerimaan'];
	var f=[['trans_list_transaksi','Transaksi'],['rekpendapatan','Rekening pendapatan',true,'fv'],['trans_list_nominal','Nominal pembayaran',true,'c'],['trans_list_keterangan','Keterangan perubahan',false]];
	if(E('jenispenerimaan').value!='0'){
		f=[['trans_list_nominal','Nominal pembayaran',true,'c'],['trans_list_transaksi','Transaksi'],['rekpendapatan','Rekening pendapatan',true,'fv'],['trans_list_keterangan','Keterangan perubahan',false]];
	}
	fform_std2(o,cid,g,"tpi_lain_transaksi_list",tpi_lain_transaksi_list_get,f,fform_purl(d));
}
function tpi_lain_transaksi_list_rek(a,b){
	b = typeof b !== 'undefined' ? b : 0;
	_("tpi_lain_transaksi_list_rek&rek="+a+"&kategorirek="+b,function(r){
		open_fform3(r);
		Efoc("kategorirek");
	});
}
function tpi_lain_transaksi_list_rekauto(){
	var trans=E('trans_list_transaksi').value;
	if(trans.length>2){
		_("tpi_lain_transaksi_list_rek_auto&trans="+trans,function(r){
			if(r!=""){
				var d=r.split("~");
				tpi_lain_transaksi_list_rek_set("pendapatan",d[0],d[1]);
			}
		});
	} else if(trans==""){
		if(E("rekpendapatan").value!="0"){
			tpi_lain_transaksi_list_rek_set("pendapatan",0,"");
		}
	}
}
function tpi_lain_transaksi_list_rek_set(a,id,rek){
	E("ffval_rek"+a).value=rek;
	E("rek"+a).value=id;
	close_fform3();
}


/** Halaman Laporan **/
function akuntansi_get(){
	var d=['ct_siswajtt','ct_calonsiswajtt','ct_penerimaan','ct_siswaskr','ct_calonsiswaskr','ct_pengeluaran'];
	var e=['gptab_index','tanggal1','tanggal2'];
	gPage("akuntansi",gpage_purlcheck(d)+fform_purl(e));
}
function akuntansi_tab_get(a){
	for(var i=1;i<=4;i++){
		EHide("akuntansi_tab_"+i);
		E("gptab"+i).className="gptab";
	}
	E("gptab_index").value=a;
	EShow("akuntansi_tab_"+a);
	E("gptab"+a).className="gptab1";
}

function laporan_get(){
	var d=['ct_siswajtt','ct_calonsiswajtt','ct_penerimaan','ct_siswaskr','ct_calonsiswaskr','ct_pengeluaran'];
	var e=['gptab_index','tanggal1','tanggal2'];
	gPage("laporan",gpage_purlcheck(d)+fform_purl(e));
}
function laporan_tab_get(a){
	for(var i=1;i<=2;i++){
		EHide("laporan_tab_"+i);
		E("gptab"+i).className="gptab";
	}
	E("gptab_index").value=a;
	EShow("laporan_tab_"+a);
	E("gptab"+a).className="gptab1";
}