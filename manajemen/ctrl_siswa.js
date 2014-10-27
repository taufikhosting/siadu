function siswa_detil_print(a,nis){
	window.open("print.php?doc=siswa_detil&docname=Data Siswa - NIS: "+nis+"&token="+a,"_blank");
}
function siswa_detil(a){
	_("siswa_detil&id="+a,function(r){
		E("fform3").innerHTML=r;
		open_fform3();
	});
}


function siswa_pendataan_angkatan_form_view(a){
	siswa_detil(a);
}
function siswa_pendataan_angkatan_get(){
	var d=['departemen','angkatan','gptab_index'];
	gPage("siswa_pendataan",gpage_purl(d)+xtable_pageparam());
}

function siswa_pendataan_kelas_form_view(a){
	siswa_detil(a);
}
function siswa_pendataan_kelas_get(){
	var d=['departemen','tahunajaran','tingkat','kelas','gptab_index'];
	gPage("siswa_pendataan",gpage_purl(d)+xtable_pageparam());
}
function siswa_pendataan_kelas_list_get(){
	var d=['ff_departemen','ff_angkatan','kelas'];
	
	_("siswa_pendataan_kelas_list_get"+fform_purl(d)+xtable2_pageparam(),function(r){
		EHtml("box_siswa_pendataan_kelas_list",r);
	});
}
function siswa_pendataan_kelas_list_cek(cekall,ncek){
	EDisplay("fform_yes_btn",(ncek>0));
}
function siswa_pendataan_kelas_form(o,cid,g){
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var d=['kelas'];
	var s=fform_purl(d);
	var f=[];
	if(o=='a'){
		s+="&data="+E("xtable2_selectedid").value;
	}
	fform_std(o,cid,g,"siswa_pendataan_kelas",siswa_pendataan_kelas_get,f,s,0,function(){
		EHide("fform_yes_btn");
	});
}

function siswa_form(o,cid,g){
	var d=['departemen','angkatan'];
	if(o=='af'){
		_("siswa_get",function(r){
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
		fform_sendclose("siswa&opt=a&data="+s+fform_purl(d),siswa_get);
	}
	else if(o=='uf'){
		gPage("siswa",gpage_purl(d)+"&opt="+o+"&cid="+cid);
	}
	else {
		var f=[
		
			['nama','Nama calon siswa'],
			['kelamin','Jenis kelamin'],
			['tmplahir','Tempat lahir'],
			['tgllahir','Tanggal lahir',true,'t'],
			['agama','Agama calon siswa',false,'s'],
			['alamat'],
			['telpon','No telepon',false,'p'],
			['sekolahasal','Sekolah asal',false],
			
			['ayah-nama','Nama Ayah',true],
			['ayah-warga','Kebangsaan Ayah',false],
			['ayah-tmplahir','Tempat lahir Ayah',false],
			['ayah-tgllahir','Tanggal lahir Ayah',false,'t'],
			['ayah-pekerjaan','Pekerjaan Ayah',false],
			['ayah-telpon','Nomor telepon Ayah',false,'p'],
			['ayah-pinbb','Pin BB Ayah',false],
			['ayah-email','Email Ayah',false],
			
			['ibu-nama','Nama Ibu',true],
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
		
		fform_std(o,cid,g,"siswa",siswa_get,f,fform_purl(d));
	}
}