<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$fmod='katalog';
$xform=new xform($fmod,$opt,$cid);

$lok=gpost('lokasi');
$gru=gpost('grup');

hiddenval('lokasi',$lok);
hiddenval('grup',$gru);

$jenis=jenis_a();

$opf=gpost('opf');
hiddenval('opf',$opf);

if($opt=='uf'){ // Nilai field editan
	$t=mysql_query("SELECT `replid`,`grup`,`kode`,`nama`,`jenis`,`harga`,`susut`,`keterangan` FROM sar_katalog WHERE replid='$cid' LIMIT 0,1");
	$data=mysql_fetch_array($t);
	$ttl='Edit';
}
else { // Nilai field default
	$data=Array();
	$data['replid']=0;
	$data['harga']=0;
	$data['susut']=0;
	$ttl='Tambah';
}

$xform->title($ttl.' data barang baru');
$xform->table_begin();
	$xform->col_begin('50%'); // Kolom kiri lebar 50%
	$xform->group_begin('Informasi Barang'); // Grup field
		$xform->fl('Lokasi','['.lokasi_kode($lok).'] '.lokasi_name($lok));
		$xform->fl('Grup barang','['.grup_kode($gru).'] '.grup_name($gru));
		$xform->fi('Kode',iText('kode',$data,'width:50px'));
		$xform->fi('Nama barang',iText('nama',$data,$xform->fieldws));
		$xform->fi('Jenis',iSelect('jenis',$jenis,$data));
		$xform->fi('Penyusutan',iText('susut',$data,'width:40px').'<l>&nbsp;% per tahun</l>');
		$xform->fi('Keterangan',iTextarea('keterangan',$data,$xform->fieldws,5));
		
	$xform->col_begin('50%'); // Kolom kanan lebar 50%
	$xform->group_begin('Gambar Barang'); // Grup field
		$xform->fphoto($data['replid'],'katalog');

if($opf=='kat'){
	if($xform->opt=='uf') $xform->back_act='katalog_form_view('.$cid.')';
	else $xform->back_act='katalog_get()';
} else if($opf=='uni'){
	if($xform->opt=='df') $xform->back_act='katalog_get()';
	else $xform->back_act='katalog_form_view('.$cid.')';
}
$xform->table_end();
?>