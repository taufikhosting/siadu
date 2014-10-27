<?php appmod_use('keu/rekening');
$bukutahun=tahunbuku_getaktif();
$tahunbuku=tahunbuku_getaktifid();

$saldo_awal=tahunbuku_getsaldoawal();
echo'<div id="tabelrekx" style="display:">';
		
$xtable=new xtable($fmod);
$xtable->noopt=true;
$xtable->tbl_width='1000px';
$xtable->tbl_style='float:left;margin-bottom:30px';
$xtable->row_strip=false;
$xtable->usepaggging=false;
$xtable->cari=0;

$db=new xdb("keu_jurnal");
$db->field("keu_jurnal:*","keu_rekening:kode as koderek,nama as nrek","keu_transaksi:tanggal,nomer,uraian");
$db->join("transaksi","keu_transaksi");
$db->join("rek","keu_rekening");
$db->where_and("keu_transaksi.tahunbuku='$tahunbuku'");
$db->where_and("keu_rekening.kategorirek='1'");
$db->order("keu_transaksi.tanggal,keu_transaksi.nomer");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

echo '<div class="sfont" style="font-size:13px;float:left;width:1000px;text-align:left;margin-top:20px;margin-bottom:20px;text-align:center">Tahun Buku: '.$bukutahun['nama'].'</div>';

if($xtable->ndata>0){
	// echo '<div class="sfont" style="font-size:13px;float:left;width:800px;text-align:left;margin-bottom:4px">['.$jd['koderek'].'] '.$jd['nrek'].'</div>';
	// Table head
	$xtable->head('Tanggal','Kode Rekening{C,70px}','Nama Perkiraan','Nomor Transaksi{70px}','Uraian','Debet{R,100px}','Kredit{R,100px}');
	$debet=0; $kredit=0;
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td(fhtgl($r['tanggal']),80);
		$xtable->td($r['koderek'],70,'c');
		$xtable->td($r['nrek'],120);
		$xtable->td($r['nomer'],120);
		$xtable->td($r['uraian']);
		$xtable->td(fRp($r['debet'],0),100,'r'); $debet+=$r['debet'];
		$xtable->td(fRp($r['kredit'],0),100,'r'); $kredit+=$r['kredit'];
		
	$xtable->row_end();}
	
	$xtable->row_begin();
		$s='style="border-top:2px solid #88d9ff"';
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('TOTAL MUTASI','','',$s);
		$xtable->td(fRp($debet,0),100,'r',$s);
		$xtable->td(fRp($kredit,0),100,'r',$s);
	$xtable->row_end();
	$saldo=$saldo_awal+$debet-$kredit;
	//$saldo=$saldo<0?-$saldo:$saldo;
	
	$xtable->row_begin();
		$s='';
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('SALDO AWAL','','',$s);
		$xtable->td(fRp($saldo_awal,0),100,'r',$s);
		$xtable->td('',100,'r',$s);
	$xtable->row_end();
	
	$xtable->row_begin();
		$s='';
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('','','',$s);
		$xtable->td('SALDO AKHIR','','',$s);
		if($saldo<0){
			$xtable->td('<span style="color:#ff0000">('.fRp(-$saldo,0).')</span>',100,'r',$s);
		} else {
			$xtable->td(fRp($saldo,0),100,'r',$s);
		}
		$xtable->td('',100,'r',$s);
	$xtable->row_end();
	
	$xtable->foot();
}
echo '</div>';

?>