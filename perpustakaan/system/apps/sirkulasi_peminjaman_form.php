<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$ssid=session_id();
dbDel("pus_tpjm","ssid='$ssid'");

$fmod='peminjaman';
$xform=new xform($fmod);

if($opt=='uf'){ // Nilai field editan
	//$t=mysql_query("SELECT * FROM pus_katalog WHERE replid='$cid' LIMIT 0,1");
	//$data=mysql_fetch_array($t);
	$ttl='Edit';
}
else { // Nilai field default
	$data=array();
	$ttl='Tambah';
	$data['tanggal1']=date("Y-m-d");
	$data['tanggal2']=date("Y-m-d",strtotime("+5 day"));
}

echo '<table cellspacing="10px" cellpadding="0" border="0" width="100%" style="border:1px solid rgba(0, 0, 0, .3);background:#fcfcff;margin-bottom:10px">';
echo '<tr valign="top">';
	echo '<td>';
		echo '<div class="sfont" style="margin-top:0px;height:24px;width:100%"><b>Daftar item yang dipinjam:</b></div>';
		echo '<div class="tbltopbar" style="width:100%">';
			$s='<button title="Cari" class="btn" style="margin-right:4px" onclick="sirkulasi_peminjaman_form_buku_list_open()"><div class="bi_srcb">&nbsp;</div></button>';
			echo iText('sbuku','','width:300px;margin-right:4px','barkode atau judul item','onkeyup="sirkulasi_peminjaman_form_buku_list_cari(event)"').$s;
		echo '</div>';
		echo '<div id="box_sirkulasi_peminjaman_form_buku" style="width:600px;max-height:100px;height:130px;overflow:auto">';
			require_once(APPDIR.'sirkulasi_peminjaman_form_buku_get.php');
		echo '</div>';
	echo '</td>';
echo '</tr>';
echo '</table>';

echo '<table cellspacing="10px" cellpadding="0" border="0" width="100%" style="border:1px solid rgba(0, 0, 0, .3);background:#fcfcff;margin-bottom:10px">';
echo '<tr valign="top">';
	echo '<td width="370px">';
		echo '<div class="sfont" style="margin-top:0px;height:24px;width:100%"><b>Data peminjam:</b></div>';
		$xform->set_fieldw(290);
		$xform->set_labelw(80);
		$s='<button title="Cari" class="btn" style="margin-right:4px" onclick="sirkulasi_peminjaman_form_member_list_open()"><div class="bi_srcb">&nbsp;</div></button>';
			$xform->fi('Peminjam',iText('smember','','width:200px;margin-right:4px','ID atau nama member','onkeyup="sirkulasi_member_cari(event)"').$s);
			//hiddenval('member_id',0);
			//hiddenval('member_tipe',0);
			//hiddenval('sirkulasi_form',1);
		echo '<div id="box_sirkulasi_peminjaman_form_member" class="xrowl" style="margin-top:10px">';
			require_once(APPDIR.'sirkulasi_peminjaman_form_member_get.php');
		echo '</div>';
	echo '</td>';
	echo '<td>';
		echo '<div class="sfont" style="float:left;margin-top:0px;height:24px;width:100%"><b>Waktu peminjaman:</b></div>';
		$xform->set_fieldw(200);
		$xform->set_labelw(150);
		$xform->fi('Tanggal peminjaman',inputTanggal('tanggal1',$data['tanggal1']));
		$xform->fi('Tanggal pengembalian',inputTanggal('tanggal2',$data['tanggal2']));
		echo '<div class="sfont" style="float:left;margin-top:10px;height:24px;width:100%"><b>Catatan peminjaman:</b></div>';
		$xform->set_fieldw(200);
		$xform->set_labelw(150);
		$xform->fi('Keterangan',iTextarea('keterangan','','width:190px',3));

	echo '</td>';
echo '</tr>';
echo '</table>';
?>