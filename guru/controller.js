/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		aspekpenilaian_form('af');
	}
	else if(PCBCODE==99){
		js_init_tinymce();
	}
	PCBCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman rpp **/
function rpp_get(){
	var d=['pelajaran','tingkat'];
	gPage("rpp",gpage_purl(d));
}
function rpp_form(o,cid,g){
	var d=['pelajaran','tingkat'];
	var f=[['unit','Unit'],['deskripsi','',false,'x']]; //PCBCODE=99;
	fform_std(o,cid,g,"rpp",rpp_get,f,fform_purl(d),0,js_init_tinymce);
}
/** Halaman penilaian **/
function penilaian_get(){
	var d=['pelajaran','kelas'];
	gPage("penilaian",gpage_purl(d));
}
function penilaian_form(o,cid,g){
	var d=['pelajaran','kelas'];
	var f=[['nama','Nama penilaian'],['kode','Kode',true,'an',5],['kkm','KKM',true,'n'],['bobot','Bobot penilaian',true,'n'],['keterangan','',false]];
	fform_std(o,cid,g,"penilaian",penilaian_get,f,fform_purl(d));
}


/** Halaman daftarnilai **/
function daftarnilai_get(){
	var d=['pelajaran','kelas','penilaian'];
	gPage("daftarnilai",gpage_purl(d));
}
function daftarnilai_form(o,cid,g){
	var d=['pelajaran','kelas','penilaian'];
	var f=[]; var s="";
	if(o=='u'){
		var allid=E("xtable2_allid").value;
		s+="&data="+allid;
		var ids=allid.split(",");
		for(var i=0;i<ids.length;i++){
			f.push(['nilai_'+ids[i],'Nilai',false,'n']);
		}
	}
	fform_std(o,cid,g,"daftarnilai",daftarnilai_get,f,fform_purl(d)+s);
}

/** Halaman jurnalp **/
function jurnal_get(){
	var d=['pelajaran','kelas'];
	gPage("jurnal",gpage_purl(d));
}
function jurnal_form(o,cid,g){
	var d=['pelajaran','kelas'];
	var f=[['tanggal','Tanggal',true,'t'],['keterangan','',false,'x']]; //PCBCODE=99;
	fform_std(o,cid,g,"jurnal",jurnal_get,f,fform_purl(d),0,js_init_tinymce);
}

/** Halaman nilairapor **/
function nilairapor_get(){
	var d=['pelajaran','kelas'];
	gPage("nilairapor",gpage_purl(d));
}
function nilairapor_bobot_form(o,cid,g){
	var d=['pelajaran','kelas'];
	var f=[];
	var s="";
	if(o=='u'){
		var allid=E("allid").value;
		s+="&data="+allid;
		var ids=allid.split(",");
		for(var i=0;i<ids.length;i++){
			f.push(['bobot_'+ids[i],'Bobot',true,'n']);
		}
	}
	fform_std(o,cid,g,"nilairapor_bobot",nilairapor_get,f,fform_purl(d)+s);
}

function nilairapor_komen_form(o,cid,g){
	var d=['pelajaran','kelas'];
	var f=[['komen','',true]];
	fform_std(o,cid,g,"nilairapor_komen",function(r){
		E("ket_"+cid).innerHTML=r;
		//callNotifbox("page");
	},f,fform_purl(d));
}