/** Halaman departemen **/
function departemen_get(){
	gPage("departemen");
}
function departemen_form(o,cid,g){
	var f=[['nama','Nama Departemen'],['alamat','',false],['telepon','No telepon',false,'p']];
	fform_std(o,cid,g,"departemen",departemen_get,f);
}
function departemen_print(){
	print_fmod('departemen');
}
/** Halaman tahunajaran **/
function tahunajaran_get(){
	var departemen=E("departemen").value;
	gPage("tahunajaran","departemen="+departemen);
}
function tahunajaran_form(o,cid,g){
	var d=['departemen'];
	var f=[['tahunajaran','Nama tahun ajaran'],['tglmulai','Tanggal mulai',true,'t'],['tglakhir','Tanggal berakhir',true,'t'],['keterangan','',false],['salin','',false,'cx']];
	fform_std(o,cid,g,"tahunajaran",tahunajaran_get,f,fform_purl(d));
}
function tahunajaran_status_form(o,cid,g){
	var d=['departemen'];
	var f=[['aktif']];
	fform_std(o,cid,g,"tahunajaran_status",tahunajaran_get,f,fform_purl(d));
}
/** Halaman tingkat **/
function tingkat_get(){
	var d=['departemen','tahunajaran'];
	gPage("tingkat",gpage_purl(d));
}
function tingkat_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['tingkat'],['keterangan','',false]];
	fform_std(o,cid,g,"tingkat",tingkat_get,f,fform_purl(d));
}
function tingkat_print(){
	print_fmod('tingkat',['departemen']);
}
/** Halaman angkatan **/
function angkatan_get(){
	var departemen=E("departemen").value;
	gPage("angkatan","departemen="+departemen);
}
function angkatan_form(o,cid,g){	
	var d=['departemen'];
	var f=[['angkatan'],['keterangan','',false]];
	fform_std(o,cid,g,"angkatan",angkatan_get,f,fform_purl(d));
}
function angkatan_print(){
	window.open("print/angkatan.php","_blank");
}
/** Halaman semester **/
function semester_get(){
	var d=['departemen','tahunajaran'];
	gPage("semester",gpage_purl(d));
}
function semester_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['nama'],['keterangan','',false]];
	fform_std(o,cid,g,"semester",semester_get,f,fform_purl(d));
}
function semester_status_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['aktif']];
	fform_std(o,cid,g,"semester_status",semester_get,f,fform_purl(d));
}
/** Halaman ruang **/
function ruang_get(){
	var departemen=E("departemen").value;
	gPage("ruang","departemen="+departemen);
}
function ruang_form(o,cid,g){	
	var d=['departemen'];
	var f=[['kode','Kode ruang'],['nama','Nama ruang'],['keterangan','',false]];
	fform_std(o,cid,g,"ruang",ruang_get,f,fform_purl(d));
}
function ruang_print(){
	window.open("print/ruang.php","_blank");
}

/** Halaman kelas **/
function kelas_get(){
	var d=['departemen','tahunajaran','tingkat'];
	gPage("kelas",gpage_purl(d));
}
function kelas_form(o,cid,g){
	var d=['departemen','tahunajaran','tingkat'];
	var f=[['kelas','Nama kelas'],['wali','Wali',false,'dm',1],['kapasitas','',true,'d'],['keterangan','',false]];
	fform_std(o,cid,g,"kelas",kelas_get,f,fform_purl(d));
}
function kelas_setwali(a,b,c){
	E("nipguru").value=a;
	E("namaguru").value=b;
	E("wali").value=c;
}
/** Halaman kelompok **/
function kelompok_get(){
	var d=['departemen','tahunajaran'];
	gPage("kelompok",gpage_purl(d));
}
function kelompok_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['nama','Nama kelompok'],['keterangan','',false]];
	fform_std(o,cid,g,"kelompok",kelompok_get,f,fform_purl(d));
}
function kelompok_urut(o,a,id){
	var d=['departemen','tahunajaran'];
	if(o!='up' && o!='dn'){
		gPage("kelompok",gpage_purl(d)+"&opt="+o);
	} else {	
	_("_apps&app=urut&table="+a+"&id="+id+"&act="+o+"&page=kelompok_urut&opt=urut"+fform_purl(d),function(r){
		E('xtablebox').innerHTML=r;
	});}
}
/** Halaman tes **/
function tesakademik_get(){
	var d=['departemen','tahunajaran'];
	gPage("tesakademik",gpage_purl(d));
}
function tesakademik_form(o,cid,g){
	var d=['departemen','tahunajaran'];
	var f=[['nama','Nama tesakademik'],['keterangan','',false]];
	fform_std(o,cid,g,"tesakademik",tesakademik_get,f,fform_purl(d));
}