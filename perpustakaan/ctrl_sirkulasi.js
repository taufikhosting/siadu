function sirkulasi_get(){
	var c=['ct_pinjam','ct_kembali','ct_telat','ct_ttelat','ct_siswa','ct_pegawai','ct_lain'];
	var d=['ct_periode','stanggal1','stanggal2','gptab_index'];
	gPage("sirkulasi",gpage_purl(d)+fform_purlcheck(c));
}
function sirkulasi_peminjaman_form(o,cid,g){
	var f=[['member_id'],['member_tipe'],['tanggal1'],['tanggal2'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"sirkulasi_peminjaman",sirkulasi_get,f,'',0,function(){Efoc("sbuku");});
}
function sirkulasi_ct_tanggal(a){
	var tgl_f=E("tanggal_f").value;
	var tgl_c=E("tanggal_c").value;
	var tgl_l=E("tanggal_l").value;
	if(a==1){ // hari ini
		inputdateSetDate("stanggal1",tgl_c);
		inputdateSetDate("stanggal2",tgl_c);
	}
	else if(a==2){
		inputdateSetDate("stanggal1",tgl_f);
		inputdateSetDate("stanggal2",tgl_l);
	}
	else if(a==3){
		inputdateSetDate("tanggal1",tgl_f);
		inputdateSetDate("tanggal2",tgl_c);
	}
}
/* buku */
function sirkulasi_peminjaman_form_buku_list_cari(event){
	if(event.which == 13){sirkulasi_peminjaman_form_buku_list_open();}
}
function sirkulasi_peminjaman_form_buku_list_open(){
	var sbuku=E("sbuku").value;
	if(sbuku!=""){
		_("sirkulasi_peminjaman_form_buku_cari&sbuku="+sbuku,function(r){
			if(r=="1"){
				sirkulasi_peminjaman_form_buku_get();
				E("sbuku").value="";
				Efoc("sbuku");
			}
			else if(r=="2"){
				sirkulasi_peminjaman_form_buku_form('af',0,false,function(){
					EHide("fform2_yes_btn");
					E("xtable3_keyword").value=sbuku;
					E('xtable3_page_search').value=1;
					sirkulasi_peminjaman_form_buku_list_get(1);
				});
			}
		});
	} else {
		sirkulasi_peminjaman_form_buku_form('af',0,false,function(){
			EHide("fform2_yes_btn");
		});
	}
}
function sirkulasi_peminjaman_form_buku_get(){
	_("sirkulasi_peminjaman_form_buku_get",function(r){
		EHtml("box_sirkulasi_peminjaman_form_buku",r);
		E("sbuku").value="";
		Efoc("sbuku");
		//callNotifbox("box_sirkulasi_peminjaman_form_buku");
	});
}
function sirkulasi_peminjaman_form_buku_form(o,cid,g,fcb){
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var f=[]; var s="";
	if(o=='a'){
		s+="&data="+E("xtable3_selectedid").value;
	}
	fform2_std(o,cid,g,"sirkulasi_peminjaman_form_buku",sirkulasi_peminjaman_form_buku_get,f,s,0,fcb);
}
function sirkulasi_peminjaman_form_buku_list_get(){
	var d=['ff2_lokasi'];
	
	_("sirkulasi_peminjaman_form_buku_list_get"+fform_purl(d)+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_peminjaman_form_buku_list",r);
	});
}
function sirkulasi_peminjaman_form_buku_list_cek(cekall,ncek){
	EDisplay("fform2_yes_btn",(ncek>0));
}

/* member */
function sirkulasi_peminjaman_form_member_list_cari(event){
	if(event.which == 13){sirkulasi_peminjaman_form_member_list_open();}
}
function sirkulasi_peminjaman_form_member_list_open(){
	var smember=E("smember").value;
	if(smember!=""){
		sirkulasi_peminjaman_form_member_form('af',0,false,function(){
			//EHide("fform2_yes_btn");
			E("xtable3_keyword").value=smember;
			E('xtable3_page_search').value=1;
			sirkulasi_peminjaman_form_member_list_siswa_get(1);
		});
	} else {
		sirkulasi_peminjaman_form_member_form('af',0,false,function(){
			//EHide("fform2_yes_btn");
		});
	}
}
function sirkulasi_peminjaman_form_member_get(){
	_("sirkulasi_peminjaman_form_member_get",function(r){
		EHtml("box_sirkulasi_peminjaman_form_member",r);
		E("smember").value="";
		Efoc("smember");
		//callNotifbox("box_sirkulasi_peminjaman_form_member");
	});
}
function sirkulasi_peminjaman_form_member_form(o,cid,g,fcb){
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var f=[]; var s="";
	if(o=='a'){
		s+="&data="+E("xtable3_selectedid").value;
	}
	fform2_std(o,cid,g,"sirkulasi_peminjaman_form_member",sirkulasi_peminjaman_form_member_get,f,s,0,fcb);
}
function sirkulasi_peminjaman_form_member_list_get(){	
	_("sirkulasi_peminjaman_form_member_list_get"+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_peminjaman_form_member_list",r);
	});
}
function sirkulasi_peminjaman_form_member_list_cek(cekall,ncek){
	EDisplay("fform2_yes_btn",(ncek>0));
}

function sirkulasi_peminjaman_form_member_list_siswa_get(a){
	var d=['ff2_departemen','ff2_tahunajaran','ff2_tingkat','ff2_kelas'];
	var s="";
	if(a==1) s=fform_purl(d);
	_("sirkulasi_peminjaman_form_member_list_siswa_get"+s+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_peminjaman_form_member_list",r);
	});
}
function sirkulasi_peminjaman_form_member_list_pegawai_get(a){
	_("sirkulasi_peminjaman_form_member_list_pegawai_get"+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_peminjaman_form_member_list",r);
	});
}
function sirkulasi_peminjaman_form_member_list_lain_get(a){
	_("sirkulasi_peminjaman_form_member_list_lain_get"+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_peminjaman_form_member_list",r);
	});
}
function sirkulasi_peminjaman_form_member_set(mtipe,id){
	_("sirkulasi_peminjaman_form_member_get&mtipe="+mtipe+"&cid="+id,function(r){
		EHtml("box_sirkulasi_peminjaman_form_member",r);
		close_fform2();
	});
}

// ----------------------------------------------------
function sirkulasi_pengembalian_form(o,cid,g){
	var f=[];
	fform_std(o,cid,g,"sirkulasi_pengembalian",sirkulasi_get,f,'',0,function(){Efoc("sbuku");});
}

function sirkulasi_pengembalian_form_buku_list_cari(event){
	if(event.which == 13){sirkulasi_pengembalian_form_buku_list_open();}
}
function sirkulasi_pengembalian_form_buku_list_open(){
	var sbuku=E("sbuku").value;
	if(sbuku!=""){
		_("sirkulasi_pengembalian_form_buku_cari&sbuku="+sbuku,function(r){
			if(r=="1"){
				sirkulasi_pengembalian_form_buku_get();
				E("sbuku").value="";
				Efoc("sbuku");
			}
			else if(r=="2"){
				sirkulasi_pengembalian_form_buku_form('af',0,false,function(){
					EHide("fform2_yes_btn");
					E("xtable3_keyword").value=sbuku;
					E('xtable3_page_search').value=1;
					sirkulasi_pengembalian_form_buku_list_get(1);
				});
			}
		});
	} else {
		sirkulasi_pengembalian_form_buku_form('af',0,false,function(){
			EHide("fform2_yes_btn");
		});
	}
}
function sirkulasi_pengembalian_form_buku_get(){
	_("sirkulasi_pengembalian_form_buku_get",function(r){
		EHtml("box_sirkulasi_pengembalian_form_buku",r);
		E("sbuku").value="";
		Efoc("sbuku");
		//callNotifbox("box_sirkulasi_pengembalian_form_buku");
	});
}
function sirkulasi_pengembalian_form_buku_form(o,cid,g,fcb){
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var f=[]; var s="";
	if(o=='a'){
		s+="&data="+E("xtable3_selectedid").value;
	}
	fform2_std(o,cid,g,"sirkulasi_pengembalian_form_buku",sirkulasi_pengembalian_form_buku_get,f,s,0,fcb);
}
function sirkulasi_pengembalian_form_buku_list_get(){
	var d=['ff2_lokasi'];
	
	_("sirkulasi_pengembalian_form_buku_list_get"+fform_purl(d)+xtable3_pageparam(),function(r){
		EHtml("box_sirkulasi_pengembalian_form_buku_list",r);
	});
}
function sirkulasi_pengembalian_form_buku_list_cek(cekall,ncek){
	EDisplay("fform2_yes_btn",(ncek>0));
}
function sirkulasi_pengembalian_item_form(o,cid,g){
	fform_std(o,cid,g,"sirkulasi_pengembalian_item",sirkulasi_get);
}