<?php 
appmod_use('aka/siswa','aka/kelas','aka/pelajaran','aka/rapor');
$opt=gpost('opt'); $cid=gpost('cid',0);

/* Load App libraries */
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');


$dept=gpost('departemen');
$departemen=departemen_r($dept);
$proses=proses_r($pros,$dept);

// cell($a,$w=0,$c=1,$r=1,$al='',$b=-1,$bg='',$s='',$atr='')

$pros=gpost('proses');

$query= mysql_query("SELECT aka_mutasi.tanggal,aka_mutasi.departemen, aka_mutasi.keterangan, aka_siswa.nisn,aka_siswa.nama, aka_jenismutasi.nama as njenis 
							FROM aka_mutasi
							JOIN aka_siswa ON aka_siswa.replid=aka_mutasi.replid
                            JOIN aka_jenismutasi ON aka_jenismutasi.replid=aka_mutasi.replid
                            WHERE aka_mutasi.departemen='$dept'");

$token=doc_decrypt($token);

$doc=new doc();
$doc->dochead("Laporan Mutasi Siswa ".gets('kelompok'),7);
$doc->nl();

$doc->row_blank(7);

//$t=dbQSql($token);
$no=1;
$doc->head('No{C}','@Tanggal','@NISN','@Angkatan','@Nama','@Jenis Mutasi','@Keterangan');

while($r=mysql_fetch_array($query)){

		
$doc->nl();
$doc->cell($no++,20,'c');
$doc->cell(fftgl($r['tanggal']),80);
$doc->cell($r['nisn'],30);
$doc->cell($r['siswa'],80);
$doc->cell($r['njenis'],50);
$doc->cell($r['keterangan'],50);
}

$doc->end(); ?>