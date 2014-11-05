<?php
require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$tbl=stocktake_ctable();
$tamp=gpost('tampil'); if($tamp=='')$tamp=0;

$fmod='stocktake_note';
$xtable = new xtable($fmod,'Buku');
$xtable->pageorder=$tbl.".cek, pus_buku.barkode";
stocktake_ptrack(3);
// Query
if($tamp==0){
	$f=" WHERE ".$tbl.".cek='N'";
} else if($tamp==1){
	$f=" WHERE ".$tbl.".cek='Y'";
} else {
	$f="";
}
if($keyw!=""){
	if($f=="")$f=" WHERE josh.pus_buku.barkode='$keyw' OR josh.pus_katalog.judul LIKE '%$keyw%'";
	else $f.=" AND ( josh.pus_buku.barkode='$keyw' OR josh.pus_katalog.judul LIKE '%$keyw%' )";
}
$sql="SELECT ".$tbl.".*,josh.pus_buku.barkode,josh.pus_katalog.judul FROM ".$tbl." LEFT JOIN josh.pus_buku ON josh.pus_buku.replid=".$tbl.".buku LEFT JOIN josh.pus_katalog ON josh.pus_katalog.replid=josh.pus_buku.katalog".$f;
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('pus_buku.barkode','pus_katalog.judul',$tbl.'.cek'));

//echo $sql.$xtable->pageorder_sql('pus_buku.barkode','pus_buku.judul',$tbl.'.cek');

/*
// Page Selection Bar
$PSBar = new PSBar_2(100);
$PSBar->begin();
	$PSBar->selection('Tampilkan',iSelect('tampilx',array(0=>'item belum dicek',1=>'item sudah dicek',2=>'semua item'),$tamp,$PSBar->selws,$fmod."_get()"));
$PSBar->end();
*/

echo '<div style="width:100%;float:left;height:20px"></div>';
$xtable->btnbar_begin();
	echo '<div class="sfont" style="float:left;width:80px;margin-top:4px;margin-right:4px"><b>Tampilkan:</b></div>';
	echo iSelect('tampil',array(0=>'item belum dicek',1=>'item sudah dicek',2=>'semua item'),$tamp,'float:left;margin-right:4px',$fmod."_get()");
	//echo '<button class="btnz" style="float:left;margin-right:4px" onclick="stocktake_note()">Selesai</button>';
	echo '<button title="Muat ulang." class="btn" style="float:left;margin-right:4px" onclick="stocktake_note()"><div class="bi_relb">&nbsp</div></button>';
	//$xtable->btnbar_add();
	$xtable->search_box('','barkode atau judul buku');
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
// Table head
	$n=0;
	$xtable->head('@Barkode','@Judul','@Cek~C','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['barkode'],120);
		$xtable->td(buku_judul($r['judul']),300);
		$xtable->td($r['cek'],50,'c');
		//td($a,$b='*',$c='',$k='',$atr=''){
		//td($a,$b='*',$c='',$atr=''){
		$xtable->td(nl2br($r['note']),'*','','id="cttn'.$r['replid'].'"');
		$s='<button class="btn" title="Edit catatan." onclick="stocktake_note_form(\'uf\','.$r['replid'].')"><div class="bi_edit">Catatan</div></button>~80';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end(); $n++;} $xtable->foot();
} else {
	if($tamp==0){
		$f=" yang belum dicek";
	} else if($tamp==1){
		$f=" yang sudah dicek";
	} else {
		$f="";
	}
	$xtable->nodata_cust('Tidak ada data item'.$f.'.');
}

$xtable->btnbar_begin();
	echo '<div style="width:100%;float:left;text-align:center;margin-top:20px">';
	echo '<button class="btn" style="margin-right:4px" onclick="stocktake_note_done(\'df\')">Kembali</button>';
	echo '<button class="btnz" style="" onclick="stocktake_note_done(\'af\')">Selesai</button>';
	echo '</div>';
$xtable->btnbar_end();
?>