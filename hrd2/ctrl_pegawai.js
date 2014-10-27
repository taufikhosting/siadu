function pegawai_get(){
	gPage("pegawai");
}
function pegawai_form(o,cid,g){
	//var d = [];
	if(o=='af'||o=='uf'){
		//d.push('pegawai_view');
		PCBCODE=1;
		gPage("pegawai","&opt="+o+"&cid="+cid);
	}
	else {
		var f=[   
			['nip','NIP',true],
			['nama','Nama',false],
			['tmplahir','Tempat lahir',true],
			['tgllahir','Tanggal lahir',true,'t'],
			['status','Status pegawai',true,'s']
			];
		/*
		if(o=='a'||o=='u'){
			fform_std(o,cid,g,"pegawai",function(r){
				pegawai_form_view(r);
				hideNotif();
			},f);
		} else {
			fform_std(o,cid,g,"pegawai",pegawai_get,f);
		}*/
		fform_std(o,cid,g,"pegawai",pegawai_get,f);
	}
}