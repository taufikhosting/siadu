/* Callbacks */
function pageCallbacks(){
	PCBCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman file **/
function file_get(){
	gPage("file");
}
function file_form(o,cid,g){
	var f=[['nama','Judul'],['ufile','File',false,'+'],['fname','File',false,'+'],['keterangan','',false]];
	fform_std(o,cid,g,"file",file_get,f);
}
function file_download(a){
	E("fid").value=a;
	E("getfile").submit();
}
/** Halaman grup **/
function grup_get(){
	gPage("grup");
}
function grup_form(o,cid,g){
	var f=[['nama','Nama anggota',false],['uname','User ID'],['passwd','Password',(o=='a'?true:false),'pw']];
	fform_std(o,cid,g,"grup",grup_get,f);
}
