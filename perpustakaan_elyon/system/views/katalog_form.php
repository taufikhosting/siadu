<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$fmod='katalog';
$xform=new xform($fmod,$opt,$cid);

$klasifikasi=klasifikasi_opt();
$pengarang=pengarang_opt();
$penerbit=penerbit_opt();
$bahasa=bahasa_opt();
$jenisbuku=jenisbuku_opt();

$opf=gpost('opf');
hiddenval('opf',$opf);

if($opt=='uf'){ // Nilai field editan
	$t=mysql_query("SELECT * FROM pus_katalog WHERE replid='$cid' LIMIT 0,1");
	$data=mysql_fetch_array($t);
	$ttl='Edit';
}
else { // Nilai field default
	$data=farray('replid','judul','klasifikasi-kode','klasifikasi','pengarang','penerbit','isbn','issn','penerjemah','tahunterbit','editor','photo','kota','volume','seri','bahasa','jenisbuku','deskripsi');
	$data['halaman']=1;
	$ttl='Tambah';
}

$xform->title($ttl.' katalog buku');
$xform->table_begin();
	$xform->col_begin('50%'); // Kolom kiri lebar 50%
	$xform->set_fieldw(280);
	$xform->group_begin('Informasi Katalog Buku'); // Grup field
		$a=explode("`",$data['judul']);
		$xform->fi('Judul',iText('judul1',$a[0],$xform->fieldws));
		$xform->fi('',iText('judul2',$a[1],$xform->fieldws));
		
		$s=iText('klasifikasi-kode',$data['klasifikasi-kode'],'float:left;margin-right:4px;width:60px');
		$s.=iSelect('klasifikasi',$klasifikasi,$data['klasifikasi'],'float:left;margin-right:4px;width:180px','katalog_klasifikasi_sel()');
		$s.='<button title="Klasifikasi baru..." class="btn" style="float:left;margin-right:4px" onclick="katalog_klasifikasi_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Klasifikasi',$s);
		
		$s=iSelect('pengarang',$pengarang,$data['pengarang'],'float:left;margin-right:4px;width:244px');
		$s.='<button title="Pengarang baru..." class="btn" style="float:left;margin-right:4px" onclick="katalog_pengarang_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Pengarang',$s);
		
		$xform->fi('Penerjemah',iText('penerjemah',$data['penerjemah'],$xform->fieldws));
		$xform->fi('Editor',iText('editor',$data['editor'],$xform->fieldws));
		
		$s=iSelect('penerbit',$penerbit,$data['penerjemah'],'float:left;margin-right:4px;width:244px');
		$s.='<button title="Penerbit baru..." class="btn" style="float:left;margin-right:4px" onclick="katalog_penerbit_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Penerbit',$s);
		
		$tahun=array(); $thn=intval(date("Y"))+5;
		for($th=$thn;$th>=1980;$th--) $tahun[$th]=$th;
		
		$xform->fi('Tahun terbit',iSelect('tahunterbit',$tahun,$data['tahunterbit']));
		$xform->fi('Kota',iText('kota',$data['kota'],'width:100px'));
		
		$xform->fi('ISBN',iText('isbn',$data['isbn'],$xform->fieldws));
		$xform->fi('ISSN',iText('issn',$data['issn'],$xform->fieldws));
		
		$s=iSelect('bahasa',$bahasa,$data['bahasa'],'float:left;margin-right:4px;width:244px');
		$s.='<button title="Bahasa baru..." class="btn" style="float:left;margin-right:4px" onclick="katalog_bahasa_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Bahasa',$s);
		
		$xform->fi('Seri buku',iText('seri',$data['seri'],$xform->fieldws));
		$xform->fi('Volume',iText('volume',$data['volume'],$xform->fieldws));
		$xform->fi('Edisi',iText('edisi',$data['edisi'],$xform->fieldws));
		
		$s=iSelect('jenisbuku',$jenisbuku,$data['jenisbuku'],'float:left;margin-right:4px;width:244px','katalog_jenisbuku_sel()');
		$s.='<button title="Jenisbuku baru..." class="btn" style="float:left;margin-right:4px" onclick="katalog_jenisbuku_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Jenis buku',$s);
		
	$xform->col_begin('50%'); // Kolom kanan lebar 50%
	$xform->group_begin('Gambar Sampul Buku');
		$xform->fphoto($data['replid'],'katalog',100,140);
		
	$xform->group_begin('Deskripsi Buku');
		$xform->fi('Jumlah halaman',iText('halaman',$data['halaman'],'width:40px').' <span style="margin-top:4px">&nbsp;halaman</span>');
		$xform->fi('Sinopsis',iTextArea('deskripsi',$data['deskripsi'],$xform->fieldws,5));

if($opf=='kat'){
	//if($xform->opt=='uf') $xform->back_act='katalog_form_view('.$cid.')';
	$xform->back_act='katalog_get()';
} else if($opf=='buk'){
	//if($xform->opt=='df') $xform->back_act='katalog_get()';
	$xform->back_act='katalog_form_view('.$cid.')';
}
$xform->table_end();
?>