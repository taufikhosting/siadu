<?php session_start(); require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xtable/xtable.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('keu/rekening');
$sesid=session_id();

// form Module
$fmod="pembayaran";
$dbtable="keu_transaksi";
$fform=new fform($fmod,$opt,$cid);

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$pid=gpost('trans_pembayaran');
		$jt=gpost('trans_jenis');
		$no=gpost('trans_nomer');
		$ct=gpost('trans_ct');
		$tgl=gpost('trans_tanggal');
		$rekkas=gpost('rekkas');
		$rekitem=gpost('rekitem');
		$urai=gpost('uraian');
		$nom=gpost('nominal');
		$rekd=$rekkas; $rekk=$rekitem;
		$q=pembayaran_trans($pid,$no,$ct,$tgl,$rekkas,$rekitem,$urai,$nom);
	}
	else if($opt=='u') { // edit
		$jt=gpost('trans_jenis');
		$urai=gpost('uraian');
		$tgl=gpost('trans_tanggal');
				
		$rekkas=gpost('rekkas');
		$nom=gpost('nominal');
		$rekitem=gpost('rekitem');
		if($rekitem!="-" && $urai!="" && $nom!=0){
			if($jt==JT_OUTCOME) { $rekd=$rekitem; $rekk=$rekkas; }
			else { $rekd=$rekkas; $rekk=$rekitem; }
			$q=transaksi_edit($cid,$tgl,$urai,$nom,$rekd,$rekk,$rekkas,$rekitem);
		}
	}
	else if($opt=='d'){ // delete
		$q=transaksi_hapus($cid);
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
		$jtrans=$r['jenis'];
	} else {
		$r=array('rekkas'=>0);
		$r['tanggal']=date("Y-m-d");
		$jtrans=JT_OUTCOME;
		$no=transaksi_newnomer();
		$r['nomer']=$no['nomer'];
		$r['ct']=$no['ct'];
		
		$pid=gpost('pembayaran');
		$pemb=pembayaran_getdata($pid);
		$r['rekkas']=$pemb['rekkas'];
		$r['rekitem']=$pemb['rekitem'];
		echo "rekitem:".$pemb['rekitem'];
		$r['uraian']=$pemb['uraian'];
		$r['nominal']=$pemb['cicilan'];
	}
	
	$rekening=rekening_opt();
	$rekasbank=rekening_kasbank_opt();
	
	if($opt!='df'){
		if($jtrans==JT_SISWA) $fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_CALONSISWA) $fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_INCOME) $fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_OUTCOME) $fform->title_style='background:#ff1b1b;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_INBANK) $fform->title_style='background:#00c804;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_OUTBANK) $fform->title_style='background:#ff1b1b;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
		if($jtrans==JT_UMUM) $fform->title_style='background:#008aff;color:#fff;height:18px !important;padding:5px 10px 10px 10px !important;margin-bottom:5px';
	}
	if($jtrans==JT_INCOME) $fform->idata='transaksi pemasukan';
	else if($jtrans==JT_OUTCOME) $fform->idata='transaksi pengeluaran';
	else $fform->idata='jurnal umum';//jt_name($jtrans);
	
	if($opt!='df') $fform->ptop=30;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		hiddenval('trans_pembayaran',$pid);
		hiddenval('trans_jenis',$jtrans);
		hiddenval('trans_nomer',$r['nomer']);
		hiddenval('trans_ct',$r['ct']);
		$fform->fl('<b>Nomor transaksi</b>','<b><span id="box_trans_nomer">'.$no['nomer'].'</span></b>');
		$fform->fi('Tanggal',inputTanggal('trans_tanggal',$r['tanggal'],'transaksi_getnomer()'));
		
		$fform->fi('Rek. Kas/Bank',iSelect('rekkas',$rekasbank,$r['rekkas'],$fform->rwidths,'transaksi_getnomer()'));
		$fform->fg('pada');
		$fform->fi('Rek. perkiraan',iSelect('rekitem',$rekening,$r['rekitem'],$fform->rwidths));
		$fform->fa('Uraian',iTextArea('uraian',$r['uraian'],$fform->rwidths,3));
		$fform->fi('Kode',iText('kodebrg',$r['kodebrg'],'width:100px'));
		$fform->fi('Jumlah barang',iText('unit',$r['unit'],'width:100px').' &nbsp;&nbsp;&nbsp;satuan:&nbsp;&nbsp;'.iText('satuan',$r['satuan'],'width:50px'));
		$fform->fi('Nominal',iTextC('nominal',$r['nominal'],'width:120px'));
	
	} else if($opt=='df'){ // Delete form 
		$fform->rheight='';
		$fform->fc('Apakah anda yakin untuk menghapus data transaksi ini?');
		$fform->fl('No. Transaksi','<b>'.$r['nomer'].'</b>');
		$fform->fl('Tanggal',fftgl($r['tanggal']));
		$fform->fl('Uraian',$r['uraian']);
	}
	
	if($opt=='af'){
		$s='<div style="float:right;margin-right:-20px">'.iCheckx('trans_print','Cetak bukti pembayaran',0,'float:right').'</div>';
		$fform->optional_button=$s;
	}
	$fform->foot();
} ?>