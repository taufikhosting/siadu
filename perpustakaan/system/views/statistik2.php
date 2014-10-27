<?php
$fmod='statistik';
$xtable = new xtable($fmod,'Buku','','','sirkulasi');
//$xtable->use_select();
$xtable->noopt=true;
$xtable->pageorder="cnt DESC,mtipe";

$lok=gpost('lokasi');
$lokasi=lokasi_r($lok);
$tgl1=date("Y-m-")."1";
$tgl2=date("Y-m-").cal_days_in_month(CAL_GREGORIAN,intval(date("m")),intval(date("Y")));
$tanggal1=gpost('tanggal1',$tgl1);
$tanggal2=gpost('tanggal2',$tgl2);

// Query
$xtable->search_keyon('memberid(ID member)=>aka_siswa.nis:EQ|hrd_pegawai.nip:EQ|pus_member.nid:EQ-0','nama(nama member)=>aka_siswa.nama:LIKE|hrd_pegawai.nama:LIKE|pus_member.nama:LIKE-1');
				
$db=new xdb("pus_peminjaman");
$db->field("pus_peminjaman:replid,member,mtipe","COUNT(pus_peminjaman.member) as cnt","aka_siswa:nis,nama as nsiswa","hrd_pegawai:nip,nama as npegawai","pus_member:nid,nama as nmember");
$db->join("buku","pus_buku");
$db->join("member","aka_siswa");
$db->join("member","hrd_pegawai");
$db->join("member","pus_member");
$db->where($lok==0?"":"pus_buku.lokasi='$lok'");
$db->where_and("pus_peminjaman.tanggal1 >= '$tanggal1'");
$db->where_and("pus_peminjaman.tanggal1 <= '$tanggal2'");
$db->where_and($xtable->search_sql_get());
$db->group("pus_peminjaman.mtipe,pus_peminjaman.member");

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('nis,nip,nid','nsiswa,npegawai,nmember','mtipe','cnt'));

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
	$PSBar->selection('Periode',inputTanggal('tanggal1',$tanggal1).'<div style="float:left;margin:4px 12px 0px 8px">sampai</div> '.inputTanggal('tanggal2',$tanggal2).$s);
$PSBar->end();

if($PSBar->pass){

$xtable->btnbar_begin();
	//echo '<button style="float:left;margin-right:4px" class="btn" title="Reload" onclick="'.$fmod.'_get()"><div class="bi_relb">&nbsp;</div></button>';
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

$membertipe=array(1=>'Siswa',2=>'Pegawai',3=>'Member luar');
if($xtable->ndata>0){
	$xtable->head('@!ID Member','@Nama member','@Jenis member','@Jumlah Item Dipinjam{R,150px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin($r['replid']);
		
		if($r['mtipe']==1){
			$xtable->td($r['nis'],120);
			$xtable->td($r['nsiswa']);
		}
		else if($r['mtipe']==2){
			$xtable->td($r['nip'],120);
			$xtable->td($r['npegawai']);
		} else {
			$xtable->td($r['nid'],120);
			$xtable->td($r['nmember']);
		}
		$xtable->td($membertipe[$r['mtipe']],150);
		$xtable->td($r['cnt'].' item',150,'r');
		
	}
	$xtable->foot();
} else {
	$xtable->nodata_cust('Tidak ada data buku pada lokasi ini.');
}

}
?>