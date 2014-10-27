<?php
session_start();
$loginpage=false;
require_once('system/config.php');
require_once(SYSDIR.'db.php');
require_once(LIBDIR.'common.php');

/** Page Personalization **/
$search_txt="find name or nip...";
$search_action=RLNK."employee.php";
$cview="employee";  // current view
$ct_bg="";
$ct_title="Employee Profile";

?>
<html><head>
<?php require_once(VWDIR.'style.php');?>
<style type="text/css">
.pf_name {
	padding-bottom:4px;
	border-top:1px solid #dedede;
	border-left:1px solid #dedede;
	border-right:1px solid #dedede;
	border-bottom:1px solid #aeaeae;
	width:918;padding:10px;
	padding:10px;
	height:40px;
	//background:#f0f0ff;
	<?=cssGrad("#dedff2 0%, #f4f4ff 100%","#eeeeee")?>
}
.pf_box {
	width:918;padding:10px;
	border:1px solid #dedede;
	background:#f4f5f5;
}
.pf_table tr td {
	font:11px Verdana,Tahoma;
	color:#444444;
}
.pf_table tr {
	height:20px;
}
.pf_pbox {
	width:890px;
	border:5px solid #6a92e5;
	padding:20px;
	background:#f4f5f5;
}
.pf_tab1{
	//width:140px;
	min-width:110px;
	height:30px;
	<?=cssGrad("#6a92e5 0%, #aad2ff 100%","#6a92e5")?>
	border-radius:5px 5px 0 0;
	border:1px solid #6a92e5;
	font:bold 11px Verdana,Tahoma;
	//color:#7f7f7f;
	//text-align:left;
	color:#ffffff;
	padding:0 20px 0 20px;
	cursor:pointer;
	margin:0;
}
.pf_tab1:hover{
	<?=cssGrad("#6a92e5 0%, #bae2ff 100%","#6a92e5")?>
}
.pf_tab {
	//width:140px;
	min-width:110px;
	height:30px;
	<?=cssGrad("#e8e8e8 0%, #ffffff 100%","#6a92e5")?>
	border-radius:5px 5px 0 0;
	border:1px solid #d2d2d2;
	border-bottom:none;
	font:bold 11px Verdana,Tahoma;
	//color:#7f7f7f;
	//text-align:left;
	color:#7f7f7f;
	padding:0 20px 0 20px;
	cursor:pointer;
	margin:0;
}
.pf_tab:hover {
	<?=cssGrad("#d8d8d8 0%, #ffffff 100%","#6a92e5")?>
}
.pf_itab {
	font:bold 12px Verdana,Tahoma;
	color:#ffffff;
	padding:4px 0 8px 0;
}
.r_bar {
	width:140px;height:32px;
	background:url('<?=IMGR?>rarrowbar.png') no-repeat;
	position:absolute;
	top:0;
}
.tglcuti {
	text-align:center;
	border-radius:5px;
	color:#ffffff;
	width:24px;
	padding:4px;
	background:#6a92e5
}

.ctgl_box tr td{
	border:none;
	background:none;
	font:11px Verdana, Tahoma;
	color:#444444;
}
.cplusbtn {
	width:24px;
	height:24px;
	border:none;
	cursor:pointer;
	background:url('<?=IMGR?>cplus0.png') center no-repeat;
	margin-bottom:10px;
}
.cplusbtn:hover {
	background:url('<?=IMGR?>cplus1.png') center no-repeat;
}
.ceditbtn {
	width:18px;
	height:18px;
	border:none;
	cursor:pointer;
	background:url('<?=IMGR?>cedit0.png') center no-repeat;
}
.ceditbtn:hover {
	background:url('<?=IMGR?>cedit1.png') center no-repeat;
}
.cdelbtn {
	width:18px;
	height:18px;
	border:none;
	cursor:pointer;
	background:url('<?=IMGR?>cdel0.png') center no-repeat;
}
.cdelbtn:hover {
	background:url('<?=IMGR?>cdel1.png') center no-repeat;
}

#pf_photo {
	border:4px solid #ffffff;
	width:140px;
	box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
}

.pfnice {
	width:170px;
	height:45px;
	padding:0 6px 1px 6px;
	background:#ffffff;
	border:1px solid #dedede;
	//border-radius:5px;
	font:bold 11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
	cursor:pointer;
	padding:0;
}

.pfn_box {
	width:150px;
	padding:2px 0 0 30px;
	text-align:left
}

.ipfbox {
	position:relative;
	border-radius:3px;
	width:400px;
	padding:4px;
	margin-bottom:15px
}
.ipfbox:hover {
	background:#e9ecec;
	border:1px solid #dbe1e1;
	padding:3px;
}
.filebtn {
	height:13px;
	width:12px;
	padding:2px 2px 3px 2px;
	<?=cssGrad("#d0d0d0 0%, #eeeeee 4%, #f9f9f9 92%, #ffffff 100%","#f4f4f4")?>
	border:1px solid #c2c2c2;
	border-radius:2px;
	font:11px Verdana,Tahoma;
	color:#6a6a6a;
    outline:none;
	margin:0;
	display:block;
}
.filebtn:hover {
	<?=cssGrad("#eeeeee 0%, #ffffff 100%","#dfdfdf")?>
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
}
.filebtn:active {
	<?=cssGrad("#ffffff 0%, #f0f0f0 4%, #f0f0f0 96%, #c1c1c1 100%","#e2e2e2")?>
	box-shadow:none;
}
</style>
<script type="text/javascript" src="jsscript/jquery.js"></script>
<script type="text/javascript">
function close_uform(){
	var n=E('empfname').value;
	$("#fform_bg").animate({ opacity: "0" }, 100 , function(){ E('fform_bg').style.display='none'; });
	$("#fformx").animate({ opacity: "0" }, 100 , function(){ E('fformx').style.display='none'; 
		E('imgframe').src='imgform.php?name='+n;
		E('imgframe').style.height='90px';
	});
}
function open_uform(){
	var n=E('empfname').value;
	
	E('tfformx').innerHTML="Upload picture of "+n;
	E('imgframe').style.height='90px';
	E('imgframe').style.display='';	
	E('fform_bg').style.display=''; E('fformx').style.display='';
	$("#fform_bg").animate({ opacity: "1" }, 100);
	$("#fformx").animate({ opacity: "1" }, 100);
}

function change_uform(a){
	E('imgframe').style.height=a+'px';
}

function open_fform(){
	E('fform_bg').style.display=''; E('fform').style.display='';
	$("#fform_bg").animate({ opacity: "1" }, 100);
	$("#fform").animate({ opacity: "1" }, 100);
}
function xfadein(a,c,d,n){
	E(a).style.opacity=c;
	if(c<1){
		c+=0.2;
		setTimeout("xfadein('"+a+"',"+c+","+d+","+n+")",20);
	}
	else {
		d++;
		if(d<n){
			xfadeout(a,1,d,n);
		} 
	}
}

function xfadeout(a,c,d,n){
	E(a).style.opacity=c;
	c-=0.2;
	if(c>0){
		setTimeout("xfadeout('"+a+"',"+c+","+d+","+n+")",20);
	} else {
		xfadein(a,0.2,d,n);
	}
}

function updpfSummary(){
	var dcid=E('empid').value;
	_('pf_summary&dcid='+dcid,function(r){
		var b=r.split("~");
		for(var i=0;i<4;i++){
			E('sumf'+i).innerHTML=b[i];
		}
		if(b[4]!='0'){
			if(E('pfflag').value=='0'){
				E('pfflag').value=b[4];
				E('sumfbtn1').style.top='0px';
				E('xsumfbtn1').title="";
			}
		} else {
			if(E('pfflag').value!='0'){
				E('pfflag').value=0;
				E('sumfbtn1').style.top='-45px';
				var fname=E('empfname').value;
				E('xsumfbtn1').title=fname+" is currently have no status. Click to add status.";
			}
		}
		E('flog').innerHTML=r;
	});
}

function addCuti(){
	var id=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_('emp_addcuti&tgl=0&id='+id+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function addDCuti(a){
	var id=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_('emp_addcuti&tgl='+a+'&id='+id+"&name="+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function editCuti(id){
	var eid=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_('emp_editcuti&tgl=0&id='+id+'&eid='+eid+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function delCuti(id){
	var eid=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_('emp_delcuti&tgl=0&id='+id+'&eid='+eid+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function takePhoto(){
	var id=E('empid').value;
	_('pf_photo&id='+id,function(r){
		E('pf_photo').innerHTML=r;
		E('pfp_btn').title="";
		E('pfp_lbl').innerHTML="Change profile picture";
		close_uform();
	});
}
function hitungHari(){
	if(E('tanggal1_y').value==0 || E('tanggal1_m').value==0 || E('tanggal1_d').value==0||E('tanggal2_y').value==0 || E('tanggal2_m').value==0 || E('tanggal2_d').value==0){
		E('htnghari').innerHTML='-';
	} else {
		var s=E('scuti').value;
		var t1=new Date(E('tanggal1').value);
		var t2=new Date(E('tanggal2').value);
		var dif=1+Math.round(Math.abs(t1.getTime()-t2.getTime())/86400000);
		var sc=s-dif;
		
		E('htnghari').innerHTML=dif;
		E('htnghari2').innerHTML=sc+" Hari";
		if(sc<0) E('htnghari2').style.color='#ff0000';
		else E('htnghari2').style.color='inherit';
	}
}
function hitungHarix(s){
	if(E('tanggal1_y').value==0 || E('tanggal1_m').value==0 || E('tanggal1_d').value==0||E('tanggal2_y').value==0 || E('tanggal2_m').value==0 || E('tanggal2_d').value==0){
		E('htnghari').innerHTML='-';
	} else {
		var t1=new Date(E('tanggal1').value);
		var t2=new Date(E('tanggal2').value);
		var dif=1+Math.round(Math.abs(t1.getTime()-t2.getTime())/86400000);
		var sc=s-dif;
		
		E('htnghari').innerHTML=dif;
		E('htnghari2').innerHTML=sc+" Hari";
		if(sc<0) E('htnghari2').style.color='#ff0000';
		else E('htnghari2').style.color='inherit';
	}
}

function dfadein(a,c,d,n){
	var tb=a.split(",");
	for(var i=0;i<tb.length;i++){
		var b=tb[i];
		E('ctgl'+b).style.opacity=c;
	}
	if(c<1){
		c+=0.1;
		setTimeout("dfadein('"+a+"',"+c+","+d+","+n+")",40);
	}
	else {
		d++;
		if(d<n){
			dfadeout(a,1,d,n);
		} 
	}
}

function dfadeout(a,c,d,n){
	var tb=a.split(",");
	for(var i=0;i<tb.length;i++){
		var b=tb[i];
		E('ctgl'+b).style.opacity=c;
	}
	c-=0.1;
	if(c>0){
		setTimeout("dfadeout('"+a+"',"+c+","+d+","+n+")",40);
	} else {
		dfadein(a,0.1,d,n);
	}
}

function emp_addcuti(){
	var id=E('empid').value;
	var cmonth=E('cmonth').value;
	var a=E('keterangan').value;
	var b=E('tanggal1').value;
	var c=E('tanggal2').value;
	_("emp_postcuti&opt=a&id="+id+"&cmonth="+cmonth+"&keterangan="+a+"&tanggal1="+b+"&tanggal2="+c,function(r){
		close_fform();
		var s=r.split("~");
		E(E('cutibox').value).innerHTML=s[1];
		updpfSummary();
		dfadeout(s[0],1,0,1);
	});
}
function emp_updatecuti(a){
	var id=E('empid').value;
	var cmonth=E('cmonth').value;
	var cid=a;
	var a=E('keterangan').value;
	var b=E('tanggal1').value;
	var c=E('tanggal2').value;
	_("emp_postcuti&opt=u&cid="+cid+"&id="+id+"&cmonth="+cmonth+"&keterangan="+a+"&tanggal1="+b+"&tanggal2="+c,function(r){
		close_fform();
		var s=r.split("~");
		E(E('cutibox').value).innerHTML=s[1];
		updpfSummary();
		dfadeout(s[0],1,0,1);
	});
}
function updatecuti(){
	var id=E('empid').value;
	_("update_cuti&id="+id,function(r){
		E(E('cutibox').value).innerHTML=r;
	});
}
function emp_delcuti(a){
	var id=E('empid').value;
	var cmonth=E('cmonth').value;
	var cid=a;
	_("emp_postcuti&opt=d&cid="+cid+"&id="+id+"&cmonth="+cmonth,function(r){
		close_fform();
		E(E('cutibox').value).innerHTML=r;
		updpfSummary();
	});
}
function switch_cmon(a){
	var id=E('empid').value;
	var cmonth=parseInt(E('cmonth').value)+a;
	var xmonth=<?=date("m")?>;
	if(a==0) cmonth=xmonth;
	if(cmonth>0 && cmonth <13){
	E('cmonth').value=cmonth;
	_("emp_postcuti&opt=s&id="+id+"&cmonth="+cmonth,function(r){
		//close_fform();
		E(E('cutibox').value).innerHTML=r;
	});
	}
}
function emp_addtrain(){
	var id=E('empid').value;
	var judul=E('judul').value;
	var jenis=E('jenis').value;
	var penyelenggara=E('penyelenggara').value;
	var tempat=E('tempat').value;
	var peserta=E('peserta').value;
	var tanggal1=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var tanggal2=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	_("emp_posttrain&opt=a&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}
function emp_edittrain(cid){
	var id=E('empid').value;
	var judul=E('judul').value;
	var jenis=E('jenis').value;
	var penyelenggara=E('penyelenggara').value;
	var tempat=E('tempat').value;
	var peserta=E('peserta').value;
	var tanggal1=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var tanggal2=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	_("emp_posttrain&opt=u&cid="+cid+"&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}
function emp_deltrain(cid){
	var id=E('empid').value;
	_("emp_posttrain&opt=d&cid="+cid+"&id="+id,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}
function hltgl(a){
	if(a.length>0){
	for(var i=0;i<a.length;i++){
		if(i==0){
		E('ceimg'+a[i]).style.display='';
		E('cdimg'+a[i]).style.display='';
		}
		E('ctgl'+a[i]).style.background='#d8e9ff';
	}
	} else {
		E('ceimg'+a).style.display='';
		E('cdimg'+a).style.display='';
		E('ctgl'+a).style.background='#d8e9ff';
	}
}
function dhltgl(a){
	if(a.length>0){
	for(var i=0;i<a.length;i++){
		if(i==0){
		E('ceimg'+a[i]).style.display='none';
		E('cdimg'+a[i]).style.display='none';
		}
		E('ctgl'+a[i]).style.background='#f8fbfd';
	}
	} else {
		E('ceimg'+a).style.display='none';
		E('cdimg'+a).style.display='none';
		E('ctgl'+a).style.background='#f8fbfd';
	}
}
function htgl(a){
	E('ctgl'+a).style.background="#dfffc5";
	E('cpimg'+a).style.display="";
}
function dhtgl(a){
	E('ctgl'+a).style.background='#f8fbfd';
	E('cpimg'+a).style.display="none";
}
/********************* IPF *********************/{
function showmore(){
	if(E('pf_more').style.display=='none'){
		E('pf_more').style.display='';
		E('pf_less').style.display='none';
		E('pf_smore').innerHTML='Sembunyikan data lainnya...';
	} else {
		E('pf_less').style.display='';
		E('pf_more').style.display='none';
		E('pf_smore').innerHTML='Tampilkan data lainnya...';
	}
}
function edit_ipf1(){
	var id=E('empid').value;
	var n=E('empfname').value;
	_('emp_editipf1&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function save_ipf1(){
	var id=E('empid').value;
	var nip=E('nip').value;
	var empbagian=E('empbagian').value;
	var staff=E('staff').value;
	var golongan=E('golongan').value;
	
	_('emp_editipf1x&id='+id+'&nip='+nip+'&empbagian='+empbagian+'&staff='+staff+'&golongan='+golongan,function(r){
		var s=r.split("~");
		E('ipf1').innerHTML=s[2];
		
		if(s[0]=="1"){
			E('swtab5').style.display='';
		}
		else {
			E('swtab5').style.display='none';
			if(E('pfb_5').style.display!='none'){
				switch_tab(0);
			}
		}
		
		if(s[1]=="1" || true){
			updatecuti();
			E('rsumfbtn2').style.display='';
			E('swtab2').style.display='';
		}
		else {
			E('rsumfbtn2').style.display='none';
			E('swtab2').style.display='none';
			if(E('pfb_2').style.display!='none'){
				switch_tab(0);
			}
		}
		
		updpfSummary();
		
		close_fform();
	});
}
/********************* END OF IPF *********************/}

function switch_tab(a){
	var n=parseInt(E('pfbnum').value);
	for(var i=0;i<n;i++){
		if(i!=a){
			E('pfb_'+i).style.display='none';
			E('pft_'+i).className='pf_tab';
		}
	}
	E('pfb_'+a).style.display='';
	E('pft_'+a).className='pf_tab1';
}


function openeditgaji(){
	E('gaji_pokok').style.display='';
	E('tunj_fungsional').style.display='';
	E('tunj_jabatan').style.display='';
	E('tunj_transport').style.display='';
	E('tunj_anak').style.display='';
	E('tunj_lain').style.display='';
	E('takehomepay').style.display='';
	
	E('tgaji_pokok').style.display='none';
	E('ttunj_fungsional').style.display='none';
	E('ttunj_jabatan').style.display='none';
	E('ttunj_transport').style.display='none';
	E('ttunj_anak').style.display='none';
	E('ttunj_lain').style.display='none';
	E('ttakehomepay').style.display='none';
	
	E('gebtn_open').style.display='none';
	E('gebtn_simpan').style.display='';
	E('gebtn_batal').style.display='';
	
}
function closeeditgaji(){
	E('gaji_pokok').style.display='none';
	E('tunj_fungsional').style.display='none';
	E('tunj_jabatan').style.display='none';
	E('tunj_transport').style.display='none';
	E('tunj_anak').style.display='none';
	E('tunj_lain').style.display='none';
	E('takehomepay').style.display='none';
	
	E('tgaji_pokok').style.display='';
	E('ttunj_fungsional').style.display='';
	E('ttunj_jabatan').style.display='';
	E('ttunj_transport').style.display='';
	E('ttunj_anak').style.display='';
	E('ttunj_lain').style.display='';
	E('ttakehomepay').style.display='';
	
	E('gebtn_open').style.display='';
	E('gebtn_simpan').style.display='none';
	E('gebtn_batal').style.display='none';	
}

function simpaneditgaji(){
	var id=E('empid').value;
	
	var gaji_pokok=E('gaji_pokok').valule;
	var tunj_fungsional=E('tunj_fungsional').valule;
	var tunj_jabatan=E('tunj_jabatan').valule;
	var tunj_transport=E('tunj_transport').valule;
	var tunj_anak=E('tunj_anak').valule;
	var tunj_lain=E('tunj_lain').valule;
	var takehomepay=E('takehomepay').valule;
	
	
	var dk=new Array('gaji_pokok','tunj_fungsional','tunj_jabatan','tunj_transport','tunj_anak','tunj_lain','takehomepay');
	var ps="";
	for(var i=0;i<dk.length;i++){
		ps=ps+'&'+dk[i]+'='+E(dk[i]).value;
	}
	
	_('emp_gajisave&id='+id+"&"+ps,function(r){
		E('pfb_gaji_data').innerHTML=r;
	});
}

/***** Pop Box *****/
function open_popbox(a){
	E('popd_'+a).style.position='relative';
	E('popb_'+a).style.display=''; E('popx_'+a).style.display='';
	E('popi_'+a).focus();
}
function close_popbox(a){
	E('popb_'+a).style.display='none'; E('popx_'+a).style.display='none';
	E('popd_'+a).style.position='static';
	E('popi_'+a).value='';
}
function popbox_save(a){
	var v=E('popi_'+a).value; var g="";
	if(a=='docid'){
		var dcid=E('empid').value;
		g="&dcid="+dcid;
	}
	_('popbox&t='+a+'&opt=a&v='+v+g,function(r){E(a).innerHTML=r;close_popbox(a);});
}

/********** Pf Summary **********/
function pf_summary(o){
	var dcid=E('empid').value;
	_("pf_summary&opt="+o+"&dcid="+dcid,function(r){
		//E('tpf_summary').innerHTML=r;
	});
}

/********** Pf info1 **********/
function pf_info1(o,cid,g){
	var fmod="pf_info1";
	var f=new Array('nip','level','division','group','position');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	var active=o=='d'?"&active="+E('active').value:"";
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v+active;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;updpfSummary();close_fform()});}
}

/********** Pf Status **********/
function pf_status(o,cid,g){
	var fmod="pf_status";
	var f=new Array('status','date1','date2','position');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	var active=o=='d'?"&active="+E('active').value:"";
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v+active;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;updpfSummary();close_fform()});}
}

/********** Pf Training **********/
function pf_train(o,cid,g){
	var fmod="pf_train";
	var f=new Array('title','type','host','place','date1','date2','speaker','participant','pf_train_file','pf_train_current_file');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}
		v=v+"&certified="+(E('certified').checked?"Y":"N");
	}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;updpfSummary();close_fform();pf_files('rf')});}
}
function pf_train_file(a){
	E('pf_train_file').value=a;
	//alert(a);
}
/********** Pf Document **********/
function pf_document(o,cid,g){
	var fmod="pf_document";
	var f=new Array('docid','date1','date2');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();pf_files('rf')});}
}
/********** Pf Education **********/
function pf_education(o,cid,g){
	var fmod="pf_education";
	var f=new Array('university','year','title','field','score','pf_train_file','pf_train_current_file');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();pf_files('rf')});}
}
/********** Pf Family **********/
function pf_family(o,cid,g){
	var fmod="pf_family";
	var f=new Array('university','year','title','field','score','pf_train_file','pf_train_current_file');
	var fname=E('empfname').value;
	var dcid=E('empid').value;
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	var v=""; if(g){for(var i=0;i<f.length;i++){var fi=f[i];v=v+"&"+fi+"="+E(fi).value;}}
	var ps=fmod+'&opt='+o+"&cid="+cid+"&dcid="+dcid+"&fname="+fname+v;
	if(o=='af' || o=='uf' || o=='df')
	{_(ps,function(r){E('fform').innerHTML=r;open_fform();});}
	else{_(ps,function(r){E('t'+fmod).innerHTML=r;close_fform();pf_files('rf')});}
}

/********** Pf Reward **********/
function pf_reward(o,cid,g){
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	if(o=='af'){
		E('rw_reward').value='';
		E('rw_rewardby').value='';
		E('rw_description').value='';
		E('rw_file').value='';
		E('fform_bg').style.display=''; E('fformz').style.display='';
		$("#fform_bg").animate({ opacity: "1" }, 100);
		$("#fformz").animate({ opacity: "1" }, 100);
	} else if(o=='c'){
		var n=E('empfname').value;
		$("#fform_bg").animate({ opacity: "0" }, 100 , function(){ E('fform_bg').style.display='none'; });
		$("#fformz").animate({ opacity: "0" }, 100 , function(){ E('fformz').style.display='none'; 
			E('imgframe2').src='rwform.php?name='+n;
		});
	} else if(o=='f'){
		E('rw_file').value=cid;
	} else if(o=='a'){
		var dcid=E('empid').value;
		var reward=E('rw_reward').value;
		var rewardby=E('rw_rewardby').value;
		var description=E('rw_description').value;
		var date=E('rw_date').value;
		var file=E('rw_file').value;
		var v="&reward="+reward+"&rewardby="+rewardby+"&description="+description+"&date="+date+"&file="+file;
		_("pf_reward&opt=a&dcid="+dcid+v,function(r){E('tpf_reward').innerHTML=r;pf_reward('c');pf_files('rf')});
	} else if(o=='df'){
		var n=E('empfname').value;
		var dcid=E('empid').value;
		_("pf_reward&opt=df&cid="+cid+"&dcid="+dcid+"&fname="+n,function(r){E('fform').innerHTML=r;open_fform()});
	} else if(o=='d'){
		var dcid=E('empid').value;
		_("pf_reward&opt=d&cid="+cid+"&dcid="+dcid+"&fname="+n,function(r){E('tpf_reward').innerHTML=r;pf_files('rf');close_fform()});
	}
}
/********** Pf Files **********/
function pf_files(o,cid,g){
	g = typeof g !== 'undefined' ? g : false;
	cid = typeof cid !== 'undefined' ? cid : 0;
	
	var dcid=E('empid').value;
	var n=E('empfname').value;
	if(o=='af'){
		E('imgframe').src='fileform.php?name='+n+"&id="+dcid;
		E('tfformx').innerHTML="Upload "+n+"'s file";
		
		E('fformboxf').style.width='450px';
		E('imgframe').style.height='140px';
		E('imgframe').style.width='430px';
		E('imgframe').style.display='';
		E('fform_bg').style.display=''; E('fformx').style.display='';
		$("#fform_bg").animate({ opacity: "1" }, 100);
		$("#fformx").animate({ opacity: "1" }, 100);
	} else if(o=='u'){
		if(g){
		_("pf_files&opt=rf&dcid="+dcid,function(r){
			E('tpf_files').innerHTML=r;
			close_uform();
		});
		} else {
			close_uform();
		}
	} else if(o=='df'){
		_("pf_files&opt=df&dcid="+dcid+"&cid="+cid+"&fname="+n,function(r){
			E('fform').innerHTML=r;
			open_fform();
		});
	} else if(o=='d'){
		_("pf_files&opt=d&dcid="+dcid+"&cid="+cid,function(r){
			E('tpf_files').innerHTML=r;
			close_fform();
			pf_train('rf');
			pf_education('rf');
			pf_reward('rf');
		});
	} else if(o=='rf'){
		_("pf_files&opt=rf&dcid="+dcid,function(r){
			E('tpf_files').innerHTML=r;
		});
	}
}
</script>
</head><body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top"><?php require_once(VWDIR.'banner.php');?></tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr>
		<td><?php require_once(VWDIR.'tabs.php');?></td>
		<td align="right"><?php require_once(WGDIR.'search.php');?></td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="ct_box"> 
				<div class="tview"><b><?=$ct_title?></b></span></div>
				<!-- ========= CONTENT ========= -->
				<div id="tp_employee"><?php require_once(VWDIR.'p_employee_view.php'); ?></div>
				<!-- ========= END OF CONTENT ========= -->
			</div>
		</td>
	</tr>
	</table>
</td></tr>
</table>
<?php require_once(VWDIR.'footer.php');?>
</div>
<div id="fform_bg" style="display:none;opacity:0"></div>
<div id="fform" style="display:none;opacity:0"></div>
<div id="fformx" style="display:none;opacity:0;width:100%;height:100%;position:fixed;top:0px;left:0px;">
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div id="fformboxf" class="fformbox" style="width:300px;">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b><span id="tfformx">Take picture of <?=$r['fname']?></span></b>
		</div>
		<div style="padding:10px">
		<iframe id="imgframe" name="imgframe" scrolling="no" style="border:none;display:;width:280px;overflow:hidden" src="imgform.php?name=<?=$r['fname']?>"></iframe>
		</div>
	</div>
	</td></tr></table>
</div>

<div id="fformz" style="display:none;opacity:0;width:100%;height:100%;position:fixed;top:0px;left:0px;">
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div id="fformbozf" class="fformbox" style="width:400px">
		<div class="sfont" style="text-align:center;color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b>Give Reward<br/></b>
		</div>
		<div style="text-align:left;padding:15px 15px;width:370px">
			<table class="stable" cellspacing="0" cellpadding="4px" width="370px">
			<tr><td width="100px">Reward:</td><td><?=iText('rw_reward','',"width:250px")?></td></tr>
			<tr><td width="100px">By:</td><td><?=iText('rw_rewardby','',"width:250px")?></td></tr>
			<tr valign="top"><td>Description:</td><td><?=iTextarea('rw_description','',"width:250px",2)?></td></tr>
			<tr><td>Date:</td><td><?=inputDate('rw_date',date("Y-m-d"))?></td></tr>
			<tr><td>Attachment:</td><td>
				<iframe id="imgframe2" name="imgframe" scrolling="no" style="border:none;display:;height:25px;width:230px;overflow:hidden;margin:0;padding:0" src="rwform.php?name=<?=$r['fname']?>"></iframe>
			</td></tr>
			</table>
			<input type="hidden" id="rw_file" value=""/>
			<table cellspacing="0" cellpadding="3px" width="370px" style="margin-top:30px"><tr>
				<td align="center">
					<input type="button" class="btn" onclick="pf_reward('c')" value="Cancel"/>
					<input type="button" class="btnx" value="Save" onclick="pf_reward('a',0,true)"/>
				</td>
			</tr></table>
		</div>
	</div>
	</td></tr></table>
</div>

<div id="flog" style="display:none;position:fixed;top:0px;left:0px;width:100%;padding:5px;background:rgba(0,0,0,0.55);color:#ffffff"></div>
</body>
</html>