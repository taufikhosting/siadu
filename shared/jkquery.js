var fRp_shownul=true;

function E(e){
	return document.getElementById(e);
}
function Efoc(a){
	E(a).focus();
	E(a).value=E(a).value;
}
function Etrim(a){
	E(a).value=$.trim(E(a).value);
	return E(a).value;
}
function EHtml(a,b){
	E(a).innerHTML=b;
}
function EShow(a){
	E(a).style.display='';
}
function EHide(a){
	E(a).style.display='none';
}
function EVisible(a,d){
	d = typeof d !== 'undefined' ? d : true;
	if(d) E(a).style.visibility='visible';
	else E(a).style.visibility='hidden';
}
function EDisplay(a,d){
	d = typeof d !== 'undefined' ? d : true;
	if(d==false || d=='none') EHide(a);
	else EShow(a);
}
function SelectGetText(elementId) {
    var elt = document.getElementById(elementId);

    if (elt.selectedIndex == -1)
        return null;

    return elt.options[elt.selectedIndex].text;
}
function __(e,t){var n={ajax:function(e){var t;if(window.XMLHttpRequest){t=new XMLHttpRequest}else{t=new ActiveXObject("Microsoft.XMLHTTP")}t.onreadystatechange=function(){if(t.readyState==4&&t.status==200){n.done(t.responseText)}};t.open("POST",e.url+".php",true);t.setRequestHeader("Content-type","application/x-www-form-urlencoded");t.send(e.data)}};n.done=t;n.ajax(e)}function _(e,t){__({url:"$",data:"x="+e},t)}

function inputDate_fmonth_r(a){
	if(a=='en'){
		return new Array('','January','February','March','April','May','June','July','August','September','October','November','December');
	} else {
		return new Array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	}
}
function inputDate_smonth_r(a){
	if(a=='en'){
		return new Array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	} else {
		return new Array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
	}
}
function inputdateChange(a){
	var MNTHN=inputDate_fmonth_r('id');
	var MNTHS=inputDate_smonth_r('id');
	
	E(a).value=E(a+'_y').value+"-"+E(a+'_m').value+"-"+E(a+'_d').value;
	
	var dim="";
	var d=new Date();
	var dm=new Date(E(a+'_y').value,E(a+'_m').value,0).getDate();
	var sd=parseInt(E(a+'_d').value);
	if(sd>dm){
		sd=dm;
		E(a).value=E(a+'_y').value+"-"+E(a+'_m').value+"-"+sd;
	}
	E(a+'_d').innerHTML='<option value="0">tgl:</option>';
	for(var i=1;i<=parseInt(dm);i++){
		E(a+'_d').innerHTML+='<option value="'+i+'" '+((i==sd)?'selected':'')+' >'+i+'</option>';
	}
	E(a+'f').value=MNTHN[parseInt(E(a+'_m').value)]+" "+E(a+'_d').value+", "+E(a+'_y').value;
	E(a+'s').value=MNTHS[parseInt(E(a+'_m').value)]+" "+E(a+'_d').value+", "+E(a+'_y').value;
}
function inputdateSet(a,b){
	var c=b.split("-");
	E(a+'_y').value=c[0];
	E(a+'_m').value=c[1];
	var d=new Date();
	var dm=new Date(d.getFullYear(),d.getMonth()+1,0).getDate();
	E(a+'_d').innerHTML='<option value="0">tgl:</option>';
	var sd=parseInt(c[2]);
	for(var i=1;i<=parseInt(dm);i++){
		E(a+'_d').innerHTML+='<option value="'+i+'" '+((i==sd)?'selected':'')+' >'+i+'</option>';
	}
	E(a+'_d').value=c[2];
	inputdateChange(a);
}
function inputdateSetDate(a,b){
	var c=b.split("-");
	E(a+'_y').value=parseInt(c[0]);
	E(a+'_m').value=parseInt(c[1]);
	E(a+'_d').value=parseInt(c[2]);
	inputdateChange(a);
}
function getSelectedText(elementId) {
    var elt = document.getElementById(elementId);

    if (elt.selectedIndex == -1)
        return null;

    return elt.options[elt.selectedIndex].text;
}
function fRp(a){
	if(a=="")a=0;
	a=a.replace(/[^0-9]/g,"");
	if(a=="")a=0;
	a=parseInt(a);
	if(!fRp_shownul && a==0) return "";
	a=a.toString();
	var dp=a.indexOf(",");
	if(dp>=0){
		var ds=a.substr(dp);
		a=a.replace(ds,"");
	}
	a=parseInt(a,10);
	a=a.toString();
	var s=""; var k=0;
	for(var i=a.length-1;i>=0;i--){
		s=a.substr(i,1)+s;
		if(k>0 && (k+1)%3==0 && k<a.length-1) s="."+s;
		k++;
	}
	return "Rp "+s;
}
function fRpt(o){
	o.value=fRp(o.value);
}
function ufRp(a){
	if(a=="") return 0;
	a=a.replace(/[^0-9]/g,"");
	if(a=="") return 0;
	return parseInt(a,10);
}
function ufRpt(o){
	o.value=ufRp(o.value);
}
function jumpTo(e){
	document.location=e;
}
function inputJMChange(a){
	var h=E(a+'_h').value;
	var m=E(a+'_m').value;
	E(a).value=h+':'+m+':00';
}
function EfindPos(a) {
	var obj=E(a);
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	}
	return [curleft,curtop];
}
function EmakeKode(a,n){
	n = typeof n !== 'undefined' ? n : "";
	var kod=a.substr(0,3).toUpperCase();
	var spat=/[^\s]+(\s+[^\s])+\s*/;
	if(spat.test(a)){
		var b=a.split(" "); kod="";
		for(var i=0;i<b.length;i++){
			if(b[i]!=""){
				kod+=b[i].substr(0,1).toUpperCase();
			}
		}
	}
	if(E(n)!=null){
		E(n).value=kod;
	}
	return kod;
}