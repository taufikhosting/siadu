<?php
$fmod='stocktake_hist';
$xtable=new xtable($fmod,'Riwayat Stock Opname');
$xtable->row_valign="top";
$xtable->pageorder="tanggal1";
$xtable->btnbar_begin();
	echo '<button class="btn" onclick="stocktake_hist_back()"><div class="bi_arrow">Kembali</div></button>';
$xtable->btnbar_end();

// Query
$sql="SELECT * FROM pus_stockhist";
$t=mysql_query($sql);
$xtable->ndata=mysql_num_rows($t);
$t=mysql_query($sql.$xtable->pageorder_sql('nama','tanggal1','tanggal2'));

if($xtable->ndata>0){
	// Table head
	$xtable->head('@Nama Stock Opname','@Tanggal Mulai','@Tanggal selesai','Rangkuman','keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
				
		$xtable->td($r['nama'],200);
		$xtable->td(fftgl($r['tanggal1']),120);
		$xtable->td(fftgl($r['tanggal2']),120);
		$tot=$r['nitem'];
		$ncek=$r['nceky'];
		$nnocek=$tot-$ncek;
		$nwn=$r['nnote'];
		$nnn=$nnocek-$nwn;
		
		$s='<table class="stable" cellspacing="0" cellpadding="0" border="0" style="border:none !important">';
		$s.='<tr><td style="border:none !important" width="180px">Total item di database</td><td style="border:none !important">: '.$tot.' item</td></tr>';
		$s.='<tr><td style="border:none !important">Item dicek</td><td style="border:none !important">: '.$ncek.' item</td></tr>';
		$s.='<tr><td style="border:none !important">Item hilang</td><td style="border:none !important">: '.$nnocek.' item</td></tr>';
		$s.='<tr><td style="border:none !important">Item hilang dengan keterangan</td><td style="border:none !important">: '.$nwn.' item</td></tr>';
		$s.='<tr><td style="border:none !important">Item hilang tanpa keterangan</td><td style="border:none !important">: '.$nnn.' item</td></tr>';
		$s.='</table>';
		$xtable->td($s,250);
		$xtable->td(nl2br($r['keterangan']));
		$s='<button class="btn" title="Cetak laporan" onclick="stocktake_report('.$r['replid'].')"><div class="bi_prib">&nbsp;</div></button>~24';
		$xtable->opt($r['replid'],$s,'u','d');
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata_cust('Tidak ada data riwayat stock opname.');}
?>