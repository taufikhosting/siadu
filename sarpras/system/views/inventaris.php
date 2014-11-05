<?php
$fmod='inventaris';
$xtable=new xtable($fmod,'Grup barang');

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

// Query
$db=new xdb("sar_grup","","lokasi='$lok'");
$t=$xtable->use_db($db,$xtable->pageorder_sql('kode','nama'));

$xtable->btnbar_begin();
	$xtable->btnbar_add();
	echo '<button class="btn" style="float:left;margin-right:4px" onclick="E(\'pageprinter\').submit()"><div class="bi_pri">Cetak</div></button>';
 // $xtable->btnbar_print();	
 echo '<div class="sfont" style="float:right;margin-top:4px">Total aset: '.fRp(lokasi_aset($lok)).'</div>';
$xtable->btnbar_end();

if($xtable->ndata>0){
	// Table head
	$xtable->head('@kode','@nama Grup barang','Jumlah unit~C','Unit tersedia~C','Unit dipinjam~C','Total aset~R','Keterangan');
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
		$xtable->opt($r['replid'],'v','u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>