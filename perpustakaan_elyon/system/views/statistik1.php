<?php
$fmod='statistik';
$xtable = new xtable($fmod,'Buku');
//$xtable->use_select();
$xtable->noopt=true;
$xtable->pageorder="cnt DESC,barkode,judul";

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);
$tgl1=date("Y-m-")."1";
$tgl2=date("Y-m-").cal_days_in_month(CAL_GREGORIAN,intval(date("m")),intval(date("Y")));
$tanggal1=gpost('tanggal1',$tgl1);
$tanggal2=gpost('tanggal2',$tgl2);

// Query
$xtable->search_keyon('barkode=>pus_buku.barkode:EQ-0',
				'judul=>pus_katalog.judul-1',
				'callnumber=>pus_buku.callnumber-2',
				'kode(kode klasifikasi)=>pus_klasifikasi.kode:EQ-3',
				'pengarang(nama pengarang)=>pus_pengarang.nama-4',
				'penerbit(nama penerbit)=>pus_penerbit.nama-5');
				
$db=new xdb('pus_peminjaman');
$db->field('pus_peminjaman:replid','pus_buku:callnumber','pus_katalog:judul,klasifikasi,pengarang,penerbit','pus_klasifikasi:kode as n1,kode','pus_pengarang:nama as n2','pus_penerbit:nama as n3','COUNT(pus_peminjaman.buku) as cnt');
$db->join('buku','pus_buku');
$db->joinother('pus_buku','katalog','pus_katalog');
$db->joinother('pus_katalog','klasifikasi','pus_klasifikasi');
$db->joinother('pus_katalog','pengarang','pus_pengarang');
$db->joinother('pus_katalog','penerbit','pus_penerbit');
$db->where($lok==0?"":"pus_buku.lokasi='$lok'");
$db->where_and("pus_peminjaman.tanggal1 >= '$tanggal1'");
$db->where_and("pus_peminjaman.tanggal1 <= '$tanggal2'");
$db->where_and($xtable->search_sql_get());
$db->group("pus_buku.katalog");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('judul','callnumber','n1','n2','n3','cnt'));

// Page Selection Bar
$PSBar = new PSBar_2(100,450);
$PSBar->begin();
	$PSBar->selection('Statistik',iSelect('statistik',$statistik,$stat,$PSBar->selws,$fmod."_get()"));
	
	if(count($lokasi)>0){
		$PSBar->selection('Lokasi',iSelect('lokasi',$lokasi,$lok,$PSBar->selws,$fmod."_get()"));
	} else {
		$PSBar->end();
		hiddenval('lokasi',$lok);
		lokasi_warn(0,'float:left');
		$PSBar->pass=false;
	}
	
	$s='<button style="float:left;margin:0px 4px 0px 4px" class="btn" title="Tampilkan" onclick="'.$fmod.'_get()"><div class="bi_srcb">&nbsp;</div></button>';
	$PSBar->selection('Periode',inputTanggal('tanggal1',$tanggal1).' <div style="float:left;margin:4px 8px 0px 8px">sampai</div> '.inputTanggal('tanggal2',$tanggal2).$s);
$PSBar->end();

if($PSBar->pass){

$xtable->btnbar_begin();
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
	$xtable->head('@Judul','@Callnumber','@Klasifikasi','@Pengarang','@Penerbit','@Dipinjam{R}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		//$xtable->td($r['barkode'],120);
		$xtable->td(buku_judul($r['judul']));
		$xtable->td($r['callnumber'],150);
		$xtable->td(klasifikasi_name($r['klasifikasi']),200);
		$xtable->td($r['n2'],150);
		$xtable->td($r['n3'],150);
		$xtable->td($r['cnt'].' kali',80,'r');
		
	}
	$xtable->foot();
} else {
	$xtable->nodata_cust('Tidak ada data buku pada lokasi ini.');
}

}
?>