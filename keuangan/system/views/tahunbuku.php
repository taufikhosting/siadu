<?php
$fmod='tahunbuku';
$xtable=new xtable($fmod,'tahun buku');
$xtable->btnbar_f('add');
// Query data
$sql="SELECT * FROM keu_tahunbuku";
$t=mysql_query($sql); $xtable->ndata=mysql_num_rows($t);

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama Tahun Buku','tanggal mulai','Saldo awal{R}','Keterangan','Status{C}');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		
		$xtable->td($r['nama'],200);
		//$xtable->td($r['kode'],140);
		$xtable->td(fftgl($r['tanggal1']),120);
		$xtable->td(fRp($r['saldoawal']),140,'r');
		$xtable->td(nl2br($r['keterangan']));
		if($r['aktif']=='1'){
		//$s='<button class="btns" title="Klik untuk me-non aktifkan." style="width:85px" onclick="tahunbuku_status_form(\'uf\','.$r['replid'].')">Aktif</button>';
		$s='<div style="padding:2px;border-radius:2px;background:#00d000;color:#fff;width:83px;margin:auto"><b>Aktif</b></div>';
		} else {
		$s='<button class="btn" title="Klik untuk mengaktifkan." style="width:85px" onclick="tahunbuku_status_form(\'uf\','.$r['replid'].')">Tidak Aktif</button>';
		}
		$xtable->td($s,100,'c');
		$xtable->opt_ud($r['replid']);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}
?>