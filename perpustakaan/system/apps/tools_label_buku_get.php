<?php $ssid=session_id(); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'control.php');
$fmod='tools_label_buku';
$xtable = new xtable($fmod,'Item');
$xtable->pageorder='pus_tpjm.replid DESC';

// Query
$db=new xdb("pus_tpjm");
$db->field('pus_tpjm:*','pus_buku:barkode,idbuku','pus_katalog:judul,callnumber');
$db->join('buku','pus_buku');
$db->joinother('pus_buku','katalog','pus_katalog','replid');
$db->where("ssid='$ssid'");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

echo '<div style="float:none !important;max-height:300px;overflow:auto">';
if($xtable->ndata>0){
	// Table head
	$xtable->head('Barkode','Callnumber','Judul','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		//$xtable->td('<button class="btn" onclick="peminjaman_baliktabelpinjam('.$r['barang'].')" title="Hapus dari daftar barang yang dipinjam."><div class="bi_canb">&nbsp</div></button>',30,'c');
		$xtable->td($r['barkode'],100);
		$xtable->td($r['callnumber'],80);
		$xtable->td(buku_judul($r['judul']));
		$s='<button class="btn" onclick="'.$fmod.'_form(\'d\','.$r['replid'].',false)" title="Keluarkan dari daftar"><div class="bi_canb">&nbsp;</div></button>~40';
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
}else{
	$xtable->nodata_cust('<span style="color:'.CLGREY.'"><i>Belum ada item yang dipilih.</i></span>');
}
echo '</div>';
if($xtable->ndata>0){
	echo '<div class="sfont" style="margin-top:10px;height:24px;width:100%">'.$xtable->ndata.' item</div>';
}
?>