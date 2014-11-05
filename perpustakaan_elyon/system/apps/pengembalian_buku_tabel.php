<?php $ssid=session_id(); require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$mtipe=gpost('mtipe'); if($mtipe=='')$mtipe=0;

$fmod='peminjaman_buku';
$xtable = new xtable($fmod,'Item');
$xtable->optw='50px';

// Query
$db=new xdb("pus_peminjaman");
$db->field('pus_peminjaman:*','pus_buku:callnumber,barkode','pus_katalog:judul');
$db->join('buku','pus_buku');
$db->joinother('pus_buku','katalog','pus_katalog','replid');
$db->where("pus_peminjaman.member='$cid' AND pus_peminjaman.mtipe='$mtipe'");
$db->order("pus_peminjaman.status DESC");
//echo $db->getsql();
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

//$xtable->btnbar_begin();
//	echo '<button class="btn" title="Tambah item" onclick="'.$fmod.'_form(\'af\')"><div class="bi_add">Item</div></button>';
//$xtable->btnbar_end();

echo '<div style="float:none !important">';
if($xtable->ndata>0){
	// Table head
	$xtable->head('barkode','Callnumber','Judul','status','Dikembalikan Tgl');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		//$xtable->td('<button class="btn" onclick="peminjaman_baliktabelpinjam('.$r['barang'].')" title="Hapus dari daftar barang yang dipinjam."><div class="bi_canb">&nbsp</div></button>',30,'c');
		$xtable->td($r['barkode'],100);
		$xtable->td($r['callnumber'],120);
		$xtable->td(buku_judul($r['judul']));
		$xtable->td(($r['status']==1?'Belum dikembalikan':'Dikembalikan'),120);
		$xtable->td(fftgl($r['tanggal3']),120);
		if($r['status']==1){
		$s='<button class="btn" onclick="pengembalian_buku_form(\'uf\','.$r['replid'].')" title="Kembaliakan item ini."><div class="bi_inb">&nbsp;</div></button>~30';
		} else {
		$s='&nbsp;';
		}
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
}else{
	$xtable->nodata_cust('<span style="color:'.CLGREY.'"><i>Tidak ada data peminjaman.</i></span>');
}
echo '</div>';
?>