<?php require_once(MODDIR.'xtable/xtable.php'); appmod_use('keu/rekening');
$tahunbuku=tahunbuku_getaktifid();

$pemb=pembayaran_getdatabysubj($modul,$siswaid);

$fmod='pembayaran';

$xform=new xform($fmod);
$xform->table_begin();
	$xform->col_begin();
	
$xtable=new xtable($fmod,'pembayaran');
$xtable->row_strip=false;
//$xtable->search_keyon('nama=>aka_siswa.nama:LIKE|aka_siswa.nis:EQ-0,1');
$xtable->search_keyon('cari=>keu_transaksi.nomer:EQ|keu_transaksi.uraian:LIKE-1');
$xtable->pageorder="keu_transaksi.tanggal,keu_transaksi.nomer";


// Query
$db=new xdb("keu_transaksi");
$db->where_and("keu_transaksi.pembayaran='".$pemb['replid']."'");
//$db->where_and($xtable->search_sql_get());
//$db->order("keu_transaksi.tanggal,keu_transaksi.nomer");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql());
//$t=$db->query($xtable->pageorder_sql('kode','nama'));

$s='<button style="float:left;margin-right:4px" class="btng" onclick="E(\'jenistransaksi\').value='.JT_INCOME.';transaksi_form(\'af\')">
	<table cellspacing="0" cellpadding="0"><tr>
	<td><div style="width:20px;height:20px;background:url('.IMGR.'inco.png) center no-repeat;margin-right:6px"></div></td><td><span style="font:bold 11px Verdana,Tahoma;color:#fff;margin-right:4px"><b>Pembayaran</b></span></td>
	</tr></table>
	</button>';
$xtable->btnbar_f($pemb['lunas']==1?'<div class="infobox" style="float:left;margin-right:10px">Pembayaran sudah lunas.</div>':'add','print');

$xtable->search_info('data transaksi dengan uraian atau nomor "<b>{keyw}</b>".');

if($xtable->ndata>0){
	// Table head
	$xtable->head('!Tanggal/<br/>No. Transaksi{110px}','Uraian','Detil Jurnal');
	
	while($r=mysql_fetch_array($t)){
		$xtable->row_begin();
			if($r['jenis']==JT_INCOME) $cl='#00c804';
			else if($r['jenis']==JT_SISWA) $cl='#00c804';
			else if($r['jenis']==JT_CALONSISWA) $cl='#00c804';
			else if($r['jenis']==JT_OUTCOME) $cl='#ff1b1b';
			else if($r['jenis']==JT_UMUM) $cl='#008aff';
			else $cl='';
			$xtable->td(fftgl($r['tanggal']).'<br/><b><span style="color:'.$cl.'">'.$r['nomer'].'</span></b>',110);
			$xtable->td(nl2br($r['uraian']),250);
			
			$t1=mysql_query("SELECT keu_jurnal.debet,keu_jurnal.kredit,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek WHERE keu_jurnal.transaksi='".$r['replid']."' ORDER BY keu_jurnal.replid");
			if(mysql_num_rows($t1)>0){
				$s='<div style="background:#fff"><table class="xtable_norm" cellspacing="0" cellpadding="4px" width="100%">';
				while($r1=mysql_fetch_array($t1)){
					$s.='<tr><td>'.$r1['nrek'].'</td><td width="40px" align="center">'.$r1['koderek'].'</td><td width="100px" align="right">'.fRp($r1['debet']).'</td><td width="100px" align="right">'.fRp($r1['kredit']).'</td></tr>';
				}
				$s.='</table></div>';
			} else {
				$s='';
			}
			$xtable->td($s);
			
			$xtable->opt_ud($r['replid']);
		
	} $xtable->foot();
	
} else{ 
	$xtable->nodata_cust('Tidak ada data transaksi.');
}


$xform->table_end(0);
?>