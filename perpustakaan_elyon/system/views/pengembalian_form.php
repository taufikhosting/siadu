<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$ssid=session_id();
dbDel("pus_tpjm","ssid='$ssid'");

$member_id=gpost('member_id');
$member_tipe=gpost('member_tipe');

$fmod='peminjaman';
$xform=new xform($fmod,$opt,$cid);

if($opt=='uf'){ // Nilai field editan
	//$t=mysql_query("SELECT * FROM pus_katalog WHERE replid='$cid' LIMIT 0,1");
	//$data=mysql_fetch_array($t);
	$ttl='Edit';
}
else { // Nilai field default
	$data=farray();
	$ttl='Tambah';
	$data['tanggal1']=date("Y-m-d");
	$data['tanggal2']=date("Y-m-d",strtotime("+7 day"));
}

$xform->title($ttl.' data pengembalian');
$xform->table_begin();
	$xform->col_begin('450px');
	$xform->set_fieldw(340);
	$xform->group_begin('Data Peminjam');
		$s='<button title="Cari" class="btn" style="margin-right:4px" onclick="sirkulasi_member_add()"><div class="bi_srcb">&nbsp;</div></button>';
		$xform->fi('Peminjam',iText('smember','','width:250px;margin-right:4px','ID atau nama member','onkeyup="sirkulasi_member_cari(event)"').$s);
		hiddenval('member_id',0);
		hiddenval('member_tipe',0);
		hiddenval('sirkulasi_form',2);
	echo '<div id="datamember" class="xrowl" style="margin-top:10px">';
	require_once(APPDIR.'sirkulasi_datamember.php');
	echo '</div>';
	$xform->col_begin();
	$xform->set_fieldw(340);
	$xform->group_begin('Cari item yang akan dikembalikan');
		$s='<button title="Cari" class="btn" style="margin-right:4px" onclick="pengembalian_item_get()"><div class="bi_srcb">&nbsp;</div></button>';
		$xform->fi('Barkode item',iText('sbarkode','','width:250px;margin-right:4px','barkode','onkeyup="pengembalian_item_cari(event)"').$s);
		$xform->fi('','<div class="sfont" id="cariiteminfo" style="margin-top:2px">&nbsp;</div>');
		hiddenval('speminjaman',0);
		
$xform->table_end(0);
echo '<div id="data_pengembalian" style="display:none">';
$xform->table_begin();
	
	$xform->col_begin();
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Daftar Peminjaman',160); // Grup field
	echo '<div id="data_pengembalian_buku" style="width:800px;max-height:300px;height:250px;overflow:auto">';
		require_once(APPDIR.'pengembalian_buku_tabel.php');
	echo '</div>';
	
$xform->table_end(0);
echo '<div style="float:left;width:100%;text-align:center;margin-bottom:10px;margin-top:10px">';
echo '<button class="btnz" onclick="pengembalian_get()">Selesai</button>';
echo '</div>';
echo '</div>';
?>