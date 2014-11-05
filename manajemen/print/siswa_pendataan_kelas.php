<?php //appmod_use('aka/siswa','aka/kelas','aka/pelajaran','aka/rapor');
// cell($a,$w=0,$c=1,$r=1,$al='',$b=-1,$bg='',$s='',$atr='')
$token=gets('token');

$token=doc_decrypt($token);

$doc=new doc();
$doc->dochead("Data Siswa Kelas ".gets('kelas'),5);
$doc->nl();
$doc->cell("Tahun Ajaran ".gets('tahunajaran'),0,'c',5,1);
$doc->row_blank(5);

$t=dbQSql($token);
$no=1;
$doc->head('No{C}','@!NIS','@!NISN','@nama','Tempat Tanggal lahir');

while($r=dbFA($t)){
$doc->nl();
$doc->cell($no++,40,'c');
$doc->cell($r['nis'],50);
$doc->cell($r['nisn'],80);
$doc->cell($r['nama'],0);
$doc->cell($r['tmplahir'].', '.fftgl($r['tgllahir']),170);
}

$doc->end(); ?>