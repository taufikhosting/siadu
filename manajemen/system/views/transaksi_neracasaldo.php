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
$t0=mysql_query("SELECT keu_jurnal.rek,keu_rekening.kode as koderek,keu_rekening.nama as nrek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek LEFT JOIN keu_transaksi ON keu_transaksi.replid=keu_jurnal.transaksi WHERE keu_transaksi.tahunbuku='$tahunbuku' AND keu_transaksi.tanggal >= '$tanggal1' AND keu_transaksi.tanggal <= '$tanggal2' ".($w==""?"":" AND (".$w.")")." GROUP BY keu_jurnal.rek ORDER BY keu_rekening.kode");

$saldo_rek=array();
if(mysql_num_rows($t0)>0){	
	while($jd=mysql_fetch_array($t0)){
		$rek=$jd['rek'];
		$saldo_rek[$rek]=array('debet'=>0,'kredit'=>0,'kode'=>$jd['koderek'],'nama'=>$jd['nrek']);
		
		$db=new xdb("keu_jurnal");
		$db->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal");
		$db->join("transaksi","keu_transaksi");
		$db->join("rek","keu_rekening");
		$db->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
		$db->where_and("keu_jurnal.rek='$rek'");
		$db->where_and("keu_transaksi.tanggal >= '$tanggal1'");
		$db->where_and("keu_transaksi.tanggal <= '$tanggal2'");
		$db->where_and($fct==""?"":"(".$fct.")");
		$db->order("keu_transaksi.tanggal,keu_transaksi.nomer");
		$t=$db->query();

		if($xtable->ndata>0){
			$debet=0; $kredit=0;
			while($r=mysql_fetch_array($t)){
				$debet+=$r['debet'];
				$kredit+=$r['kredit'];
			}
			$selisih=$debet-$kredit;
			$selisih=$selisih<0?-$selisih:$selisih;
			
			if($debet>=$kredit){
				$saldo_rek[$rek]['debet']=$selisih;
			} else {
				$saldo_rek[$rek]['kredit']=$selisih;
			}
		}
	}
	
	$xtable=new xtable($fmod);
	$xtable->noopt=true;
	$xtable->tbl_width='700px';
	$xtable->tbl_style='float:left;margin-bottom:30px';
	$xtable->row_strip=false;
	$xtable->cari=0;
	
	$xtable->ndata=count($saldo_rek);
	if($xtable->ndata>0){
		//$s='<button style="float:left;margin-right:4px" class="btn" onclick=""><div class="bi_pri">Cetak</div></button>';
		//echo '<div class="tbltopbar" style="width:100%;margin-bottom:5px"><div style="width:700px">'.$s.'</div></div>';
		
		//echo '<div class="sfont" style="font-size:15px;float:left;width:700px;text-align:center;margin-bottom:20px">Neraca Saldo</div>';
		
		$xtable->head('Kode Rekening{C,70px}','Nama Rekening','Debet{R}','Kredit{R}');
		$debet=0; $kredit=0;
		foreach($saldo_rek as $rek=>$r){
			$xtable->row_begin();
				$xtable->td($r['kode'],70,'c');
				$xtable->td($r['nama']);
				$xtable->td(fRp($r['debet'],0),100,'r');
				$xtable->td(fRp($r['kredit'],0),100,'r');
				$debet+=$r['debet'];
				$kredit+=$r['kredit'];
			$xtable->row_end();
		}
			$xtable->row_begin();
				$s='style="border-top:2px solid #88d9ff"';
				$xtable->td('<b>Jumlah</b>','','c',$s);
				$xtable->td('','','',$s);
				$xtable->td('<b>'.fRp($debet,0).'</b>',100,'r',$s);
				$xtable->td('<b>'.fRp($kredit,0).'</b>',100,'r',$s);
			$xtable->row_end();
		$xtable->foot();
	} else {
		$xtable->nodata_cust('Tidak ada data transaksi.');
	}
} else {
	$xtable=new xtable($fmod);
	$xtable->nodata_cust('Tidak ada data transaksi.');
}} else {
	$xtable=new xtable($fmod);
	$xtable->nodata_cust('Silahkan pilih laporan transaksi.');
}
?>