<?php $opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='katalog_unit';
$xtable=new xtable($fmod,'Unit barang');
$xtable->noopt=true;

$lok=gpost('lokasi');
$grup=gpost('grup');
$kat=$cid;

hiddenval('lokasi',$lok);
hiddenval('grup',$grup);
hiddenval('katalog',$kat);

if($opt=='af'||$opt=='uf') require_once(VWDIR.'katalog_form.php');
else{

// Katalog Query
$tk=mysql_query("SELECT * FROM sar_katalog WHERE replid='$cid'");
$rk=mysql_fetch_array($tk);

// Query
//$sql="SELECT * FROM sar_barang WHERE katalog='$cid'";
$t=$xtable->use_db(new xdb("sar_barang","","katalog='$cid'"),$xtable->pageorder_sql('kode','barkode','kondisi'));

$xtable->btnbar_f(iBtn('Grup barang','bi_arrow','title="Kembali ke grup barang" onclick="katalog_unit_back()"'));

hiddenval('opf','uni');

hiddenval('kondisi_1',mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='$cid' AND kondisi='1'")));
hiddenval('kondisi_2',mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='$cid' AND kondisi='2'")));
hiddenval('kondisi_3',mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='$cid' AND kondisi='3'")));
hiddenval('kondisi_4',mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='$cid' AND kondisi='4'")));

?>
<div class="tbltopmbar" style="float:left;margin-top:10px;margin-bottom:10px">
<table class="stable" cellspacing="0" cellpadding="0" width="100%"><tr valign="top">
<td width="400px">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px"><td colspan="2"><b>Informasi Barang :</b></td></tr>
		<tr height="24px"><td width="140px">Nama barang:</td><td><?=$rk['nama']?></td></tr>
		<tr height="24px"><td width="140px">Grup barang:</td><td><?=grup_name($grup)?></td></tr>
		<tr height="24px"><td width="140px">Lokasi:</td><td><?=lokasi_name($lok)?></td></tr>
		<tr height="24px"><td width="140px">Jumlah unit:</td><td><?=$xtable->ndata?> unit</td></tr>
		<tr height="24px"><td width="140px">Total aset:</td><td><?=fRp(katalog_aset($rk['replid']))?></td></tr>
		<tr height="24px"><td width="140px">Penyusutan per tahun:</td><td><?=$rk['susut']?> %</td></tr>
	</table>
</td>
<td align="">
	<table class="stable" cellspacing="0" cellpadding="0">
		<tr height="24px"><td colspan="2"><b>Gambar Barang:</b></td></tr>
		<tr height="24px"><td colspan="2">
			<div style="border:1px solid #b7b7b7;height:100px;">
			<?php if($rk['photo']!=''){ ?>
			<img id="tfoto" src="photo/katalog.php?id=<?=$rk['replid']?>" height="100px" style="margin-right:0px"/>
			<?php }else{ ?>
			<img id="tfoto" src="photo/nophoto.jpg" height="100px" style="margin-right:0px"/>
			<?php }?>
			</div>
		</td></tr>
	</table>
</td>
<td align="">
<table class="stable" cellspacing="0" cellpadding="0">
	<tr height="24px"><td colspan="2"><b>Kondisi Barang:</b></td></tr>
	<tr><td><div id="placeholder" style="background:#fff;width:300px;height:120px"></div></td></tr>
</table>
</td>
</tr></table>
</div>
<?php
if($xtable->ndata>0){
	// Table head
	$xtable->head('@kode','@barkode','sumber','harga~R','@kondisi','status','keterangan');
	$nom = 1;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['kode'],200);
		$xtable->td($r['barkode'],100);
		$xtable->td(sumber_name($r['sumber']),100);
		$xtable->td(fRp($r['harga']),120,'r');
		$xtable->td(kondisi_name($r['kondisi']),100);
		$xtable->td($r['status']==1?'Tersedia':'Dipinjam',100);
		$xtable->td(nl2br($r['keterangan']));
		//$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
?>