/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		Efoc('judul');
	}
	else if(PCBCODE==2){
		Efoc('kode');
	}
	else if(PCBCODE==3){
		katalog_unit_pie();
		//alert('yay');
	}
	else if(PCBCODE==4){
		var peminjaman=E('peminjaman').value;
		pengembalian_setpeminjaman(peminjaman);
	}
	PCBCODE=0;
}
function EscapeFunction(){
	if(ESCCODE==1){
		barang_get();
	}
	else if(ESCCODE==2){
		katalog_get();
	}
	ESCCODE=0;
}
/*************** Halaman-halaman ***************/

// [id -> sesuaikan nama kolom di db, label <sama dg id>, (<true>/false) -> harus diisi atau tidak, tipe]

/** Halaman inventaris **/
function inventaris_get(){
	var lokasi=E('lokasi').value;
	gPage("inventaris","lokasi="+lokasi);
}
function inventaris_form(o,cid,g){
	var d=['lokasi'];
	var f=[['kode'],['nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"inventaris",inventaris_get,f,fform_purl(d));
}
function inventaris_form_view(cid){
	var lokasi=E('lokasi').value;
	gPage("katalog","lokasi="+lokasi+"&grup="+cid);
}
function inventaris_print(){
	window.open("print/?file=inventaris","_blank");
}
function katalog_get(){
	var d=['lokasi','grup'];
	gPage("katalog",gpage_purl(d));
}
function katalog_back(a){
	inventaris_get();
}
function katalog_form(o,cid,g){
	cid = typeof cid !== 'undefined' ? cid : 0;
	g = typeof g !== 'undefined' ? g : true;
	var opf = E('opf').value;

	var d=['lokasi','grup'];
	if(o=='af'||o=='uf'){
		PCBCODE=2; ESCCODE=2;
		gPage("katalog",gpage_purl(d)+"&opt="+o+"&cid="+cid+"&opf="+opf);
	}
	else if(o=='df'||o=='d'){
		fform_std(o,cid,g,"katalog",katalog_get,0,fform_purl(d));
	}
	else if(o=='a'||o=='u'){
		var s="&photo="+E("photo").value;//+"&harga="+ufRp(E('harga').value);
		var d=['lokasi','grup'];
		s+=fform_purl(d);
		
		var f=[['nama'],['kode'],['jenis'],['susut','',true,'n'],['keterangan','',false]];
		
		if(svalidate_r(f)){
			for(var i=0;i<f.length;i++){
				s+="&"+f[i][0]+"="+E(f[i][0]).value;
			}
			_("katalog&opt="+o+"&cid="+cid+s,function(r){
				katalog_form_view(r);
				hideNotif();
			});
		}
	}
}
function katalog_form_view(cid){
	var d=['lokasi','grup']; PCBCODE=3;
	gPage("katalog_unit",gpage_purl(d)+"&cid="+cid);
}
function katalog_unit_back(a){
	katalog_get();
}
function katalog_unit_get(){
	katalog_form_view(E('katalog').value);
}
function katalog_unit_form(o,cid,g){
	var d=['lokasi','grup','katalog'];
	var f;
	if(o=='af'||o=='a'){
		f=[['nunit','Jumlah unit baru',true,'n'],['kode'],['barkode'],['sumber','',true,'r',3],['harga','',false,'c'],['kondisi'],['keterangan','',false]];
	} else {
		f=[['kode'],['barkode'],['sumber','',true,'r',3],['harga','',false,'c'],['kondisi'],['keterangan','',false]];
	}
	fform_std(o,cid,g,"katalog_unit",katalog_unit_get,f,fform_purl(d));
}
function katalog_unit_pie(){
	var a=parseInt(E('kondisi_1').value);
	var b=parseInt(E('kondisi_2').value);
	var c=parseInt(E('kondisi_3').value);
	var d=parseInt(E('kondisi_4').value);
	var tot=a+b+c+d;
	var data = [
        {label: "Sangat baik", data: a, color:'#0050ff'},
        {label: "Baik", data: b, color:'#00f500'},
        {label: "Buruk", data: c, color:'#ff8000'},
        {label: "Sangat Buruk", data: d, color:'#ff0000'}
    ];
	$.plot($("#placeholder"), data, {
		series: {
			pie: {
				show: true,
				radius: 1, 
				offset: {
					top: 0,//integer value to move the pie up or down
					left:-80//integer value to move the pie left or right, or 'auto'
				},
				stroke: {
					width: 2
				},
				label: {
					show: true,
					formatter: function (label, series) {
						return '<div style="font-size:11px;text-align:center;color:#000;border-radius:5px;padding:0px 2px;background:#fff"><b>'+   
						Math.round(series.percent*tot/100) + '</b> unit</div>';
					}
				},
			}
		},
		legend: {
			show: true
		}
	});
}

function katalog_unit_cek(a){
	var b=parseInt(a.value);
	if(b==1){
		E('kode').value=E('tkode').value;
		E('barkode').value=E('tbarkode').value;
	} else if(b>1){
		E('tkode').value=E('kode').value;
		E('tbarkode').value=E('barkode').value;
		var k=E('kode').value.split(".");
		E('kode').value=k[0]+'.'+k[1]+'.'+k[2]+'.[otomatis]';
		E('barkode').value='[otomatis]';
	} else {
		alert('Jumlah unit tidak boleh kurang dari 1');
		a.value=1;
		Efoc('nunit');
		E('kode').value=E('tkode').value;
		E('barkode').value=E('tbarkode').value;
	}
}

/** Halaman logistik **/
function logistik_get(){
	gPage("logistik");
}
function logistik_form(o,cid,g){
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"logistik",logistik_get,f);
}
function logistik_print(){
	window.open("print/?file=logistik","_blank");
}

/** Halaman jenis barang **/
function jenis_get(){
	gPage("jenis");
}
function jenis_form(o,cid,g){
	var f=[['kode','Kode',true,'n'],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"jenis",jenis_get,f);
}
function jenis_print(){
	window.open("print/?file=jenis","_blank");
}

/** Halaman grup barang **/
function grup_get(){
	var rak=E('rak').value;
	gPage("grup","rak="+rak);
}
function grup_form(o,cid,g){
	var d=['rak'];
	var f=[['kode','Kode',true,'n'],['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"grup",grup_get,f,fform_purl(d));
}
function grup_print(){
	window.open("print/?file=grup","_blank");
}

/** Halaman lokasi **/
function lokasi_get(){
	gPage("lokasi");
}
function lokasi_form(o,cid,g){
	var f=[['kode','Kode Lokasi'],['nama','Nama Lokasi'],['alamat','Alamat',false],['kontak','Kontak',false],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"lokasi",lokasi_get,f);
}
function lokasi_print(){
	window.open("print/?file=lokasi","_blank");
}

/** Halaman aktivitas **/
function aktivitas_get(){
	var d=['lokasi'];
	gPage("aktivitas",gpage_purl(d));
}
function aktivitas_form(o,cid,g){
	var d=['lokasi'];
	var f=[['aktivitas'],['tanggal1','Tanggal mulai',true,'t'],['tanggal2','Tanggal selesai',true,'t'],['keterangan','',false]];
	fform_std(o,cid,g,"aktivitas",aktivitas_get,f,fform_purl(d));
}
function aktivitas_print(){
	window.open("print/?file=aktivitas","_blank");
}

/** Halaman peminjaman **/
function peminjaman_get(){
	var d=['lokasi'];
	gPage("peminjaman",gpage_purl(d));
}
function peminjaman_form(o,cid,g){
	cid = typeof cid !== 'undefined' ? cid : 0;
	g = typeof g !== 'undefined' ? g : true;
	
	var d=['lokasi'];
	if(o=='af'||o=='uf'){
		gPage("peminjaman",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else if(o=='df'||o=='d'){
		fform_std(o,cid,g,"peminjaman",peminjaman_get,0,fform_purl(d));
	}
	else if(o=='a'||o=='u'){
		
		var d=['lokasi'];
		var s=fform_purl(d);
		
		var f=[['peminjam'],['tempat'],['tanggal1','',true,'t'],['tanggal2','',true,'t'],['keterangan','',false]];
		
		if(svalidate_r(f)){
			for(var i=0;i<f.length;i++){
				s+="&"+f[i][0]+"="+E(f[i][0]).value;
			}
			if(o=='a'){
				if(confirm('Data sudah benar?')){
					_("peminjaman&opt="+o+"&cid="+cid+s,function(r){
						peminjaman_get();
						hideNotif();
					});
				}
			}
		}
	}
}

function peminjaman_cari(){
	var keyword=E('keyword').value;
	_("peminjaman_tabelcari&keyword="+keyword,function(r){
		E('tabelcari').innerHTML=r;
	});
}

function peminjaman_ketabelpinjam(barang,katalog){
	_("peminjaman_ketabelpinjam&barang="+barang+"&katalog="+katalog,function(r){
		E('tabelpinjam').innerHTML=r;
		peminjaman_cari();
	});
}

function peminjaman_baliktabelpinjam(barang){
	_("peminjaman_baliktabelpinjam&barang="+barang,function(r){
		E('tabelpinjam').innerHTML=r;
		peminjaman_cari();
	});
}

function peminjaman_kembalikan(barang){
	_("peminjaman_baliktabelpinjam&barang="+barang,function(r){
		E('tabelpinjam').innerHTML=r;
		peminjaman_cari();
	});
}

function pengembalian_cari(){
	var keyword=E('keyword').value;
	_("pengembalian_tabelcari&keyword="+keyword,function(r){
		E('tabelcari').innerHTML=r;
	});
}
function pengembalian_get(){
	var d=['lokasi'];
	gPage("pengembalian",gpage_purl(d));
}
function pengembalian_form(o,cid,g){
	cid = typeof cid !== 'undefined' ? cid : 0;
	g = typeof g !== 'undefined' ? g : true;
	
	var d=['lokasi'];
	if(o=='af'||o=='uf'){
		gPage("pengembalian",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else if(o=='df'||o=='d'){
		fform_std(o,cid,g,"pengembalian",pengembalian_get,0,fform_purl(d));
	}
	else if(o=='a'||o=='u'){
		
		var s="";
		
		var f=[['peminjaman'],['keterangan','',false]];
		
		if(svalidate_r(f)){
			for(var i=0;i<f.length;i++){
				s+="&"+f[i][0]+"="+E(f[i][0]).value;
			}
			if(o=='a'){
				if(confirm('Data sudah benar?')){
					_("pengembalian&opt="+o+"&cid="+cid+s,function(r){
						pengembalian_get();
						hideNotif();
					});
				}
			}
		}
	}
}
function pengembalian_setpeminjaman(cid){
	var d=['lokasi'];
	gPage("pengembalian",gpage_purl(d)+"&peminjaman="+cid+"&opt=af");
}

/** Halaman pencarian **/
function pencarian_get(){
	var d=['lokasi','grup','jenis','keyword'];
	gPage("pencarian",gpage_purl(d));
}

/** Halaman tempat **/
function tempat_get(){
	var d=['lokasi'];
	gPage("tempat",gpage_purl(d));
}
function tempat_form(o,cid,g){
	var d=['lokasi'];
	var f=[['nama','Nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"tempat",tempat_get,f,fform_purl(d));
}
function tempat_print(){
	window.open("print/?file=tempat","_blank");
}