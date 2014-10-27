<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

mysql_query("TRUNCATE TABLE  `sar_dftp`");

$fmod='peminjaman';
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

$xform->title('Peminjaman Barang');

$xform->table_begin();

	$xform->col_begin('50%'); // Kolom kiri lebar 40%
	$xform->group_begin('Informasi Peminjam',160); // Grup field
		$xform->fi('Peminjam',iText('peminjam',$data['peminjam'],$xform->fieldws));
		$xform->fi('Tempat',iText('tempat',$data['tempat'],$xform->fieldws));

	$xform->col_begin('50%'); // Kolom kiri lebar 60%
	$xform->grupclass='flodiv'; $xform->grupstyle='';
	$xform->group_begin('Jangka Waktu Peminjaman',160); // Grup field
		$xform->fi('Tanggal Peminjaman',inpDate('tanggal1',$data['tanggal1']));
		$xform->fi('Tanggal Pengembalian',inpDate('tanggal2',$data['tanggal2']));
	$xform->group_begin('Catatan Peminjaman',160);
		$xform->fi('Keterangan',iTextarea('keterangan','','width:250px',5));
		
//$xform->table_end(0);

$xform->table_begin();

	$xform->col_begin('50%');
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Cari Barang yang akan dipinjam',160); // Grup field
		$xform->fi('Nama atau kode barang',iText('keyword',$keyword,'width:'.($xform->fieldw-30).'px;float:left;margin-right:2px').
		'<button class="find21" style="float:left;margin-top:2px" title="Cari" onclick="peminjaman_cari()"></button>');
		echo '<div id="tabelcari" style="width:420px;max-height:180px;height:180px;overflow:auto">';
			require_once(APPDIR.'peminjaman_tabelcari.php');
		echo '</div>';
	
	$xform->col_begin('50%');
	$xform->grupclass=''; $xform->grupstyle='float:left';
	$xform->group_begin('Daftar barang yang dipinjam',160); // Grup field
	echo '<div id="tabelpinjam" class="unflodiv" style="width:450px;max-height:180px;height:180px;overflow:auto">';
		require_once(APPDIR.'peminjaman_tabelpinjam.php');
	echo '</div>';

$xform->table_end();
?>