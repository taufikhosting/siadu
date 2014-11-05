fRp_shownul=false;

/* Callbacks */
function pageCallbacks(){
	if(PCBCODE==1){
		E("qcari").focus();
		E("qcari").value=E("qcari").value;
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
function EscapeFunction(){
	ESCCODE=0;
}
/*************** Halaman-halaman ***************/
/** Halaman tahunbuku **/
function tahunbuku_get(){
	gPage("tahunbuku");
}
function tahunbuku_form(o,cid,g){
	var f=[['nama','Nama tahun buku'],['kode','Kode awalan kwitansi',false,'w',10],['tanggal1','Tanggal dibuka',true,'t'],['saldoawal','Saldo awal',false,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"tahunbuku",tahunbuku_get,f);
}
function tahunbuku_status_form(o,cid,g){
	var f=[['aktif']];
	fform_std(o,cid,g,"tahunbuku_status",tahunbuku_get,f);
}
/** Halaman rekening **/
function rekening_get(){
	var d=['skategorirek'];
	gPage("rekening",gpage_purl(d));
}
function rekening_form(o,cid,g){
	var d=['skategorirek'];
	var f=[['kategorirek'],['kode','',true,'w',10],['nama','Nama tahun buku'],['keterangan','',false]];
	if(E('skategorirek').value!='0'){
		f=[['kode','',true,'w',10],['kategorirek'],['nama','Nama tahun buku'],['keterangan','',false]];
	}
	fform_std(o,cid,g,"rekening",rekening_get,f,fform_purl(d));
}
function rekening_setkode(){
	/*
	var k=E('kategorirek').value;
	var ck=0;
	if(E('kode').value!='') ck=parseInt(E('kode').value);
	if(k!='0' && (E('kode').value=='' || (ck>=1 && ck<=7))){
		E('kode').value=k;
	}
	*/
}

/** Halaman transaksi **/
function transaksi_get(){
	var d=['ct_umum','ct_pemasukan','ct_pengeluaran','ct_siswa','ct_calonsiswa','ct_barang','ct_jurnaldetil'];
	var e=['gptab_index','tanggal1','tanggal2'];
	gPage("transaksi",gpage_purlcheck(d)+fform_purl(e));
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

/** Halaman budget **/
function budget_get(){
	var d=['tahunbuku'];
	gPage("budget",gpage_purl(d));
}
function budget_form(o,cid,g){
	var d=['tahunbuku'];
	var f=[['nama','Nama anggaran'],['nominal','Nominal anggaran',true,'c'],['keterangan','',false]];
	fform_std(o,cid,g,"budget",budget_get,f,fform_purl(d));
}