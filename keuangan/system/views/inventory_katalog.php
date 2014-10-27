<?php $opt=gpost('opt'); $cid=gpost('cid',0);

$fmod='katalog';
$xtable=new xtable($fmod,'Barang');

$lok=gpost('lokasi');
$grup=gpost('grup');

hiddenval('lokasi',$lok);
hiddenval('grup',$grup);

if($opt=='af'||$opt=='uf') require_once(VWDIR.'katalog_form.php');
else{

// Query
$db=new xdb("sar_katalog","","grup='$grup'");
$t=$xtable->use_db($db,$xtable->pageorder_sql('kode','nama'));

$xtable->btnbar_f(iBtn('Inventory','bi_arrow','title="Kembali ke inventaris" onclick="katalog_back()"'));

hiddenval('opf','kat');
?>
<div class="tbltopmbar" style="float:left;margin-top:10px">
<table class="stable" cellspacing="0" cellpadding="0" width="100%">
	<tr height="30px"><td colspan="2" align="center" style="font-size:15px">Grup Barang <b><?=grup_name($grup)?></b></td></tr>
	<tr height="24px"><td width="100px">Lokasi:</td><td><?=lokasi_name($lok)?></td></tr>
	<tr height="24px"><td width="100px">Total aset:</td><td><?=fRp(grup_aset($grup))?></td></tr>
</table>
</div>
<?php
if($xtable->ndata>0){
	// Table head
	$xtable->head('@kode','@nama barang','jenis','Jumlah unit~R','Aset~R','penyusutan<br/>per tahun~R','keterangan','{40px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$n=mysql_num_rows(mysql_query("SELECT replid FROM sar_barang WHERE katalog='".$r['replid']."'"));
		
		$xtable->td($r['kode'],80);
		$xtable->td($r['nama'],200);
		$xtable->td(jenis_name($r['jenis']),200);
		$xtable->td($n,80,'r');
		$xtable->td(fRp(katalog_aset($r['replid'])),100,'r');
		$xtable->td($r['susut'].' %',120,'r');
		$xtable->td(nl2br($r['keterangan']));
		$xtable->opt($r['replid'],'v');
			//'<button class="btn" title="Tambah unit barang baru." onclick="katalog_unit_add(\'<id>\')"><div class="bi_add">Unit</div></button>~50');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}}
?>