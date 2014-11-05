<?php require_once(MODDIR.'control.php'); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'apps/aka.php');
$fmod='peminjaman_buku_get_cari';
$xtable=new xtable($fmod);

$keyw=gpost('pskeyword');

$lok=gpost('pslokasi');
$lokasi=lokasi_r($lok);

$PSBar = new PSBar_2(100);
$PSBar->begin();
	
	if(count($lokasi)>0){
		$PSBar->selection('Lokasi',iSelect('pslokasi',$lokasi,$lok,$PSBar->selws,"peminjaman_buku_get_cari(1)"));
	} else {
		$PSBar->end();
		hiddenval('pslokasi',$lok);
		lokasi_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	//$PSBar->selection('Cari item',iTextSrc('pskeyword',$keyw,'float:left~width:250px','barkode atau judul item...',"peminjaman_buku_get_cari(1)"));
	
$PSBar->end();
if($PSBar->pass){

$xtable->btnbar_begin();
	echo iTextSrc('pskeyword',$keyw,'float:left~width:250px','cari barkode atau judul item...',"peminjaman_buku_get_cari(1)",'onkeyup="peminjaman_buku_get_cari_do(event)"');
$xtable->btnbar_end();

if($keyw!=''){

$t=mysql_query("SELECT pus_buku.*,pus_katalog.judul FROM pus_buku LEFT JOIN pus_katalog ON pus_katalog.replid=pus_buku.katalog WHERE pus_buku.lokasi='$lok' AND pus_buku.status='1' ".($keyw==""?"":" AND (pus_katalog.judul LIKE '%$keyw%' OR pus_buku.barkode='$keyw') ")." ORDER BY pus_buku.barkode,pus_katalog.judul");
$xtable->ndata=mysql_num_rows($t);

$xtable->search_info($keyw,'Hasil pencarian item dengan barkode atau judul  "<b>'.$keyw.'</b>".',"E('pskeyword').value='';siswakelas_get_cari(1)");

if($xtable->ndata>0){
	//$xtable->optw='50px';
	$xtable->head('<input id="pscekt" type="checkbox" onclick="peminjaman_buku_get_cekall(this.checked)" />~C','Barkode','Callnumber','Judul');
	$n=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();

		$s='<input id="pscek'.($n).'" value="'.$r['replid'].'" type="checkbox" onclick="peminjaman_buku_get_cek('.($n).',this.checked)" />';
		$xtable->td($s,20,'c');
		$xtable->td(srcrep($keyw,$r['barkode']),100);
		//$xtable->td($r['idbuku'],120);
		$xtable->td($r['callnumber'],80);
		$xtable->td(srcrep($keyw,buku_judul($r['judul'])));
		
		if(admin_isoperator()) $s='<button class="btn" onclick="peminjaman_buku_get_pilih_id('.($n++).')">Pilih</button>~40px';
		else $s='<div style="height:23px;width:40px"></div>';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
	hiddenval('psceknum',$n);
} else { $xtable->nodata_cust('Tidak data item dengan barkode atau judul <b>'.$keyw.'</b> di lokasi ini.'); }
} else {
	$xtable->nodata_cust('<span style="color:'.CLGREY.'"><i>Masukkan barkode atau judul item.</i></span>');
} }
?>