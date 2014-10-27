/* buku */
function tools_label_get(){
	_("tools_label_get",function(r){
		EHtml("box_tools_label",r);
		EHide("box_btn_cetaklabel");
		EShow("box_tools_label");
		Efoc("sbuku");
	});
}
function tools_label_cancel(){
	EHide("box_tools_label");
	EShow("box_btn_cetaklabel");
}
function tools_label_cetak(){
	var f=[['cetak_header','',false,'cx'],['cetak_callnumber','',false,'cx'],['cetak_barkode','',false,'cx'],['cetak_lebar','Lebar label',true,'n'],['cetak_ukuran'],['cetak_orientasi'],['cetak_judul'],['cetak_deskripsi']];
	var s=fform_fetchvalue(f);
	window.open("print/label.php?"+s,"_blank");
}
function tools_label_buku_list_cari(event){
	if(event.which == 13){tools_label_buku_list_open();}
}
function tools_label_buku_list_open(){
	var sbuku=E("sbuku").value;
	if(sbuku!=""){
		_("tools_label_buku_cari&sbuku="+sbuku,function(r){
			if(r=="1"){
				tools_label_buku_get();
				E("sbuku").value="";
				Efoc("sbuku");
			}
			else if(r=="2"){
				tools_label_buku_form('af',0,false,function(){
					EHide("fform_yes_btn");
					E("xtable2_keyword").value=sbuku;
					E('xtable2_page_search').value=1;
					tools_label_buku_list_get(1);
				});
			}
		});
	} else {
		tools_label_buku_form('af',0,false,function(){
			EHide("fform_yes_btn");
		});
	}
}
function tools_label_buku_get(){
	_("tools_label_buku_get",function(r){
		EHtml("box_tools_label_buku",r);
		E("sbuku").value="";
		Efoc("sbuku");
		//callNotifbox("box_tools_label_buku");
	});
}
function tools_label_buku_form(o,cid,g,fcb){
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var f=[]; var s="";
	if(o=='a'){
		s+="&data="+E("xtable2_selectedid").value;
	}
	fform_std(o,cid,g,"tools_label_buku",tools_label_buku_get,f,s,0,fcb);
}
function tools_label_buku_list_get(){
	var d=['ff_lokasi'];
	EHide("fform_yes_btn");
	_("tools_label_buku_list_get"+fform_purl(d)+xtable2_pageparam(),function(r){
		EHtml("box_tools_label_buku_list",r);
	});
}
function tools_label_buku_list_cek(cekall,ncek){
	EDisplay("fform_yes_btn",(ncek>0));
}