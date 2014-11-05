<?php require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'control.php');
$SOUF=stocktake_unfinished();
$fmod='katalog_buku_daftar';
$xtable=new xtable($fmod,'koleksi');
if($SOUF==0)$xtable->use_select();
$xtable->search_keyon('barkode=>pus_buku.barkode:EQ-1');
$xtable->pageorder="pus_buku.barkode";
if($SOUF!=0)$xtable->noopt=true;

$kat=gpost('katalog',0);
$lok=gpost('lokasi');
$lokasi=lokasi_r($lokasi,1);

$db=new xdb("pus_buku");
$db->field("pus_buku.*","pus_lokasi:nama as nlokasi","pus_tingkatbuku:nama as ntingkat");
$db->join("lokasi","pus_lokasi");
$db->join("tingkatbuku","pus_tingkatbuku");
$db->where("pus_buku.katalog='$kat'");
$db->where_and($xtable->search_sql_get());
if($lok!=0) $db->where_and("pus_buku.lokasi='$lok'");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('pus_buku.barkode','pus_buku.callnumber','pus_buku.sumber','pus_buku.harga','pus_buku.tanggal','pus_buku.status','nlokasi','ntingkat'));

// Page Selection Bar
$PSBar = new PSBar_2(100);
$PSBar->begin();
	if(count($lokasi)>0){
		$PSBar->selection('Lokasi',iSelect('lokasi',$lokasi,$lok,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('lokasi',$lok);
		lokasi_warn(0,'float:left');
		$PSBar->pass=false;
	}
$PSBar->end();

$xtable->btnbar_begin();
	if($SOUF==0) $xtable->btnbar_add();
	$xtable->search_box('Cari barkode');
$xtable->btnbar_end();

$xtable->search_info('data buku dengan barkode "<b>{keyw}</b>"'.($lok==0?'':' pada lokasi '.preg_replace("/\[[^\[\]]+\]/","",$lokasi[$lok])).'.');

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Barkode','@Callnumber','@sumber','@harga~R','@Tanggal diperoleh','@Status','@lokasi','@tingkat');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
				
		$xtable->td($r['barkode']);
		$xtable->td($r['callnumber'],120);
		$xtable->td($r['sumber']==0?'Beli':'Pemberian',100);
		$xtable->td($r['satuan'].' '.$r['harga'],80,'r');
		$xtable->td(fftgl($r['tanggal']),120);
		$xtable->td($r['status']==1?'Tersedia':'Dipinjam',100);
		$xtable->td($r['nlokasi'],150);		
		$xtable->td($r['ntingkat'],120);		
		if($SOUF==0) $xtable->opt_ud($r['replid']);
		
	}$xtable->foot();
}else{$xtable->nodata('','pada lokasi ini');}

?>