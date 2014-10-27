<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$fmod='mutasi_siswa_list';
$xtable=new xtable($fmod,'item','',2);
$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
$xtable->search_box_pos('l');
$xtable->pageorder="aka_siswa.nis";

$dept=gpost('departemen');

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$tingk=gpost('tingkat');
$tingkat=tingkat_r($tingk,$tajar,1);

$kls=gpost('kelas');
$kelas=kelas_r($kls,$tingk,0,1);

$PSBar = new PSBar_2(100);
$PSBar->begin();
	$PSBar->selection('Departemen',departemen_name($dept));

	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('tahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$tingk);
		hiddenval('kelas',$kls);
		tahunajaran_warn(0);
		$PSBar->pass=false;
	}
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$tingk,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('tingkat',$tingk);
		hiddenval('kelas',$kls);
		tingkat_warn(0);
		$PSBar->pass=false;
	}	
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('kelas',$kelas,$kls,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('kelas',$kls);
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
	$xtable->head('@!NIS','@nama','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		
		if(admin_isoperator()) $s='<button class="btn" onclick="mutasi_siswa_set('.$r['replid'].',\''.$r['nis'].'\',\''.$r['nama'].'\')">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
} else { $xtable->nodata_cust(); }
}
?>