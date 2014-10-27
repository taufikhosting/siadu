<?php
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$fmod='katalog';
$katalog_view=gpost('katalog_view','list');
hiddenval('katalog_view',$katalog_view);

hiddenval('opf','kat');

if($opt=='af'||$opt=='uf'){
	require_once(VWDIR.'katalog_form.php');
}
else{
/*
   SELECT katalog.*, 
          COUNT(post_id) AS post_count
     FROM katalog 
LEFT JOIN blogger_posts ON katalog.blogger_id = blogger_posts.blogger_id
    WHERE katalog.AUX = 3
 GROUP BY katalog.blogger_id
 ORDER BY post_count
*/
$xtable = new xtable($fmod,'katalog');
$xtable->search_keyon('judul=>pus_katalog.judul-0',
			  'isbn(barcode)=>pus_buku.barkode-1',
			  'kode(kode klasifikasi)=>pus_klasifikasi.kode:EQ-2',
			  'pengarang(nama pengarang)=>pus_pengarang.nama:LIKE-3',
			  'penerbit(nama penerbit)=>pus_penerbit.nama:LIKE-4');
$xtable->pageorder="pus_katalog.judul";
$xtable->rpp=$katalog_view=='list'?$xtable->rpp:21;
// Query			  
$db=new xdb("pus_katalog");
$db->field("pus_katalog:replid,judul,klasifikasi,pengarang,penerbit,kota,tahunterbit,halaman,isbn,deskripsi,callnumber","pus_klasifikasi:kode as n1,kode","pus_pengarang:nama as n2,nama2 as nkutip","pus_penerbit:nama as n3","COUNT(pus_buku.replid) as buku_count");
$db->join("replid","pus_buku","katalog");
$db->join("klasifikasi","pus_klasifikasi");
$db->join("pengarang","pus_pengarang");
$db->join("penerbit","pus_penerbit");
$db->where($xtable->search_sql_get());
$db->group("pus_katalog.replid");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('judul','n1','n2','n3','callnumber','buku_count'));

$SOUF=stocktake_unfinished();

$xtable->btnbar_begin();
	if($SOUF==0) $xtable->btnbar_add();
	else echo '<div class="warnbox">Perubahan katalog tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
	
	
	if($katalog_view=='detil'){
		echo '<button title="Tampilan daftar" class="btn" style="float:left;margin-right:4px" onclick="E(\'katalog_view\').value=\'list\';katalog_get()"><div class="bi_lis">Daftar</div></button>';
	} else {
		echo '<button title="Tampilan detil" class="btn" style="float:left;margin-right:4px" onclick="E(\'katalog_view\').value=\'detil\';katalog_get()"><div class="bi_thumb">Detil</div></button>';
	}
	
	$xtable->btnbar_print();
	
	$xtable->search_box();
$xtable->btnbar_end();

$xtable->search_info();
$xtable->printable_info('KATALOG',5);

if($xtable->ndata>0){
// Table head
	require_once(VWDIR.'katalog_'.$katalog_view.'.php');
} else { $xtable->nodata(); }
}
?>