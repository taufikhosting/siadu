<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php');
appmod_use('aka/angkatan','aka/siswa');

$fmod='daftarnilai_list';
$xtable=new xtable($fmod,'siswa','',2);
//$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
//$xtable->search_box_pos('l');
$xtable->noopt=true;

//$xtable->use_select();
//$xtable->select_noopt=true;
//$xtable->select_cekfunc="siswa_pendataan_kelas_list_cek(param)";
/*
$dept=gpost('ff_departemen');
$departemen=departemen_r($dept);

$angk=gpost('ff_angkatan');
$angkatan=angkatan_r($angk,$dept);
*/

$pel=gpost('pelajaran');
$kls=gpost('kelas');
$peni=gpost('penilaian');
			  
$db=siswa_db_bykelas($kls);
$db->field("aka_daftarnilai:nilai,keterangan as ketnilai");
$db->join("siswa","aka_daftarnilai","siswa");
$db->where_and("aka_daftarnilai.penilaian='$peni'");
$t=$db->query();
$xtable->ndata_db($t);

if($xtable->ndata>0){
	echo '<div style="width:100%;height:300px;max-height:300px;overflow:auto">';
	$xtable->head('!NIS','nama','Nilai{C}','Keterangan');
	$n=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['nis'],80);
		$xtable->td($r['nama'],250);
		$xtable->td(iText('nilai_'.$r['replid'],$r['nilai'],'width:100%;text-align:center'),50);
		$xtable->td(iText('ket_'.$r['replid'],$r['ketnilai'],'width:100%'));
		
		$n++;
	$xtable->row_end();}$xtable->foot();
	echo '</div>';
} else { $xtable->nodata(); }
?>