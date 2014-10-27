<?php appmod_use('aka/tahunajaran','aka/tingkat','aka/kelas','aka/siswa');

$fmod='member_siswa';
$xtable=new xtable($fmod,'member','',0,'member');
$xtable->search_keyon('kunci=>aka_siswa.nis:EQ|aka_siswa.nama:LIKE-0,1');
$xtable->pageorder="aka_siswa.nis";
$xtable->noopt=true;

$dept=gpost('departemen');
$departemen=departemen_r($dept,1);

$tajar=gpost('tahunajaran');
$tahunajaran=tahunajaran_r($tajar,$dept);

$tingk=gpost('tingkat');
$tingkat=tingkat_r($tingk,$tajar,1);

$kls=gpost('kelas');
$kelas=kelas_r($kls,$tingk);

$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($departemen)>0){
		$PSBar->selection('Departemen',iSelect('departemen',$departemen,$depat,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('departemen',$dept);
		hiddenval('tahunajaran',$tajar);
		hiddenval('tingkat',$tingk);
		hiddenval('kelas',$kls);
		departemen_warn(0);
		$PSBar->pass=false;
	}
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
		$PSBar->selection('Tingkat',iSelect('tingkat',$tingkat,$tingk,$PSBar->selws,$fmod."_get()"));
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
$db->field("COUNT(pus_peminjaman.buku) as cnt","SUM(CASE pus_peminjaman.status WHEN '1' THEN 1 ELSE 0 END) as cntpjm");
$db->join_cust("pus_peminjaman ON (pus_peminjaman.member = aka_siswa.replid AND pus_peminjaman.mtipe = '1')");
$db->where_and($xtable->search_sql_get());
$db->group("aka_siswa.replid");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('aka_siswa.nis','aka_siswa.nama','cntpjm','cnt'));

if($xtable->ndata>0){
	$xtable->head('@nis','@nama','Jml item sedang dipinjam{200px}','@Total peminjaman{120px}');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);

		$xtable->td($r['nis'],100);
		$xtable->td($r['nama']);
		$xtable->td($r['cntpjm'],200);
		$xtable->td($r['cnt'],120);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata_cust(); }
}
?>