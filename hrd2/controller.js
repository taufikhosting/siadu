/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		Efoc("nip");
	}
	PCBCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman status **/
function status_get(){
	gPage("status");
}
function status_form(o,cid,g){
	var f=[['status','Status pegawai'],['reminder','Pengingat',false,'d'],['keterangan','',false]];
	fform_std(o,cid,g,"status",status_get,f);
}
/** Halaman tingkat **/
function tingkat_get(){
	gPage("tingkat");
}
function tingkat_form(o,cid,g){
	var f=[['tingkat','tingkat pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"tingkat",tingkat_get,f);
}
/** Halaman bagian **/
function bagian_get(){
	gPage("bagian");
}
function bagian_form(o,cid,g){
	var f=[['bagian','bagian pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"bagian",bagian_get,f);
}
/** Halaman kelompok **/
function kelompok_get(){
	gPage("kelompok");
}
function kelompok_form(o,cid,g){
	var f=[['kelompok','kelompok pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"kelompok",kelompok_get,f);
}
/** Halaman posisi **/
function posisi_get(){
	gPage("posisi");
}
function posisi_form(o,cid,g){
	var f=[['posisi','posisi pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"posisi",posisi_get,f);
}
/** Halaman dokumen **/
function dokumen_get(){
	gPage("dokumen");
}
function dokumen_form(o,cid,g){
	var f=[['dokumen','dokumen pegawai'],['reminder','Pengingat',false,'d'],['keterangan','',false]];
	fform_std(o,cid,g,"dokumen",dokumen_get,f);
}
/** Halaman keluarga **/
function keluarga_get(){
	gPage("keluarga");
}
function keluarga_form(o,cid,g){
	var f=[['keluarga','keluarga pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"keluarga",keluarga_get,f);
}
/** Halaman marital **/
function marital_get(){
	gPage("marital");
}
function marital_form(o,cid,g){
	var f=[['marital','marital pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"marital",marital_get,f);
}
/** Halaman jenistraining **/
function jenistraining_get(){
	gPage("jenistraining");
}
function jenistraining_form(o,cid,g){
	var f=[['jenistraining','jenistraining pegawai'],['keterangan','',false]];
	fform_std(o,cid,g,"jenistraining",jenistraining_get,f);
}
/** Halaman pendataan **/
function pendataan_get(){
	gPage("pendataan");
}
function pendataan_add(){
	gPage("pendataan","opt=add");
}
function pendataan_edit(a){
	gPage("pendataan","opt=edit&id="+a);
}
function pendataan_form(o){
	var f=[['nip'],
		['nama'],
		['kelamin','Jenis kelamin'],
		['tmplahir','Tempat lahir'],
		['tgllahir','Tanggal lahir',true,'t'],
		['agama','',false],
		['warga','',false],
		['alamat','',false],
		['kodepos','',false,'n'],
		['telpon','No telepon',false,'p'],
		['pinbb','Pin BB',false,'p'],
		['email','Email',false],
		['posisi'],
		['tingkat'],
		['bagian'],
		['status'],
		['kelompok'],
		['photo','',false],
		['darah','',false],
		['berat','',false,'n'],
		['tinggi','',false,'n'],
		['kesehatan','',false],
		['keterangan','',false]];
	/*
	var q="";
	for(var i=0;i<f.length;i++){
		q+="'"+f[i][0]+"',";
	}
	E("tempes").innerHTML=q;
	return 0;*/
	if(svalidate_r(f)){
		var s="";
		for(var i=0;i<f.length;i++){
			s+="&"+f[i][0]+"="+E(f[i][0]).value;
		}
		var act=o=="s"?"save":"update&id="+o;
		_("pendataan_"+act+s,function(r){
			pendataan_get();
			if(typeof tnotif !== 'undefined') clearTimeout(tnotif);
			tnotif=setTimeout("hideNotifbox()",3000);
		});
	}
}
function pendataan_del(a,b){
	_("pendataan_del&opt=df&id="+a+"&name="+b,function(r){
		E("fform").innerHTML=r;
		open_fform();
	});
}
function pendataan_delete(a){
	_("pendataan_del&opt=d&id="+a,function(r){
		close_fform();
		pendataan_get();
		if(typeof tnotif !== 'undefined') clearTimeout(tnotif);
		tnotif=setTimeout("hideNotifbox()",3000);
	});
}

/** Halaman training **/
function training_get(){
	gPage("training");
}
function training_form(o,cid,g){
	var f=[['judul'],['penyelenggara'],['tempat'],['tgl1','Tanggal mulai',true,'t'],['tgl2','Tanggal akhir',false,'t'],['pembicara','',false],['peserta','',false],['jenistraining']];
	fform_std(o,cid,g,"training",training_get,f);
}