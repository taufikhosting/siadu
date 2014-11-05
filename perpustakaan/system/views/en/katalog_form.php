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
	$ttl='Add New';
}

$xform->title($ttl.' Catalog');
$xform->table_begin();
	$xform->col_begin('50%'); // Kolom kiri lebar 50%
	$xform->set_fieldw(280);
	$xform->group_begin('Catalog Information'); // Grup field
		$xform->fi('Title',iText('judul',$data['judul'],$xform->fieldws));
		
		$s=iText('klasifikasi-kode',$data['klasifikasi-kode'],'float:left;margin-right:4px;width:60px');
		$s.=iSelect('klasifikasi',$klasifikasi,$data['klasifikasi'],'float:left;margin-right:4px;width:180px','katalog_klasifikasi_sel()');
		$s.='<button title="Add new classification..." class="btn" style="float:left;margin-right:4px" onclick="katalog_klasifikasi_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Classification',$s);
		
		$s=iSelect('pengarang',$pengarang,$data['pengarang'],'float:left;margin-right:4px;width:244px');
		$s.='<button title="Add new author..." class="btn" style="float:left;margin-right:4px" onclick="katalog_pengarang_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Author',$s);
		
		$xform->fi('Translator',iText('penerjemah',$data['penerjemah'],$xform->fieldws));
		$xform->fi('Editor',iText('editor',$data['editor'],$xform->fieldws));
		
		$s=iSelect('penerbit',$penerbit,$data['penerjemah'],'float:left;margin-right:4px;width:244px');
		$s.='<button title="Add new publisher..." class="btn" style="float:left;margin-right:4px" onclick="katalog_penerbit_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Publisher',$s);
		
		$xform->fi('Year terbit',iText('tahunterbit',$data['tahunterbit'],'width:60px'));
		$xform->fi('City',iText('kota',$data['kota'],$xform->fieldws));
		
		$xform->fi('ISBN',iText('isbn',$data['isbn'],$xform->fieldws));
		$xform->fi('ISSN',iText('issn',$data['issn'],$xform->fieldws));
		
		$s=iSelect('bahasa',$bahasa,'','float:left;margin-right:4px;width:244px');
		$s.='<button title="Add new language..." class="btn" style="float:left;margin-right:4px" onclick="katalog_bahasa_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Language',$s);
		
		$xform->fi('Series',iText('seri',$data['seri'],$xform->fieldws));
		$xform->fi('Volume',iText('volume',$data['volume'],$xform->fieldws));
		$xform->fi('Edition',iText('edisi',$data['edisi'],$xform->fieldws));
		
		$s=iSelect('jenisbuku',$jenisbuku,$data['jenisbuku'],'float:left;margin-right:4px;width:244px','katalog_jenisbuku_sel()');
		$s.='<button title="Add new type..." class="btn" style="float:left;margin-right:4px" onclick="katalog_jenisbuku_form(\'af\')"><div class="bi_addb">&nbsp;</div></button>';
		$xform->fi('Type',$s);
		
	$xform->col_begin('50%'); // Kolom kanan lebar 50%
	$xform->group_begin('Cover Image');
		$xform->fphoto($data['replid'],'katalog',100,140);
		
	$xform->group_begin('Description');
		$xform->fi('Number of page',iText('halaman',$data['halaman'],'width:40px').' <span style="margin-top:4px">&nbsp;page(s)</span>');
		$xform->fi('Synopsis',iTextArea('deskripsi',$data['deskripsi'],$xform->fieldws,5));

if($opf=='kat'){
	//if($xform->opt=='uf') $xform->back_act='katalog_form_view('.$cid.')';
	$xform->back_act='katalog_get()';
} else if($opf=='buk'){
	//if($xform->opt=='df') $xform->back_act='katalog_get()';
	$xform->back_act='katalog_form_view('.$cid.')';
}
$xform->table_end();
?>