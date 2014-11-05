<?php
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$fmod='katalog';

hiddenval('opf','kat');

if($opt=='af'||$opt=='uf') require_once(VWDIR.'katalog_form.php');
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
			  'kode(kode klasifikasi)=>pus_klasifikasi.kode:EQ-1',
			  'pengarang(nama pengarang)=>pus_pengarang.nama:LIKE-2',
			  'penerbit(nama penerbit)=>pus_penerbit.nama:LIKE-3');
$xtable->pageorder="pus_katalog.judul";
// Query			  
$db=new xdb("pus_katalog");
$db->field("pus_katalog:replid,judul,klasifikasi,pengarang,penerbit","pus_klasifikasi:kode as n1,kode","pus_pengarang:nama as n2","pus_penerbit:nama as n3","COUNT(pus_buku.replid) as buku_count");
$db->join("replid","pus_buku","katalog");
$db->join("klasifikasi","pus_klasifikasi");
$db->join("pengarang","pus_pengarang");
$db->join("penerbit","pus_penerbit");
$db->where($xtable->search_sql_get());
$db->group("pus_katalog.replid");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('judul','n1','n2','n3','buku_count'));

$SOUF=stocktake_unfinished();

$xtable->btnbar_begin();
	if($SOUF==0) $xtable->btnbar_add();
	else echo '<div class="warnbox">Perubahan katalog tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
	
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
// Table head
	$xtable->head('@Judul','@Klasifikasi','@Pengarang','@Penerbit','@Jumlah koleksi{R,100px}',($SOUF==0?'':'{40px}'));
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td(buku_judul($r['judul']));
		$xtable->td(klasifikasi_name($r['klasifikasi']),200);
		$xtable->td($r['n2'],120);
		$xtable->td($r['n3'],120);
		$xtable->td($r['buku_count'],100,'r');
		if($SOUF==0){
			$s='<button class="btn" title="Tambah buku baru" onclick="PCBCODE=201;katalog_form_view(\''.$r['replid'].'\')"><div class="bi_add">Buku</div></button>~60';
			$xtable->opt($r['replid'],'v','u','d',$s);
		} else {
			$xtable->opt($r['replid'],'v');
		}
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata(); }
}
?>