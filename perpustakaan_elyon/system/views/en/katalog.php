<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$fmod='katalog';
$xtable = new xtable($fmod,'Catalog');
$xtable->keyons=array('judul'=>'title','kode'=>'classification code','pengarang'=>'author','penerbit'=>'publisher');

hiddenval('opf','kat');

if($opt=='af'||$opt=='uf') require_once(VWDIR.'en/katalog_form.php');
else{
// Query
$f=dbTF('pus_katalog:replid,judul,klasifikasi,pengarang,penerbit','pus_klasifikasi:kode as n1,kode','pus_pengarang:nama as n2','pus_penerbit:nama as n3');
$j=dbLJoin('pus_katalog','klasifikasi','pus_klasifikasi','replid');
$j.=dbLJoin('pus_katalog','pengarang','pus_pengarang','replid');
$j.=dbLJoin('pus_katalog','penerbit','pus_penerbit','replid');
$xtable->search_sql_set(array('judul'=>"pus_katalog.judul:LIKE",
			  'kode'=>"pus_klasifikasi.kode:=",
			  'pengarang'=>"pus_pengarang.nama:LIKE",
			  'penerbit'=>"pus_penerbit.nama:LIKE"));

$sql="SELECT ".$f." FROM pus_katalog ".$j." ".$xtable->search_sql_get();
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('judul','n1','n2','n3'));

$xtable->btnbar_begin();
	$xtable->btnbar_add();
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
// Table head
	$xtable->head('@Title','@Classification','@Author','@Publisher');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['judul'],0,'','judul');
		$xtable->td(klasifikasi_name($r['klasifikasi']),200,'','kode');
		$xtable->td($r['n2'],120,'','pengarang');
		$xtable->td($r['n3'],120,'','penerbit');
		$s='<button class="btn" title="Add new item" onclick="PCBCODE=201;katalog_form_view(\''.$r['replid'].'\')"><div class="bi_add">Item</div></button>~60';
		$xtable->opt($r['replid'],'v','u','d',$s);
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata(); }
}
?>