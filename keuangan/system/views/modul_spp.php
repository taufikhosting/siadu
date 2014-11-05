<?php appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$dept=gpost('departemen');
$departemen=departemen_r($dept);
$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$tingk=gpost('tingkat');
$tingkat=tingkat_r($tingk,$tajar);
$kls=gpost('kelas');
$kelas=kelas_r($kls,$tingk);

$fmod='modul_spp';

if(count($departemen)>0){
// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		tahunajaran_warn(1); exit();
	}
	/*
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$tingk,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$tingk);
		tingkat_warn(1); exit();
	}
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$angk,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
		kelas_warn(1); exit();
	}
	*/
	
$PSBar->end();

$modid=0;
$t=mysql_query("SELECT replid FROM keu_modul WHERE reftipe='".RT_SPP."' AND refid='$tajar'");
if(mysql_num_rows($t)>0){
$modul=mysql_fetch_array($t);
$modid=$modul['replid'];
/*
$inp=array('modul'=>$modid,'siswa'=>0,'nominal'=>0,'cicilan'=>0);
$t=mysql_query("SELECT aka_siswa.replid,aka_siswa.sumnet,aka_siswa.angsuran FROM aka_siswa WHERE aka_siswa.angkatan='$angk'");
while($r=mysql_fetch_array($t)){
	$t1=mysql_query("SELECT * FROM keu_pembayaran WHERE modul='$modid' AND siswa='".$r['replid']."'");
	if(mysql_num_rows($t1)==0){
		$inp['siswa']=$r['replid'];
		$inp['nominal']=$r['sumnet'];
		$inp['cicilan']=$r['angsuran'];
		$q=dbInsert("keu_pembayaran",$inp);
	}
}
*/
// Tabel transaksi
echo '<table cellspacing="0" cellpadding="0" width="100%"><tr valign="top">';
echo '<td width="350px"><div id="box_siswa" style="margin-right:10px">';
		require_once(APPDIR.'siswa_list_kelas_get.php');
echo '</td>';
echo '<td><div style="width:100%"><div id="box_pembayaran" style="display:none">';
		require_once(APPDIR.'pembayaran_proses_get.php');
echo '</div></div></td>';
echo '</tr></table>';
// End of Tabel transaksi

} else {
	echo '<div style="float:left;width:100%;margin-bottom:6px"><div class="warnbox" style="margin-right:4px">Belum ada modul pembayaran uang sekolah pada tahun ajaran ini. Silahkan menambah modul pembayaran.</div></div><button onclick="modul_form(\'af\')" class="btnz" style="float:left" title="Tambah modul pembayaran."><div class="bi_add2">Modul pembayaran</div></button>';
}

hiddenval('kategori',1);
hiddenval('modul',$modid);
hiddenval('reftipe',RT_SPP);
hiddenval('refid',$tajar);
hiddenval('siswa',0);
hiddenval('snama','Uang sekolah tahun ajaran '.$tahunajaran[$tajar]);


}else departemen_warn(1);
?>