/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		Efoc('judul1');
	}
	else if(PCBCODE==2){
		Efoc('kode');
	}
	else if(PCBCODE==3){
		Efoc('smember');
	}
	else if(PCBCODE==4){
		Efoc('nama');
	}
	else if(PCBCODE==5){
		stocktake_batch();
	}
	else if(PCBCODE==101){
		rakbuku_form('af');
	}
	else if(PCBCODE==201){
		katalog_buku_form('af');
	}
	PCBCODE=0;
}
function EscapeFunction(){
	
	ESCCODE=0;
}
/** setting **/
function setting_form(o,cid,g){
	if(o=='u'){
		var bahasa=E('bahasa').value;
		var oldpassword=E('oldpassword').value;
		var newpassword=E('newpassword').value;
		var rnewpassword=E('rnewpassword').value;
	
		if(oldpassword!="" && newpassword!=""){
			if(newpassword!=rnewpassword){
				alert('Password baru tidak sama');
				E('newpassword').focus();
				return false;
			}
			_("setting&opt=cek&oldpassword="+oldpassword+"&newpassword="+newpassword+"&bahasa="+bahasa,function(r){
				if(r=="0"){
					var f=[['bahasa','Bahasa',false],['newpassword','Password',false]];
					fform_std(o,cid,g,"setting",gpage_reload,f);
				}
				else if(r=='2'){
					alert('Pasword lama salah');
					E('oldpassword').focus();
					return false;
				}
				else {
					E('oldpassword').value=r;
					alert('Gagal mengupdate password:'+r);
					return false;
				}
			});
		} else {
			var f=[['bahasa','Bahasa',false]];
			fform_std(o,cid,g,"setting",gpage_reload,f);
		}
	}
	return true;
}

/*************** Halaman-halaman ***************/

/** Halaman lokasi **/
function lokasi_get(){
	gPage("lokasi");
}
function lokasi_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['alamat','Alamat',false],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"lokasi",lokasi_get,f);
}
function lokasi_print(){
	window.open("print/?file=lokasi","_blank");
}

/** Halaman klasifikasi **/
function klasifikasi_get(){
	gPage("klasifikasi");
}
function klasifikasi_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"klasifikasi",klasifikasi_get,f);
}
function klasifikasi_print(){
	window.open("print/?file=klasifikasi","_blank");
}

/** Halaman pengarang **/
function pengarang_namabib(a){
	a=$.trim(a);
	var s=a.split(/\s+/);
	var n=s.length;
	if(n>1){
		n=n-1;
		var a=s[n]+",";
		for(var i=0;i<n;i++) a+=" "+s[i];
		return a;
	} else {
		return a;
	}
}
function pengarang_get(){
	gPage("pengarang");
}
function pengarang_form(o,cid,g){
	var f=[['nama','Nama pengarang'],['nama2','Nama kutipan'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"pengarang",pengarang_get,f);
}
function pengarang_print(){
	window.open("print/?file=pengarang","_blank");
}

/** Halaman penerbit **/
function penerbit_get(){
	gPage("penerbit");
}
function penerbit_form(o,cid,g){
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"penerbit",penerbit_get,f);
}
function penerbit_print(){
	window.open("print/?file=penerbit","_blank");
}

/** Halaman bahasa **/
function bahasa_get(){
	gPage("bahasa");
}
function bahasa_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"bahasa",bahasa_get,f);
}
function bahasa_print(){
	window.open("print/?file=bahasa","_blank");
}

/** Halaman satuan **/
function satuan_get(){
	gPage("satuan");
}
function satuan_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"satuan",satuan_get,f);
}
function satuan_print(){
	window.open("print/?file=satuan","_blank");
}

/** Halaman extra **/
function extra_get(){
	gPage("extra");
}
function extra_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"extra",extra_get,f);
}
function extra_print(){
	window.open("print/?file=extra","_blank");
}

/** Halaman jenisbuku **/
function jenisbuku_get(){
	gPage("jenisbuku");
}
function jenisbuku_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"jenisbuku",jenisbuku_get,f);
}
function jenisbuku_print(){
	window.open("print/?file=jenisbuku","_blank");
}

/** Halaman tingkatbuku **/
function tingkatbuku_get(){
	gPage("tingkatbuku");
}
function tingkatbuku_form(o,cid,g){
	var f=[['kode','Kode',true],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"tingkatbuku",tingkatbuku_get,f);
}
function tingkatbuku_print(){
	window.open("print/?file=tingkatbuku","_blank");
}

/** Halaman kataog **/
function katalog_get(){
	var d=['katalog_view'];
	gPage("katalog",gpage_purl(d));
}
function katalog_print(){
	window.open("print/?file=katalog&info=Katalog"+xtable_pageparam(),"_blank");
}
function katalog_cari(){
	var d=['keyword','keyon'];
	gPage("katalog",gpage_purl(d));
}
function katalog_form_view(katalog){
	var d=['katalog_view'];
	gPage("katalog_buku",gpage_purl(d)+"&katalog="+katalog);
}
function katalog_buku_daftar_get(){
	var d=['katalog','lokasi'];
	_("katalog_buku_daftar_get"+fform_purl(d)+xtable_pageparam(),function(r){
		EHtml('katalog_buku_daftar',r);
	});
}
function katalog_buku_daftar_cek_form(o){
	if(o=='df'){
		_("katalog_buku_daftar_cek&opt="+o+"&data="+E('xtable_selectedid').value,function(r){
			EHtml('fform',r);open_fform();
		});
	} else if(o=='d'){
		fform_sendclose("katalog_buku_daftar_cek&opt="+o+"&data="+E('xtable_selectedid').value,katalog_buku_get);
	}
}
function katalog_buku_get(){
	var d=['katalog','lokasi'];
	gPage("katalog_buku",gpage_purl(d));
}
function katalog_buku_back(a){
	if(a==0) katalog_get();
}
function katalog_buku_form(o,cid,g){
	var d=['katalog','lokasi'];
	var f;
	if(o=='af'||o=='a'){
		f=[['nbuku','Jumlah unit baru',true,'n'],['idbuku','ID buku'],['barkode'],['callnumber','',false],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	} else {
		f=[['idbuku','ID buku'],['barkode'],['callnumber','',false],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	}
	fform_std(o,cid,g,"katalog_buku",katalog_buku_get,f,fform_purl(d),0,function(){katalog_buku_getkode(cid)});
}
function katalog_buku_daftar_form(o,cid,g){
	var d=['katalog','lokasi'];
	var f;
	if(o=='af'||o=='a'){
		f=[['nbuku','Jumlah unit baru',true,'n'],['idbuku','ID buku'],['barkode'],['callnumber','',false],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	} else {
		f=[['idbuku','ID buku'],['barkode'],['callnumber','',false],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	}
	fform_std(o,cid,g,"katalog_buku",katalog_buku_get,f,fform_purl(d),0,function(){katalog_buku_getkode(cid)});
}
function katalog_buku_getkode(cid){
	cid = typeof cid !== 'undefined'?cid:0;
	var nbuku=1;
	if(cid==0){
		nbuku=E("nbuku").value;
		var pat=/^[0-9]+$/g;
		if(!pat.test(nbuku)){
			alert("Jumlah buku tidak boleh 0.");
			E("nbuku").value=1;
			return false;
		}
		nbuku=parseInt(nbuku);
		if(nbuku<=0){
			alert("Jumlah buku tidak boleh 0.");
			E("nbuku").value=1;
			return false;
		}
	}
	
	var lokasi=E("tlokasi").value;
	var tingkatbuku=E("ttingkatbuku").value;
	var sumber=E("sumber2").checked?"1":"0";
	
	_("katalog_buku_getkode&nbuku="+nbuku+"&lokasi="+lokasi+"&tingkatbuku="+tingkatbuku+"&sumber="+sumber+"&cid="+cid,function(r){
		var k=r.split("~");
		E('barkode').value=k[0];
		E('idbuku').value=k[1];
	});
}
function katalog_buku_rakbuku_opt(){
	var perpustakaan = E('perpustakaan').value;
	EShow("loader3");
	_("katalog_buku_rakbuku_opt&perpustakaan="+perpustakaan,function(r){
		E('rakbuku').innerHTML=r;
		EHide("loader3");
	});
}
function katalog_getcallnumber(){
	var jud=E("judul1").value;
	var kode=E("klasifikasi-kode").value;
	var peng=SelectGetText("pengarang");
	if(jud!="" && kode!="" && peng!=""){
		E("callnumber").value=kode+" "+peng.substring(0,3)+" "+jud.substring(0,1).toLowerCase();
	}
}
function katalog_form(o,cid,g){
	var d = ['opf'];
	
	if(o=='af'||o=='uf'){
		d.push('katalog_view');
		PCBCODE=1;
		gPage("katalog",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[
			['judul1','Judul',true,'adv'],
			['judul2','Judul',false,'adv'],
			['klasifikasi-kode','Kode Klasifikasi',false,'w',10],
			['klasifikasi','Klasifikasi',false],
			['pengarang','Pengarang',false,'s'],
			['callnumber','Callnumber',false,'s'],
			['penerjemah','Penerjemah',false],
			['editor','Editor',false],
			['penerbit','Penerbit',false],
			['tahunterbit','Tahun terbit',false,'d',4],
			['kota','Kota',false,'w',50],
			['isbn','ISBN',false,'w',50],
			['issn','ISSN',false,'w',50],
			['bahasa','Bahasa',false],
			['seri','Seri',false,'w'],
			['volume','Volume',false,'w'],
			['edisi','Edisi',false,'w'],
			['jenisbuku','Jenis',false],
			['photo','Gambar sampul',false,'f'],
			['halaman','Jumlah halaman',false,'dm',0],
			['dimensi','Dimensi',false],
			['deskripsi','Sinopsis',false]
			];
		
		if(o=='a'||o=='u'){
			fform_std(o,cid,g,"katalog",function(r){
				katalog_form_view(r);
				hideNotif();
			},f);
		} else {
			fform_std(o,cid,g,"katalog",katalog_get,f);
		}
	}
}
function katalog_klasifikasi_set(){
	var tkode=E("klasifikasi-kode").value.match(/^[0-9]+/);
	if(tkode!=null){
		var kode=tkode[0];
		var opt=E("klasifikasi").options;
		for(var i=0;i<opt.length;i++){
			if(opt[i].text.indexOf(kode)!=-1){
				E("klasifikasi").value=opt[i].value;
				return 1;
			}
		}
	}
	E("klasifikasi").value='-';
	return 0;
}
function katalog_klasifikasi_sel(){
	var a = SelectGetText('klasifikasi');
	var sa=a.indexOf("[")+1;
	var sb=a.indexOf("]",sa);
	var kode=a.substring(sa,sb);
	E('klasifikasi-kode').value=kode;
}
function katalog_klasifikasi_form(o,cid,g){
	var f=[['kode','Kode',true,10],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_klasifikasi",function(r){
		var d=r.split(";");
		_("katalog_klasifikasi_opt",function(r){
			E('klasifikasi').innerHTML=r;
			E('klasifikasi').value=d[0];
			E('klasifikasi-kode').value=d[1];
			katalog_getcallnumber();
		});
	},f,'',0,function(){if(E("klasifikasi").value=="-"){E("kode").value=E("klasifikasi-kode").value;}});
}
function katalog_pengarang_form(o,cid,g){
	var f=[['nama','Nama pengarang'],['nama2','Nama kutipan'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_pengarang",function(r){
		var d=r.split(";");
		_("katalog_pengarang_opt",function(r){
			E('pengarang').innerHTML=r;
			E('pengarang').value=d[0];
			katalog_getcallnumber();
		});
	},f);
}
function katalog_penerbit_form(o,cid,g){
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_penerbit",function(r){
		var d=r.split(";");
		_("katalog_penerbit_opt",function(r){
			E('penerbit').innerHTML=r;
			E('penerbit').value=d[0];
		});
	},f);
}
function katalog_bahasa_form(o,cid,g){
	var f=[['kode','kode',true,10],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_bahasa",function(r){
		var d=r.split(";");
		_("katalog_bahasa_opt",function(r){
			E('bahasa').innerHTML=r;
			E('bahasa').value=d[0];
		});
	},f);
}
function katalog_jenisbuku_form(o,cid,g){
	var f=[['kode','kode',true,10],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_jenisbuku",function(r){
		var d=r.split(";");
		_("katalog_jenisbuku_opt",function(r){
			E('jenisbuku').innerHTML=r;
			E('jenisbuku').value=d[0];
		});
	},f);
}

/* Halaman daftarbuku */
function daftarbuku_get(){
	var d=['lokasi','jenisbuku'];
	gPage("daftarbuku",gpage_purl(d));
}
function daftarbuku_form(o,cid,g){
	var f;
	f=[['katalog'],['idbuku','ID buku'],['barkode'],['callnumber'],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
	fform_std(o,cid,g,"daftarbuku",daftarbuku_get,f,'',0,function(){katalog_buku_getkode(cid)});
}
function daftarbuku_cek_form(o){
	if(o=='df'){
		_("daftarbuku_cek&opt="+o+"&data="+E('xtable_selectedid').value,function(r){
			EHtml('fform',r);open_fform();
		});
	} else if(o=='d'){
		fform_sendclose("daftarbuku_cek&opt="+o+"&data="+E('xtable_selectedid').value,daftarbuku_get);
	}
}

/** Halaman Statistik **/
function statistik_get(){
	var d=['gptab_index','lokasi','statistik','tanggal1','tanggal2'];
	gPage("sirkulasi",gpage_purl(d));
}

/** Halaman member_lain **/
function member_lain_get(){
	var d=['gptab_index'];
	gPage("member",gpage_purl(d));
}
function member_lain_form(o,cid,g){
	var f=[['nid','Nomor ID member'],['nama'],['kontak'],['alamat','Alamat',false]];
	fform_std(o,cid,g,"member_lain",member_lain_get,f);
}
function member_lain_print(){
	window.open("print/?file=member_lain","_blank");
}

/** Halaman member_siswa **/
function member_siswa_get(){
	var d=['departemen','tahunajaran','tingkat','kelas','gptab_index'];
	gPage("member",gpage_purl(d));
}

/** Halaman tools **/
function tools_get(){
	gPage("tools");
}
function tools_idbuku_form(o,cid,g){
	var f=[['nilai','Format nomor ID'],['updatebuku','Update nomor ID item',false,'cx']];
	fform_std(o,cid,g,"tools_idbuku",tools_get,f);
}
function tools_barkode_form(o,cid,g){
	var f=[['nilai','Format barkode'],['updatebuku','Update barkode item',false,'cx']];
	fform_std(o,cid,g,"tools_barkode",tools_get,f);
}
function tools_label_form_get(){
	_("tools_label_form_get",function(r){
		EHtml('box_tools_label_form',r);
		callNotifbox("box_tools_label_form");
	});
}
function tools_label_form(o,cid,g){
	var f=[['judul','Judul'],['deskripsi','Deskripsi',false]];
	fform_std(o,cid,g,"tools_label",tools_label_form_get,f);
}