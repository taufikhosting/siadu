<?php appmod_use('sar');
$spage=gpost('spage');
if($spage=='katalog'){
require_once(VWDIR.'inventory_katalog.php');
} else if($spage=='katalog_unit'){
require_once(VWDIR.'inventory_katalog_unit.php');
} else {
$fmod='inventaris';

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);

$PSBar = new PSBar_2(); // Page selection bar
$PSBar->begin();
	if(count($lokasi)>0){
		$PSBar->selection('lokasi',iSelect('lokasi',$lokasi,$lok,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('lokasi',$lok);
		lokasi_warn();
		exit();
	}
$PSBar->end();

// xtable Query
$xtable=new xtable($fmod,'Grup barang');
$db=new xdb("sar_grup","","lokasi='$lok'");
$t=$xtable->use_db($db,$xtable->pageorder_sql('kode','nama'));

$xtable->btnbar_begin();
	//$xtable->btnbar_add();
	echo '<div class="sfont" style="float:right;margin-top:4px">Total aset: '.fRp(lokasi_aset($lok)).'</div>';
$xtable->btnbar_end();

if($xtable->ndata>0){
	// Table head
	$xtable->head('@kode','@nama Grup barang','Jumlah unit~C','Unit tersedia~C','Unit dipinjam~C','Total aset~R','Keterangan','{40px}');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		$n=mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE grup='".$r['replid']."'"));
		
		$xtable->td($r['kode'],100);
		$xtable->td($r['nama'],200);
		$xtable->td($n,100,'c');
		$xtable->td(0,100,'c');
		$xtable->td(0,100,'c');
		$xtable->td(fRp(grup_aset($r['replid'])),120,'r');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt($r['replid'],'v');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
}
?>