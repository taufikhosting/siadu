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
	else if(PCBCODE=='jenispenerimaan_warn_add'){
		jenispenerimaan_form('af');
	}
	else if(PCBCODE=='tpo_focnominal'){
		var id=E("tpo_first_itemid").value;
		//alert(id);
		tpo_lain_transaksi_list_form('uf',id);
	}
	else if(PCBCODE=='show_katalog_unit_pie'){
		katalog_unit_pie();
	}
	PCBCODE=0;
}
/*************** Halaman-halaman ***************/

/** Halaman user **/

function user_get(){
	gPage("user");
}
function user_form(o,cid,g){
	var f=[['uname','Username'],['level','Level'],['app','Modul'],['departemen','Departemen']];
	fform_std(o,cid,g,"user",user_get,f);
}

function user_print(){
	print_fmod('user',['departemen']);
}
/* Akademik */
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

/** Halaman transaksi **/
function transaksi_get(){
	var d=['ct_umum','ct_pemasukan','ct_pengeluaran','ct_siswa','ct_calonsiswa','ct_barang','ct_jurnaldetil'];
	var e=['gptab_index','tanggal1','tanggal2'];
	gPage("laporan_keuangan",gpage_purlcheck(d)+fform_purl(e));
}
function transaksi_ct_all(){
	E("ct_umum").checked=true;
	E("ct_pemasukan").checked=true;
	E("ct_pengeluaran").checked=true;
	E("ct_siswa").checked=true;
	E("ct_calonsiswa").checked=true;
	E("ct_barang").checked=true;
	EHide("ctallbtn");
}
function transaksi_ct_cek(){
	var cek=0;
	if(E("ct_umum").checked)cek++;
	if(E("ct_pemasukan").checked)cek++;
	if(E("ct_pengeluaran").checked)cek++;
	if(E("ct_siswa").checked)cek++;
	if(E("ct_calonsiswa").checked)cek++;
	if(E("ct_barang").checked)cek++;
	EDisplay("ctallbtn",cek<6);
}
function transaksi_ctgl_set(a){
	var tgl_f=E("tanggal_f").value;
	var tgl_c=E("tanggal_c").value;
	var tgl_l=E("tanggal_l").value;
	if(a==1){ // hari ini
		inputdateSetDate("tanggal1",tgl_c);
		inputdateSetDate("tanggal2",tgl_c);
	}
	else if(a==2){
		inputdateSetDate("tanggal1",tgl_f);
		inputdateSetDate("tanggal2",tgl_l);
	}
	else if(a==3){
		inputdateSetDate("tanggal1",tgl_f);
		inputdateSetDate("tanggal2",tgl_c);
	}
}
function transaksi_getnomer(){
	var jt=E("trans_jenis").value;
	var tgl=E("trans_tanggal").value;
	var ct=E("trans_ct").value;
	var rk="0";
	if(jt=='3'||jt=='4'){
		rk=E("rekkas").value;
	}
	_("transaksi_getnomer&jtrans="+jt+"&rekkas="+rk+"&tanggal="+tgl+"&ct="+ct,function(r){
		if(r!=""){
		EHtml("box_trans_nomer",r);
		E("trans_nomer").value=r;
		}
	});
}
function transaksi_getsubtotal(){
	var n=parseInt(E("transaksi_list_num").value);
	var subtotal=0;
	for(var i=1;i<=n;i++){
		subtotal+=ufRp(E("nominal"+i).value);
	}
	subtotal=subtotal==0?"Rp 0":fRp(subtotal.toString());
	EHtml("trans_subtotal","<b>"+subtotal+"</b>");
}
function transaksi_cekbudget(){
	var n=parseInt(E("transaksi_list_num").value);
	var subtotal=0;
	for(var i=1;i<=n;i++){
		subtotal+=ufRp(E("nominal"+i).value);
	}
	_("transaksi_cekbudget&budget="+E("budget").value,function(r){
		var s=r=="x"?true:parseInt(r)>=subtotal;
		if(s){
			E("trans_subtotal").style.color="#444";
		}
		else {
			E("trans_subtotal").style.color="#ff0000";
			alert('Perigatan: Jumlah nominal transaksi lebih besar dari sisa anggaran!');
		}
	});
}
function transaksi_print(t){
	if(t!="") window.open("print.php?doc=buktitransaksi&docname=bukti transaksi&token="+t,"_blank");
}
function transaksi_form(o,cid,g){
	var d=['jenistransaksi']; var jtrans=-1;
	var f=[['rekkas','Rek. Kas/Bank',true,'s'],['budget','Anggaran',false],['trans_tanggal','Tanggal',true,'t'],['trans_jenis'],['trans_print','Cetak bukti pembayaran',false,'cx']];
	if(o=='af'){
		if(E('jenistransaksi').value=='0'){
			f[0]=['uraian'];
			jtrans=0;
		}
	}
	if(o=='a'){
		if(E('trans_jenis').value=='0'){
			f[0]=['uraian'];
			jtrans=0;
		}
		f.push(['trans_nomer']);
		f.push(['trans_nobukti','Nomor bukti',false]);
		f.push(['trans_ct']);
		if(E('trans_jenis').value=='0'){
			for(var i=1;i<=8;i++){
				f.push(['rekitem'+i,'Rek. perkiraan',false,'s']);
				f.push(['debet'+i,'Nominal debet',false,'c']);
				f.push(['kredit'+i,'Nominal kredit',false,'c']);
			}
		} else {
			for(var i=1;i<=8;i++){
				f.push(['rekitem'+i,'Rek. perkiraan',false,'s']);
				f.push(['uraian'+i,'Uraian',false]);
				f.push(['nominal'+i,'Nominal',false,'c']);
			}
		}
	}
	if(o=='u') {
		if(E('trans_jenis').value=='0'){
			f[0]=['uraian'];
			for(var i=1;i<=8;i++){
				f.push(['rekitem'+i,'Rek. perkiraan',false,'s']);
				f.push(['debet'+i,'Nominal debet',false,'c']);
				f.push(['kredit'+i,'Nominal kredit',false,'c']);
			}
			jtrans=0;
		} else {
			f.push(['rekitem','Rek. perkiraan',false,'s']);
			f.push(['uraian','Uraian',false]);
			f.push(['nominal','Nominal',false,'c']);
		}
	}
	
	//if(o=='a') alert(fform_fetchvalue(f));
	fform_std(o,cid,g,"transaksi",function(r){
		transaksi_get();
		transaksi_print(r);
	},f,fform_purl(d),function(){
		if(jtrans==0){
			if((o=='a' || o=='u')){
				var deb=0; var kre=0;
				for(var i=1;i<=8;i++){
					deb+=ufRp(E('debet'+i).value);
					kre+=ufRp(E('kredit'+i).value);
				}
				if(deb!=kre){
					alert('Jumlah debet dan kredit tidak sama!');
					return false;
				}
				if((deb+kre)==0){
					alert('Nominal jurnal tidak boleh kosong!');
					return false;
				}
			}
		}
		// return confirm('Data sudah benar?');
		return true;
	},function(){transaksi_getnomer();});
}

function transaksi_list_add(){
	var n=parseInt(E('transaksi_list_num').value)+1;
	EShow("xtr"+n);
	E('transaksi_list_num').value=n;
	if(n==7) E("fformt").style.paddingTop='5px';
	if(n==8) EHide("tlist_add");
}

function transaksi_tab_get(a){
	var n=parseInt(E("transaksi_tab_num").value);
	for(var i=1;i<=n;i++){
		EHide("transaksi_tab_"+i);
		E("gptab"+i).className="gptab";
	}
	E("gptab_index").value=a;
	EShow("transaksi_tab_"+a);
	E("gptab"+a).className="gptab1";
	
	if(a==8){
		$("#transaksi_tampil_menu").animate({opacity:0},"fast");
	} else {
		$("#transaksi_tampil_menu").animate({opacity:1},"fast");
	}
}

function transaksi_bukubesar_get(a){
	if(a==0){
		var t=parseInt(E("tampilrek").value);
		var n=parseInt(E("njurnal").value);
		if(t==0){
			for(var i=1;i<=n;i++){
				EShow("tabelrek"+i);
			}
		} else {
			for(var i=1;i<=n;i++){
				EHide("tabelrek"+i);
			}
			EShow("tabelrek"+t);
		}
	} else {
		var t1=parseInt(E("tampilrek1").value);
		var t2=parseInt(E("tampilrek2").value);
		var n=parseInt(E("njurnal").value);		
		for(var i=1;i<=n;i++){
			if(t1<=i && i<=t2){
				EHide("tabelrek"+i);
			} else {
				EShow("tabelrek"+i);
			}
		}
	}
}
function transaksi_jurnadetil(a){
	EDisplay("xth3",!a);
	EDisplay("xth4",a);
	var nr=parseInt(E("xtd_jd_num").value);
	for(var i=0;i<nr;i++){
		EDisplay("xtd_nom"+i,!a);
		EDisplay("xtd_jd"+i,a);
		E("xtd_urai"+i).style.width=a?"300px":"";
	}
}
