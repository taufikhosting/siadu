<?php $SOUF=stocktake_unfinished();
$opt=gpost('opt'); $cid=gpost('cid'); if($cid=='')$cid=0;
$keyw=gpost('keyword'); $keyn=gpost('keyon');

$fmod='pengembalian';
$xtable = new xtable($fmod,'pengembalian');
$xtable->noopt=true;
$xtable->pageorder="pus_peminjaman.tanggal3 DESC";
$xtable->search_keyon('barkode=>pus_buku.barkode:EQ-0',
					  'judul=>pus_katalog.judul:LIKE-1',
					  'memberid(ID member)=>aka_siswa.nis:EQ|hrd_pegawai.nip:EQ-2',
					  'nama(nama member)=>aka_siswa.nama:LIKE|hrd_pegawai.nama:LIKE-2');

if($opt=='af'||$opt=='uf') require_once(VWDIR.'pengembalian_form.php');
else{
hiddenval('member_id',0);
hiddenval('member_tipe',0);

$tgl1=date("Y-m-")."1";
$tgl2=date("Y-m-").cal_days_in_month(CAL_GREGORIAN,intval(date("m")),intval(date("Y")));
$tanggal1=gpost('tanggal1',$tgl1);
$tanggal2=gpost('tanggal2',$tgl2);

$PSBar = new PSBar_2(100,450);
$PSBar->begin();
	$s='<button style="float:left;margin:0px 4px 0px 4px" class="btn" title="Tampilkan" onclick="'.$fmod.'_get()"><div class="bi_srcb">&nbsp;</div></button>';
	$PSBar->selection('Periode',inputTanggal('tanggal1',$tanggal1).' <div style="float:left;margin:4px 8px 0px 8px">sampai</div> '.inputTanggal('tanggal2',$tanggal2).$s);
$PSBar->end();

// Query
$db=new xdb("pus_peminjaman");
$db->field("pus_peminjaman:*","pus_buku:barkode","pus_katalog:judul","DATEDIFF(pus_peminjaman.tanggal3,pus_peminjaman.tanggal2) as telat","aka_siswa:nis,nama as nsiswa","hrd_pegawai:nip,nama as npegawai");
$db->join("buku","pus_buku");
$db->join("member","aka_siswa");
$db->join("member","hrd_pegawai");
$db->joinother("pus_buku","katalog","pus_katalog");
$db->where("pus_peminjaman.status = '0'");
$db->where_and("pus_peminjaman.tanggal3 >= '$tanggal1'");
$db->where_and("pus_peminjaman.tanggal3 <= '$tanggal2'");
$db->where_and($xtable->search_sql_get());

$t=$db->query();
$xtable->ndata=mysql_num_rows($t);
$t=$db->query($xtable->pageorder_sql('barkode','judul','nsiswa,npegawai','tanggal1','tanggal2','tanggal3','telat'));

$xtable->btnbar_begin();
	if($SOUF==0) $xtable->btnbar_add();
	else echo '<div class="warnbox">Pengembalian tidak dapat dilakukan selama proses stock opname berlangsung.</div>';
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
// Table head
	$xtable->head('@Barkode Item','@Judul Item','@Peminjam','@Tgl peminjaman','@Tgl pengembalian','@Tgl dikembalikan','@Terlambat{R}','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		if($r['mtipe']==1){
			$member=$r['nsiswa'].'<br/>NIS: '.$r['nis'];
		} else if($r['mtipe']==2){
			$member=$r['npegawai'].'<br/>NIP: '.$r['nip'];
		} else {
			$member="N/a";
		}
		
		$xtable->td($r['barkode'],120,'','item');
		$xtable->td(buku_judul($r['judul']),250,'','item');
		$xtable->td($member,200,'','member');
		$xtable->td(fftgl($r['tanggal1']),120);
		
		if($r['telat']>0){
			$s='<span style="color:red">'.fftgl($r['tanggal3']).'</span>';
		} else {
			$s=fftgl($r['tanggal3']);
		}
		$xtable->td(fftgl($r['tanggal2']),120);
		$xtable->td($s,120);
		
		$xtable->td(($r['telat']>0?$r['telat'].' hari':'-'),80,'r');
		$xtable->td($r['keterangan']==''?'&nbsp':nl2br($r['keterangan']));
		
	$xtable->row_end();}$xtable->foot();
} else { $xtable->nodata(); }
}
?>