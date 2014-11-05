<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/angkatan','aka/siswa');

$fmod='alumni_list';
$xtable=new xtable($fmod,'siswa','',2);
$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
$xtable->search_box_pos('l');
$xtable->pageorder="aka_siswa.nis";
$xtable->use_select();
$xtable->select_noopt=true;
$xtable->select_cekfunc="alumni_list_cek(param)";
$xtable->disabletextselection();

$dept=gpost('ff_departemen');
$departemen=departemen_r($dept);

$angk=gpost('ff_angkatan');
$angkatan=angkatan_r($angk,$dept);

$kls=gpost('kelas');

$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($departemen)>0){
		$PSBar->selection('Departemen',iSelect('ff_departemen',$departemen,$depat,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff_departemen',$dept);
		hiddenval('ff_angkatan',$angk);
		departemen_warn(0);
		$PSBar->pass=false;
	}
	if(count($angkatan)>0){
		$PSBar->selection('Angkatan',iSelect('ff_angkatan',$angkatan,$angk,$PSBar->selws,$fmod."_get(1)"));
	} else {
		$PSBar->end();
		hiddenval('ff_angkatan',$angk);
		angkatan_warn(0);
		$PSBar->pass=false;
	}
$PSBar->end();
if($PSBar->pass){

$xtable->search_box('nis atau nama siswa');
			  
$db=siswa_db_byangkatan($angk);
$db->where_and("!( NOT EXISTS (SELECT aka_alumni.replid FROM aka_alumni WHERE aka_alumni.siswa=aka_siswa.replid) )");
$db->where_and($xtable->search_sql_get());
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('aka_siswa.nis','aka_siswa.nama'));

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto;float:left">';
	$xtable->head('@nis','@nama','{44px}');
	$n=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		
		if(admin_isoperator()) $s='<button class="btn" onclick="xtable2_cekall(false);xtable2_sel('.$n.');alumni_form(\'a\',\'0\',true)"">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
		$n++;
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
} else { $xtable->nodata_cust(); }
}
?>