<?php appmod_use('psb','psb/proses','psb/kelompok');

$dept=gpost('departemen');
$departemen=departemen_r($dept);
$pros=gpost('proses');
$proses=proses_r($pros,$dept);
$kel=gpost('kelompok');
$kelompok=kelompok_r($kel,$pros,1);

$modeview=gpost('modeview','data');
hiddenval('modeview',$modeview);

$fmod='modul_psb';

if(count($departemen)>0){
// Page Selection Bar
$PSBar = new PSBar_2();
$PSBar->begin();
	$PSBar->selection_departemen($fmod,$dept);
	if(count($proses)>0){
		$PSBar->selection('Periode',iSelect('proses',$proses,$pros,"width:".$PSBar->selw,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('proses',$pros);
		hiddenval('kelompok',$kel);
		proses_warn(1); exit();
	}
	if(count($kelompok)>0){
		$PSBar->selection('Kelompok',iSelect('kelompok',$kelompok,$kel,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('kelompok',$kel);
		kelompok_warn(1); exit();
	}
$PSBar->end();

$tampil=gpost('tampil','all');

$t=mysql_query("SELECT replid FROM keu_modul WHERE reftipe='".RT_PSB."' AND refid='$pros'");
if(mysql_num_rows($t)>0){
$modul=mysql_fetch_array($t);
$modid=$modul['replid'];

$inp=array('modul'=>$modid,'siswa'=>0,'nominal'=>0,'cicilan'=>0);
$t=mysql_query("SELECT psb_calonsiswa.replid,psb_kelompok.biaya FROM psb_calonsiswa LEFT JOIN psb_kelompok ON psb_kelompok.replid=psb_calonsiswa.kelompok WHERE psb_calonsiswa.proses='$pros'");
while($r=mysql_fetch_array($t)){
	$t1=mysql_query("SELECT * FROM keu_pembayaran WHERE modul='$modid' AND siswa='".$r['replid']."'");
	if(mysql_num_rows($t1)==0){
		$inp['siswa']=$r['replid'];
		$inp['nominal']=$r['biaya'];
		$inp['cicilan']=$r['biaya'];
		$q=dbInsert("keu_pembayaran",$inp);
	}
}

// Tabel transaksi
$fmod='modul_psb';
$xtable=new xtable($fmod,'Pembayan pendaftaran');
$xtable->pageorder="psb_calonsiswa.nopendaftaran";
$xtable->search_keyon('nopendaftaran(nomor pendaftaran)=>psb_calonsiswa.nopendaftaran:EQ-0','nama=>psb_calonsiswa.nama-1');
$xtable->noopt=true;
$xtable->cari=$xtable->keyw==''?0:1;

// Query
$db=new xdb("keu_pembayaran");
$db->field("keu_pembayaran:*","psb_calonsiswa:nama,nopendaftaran","keu_transaksi:tanggal as tglbayar,nominal as jmlbayar");
$db->join("siswa","psb_calonsiswa");
$db->join("modul","keu_modul");
$db->join("replid","keu_transaksi","pembayaran");
$db->where("keu_modul.refid='$pros'");
$db->where_and($kel==0?"":"psb_calonsiswa.kelompok='$kel'");
if($tampil=='Y') $db->where_and("keu_pembayaran.lunas='1'");
if($tampil=='N') $db->where_and("keu_pembayaran.lunas='0'");
$db->where_and($xtable->search_sql_get());

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql("psb_calonsiswa.nopendaftaran","psb_calonsiswa.nama","","","keu_transaksi.tanggal","keu_pembayaran.lunas"));

$s='';
//$s.='<button title="Tampilkan." class="btn" style="float:right;margin-left:4px" onclick="stocktake_note()"><div class="bi_relb">&nbsp;</div></button>';
$s.=iSelect('tampil',array('all'=>'Semua','Y'=>'Sudah bayar','N'=>'Belum bayar'),$tampil,'float:right;margin-left:4px;margin-right:20px',$fmod.'_get()');
$s.='<div class="sfont" style="float:right;margin-top:4px;margin-left:4px"><b>Tampilkan:</b></div>';

$xtable->btnbar_f('print','srcbox',$s);

hiddenval('modul',$modid);
hiddenval('pembayaran',0);

if($xtable->ndata>0){
	// Table head
	$xtable->head('@No pendaftaran','@Nama','Biaya pendaftaran{R}','Jumlah dibayar{R}','@Tanggal pembayaran','@Status');
	
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['nopendaftaran'],120);
		$xtable->td($r['nama']);
		$xtable->td(fRp($r['nominal']),110,'r');
		$xtable->td(fRp($r['jmlbayar']),110,'r');
		
		if($r['lunas']=='1')
			$s='<div style="padding:2px;border-radius:2px;background:#00d000;color:#fff;width:96px;margin:auto"><b>Sudah bayar</b></div>';
		else
			$s='<button class="btn" title="Klik untuk transaksi pembayaran." onclick="E(\'pembayaran\').value='.$r['replid'].';pembayaran_form(\'af\')" style="width:100px">Belum bayar</button>';
		$xtable->td(fftgl($r['tglbayar']),140);
		$xtable->td($s,110,'c');
		//$xtable->opt($r['replid'],($h['status']=='1'?'u':''));
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata_cust('Tidak ditemukan data pembayaran.');}
// End of Tabel transaksi

} else {
	hiddenval('tampil','all');
	echo '<div style="float:left;width:100%;margin-bottom:6px"><div class="warnbox" style="margin-right:4px">Belum ada modul pembayaran pendaftaran periode ini. Silahkan menambah modul pembayaran.</div></div><button onclick="modul_form(\'af\')" class="btnz" style="float:left" title="Tambah modul pembayaran."><div class="bi_add2">Modul pembayaran</div></button>';
}

hiddenval('kategori',3);
hiddenval('reftipe',RT_PSB);
hiddenval('refid',$pros);
hiddenval('snama','Pendaftaran '.$proses[$pros]);


}else departemen_warn(1);
?>