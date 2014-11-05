<?php require_once(MODDIR.'xform/xform.php'); require_once(MODDIR.'control.php');
$SOUF=stocktake_unfinished();

$opt=gpost('opt');
$kat=gpost('katalog',0);

hiddenval('katalog',$kat);

$lok=gpost('lokasi');
$lokasi=lokasi_r($lokasi,1);

$fmod='katalog_buku';
$xform=new xform($fmod,$opt,$kat);
$xtable=new xtable($fmod,'Buku');

// Katalog Query
$tk=mysql_query("SELECT * FROM pus_katalog WHERE replid='$kat'");
$rk=mysql_fetch_array($tk);

$xtable->btnbar_begin();
	//$xtable->btnbar_back(0,'Katalog');
	echo '<button class="btn" title="Kembali ke katalog" style="float:left;margin-right:4px" onclick="katalog_buku_back(0)"><div class="bi_arrow">Katalog</div></button>';
	if($SOUF==0){
		echo '<button class="btn" onclick="katalog_form(\'uf\',\''.$rk['replid'].'\')" style="float:left;margin-right:4px"><div class="bi_edit">Edit informasi katalog</div></button>';
		echo '<button class="btn" title="Tambah data koleksi." style="float:left;margin-right:4px" onclick="katalog_buku_form(\'af\')"><div class="bi_add">Koleksi</div></button>';
		echo '<button class="btn" title="Reload." style="float:left;margin-right:4px" onclick="katalog_buku_get()"><div class="bi_relb">&nbsp;</div></button>';
	} else {
		echo '<button class="btn" title="Reload." style="float:left;margin-right:4px" onclick="katalog_buku_get()"><div class="bi_relb">&nbsp;</div></button>';
		echo '<div class="warnbox">Perubahan katalog tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
	}
$xtable->btnbar_end();

hiddenval('opf','buk');

?>
<div class="tbltopmbar" style="float:left;margin-top:10px;margin-bottom:10px">
<table class="stable" cellspacing="0" cellpadding="0" width="100%"><tr valign="top">
<td width="400px">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px"><td colspan="2"><b>Informasi Katalog:</b></td></tr>
		<tr height="24px"><td width="140px">Judul:</td><td><?=buku_judul($rk['judul'])?></td></tr>
		<tr height="24px"><td width="140px">Klasifikasi:</td><td><?=klasifikasi_name($rk['klasifikasi'])?></td></tr>
		<tr height="24px"><td width="140px">Pengarang:</td><td><?=pengarang_name($rk['pengarang'])?></td></tr>
		<tr height="24px"><td width="140px">Penerjemah:</td><td><?=$rk['penerjemah']?></td></tr>
		<tr height="24px"><td width="140px">Editor:</td><td><?=$rk['editor']?></td></tr>
		<tr height="24px"><td width="140px">Terbitan:</td><td><?=penerbit_name($rk['penerbit']).($rk['kota']==''?'':', '.$rk['kota']).($rk['tahunterbit']==''?'':', '.$rk['tahunterbit'])?></td></tr>
		<tr height="24px"><td width="140px">ISBN:</td><td><?=$rk['isbn']?></td></tr>
		<tr height="24px"><td width="140px">ISSN:</td><td><?=$rk['issn']?></td></tr>
		<tr height="24px"><td width="140px">Bahasa:</td><td><?=bahasa_name($rk['bahasa'])?></td></tr>
		<tr height="24px"><td width="140px">Seri:</td><td><?=$rk['seri']?></td></tr>
		<tr height="24px"><td width="140px">Volume:</td><td><?=$rk['volume']?></td></tr>
		<tr height="24px"><td width="140px">Edisi:</td><td><?=$rk['edisi']?></td></tr>
		<tr height="24px"><td width="140px">Jenis koleksi:</td><td><?=jenisbuku_name($rk['jenisbuku'])?></td></tr>
	</table>
</td>
<td align="">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px"><td colspan="2"><b>Gambar Sampul:</b></td></tr>
		<tr height="24px"><td colspan="2">
			<?=$xform->photof($rk['replid'],'katalog',100,140);?>
		</td></tr>
		<tr height="24px"><td colspan="2"><b>Deskripsi:</b></td></tr>
		<tr height="24px"><td width="140px">Jumlah halaman:</td><td><?=$rk['halaman'];?> halaman</td></tr>
		<tr height="24px"><td width="140px">Sinopsis:</td><td><?=nl2br($rk['deskripsi']);?></td></tr>
	</table>
</td>
</tr>
<tr><?php

?></tr>
</table>
</div>
<div class="tbltopmbar" style="float:left;margin-top:10px;margin-bottom:10px">
<div class="sfont"><b>Daftar item :</b></div>
</div>
<div id="katalog_buku_daftar">
<?php
require_once(APPDIR.'katalog_buku_daftar_get.php');
?>
</div>