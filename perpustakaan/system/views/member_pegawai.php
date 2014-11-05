<?php
$fmod='member_pegawai';
$xtable=new xtable($fmod,'member','',0,'member');
$xtable->search_keyon('kunci=>hrd_pegawai.nip:EQ|hrd_pegawai.nama:LIKE-0,1');

/*
SELECT aka_siswa.replid, aka_siswa.nis, aka_siswa.nama, COUNT( pus_peminjaman.buku ) AS cnt
FROM aka_siswa
LEFT JOIN pus_peminjaman ON ( pus_peminjaman.member = aka_siswa.replid
AND pus_peminjaman.mtipe =  '1' ) 
GROUP BY aka_siswa.replid
*/

// Query
$db=new xdb('hrd_pegawai');
$db->field('hrd_pegawai:replid,nip,nama',"COUNT(pus_peminjaman.buku) as cnt","SUM(CASE pus_peminjaman.status WHEN '1' THEN 1 ELSE 0 END) as cntpjm");
$db->join_cust("pus_peminjaman ON (pus_peminjaman.member = hrd_pegawai.replid AND pus_peminjaman.mtipe = '2')");
$db->where_and($xtable->search_sql_get());
$db->group("hrd_pegawai.replid");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('hrd_pegawai.nip','hrd_pegawai.nama','','','cntpjm','cnt'));

$xtable->btnbar_begin();
	//$xtable->btnbar_add();
	$xtable->search_box('nip atau nama pegawai');
$xtable->btnbar_end();

if($xtable->ndata>0){
	// Table head
	$xtable->head('@!NIP','@Nama','Jml item sedang dipinjam{200px}','@Total peminjaman{120px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['nip'],80);
		$xtable->td($r['nama']);
		$xtable->td($r['cntpjm'],200);
		$xtable->td($r['cnt'],120);
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>