<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

?>
<div style="float:left;width:100%;margin-bottom:20px;border-bottom:1px solid #01a8f7">
<div class="gptab1" onclick="sirkulasi_peminjaman_form_member_list_siswa_get(0)">Siswa</div>
<div class="gptab" onclick="sirkulasi_peminjaman_form_member_list_pegawai_get(0)">Pegawai</div>
<div class="gptab" onclick="sirkulasi_peminjaman_form_member_list_lain_get(0)">Member Luar</div>
</div>
<?php

$fmod='sirkulasi_peminjaman_form_member_list_siswa';
$xtable=new xtable($fmod,'item','',3);
$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
$xtable->search_box_pos('l');
$xtable->pageorder="aka_siswa.nis";

$dept=gpost('ff2_departemen');
$departemen=departemen_r($dept);

$tajar=gpost('ff2_tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$tingk=gpost('ff2_tingkat');
$tingkat=tingkat_r($tingk,$tajar,1);

$kls=gpost('ff2_kelas');
$kelas=kelas_r($kls,$tingk,0,1);

$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($departemen)>0){
		$PSBar->selection('Departemen',iSelect('ff2_departemen',$departemen,$depat,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff2_departemen',$dept);
		hiddenval('ff2_tahunajaran',$tajar);
		hiddenval('ff2_tingkat',$tingk);
		hiddenval('ff2_kelas',$kls);
		departemen_warn(0);
		$PSBar->pass=false;
	}
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('ff2_tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff2_tahunajaran',$tajar);
		hiddenval('ff2_tingkat',$tingk);
		hiddenval('ff2_kelas',$kls);
		tahunajaran_warn(0);
		$PSBar->pass=false;
	}
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('ff2_tingkat',$tingkat,$tingk,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff2_tingkat',$tingk);
		hiddenval('ff2_kelas',$kls);
		tingkat_warn(0);
		$PSBar->pass=false;
	}	
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('ff2_kelas',$kelas,$kls,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff2_kelas',$kls);
		kelas_warn(0);
		$PSBar->pass=false;
	}
$PSBar->end();
if($PSBar->pass){

$xtable->search_box('nis atau nama siswa');
			  
$db=siswa_db_bykelas($kls,$tingk);
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('aka_siswa.nis','aka_siswa.nama'));

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('@nis','@nama','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		
		if(admin_isoperator()) $s='<button class="btn" onclick="sirkulasi_peminjaman_form_member_set(1,'.$r['replid'].')">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
} else { $xtable->nodata_cust(); }
}
?>