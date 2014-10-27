<?php require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'control.php');  require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;

$fmod='pendataan_saudara_siswa';
$fform=new fform($fmod);
$fform->fformid='2';
$fform->reg['title_af']='<idata>';
$fform->reg['btnlabel_no']='Tutup';
$fform->dimension(500);
$fform->ptop=50;
$fform->head('Pilih Siswa'); //>>
$fform->box_begin();

$xtable=new xtable($fmod,'siswa');
$xtable->search_keyon('nama=>aka_siswa.nama:LIKE-1','nis=>aka_siswa.nis:EQ-0');
$xtable->search_box_pos('l','200px');

$dept=gpost('psdepartemen');
$departemen=departemen_r($dept);
$tajar=gpost('pstahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);
$ting=gpost('pstingkat');
$tingkat=tingkat_r($ting,$dept);
$kls=gpost('pskelas');
$kelas=kelas_r($kls,$ting,0,1);


$PSBar = new PSBar_2(100);
$PSBar->begin();
	$PSBar->selection('Departemen',iSelect('psdepartemen',$departemen,$dept,$PSBar->selws,$fmod.'_get()'));
	
	if(count($tahunajaran)>0){
		$PSBar->selection('Tahun Ajaran',iSelect('pstahunajaran',$tahunajaran,$tajar,$PSBar->selws,$fmod.'_get()'));
	} else {
		$PSBar->end();
		hiddenval('pstahunajaran',$tajar);
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		tahunajaran_warn(1);
		$PSBar->pass=false;
	}
	
	if($PSBar->pass){
	if(count($tingkat)>0){
		$PSBar->selection('Tingkat',iSelect('pstingkat',$tingkat,$ting,$PSBar->selws,$fmod.'_get()'));
	} else {
		$PSBar->end();
		hiddenval('pstingkat',$ting);
		hiddenval('pskelas',$kls);
		tingkat_warn(1);
		$PSBar->pass=false;
	}}
	
	if($PSBar->pass){
	if(count($kelas)>0){
		$PSBar->selection('Kelas',iSelect('pskelas',$kelas,$kls,$PSBar->selws,$fmod.'_get()'));
	} else {
		$PSBar->end();
		hiddenval('pskelas',$kls);
		kelas_warn(1);
		$PSBar->pass=false;
	}}
	
$PSBar->end();

$db=siswa_db_bykelas($kls,$ting,"tgllahir");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

$xtable->search_box();

$xtable->search_info('data siswa dengan {keyon} "<b>{keyw}</b>"'.($kls==0?'':'pada kelas '.$kelas[$kls]).'.');

if($xtable->ndata>0){
	$xtable->head('NIS','Nama');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$xtable->td($r['nis'],120);
		$xtable->td($r['nama']);
		if(admin_isoperator()) $s='<button class="btn" title="Lihat detil" onclick="pendataan_saudara_detil(\''.$r['replid'].'\')"><div class="bi_srcb">&nbsp;</div></button>&nbsp;<button class="btn" onclick="pendataan_saudara_set(\''.$r['nama'].'\',\''.$r['ndepartemen'].'\',\''.$r['tgllahir'].'\')">Pilih</button>~72px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else{
	$xtable->nodata_cust('Tidak ada data siswa'.($kls==0?'':' pada kelas ini').'.'.$kls);
}

$fform->foot(0); //>
?>