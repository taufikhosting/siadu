/* Callbacks */
function EscapeFunction(){
	if(BODY_SERVICE_CODE==1){
		jadwal_sks_reset();
		jadwal_sks_drop();
	}
}
function pageCallbacks(){
	if(PCBCODE==1){
		aspekpenilaian_form('af');
	}
	else if(PCBCODE==99){
		js_init_tinymce();
	}
	else if(PCBCODE==100){
		departemen_form('af');
	}
	else if(PCBCODE==101){
		tingkat_form('af');
	}
	else if(PCBCODE==102){
		tahunajaran_form('af');
	}
	else if(PCBCODE==103){
		semester_form('af');
	}
	else if(PCBCODE==104){
		pelajaran_form('af');
	}
	else if(PCBCODE==105){
		kelas_form('af');
	}
	else if(PCBCODE==106){
		angkatan_form('af');
	}
	PCBCODE=0;
}
/*************** Halaman-halaman ***************/
function aka_getpegawai(c){
	_("getpegawai&c="+c,function(r){
		E('fform2').innerHTML=r;
		open_fform2();
		Efoc("srcname");
	});
}
function aka_setpegawai(a,b,c){
	E("nippegawai").value=a;
	E("namapegawai").value=b;
	E("pegawai").value=c;
}
function aka_findpegawai(a){
	var n=E("srcname").value;
	var c=E("srccback").value;
	if(a==0) n="";
	if(n=="") a=0;
	EHide("databox");EShow("loader7");
	_("getpegawai&opt=find&nama="+n+"&c="+c,function(r){
		E('databox').innerHTML=r;
		EHide("loader7");
		EShow("databox");
		if(a==0)EHide("showallbtn");
		else EShow("showallbtn");
	});
}

function aka_getguru(c){
	_("getguru&c="+c,function(r){
		E('fform2').innerHTML=r;
		open_fform2();
		Efoc("srcname");
	});
}
function aka_setguru(a,b,c){
	E("nipguru").value=a;
	E("namaguru").value=b;
	E("guru").value=c;
}
function aka_findguru(a){
	var n=E("srcname").value;
	var c=E("srccback").value;
	if(a==0) n="";
	if(n=="") a=0;
	EHide("databox");EShow("loader7");
	_("getguru&opt=find&name="+n+"&c="+c,function(r){
		E('databox').innerHTML=r;
		EHide("loader7");
		EShow("databox");
		if(a==0)EHide("showallbtn");
		else EShow("showallbtn");
	});
}
/** Halaman pelajaran **/
function pelajaran_get(){
	var d=['departemen','tahunajaran'];
	gPage("pelajaran",gpage_purl(d));
}
function pelajaran_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['nama','Nama pelajaran'],['kode','Singkatan nama pelajaran',false],['skm','Standar ketuntasan minimum',true,'n'],['keterangan','',false]];
	fform_std(o,cid,g,"pelajaran",pelajaran_get,f,fform_purl(d));
}
function pelajaran_form_getkode(){
	var pel=E("nama").value;
	var kod=pel.substr(0,3).toUpperCase();
	var spat=/[^\s]+(\s+[^\s])+\s*/;
	if(spat.test(pel)){
		var pels=pel.split(" "); kod="";
		for(var i=0;i<pels.length;i++){
			if(pels[i]!=""){
				kod+=pels[i].substr(0,1).toUpperCase();
			}
		}
	}
	E("kode").value=kod;
}
/** Halaman guru **/
function guru_get(){
	var d=['departemen','tahunajaran','spelajaran'];
	gPage("guru",gpage_purl(d));
}
function guru_form(o,cid,g){
	var d=['departemen','tahunajaran','spelajaran'];
	var f=[['pelajaran','Mata pelajaran'],['pegawai'],['aktif'],['keterangan','',false]];
	fform_std(o,cid,g,"guru",guru_get,f,fform_purl(d));
}

// siswa_get
function siswa_get_pilih_id(a){
	siswa_get_cekall(false);
	siswa_get_cek(a,true);
	siswa_form('a');
}
function siswa_get_pilih(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?fform_purl(d):"";
	_("siswa_get_pilih"+s,function(r){
		E('data_siswa').innerHTML=r;
		siswa_get_ceknum();
	});
}
function siswa_get_cari(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?E('pskeyword').value:"";
	_("siswa_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_siswa').innerHTML=r;
		siswa_get_ceknum();
	});
}
function siswa_get_detil(a){
	_("siswa_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function siswa_get_ceknum(){
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
function siswa_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	siswa_get_ceknum();
}
function siswa_get_cek(a,b){
	E('pscek'+a).checked=b;
	siswa_get_ceknum();
}
// siswa_saudara
function siswa_saudara_get(){
	_("siswa_saudara_get",function(r){
		E("data_saudara").innerHTML=r;
	});
}
function siswa_saudara_form(o,cid,g){
	var f=[['psnama','Nama'],['pstgllahir','Tanggal lahir',false,'t'],['pssekolah','Sekolah',false]];
	fform_std(o,cid,g,"siswa_saudara",siswa_saudara_get,f);
}

function siswa_saudara_getsiswa(){
	_("siswa_saudara_getsiswa",function(r){
		E('fform2').innerHTML=r;
		open_fform2();
		Efoc('pskeyword');
	});
}
function siswa_saudara_setsiswa(a,b,c){
	E("psnama").value=a;
	E("pssekolah").value=b;
	inputdateSetDate("pstgllahir",c);
	close_fform2();
}
function siswa_saudara_siswapilih(a){
	var d=['psdepartemen','pstahunajaran','pstingkat','pskelas'];
	var s=a==1?fform_purl(d):"";
	_("siswa_saudara_siswapilih"+s,function(r){
		E('data_siswa').innerHTML=r;
	});
}
function siswa_saudara_siswacari(a){
	var s=a==1?E('pskeyword').value:"";
	_("siswa_saudara_siswacari&pskeyword="+s,function(r){
		E('data_siswa').innerHTML=r;
	});
}
function siswa_saudara_detil(a){
	_("siswa_saudara_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}

/** Halaman pengelompokan **/
function pengelompokan_get(){
	var d=['departemen','tahunajaran','grup'];
	gPage("pengelompokan",gpage_purl(d));
}
function pengelompokan_form(o,cid,g){
	var d=['departemen','tahunajaran','grup'];
	if(o=='af'){
		_("pengelompokan_get",function(r){
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
		fform_sendclose("pengelompokan&opt=a&data="+s+fform_purl(d),pengelompokan_get);
	}
	else if(o=='uf'){
		gPage("pengelompokan",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[];
		
		fform_std(o,cid,g,"pengelompokan",pengelompokan_get,f,fform_purl(d));
	}
}
function pengelompokan_form_view(a){
	_("pengelompokan_view&id="+a,function(r){
		E("fform").innerHTML=r;
		open_fform();
	});
}
// pengelompokan_get
function pengelompokan_get_pilih_id(a){
	pengelompokan_get_cekall(false);
	pengelompokan_get_cek(a,true);
	pengelompokan_form('a');
}
function pengelompokan_get_pilih(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?fform_purl(d):"";
	_("pengelompokan_get_pilih"+s,function(r){
		E('data_pengelompokan').innerHTML=r;
		pengelompokan_get_ceknum();
	});
}
function pengelompokan_get_cari(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?E('pskeyword').value:"";
	_("pengelompokan_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_pengelompokan').innerHTML=r;
		pengelompokan_get_ceknum();
	});
}
function pengelompokan_get_detil(a){
	_("pengelompokan_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function pengelompokan_get_ceknum(){
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
function pengelompokan_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	pengelompokan_get_ceknum();
}
function pengelompokan_get_cek(a,b){
	E('pscek'+a).checked=b;
	pengelompokan_get_ceknum();
}


/** Halaman siswakelas **/
function siswakelas_get(){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	gPage("siswakelas",gpage_purl(d));
}
function siswakelas_form(o,cid,g){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	if(o=='af'){
		_("siswakelas_get",function(r){
			//alert(r);
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
		fform_sendclose("siswakelas&opt=a&data="+s+fform_purl(d),siswakelas_get);
	}
	else if(o=='uf'){
		gPage("siswakelas",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[];		
		fform_std(o,cid,g,"siswakelas",siswakelas_get,f,fform_purl(d));
	}
}
function siswakelas_form_view(a){
	_("siswakelas_view&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
// siswakelas_get
function siswakelas_get_pilih_id(a){
	siswakelas_get_cekall(false);
	siswakelas_get_cek(a,true);
	siswakelas_form('a');
}
function siswakelas_get_cari(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?E('pskeyword').value:"";
	_("siswakelas_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_siswa').innerHTML=r;
		siswakelas_get_ceknum();
	});
}
function siswakelas_get_detil(a){
	_("siswakelas_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function siswakelas_get_ceknum(){
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
function siswakelas_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	siswakelas_get_ceknum();
}
function siswakelas_get_cek(a,b){
	E('pscek'+a).checked=b;
	siswakelas_get_ceknum();
}


/** Halaman siswakelompok **/
function siswakelompok_get(){
	var d=['departemen','tahunajaran','grupsiswa'];
	gPage("siswakelompok",gpage_purl(d));
}
function siswakelompok_form(o,cid,g){
	var d=['departemen','tahunajaran','grupsiswa'];
	if(o=='af'){
		_("siswakelompok_get",function(r){
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
		fform_sendclose("siswakelompok&opt=a&data="+s+fform_purl(d),siswakelompok_get);
	}
	else if(o=='uf'){
		gPage("siswakelompok",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[];		
		fform_std(o,cid,g,"siswakelompok",siswakelompok_get,f,fform_purl(d));
	}
}
function siswakelompok_form_view(a){
	_("siswakelompok_view&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
// siswakelompok_get
function siswakelompok_get_pilih_id(a){
	siswakelompok_get_cekall(false);
	siswakelompok_get_cek(a,true);
	siswakelompok_form('a');
}
function siswakelompok_get_cari(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?E('pskeyword').value:"";
	_("siswakelompok_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_siswa').innerHTML=r;
		siswakelompok_get_ceknum();
	});
}
function siswakelompok_get_detil(a){
	_("siswakelompok_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function siswakelompok_get_ceknum(){
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
function siswakelompok_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	siswakelompok_get_ceknum();
}
function siswakelompok_get_cek(a,b){
	E('pscek'+a).checked=b;
	siswakelompok_get_ceknum();
}


/** Halaman siswaguru **/
function siswaguru_get(){
	var d=['departemen','tahunajaran','guru'];
	gPage("siswaguru",gpage_purl(d));
}
function siswaguru_form(o,cid,g){
	var d=['departemen','tahunajaran','guru'];
	if(o=='af'){
		_("siswaguru_get",function(r){
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
		fform_sendclose("siswaguru&opt=a&data="+s+fform_purl(d),siswaguru_get);
	}
	else if(o=='uf'){
		gPage("siswaguru",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[];		
		fform_std(o,cid,g,"siswaguru",siswaguru_get,f,fform_purl(d));
	}
}
function siswaguru_form_view(a){
	_("siswaguru_view&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
// siswaguru_get
function siswaguru_get_pilih_id(a){
	siswaguru_get_cekall(false);
	siswaguru_get_cek(a,true);
	siswaguru_form('a');
}
function siswaguru_get_cari(a){
	var d=['psdepartemen','psangkatan'];
	var s=a==1?E('pskeyword').value:"";
	_("siswaguru_get_cari"+fform_purl(d)+"&pskeyword="+s,function(r){
		E('data_siswa').innerHTML=r;
		siswaguru_get_ceknum();
	});
}
function siswaguru_get_detil(a){
	_("siswaguru_get_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}
function siswaguru_get_ceknum(){
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
function siswaguru_get_cekall(a){
	var n=parseInt(E('psceknum').value);
	for(var i=0;i<n;i++){
		E('pscek'+i).checked=a;
	}
	siswaguru_get_ceknum();
}
function siswaguru_get_cek(a,b){
	E('pscek'+a).checked=b;
	siswaguru_get_ceknum();
}


//////////////////////////////////////////////////////////////////////////////////
/** Halaman rpp **/
function rpp_get(){
	gPage("rpp",gpage_purl(['departemen','tingkat','semester','pelajaran']));
}
function rpp_form(o,cid,g){
	var f=[['rpp','Materi'],['kode','',true,'w',20],['deskripsi','',false,'x']]; PCBCODE=99;
	fform_std(o,cid,g,"rpp",rpp_get,f,fform_purl(['departemen','tingkat','semester','pelajaran']));
}
/** Halaman aspekpenilaian **/
function aspekpenilaian_get(){
	gPage("aspekpenilaian");
}
function aspekpenilaian_form(o,cid,g){
	var f=[['kode','',true,'w',10],['aspekpenilaian']];
	fform_std(o,cid,g,"aspekpenilaian",aspekpenilaian_get,f);
}
/** Halaman jenispengujian **/
function jenispengujian_get(){
	gPage("jenispengujian",gpage_purl(['departemen','pelajaran']));
}
function jenispengujian_form(o,cid,g){
	var f=[['kode','Singkatan',true,'w',20],['jenispengujian'],['bobot','bobot penilian',true,'n'],['keterangan','',false]];
	fform_std(o,cid,g,"jenispengujian",jenispengujian_get,f,fform_purl(['departemen','pelajaran']));
}
/** Halaman grading **/
function grading_get(){
	gPage("grading",gpage_purl(['guru','pelajaran','tingkat']));
}
function grading_form(o,cid,g){
	var f=[['kode','Singkatan',true,'w',20],['grading'],['keterangan','',false]];
	fform_std(o,cid,g,"grading",grading_get,f,fform_purl(['guru','pelajaran','tingkat']));
}
function grading_setguru(a,b,c){
	E("nipguru").value=a;
	E("namaguru").value=b;
	E("guru").value=c;
	grading_get();
}
/** Halaman statusguru **/
function statusguru_get(){
	gPage("statusguru");
}
function statusguru_form(o,cid,g){
	var f=[['statusguru','Status'],['keterangan','',false]];
	fform_std(o,cid,g,"statusguru",statusguru_get,f);
}
/** Halaman pendataanguru **/
function pendataanguru_get(){
	var departemen=E("departemen").value;
	var pelajaran=E("pelajaran").value;
	gPage("pendataanguru","departemen="+departemen+"&pelajaran="+pelajaran);
}
function pendataanguru_form(o,cid,g){
	var departemen=E("departemen").value;
	var pelajaran=E("pelajaran").value;
	var fmod="pendataanguru";
	var f=new Array('spelajaran','nip','statusguru','keterangan');
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	else v+="&departemen="+departemen+"&pelajaran="+pelajaran;
	var ps=fmod+'&opt='+o+"&cid="+cid+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();if(o!='df'){E(f[0]).focus();E(f[0]).value=E(f[0]).value}})}
	else{_(ps,function(r){
		close_fform();
		pendataanguru_get();
		setTimeout("hideNotifbox()",3000);
	})}
}
function pendataanguru_print(){
	window.open("print/pendataanguru.php","_blank");
}
function pendataanguru_getguru(){
	_("pendataanguru_getguru",function(r){
		E('fform2').innerHTML=r;
		open_fform2();
	});
}
function pendataanguru_setguru(a,b){
	E("nip").value=a;
	E("namaguru").value=b;
	close_fform2();
}

function katalog_form(o,cid,g){
	cid = typeof cid !== 'undefined' ? cid : 0;
	g = typeof g !== 'undefined' ? g : true;
	var opf = E('opf').value;

	var d=['departemen','tingkat','kelas'];
	if(o=='af'||o=='uf'){
		gPage("siswa",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else if(o=='df'||o=='d'){
		fform_std(o,cid,g,"siswa",siswa_get,0,fform_purl(d));
	}
	else if(o=='a'||o=='u'){
		var s="&photo="+E("photo").value;//+"&harga="+ufRp(E('harga').value);
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

/** Halaman jadwal **/
function jadwal_get(){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	gPage("jadwal",gpage_purl(d));
}
function jadwal_jam_form(o,cid,g){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	var f=[['jamke','Jam ke'],['jam1','Jam mulai',true,'t'],['jam2','Jam selesai',true,'t'],['salin','',false,'cx']];
	fform_std(o,cid,g,"jadwal_jam",jadwal_get,f,fform_purl(d));
}
function jadwal_pelajaran_add(k,h,j){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	var s=fform_purl(d)+"&kelas="+k+"&hari="+h+"&jam="+j;
	var f=[['pspelajaran','Pelajaran']];
	fform_std('af',0,false,"jadwal_pelajaran",jadwal_get,f,s);
}
function jadwal_pelajaran_form(o,cid,g){
	var d=['departemen','tahunajaran','tingkat','kelas'];
	var f=[['pelajaran'],['guru'],['jam'],['hari'],['ruang']];
	fform_std(o,cid,g,"jadwal_pelajaran",jadwal_get,f,fform_purl(d));
}
function jadwal_pelajaran_get(){
	var d=['departemen','tahunajaran'];
	_("jadwal_pelajaran_get"+fform_purl(d),function(r){
		E('fform2').innerHTML=r;
		open_fform2();
	});
}
function jadwal_pelajaran_get_cari(){
	var d=['departemen','tahunajaran','pcpelajaran'];
	_("jadwal_pelajaran_get_cari"+fform_purl(d),function(r){
		E('data_jadwal').innerHTML=r;
	});
}
function jadwal_guru_get(){
	var d=['departemen','tahunajaran'];
	_("jadwal_guru_get"+fform_purl(d),function(r){
		E('fform2').innerHTML=r;
		open_fform2();
	});
}
function jadwal_guru_get_cari(){
	var d=['departemen','tahunajaran','pcguru'];
	_("jadwal_guru_get_cari"+fform_purl(d),function(r){
		E('data_jadwal').innerHTML=r;
	});
}
function jadwal_set(pid,pn,gid,gn){
	E('pspelajaran').value=pn;
	E('pelajaran').value=pid;
	E('psguru').value=gn;
	E('guru').value=gid;
	close_fform2();
}

/** Halaman jampelajaran **/
function jampelajaran_get(){
	gPage("jampelajaran",gpage_purl(['departemen']));
}
function jampelajaran_form(o,cid,g){
	var f=[['jamke','Jam ke'],['jam1','Jam mulai',true,'t'],['jam2','Jam selesai',true,'t'],['keterangan','',false]];
	fform_std(o,cid,g,"jampelajaran",jampelajaran_get,f,fform_purl(['departemen']));
}

/** Halaman presensi **/
function presensi_get(){
	var d=['departemen','tahunajaran','tingkat','kelas','tanggal'];
	gPage("presensi",gpage_purl(d));
}
function presensi_set(){
	var n=parseInt(E('gpceknum').value);
	var absen=E('presensi_set').value;
	for(var i=0;i<n;i++){
		if(E('gpcek'+i).checked){
			E('absen'+i).value=absen;
		}
	}
}
function presensi_simpan(){
	var tanggal=E("tanggal").value;
	var s="";
	var n=parseInt(E('gpceknum').value);
	for(var i=0;i<n;i++){
		if(s!="")s+=",";
		s+=E("idsiswa"+i).value+"-"+E('absen'+i).value;
	}
	_("presensi&opt=a&tanggal="+tanggal+"&data="+s,function(r){
		presensi_get();
		hideNotif();
	});
}
function presensi_tanggal_set(a){
	E('tanggal').value=a;
	presensi_get();
}

/** Halaman kbm **/
function kbm_get(){
	var d=['departemen','tahunajaran'];
	gPage("kbm",gpage_purl(d));
}
function kbm_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['kbm'],['keterangan','',false]];
	fform_std(o,cid,g,"kbm",kbm_get,f,fform_purl(d));
}
function kbm_print(){
	print_fmod('kbm',['departemen']);
}

/** Halaman kegiatan **/
function kegiatan_get(){
	var d=['departemen','tahunajaran'];
	gPage("kegiatan",gpage_purl(d));
}
function kegiatan_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['tanggal1','Tanggal dimulai',true,'t'],['tanggal2','Tanggal akhir',false,'t'],['keterangan','',false],['efektif','Hari efektif',false,'cx']];
	fform_std(o,cid,g,"kegiatan",kegiatan_get,f,fform_purl(d));
}