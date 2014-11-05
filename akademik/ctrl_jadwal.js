function jadwal_sks_get(){
	var d=['tahunajaran'];
	_("jadwal_sks_get"+fform_purl(d),function(r){
		EHtml("box_jadwal_sks",r);
	});
}
function jadwal_sks_pick_save(){
	var sks=parseInt(E("sks_picked").value);
	var kelas=parseInt(E("sks_picked_kelas").value);
	var hari=parseInt(E("sks_picked_hari").value);
	var jam=parseInt(E("sks_picked_jam").value);
	var skstodrop=parseInt(E("sks_todrop").value);
	var skstodel=parseInt(E("sks_todel").value);
	if(skstodel!=0){
		if(!confirm("Hapus pelajaran?")) skstodel=0;
	}
	if(sks!=0 && ((kelas!=0 && hari!=0 && jam!=0) || (skstodrop!=0) || (skstodel!=0))){
		E("jadwal_notifmsg").innerHTML="Loading...";
		EShow("jadwal_notifbox");
		var opt="a";
		if(skstodel==sks) opt="d";
		if(skstodrop==sks) opt="u";
		_("jadwal_sks&opt="+opt+"&sks="+sks+"&kelas="+kelas+"&hari="+hari+"&jam="+jam,function(r){
			jadwal_sks_get();
			sks_get();
			if(r=="0"){
				EHide("jadwal_notifbox");
			} else {
				jadwal_sks_reset();
				if(r=="1") E("jadwal_notifmsg").innerHTML="Jam tersebut sudah terisi!";
				else if(r=="2") E("jadwal_notifmsg").innerHTML="Guru bentrok pada hari dan jam yang sama!";
				else if(r=="3") E("jadwal_notifmsg").innerHTML="Tidak dapat mengubah jadwal!";
				else if(r=="4") E("jadwal_notifmsg").innerHTML="Tidak dapat menghapus jadwal!";
				setTimeout('EHide("jadwal_notifbox")',3000);
			}
		});
	} else {
		jadwal_sks_reset();
	}
}
function jadwal_sks_pick(sks,kode,kls){
	E("global").className="selectdiabled";
	E('sks_picked_kode').value=kode;
	E('sks_picked').value=sks;
	E('sks_picked_kelas').value=kls;
	E("sks_picked_opt").value='pick';
	EHtml("tmpbox_stock",kode);
	EHide("box_sks_stock_"+sks);
	BODY_SERVICE_CODE=1;
	jadwal_sks_service();
}
function jadwal_sks_reset(){
	var sid=E("sks_picked").value;
	if(E("sks_picked_opt").value=='pick'){
		EShow("box_sks_stock_"+sid);
	}
	else if(E("sks_picked_opt").value=='repick'){
		EShow("box_jsd_"+sid);
	}
	var klsid=E("jadwalkelasid").value;
	var klsids=klsid.split(",");
	for(var i=0;i<klsids.length;i++){
		var kls=klsids[i];
		E("box_jsr_"+kls).className="jadwal_row";
		E("box_sks_allstock_"+kls).className='jadwal_stock';
		E("box_sks_substock_"+kls).style.visibility='visible';
	}
	E("sks_picked").value=0;
	E("sks_picked_kode").value="";
	E("sks_picked_kelas").value=0;
	E("sks_picked_hari").value=0;
	E("sks_picked_jam").value=0;
	E("sks_picked_opt").value='drop';
}
function jadwal_sks_drop(){
	BODY_SERVICE_CODE=0;
	EHide("tmpbox_stock");
	EHide("jadwal_trashcan");
	E("global").className="selectenabled";
	jadwal_sks_pick_save();
	jadwal_sks_unhover_all();
	//jadwal_sks_kelas_unhover_all();
	//E("sks_picked_opt").value='drop';
}
function jadwal_sks_unhover_all(){
	var klsid=E("jadwalkelasid").value;
	var klsids=klsid.split(",");
	for(var i=0;i<klsids.length;i++){
		var kls=klsids[i];
		for(var h=1;h<=5;h++){
			for(var j=1;j<=7;j++){
				jadwal_sks_unhover(kls,h,j);
			}
		}
	}
}
function jadwal_sks_hover(k,h,j){
	jadwal_sks_unhover_all();
	E("box_jsk_"+k).style.background="#ffff00";
	E("box_jsj_"+h+"_"+j).style.background="#ffff00";
	E("sks_picked_kelas").value=k;
	E("sks_picked_hari").value=h;
	E("sks_picked_jam").value=j;
}
function jadwal_sks_unhover(k,h,j){
	E("box_jsk_"+k).style.background="";
	E("box_jsj_"+h+"_"+j).style.background="";
	E("sks_picked_hari").value=0;
	E("sks_picked_jam").value=0;
}
function jadwal_sks_kelas_unhover(kls){
	E("box_sks_allstock_"+kls).className='jadwal_stock_off';
	E("box_sks_substock_"+kls).style.visibility='hidden';
}
function jadwal_sks_kelas_unhover_all(){
	var klsid=E("jadwalkelasid").value;
	var klsids=klsid.split(",");
	for(var i=0;i<klsids.length;i++){
		var kls=klsids[i];
		jadwal_sks_kelas_unhover(kls);
	}
}
function jadwal_sks_kelas_hover(kls){
	jadwal_sks_kelas_unhover_all();
	if(kls!=0){
		E("box_sks_allstock_"+kls).className='jadwal_stock_on';
		E("box_sks_substock_"+kls).style.visibility='visible';
	}
}
function jadwal_sks_repick(sks,kode,kls){
	E("global").className="selectdiabled";
	E('sks_picked_kode').value=kode;
	E('sks_picked').value=sks;
	E('sks_picked_kelas').value=kls;
	E("sks_picked_opt").value='repick';
	EHtml("tmpbox_stock",kode);
	EHide("box_jsd_"+sks);
	BODY_SERVICE_CODE=1;
	jadwal_sks_service();
}