<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$peminjaman=gpost('peminjaman'); if($peminjaman=='')$peminjaman=0;
hiddenval('peminjaman',$peminjaman);
//mysql_query("TRUNCATE TABLE  `sar_dftp`");

$fmod='pengembalian';
$xform=new xform($fmod,$opt,$cid);

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);

hiddenval('lokasi',$lok);

if($opt=='uf'){ // Nilai field editan
	$t=mysql_query("SELECT * FROM sar_peminjaman WHERE replid='$cid' LIMIT 0,1");
	$data=mysql_fetch_array($t);
}
else { // Nilai field default
	$data=Array();
	$data['replid']=0;
	$data['tanggal1']=date("Y-m-d");
	$data['tanggal2']=date("Y-m-d",strtotime("+1 day"));
}

$xform->title('Pengembalian Barang');

if($peminjaman==0){
$xform->table_begin();

	$xform->col_begin('50%');
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Barang yang akan dikembalikan',160); // Grup field
		$xform->fi('Nama atau kode barang',iText('keyword',$keyword,'width:'.($xform->fieldw-30).'px;float:left;margin-right:2px').
		'<button class="find21" style="float:left;margin-top:2px" title="Cari" onclick="pengembalian_cari()"></button>');
		echo '<div id="tabelcari" style="width:420px;max-height:180px;height:180px;overflow:auto">';
			require_once(APPDIR.'pengembalian_tabelcari.php');
		echo '</div>';

$xform->table_end(0);

} else {
$xform->table_begin();

	$sql="SELECT sar_peminjaman.*,sar_barang.kode,sar_katalog.nama FROM sar_peminjaman LEFT JOIN sar_barang ON sar_barang.replid=sar_peminjaman.barang LEFT JOIN sar_katalog ON sar_katalog.replid=sar_barang.katalog WHERE sar_peminjaman.replid='$peminjaman'";
	$t=mysql_query($sql);
	$data=mysql_fetch_array($t);
	

	$xform->col_begin('50%');
	$xform->group_begin('Informasi Barang',160); // Grup field
		$xform->fi('Kode barang',$data['kode']);
		$xform->fi('Nama barang',$data['nama']);
	$xform->group_begin('Informasi Peminjam',160);
		$xform->fi('Peminjam',$data['peminjam']);
		$xform->fi('Tempat',$data['tempat']);
	if($data['keterangan']!=''){
	$xform->group_begin('Catatan Peminjaman',160);
		$xform->fi('Keterangan',nl2br($data['keterangan']));
	}

	$xform->col_begin('50%');
	$xform->group_begin('Jangka Waktu Peminjaman',160);
		$xform->fi('Tanggal Peminjaman',fftgl($data['tanggal1']));
		$xform->fi('Tanggal Pengembalian',fftgl($data['tanggal2']));
	$xform->group_begin('Catatan Pengembalian',160);
		$xform->fi('Keterangan',iTextarea('keterangan','','width:250px',5));
		
$xform->table_end(0);

	echo '<div style="float:left;width:100%;text-align:center;margin-bottom:10px;margin-top:20px">';
	echo '<button class="btn" style="margin-right:4px" onclick="'.$xform->back_act.'">Batal</button>';
	echo '<button class="btnz" onclick="'.$xform->fmod.'_form(\''.substr($xform->opt,0,1).'\','.$xform->cid.')">Kembalikan</button>';
	echo '</div>';
			
}

?>