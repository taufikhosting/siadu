<?php 

appmod_use('keu/rekening');
$fmod='rekening';
$xtable=new xtable($fmod,'kode rekening');
$xtable->pageorder="kode";

$kat=gpost('skategorirek');
$kategorirek=kategorirek_r($kat,1);

// Page Selection Bar
$PSBar = new PSBar_2(120);
$PSBar->begin();
	$PSBar->selection('Kategori rekening',iSelect('skategorirek',$kategorirek,$kat,$PSBar->selws,$fmod."_get()"));
$PSBar->end();

// Query
$db=new xdb("keu_rekening");
if($kat!==0)$db->where("kategorirek='$kat'");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('kode','nama'));

$xtable->btnbar_f('add');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Kode{C}','@Rekening','Keterangan');
	
	$lkat=0;
	while($r=mysql_fetch_array($t)){
		$kr=substr($r['kode'],0,1);
		if($lkat!=$r['kategorirek'] && $kat==0){
			$l=strlen($r['kode'])-1;
			$xtable->row_begin();
				$xtable->td('<b>'.sprintf($kr."%0".$l."d",0).'</b>',100,'c');
				$xtable->td('<b>'.kategorirek_name($r['kategorirek']).'</b>',250);
				$xtable->td(); 
				$xtable->td();
		}
		$xtable->row_begin();
		$xtable->td($r['kode'],100,'c');
		$xtable->td($r['nama'],250);
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt_ud($r['replid']);
		
		$lkat=$r['kategorirek'];
	}$xtable->foot();
}else{
	$xtable->nodata('',$kat==0?"":"pada kategori rekening ".strtolower($kategorirek[$kat]));
}
?>