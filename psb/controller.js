/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		E("qcari").focus();
		E("qcari").value=E("qcari").value;
	}
	else if(PCBCODE==2){
		statistik_get();
	}
	else if(PCBCODE==3){
		periode_form('af');
	}
	else if(PCBCODE==4){
		kelompok_form('af');
	}
	else if(PCBCODE==5){
		pendataan_add();
	}
	else if(PCBCODE==6){
		kriteria_form('af');
	}
	PCBCODE=0;
}
function EscapeFunction(){
	ESCCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman Periode **/
function periode_get(){
	var d=['departemen'];
	gPage("periode",gpage_purl(d));
}
function periode_form(o,cid,g){
	var d=['departemen'];
	var f=[['proses','Nama periode'],['kodeawalan','Kode awalan',true,'w',10],['angkatan'],['kapasitas','',true,'dm',1],['aktif','Status','s'],['keterangan','',false]];
	fform_std(o,cid,g,"periode",periode_get,f,fform_purl(d));
}
function periode_print(){
	var d=['departemen'];
	window.open("print/?file=periode"+fform_purl(d),"_blank");
}
/** Halaman Kelompok **/
function kelompok_get(){
	var d=['departemen','proses'];
	gPage("kelompok",gpage_purl(d));
}
function kelompok_form(o,cid,g){
	var d=['departemen','proses'];
	var f=[['kelompok','Nama kelompok'],['tglmulai','Tanggal dibuka',true,'t'],['tglselesai','Tanggal ditutup',false,'t'],['biaya','Biaya formulir',false,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"kelompok",kelompok_get,f,fform_purl(d));
}
function kelompok_print(){
	var d=['departemen','proses'];
	window.open("print/?file=kelompok"+fform_purl(d),"_blank");
}
/** Halaman Pendataan **/
function pendataan_getSumPokok(){
	var a=E("proses").value;
	var b=E("kelompok").value;
	var c=E("kriteria").value;
	var d=E("golongan").value;
	EShow("loader3"); //loading animation
	_("pendataan_getsumpokok&proses="+a+"&kelompok="+b+"&kriteria="+c+"&golongan="+d,function(r){
		var ns=r.split("-");
		E("sumpokok").value=fRp(ns[0]); // uang gedung
		E("sppbulan").value=fRp(ns[1]); // spp bulanan
		E("joiningf").value=fRp(ns[2]); // spp bulanan
		pendataan_countnet();
		EHide("loader3");
	});
}

function pendataan_cdiscount(){
	var sum1    =ufRp(E("sumpokok").value);
	var disc1   =ufRp(E("disctb").value);
	var disc2   =ufRp(E("discsaudara").value);
	var disc3   =parseInt(E("disctunai").value);
		disc3 	=disc3*sum1/100;
	var disc=disc1+disc2+disc3;
	E("disctotal").value  =fRp(disc.toString());
}
 
// by : epi ----------------
	function pendataan_disctunairp(){
		var sp  = parseInt(ufRp(E("sumpokok").value));
		var dt1 = parseInt(E("disctunai").value);
		var dt2 = sp*dt1/100; 
		E("disctunai2").value=fRp(dt2.toString());
	}
// end of by : epi ----------------

function pendataan_csumnet(){
	var sum1 =ufRp(E("sumpokok").value);
	var disc =ufRp(E("disctotal").value);
	var sumn =sum1-disc;
	E("sumnet").value=fRp(sumn.toString());
}
function pendataan_cangsuran(){
	var angs=parseInt(E("jmlangsur").value);
	var sumn=ufRp(E("sumnet").value);
	var anpb=sumn/angs;
	var m=anpb%100;
	if(m!=0){
		anpb=anpb-m+100;
	}
	E("angsuran").value=fRp(anpb.toString());
}

function pendataan_countnet(){
	pendataan_disctunairp();
	pendataan_cdiscount();
	pendataan_csumnet();
	pendataan_cangsuran();
}

function pendataan_get(){
	var d=['departemen','proses','kelompok'];
	gPage("pendataan",gpage_purl(d));
}
function pendataan_cari(){
	var keyw=E('keyword').value;
	var d=['departemen','proses','kelompok'];
	gPage("pendataan",gpage_purl(d)+"&act=cari&keyword="+keyw);
}
function pendataan_form(o,cid,g){
	var d=['departemen','proses','kelompok'];
	if(o=='af'||o=='uf'){
		gPage("pendataan",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}else {
		var f=[
			['kriteria','Kriteria',true,'s'],
			['golongan','Kriteria',true,'s'],
			
			['joiningf','Joining Fee',false,'c'],
			['sumpokok','Sumbangan pokok',false,'c'],
			['sumnet','Sumbangan net',false,'c'],
			['sppbulan','Uang sekolah perbulan',false,'c'],
			['denda','Denda keterlambatan',false,'c'],
			['disctb','Discount subsidi',false,'c'],
			['discsaudara','Discount saudara',false,'c'],
			['disctunai','Discount tunai',false],
			['disctotal','Discount total',false,'c'],
			['jmlangsur','Lama angsuran',true,'s'],
			['angsuran','Angsuran per bulan',false,'c'],
			
			['nopendaftaran','Nomor pendaftaran'],
			['nama','Nama calon siswa'],
			['kelamin','Jenis kelamin'],
			['tmplahir','Tempat lahir',false],
			['tgllahir','Tanggal lahir',false,'t'],
			['agama','Agama calon siswa',false,'s'],
			['alamat','Alamat calon siswa',false],
			['telpon','No telepon',false,'p'],
			['sekolahasal','Sekolah asal',false],
			
			['ayah-nama','Nama Ayah',false],
			['ayah-warga','Kebangsaan Ayah',false],
			['ayah-tmplahir','Tempat lahir Ayah',false],
			['ayah-tgllahir','Tanggal lahir Ayah',false,'t'],
			['ayah-pekerjaan','Pekerjaan Ayah',false],
			['ayah-telpon','Nomor telepon Ayah',false,'p'],
			['ayah-pinbb','Pin BB Ayah',false],
			['ayah-email','Email Ayah',false],
			
			['ibu-nama','Nama Ibu',false],
			['ibu-warga','Kebangsaan Ibu',false],
			['ibu-tmplahir','Tempat lahir Ibu',false],
			['ibu-tgllahir','Tanggal lahir Ibu',false,'t'],
			['ibu-pekerjaan','Pekerjaan Ibu',false],
			['ibu-telpon','Nomor telepon Ibu',false,'p'],
			['ibu-pinbb','Pin BB Ibu',false],
			['ibu-email','Email Ibu',false],
			
			['keluarga-tglnikah','Tanggal perkawinan orang tua',false,'t'],
			['keluarga-kakek-nama','Nama Kakek',false],
			['keluarga-nenek-nama','Nama Nenek',false],
			['photo','Foto Siswa',false,'f'],
			['darah','Golongan darah',false],
			['kesehatan','Penyakit yang pernah diderita',false],
			['ketkesehatan','Catatan kesehatan',false],
			['kontakdarurat-nama','Nama kontak darurat',false],
			['kontakdarurat-hubungan','Hubungan',false],
			['kontakdarurat-telpon','Nomor yang dapat dihubungi',false,'p']
			
			];
		
		fform_std(o,cid,g,"pendataan",pendataan_get,f,fform_purl(d));
	}
}
function pendataan_showdetil(a){
	_("pendataan_view&id="+a,function(r){
		E("fform").innerHTML=r;
		open_fform();
	});
}
function pendataan_form_view(a){
	_("pendataan_view&id="+a,function(r){
		E("fform").innerHTML=r;
		open_fform();
	});
}
function pendataan_saudara_get(){
	_("pendataan_saudara_get",function(r){
		EHtml("data_saudara",r);
	});
}
function pendataan_saudara_form(o,cid,g){
	var f=[['psnama','Nama'],['pstgllahir','Tanggal lahir',false,'t'],['pssekolah','Sekolah',false]];
	fform_std(o,cid,g,"pendataan_saudara",pendataan_saudara_get,f);
}
function pendataan_saudara_siswa_get(g){
	g = typeof g !== 'undefined' ? g : 1;
	var d=['psdepartemen','pstahunajaran','pstingkat','pskelas','keyword','keyon'];
	var s=""; if(g==1){s=fform_purl(d);} else {page_search=0;}
	
	_("pendataan_saudara_siswa_get&page_search="+page_search+s,function(r){
		open_fform2(r);
		Efoc("keyword");
	});
}
function pendataan_saudara_set(a,b,c){
	E("psnama").value=a;
	E("pssekolah").value=b;
	inputdateSetDate("pstgllahir",c);
	close_fform2();
}
function pendataan_saudara_detil(a){
	_("pendataan_saudara_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}

function pendataan_print(){
	var d=['departemen'];
	window.open("print/?file=pendataan"+fform_purl(d),"_blank");
	//print_fmod('pendataan',['departemen','proses','kelompok']);
}
function pendataan_view_print(a){
	print_fmod('pendataan_view&token='+a);
}

/** Halaman penerimaan **/
function penerimaan_get(){
	var d=['departemen','proses','kelompok'];
	gPage("penerimaan",gpage_purl(d));
}
function penerimaan_cari(){
	var keyw=E('keyword').value;
	var d=['departemen','proses','kelompok'];
	gPage("penerimaan",gpage_purl(d)+"&act=cari&keyword="+keyw);
}
function pendataan_status_form(o,cid,g){
	var d=['departemen','proses','kelompok'];
	var f=[['nis','No Induk Siswa'],['nisn','NISN'],['angkatan'],['status']];
	//showTempes(f); return 0;
	fform_std(o,cid,g,"pendataan_status",penerimaan_get,f,fform_purl(d));
}
function pendataan_syarat_form(o,cid,g){
	var f=new Array();
	if(o=='u'){
	var x=E('syaratid').value;
	//alert(x);
	var y=x.split(",");
	for(var i=0;i<y.length;i++){
		f[i]=[y[i],y[i],false,'cx'];
	}
	//alert(f);
	}
	fform_std(o,cid,g,"pendataan_syarat",penerimaan_get,f);
}

/** Halaman Penempatan **/
function penempatan_get(){
	var d=['departemen','proses','kelompok','tahunajaran','tingkat','kelas'];
	gPage("penempatan",gpage_purl(d));
}
function penempatan_calon_kelas_get(){
	penempatan_calon_get();
	penempatan_kelas_get();
}
function penempatan_calon_get(){
	EHide("data_calon");
	EShow("loader3");
	var d=['departemen','proses','kelompok','kriteria'];
	_("penempatan_calon_get"+fform_purl(d),function(r){
		E("data_calon").innerHTML=r;
		EHide("loader3");
		EShow("data_calon");
	});
}
function penempatan_kelas_get(g,h){
	g = typeof g !== 'undefined' ? g : 0;
	h = typeof h !== 'undefined' ? h : 0;
	EHide("data_kelas");
	EShow("loader2");
	var d=['departemen','proses','kelompok','tahunajaran'];
	var kelas=g==0?E("kelas").value:g;
	var tingkat=h==0?E("tingkat").value:h;
	_("penempatan_kelas_get"+fform_purl(d)+"&tingkat="+tingkat+"&kelas="+kelas,function(r){
		E("data_kelas").innerHTML=r;
		EHide("loader2");
		EShow("data_kelas");
	});
}
function penempatan_form(o,cid,g){
	var d=['departemen','proses','kelompok','tahunajaran','tingkat','kelas'];
	var f=[['nis','No Induk Siswa'],['nisn','NISN']];
	fform_std(o,cid,g,"penempatan",penempatan_calon_kelas_get,f,fform_purl(d));
}

/** Halaman Golongan **/
function golongan_get(){
	gPage("golongan");
}
function golongan_form(o,cid,g){
	var f=[['golongan','Nama golongan'],['keterangan','',false]];
	fform_std(o,cid,g,"golongan",golongan_get,f);
}
/** Halaman Kriteria **/
function kriteria_get(){
	gPage("kriteria");
}
function kriteria_form(o,cid,g){
	var f=[['kriteria','Nama kriteria'],['keterangan','',false]];
	fform_std(o,cid,g,"kriteria",kriteria_get,f);
}
/** Halaman Biaya **/
function biaya_get(){
	var a=E("departemen").value;
	var b=E("proses").value;
	var c=E("kelompok").value;
	gPage("biaya","departemen="+a+"&proses="+b+"&kelompok="+c);
}
function biaya_cancel(){
	var tfields=E("tfields").value;
	var tfield=tfields.split("~");
	for(var i=1;i<tfield.length;i++){
		//E(tfield[i]).value=E("t"+tfield[i]).value;
	}
}
function biaya_save(){
	var a=E("departemen").value;
	var b=E("proses").value;
	var c=E("kelompok").value;
	
	var tfields  =E("tfields").value;
	var tfield   =tfields.split("~");
	
	var tfields2 =E("tfields2").value;
	var tfield2  =tfields2.split("~");
	
	var tfields3 =E("tfields3").value;
	var tfield3  =tfields3.split("~");
	
	var tfields4 =E("tfields4").value; /*epiii*/
	var tfield4  =tfields4.split("~"); /*epiii*/
	
	var s="&departemen="+a+"&proses="+b+"&kelompok="+c;
	for(var i=1;i<tfield.length;i++){
		s+="&"+tfield[i]+"="+ufRp(E(tfield[i]).value);
		E(tfield[i]).disabled='disabled';
	}
	
	for(var i=1;i<tfield2.length;i++){
		s+="&"+tfield2[i]+"="+ufRp(E(tfield2[i]).value);
		E(tfield2[i]).disabled='disabled';
	}
	
	for(var i=1;i<tfield3.length;i++){
		s+="&"+tfield3[i]+"="+ufRp(E(tfield3[i]).value);
		E(tfield3[i]).disabled='disabled';
	}
	
	/*epiii*/
	for(var i=1;i<tfield4.length;i++){
		s+="&"+tfield4[i]+"="+ufRp(E(tfield4[i]).value);
		E(tfield4[i]).disabled='disabled';
	}/*epiii*/
	
	EHide("cbiaya");
	EShow("loader2");
	_("biaya"+s,function(r){
		E("cbiaya").innerHTML=r;
		EHide("loader2");
		EShow("cbiaya");
		setTimeout("hideNotifbox()",5000);
	});
}
/** Halaman Angsuran **/
function angsuran_get(){
	gPage("angsuran");
}
function angsuran_form(o,cid,g){
	var f=[['cicilan','Jumlah angsuran'],['keterangan','',false]];
	fform_std(o,cid,g,"angsuran",angsuran_get,f);
}
/** Halaman Discount **/
function discount_get(){
	gPage("discount");
}
function discount_form(o,cid,g){
	var f=[['nilai','Besar diskon',true,'n'],['keterangan','',false]];
	fform_std(o,cid,g,"discount",discount_get,f);
}
/** Halaman Cari **/
function cari_get(){
	var a=E("departemen").value;
	var b=E("optcari").value;
	var c=E("qcari").value;
	PCBCODE=1;
	gPage("cari","departemen="+a+"&optcari="+b+"&qcari="+c);
}
function cari_cari(){
	if(E("qcari").value!=""){
	if(svalidate('qcari','Kata kunci pencarian')){
		cari_get();
	}} else Efoc('qcari');
}
function cari_keyword(e){
	if (e.keyCode == '13') {
		cari_cari();
	}
}
/** Halaman Statistik **/
function statistik_get(){
	var a=E("departemen").value;
	var b=E("optcari").value;
	_("statistik&departemen="+a+"&optcari="+b,function(r){
		EHide("gbox0");
		EHide("gbox1");
		EHide("gbox2");
		EHide("gbox3");
		EHide("nodata");
		if(r!=""){
			var data = [];
			var d=r.split("~");

			for(var i=1;i<d.length;i++){
				var c=d[i].split(";");
				data.push([c[0],parseInt(c[1])]);
			}
			$.plot($("#placeholder"+d[0]), [ data ], {
				series: {
					bars: {
						show: true,
						barWidth: 0.5,
						align: "center"
					}
				},
				yaxis: {tickDecimals: 0},
				xaxis: {
					mode: "categories",
					tickLength: 0
				}
			});
			$("#gbox"+d[0]).fadeIn();
		} else {
			EShow("nodata");
		}
	});
}
/** Halaman Help **/
function help_get(){
	_("help",function(r){
		E("fform").innerHTML=r;
		open_fform();
	});
}

/** Halaman contoh **/
function contoh_get(){
	gPage("contoh");
}
function contoh_form(o,cid,g){
	fform_std(o,cid,g,"contoh",contoh_get);
}
function contoh_print(){
	var departemen=E('departemen').value;
	var proses=E('proses').value;
	window.open("print/?file=contoh&token="+departemen+"&proc="+proses,"_blank");
}

/** Halaman syarat **/
function syarat_get(){
	gPage("syarat");
}
function syarat_form(o,cid,g){
	var f=[['syarat','Persyaratan'],['wajib'],['keterangan','',false]];
	fform_std(o,cid,g,"syarat",syarat_get,f);
}