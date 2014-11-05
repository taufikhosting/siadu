<?php appmod_use('keu/rekening');
$tahunbuku=tahunbuku_getaktifid();

$fmod='transaksi_jurnalumum';

$tanggal1=gpost('tanggal1',date("Y-m")."-1");
$tgl=explode("-",date("Y-m-d")); $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
$tanggal2=gpost('tanggal2',date("Y-m")."-".$dim);

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

$fct=$w;

if($sel>0){
/*
$t0=mysql_query("SELECT keu_jurnal.rek,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek LEFT JOIN keu_transaksi ON keu_transaksi.replid=keu_jurnal.transaksi WHERE keu_transaksi.tahunbuku='$tahunbuku' AND keu_transaksi.tanggal <= '$tanggal2' AND (keu_rekening.kategorirek='1' OR keu_rekening.kategorirek='2') ".($fct==""?"":" AND (".$fct.")")." GROUP BY keu_jurnal.rek ORDER BY keu_rekening.kategorirek,keu_rekening.kode");

$jurnal=array();
$i=0;
while($jd=mysql_fetch_array($t0)){
	$jurnal[$i]=$jd;
	$i++;
}
for($i=0;$i<$njurnal;$i++){
	$jd=$jurnal[$i];
	$rek=$jd['rek'];
	//echo'<div id="tabelrek'.($i+1).'" style="display:">';
	
	$xtable=new xtable($fmod);
	$xtable->noopt=true;
	$xtable->tbl_width='800px';
	$xtable->tbl_style='float:left;margin-bottom:30px';
	$xtable->row_strip=false;
	$xtable->usepaggging=false;
	$xtable->cari=0;
	
	$db=new xdb("keu_jurnal");
	$db->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal,nomer,uraian");
	$db->join("transaksi","keu_transaksi");
	$db->join("rek","keu_rekening");
	$db->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
	$db->where_and("keu_jurnal.rek='$rek'");
	$db->where_and("keu_transaksi.tanggal >= '$tanggal1'");
	$db->where_and("keu_transaksi.tanggal <= '$tanggal2'");
	$db->where_and($fct==""?"":"(".$fct.")");
	$db->order("keu_transaksi.tanggal,keu_transaksi.nomer");
	$t=$db->query();
	$xtable->ndata=mysql_num_rows($t);

	if($xtable->ndata>0){
		echo '<div class="sfont" style="font-size:13px;float:left;width:800px;text-align:left;margin-bottom:4px">['.$jd['koderek'].'] '.$jd['nrek'].'</div>';
		// Table head
		$xtable->head('Tanggal','Nomor Transaksi{70px}','Uraian','Kode Rekening{C,70px}','Debet{R}','Kredit{R}');
		$debet=0; $kredit=0;
		while($r=mysql_fetch_array($t)){$xtable->row_begin();
			
			$xtable->td(fhtgl($r['tanggal']),80);
			$xtable->td($r['nomer'],120);
			$xtable->td($r['uraian']);
			$xtable->td($r['koderek'],70,'c');
			$xtable->td(fRp($r['debet'],0),100,'r'); $debet+=$r['debet'];
			$xtable->td(fRp($r['kredit'],0),100,'r'); $kredit+=$r['kredit'];
			
		$xtable->row_end();}
		
		$xtable->row_begin();
			$s='style="border-top:2px solid #88d9ff"';
			$xtable->td('<b>Jumlah</b>','','',$s);
			$xtable->td('','','',$s);
			$xtable->td('','','',$s);
			$xtable->td('','','',$s);
			$xtable->td('<b>'.fRp($debet,0).'</b>',100,'r',$s);
			$xtable->td('<b>'.fRp($kredit,0).'</b>',100,'r',$s);
		$xtable->row_end();
		$saldo=$debet-$kredit;
		$saldo=$saldo<0?-$saldo:$saldo;
		$xtable->row_begin();
			$xtable->td();
			$xtable->td();
			$xtable->td();
			$xtable->td();
			if($debet>=$kredit){
				$xtable->td('<b>'.fRp($saldo,0).'</b>',100,'r');
				$xtable->td();
			} else {
				$xtable->td();
				$xtable->td('<b>'.fRp($saldo,0).'</b>',100,'r');					
			}
		$xtable->row_end();
		
		$xtable->foot();
	}
	//echo '</div>';
}
*/

$t0=mysql_query("SELECT keu_jurnal.rek,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek LEFT JOIN keu_transaksi ON keu_transaksi.replid=keu_jurnal.transaksi WHERE keu_transaksi.tahunbuku='$tahunbuku' AND keu_transaksi.tanggal >= '$tanggal1' AND keu_transaksi.tanggal <= '$tanggal2' AND (keu_rekening.kategorirek='1' OR keu_rekening.kategorirek='2') ".($fct==""?"":" AND (".$fct.")")." GROUP BY keu_jurnal.rek ORDER BY keu_rekening.kategorirek,keu_rekening.kode");

$njurnal=mysql_num_rows($t0);

hiddenval('njurnal',$njurnal);

if($njurnal>0){
	$jurnal=array();
	$i=0;
	while($jd=mysql_fetch_array($t0)){
		$jurnal[$i]=$jd;
		$i++;
	}
	for($i=0;$i<$njurnal;$i++){
		$jd=$jurnal[$i];
		$rek=$jd['rek'];
		echo'<div id="tabelrekz" style="border-bottom:1px solid #444;float:left;width:800px;margin-bottom:20px">';
		
		$saldo_awal=0;
		$db0=new xdb("keu_jurnal");
		$db0->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal,nomer,uraian");
		$db0->join("transaksi","keu_transaksi");
		$db0->join("rek","keu_rekening");
		$db0->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
		$db0->where_and("keu_jurnal.rek='$rek'");
		$db0->where_and("keu_transaksi.tanggal < '$tanggal1'");
		//$db2->where_and("keu_transaksi.tanggal <= '$tanggal2'");
		$db0->where_and($fct==""?"":"(".$fct.")");
		$db0->order("keu_transaksi.tanggal,keu_transaksi.nomer");
		$t_0=$db0->query();
		$ndata=mysql_num_rows($t_0);
		if($ndata>0){
			while($r_0=mysql_fetch_array($t_0)){
				$saldo_awal+=$r2['debet'];
				$saldo_awal-=$r2['kredit'];
			}
		}
		echo '<div class="sfont" style="font-size:13px;float:left;width:800px;text-align:left;margin-bottom:4px">';
		echo '<div style="float:left">['.$jd['koderek'].'] '.$jd['nrek'].'</div>';
		echo '<div style="float:right">Saldo awal: '.($saldo_awal>0?fRp($saldo_awal):'Rp 0').'</div>';
		echo '</div>';
		
		$debet=0; $kredit=0;
		
		// Penerimaan
		echo '<div class="sfont" style="font-size:13px;float:left;width:800px;text-align:left;margin-bottom:4px">';
		echo '<div style="float:left">Penerimaan:</div>';
		echo '</div>';
		
		$xtable=new xtable($fmod);
		$xtable->noopt=true;
		$xtable->tbl_width='800px';
		$xtable->tbl_style='float:left;margin-bottom:30px';
		$xtable->row_strip=false;
		$xtable->usepaggging=false;
		$xtable->cari=0;
		
		$db_in=new xdb("keu_jurnal");
		$db_in->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal,nomer,uraian");
		$db_in->join("transaksi","keu_transaksi");
		$db_in->join("rek","keu_rekening");
		$db_in->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
		$db_in->where_and("keu_jurnal.rek='$rek'");
		$db_in->where_and("keu_transaksi.tanggal >= '$tanggal1'");
		$db_in->where_and("keu_transaksi.tanggal <= '$tanggal2'");
		$db_in->where_and("keu_jurnal.kredit = '0'");
		$db_in->where_and($fct==""?"":"(".$fct.")");
		$db_in->order("keu_transaksi.tanggal,keu_transaksi.nomer");
		$t=$db_in->query();
		$xtable->ndata=mysql_num_rows($t);

		// Table head
		$xtable->head('Tanggal','Nomor Transaksi{120px}','Uraian','Nominal{R}');
		
		if($xtable->ndata>0){
		while($r=mysql_fetch_array($t)){$xtable->row_begin();
			
			$xtable->td(fhtgl($r['tanggal']),80);
			$xtable->td($r['nomer'],120);
			$xtable->td($r['uraian']);
			$xtable->td(fRp($r['debet'],0),100,'r'); $debet+=$r['debet'];
			
		$xtable->row_end();}
		} else {
			$xtable->row_begin();
			
			$xtable->td('<i>Tidak ada data.</i>',80,'','colspan="4"');
			
			$xtable->row_end();
		}
		$xtable->row_begin();
			$s='style="border-top:2px solid #88d9ff"';
			$xtable->td('Jumlah Pengeluaran','','',$s);
			$xtable->td('','','',$s);
			$xtable->td('','','',$s);
			$xtable->td(''.($debet>0?fRp($debet,0):0).'',100,'r',$s);
		$xtable->row_end();
		
		$xtable->foot();

		
		// Pengeluaran
		echo '<div class="sfont" style="font-size:13px;float:left;width:800px;text-align:left;margin-bottom:4px">';
		echo '<div style="float:left">Pengeluaran:</div>';
		echo '</div>';
		
		$xtable=new xtable($fmod);
		$xtable->noopt=true;
		$xtable->tbl_width='800px';
		$xtable->tbl_style='float:left;margin-bottom:30px';
		$xtable->row_strip=false;
		$xtable->usepaggging=false;
		$xtable->cari=0;
		
		$db_out=new xdb("keu_jurnal");
		$db_out->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal,nomer,uraian");
		$db_out->join("transaksi","keu_transaksi");
		$db_out->join("rek","keu_rekening");
		$db_out->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
		$db_out->where_and("keu_jurnal.rek='$rek'");
		$db_out->where_and("keu_transaksi.tanggal >= '$tanggal1'");
		$db_out->where_and("keu_transaksi.tanggal <= '$tanggal2'");
		$db_out->where_and("keu_jurnal.debet = '0'");
		$db_out->where_and($fct==""?"":"(".$fct.")");
		$db_out->order("keu_transaksi.tanggal,keu_transaksi.nomer");
		$t=$db_out->query();
		$xtable->ndata=mysql_num_rows($t);

		// Table head
		$xtable->head('Tanggal','Nomor Transaksi{120px}','Uraian','Nominal{R}');
		if($xtable->ndata>0){
		while($r=mysql_fetch_array($t)){$xtable->row_begin();
			
			$xtable->td(fhtgl($r['tanggal']),80);
			$xtable->td($r['nomer'],120);
			$xtable->td($r['uraian']);
			$xtable->td(fRp($r['kredit'],0),100,'r'); $kredit+=$r['kredit'];
			
		$xtable->row_end();}
		} else {
			$xtable->row_begin();
			
			$xtable->td('<i>Tidak ada data.</i>',80,'','colspan="4"');
			
			$xtable->row_end();
		}
		$xtable->row_begin();
			$s='style="border-top:2px solid #88d9ff"';
			$xtable->td('Jumlah Pengeluaran</b>','','',$s);
			$xtable->td('','','',$s);
			$xtable->td('','','',$s);
			$xtable->td(''.($kredit>0?fRp($kredit,0):0).'',100,'r',$s);
		$xtable->row_end();
		
		$xtable->foot();
		
		$saldo_awal=$saldo_awal+$debet-$kredit;
		echo '<div class="sfont" style="background:#f0f0f0;font-size:13px;float:left;width:800px;text-align:left;margin-bottom:10px">';
		//echo '<div style="float:left">['.$jd['koderek'].'] '.$jd['nrek'].'</div>';
		echo '<div style="float:right;margin:2px;">Saldo Akhir: '.($saldo_awal>0?fRp($saldo_awal):'Rp 0').'</div>';
		echo '</div>';
		
		echo '</div>';
	}
} else {
	$xtable=new xtable($fmod);
	$xtable->btnbar_begin();
		echo '<div style="visibility:hidden">'; $xtable->search_box(); echo '</div>';
	$xtable->btnbar_end();
	$xtable->nodata_cust('Tidak data transaksi.');
}} else {
	$xtable=new xtable($fmod);
	$xtable->nodata_cust('Silahkan pilih laporan transaksi.');
}
?>