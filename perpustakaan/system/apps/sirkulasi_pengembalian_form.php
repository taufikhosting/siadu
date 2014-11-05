<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;

$ssid=session_id();
dbDel("pus_tpjm","ssid='$ssid'");

$fmod='pengembalian';
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
	$data['tanggal2']=date("Y-m-d",strtotime("+7 day"));
}

echo '<table cellspacing="10px" cellpadding="0" border="0" width="100%" style="border:1px solid rgba(0, 0, 0, .3);background:#fcfcff;margin-bottom:10px">';
echo '<tr valign="top">';
	echo '<td>';
		echo '<div class="sfont" style="margin-top:0px;height:24px;width:100%"><b>Daftar item yang dikembalikan:</b></div>';
		echo '<div class="tbltopbar" style="width:100%">';
			$s='<button title="Cari" class="btn" style="margin-right:4px" onclick="sirkulasi_pengembalian_form_buku_list_open()"><div class="bi_srcb">&nbsp;</div></button>';
			echo iText('sbuku','','width:300px;margin-right:4px','barkode atau judul item','onkeyup="sirkulasi_pengembalian_form_buku_list_cari(event)"').$s;
		echo '</div>';
		echo '<div id="box_sirkulasi_pengembalian_form_buku" style="width:100%;max-height:200px;height:200px;overflow:auto">';
			require_once(APPDIR.'sirkulasi_pengembalian_form_buku_get.php');
		echo '</div>';
	echo '</td>';
echo '</tr>';
echo '</table>';
?>