<?php appmod_use('keu/rekening');
$tahunbuku=tahunbuku_getaktifid();

$lababersih=0;

$fmod='transaksi_labarugi';

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
$rekpendapatan=array();
$rekbeban=array();
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
			if($kategorirek==6){
				$rekpendapatan[$rek]=array();
				if($neracasaldo[$rek]['debet']>$neracasaldo[$rek]['kredit']){
					$rekpendapatan[$rek]['nominal']=-$neracasaldo[$rek]['debet'];
				} else {
					$rekpendapatan[$rek]['nominal']=$neracasaldo[$rek]['kredit'];
				}
				$rekpendapatan[$rek]['nama']=$neracasaldo[$rek]['nama'];
			}
			if($kategorirek==7){
				$rekbeban[$rek]=array();
				if($neracasaldo[$rek]['kredit']>$neracasaldo[$rek]['debet']){
					$rekbeban[$rek]['nominal']=-$neracasaldo[$rek]['kredit'];
				} else {
					$rekbeban[$rek]['nominal']=$neracasaldo[$rek]['debet'];
				}
				$rekbeban[$rek]['nama']=$neracasaldo[$rek]['nama'];
			}
		}
		//echo $neracasaldo[$rek]['nama'].':'.$kategorirek.'<br/>';
	}
	
	$xtable=new xtable($fmod);
	$xtable->noopt=true;
	$xtable->tbl_width='1000px';
	$xtable->tbl_style='float:left;margin-bottom:30px';
	$xtable->row_strip=false;
	
	$xtable->ndata=count($neracasaldo);
	if($xtable->ndata>0){
		$s='<button style="float:left;margin-right:4px" class="btn" onclick=""><div class="bi_pri">Cetak</div></button>';
		echo '<div class="tbltopbar" style="width:100%;margin-bottom:25px"><div style="width:700px">'.$s.'</div></div>';
		
		echo '<table class="stable" cellspacing="0" cellpadding="0" width="550px" border="0" style="margin-bottom:30px">';

		$pendapatan=0; $beban=0;
			
			// Pendapatan
			echo '<tr height="20px">',
				'<td style="font-size:11px" ><b>Pendapatan :</b></td>',
				'<td></td>',
				'<td></td>',
				'</tr>';
			foreach($rekpendapatan as $rek=>$r){
				echo '<tr height="20px">',
					'<td style="font-size:11px" >'.$rekpendapatan[$rek]['nama'].'</td>',
					'<td style="font-size:11px" width="120px" align="right">'.fRp($rekpendapatan[$rek]['nominal'],1,1,1).'</td>',
					'<td></td>',
					'</tr>';
					$pendapatan+=$rekpendapatan[$rek]['nominal'];
			}
			echo '<tr height="20px" style="background:#eaeaea">',
				'<td style="font-size:11px" ><i>Total Pendapatan:</i></b></td>',
				'<td></td>',
				'<td style="font-size:11px" width="120px" align="right">'.fRp($pendapatan,1,1,1).'</td>',
				'</tr>';
			
			echo '<tr height="10px">',
				'<td></td>',
				'<td></td>',
				'<td></td>',
				'</tr>';
				
			// Beban
			echo '<tr height="20px">',
				'<td style="font-size:11px" ><b>Beban :</b></td>',
				'<td></td>',
				'<td></td>',
				'</tr>';
			foreach($rekbeban as $rek=>$r){
				echo '<tr height="20px">',
					'<td style="font-size:11px" >'.$rekbeban[$rek]['nama'].'</td>',
					'<td style="font-size:11px" width="120px" align="right">'.fRp($rekbeban[$rek]['nominal'],1,1,1).'</td>',
					'<td></td>',
					'</tr>';
					$beban+=$rekbeban[$rek]['nominal'];
			}
			echo '<tr height="20px" style="background:#eaeaea">',
				'<td style="font-size:11px" ><i>Total Beban:</i></b></td>',
				'<td></td>',
				'<td style="font-size:11px" width="120px" align="right">'.fRp($beban,1,1,1).'</td>',
				'</tr>';
				
			echo '<tr height="10px">',
				'<td></td>',
				'<td></td>',
				'<td><div style="margin-top:4px;padding-top:4px;margin-left:10px;width:110px;border-top:1px solid #666"></div></td>',
				'</tr>';
				
			$lababersih=$pendapatan-$beban;
			
			echo '<tr height="20px" style="background:#eaeaea">',
				'<td style="font-size:11px" ><i><b>Laba Bersih:</b></i></td>',
				'<td></td>',
				'<td style="font-size:11px" width="120px" align="right"><b>'.fRp($lababersih,1,1,1).'</b></td>',
				'</tr>';
					
		echo '</table>';
		
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