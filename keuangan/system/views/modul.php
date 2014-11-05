<?php appmod_use('keu/kategori','keu/rekening','psb/proses','psb/kelompok','aka/angkatan','aka/tahunajaran');
$fmod='modul';
$xtable=new xtable($fmod,'modul pembayaran');

$kmod=gpost('kategori',1);
$kategori=kategori_r();

// Page Selection Bar
$PSBar = new PSBar_2(140);
$PSBar->begin();
	$PSBar->selection('Kategori pembayaran',iSelect('kategori',$kategori,$kmod,$PSBar->selws,$fmod."_get()"));
$PSBar->end();

$s='<button class="btn" title="Tambah data modul pembayaran" style="float:left;margin-right:4px" onclick="E(\'reftipe\').value=0;modul_form(\'af\')"><div class="bi_add">Modul pembayaran</div></button>';
$xtable->btnbar_f($s);

// Query
$db=new xdb("keu_modul","*","kategori='$kmod'","nama");
$t=$db->query();
$xtable->ndata=mysql_num_rows($t);

if($xtable->ndata>0){
	// Table head
	$xtable->head('Nama Pembayaran','Kode Rekening','Keterangan');
	while($r=mysql_fetch_array($t)){$xtable->row_begin();
	
		$xtable->td($r['nama'],300);
		$s='<b>Kas:</b> '.rekening_name($r['rek1']);
		if($r['rek2']!=0) $s.='<br/><b>Pendapatan:</b> '.rekening_name($r['rek2']);
		if($r['rek3']!=0) $s.='<br/><b>Piutang:</b> '.rekening_name($r['rek3']);
		$xtable->td($s,300);
		$s=nl2br($r['keterangan']);
		/*
		if($r['reftipe']!=0){
			if($s!='')$s.='<br/><br/>';
			$s='<div class="infobox"><i>Pembayaran ini terhubung dengan bagian PSB untuk pembayaran biaya pendaftaran calon siswa periode <b>'.proses_name($r['proses']).'</b>'.($r['kelompok']!=0?', kelompok <b>'.kelompok_name($r['kelompok']).'</b>':'').'.</i></div>';
		}
		if($r['angkatan']!=0){
			if($s!='')$s.='<br/><br/>';
			$s='<div class="infobox"><i>Pembayaran ini digunakan untuk pembayaran uang pangkal siswa angkatan <b>'.angkatan_name($r['angkatan']).'</b>.</i></div>';
		}
		if($r['tahunajaran']!=0){
			if($s!='')$s.='<br/><br/>';
			$s='<div class="infobox"><i>Pembayaran ini digunakan untuk pembayaran uang sekolah siswa tahun ajaran <b>'.tahunajaran_name($r['tahunajaran']).'</b>.</i></div>';
		}
		if($r['nominal']!=0){
			if($s!='')$s.='<br/><br/>';
			$s='<div class="infobox">Jumlah pembayaran: '.fRp($r['nominal']).($r['cicilan']==0?'':'<br/>Besar cicilan: '.fRp($r['cicilan'])).'</div>';
		}
		*/
		$xtable->td($s);
		if($r['reftipe']==RT_SPP){
			$q=mysql_query("SELECT departemen FROM aka_tahunajaran WHERE replid='".$r['refid']."' LIMIT 0,1");
			$h=mysql_fetch_array($q);
			$de=mysql_query("SELECT replid FROM departemen WHERE replid='".$h['departemen']."' LIMIT 0,1");
			$d=mysql_fetch_array($de);
			$s='<button class="btn" title="Ke transaksi pembayaran." onclick="openPage('.app_page_getindex('modul_spp').',\'modul_spp\',false,\'departemen='.$d['replid'].'&tahunajaran='.$r['refid'].'\')"><div class="bi_arrow2" style="background-position:53px -214px;">Transaksi</div></button>~80';
		} else if($r['reftipe']==RT_USP){
			$q=mysql_query("SELECT departemen FROM aka_angkatan WHERE replid='".$r['refid']."' LIMIT 0,1");
			$h=mysql_fetch_array($q);
			$de=mysql_query("SELECT replid FROM departemen WHERE replid='".$h['departemen']."' LIMIT 0,1");
			$s='<button class="btn" title="Ke transaksi pembayaran." onclick="openPage('.app_page_getindex('modul_usp').',\'modul_usp\',false,\'departemen='.$d['replid'].'&angkatan='.$r['refid'].'\')"><div class="bi_arrow2" style="background-position:53px -214px;">Transaksi</div></button>~80';
		} else if($r['reftipe']==RT_PSB){
			$q=mysql_query("SELECT departemen FROM psb_proses WHERE replid='".$r['refid']."' LIMIT 0,1");
			$h=mysql_fetch_array($q);
			$de=mysql_query("SELECT replid FROM departemen WHERE replid='".$h['departemen']."' LIMIT 0,1");
			$s='<button class="btn" title="Ke transaksi pembayaran." onclick="openPage('.app_page_getindex('modul_psb').',\'modul_psb\',false,\'departemen='.$d['replid'].'&proses='.$r['refid'].'\')"><div class="bi_arrow2" style="background-position:53px -214px;">Transaksi</div></button>~80';
		} else {
			$s='';
		}
		
		$u='<button class="btn" title="Edit" onclick="E(\'reftipe\').value='.$r['reftipe'].';modul_form(\'uf\',\''.$r['replid'].'\')"><div class="bi_editb">&nbsp;</div></button>';
		$xtable->opt($r['replid'],$u,'d',$s);
		
	$xtable->row_end();}$xtable->foot();
}else{$xtable->nodata();}

hiddenval('reftipe',0);
hiddenval('refid',0);
hiddenval('snama','');
?>