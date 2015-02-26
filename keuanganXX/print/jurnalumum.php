<?php appmod_use('aka/siswa','aka/kelas','aka/pelajaran','aka/rapor');

// Query
$sql=gpost('pagesql');
$t=mysql_query($sql);

$doc=new doc(1);
$doc->colnum=1;
$doc->dochead("JURNAL UMUM",$doc->colnum);
$doc->row_blank($doc->colnum);

$doc->nl();
	$doc->cell('<b>NAMA</b>',100,'',2);
	$doc->cell('<b>: '.strtoupper($siswa['nama']).'</b>',0,'',4);
	
/*	
$doc->nl();
	$doc->cell('<b>NIS</b>',100,'',2);
	$doc->cell('<b>: '.$siswa['nis'].'</b>',0,'',4);
	
$doc->nl();
	$doc->cell('<b>KELAS</b>',100,'',2);
	$doc->cell('<b>: '.$siswa['nkelas'].'</b>',0,'',4);
	
$doc->nl();
	$doc->cell('',40);
	$doc->cell('',60);
	$doc->cell('',0,'',4);

$doc->cell_format('border:1,align:c');
$doc->nl(30);
	$doc->cell('<b>NO</b>',40);
	$doc->cell('<b>MATA PELAJARAN</b>',0,'',2);
	$doc->cell('<b>NILAI</b>',80);
	$doc->cell('<b>KKM</b>',80);
	$doc->cell('<b>KETUNTASAN</b>',120);

$no=1; $jmlnilai=0;
$tpel=dbQSql("SELECT aka_pelajaran.replid,aka_pelajaran.nama FROM aka_sks LEFT JOIN aka_pelajaran ON aka_pelajaran.replid=aka_sks.pelajaran WHERE aka_sks.kelas='".$siswa['idkelas']."' GROUP BY aka_sks.pelajaran ORDER BY aka_pelajaran.nama");
while($rpel=dbFA($tpel)){
$doc->nl(); // cell($a,$w=0,$al='',$c=1,$r=1,$b=-1,$bg='',$s='',$atr='')
	$nilai=rapor_pelajaran_nilai($rpel['replid'],$kls,$siswa['replid']);
	$skm=pelajaran_skm($rpel['replid']);
	$doc->cell($no++,40);
	$doc->cell($rpel['nama'],'244#','l',2,1);
	$doc->cell(number_format($nilai,2),80);
	$doc->cell(number_format($skm,2),80);
	$doc->cell($nilai<$skm?'Tidak tuntas':'Tuntas',120);
	$jmlnilai+=$nilai;
}
$rata=$jmlnilai/($no-1);
$doc->nl();
	$doc->cell('<b>Jumlah Nilai</b>',0,'',3); $doc->cell('<b>'.$jmlnilai.'</b>'.'[x:fmla="=SUM(D8:D10)" x:num]','c');
	$doc->cell('',0,'',2);
$doc->nl();
	$doc->cell('<b>Rata-Rata Nilai</b>',0,'',3); $doc->cell('<b>'.number_format($rata,2).'</b>'.'[x:fmla="=AVERAGE(D8:D10)" x:num="'.number_format($rata,2).'"]',0,'c',1,1,-1,'','mso-number-format:\'0\.00_ \'');
	$doc->cell('',0,'',2);
$doc->nl();
	$doc->cell('<b>Peringkat</b>',0,'',3); $doc->cell(rapor_peringkatkelas_siswa($kls,$siswa['replid']).' dari '.kelas_jumlahsiswa($kls).' siswa',0,'',3);

$doc->row_blank(6);

$komen=dbSFA("*","aka_komenrapor","W/ siswa='".$siswa['replid']."' AND tahunajaran='$tajar'");
$doc->cell_format_reset();
$doc->nl();
	$doc->cell('Keterangan hasil belajar:',0,'',6);
$doc->nl(100,'top');
	$doc->cell($komen['komen'],0,'',6,1,1);
	*/
$doc->end(); ?>