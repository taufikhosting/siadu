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
function pengarang_get(){
	gPage("pengarang");
}
function pengarang_form(o,cid,g){
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
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
	gPage("katalog");
}
function katalog_cari(){
	var d=['keyword','keyon'];
	gPage("katalog",gpage_purl(d));
}
function katalog_form_view(katalog){
	gPage("katalog_buku","katalog="+katalog);
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
		f=[['nbuku','Jumlah unit baru',true,'n'],['idbuku','ID buku'],['barkode'],['callnumber'],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	} else {
		f=[['idbuku','ID buku'],['barkode'],['callnumber'],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	}
	fform_std(o,cid,g,"katalog_buku",katalog_buku_get,f,fform_purl(d));
}
function katalog_buku_daftar_form(o,cid,g){
	var d=['katalog','lokasi'];
	var f;
	if(o=='af'||o=='a'){
		f=[['nbuku','Jumlah unit baru',true,'n'],['idbuku','ID buku'],['barkode'],['callnumber'],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	} else {
		f=[['idbuku','ID buku'],['barkode'],['callnumber'],['sumber','',true,'r',2],['harga','',false,'n'],['satuan'],['tanggal','tanggal diperoleh',false,'t'],['tlokasi','Perpustakaan'],['ttingkatbuku','Tingkat buku']];
		//showTempes(f); return 0;
	}
	fform_std(o,cid,g,"katalog_buku",katalog_buku_get,f,fform_purl(d));
}
function katalog_buku_cek(){
	var sep=".";
	var b=parseInt(E('nbuku').value);
	if(b==1){
		E('idbuku').value=E('tidbuku').value;
		E('barkode').value=E('tbarkode').value;
	} else if(b>1){
		var k=E('idbuku').value.split(sep);
		E('idbuku').value=k[0]+sep+k[1]+sep+k[2]+sep+"[auto]";
		E('barkode').value=k[0]+k[1]+k[2]+"[auto]";
	} else {
		alert('Jumlah buku tidak boleh kurang dari 1');
		a.value=1;
		Efoc('nbuku');
		E('barkode').value=E('tbarkode').value;
		E('idbuku').value=E('tidbuku').value;
	}
}
function katalog_buku_getkode(o){
	o = typeof o !== 'undefined' ? o : "af";
	var lokasi=E("tlokasi").value;
	var tingkatbuku=E("ttingkatbuku").value;
	var idbuku=o=="af"?"":E('idbuku').value;
	_("katalog_buku_getkode&lokasi="+lokasi+"&tingkatbuku="+tingkatbuku+"&opt="+o+"&idbuku="+idbuku,function(r){
		var k=r.split("-");
		E('barkode').value=k[0];
		E('idbuku').value=k[1];
		E('tbarkode').value=k[0];
		E('tidbuku').value=k[1];
		katalog_buku_cek();
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

function katalog_form(o,cid,g){
	var d = ['opf'];
	
	if(o=='af'||o=='uf'){
		gPage("katalog",gpage_purl(d)+"&opt="+o+"&cid="+cid);
		PCBCODE=1;
	}
	else {
		var f=[
			['judul1','Judul Buku',true,'adv'],
			['judul2','Judul Buku',false,'adv'],
			['klasifikasi-kode','Kode Klasifikasi',true,'w',10],
			['klasifikasi'],
			['pengarang'],
			['penerjemah','Penerjemah',false],
			['editor','Editor',false],
			['penerbit'],
			['tahunterbit','Tahun terbit',false,'d',4],
			['kota','Kota',false,'w',50],
			['isbn','ISBN',false,'w',50],
			['issn','ISSN',false,'w',50],
			['bahasa'],
			['seri','Seri buku',false,'w'],
			['volume','Volume',false,'w'],
			['edisi','Edisi',false,'w'],
			['jenisbuku','Jenis buku'],
			['photo','Gambar sampul buku',false,'f'],
			['halaman','Jumlah halaman',false,'dm',0],
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
		});
	},f);
}
function katalog_pengarang_form(o,cid,g){
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"katalog_pengarang",function(r){
		var d=r.split(";");
		_("katalog_pengarang_opt",function(r){
			E('pengarang').innerHTML=r;
			E('pengarang').value=d[0];
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
	fform_std(o,cid,g,"daftarbuku",daftarbuku_get,f);
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

/** Halaman peminjaman **/
function peminjaman_get(){
	gPage("peminjaman");
}
function peminjaman_cari(){
	var d=['keyword','keyon'];
	gPage("peminjaman",gpage_purl(d));
}
function peminjaman_form(o,cid,g){
	
	if(o=='af'||o=='uf'){
		PCBCODE=3;
		gPage("peminjaman","&opt="+o+"&cid="+cid);
	}
	else {
		var f=[
			['member_id'],
			['member_tipe'],
			['tanggal1'],
			['tanggal2'],
			['keterangan','Keterangan',false]
			];
			
		fform_std(o,cid,g,"peminjaman",peminjaman_get,f);
	}
}
function peminjaman_buku_get(){
	_("peminjaman_buku_tabel",function(r){
		E("data_peminjaman_buku").innerHTML=r;
	});
}
function peminjaman_buku_form(o,cid,g){
	if(o=='af'){
		_("peminjaman_buku_get",function(r){
			E('fform').innerHTML=r;
			E("fform_yes_btn").style.display='none';
			open_fform();
			Efoc('pskeyword');
		});
	}
	else if(o=='a'){
		var s="";
		var n=parseInt(E('psceknum').value);
		for(var i=0;i<n;i++){
			if(E('pscek'+i).checked){
				if(s!="")s+=",";
				s+=E('pscek'+i).value;
			}
		}
		fform_sendclose("peminjaman_buku&opt=a&data="+s,peminjaman_buku_get);
	}
	else if(o=='d'){
		_("peminjaman_buku&opt=d&cid="+cid,function(r){
			peminjaman_buku_get();
		});
	}
}
function peminjaman_buku_get_pilih_id(a){
	peminjaman_buku_get_cekall(false);
	peminjaman_buku_get_cek(a,true);
	peminjaman_buku_form('a');
}
function peminjaman_buku_get_cari(a){
	var d=['pslokasi'];
	var s=a==1?E('pskeyword').value:"";
	_("peminjaman_buku_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_buku').innerHTML=r;
		peminjaman_buku_get_ceknum();
	});
}
function peminjaman_buku_get_cari_do(event){
	if(event.which == 13){
		peminjaman_buku_get_cari(1);
	}
}
function peminjaman_buku_get_detil(a){
	_("peminjaman_buku_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function peminjaman_buku_get_ceknum(){
	var ncek=0;
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		if(E('pscek'+i).checked) ncek++;
	}
	if(ncek>0){
		E("fform_yes_btn").style.display='';
	} else {
		E("fform_yes_btn").style.display='none';
	}
	if(ncek==n){
		E('pscekt').checked=true;
	} else {
		E('pscekt').checked=false;
	}
}
function peminjaman_buku_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	peminjaman_buku_get_ceknum();
}
function peminjaman_buku_get_cek(a,b){
	E('pscek'+a).checked=b;
	peminjaman_buku_get_ceknum();
}

/** Halaman pengembalian **/
function pengembalian_get(){
	var d=['tanggal1','tanggal2'];
	gPage("pengembalian",gpage_purl(d));
}
function pengembalian_cari(){
	var d=['keyword','keyon'];
	gPage("pengembalian",gpage_purl(d));
}
function pengembalian_form(o,cid,g){
	
	if(o=='af'||o=='uf'){
		var member_id=E('member_id').value;
		var member_tipe=E('member_tipe').value;
		PCBCODE=3;
		gPage("pengembalian","&opt="+o+"&cid="+cid);
	}
	else {
		var f=[
			['member_id'],
			['member_tipe'],
			['tanggal1'],
			['tanggal2'],
			['keterangan','Keterangan',false]
			];
			
		fform_std(o,cid,g,"pengembalian",pengembalian_get,f);
	}
}
function pengembalian_buku_get(){
	var id=E('member_id').value;
	var t=E('member_tipe').value;
	_("pengembalian_buku_tabel&cid="+id+"&mtipe="+t,function(r){
		E('data_pengembalian_buku').innerHTML=r;
		EShow('data_pengembalian');
	});
}
function pengembalian_buku_form(o,cid,g){
	var f=[['buku_id'],['status'],['tanggal3']];
	fform_std(o,cid,g,"pengembalian_buku",pengembalian_buku_get,f);
}
function pengembalian_item_get(){
	var barkode=E("sbarkode").value;
	EHtml("cariiteminfo","&nbsp;");
	if(barkode!=""){
	_("pengembalian_item_get&barkode="+barkode,function(r){
		if(r=="0"){
			EHtml("cariiteminfo","item \""+barkode+"\" tidak sedang dipinjam.");
			E("speminjaman").value="0";
		} else {
			var d=r.split("-");
			E("speminjaman").value=d[0];
			sirkulasi_member_pilih(d[1],d[2]);
		}
	});}
	else{
	EHtml("cariiteminfo","Masukkan barkode item");
	}
}
function pengembalian_item_cari(event){
	if(event.which == 13){
		pengembalian_item_get();
	}
}
/* Sirkulasi */
function sirkulasi_member_add(n,t){
	n = typeof n !== 'undefined' ? n : "";
	t = typeof t !== 'undefined' ? t : "1";
	if(n=="")n=E("smember").value;
	if(n!="")page_search=1;
	else page_search=0;
	_("sirkulasi_member_get&keyword="+n+"&mtipe="+t+"&page_search="+page_search,function(r){
		open_fform(r);
	});
}
function sirkulasi_member_cari(event){
	var keyword=E('smember').value;
	if(event.which == 13){
		_("sirkulasi_member_cari&keyword="+keyword,function(r){
			if(r.length>1){
				var s=r.split("-");
				sirkulasi_member_pilih(s[0],s[1],s[2]);
			} else {
				sirkulasi_member_add(keyword,r);
			}
		});
	}
}
function sirkulasi_member_get_siswa_get(a){
	var d=['psdepartemen','pstahunajaran','pstingkat','pskelas','keyword'];
	var s="";
	
	if(a==1) s=fform_purl(d);
	if(E('keyword').value=="")page_search=0;
	_("sirkulasi_member_get_siswa&page_search="+page_search+s,function(r){
		E('data_member').innerHTML=r;
	});
}
function sirkulasi_member_pilih(id,t,n){
	n = typeof n !== 'undefined' ? n : "";
	E('member_id').value=id;
	E('member_tipe').value=t;
	if(n!="") E('smember').value=n;
	_("sirkulasi_datamember&cid="+id+"&mtipe="+t,function(r){
		E('datamember').innerHTML=r;
		close_fform();
		if(E('sirkulasi_form').value=='2'){
			_("pengembalian_buku_tabel&cid="+id+"&mtipe="+t,function(r){
				E('data_pengembalian_buku').innerHTML=r;
				EShow('data_pengembalian');
				if(E("speminjaman").value!="0"){
					pengembalian_buku_form('uf',E("speminjaman").value);
				}
			});
		}
	});
}
function sirkulasi_member_siswa_view(a){
	_("sirkulasi_member_siswa_view&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}

/* Halaman stock take */
function stocktake_get(){
	gPage("stocktake");
}
function stocktake_init(a){
	if(a==0){
		PCBCODE=4;
		gPage("stocktake","opt=init");
	}
	else if(a==1){
		var f=[['tanggal1'],['nama','Nama stock opname'],['keterangan','',false]];
		fform_std('a',0,true,"stocktake_init",function(){stocktake_init(2);},f);
	}
	else if(a==2){
		PCBCODE=5;
		gPage("stocktake","opt=batch");
	}
}
function stocktake_batch(){
	_("stocktake_batch",function(r){
		//alert(r);
		var d=r.split("-");
		var a=parseInt(d[0]);
		var b=parseInt(d[1]);
		var c=parseInt(a*100/b);
		var p=parseInt(a*400/b);
		E("pbarp").innerHTML=c+"%";
		E("pbar1").style.width=p+"px";
		if(a<b) setTimeout("stocktake_batch()",50);
		else stocktake_cek();
	});
}
function stocktake_cek(){
	_("stocktake_cek&opt=getcurrent",function(r){
		if(r=="1") gPage("stocktake","opt=cek");
		else stocktake_init(2);
	});
}
function stocktake_cekbarkode(event){
	if(event.which == 13){
		stocktake_cek_barkode();
	}
}
function stocktake_cancel(){
	E("barkode").value="";
	EHtml("scbcd","");
	EHide("okbtn");
	Efoc("barkode");
}
function stocktake_cek_barkode(){
	var barkode=E("barkode").value;
	EHtml("scbcd","");
	EHide("okbtn");
	E("scinfo","");
	
	if(barkode!=""){
		_("stocktake_cek&opt=cekbarkode&barkode="+barkode,function(r){
			if(r=="1"){
				E("scbcd").style.color="#ff4000";
				E("buku_id").value=0;
				EHtml("scbcd",barkode);
				EHtml("scinfo","Tidak ditemukan dalam database.");
			}
			else if(r=="2"){
				E("scbcd").style.color="#009000";
				E("buku_id").value=0;
				EHtml("scbcd",barkode);
				EHtml("scinfo","Item sudah dicek.");
			}
			else {
				var d=r.split("`");
				E("scbcd").style.color="#468ad2";
				E("buku_id").value=d[0];
				EHtml("scbcd",d[1]);
				EShow("okbtn");
				EHtml("scinfo","1 item ditemukan dalam database.");
				if(E("aoke").checked){
					setTimeout("stocktake_cek_buku()",1000);
				}
			}
		});
	} else {
		EHtml("scinfo","Masukkan barkode!");
	}
}
function stocktake_cek_buku(){
	var buku_id=E("buku_id").value;
	_("stocktake_cek&opt=cekbuku&cid="+buku_id,function(r){
		E("barkode").value="";
		EHtml("scbcd","");
		EHide("okbtn");
		var d=r.split("`");
		E("schist").value=d[0]+E("schist").value;
		EHtml("cekedbook",d[1]);
		E("pbar").style.width=d[3];
		if(parseInt(d[1])==parseInt(d[2])){
			E("schist").value="Semua buku sudah dicek."+E("schist").value;
			alert("Semua buku sudah di cek.");
		} else {
			Efoc("barkode");
		}
	});
}
function stocktake_daftar_get(g){
	if(g==0){page_search=0; page_sort=0;}
	_("stocktake_daftar"+xtable_pageparam(g,0),function(r){
		open_fform(r);
	});
}
function stocktake_cek_done(o){
	if(o=='af'){
		_("stocktake_cek_done&opt=af",function(r){
			open_fform(r);
		});
	} else {
		fform_sendclose("stocktake_cek_done&opt=a",function(r){
			if(r=="1") stocktake_note();
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_note(){
	gPage("stocktake","opt=note");
}
function stocktake_note_get(){
	gPage("stocktake","opt=note&tampil="+E('tampil').value);
}
function stocktake_note_form(o,id){
	if(o=='uf'){
		_("stocktake_note&opt=af&cid="+id,function(r){
			open_fform(r);
			Efoc('note');
		});
	} else {
		var note=E("note").value;
		fform_sendclose("stocktake_note&opt=a&cid="+id+"&note="+note,function(r){
			if(r!="-0-") EHtml("cttn"+id,r);
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_note_done(o){
	if(o=='af'||o=='df'){
		_("stocktake_note_done&opt="+o,function(r){
			open_fform(r);
		});
	} else {
		fform_sendclose("stocktake_note_done&opt="+o,function(r){
			if(r=="1") stocktake_finish();
			else if(r=="2") stocktake_cek();
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_finish(){
	gPage("stocktake","opt=finish");
}
function stocktake_report(id){
	gPage("stocktake","opt=report&cid="+id);
}
function stocktake_report_back(){
	gPage("stocktake","opt=hist");
}
function stocktake_hist(){
	gPage("stocktake","opt=hist");
}
function stocktake_hist_get(){
	stocktake_hist();
}
function stocktake_hist_back(){
	gPage("stocktake");
}
function stocktake_hist_form(o,cid,g){
	var f=[['nama','Nama stock opname'],['keterangan','',false]];
	fform_std(o,cid,g,"stocktake_hist",stocktake_hist_get,f);
}
function stocktake_print(a){
	var lap_cetak=E("lap_cetak").value;
	var lap_tglcetak=E("lap_tglcetak").checked?1:0;
	var lap_sum=E("lap_sum").checked?1:0;
	var lap_kertas=E("lap_kertas").value;
	window.open("print/?file=stocktake&token="+a+"&lap_cetak="+lap_cetak+"&lap_tglcetak="+lap_tglcetak+"&lap_sum="+lap_sum+"&psize="+lap_kertas+"&pori=L","_blank");
}

/** Halaman Statistik **/
function statistik_get(){
	var d=['lokasi','statistik','tanggal1','tanggal2'];
	gPage("statistik",gpage_purl(d));
}