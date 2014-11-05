/* Callbacks */
function pageCallbacks(){
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