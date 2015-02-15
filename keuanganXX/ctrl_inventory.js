function xtree_folder_toggle(e,a){
	if(e.target == E("xt_"+a)){
		var d=(E("xtbox_"+a).style.display=='none');
		EDisplay("xtbox_"+a,d);
		if(d) E("xt_"+a).className="xtree_folder1";
		else E("xt_"+a).className="xtree_folder0";
	}
}
function xtree_file_select(){
	var xtf_num=parseInt(E("xtf_num").value);
	for(var i=0;i<xtf_num;i++){
		E("xtf_"+i).className='xtree_file0';
	}
	E("xtf_"+E("xtf_sel").value).className='xtree_file1';
	
}
/** Halaman inventory **/
function inventory_get(s){
	s = typeof s !== 'undefined' ? s : "";
	var d=['grupbrg','kelompokbrg','gptab_index'];
	gPage("invent",gpage_purl(d)+s);
}
function inventory_grupbrg_form(o,cid,g){
	var f=[['nama','Nama grup barang']];
	fform_std(o,cid,g,"inventory_grupbrg",inventory_get,f);
}
function inventory_kelompokbrg_form(o,cid,g){
	var d=['grupbrg'];
	var f=[['nama','Nama kelompok barang']];
	fform_std(o,cid,g,"inventory_kelompokbrg",inventory_get,f,fform_purl(d));
}
function inventory_kelompokbrg_get(){
	var d=['grupbrg','kelompokbrg'];
	var s="";
	if(E("kelompokbrg").value!='0'){
		//alert('asd');
		s=xtable_pageparam();
	}
	_("inventory_kelompokbrg_get"+fform_purl(d)+s,function(r){
		EHtml("box_inventory_kelompokbrg",r);
		xtree_file_select();
	});
}
function inventory_brg_get(){
	//alert('asd');
	inventory_kelompokbrg_get();
}
function inventory_brg_form(o,cid,g){
	var d=['grupbrg','kelompokbrg'];
	var f=[['kode','Kode barang'],['nama','Nama kelompok barang'],['tanggal','Tanggal diperoleh',true,'t'],['unit','Jumlah barang',true,'dm',1],['satuan','Satuan',false],['keterangan','',false]];
	fform_std(o,cid,g,"inventory_brg",inventory_get,f,fform_purl(d));
}
function inventory_penerimaan_get(){
	var s=xtable_pageparam();
	inventory_get(s);
}
function inventory_penerimaan_data_get(){
	var d=['nomerbukti','kodebrg','unit','satuan'];
	_("inventory_penerimaan_data"+fform_purl(d),function(r){
		var s=r.split("~");
		E("uraian").value=s[0];
		if(s.length>1){
			E("namabrg").value=s[1];
		}
	});
}
function inventory_penerimaan_form(o,cid,g){
	var f=[['rekkas','Rek. Kas/Bank',true,'s'],['trans_tanggal','Tanggal',true,'t'],['trans_nomer'],['trans_ct'],['trans_print'],['rekitem','Rek. perkiraan',true,'s'],['uraian','Uraian',false],['nominal','Nominal',false,'c'],['nomerbukti','Nomor bukti penerimaan barang',true],['kodebrg','Kode barang',true],['namabrg','Nama barang',true],['unit','Jumlah barang',true,'dm',1],['satuan','Satuan',false]];
			
	fform_std(o,cid,g,"inventory_penerimaan",function(r){inventory_get();transaksi_print(r);},f,'',0,function(){transaksi_getnomer();});
}