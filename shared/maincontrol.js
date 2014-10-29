var tnotif;
var iTextA = false;
var page_sort=0;
var page_sort_dir='ASC';
var page_open=1;
var page_number=1;
var page_current='';
var page_search=0;
//var body_mouse_service=Array();
var BODY_SERVICE_CODE=0;
var XTICKER=0;

function jadwal_sks_service(){
	var x=E("body_mouse_x").value;
	var y=E("body_mouse_y").value;
	//E("box_global_info").innerHTML=XTICKER; XTICKER++; if(XTICKER==10000)XTICKER=0;
	var stock=E("tmpbox_stock");
	stock.style.left=(parseInt(x)-14)+'px';
	stock.style.top=(parseInt(y)-14)+'px';
	EShow("tmpbox_stock");
	EShow("jadwal_trashcan");
	var klsid=E("jadwalkelasid").value;
	var klsids=klsid.split(",");
	
	var sks_picked_kelas=E("sks_picked_kelas").value;
	E("sks_todrop").value=0;
	E("sks_todel").value=0;
	var pos=EfindPos("jadwal_trashcan");
	var w=E("jadwal_trashcan").offsetWidth;
	var h=E("jadwal_trashcan").offsetHeight;
	var x1=pos[0];
	var y1=pos[1];
	var x2=pos[0]+w;
	var y2=pos[1]+h;
	//E("box_global_info").innerHTML=x1;
	if(x1<=x && x<=x2 && y1<=y && y<=y2){
		E("sks_todel").value=E("sks_picked").value;
		E("jadwal_trashcan").className="jadwal_trash_on";
	} else {
		E("jadwal_trashcan").className="jadwal_trash";
	}
	
	//E("box_global_info").innerHTML=klsid;
	//E("box_global_info").innerHTML=klsid+"<br/>";
	var gkls=0; var gh=0; var gj=0; var klstd=0;
	for(var i=0;i<klsids.length;i++){
		var kls=klsids[i];
		if(kls==sks_picked_kelas){
			E("box_jsr_"+kls).className="jadwal_row_on";
			for(var h=1;h<=5;h++){
				for(var j=1;j<=7;j++){
					var bjss=E("box_jss_"+kls+"_"+h+"_"+j);
					if(bjss!=null){
						var pos=EfindPos("box_jss_"+kls+"_"+h+"_"+j);
						var w=bjss.offsetWidth;
						var he=bjss.offsetHeight;
						var x1=pos[0];
						var y1=pos[1];
						var x2=pos[0]+w;
						var y2=pos[1]+he;
						if(x1<=x && x<=x2 && y1<=y && y<=y2){
							gkls=kls; gh=h; gj=j;
						}
					}
				}
			}
			if(E("sks_picked_opt").value=='repick'){
				var pos=EfindPos("box_sks_allstock_"+kls);
				var w=E("box_sks_allstock_"+kls).offsetWidth;
				var h=E("box_sks_allstock_"+kls).offsetHeight;
				var x1=pos[0];
				var y1=pos[1];
				var x2=pos[0]+w;
				var y2=pos[1]+h;
				//E("box_global_info").innerHTML=x1;
				if(x1<=x && x<=x2 && y1<=y && y<=y2){
					E("sks_todrop").value=E("sks_picked").value;
				}
			} else {
				E("sks_todrop").value=0;
			}
		} else {
			E("box_jsr_"+kls).className="jadwal_row_off";
		}
	}
	jadwal_sks_kelas_hover(sks_picked_kelas);
	jadwal_sks_hover(gkls,gh,gj);
}

function body_get_mousexy(x,y){
	//var x=window.event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	//var y=window.event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
	E("body_mouse_x").value=x;
	E("body_mouse_y").value=y;
	if(BODY_SERVICE_CODE==1){
		jadwal_sks_service();
	} else {
		BODY_SERVICE_CODE=0;
	}
}
/* Panel Sliding */
function slide(n,k){
	$("#pagetitle").animate({opacity:0},200);
	$("#panel").animate({marginLeft:tpos[n]},200*(dabs(CSLIDE-n)+1),function(){
		E("pagetitle").innerHTML=tiletitle[k];
		$("#pagetitle").animate({opacity:1},200);
		CSLIDE=n;
	});
}
function gpage_cari(event,f){
	//alert(event.which);
	if(event.which == 13){
		f();
	}
}
$(document).keyup(function(event) {
	if (event.which == 27) {
		if(E("fform3").style.display!='none'){
			close_fform3();
			ESCCODE=0;
		}
		else if(E("fform2").style.display!='none'){
			close_fform2();
			ESCCODE=0;
		}
		else if(E("fform").style.display!='none'){
			close_fform();
			ESCCODE=0;
		}
		EscapeFunction();
		ESCCODE=0;
	}
	else if(event.which == 13 && !iTextA){
		if(E("fform2").style.display=='none' && E("fform3").style.display=='none'){
			if(E("fform").style.display!='none'){
				if(E("fform_globalkey").value=="1"){
					setTimeout(E("fform_action").value,50);
				}
			}//alert('a');
		}
	}
});
//$(document).on("contextmenu", function(event) { event.preventDefault(); });
$('document').ready(function(){
	// session chalange
	
	//var _0xe79d=["\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x62\x6F\x64\x79","\x3C\x64\x69\x76\x20\x69\x64\x3D\x22\x63\x6F\x70\x79\x72\x69\x67\x68\x74\x22\x3E\x43\x6F\x70\x79\x72\x69\x67\x68\x74\x20\x26\x63\x6F\x70\x79\x3B\x20\x4A\x6F\x68\x61\x6E\x20\x4B\x68\x61\x72\x69\x73\x6D\x61\x20\x2D\x20\x41\x6C\x6C\x20\x72\x69\x67\x68\x74\x20\x72\x65\x73\x65\x72\x76\x65\x64\x20\x26\x6E\x62\x73\x70\x3B\x26\x6E\x62\x73\x70\x3B\x26\x6E\x62\x73\x70\x3B\x3C\x2F\x64\x69\x76\x3E"];document[_0xe79d[1]][_0xe79d[0]]+=_0xe79d[2];
	
	E("username").focus();
	
	hideNotif();
	
	$(document).mousemove(function(event){
	  body_get_mousexy(event.pageX,event.pageY);
	});
	
});
/* Fade Animation */
function fadeTile(a){
	$("#tile"+a).fadeIn("fast");
}
function fadeTileset(a){
	var tsids=E("tilesetid"+a).value;
	var tsid=tsids.split("-");
	var td=0;	
	for(var i=0;i<tsid.length;i++){
		setTimeout("fadeTile("+tsid[i]+")",td);
		td+=50;
	}
}
/* Start or End App */
function openApp(info){
	_("_apps&app=panel",function(r){
		E("panel").innerHTML=r;
		E("maincontainer").style.marginRight='0px';
		E("maincontainer").style.marginLeft='0px';
		E("panel").style.marginLeft='20px';
		E("pagetitle").style.marginLeft='20px';
		EHtml('userinformation',info);
		EHide("loader4");
		EHide("loginscreen");
		EHide("tabmenu2");
		EShow("tabmenu3");
		EShow("tabmenu4");
		EShow("tabmenu5");
		E("usession").value="admin";
		var ntile=parseInt(E("ntile").value);
		ntile=ntile>10?10:ntile;
		for(var i=1;i<ntile;i++){
			EHide("tile"+i);
		}
		EShow("pagetitle");
		EShow("panel");
		EShow("pagetitle");
		fadeTiles();
		CSLIDE=CSLIDE0;
		_("_apps&app=menu",function(r){
			E("pagetitle").innerHTML=HomeTitle;
			E("tabmenu").innerHTML=r;
		});
	});
}
function closeApp(){
	EHide("loader4");
	EHide("pagetitle");
	EHide("panel");
	EHide("pagebox");
	E("usession").value="";
	E("userpasswd").value="";
	E("username").value="";
	//EShow("loginbtn");
	EHide("userwarn");
	EHide("tabmenu3");
	EHide("tabmenu4");
	EHide("tabmenu5");
	E("tabmenu").innerHTML="";
	$("#loginscreen").fadeIn("slow");
	$("#tabmenu2").fadeIn("slow");
	
}
/* Page Tabs */
function gpage_tab_get(a){
	var n=parseInt(E("gptab_num").value);
	for(var i=1;i<=n;i++){
		EHide("gpage_tab_"+i);
		E("gptab"+i).className="gptab";
	}
	E("gptab_index").value=a;
	EShow("gpage_tab_"+a);
	E("gptab"+a).className="gptab1";
}
function gpage_tab_singlebox_get(a){
	var page=E("gptab_page"+a).value;
	EHide("box_gpage_tab");
	EShow("loader_gpage_tab");
	_("_apps&app=gpage_tab&page="+page,function(r){
		var n=parseInt(E("gptab_num").value);
		for(var i=1;i<=n;i++){
			E("gptab"+i).className="gptab";
		}
		E("gptab"+a).className="gptab1";
		E("gptab_index").value=a;
		EHtml("box_gpage_tab",r);
		EHide("loader_gpage_tab");
		EShow("box_gpage_tab");
	});	
}
/* Page Ceks */
function gpage_ceknum(){
	var ncek=0;
	var n=parseInt(E('gpceknum').value);
	for(var i=0;i<n;i++){
		if(E('gpcek'+i).checked) ncek++;
	}
	if(ncek==n){
		E('gpcekt').checked=true;
	} else {
		E('gpcekt').checked=false;
	}
	if(ncek>0){
		E("gpage_cek_opt").style.display='';
	} else {
		E("gpage_cek_opt").style.display='none';
	}
	return ncek;
}
function gpage_cekall(a){
	var n=parseInt(E('gpceknum').value);
	for(var i=0;i<n;i++){
		E('gpcek'+i).checked=a;
	}
	gpage_ceknum();
}
function gpage_cek(a,b){
	E('gpcek'+a).checked=b;
	gpage_ceknum();
}
function gpage_getceknum(){
	var n=parseInt(E('gpceknum').value);
	return n;
}

/* Page Callbacks */
var PCBCODE=0;
function sPage(){
	EHide("loader");
	$("#page").fadeIn("fast",function(){
	EShow("page");
	E("page").style.overflow='visible';pageCallbacks();
	});
}
function showPage(){
	//setTimeout("gPage_seekfull()",300);
	setTimeout("sPage()",100);
	//sPage();
}
function gpage_reload(){
	window.location.reload();
}
var page_isloading=true;
var page_timeout=0;
function gPage_seekfull(){
	page_isloading=false;
}
function gPage_seekloader(prw){
	E("loaderbar").style.width=prw+'%';
	if(prw<98){
		if(prw>90) prw+=0.01;
		else if(prw>80) prw+=1;
		else if(prw>70) prw+=2;
		else if(prw>50) prw+=5;
		else if(prw>20) prw+=40;
		else prw+=5;
		if(page_isloading) setTimeout("gPage_seekloader("+prw+")",50);
		else {
			E("loaderbar").style.width='100%';
			setTimeout("sPage()",100);
		}
	}
	//else E("loaderbar").style.width='100%';
}
function gPage(a,b){
	var usession=E("usession").value;
	if(usession!=""){
	EHide("copyright");
	EHide("panel");
	EShow("pagebox");
	var pw=$("#page").width();
	var ph=$("#page").height();
	if(ph<=450) ph=450;
	$("#pagepreview").width(pw);
	$("#loader").width(pw);
	$("#loader").height(ph);
	EHide("page");
	EShow("loader");
	//page_isloading=true; page_timeout=0; gPage_seekloader(0);
	if(b!="") b="&"+b;
	var xtable_param="";
	var xt=E("xtable_page_name");
	//alert(xt);
	if(xt!=null){
		//alert(E("xtable_page_name").value);
		//alert(a+" : "+E("xtablefmod").value);
		if(a==E("xtable_page_name").value){
			xtable_param=xtable_pageparam();
		}
	}
	//alert("xtable_param:"+xtable_param);
	_("_apps&app=view&page="+a+b+xtable_param,function(r){
		E("cpage").value=a;
		E("page").innerHTML=r;
		E("pagepreview").innerHTML=r;
		var pvh=$("#pagepreview").height();
		if(pvh<=450) pvh=450;
		if(pvh!=ph){
			$("#loader").animate({height:pvh},500,showPage());
		} else showPage();
	});
	}
}
function getPage(a,b){
	var usession=E("usession").value;
	if(usession!=""){
	b = typeof b !== 'undefined' ? b : "";
	$("#panel").fadeOut("fast",gPage(a,b));
	}
}
function dabs(a){
	if(a<0)return -a;
	else return a;
}
function openHome(n){
	n = typeof n !== 'undefined' ? n : 1;
	E("pagetitle").innerHTML=HomeTitle;
	EHide("pagebox");
	E("maincontainer").style.marginRight='0px';
	E("maincontainer").style.marginLeft='0px';
	E("panel").style.marginLeft='20px';
	E("pagetitle").style.marginLeft='20px';
	$("#panel").fadeIn("slow");
	_("_apps&app=menu",function(r){
		E("tabmenu").innerHTML=r;
	});
	E("cpage").value="home";
	EShow("copyright");
	CSLIDE=n;
	page_sort=0;
}
/** Notification **/
function hideNotifbox(){
	$("#notifbox").animate({opacity:0,paddingTop:'0px',paddingBottom:'0px'},500,function(){EHide("notifbox");E("notifbox").id="notifbox2";});
}
function hideNotifbox2(){
	$("#notifbox2").animate({opacity:0,paddingTop:'0px',paddingBottom:'0px'},500,function(){EHide("notifbox2")});
}
function hideNotif(){
	if(typeof tnotif !== 'undefined') clearTimeout(tnotif);
	tnotif=setTimeout("hideNotifbox()",5000);
}
function callNotifbox(a){
	a = typeof a !== 'undefined' ? a : "page";
	_("_apps&app=notifbox",function(r){
		if(r!=""){
			E(a).innerHTML+=r;
			EShow("notifbox");
			hideNotif();
		}
	});
}
/** Foto **/
var fotoanim=false;
function getPhoto(a,b,c,d){
	c = typeof c !== 'undefined' ? c : 0;
	d = typeof d !== 'undefined' ? d : 'h';
	if(a=='') a='nophoto.jpg';
	//alert(a);
	E("tphoto").src="photo/"+a;
	if(c>0){
		if(d=='h'){
			E("tphoto").style.height=c+'px';
			$("#photoframe").animate({height:c+'px'},"fast");
		}
		else{
			E("tphoto").style.width=c+'px';
			$("#photoframe").animate({width:c+'px'},"fast");
		}
	}
	E("photo").value=b;
	EHide("tphoto");
	$("#tphoto").ready(function(){
		$("#tphoto").fadeIn("fast");
	});
}
function getFile(a,b){
	E("ufile").value=a;
	E("fname").value=b;
}
/** Buka Halaman **/
function openPage(m,page,a,b){
	close_fform();
	close_fform2();
	close_fform3();
	var usession=E("usession").value;
	if(usession!=""||true){
	var cpage=E("cpage").value;
	if(cpage!=page || true){
	E("maincontainer").style.marginRight='5px';
	E("maincontainer").style.marginLeft='5px';
	E("pagetitle").style.marginLeft='0px';
	E("pagetitle").innerHTML=pagetitle[page];
	_("_apps&app=menu&set="+m+"&page="+page,function(r){
		E("tabmenu").innerHTML=r;
		if(a){
		E('tabmenu').style.right='-560px';
		E('tabmenu').style.display='';
		$("#tabmenu").animate({right:'0px'},200);
		}
	});
	b = typeof b !== 'undefined' ? b : "";
	getPage(page,b);
	}}
}

function fform_sendclose(d,f){
	fform_sl();
	_(d,function(r){
		setTimeout(function(){close_fform();f(r);
			if(typeof tnotif !== 'undefined') clearTimeout(tnotif);
			tnotif=setTimeout("hideNotifbox()",5000);
		},250);
	})
}

function fform_sendclose2(d,f){
	fform_sl2();
	_(d,function(r){
		setTimeout(function(){close_fform2();f(r);
			//if(typeof tnotif !== 'undefined') clearTimeout(tnotif);
			//tnotif=setTimeout("hideNotifbox()",5000);
		},250);
	})
}

function svalidate(o,n,g,t,l){
	if(typeof n === 'undefined'){
		n=o.charAt(0).toUpperCase() + o.substr(1).toLowerCase();
	} else {
		if(n=="") n=o.charAt(0).toUpperCase() + o.substr(1).toLowerCase();
	}
	g = typeof g !== 'undefined' ? g : true;
	t = typeof t !== 'undefined' ? t : 'w';
	l = typeof l !== 'undefined' ? l : 0;
	
	//alert(l); return true;
	
	if(t=='+'){
		var a=E(o).value;
		if(a==""){
			alert(n+" tidak boleh kosong.");
			Efoc(o);
			return false;
		}
	}
	else if(t=='pw'){
		var a=E(o).value;
		var b=E("r"+o).value;
		if(g){
			if(a==""){
				alert("Password tidak boleh kosong.");
				Efoc(o);
				return false;
			}
		}
		if(a!=""){
			if(a!=b){
				alert("Password tidak cocok.");
				Efoc("r"+o);
				return false;
			}
		}
	}
	else if(t=='pwx'){
		var a=E(o).value;     // new password
		var b=E("r"+o).value; // retype
		var c=E("x"+o).value; // old
		if(a!=""){
			if(a!=b){
				alert("Password baru tidak cocok.");
				Efoc("r"+o);
				return false;
			}
		}
		if(g(c)){
			alert("Password salah.");
			Efoc("x"+o);
			return false;
		}
	}
	else if(t=='radio'||t=='r'){
		if(g){
			var c=false;
			for(var i=1;i<=l;i++){
				if(E(o+i).checked) c=true;
			}
			if(!c){
				alert(n+" harus ditentukan.");
				return false;
			}
		}
	}
	else if(t=='cx'){}
	else if(t=='x'){}
	else if(t=='c'){
		if(g){
			var a=ufRp(E(o).value);
			if(a==0){
				alert(n+' tidak boleh Rp 0.');
				Efoc(o);
				return false;
			}
		}
	}
	else if(t=='f'){
		if(g){
			var a=E(o).value;
			if(a==0||a==''){
				alert(n+' tidak boleh kosong.');
				return false;
			}
		}
	}
	else if(t=='fv') {
		var a=Etrim(o);
		if(a==""||a=="-"){
			alert((n!=""?n+" harus":"Harus")+" ditentukan.");
			Efoc('ffval_'+o);
			return false;
		}
		var spat=/^[A-Za-z0-9 \-\._\,\/\s\:@\[\]\%\(\)]+$/g;
		if(!spat.test(a)){
			alert("Tidak boleh menggunakan karakter khusus"+(n!=""?" untuk "+n.toLowerCase():"")+".");
			Efoc('ffval_'+o);
			return false;
		}
	}
	else {
		var a=Etrim(o);
		if(g){if(a==""){
			alert(n+" tidak boleh kosong.");
			Efoc(o);
			return false;
		}}
		if(a!=""){
			if(t=='c'){
				var spat=/^(Rp +)?[0-9\.]+$/g;
				if(!spat.test(a)){
					alert("Input nominal mata uang "+(n!=""?n.toLowerCase():"")+" tidak valid.");
					Efoc(o);
					return false;
				}
			} else if(t=='n'){
				var spat=/^[0-9\.]+$/g;
				if(!spat.test(a)){
					alert("Hanya gunakan karanter numerik"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
			}  else if(t=='p'){
				var spat=/^[+]?[0-9\-\(\)]+$/g;
				if(!spat.test(a)){
					alert("Format nomor telepon tidak valid.");
					Efoc(o);
					return false;
				}
			} else if(t=='d'){
				var spat=/^[0-9]+$/g;
				if(!spat.test(a)){
					alert("Hanya gunakan karanter numerik bilangan bulat"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
			} else if(t=='dm'){
				var spat=/^[0-9]+$/g;
				if(!spat.test(a)){
					alert("Hanya gunakan karanter numerik bilangan bulat"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
				if(parseInt(a)<l){
					alert(n+" tidak boleh kurang dari "+l+".");
					Efoc(o);
					return false;
				}
			} else if(t=='t'){
				if(g){
				var dd=a.split("-");
				if(parseInt(dd[2])==0){
					alert(n+" harus ditentukan.");
					E(o+"_d").focus();
					return false;
				}
				if(parseInt(dd[1])==0){
					alert(n+" harus ditentukan.");
					E(o+"_m").focus();
					return false;
				}
				if(parseInt(dd[0])==0){
					alert(n+" harus ditentukan.");
					E(o+"_y").focus();
					return false;
				}}
			} else if(t=='s') {
				if(g){
					if(a=="-"){
						alert((n!=""?n+" harus":"Harus")+" ditentukan.");
						Efoc(o);
						return false;
					}
				}
			} else if(t=='adv') {
				var spat=/^[A-Za-z0-9 \;\-\._\,\/\s\:@\[\]\%\(\)\&\']+$/g;
				if(!spat.test(a)){
					alert("Tidak boleh menggunakan karakter khusus"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
				if(l>0){
					if(a.length>l){
					alert(n+" tidak boleh lebih dari "+l+" karakter.");
					Efoc(o);
					return false;
					}
				}
			} else if(t=='an') {
				var spat=/^[A-Za-z0-9]+$/g;
				if(!spat.test(a)){
					alert("Hanya gunakan huruf abjad atau angka"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
				if(l>0){
					if(a.length>l){
					alert(n+" tidak boleh lebih dari "+l+" karakter.");
					Efoc(o);
					return false;
					}
				}
			} else {
				var spat=/^[A-Za-z0-9 \;\-\._\,\/\s\:@\[\]\%\(\)\&\']+$/g;
				if(!spat.test(a)){
					alert("Tidak boleh menggunakan karakter khusus"+(n!=""?" untuk "+n.toLowerCase():"")+".");
					Efoc(o);
					return false;
				}
				if(l>0){
					if(a.length>l){
					alert(n+" tidak boleh lebih dari "+l+" karakter.");
					Efoc(o);
					return false;
					}
				}
			}
		}
	}
	return true;
}
function svalidate_r(o,n){
	n = typeof n !== 'undefined' ? n : 0;
	if(n==0){
	for(var i=0;i<o.length;i++){
		if(!svalidate(o[i][0],o[i][1],o[i][2],o[i][3],o[i][4])){
			return false;
		}
	}}else{
	for(var i=0;i<o.length;i++){
		if(!svalidate(o[i],n[i][0],n[i][1],n[i][2],n[i][3])){
			return false;
		}
	}}
	return true;
}

function fform_fetchvalue(f){
	var v="";
	for(var i=0;i<f.length;i++){
		var fi=f[i][0];
		if(f[i][3]=='x'){
			v=v+"&"+fi+"="+tinyMCE.activeEditor.getContent();
		}
		else if(f[i][3]=='cx'){
			v=v+"&"+fi+"="+(E(fi).checked?'1':'0');
		}
		else if(f[i][3]=='c'){
			v=v+"&"+fi+"="+ufRp(E(fi).value);
		}
		else if(f[i][3]=='r'||f[i][3]=='radio'){
			var nr=parseInt(f[i][4]);
			v=v+"&"+fi+"=";
			for(var ii=1;ii<=nr;ii++){
				if(E(fi+ii).checked){
					v=v+E(fi+ii).value;
				}
			}
		}
		else{
			var s=E(fi).value;
			s=s.replace("&","%26");
			s=s.replace("=","%3D");
			v=v+"&"+fi+"="+s;
		}
	}
	return v;
}

function fform_std(o,cid,g,fmod,c,f,s,cc,fcb){
	g = typeof g !=='undefined'?g:false;cid = typeof cid !== 'undefined'?cid:0;s = typeof s !== 'undefined'?s:"";
	f = typeof f !== 'undefined'?f:[];
	cc = typeof cc !== 'undefined'?cc:0;
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var ps=fmod+'&fmod='+fmod+'&opt='+o+"&cid="+cid+s;
	if(o=='af'||o=='uf'|| o=='df' || o=='hf'){_(ps,function(r){EHtml('fform',r);open_fform();if(o!='df'){
		if(f[0][3]=='fv')Efoc('ffval_'+f[0][0]);else Efoc(f[0][0]);
		pageCallbacks();
		if(fcb!=0)fcb();
	}})}
	else{ var p=true; var v="";
		if(g){
			p=svalidate_r(f);
			if(p){
				if(cc!=0){
					p=cc();
				}
			}
			if(p){
				ps+=fform_fetchvalue(f);
			}
		}
		if(p) fform_sendclose(ps,c); PCBCODE=0;
	}
}

function fform_std2(o,cid,g,fmod,c,f,s,cc,fcb){
	g = typeof g !=='undefined'?g:false;cid = typeof cid !== 'undefined'?cid:0;s = typeof s !== 'undefined'?s:"";
	f = typeof f !== 'undefined'?f:[];
	cc = typeof cc !== 'undefined'?cc:0;
	fcb = typeof fcb !== 'undefined'?fcb:0;
	var ps=fmod+'&fmod='+fmod+'&opt='+o+"&cid="+cid+s;
	if(o=='af'||o=='uf'|| o=='df' || o=='hf'){_(ps,function(r){EHtml('fform2',r);open_fform2();if(o!='df'){
		if(f[0][3]=='fv')Efoc('ffval_'+f[0][0]);else Efoc(f[0][0]);
		pageCallbacks();
		if(fcb!=0)fcb();
	}})}
	else{ var p=true; var v="";
		if(g){
			p=svalidate_r(f);
			if(p){
				if(cc!=0){
					p=cc();
				}
			}
			if(p){
				ps+=fform_fetchvalue(f);
			}
		}
		if(p) fform_sendclose2(ps,c); PCBCODE=0;
	}
}
function fform2_std(o,cid,g,fmod,c,f,s,cc,fcb){
	fform_std2(o,cid,g,fmod,c,f,s,cc,fcb);
}

function fform_purl(f){
	var d=""; for(var i=0;i<f.length;i++) d+="&"+f[i]+"="+E(f[i]).value;
	return d;
}
function gpage_purl(f){
	var d=""; for(var i=0;i<f.length;i++){
		if(i>0)d+="&";
		d+=f[i]+"="+E(f[i]).value;
	}
	return d;
}
function gpage_purlcheck(f){
	var d=""; for(var i=0;i<f.length;i++){
		if(i>0)d+="&";
		if(E(f[i]).checked){
			d+=f[i]+"=1";
		} else {
			d+=f[i]+"=0";
		}
	}
	return d;
}
function fform_purlcheck(f){
	var d=""; for(var i=0;i<f.length;i++){
		d+="&";
		if(E(f[i]).checked){
			d+=f[i]+"=1";
		} else {
			d+=f[i]+"=0";
		}
	}
	return d;
}

function loadmainquery() {
	var s="url('../shared/libraries/modules/fquery.php') center top fixed #f0f0f0";
	document.body.style.background=s;
}

function pad_two(a){
	return a.length>2?a:'0'+a;
}
function fmodeurl(a){
	var s="";
	for(var i=0;i<a.length;i++){
		s+="%"+a.charCodeAt(i).toString(16);
	}
	return s;
}
function print_fmod(f,a){
	var s="";
	a = typeof a !=='undefined'?a:'';
	if(a!=''){
	for(var i=0;i<a.length;i++){
		if(i>0)s+="-";
		s+=E(a[i]).value;
	} s="&token="+s;
	}
	window.open("print/?file="+f+s,"_blank");
}

function fform_sl(){
	if(E('fform').style.display!='none'){
		$("#fformct").animate({height:'0px',opacity:0,paddingTop:'0px',paddingBottom:'0px'},150,function(){EHide("fformct")});
		E("fform_title").style.color='#333';
		E("fform_title").style.margin='0';
		E("fform_title").style.background='';
		EShow('fform_title'); EShow('ffload');
	} else {
		var ex=E('xform_title');
		if(ex!=null){
			var r=E('fformload').value;
			r=r.replace("###",E('xform_title').value);
			EHtml('fform',r);open_fform();
			open_fform();
		}
	}
}
function fform_sl2(){
	if(E('fform2').style.display!='none'){
		$("#fformct2").animate({height:'0px',opacity:0,paddingTop:'0px',paddingBottom:'0px'},150,function(){EHide("fformct2")});
		EShow('fform_title2'); EShow('ffload2');
	}
}

function js_init_tinymce(){
	tinyMCE.init({
		// General options
		elements : "elm1",
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
		skin : "o2k7",
		plugins : "paste,lists,style,layer,",

		theme_advanced_buttons1 : ",bold,italic,underline,strikethrough,forecolor,|,bullist,numlist,|,indent,outdent,justifyleft,justifycenter,justifyright,justifyfull,|,fontsizeselect",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "none",
		theme_advanced_resizing : true,

		content_css : "css/word.css",

		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
}

function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1)
	{
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1)
	{
		c_value = null;
	}
	else
	{
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1)
		{
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}
function checkCookie()
{
	var username=getCookie("sarprasdemo");
	if (username!=null && username!="")
	{
		return true;
	}
	else 
	{
		return false;
	}
}
function userlogin(){
	var userpasswd=E("userpasswd").value;
	var username=E("username").value;
	E("userpasswd").blur();
	E("username").blur();
	// EHide("loginbtn");
	EShow("loader4");
	_("_apps&app=checkuser&passwd="+userpasswd+"&uname="+username,function(r){
		// EHide("loader4");
		if(r!="0") {
			setCookie("sarprasdemo","admin",365);
			// EHide("userwarn");
			openApp(r);
		}
		else {
			EShow("userwarn");
		}
	});
}

function retypeuser(){
	EHide("userwarn");
	EShow("loginbtn");
}
function delete_cookie(name){
	document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
function userlogout(){
	c_name=E("usession").value;
	delete_cookie(c_name);
	closeApp();
}
function Logout(){
	userlogout();
}
function checkusertype(e){
	if (e.keyCode == '13') {
		userlogin();
	}
}

function setting_open(){
	_("setting&opt=uf",function(r){
		E("fform").innerHTML=r;
		open_fform();
		Efoc('bahasa');
	});
}

function setting_form(o,cid,g){
	if(o=='u'){
		//var bahasa = E('bahasa').value;
		var oldpassword=E('oldpassword').value;
		var newpassword=E('newpassword').value;
		var rnewpassword=E('rnewpassword').value;
		//if(newpassword!=''){
			if(newpassword!=rnewpassword){
				alert('Password baru tidak sama');
				E('newpassword').focus();
				return false;
			}
			_("setting&opt=cek&old="+oldpassword+"&new="+newpassword,function(r){
				if(r=="0"){
					alert('Password berhasil diubah');
					close_fform();
				}
				else if(r=='2'){
					alert('Pasword lama salah');
					E('oldpassword').focus();
					return false;
				}
				else {
					E('oldpassword').value=r;
					alert('Gagal mengupdate password:'+r);
					return false;
				}
			});
		//}
		//else {
			//close_fform();
		//}
	}
	return true;
}
/*

function emptyfunction(){
}
function checkuserpassword(a){
	_("_apps&app=checkpaswd&passwd="+a,function(r){
		EHide("loader4");
		if(r=="1") {
			setCookie("sarprasdemo","admin",365);
			EHide("userwarn");
			openApp();
		}
		else {
			EShow("userwarn");
		}
	});
}
function setting_form(o,cid,g){
	var f=[['nilai','Besar diskon',true,'n'],['keterangan','',false]];
	fform_std(o,cid,g,"setting",emptyfunction,f);
}
*/

function showTempes(f){
	var s="";
	for(var i=0;i<f.length;i++){
		s+="'"+f[i][0]+"',";
	}
	E("fform").innerHTML='<textarea id="tempes" style="float:left;width:500px;margin:20px;padding:5px;height:300px">'+s+'</textarea>';
	open_fform();
}