/* Halaman stock take */
function stocktake_get(){
	gPage("stocktake");
}
function stocktake_init(a){
	if(a==0){
		PCBCODE=4;
		gPage("stocktake","opt=init");
	}
	else if(a==1){
		var f=[['tanggal1'],['nama','Nama stock opname'],['keterangan','',false]];
		fform_std('a',0,true,"stocktake_init",function(){stocktake_init(2);},f);
	}
	else if(a==2){
		PCBCODE=5;
		gPage("stocktake","opt=batch");
	}
}
function stocktake_batch(){
	_("stocktake_batch",function(r){
		//alert(r);
		var d=r.split("-");
		var a=parseInt(d[0]);
		var b=parseInt(d[1]);
		var c=parseInt(a*100/b);
		var p=parseInt(a*400/b);
		E("pbarp").innerHTML=c+"%";
		E("pbar1").style.width=p+"px";
		if(a<b) setTimeout("stocktake_batch()",50);
		else stocktake_cek();
	});
}
function stocktake_cek(){
	_("stocktake_cek&opt=getcurrent",function(r){
		if(r=="1") gPage("stocktake","opt=cek");
		else stocktake_init(2);
	});
}
function stocktake_cekbarkode(event){
	if(event.which == 13){
		stocktake_cek_barkode();
	}
}
function stocktake_cancel(){
	E("barkode").value="";
	EHtml("scbcd","");
	EHide("okbtn");
	Efoc("barkode");
}
function stocktake_cek_barkode(){
	var barkode=E("barkode").value;
	EHtml("scbcd","");
	EHide("okbtn");
	E("scinfo","");
	
	if(barkode!=""){
		_("stocktake_cek&opt=cekbarkode&barkode="+barkode,function(r){
			if(r=="1"){
				E("scbcd").style.color="#ff4000";
				E("buku_id").value=0;
				EHtml("scbcd",barkode);
				EHtml("scinfo","Tidak ditemukan dalam database.");
			}
			else if(r=="2"){
				E("scbcd").style.color="#009000";
				E("buku_id").value=0;
				EHtml("scbcd",barkode);
				EHtml("scinfo","Item sudah dicek.");
			}
			else {
				var d=r.split("`");
				E("scbcd").style.color="#468ad2";
				E("buku_id").value=d[0];
				EHtml("scbcd",d[1]);
				EShow("okbtn");
				EHtml("scinfo","1 item ditemukan dalam database.");
				if(E("aoke").checked){
					setTimeout("stocktake_cek_buku()",1000);
				}
			}
		});
	} else {
		EHtml("scinfo","Masukkan barkode!");
	}
}
function stocktake_cek_buku(){
	var buku_id=E("buku_id").value;
	_("stocktake_cek&opt=cekbuku&cid="+buku_id,function(r){
		E("barkode").value="";
		EHtml("scbcd","");
		EHide("okbtn");
		var d=r.split("`");
		E("schist").value=d[0]+E("schist").value;
		EHtml("cekedbook",d[1]);
		E("pbar").style.width=d[3];
		if(parseInt(d[1])==parseInt(d[2])){
			E("schist").value="Semua buku sudah dicek."+E("schist").value;
			alert("Semua buku sudah di cek.");
		} else {
			Efoc("barkode");
		}
	});
}
function stocktake_daftar_get(g){
	if(g==0){page_search=0; page_sort=0;}
	_("stocktake_daftar"+xtable_pageparam(g,0),function(r){
		open_fform(r);
	});
}
function stocktake_cek_done(o){
	if(o=='af'){
		_("stocktake_cek_done&opt=af",function(r){
			open_fform(r);
		});
	} else {
		fform_sendclose("stocktake_cek_done&opt=a",function(r){
			if(r=="1") stocktake_note();
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_note(){
	gPage("stocktake","opt=note");
}
function stocktake_note_get(){
	gPage("stocktake","opt=note&tampil="+E('tampil').value);
}
function stocktake_note_form(o,id){
	if(o=='uf'){
		_("stocktake_note&opt=af&cid="+id,function(r){
			open_fform(r);
			Efoc('note');
		});
	} else {
		var note=E("note").value;
		fform_sendclose("stocktake_note&opt=a&cid="+id+"&note="+note,function(r){
			if(r!="-0-") EHtml("cttn"+id,r);
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_note_done(o){
	if(o=='af'||o=='df'){
		_("stocktake_note_done&opt="+o,function(r){
			open_fform(r);
		});
	} else {
		fform_sendclose("stocktake_note_done&opt="+o,function(r){
			if(r=="1") stocktake_finish();
			else if(r=="2") stocktake_cek();
			else alert("Terjadi kesalahan teknis program. Silahkan menghubungi administrator anda.");
		});
	}
}
function stocktake_finish(){
	gPage("stocktake","opt=finish");
}
function stocktake_report(id){
	gPage("stocktake","opt=report&cid="+id);
}
function stocktake_report_back(){
	gPage("stocktake","opt=hist");
}
function stocktake_hist(){
	gPage("stocktake","opt=hist");
}
function stocktake_hist_get(){
	stocktake_hist();
}
function stocktake_hist_back(){
	gPage("stocktake");
}
function stocktake_hist_form(o,cid,g){
	var f=[['nama','Nama stock opname'],['keterangan','',false]];
	fform_std(o,cid,g,"stocktake_hist",stocktake_hist_get,f);
}
function stocktake_print(a){
	var lap_cetak=E("lap_cetak").value;
	var lap_tglcetak=E("lap_tglcetak").checked?1:0;
	var lap_sum=E("lap_sum").checked?1:0;
	var lap_kertas=E("lap_kertas").value;
	window.open("print/stocktake.php?file=stocktake&token="+a+"&lap_cetak="+lap_cetak+"&lap_tglcetak="+lap_tglcetak+"&lap_sum="+lap_sum+"&psize="+lap_kertas+"&pori=L","_blank");
}