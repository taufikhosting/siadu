<?php session_start(); require_once(MODDIR.'fform/fform.php'); require_once(MODDIR.'xtable/xtable.php'); $opt=gpost('opt');$cid=gpost('cid');if($cid=='')$cid=0;
appmod_use('keu/rekening');
$sesid=session_id();

// form Module
$fmod="inventory_penerimaan";
$dbtable="keu_transaksi";
$fform=new fform($fmod,$opt,$cid,'penerimaan barang');
$fform->globalkey='0';

if($opt=='a'||$opt=='u'||$opt=='d'){ $q=false;
	if($opt=='a'){ // add
		$nomerbukti=gpost('nomerbukti');
		$kodebrg=gpost('kodebrg');
		$namabrg=gpost('namabrg');
		$unit=gpost('unit');
		$satuan=gpost('satuan');
		
		$pid=gpost('trans_pembayaran');
		$jt=gpost('trans_jenis');
		$no=gpost('trans_nomer');
		$ct=gpost('trans_ct');
		$tgl=gpost('trans_tanggal');
		$rekkas=gpost('rekkas');
		$rekitem=gpost('rekitem');
		$urai=gpost('uraian');
		$nom=gpost('nominal');
		$rekd=$rekitem; $rekk=$rekkas;
		
		$q=dbInsert("keu_penerimaanbrg",array('nomerbukti'=>$nomerbukti,'kodebrg'=>$kodebrg,'namabrg'=>$namabrg,'unit'=>$unit,'satuan'=>$satuan,'nominal'=>$nom));
		if($q){
			$t1=mysql_query("SELECT replid,unit FROM keu_brg WHERE kode='$kodebrg' LIMIT 0,1");
			if(mysql_num_rows($t1)>0){
				$r1=mysql_fetch_array($t1);
				$unit=intval($r1['unit'])+intval($unit);
				mysql_query("UPDATE keu_brg SET unit='$unit',tanggal='$tgl' WHERE replid='".$r1['replid']."'");
			} else {
				dbInsert("keu_brg",array('kode'=>$kodebrg,'kelompokbrg'=>1,'nama'=>$namabrg,'unit'=>$unit,'satuan'=>$satuan,'tanggal'=>$tgl));
			}
		}
		$pbrg=mysql_insert_id();
		$q=transaksi_post($no,$ct,$tgl,$urai,$nom,$rekd,$rekk,$rekkas,$rekitem,JT_INBRG,0,0,$pbrg);
		
		$tprint=gpost('trans_print',0);
		if($tprint!=0) echo $no;
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
		
		$r['rekkas']=0;
		$r['rekitem']=0;
		//echo "rekitem:".$pemb['rekitem'];
		$r['unit']=1;
		$r['satuan']='unit';
		$r['uraian']='Penerimaan barang.'.chr(13).'Jumlah barang: 1 unit.';
	}
	
	$rekening=rekening_nokasbank_opt();
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
	
	if($opt!='df') $fform->ptop=20;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		hiddenval('trans_pembayaran',$pid);
		hiddenval('trans_jenis',$jtrans);
		hiddenval('trans_nomer',$r['nomer']);
		hiddenval('trans_ct',$r['ct']);
		$fform->fl('<b>Nomor</b>','<b><span id="box_trans_nomer">'.$no['nomer'].'</span></b>');
		$fform->fi('Tanggal',inputTanggal('trans_tanggal',$r['tanggal'],'transaksi_getnomer()'));
		
		$fform->fi('Rek. Kas/Bank',iSelect('rekkas',$rekasbank,$r['rekkas'],$fform->rwidths,'transaksi_getnomer()'));
		$fform->fg('pada');
		$fform->fi('Rek. perkiraan',iSelect('rekitem',$rekening,$r['rekitem'],$fform->rwidths));
		$fform->fi('Nomor bukti penerimaan',iText('nomerbukti',$r['nomerbukti'],$fform->rwidths,'','','onkeyup="inventory_penerimaan_data_get()"'));
		$fform->fi('Kode barang',iText('kodebrg',$r['kodebrg'],'width:100px','','','onkeyup="inventory_penerimaan_data_get()"'));
		$fform->fi('Nama barang',iText('namabrg',$r['namabrg'],$fform->rwidths,'','','onkeyup="inventory_penerimaan_data_get()"'));
		$fform->fi('Jumlah barang',iText('unit',$r['unit'],'width:50px','','','onkeyup="inventory_penerimaan_data_get()"').' &nbsp;&nbsp;&nbsp;satuan:&nbsp;&nbsp;'.iText('satuan',$r['satuan'],'width:50px','','','onkeyup="inventory_penerimaan_data_get()"'));
		$fform->fa('Uraian',iTextArea('uraian',$r['uraian'],$fform->rwidths,5));
		$fform->fi('Nominal',iTextC('nominal',$r['nominal'],'width:120px'));
	
	} else if($opt=='df'){ // Delete form 
		$fform->rheight='';
		$fform->fc('Apakah anda yakin untuk menghapus data transaksi ini?');
		$fform->fl('Nomor','<b>'.$r['nomer'].'</b>');
		$fform->fl('Tanggal',fftgl($r['tanggal']));
		$fform->fl('Uraian',$r['uraian']);
	}
	
	if($opt=='af'){
		$s='<div style="float:right;margin-right:-20px">'.iCheckx('trans_print','Cetak bukti pembayaran',0,'float:right').'</div>';
		$fform->optional_button=$s;
	}
	$fform->foot();
} ?>