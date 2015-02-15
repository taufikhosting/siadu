<?php appmod_use('keu/rekening');
$tahunbuku=tahunbuku_getaktifid();

$fmod='transaksi';
$xtable=new xtable($fmod);
$xtable->row_strip=false;
//$xtable->search_keyon('nama=>aka_siswa.nama:LIKE|aka_siswa.nis:EQ-0,1');
$xtable->search_keyon('cari=>keu_transaksi.nomer:EQ|keu_transaksi.uraian:LIKE-1,2');
$xtable->pageorder="keu_transaksi.tanggal,keu_transaksi.ct";

$tanggal1=gpost('tanggal1',date("Y-m")."-1");
$tgl=explode("-",date("Y-m-d")); $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
$tanggal2=gpost('tanggal2',date("Y-m")."-".$dim);

$ct_jurnaldetil=gpost('ct_jurnaldetil',1);

$ct_umum=gpost('ct_umum',1);
$ct_pemasukan=gpost('ct_pemasukan',1);
$ct_pengeluaran=gpost('ct_pengeluaran',1);
$ct_siswa=gpost('ct_siswa',1);
$ct_calonsiswa=gpost('ct_calonsiswa',1);
$ct_barang=gpost('ct_barang',1);
$w=""; $sel=0;
if($ct_umum!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_UMUM."'";
$sel++;}
if($ct_pemasukan!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_INCOME."'";
$sel++;}
if($ct_pengeluaran!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_OUTCOME."'";
$sel++;}
if($ct_siswa!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_SISWA."'";
$sel++;}
if($ct_calonsiswa!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_CALONSISWA."'";
$sel++;}
if($ct_barang!=0){if($w!="")$w.=" OR ";
	$w.="keu_transaksi.jenis='".JT_INBRG."'";
$sel++;}

if($sel>0){
	// Query
	$db=new xdb("keu_transaksi");
	$db->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
	$db->where_and("keu_transaksi.tanggal>='$tanggal1'");
	$db->where_and("keu_transaksi.tanggal<='$tanggal2'");
	$db->where_and($w==""?"":"(".$w.")");
	$db->where_and($xtable->search_sql_get());
	//$db->order("keu_transaksi.tanggal,keu_transaksi.nomer");
	$t=$db->query();
	$xtable->ndata=mysql_num_rows($t);
	$t=$db->query($xtable->pageorder_sql('keu_transaksi.tanggal','keu_transaksi.nomer','','keu_transaksi.nominal'));
	//$t=$db->query($xtable->pageorder_sql('kode','nama'));
	
	$xtable->btnbar_begin();
		//$xtable->btnbar_print();
		echo '<button class="btn" style="float:left;margin-right:4px" onclick="E(\'pageprinter\').submit()"><div class="bi_pri">Cetak</div></button>';
		
		$xtable->search_box('Cari uraian atau nomor jurnal');
		echo iCheckx('ct_jurnaldetil','Tampilkan detil jurnal',$ct_jurnaldetil,'float:right;margin-left:4px;margin-right:30px;margin-top:4px','onclick="transaksi_jurnadetil(this.checked)"');
	$xtable->btnbar_end();

	$xtable->search_info('data transaksi dengan uraian atau nomor jurnal "<b>{keyw}</b>".');

	if($xtable->ndata>0){
		// Table head
		$xtable->head('@!Tanggal','@!No. Jurnal / <br/>No. Bukti','Uraian','@nominal{R'.($ct_jurnaldetil==1?',h':'').'}','Detil Jurnal'.($ct_jurnaldetil==1?'':'{h}'));
		$row=0;
		while($r=mysql_fetch_array($t)){
			$xtable->row_begin();
				if($r['jenis']==JT_INCOME) $cl='#00c804';
				else if($r['jenis']==JT_OUTCOME) $cl='#ff1b1b';
				else if($r['jenis']==JT_INBRG) $cl='#ff1b1b';
				else if($r['jenis']==JT_INBANK) $cl='#00c804';
				else if($r['jenis']==JT_OUTBANK) $cl='#ff1b1b';
				else if($r['jenis']==JT_SISWA) $cl='#00c804';
				else if($r['jenis']==JT_CALONSISWA) $cl='#00c804';
				else if($r['jenis']==JT_UMUM) $cl='#008aff';
				else $cl='';
				$xtable->td(fftgl($r['tanggal']),110);
				$xtable->td('<b><span style="color:'.$cl.'">'.$r['nomer'].($r['nobukti']==''?'':'<br/><span style="color:#444">'.$r['nobukti'].'</span>').'</span></b>',120);
				$xtable->td(nl2br($r['uraian']),($ct_jurnaldetil==1?300:''),'','id="xtd_urai'.$row.'"');
				$xtable->td(fRp($r['nominal']),100,'r','id="xtd_nom'.$row.'" style="display:'.($ct_jurnaldetil==1?'none':'').'"');
				
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
				$xtable->td($s,'','','id="xtd_jd'.$row.'" style="display:'.($ct_jurnaldetil==1?'':'none').'"');
				
				$s='<button class="btn" title="Cetak bukti transaksi" onclick="transaksi_print(\''.$r['nomer'].'\')"><div class="bi_prib">&nbsp;</div></button>';
				$xtable->opt($r['replid'],'u','d');
				$row++;
		} $xtable->foot();
		hiddenval('xtd_jd_num',$row);
		echo '<form id="pageprinter" style="display:none" target="_blank" action="'.RLNK.'print2.php?doc=jurnalumum&docname=Jurnal Umum&doprint=0" method="post"><input name="pagesql" type="hidden" value="'.$db->getsql().'" /></form>';
	} else{
		$xtable->nodata_cust('Tidak ada data transaksi.');
	}
} else {
	$xtable->nodata_cust('Silahkan pilih laporan transaksi.');
}
?>