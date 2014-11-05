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
$t0=mysql_query("SELECT keu_jurnal.rek,keu_rekening.kode as koderek,keu_rekening.nama as nrek,keu_rekening.kategorirek FROM keu_jurnal LEFT JOIN keu_rekening ON keu_rekening.replid=keu_jurnal.rek LEFT JOIN keu_transaksi ON keu_transaksi.replid=keu_jurnal.transaksi WHERE keu_transaksi.tahunbuku='$tahunbuku' AND keu_transaksi.tanggal >= '$tanggal1' AND keu_transaksi.tanggal <= '$tanggal2' ".($fct==""?"":" AND (".$fct.")")." GROUP BY keu_jurnal.rek ORDER BY keu_rekening.kode");

$neracasaldo=array();
$labarugi=array();
if(mysql_num_rows($t0)>0){	
	while($jd=mysql_fetch_array($t0)){
		$rek=$jd['rek'];
		$kategorirek=$jd['kategorirek'];
		
		$neracasaldo[$rek]=array('debet'=>0,'kredit'=>0,'kode'=>$jd['koderek'],'nama'=>$jd['nrek'],'kategorirek'=>$kategorirek);
		$labarugi[$rek]=array('debet'=>0,'kredit'=>0);
		
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
				$neracasaldo[$rek]['debet']=$selisih;
			} else {
				$neracasaldo[$rek]['kredit']=$selisih;
			}
			if($kategorirek>=4){
				$labarugi[$rek]['debet']=$neracasaldo[$rek]['debet'];
				$labarugi[$rek]['kredit']=$neracasaldo[$rek]['kredit'];
			}
		}
	}
	
	$xtable=new xtable($fmod);
	$xtable->noopt=true;
	$xtable->tbl_width='1000px';
	$xtable->tbl_style='float:left;margin-bottom:30px';
	$xtable->row_strip=false;
	$xtable->cari=0;
	
	$xtable->ndata=count($neracasaldo);
	if($xtable->ndata>0){
		$s='<button style="float:left;margin-right:4px" class="btn" onclick=""><div class="bi_pri">Cetak</div></button>';
		echo '<div class="tbltopbar" style="width:100%;margin-bottom:5px"><div style="width:700px">'.$s.'</div></div>';
		
		//echo '<div class="sfont" style="font-size:15px;float:left;width:1000px;text-align:center;margin-bottom:20px">Neraca Lajur</div>';

		$xtable->head_addrow('Kode Rekening{2,70px,C}','Nama Rekening{2}','Neraca Saldo{C,1,2}','Laba/Rugi{C,1,2}','Neraca{C,1,2}');
		$xtable->head_addrow('Debet{R}','Kredit{R}','Debet{R}','Kredit{R}','Debet{R}','Kredit{R}');
		$xtable->head_multi();
		
		$neracasaldo_debet=0; $neracasaldo_kredit=0;
		$labarugi_debet=0; $labarugi_kredit=0;
		$neraca_debet=0; $neraca_kredit=0;
		foreach($neracasaldo as $rek=>$r){
			$xtable->row_begin();
				$xtable->td($neracasaldo[$rek]['kode'],70,'c');
				$xtable->td($neracasaldo[$rek]['nama']);
				// Neraca saldo
				$xtable->td(fRp($neracasaldo[$rek]['debet'],0),90,'r');
				$xtable->td(fRp($neracasaldo[$rek]['kredit'],0),90,'r');
				// Laba/Rugi
				if($neracasaldo[$rek]['kategorirek']>=4){
					$xtable->td(fRp($labarugi[$rek]['debet'],0),90,'r');
					$xtable->td(fRp($labarugi[$rek]['kredit'],0),90,'r');
					$labarugi_debet+=$labarugi[$rek]['debet'];
					$labarugi_kredit+=$labarugi[$rek]['kredit'];
				} else {
					$xtable->td();
					$xtable->td();
				}
				// Neraca
				if($neracasaldo[$rek]['kategorirek']<4){
					$xtable->td(fRp($neracasaldo[$rek]['debet'],0),90,'r');
					$xtable->td(fRp($neracasaldo[$rek]['kredit'],0),90,'r');
					$neraca_debet+=$neracasaldo[$rek]['debet'];
					$neraca_kredit+=$neracasaldo[$rek]['kredit'];
				} else {
					$xtable->td();
					$xtable->td();
				}
				
				$neracasaldo_debet+=$neracasaldo[$rek]['debet'];
				$neracasaldo_kredit+=$neracasaldo[$rek]['kredit'];
			$xtable->row_end();
		}
			$xtable->row_begin();
				$s='style="border-top:2px solid #88d9ff"';
				$xtable->td('<b>Jumlah</b>','','c',$s);
				$xtable->td('','','',$s);
				// Neraca Saldo
				$xtable->td('<b>'.fRp($neracasaldo_debet,0).'</b>',100,'r',$s);
				$xtable->td('<b>'.fRp($neracasaldo_kredit,0).'</b>',100,'r',$s);
				// Laba/Rugi
				$xtable->td('<b>'.fRp($labarugi_debet,0).'</b>',100,'r',$s);
				$xtable->td('<b>'.fRp($labarugi_kredit,0).'</b>',100,'r',$s);
				// Neraca
				$xtable->td('<b>'.fRp($neraca_debet,0).'</b>',100,'r',$s);
				$xtable->td('<b>'.fRp($neraca_kredit,0).'</b>',100,'r',$s);
			$xtable->row_end();
			$xtable->row_begin();
				$xtable->td();
				$xtable->td();
				$xtable->td();
				$xtable->td();
				// Laba/Rugi
				$laba=$labarugi_kredit-$labarugi_debet;
				if($laba<0){
					$xtable->td();
					$xtable->td('<b>'.fRp(-$laba,0).'</b>',100,'r');
				} else {
					$xtable->td('<b>'.fRp($laba,0).'</b>',100,'r');
					$xtable->td();
				}
				// Neraca
				$selisih=$neraca_debet-$neraca_kredit;
				if($selisih<0){
					$xtable->td('<b>'.fRp(-$selisih,0).'</b>',100,'r');
					$xtable->td();
				} else {
					$xtable->td();
					$xtable->td('<b>'.fRp($selisih,0).'</b>',100,'r');
				}
			$xtable->row_end();
			$xtable->row_begin();
				$xtable->td();
				$xtable->td();
				$xtable->td();
				$xtable->td();
				// Laba/Rugi
				// $laba=$labarugi_kredit-$labarugi_debet;
				if($laba<0){
					$xtable->td();
					$xtable->td('<b>'.fRp($labarugi_debet-$laba,0).'</b>',100,'r');
				} else {
					$xtable->td('<b>'.fRp($labarugi_debet+$laba,0).'</b>',100,'r');
					$xtable->td();
				}
				// Neraca
				// $selisih=$neraca_debet-$neraca_kredit;
				if($selisih<0){
					$xtable->td('<b>'.fRp($neraca_kredit-$selisih,0).'</b>',100,'r');
					$xtable->td();
				} else {
					$xtable->td();
					$xtable->td('<b>'.fRp($neraca_kredit+$selisih,0).'</b>',100,'r');
				}
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