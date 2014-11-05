<?php appmod_use('aka/siswa','aka/kelas','aka/pelajaran','aka/rapor');
// cell($a,$w=0,$al='',$c=1,$r=1,$b=-1,$bg='',$s='',$atr='')
$token=gets('token');

$db=siswa_db_byID($token,'nisn,kelamin,tmplahir,tgllahir,alamat,telpon');
$db->field("mst_agama.agama as nagama");
$db->joinother("aka_siswa","agama","mst_agama");
$t=$db->query();
$siswa=dbFA($t);

$doc=new doc(1);
$doc->dochead("DATA SISWA",4);

$doc->nl();
$doc->cell('<b>'.strtoupper($siswa['nama']).'</b>',0,'',4,1,'b');

$doc->nl(5);
$doc->cell('',0,'',3);

$lw=120;

$doc->nl();
$doc->cell('Departemen',$lw,'');
$doc->cell(': '.$siswa['ndepartemen'],0,'',2);

$img='<img src="photo/siswa.php?id='.$siswa['replid'].'" width="120px" />';

$doc->cell($img,200,'r',1,10);
$doc->nl();
$doc->cell('NIS',$lw,'');
$doc->cell(': '.$siswa['nis'],0,'',2);
$doc->nl();
$doc->cell('NISN',$lw,'');
$doc->cell(': '.$siswa['nisn'],0,'',2);

$doc->nl();
$doc->cell('',0,'',3);

$doc->nl();
$doc->cell('<b>Data Pribadi Siswa:</b>',0,'',3);
$doc->nl();
$doc->cell('Nama lengkap',$lw);
$doc->cell(': '.$siswa['nama'],0,'',2);
$doc->nl();
$doc->cell('Jenis kelamin',$lw);
$doc->cell(': '.$siswa['kelamin'],0,'',2);
$doc->nl();
$doc->cell('Tempat lahir',$lw);
$doc->cell(': '.$siswa['tmplahir'],0,'',2);
$doc->nl();
$doc->cell('Tanggal lahir',$lw);
$doc->cell(': '.fftgl($siswa['tgllahir']),0,'',2);
$doc->nl();
$doc->cell('Agama',$lw);
$doc->cell(': '.$siswa['nagama'],0,'',2);
$doc->nl();
$doc->cell('Alamat rumah',$lw);
$doc->cell(': '.$siswa['alamat'],0,'',3);
$doc->nl();
$doc->cell('Telepon rumah',$lw);
$doc->cell(': '.$siswa['telpon'],0,'',3);

$doc->nl();
$doc->cell('',0,'',2);
$doc->cell('',80,'',1);
$doc->cell('',0,'',1);

$doc->nl();
$doc->cell('<b>Kesehatan Siswa:</b>',0,'',4);
$doc->nl();
$doc->cell('Golongan darah',$lw);
$doc->cell(': '.$siswa['darah'],0,'',3);
$doc->nl();
$doc->cell('Penyakit yang diderita',100);
$doc->cell(': '.$siswa['kesehatan'],0,'',3);
$doc->nl();
$doc->cell('Alergi terhadap',$lw);
$doc->cell(': '.$siswa['ketkesehatan'],0,'',3);

$doc->nl();
$doc->cell('',0,'',4);

$t=mysql_query("SELECT * FROM aka_siswa_ayah WHERE siswa='$cid'");
		$ayah=mysql_fetch_array($t);
		$t=mysql_query("SELECT * FROM aka_siswa_ibu WHERE siswa='$cid'");
		$ibu=mysql_fetch_array($t);

$doc->nl();
$doc->cell('<b>Data orang tua siswa:</b>',0,'',4);
$doc->nl();
$doc->cell('',$lw);
$doc->cell('<b>Ayah</b>');
$doc->cell('<b>Ibu</b>',250,'',2);
$doc->nl();
$doc->cell('Nama',$lw);
$doc->cell(': '.$ayah['nama']);
$doc->cell($ibu['nama'],0,'',2);
$doc->nl();
$doc->cell('Kebangsaan',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('Tempat lahir',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('Tanggal lahir',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('Pekerjaan',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('No telepon',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('PIN BB',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);
$doc->nl();
$doc->cell('Email',$lw);
$doc->cell(':'.$siswa['telpon']);
$doc->cell($siswa['telpon'],0,'',2);

$doc->end(); ?>