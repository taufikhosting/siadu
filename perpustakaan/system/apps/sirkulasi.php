<?php require_once(MODDIR.'xtable/xtable.php'); require_once(MODDIR.'control.php'); $SOUF=stocktake_unfinished();

$s='';
$s.='<button style="float:left;margin-right:4px;height:26px" class="btnz" onclick="sirkulasi_peminjaman_form(\'af\')">
	<table cellspacing="0" cellpadding="0"><tr>
	<td><div style="width:20px;height:20px;background:url('.IMGR.'outco.png) center no-repeat;margin-right:6px"></div></td><td><span style="font:bold 11px Verdana,Tahoma;color:#fff;margin-right:4px"><b>Peminjaman</b></span></td>
	</tr></table>
	</button>';
$s.='<button style="float:left;margin-right:4px;height:26px" class="btng" onclick="sirkulasi_pengembalian_form(\'af\')">
	<table cellspacing="0" cellpadding="0"><tr>
	<td><div style="width:20px;height:20px;background:url('.IMGR.'inco.png) center no-repeat;margin-right:6px"></div></td><td><span style="font:bold 11px Verdana,Tahoma;color:#fff;margin-right:4px"><b>Pengembalian</b></span></td>
	</tr></table>
	</button>';
echo '<div class="tbltopbar" style="width:100%;margin-bottom:20px">'.$s.'</div>';

$fmod='sirkulasi';

$ct_periode=gpost('ct_periode','1');
$ct_pinjam=gpost('ct_pinjam','1');
$ct_kembali=gpost('ct_kembali','0');
$ct_ttelat=gpost('ct_ttelat','1');
$ct_telat=gpost('ct_telat','1');
$ct_siswa=gpost('ct_siswa','1');
$ct_pegawai=gpost('ct_pegawai','1');
$ct_lain=gpost('ct_lain','1');

$ct_sel1=0; $w1=""; 
if($ct_pinjam!=0){if($w1!="")$w1.=" OR ";
	$w1.="pus_peminjaman.status='1'";
$ct_sel1++;}
if($ct_kembali!=0){if($w1!="")$w1.=" OR ";
	$w1.="pus_peminjaman.status='0'";
$ct_sel1++;}
$w1=($w1==''||$ct_sel1==2)?'':'('.$w1.')';

$ct_sel3=0; $w3='';
if($ct_ttelat!=0){if($w3!="")$w3.=" OR ";
	$w3.="((pus_peminjaman.status='1' AND '".date("Y-m-d")."' <= pus_peminjaman.tanggal2) OR (pus_peminjaman.status='0' AND pus_peminjaman.tanggal3 <= pus_peminjaman.tanggal2))";
$ct_sel3++;}
if($ct_telat!=0){if($w3!="")$w3.=" OR ";
	$w3.="((pus_peminjaman.status='1' AND '".date("Y-m-d")."' > pus_peminjaman.tanggal2) OR (pus_peminjaman.status='0' AND pus_peminjaman.tanggal3 > pus_peminjaman.tanggal2))";
$ct_sel3++;}
$w3=($w3==''||$ct_sel3==2)?'':'!('.$w3.')';

$ct_sel2=0; $w2="";
if($ct_siswa!=0){if($w2!="")$w2.=" OR ";
	$w2.="pus_peminjaman.mtipe='1'";
$ct_sel2++;}
if($ct_pegawai!=0){if($w2!="")$w2.=" OR ";
	$w2.="pus_peminjaman.mtipe='2'";
$ct_sel2++;}
if($ct_lain!=0){if($w2!="")$w2.=" OR ";
	$w2.="pus_peminjaman.mtipe='3'";
$ct_sel2++;}
$w2=($w2==''||$ct_sel2==3)?'':'('.$w2.')';

$tgl=explode("-",date("Y-m-d")); $dim=cal_days_in_month(CAL_GREGORIAN,intval($tgl[1]),intval($tgl[0]));
$tgl_f=date("Y-m")."-1";
$tgl_c=date("Y-m-d");
$tgl_l=date("Y-m")."-".$dim;
$stanggal1=gpost('stanggal1',$tgl_f);
$stanggal2=gpost('stanggal2',$tgl_l);
hiddenval('tanggal_f',$tgl_f);
hiddenval('tanggal_c',$tgl_c);
hiddenval('tanggal_l',$tgl_l);

$xtable = new xtable($fmod,'peminjaman');
$xtable->pageorder="pus_peminjaman.tanggal1 DESC,pus_peminjaman.replid DESC";
$xtable->search_keyon('barkode=>pus_buku.barkode:EQ-2',
					  'judul=>pus_katalog.judul:LIKE-3',
					  'memberid(ID member)=>aka_siswa.nis:EQ|hrd_pegawai.nip:EQ|pus_member.nid:EQ-1',
					  'nama(nama member)=>aka_siswa.nama:LIKE|hrd_pegawai.nama:LIKE|pus_member.nama:LIKE-1');

					  
// Query
$db=new xdb("pus_peminjaman");
$db->field("pus_peminjaman:*","pus_buku:barkode","pus_katalog:judul","aka_siswa:nis,nama as nsiswa","hrd_pegawai:nip,nama as npegawai","pus_member:nid,nama as nmember");//,"(CASE pus_peminjaman.mtipe WHEN '1' THEN aka_siswa.nis WHEN '2' THEN hrd_pegawai.nip ELSE pus_member.nid END) as id_member");//,"@id_member:= as idmmbr");//,"(CASE pus_peminjaman.status='1' AND '".date("Y-m-d")."' > pus_peminjaman.tanggal2 WHEN TRUE THEN '1' ELSE '0' END) as telat1","(CASE pus_peminjaman.status='0' AND pus_peminjaman.tanggal3 > pus_peminjaman.tanggal2 WHEN TRUE THEN '1' ELSE '0' END) as telat2");
$db->join("buku","pus_buku");
$db->join("member","aka_siswa");
$db->join("member","hrd_pegawai");
$db->join("member","pus_member");
$db->joinother("pus_buku","katalog","pus_katalog");
$db->where_and("pus_peminjaman.tanggal".$ct_periode." >= '$stanggal1'");
$db->where_and("pus_peminjaman.tanggal".$ct_periode." <= '$stanggal2'");
$db->where_and($w1);
$db->where_and($w2);
$db->where_and($w3);
if($xtable->keyn=='memberid' && $xtable->page_search==1){
	$db->where_and("!((CASE pus_peminjaman.mtipe WHEN '1' THEN aka_siswa.nis WHEN '2' THEN hrd_pegawai.nip ELSE pus_member.nid END) = '".$xtable->keyw."')");
} else if($xtable->keyn=='nama' && $xtable->page_search==1){
	if($xtable->keyw=='') $keywo=" = '' ";
	else $keywo=" LIKE '%".$xtable->keyw."%' ";
	$db->where_and("!((CASE pus_peminjaman.mtipe WHEN '1' THEN aka_siswa.nama WHEN '2' THEN hrd_pegawai.nama ELSE pus_member.nama END) ".$keywo.")");
} else {
	$db->where_and($xtable->search_sql_get());
}
				

if(!($ct_sel1==0 || $ct_sel2==0 || $ct_sel3==0)){
	$t=$db->query();
	$xtable->ndata=mysql_num_rows($t);
	$t=$db->query($xtable->pageorder_sql('pus_peminjaman.tanggal1','nsiswa,npegawai,nmember','pus_buku.barkode','pus_katalog.judul','pus_peminjaman.tanggal2','pus_peminjaman.status','pus_peminjaman.tanggal3'));
}

echo '<table cellspacing="0" cellpadding="0" style="margin-bottom:20px"><tr valign="top"><td width="250px">';
	echo '<div class="sfont" style="float:left;width:100%;margin-top:0px;margin-bottom:10px"><b>Tampilkan catatan sirkulasi:</b></div>';
	echo '<div style="float:left;width:100%">';
		echo '<div style="float:left">';
		echo '<table cellspacing="0" cellpadding="0">';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_pinjam','masih dipinjam',$ct_pinjam).'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_kembali','sudah dikembalikan',$ct_kembali).'</td>',
		'</tr>';
		echo '</table>';
		echo '</div>';
	echo '</div>';
echo '</td><td width="250px">';
	echo '<div class="sfont" style="float:left;width:100%;margin-top:0px;margin-bottom:10px"><b>keterlambatan:</b></div>';
	echo '<div style="float:left;width:100%">';
		echo '<div style="float:left">';
		echo '<table cellspacing="0" cellpadding="0">';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_ttelat','tidak terlambat',$ct_ttelat).'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_telat','terlambat',$ct_telat).'</td>',
		'</tr>';
		echo '</table>';
		echo '</div>';
	echo '</div>';
echo '</td><td width="250px">';
	echo '<div class="sfont" style="float:left;width:100%;margin-top:0px;margin-bottom:10px"><b>peminjam:</b></div>';
	echo '<div style="float:left;width:100%">';
		echo '<div style="float:left">';
		echo '<table cellspacing="0" cellpadding="0">';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_siswa','siswa',$ct_siswa).'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_pegawai','pegawai',$ct_pegawai).'</td>',
		'</tr>';
		echo '<tr height="24px">',
			'<td>'.iCheckx('ct_lain','member luar',$ct_lain).'</td>',
		'</tr>';
		echo '</table>';
		echo '</div>';
	echo '</div>';
echo '</td></tr></table>';
	
echo '<div class="sfont" style="float:left;width:100%;margin-bottom:15px">';
echo '<table cellspacing="0" cellpadding="0"><tr>';
	echo '<td><div class="sfont"><b>periode:</b></div></td>';
	echo '<td width="200px">'.iSelect('ct_periode',array('1'=>'tanggal peminjaman','2'=>'tanggal pengembalian','3'=>'tanggal dikembalikan'),$ct_periode,'margin-left:10px').'</td>';
	echo '<td width="80px"><a href="javascript:void(0)" class="linkb" onclick="sirkulasi_ct_tanggal(1)" >[hari ini]</a></td>';
	echo '<td width="80px"><a href="javascript:void(0)" class="linkb" onclick="sirkulasi_ct_tanggal(2)" >[bulan ini]</a></td>';
echo '</tr></table>';
echo '</div>';
echo '<div style="float:left;width:100%;margin-bottom:30px">';
	echo inputDate('stanggal1',$stanggal1).'<div class="sfont" style="float:left;margin-right:4px;margin-top:4px">&nbsp;sampai&nbsp;</div>'.inputDate('stanggal2',$stanggal2).'<button style="float:left;margin-left:30px;margin-right:4px" class="btnz" onclick="sirkulasi_get()"><div class="">Tampilkan &raquo;</div></button>';
echo '</div>';

$xtable->btnbar_begin();
	$xtable->search_box();
	//$xtable->btnbar_print();
$xtable->btnbar_end();

$xtable->search_info();

if($xtable->ndata>0){
// Table head
	$xtable->head('@Tgl peminjaman','@Peminjam','@Barkode Item','@Judul Item','@Tgl pengembalian','@Status','@Tgl dikembalikan','Terlambat{60px}','Keterangan','{44px}');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
		if($r['mtipe']==1){
			$member=$r['nsiswa'].'<br/>NIS: '.$r['nis'];
		} else if($r['mtipe']==2){
			$member=$r['npegawai'].'<br/>NIP: '.$r['nip'];
		} else {
			$member=$r['nmember'].'<br/>No. ID: '.$r['nid'];
		}
		
		$xtable->td(fftgl($r['tanggal1']),110);
		$xtable->td($member,150);
		$xtable->td($r['barkode'],120,'','item');
		$xtable->td(buku_judul($r['judul']),250);
		//Tgl Pengembalian
		$s=fftgl($r['tanggal2']); //$telat='-';
		
		if($r['status']!=0){
			$lewat=diffDay($r['tanggal2']);
			if($lewat<0 && $r['status']!=0){
				$s='<span style="color:red">'.$s.'</span>';
			}
		} else {
			$telat=diffDay($r['tanggal3'],$r['tanggal2']);
			//if($telat>0)$telat='<br/><span style="color:#ff9000">Terlambat: '.$telat.' hari</span>';
			//else $telat="";
		}
		//Status
		$xtable->td($s,110);
		$xtable->td($r['status']==1?'Dipinjam':'Dikembalikan',80);
		
		//Tgl Dikembalikan
		$xtable->td(fftgl($r['tanggal3']),110);
		
		if($r['status']==0){
			$telat=diffDay($r['tanggal3'],$r['tanggal2']);
			if($telat<=0) 
				$telat='-';
				//$s=$telat;
		}
		$xtable->td(($r['telat']==0?'-':$r['telat'].' hari'),60);
		//$xtable->td($r['telat1'],60);

		$xtable->td($r['keterangan']==''?'&nbsp':nl2br($r['keterangan']));
		
		if($r['status']==1){
			$s='<button class="btn" onclick="sirkulasi_pengembalian_item_form(\'uf\','.$r['replid'].')" title="Kembaliakan item ini."><div class="bi_inb">&nbsp;</div></button>~30';
		} else {
			$s='&nbsp;';
		}
		$xtable->opt($r['replid'],$s);
		
	$xtable->row_end();}$xtable->foot();
} else {
	$xtable->nodata_cust('Tidak ada data.');
}
?>