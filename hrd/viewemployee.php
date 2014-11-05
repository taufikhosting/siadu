<?php
define('RLNK','http://127.0.0.1/hrd/');
define('IMGR','http://127.0.0.1/hrd/images/');
require_once('db.php');
require_once('common.php');

$empstatus=getStatus();
$dataeks=getDataEks();
$empnikah=getNikah();
$ct_bg="folderico.png";
?>
<html>
<head>
<?php require_once('style.php');?>
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
	min-width:120px;
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
	min-width:120px;
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
	width:450px;
	padding:4px;
	margin-bottom:15px
}
.ipfbox:hover {
	background:#e9ecec;
	border:1px solid #dbe1e1;
	padding:3px;
}
</style>
<script type="text/javascript" src="djsobj.js"></script>
<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
<script type="text/javascript" language="javascript">
var oku=0;
var imgcek=false;
function search_foc(){
	if(E('search_input').value=='Cari nama atau nip...'){
		E('search_input').value='';
	}
	E('search_input').style.color='black';
	
	if(E('search_input').style.width!='175px') $("#search_input").animate({"width": "175px"}, { queue: false, duration: 200 });
}
function search_blur(){
	if(E('search_input').value==''){
		E('search_input').value='Cari nama atau nip...';
		E('search_input').style.color='#999999';
		$("#search_input").animate({"width": "145px"}, { queue: false, duration: 200 });
	}
}
function doSearch(){
	if(E('search_input').value!='' && E('search_input').value!='Cari nama atau nip...'){
		E('srcform').submit();
	}
}
function selectAll(){
	var n=E('nrow').value;
	for(var i=0;i<parseInt(n);i++){
		
	}
}
function close_fform(){
	$("#fform_bg").animate({ opacity: "0" }, 100 , function(){ E('fform_bg').style.display='none'; });
	$("#fform").animate({ opacity: "0" }, 100 , function(){ E('fform').style.display='none'; });
	E('fform').innerHTML='';
}

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
	var id=E('empid').value;
	_POST('xpf_summary&id='+id,function(r){
		//E('pf_summary').innerHTML=r;
		var b=r.split("~");
		for(var i=0;i<4;i++){
			E('sumf'+i).innerHTML=b[i];
		}
		if(b[4]!='0'){
			if(E('pfflag').value=='0'){
				E('pfflag').value=b[4];
				E('sumfbtn1').style.top='0px';
			}
		}
	});
}
/** Tambah Status **/
function addEntry(){
	_POST('emp_addstat',function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
	//open_fform();
}

function emp_addstat(){
	var id=E('empid').value;
	var n=E('empfname').value;
	var a=E('statusid').value;
	var b=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var c=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	_POST("emp_poststat&id="+id+"&name="+n+"&statusid="+a+"&tanggal1="+b+"&tanggal2="+c,function(r){
		close_fform();
		E('pfb_status_data').innerHTML=r;
		updpfSummary();
	});
}


function cekStatR(a,b){
	if(a!=b){
		E('rtgl2').style.display='';
		E('stgl2').style.display='';
	} else {
		E('rtgl2').style.display='none';
		E('stgl2').style.display='none';
	}
}
/********** DATA TRAINING **********/
function addTrain(){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_addtrain&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function editTrain(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_editrain&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function delTrain(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_deltrain&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
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
	_POST("emp_posttrain&opt=a&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
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
	_POST("emp_posttrain&opt=u&cid="+cid+"&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}
function emp_deltrain(cid){
	var id=E('empid').value;
	_POST("emp_posttrain&opt=d&cid="+cid+"&id="+id,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}

/********** END OF DATA TRAINING **********/

/********** DATA REWARD **********/
function addReward(){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_addreward&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function editReward(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_editreward&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function delReward(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_reward&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function emp_addreward(){
	var id=E('empid').value;
	var reward=E('reward').value;
	var tanggal=E('tanggal_y').value+"-"+E('tanggal_m').value+"-"+E('tanggal_d').value;
	var deskripsi=E('deskripsi').value;
	
	_POST("emp_postreward&opt=a&id="+id+"&reward="+reward+"&tanggal="+tanggal+"&deskripsi="+deskripsi,function(r){
		close_fform();
		E('pfb_reward_data').innerHTML=r;
		updpfSummary();
	});
}
function emp_editreward(cid){
	var id=E('empid').value;
	var reward=E('reward').value;
	var tanggal=E('tanggal_y').value+"-"+E('tanggal_m').value+"-"+E('tanggal_d').value;
	var deskripsi=E('deskripsi').value;
	
	_POST("emp_postreward&opt=u&cid="+cid+"&id="+id+"&reward="+reward+"&tanggal="+tanggal+"&deskripsi="+deskripsi,function(r){
		close_fform();
		E('pfb_reward_data').innerHTML=r;
		updpfSummary();
	});
}
function emp_delreward(cid){
	var id=E('empid').value;
	_POST("emp_postreward&opt=d&cid="+cid+"&id="+id,function(r){
		close_fform();
		E('pfb_reward_data').innerHTML=r;
		updpfSummary();
	});
}
/********** END OF DATA REWARD **********/

/********** DATA EKSPATRIAT **********/
function addDataeks(){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_dataeks&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function emp_adddataeks(){
	var id=E('empid').value;
	var dokumen=E('dokumen').value;
	var tanggal1=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var tanggal2=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	var status=E('status').value;
	
	_POST("emp_postdataeks&opt=a&id="+id+"&dokumen="+dokumen+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2+"&status="+status,function(r){
		close_fform();
		//var s=r.split("~");
		E('pfb_ekspat_data').innerHTML=r;
		//updpfSummary();
		//xfadeout('pfde'+s[0],1,0,1);
	});
}

function editDataeks(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_editdataeks&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function emp_editdataeks(cid){
	var id=E('empid').value;
	//var dokumen=E('dokumen').value;
	var tanggal1=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var tanggal2=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	var status=E('status').value;
	
	_POST("emp_postdataeks&opt=u&cid="+cid+"&id="+id+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2+"&status="+status,function(r){
		close_fform();
		E('pfb_ekspat_data').innerHTML=r;
		//updpfSummary();
	});
}
function delDataeks(cid){
	var id=E('empid').value;
	var n=E('empfname').value;
	_POST('emp_deldataeks&cid='+cid+'&id='+id+'&name='+n,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function emp_deldataeks(cid){
	var id=E('empid').value;
	_POST("emp_postdataeks&opt=d&cid="+cid+"&id="+id,function(r){
		close_fform();
		E('pfb_ekspat_data').innerHTML=r;
		//updpfSummary();
	});
}
function shdataeks(a){
	var flg=true;
	for(var i=0;i<a;i++){
		if(E('pfdeh'+i).style.display=='none'){
			E('pfdeh'+i).style.display='';
			flg&=true;
		} else {
			E('pfdeh'+i).style.display='none';
			flg&=false;
		}
	}
	if(flg){
		E('pfdeha').innerHTML="Sembunyikan dokumen tidak aktif...";
	} else {
		E('pfdeha').innerHTML="Tampilkan dokumen tidak aktif...";
	}
}
/********** END OF DATA EKSPATRIAT **********/

function cekJenisTrain(a){
	if(a=='Inhouse'){
		E('penyelenggara').value='VITA';
		E('tempat').value='VITA School';
	} else {
		E('penyelenggara').value='';
		E('tempat').value='';
	}
}
function addCuti(){
	var id=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_POST('emp_addcuti&tgl=0&id='+id+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function addDCuti(a){
	var id=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_POST('emp_addcuti&tgl='+a+'&id='+id+"&name="+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function editCuti(id){
	var eid=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_POST('emp_editcuti&tgl=0&id='+id+'&eid='+eid+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function delCuti(id){
	var eid=E('empid').value;
	var n=E('empfname').value;
	var s=E('scuti').value;
	_POST('emp_delcuti&tgl=0&id='+id+'&eid='+eid+'&name='+n+'&scuti='+s,function(r){
		E('fform').innerHTML=r;
		open_fform();
	});
}
function takePhoto(){
	var id=E('empid').value;
	_POST('emp_postphoto&id='+id,function(r){
		//E('fform').innerHTML=r;
		//open_fform();
		E('pf_photo').innerHTML=r;
		E('pfp_btn').title="Ganti foto karyawan";
		E('pfp_lbl').innerHTML="Ganti Foto";
		close_uform();
	});
}
function hitungHari(){
	if(E('tanggal1_y').value==0 || E('tanggal1_m').value==0 || E('tanggal1_d').value==0||E('tanggal2_y').value==0 || E('tanggal2_m').value==0 || E('tanggal2_d').value==0){
		E('htnghari').innerHTML='-';
	} else {
		var s=E('scuti').value;
		var t1=new Date(E('tanggal1_y').value,E('tanggal1_m').value,E('tanggal1_d').value);
		var t2=new Date(E('tanggal2_y').value,E('tanggal2_m').value,E('tanggal2_d').value);
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
		var t1=new Date(E('tanggal1_y').value,E('tanggal1_m').value,E('tanggal1_d').value);
		var t2=new Date(E('tanggal2_y').value,E('tanggal2_m').value,E('tanggal2_d').value);
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
	var b=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var c=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	_POST("emp_postcuti&opt=a&id="+id+"&cmonth="+cmonth+"&keterangan="+a+"&tanggal1="+b+"&tanggal2="+c,function(r){
		close_fform();
		var s=r.split("~");
		E('pfb_2').innerHTML=s[1];
		updpfSummary();
		dfadeout(s[0],1,0,1);
	});
}
function emp_updatecuti(a){
	var id=E('empid').value;
	var cmonth=E('cmonth').value;
	var cid=a;
	var a=E('keterangan').value;
	var b=E('tanggal1_y').value+"-"+E('tanggal1_m').value+"-"+E('tanggal1_d').value;
	var c=E('tanggal2_y').value+"-"+E('tanggal2_m').value+"-"+E('tanggal2_d').value;
	_POST("emp_postcuti&opt=u&cid="+cid+"&id="+id+"&cmonth="+cmonth+"&keterangan="+a+"&tanggal1="+b+"&tanggal2="+c,function(r){
		close_fform();
		var s=r.split("~");
		E('pfb_2').innerHTML=s[1];
		updpfSummary();
		dfadeout(s[0],1,0,1);
	});
}
function updatecuti(){
	var id=E('empid').value;
	_POST("update_cuti&id="+id,function(r){
		E('pfb_2').innerHTML=r;
	});
}
function emp_delcuti(a){
	var id=E('empid').value;
	var cmonth=E('cmonth').value;
	var cid=a;
	_POST("emp_postcuti&opt=d&cid="+cid+"&id="+id+"&cmonth="+cmonth,function(r){
		close_fform();
		E('pfb_2').innerHTML=r;
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
	_POST("emp_postcuti&opt=s&id="+id+"&cmonth="+cmonth,function(r){
		//close_fform();
		E('pfb_2').innerHTML=r;
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
	_POST("emp_posttrain&opt=a&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
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
	_POST("emp_posttrain&opt=u&cid="+cid+"&id="+id+"&judul="+judul+"&jenis="+jenis+"&penyelenggara="+penyelenggara+"&tempat="+tempat+"&peserta="+peserta+"&tanggal1="+tanggal1+"&tanggal2="+tanggal2,function(r){
		close_fform();
		E('pfb_3').innerHTML=r;
		updpfSummary();
	});
}
function emp_deltrain(cid){
	var id=E('empid').value;
	_POST("emp_posttrain&opt=d&cid="+cid+"&id="+id,function(r){
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
	_POST('emp_editipf1&id='+id+'&name='+n,function(r){
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
	
	_POST('emp_editipf1x&id='+id+'&nip='+nip+'&empbagian='+empbagian+'&staff='+staff+'&golongan='+golongan,function(r){
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
	for(var i=0;i<7;i++){
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
	
	_POST('emp_gajisave&id='+id+"&"+ps,function(r){
		E('pfb_gaji_data').innerHTML=r;
	});
}
</script>
</head>
<body>
<div style="width:1000px;margin:auto">
<table cellspacing="0" cellpadding="0" width="1000px">
<tr valign="top">
	<?php require_once('banner.php');?>
</tr>
<tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="1000px">
	<tr><td>
		<?php $cview="employee"; require_once('tabs.php');?>
	</td><td align="right">
		<?php require_once('srcform.php'); ?>
	</td></tr>
	<tr><td colspan="2">
		<!--============================= CONTENTS =============================-->
		<?php
			$dcid=$_REQUEST['nid'];
			$t=mysql_query("SELECT * FROM jbssdm.employment_app WHERE dcid='$dcid'");
			$n=mysql_num_rows($t);
			$cth="700";
			if($n>0){
				$r=mysql_fetch_array($t);
				if($r['empbagian']=='Non Akademik') $cth="1100";
			}
		?>
		<div id="ct_box">
			<div class="tview"><b>Data Karyawan</b></div>
			<div style="width:940px;height:32px;position:relative;display:none">
			<div class="r_bar" style="left:130px"></div>
			<div class="r_bar" style="left:0"></div>
			</div>
			<button class="btn" style="margin-bottom:5px" title="Kembali ke halaman daftar karyawan" onclick="jumpTo('<?=RLNK?>employee.php')">
				<div style="background:url('<?=IMGR?>larrow.png') no-repeat;padding-left:16px">Daftar Karyawan</div>
			</button>
			<button class="btn" style="margin-bottom:5px" title="Ubah data karyawan" onclick="jumpTo('<?=RLNK?>editemployee.php?nid=<?=$r['dcid']?>')">
				<div style="background:url('<?=IMGR?>bi_pencil.png') no-repeat;padding-left:16px">Edit Data Karyawan</div>
			</button>
			<?php
			if($n>0){
			$r['status']=strtoupper($empstatus[$r['statuskaryawan']]); $nm=explode(" ",$r['name']); if($r['gender']=='Pria') $r['fname']="Mr. ".$nm[0]; else $r['fname']="Mrs. ".$nm[0];?>
			<input type="hidden" id="empid" value="<?=$r['dcid']?>"/>
			<input type="hidden" id="empfname" value="<?=$r['fname']?>"/>
			<div class="pf_name">
			<span style="font:bold 28px 'Cambria', 'Trebuchet MS',Verdana,Tahoma;color:#0070d8;text-shadow: 1px 2px rgba(0,0,0,0.25);"><i><?=$r['name']?></i></span>
			</div>
			<div class="pf_box">
			<table class="stable" cellspacing="0" cellpadding="0" width="918">
				<tr valign="top">
					<td style="padding-left:5px">
						<div id="ipf1" class="ipfbox" onmouseover="E('eipf1').style.display=''" onmouseout="E('eipf1').style.display='none'">
							<?php require_once('apps/ipf1.php');?>
						</div>
						<span style="color:#444444;font:bold 12px Verdana,Tahoma">Data Pribadi</span>
						<div id="pf_less" style="display:">
						<table class="pf_table" cellspacing="5px" cellpadding="0">
							<tr><td width="140px">Alamat Asal</td><td>: <?=$r['address']?></td></tr>
							<tr><td>Alamat Surabaya</td><td>: <?=$r['addresssby']?></td></tr>
							<tr><td>Email</td><td>: <?=$r['email']?></td></tr>
							<tr><td>Telepon Rumah</td><td>: <?=$r['home_phone']?></td></tr>
							<tr><td>Fax</td><td>: <?=$r['home_phone']?></td></tr>
							<tr><td>Handphone</td><td>: <?=$r['cellphone']?></td></tr>
							<tr><td>Tempat Tanggal Lahir</td><td>: <?=$r['birth_place']?>, <?=fftgl($r['birth_date'])?></td></tr>
						</table>
						</div>
						<div id="pf_more" style="display:none;width:500px;height:380px;overflow:auto">
						<table class="pf_table" cellspacing="5px" cellpadding="0" width="480px">
							<tr><td width="140px">Alamat Asal</td><td>: <?=$r['address']?></td></tr>
							<tr><td>Alamat Surabaya</td><td>: <?=$r['addresssby']?></td></tr>
							<tr><td>Email</td><td>: <?=$r['email']?></td></tr>
							<tr><td>Telepon Rumah</td><td>: <?=$r['home_phone']?></td></tr>
							<tr><td>Fax</td><td>: <?=$r['home_phone']?></td></tr>
							<tr><td>Handphone</td><td>: <?=$r['cellphone']?></td></tr>
							<tr><td>Tempat Tanggal Lahir</td><td>: <?=$r['birth_place']?>, <?=fftgl($r['birth_date'])?></td></tr>
							<tr><td width="140px">Status pernikahan</td><td>: <?=$empnikah[$r['marital_stat']]?></td></tr>
							<tr><td>Agama dan denominasi</td><td>: <?=$r['religion']?></td></tr>
							<tr><td>Nama gereja</td><td>: <?=$r['church_name']?></td></tr>
							<tr><td>Alamat gereja</td><td>: <?=$r['church_address']?></td></tr>
							<tr><td>Nama pendeta/pastor</td><td>: <?=$r['pastor_name']?></td></tr>
							<tr><td>Kegiatan di gereja</td><td>: <?=$r['church_activity']?></td></tr>
							<tr><td>Hobi</td><td>: <?=$r['hobbies']?></td></tr>
						</table>
						</div>
						<div style="padding-left:5px;margin-top:15px">
						<a id="pf_smore" class="linkl11" href="javascript:void(0)" onclick="showmore()">Tampilkan data lainnya...</a>
						</div>
						<?php
							
						?>
					</td>
					<td align="right" width="180px">
						<div id="pf_summary" style="padding-top:10px">
							<?php require_once('apps/pf_summary.php');?>
						</div>
					</td>
					<td width="165px" align="center" style="padding-top:10px">
						<?php 
						$np=dbSRow("jbssdm.empapp_photo","W/empappid='".$r['dcid']."'");
						if($np>0){ ?>
							<div id="pf_photo"><img src="<?=RLNK?>apps/pf_photo.php?id=<?=$r['dcid']?>"/></div><br/>
							<button id="pfp_btn" class="btn" title="Ganti foto karyawan" onclick="open_uform()">
								<div id="pfp_lbl" style="background:url('<?=IMGR?>bi_photo.png') no-repeat;padding-left:16px">Ganti Foto</div>
							</button><br/>
						<?php } else {?>
							<div id="pf_photo"><img src="<?=IMGR?>nophoto.png"/></div><br/>
							<button id="pfp_btn" class="btn" title="Tambahkan foto baru" onclick="open_uform()">
								<div id="pfp_lbl" style="background:url('<?=IMGR?>bi_photo.png') no-repeat;padding-left:16px">Tambahkan Foto</div>
							</button><br/>
						<?php } ?>
					</td>
				</tr>
			</table>
			</div>
			<br/>
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td>
					<table cellspacing="0" cellpadding="0"><tr>
						<td><button id="pft_0" class="pf_tab1" onclick="switch_tab(0)">Status</button></td>
						<td id="swtab5" style="display:<?=(($r['golongan']=="Lokal")?"none":"")?>"><button id="pft_5" class="pf_tab" style="margin-left:1px" onclick="switch_tab(5)">Dokumen Ekspatriat</button></td>
						<td style="display:none"><button id="pft_1" class="pf_tab" style="margin-left:1px" onclick="switch_tab(1)">Data Keluarga</button></td>
						<td id="swtab2" style="display:<?=(($r['empbagian']=="Non Akademik")?"":"")?>"><button id="pft_2" class="pf_tab" style="margin-left:1px;" onclick="switch_tab(2)">Cuti</button></td>
						<td><button id="pft_3" class="pf_tab" style="margin-left:1px" onclick="switch_tab(3)">Training</button></td>
						<td><button id="pft_6" class="pf_tab" style="margin-left:1px" onclick="switch_tab(6)">Gaji</button></td>
						<td><button id="pft_4" class="pf_tab" style="margin-left:1px" onclick="switch_tab(4)">Rewards</button></td>
						</tr></table>
					</td>
				</tr>
				<tr><td>
					<!-- STATUS KARYAWAN -->
					<div id="pfb_0" class="pf_pbox" style="display:">
						<div id="pfb_status_data">
						<?php require_once('apps/data_status.php');?>
						</div>
						<button id="addStatBtn" class="btn" title="Menambah status baru" onclick="addEntry()" style="margin-top:10px">
						<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">Status Baru</div>
						</button>
					</div>
					<!-- DATA KELUARGA -->
					<div id="pfb_1" class="pf_pbox" style="display:none">
					</div>
					<!-- CUTI & KEHADIRAN -->
					<input type="hidden" id="cmonth" value="<?=date("m")?>"/>
					<div id="pfb_2" class="pf_pbox" style="display:none">
						<?php $cmonth = date("m"); require_once('apps/data_cuti.php');?>
					</div>
					<!-- TRAINING -->
					<div id="pfb_3" class="pf_pbox" style="display:none">
						<?php require_once('apps/data_train.php');?>
					</div>
					<!-- REWARD -->
					<div id="pfb_4" class="pf_pbox" style="display:none">
						<div id="pfb_reward_data">
						<?php require_once('apps/data_reward.php');?>
						</div>
						<button id="addRewardBtn" class="btn" onclick="addReward()" style="margin-top:10px">
						<div style="background:url('<?=IMGR?>bi_star.png') no-repeat;padding-left:16px">Berikan Reward</div>
						</button>
					</div>
					<!-- DATA EKS -->
					<div id="pfb_5" class="pf_pbox" style="display:none">
						<div id="pfb_ekspat_data">
						<?php require_once('apps/data_ekspat.php');?>
						</div>
						<button id="addStatBtn" class="btn" title="Menambah dokumen baru" onclick="addDataeks()" style="margin-top:10px">
						<div style="background:url('<?=IMGR?>addico.png') no-repeat;padding-left:16px">Dokumen Baru</div>
						</button>
					</div>
					<!-- DATA GAJI -->
					<div id="pfb_6" class="pf_pbox" style="display:none">
						<div id="pfb_gaji_data">
						<?php require_once('apps/data_gaji.php');?>
						</div>
					</div>
				</td></tr>
			</table>
			<?php } else { ?>
			
			<?php } ?>
		</div>
	</td></tr>
	</table>
</td></tr>
</table>
<?php require_once('footer.php');?>
</div>
<div id="fform_bg" style="display:none;opacity:0;width:100%;height:100%;background:url('<?=IMGR?>greyop.png');position:fixed;top:0px;left:0px"></div>
<div id="fform" style="display:none;opacity:0;width:100%;height:100%;position:fixed;top:0px;left:0px;"></div>
<script type="text/javascript" language="javascript">
function doCek(k){
	var a=document.imgframe.regform.isImgOK.value;
	E('testo').value=a+oku;
	oku++;
	var nc="true";
	if(a!="No"){
		var b = a.split("~");
		E('imgframe').style.height=(5+parseInt(b[0]))+'px';
		E('imgframe').style.display='';
		E('posbtn').style.display='';
		E('loader').style.display='none';
		E('imessage').innerHTML=b[1];
		nc="false";
	}
	if(k)setTimeout("doCek("+nc+")",1000);
}
function doUpload(){
	oku=0;
	E('imgframe').style.display='none';
	E('prebtn').style.display='none';
	E('loader').style.display='';
	doCek(true);
	document.imgframe.regform.submit();
}
</script>
<div id="fformx" style="display:none;opacity:0;width:100%;height:100%;position:fixed;top:0px;left:0px;">
	<table cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding-top:120px">
	<div class="fformbox" style="width:300px;">
		<div class="sfont" style="color:#ffffff;border-radius:5px 5px 0 0;background:#6a92e5;padding:6px 0 6px 0;">
			<b>Ambil Foto <?=$r['fname']?></b>
		</div>
		<div style="padding:10px">
		<iframe id="imgframe" name="imgframe" scrolling="no" style="border:none;display:;width:280px;overflow:hidden" src="imgform.php?name=<?=$r['fname']?>"></iframe>
		</div>
	</div>
	</td></tr></table>
</div>
</body>
</html>