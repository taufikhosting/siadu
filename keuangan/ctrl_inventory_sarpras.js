/* Callbacks 
function pageCallbacks(){
	if(PCBCODE==1){
		Efoc('judul');
	}
	else if(PCBCODE==2){
		Efoc('kode');
	}
	else if(PCBCODE==3){
		katalog_unit_pie();
		//alert('yay');
	}
	else if(PCBCODE==4){
		var peminjaman=E('peminjaman').value;
		pengembalian_setpeminjaman(peminjaman);
	}
	PCBCODE=0;
}
function EscapeFunction(){
	if(ESCCODE==1){
		barang_get();
	}
	else if(ESCCODE==2){
		katalog_get();
	}
	ESCCODE=0;
}*/
/*************** Halaman-halaman ***************/

// [id -> sesuaikan nama kolom di db, label <sama dg id>, (<true>/false) -> harus diisi atau tidak, tipe]

/** Halaman inventaris **/
function inventaris_get(){
	var d=['lokasi','gptab_index'];
	gPage("invent",gpage_purl(d)+xtable_pageparam());
}
function inventaris_form(o,cid,g){
	var d=['lokasi'];
	var f=[['kode'],['nama'],['keterangan','Keterangan',false]];
	fform_std(o,cid,g,"inventaris",inventaris_get,f,fform_purl(d));
}
function inventaris_form_view(cid){
	var d=['lokasi','gptab_index'];
	gPage("invent",gpage_purl(d)+xtable_pageparam()+"&spage=katalog&grup="+cid);
}
function inventaris_print(){
	window.open("print/?file=inventaris","_blank");
}
function katalog_get(){
	var d=['lokasi','grup'];
	gPage("katalog",gpage_purl(d));
}
function katalog_back(){
	inventaris_get();
}
function katalog_form_view(cid){
	var d=['lokasi','grup','gptab_index']; PCBCODE='show_katalog_unit_pie';
	gPage("invent",gpage_purl(d)+xtable_pageparam()+"&spage=katalog_unit&cid="+cid);
}
function katalog_unit_back(a){
	katalog_get();
}
function katalog_unit_get(){
	katalog_form_view(E('katalog').value);
}
function katalog_unit_back(){
	var d=['lokasi','grup','katalog','gptab_index'];
	gPage("invent",gpage_purl(d)+xtable_pageparam()+"&spage=katalog");
}
function katalog_unit_pie(){
	var a=parseInt(E('kondisi_1').value);
	var b=parseInt(E('kondisi_2').value);
	var c=parseInt(E('kondisi_3').value);
	var d=parseInt(E('kondisi_4').value);
	var tot=a+b+c+d;
	var data = [
        {label: "Sangat baik", data: a, color:'#0050ff'},
        {label: "Baik", data: b, color:'#00f500'},
        {label: "Buruk", data: c, color:'#ff8000'},
        {label: "Sangat Buruk", data: d, color:'#ff0000'}
    ];
	$.plot($("#placeholder"), data, {
		series: {
			pie: {
				show: true,
				radius: 1, 
				offset: {
					top: 0,//integer value to move the pie up or down
					left:-80//integer value to move the pie left or right, or 'auto'
				},
				stroke: {
					width: 2
				},
				label: {
					show: true,
					formatter: function (label, series) {
						return '<div style="font-size:11px;text-align:center;color:#000;border-radius:5px;padding:0px 2px;background:#fff"><b>'+   
						Math.round(series.percent*tot/100) + '</b> unit</div>';
					}
				},
			}
		},
		legend: {
			show: true
		}
	});
}