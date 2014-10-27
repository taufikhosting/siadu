<?php
$reqs=Array('nip','nama','kelamin','tmplahir','tgllahir','agama','alamat','kodepos','telpon','pinbb','email','posisi','tingkat','bagian','status','kelompok','darah','berat','tinggi','kesehatan','keterangan');

$inp=Array();
foreach($reqs as $key=>$val){
	$inp[$val]=gpost($val);
}

$p=gpost('photo');
if(!empty($p)){
	$inp['photo']=dbFetch("photo","psb_tmp","W/dcid='".gpost('photo')."'");
}

$sql="INSERT INTO hrd_pegawai SET "; $f=true;
foreach($inp as $key=>$val){
	if(!$f) $sql.=","; else $f=false;
	$sql.="`".$key."`='".addslashes($val)."'";
}

if(mysql_query($sql)) $_SESSION[ASID.'notifbox']='<div id="notifbox" class="infobox">Data calon pegawai telah ditambahkan.</div>';
else $_SESSION[ASID.'notifbox']='<div id="notifbox" class="warnbox">Data calon siswa tidak dapat ditambahkan. Terjadi kesalahan teknis program. Silahkan menghubungi administrator.</div>';

?>