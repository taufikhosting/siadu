<?php 
session_start(); 
require_once(MODDIR.'fform/fform.php'); 
require_once(MODDIR.'xtable/xtable.php'); 
$opt=gpost('opt');
$cid=gpost('cid');
if($cid=='')
	$cid=0;
appmod_use('keu/rekening','keu/budget'); 
require_once(MODDIR.'control.php');
$sesid=session_id();

// form Module
$fmod    ="transaksi";
$dbtable ="keu_transaksi";
$fform   =new fform($fmod,$opt,$cid);

if($opt=='a'||$opt=='u'||$opt=='d'){ //add, update, delete
	$q=false;
	if($opt=='a'){ // add
		$jt      =gpost('trans_jenis');
		$no      =gpost('trans_nomer');
		$nobukti =gpost('trans_nobukti');
		$ct      =gpost('trans_ct');
		$tgl     =gpost('trans_tanggal');
		$bud     =gpost('budget');
		
		if($jt==JT_UMUM){
			$urai =gpost('uraian'); 
			$jur  =array(); 
			$l    =0; 
			$nom  =0;
			
			for($i=1;$i<=8;$i++){
				$rekitem = gpost('rekitem'.$i);
				$debet   = gpost('debet'.$i);
				$kredit  = gpost('kredit'.$i);
				//log_print("transaksi: rekitem".$i"=".$rekitem." debet".$i."=".$debet
				if($rekitem!="-"){
					$jur[$l]=array();
					$jur[$l]['rek']=$rekitem;
					$jur[$l]['debet']=$debet;
					$jur[$l]['kredit']=$kredit;
					$nom+=$debet;
					$l++;
				}
			}
			//function transaksi_posting($no,$ct,$tgl,$urai,$jur,$jt=JT_UMUM,$kat=0,$nobukti='')
			$q=transaksi_posting($no,$ct,$tgl,$urai,$jur,JT_UMUM,0,$nobukti);
		} else {
			//transaksi_post($tgl,$urai,$nom,$rekd,$rekk,$jt=JT_INCOME,$mod=0);
			$rekkas=gpost('rekkas');
			
			for($i=1;$i<=8;$i++){
				$urai=gpost('uraian'.$i);
				$nom=gpost('nominal'.$i);
				$rekitem=gpost('rekitem'.$i);
				if($rekitem!="-" && $nom!=0){
					if($jt==JT_OUTCOME) { $rekd=$rekitem; $rekk=$rekkas; }
					else { $rekd=$rekkas; $rekk=$rekitem; }
					//transaksi_post($no,$ct,$tgl,$urai,$nom,$rekd,$rekk,$rekkas=0,$rekitem=0,$jt=JT_UMUM,$pem=0,$kat=0,$pbrg=0,$bud=0,$nobukti='')
					$q=transaksi_post($no,$ct,$tgl,$urai,$nom,$rekd,$rekk,$rekkas,$rekitem,$jt,0,0,0,$bud,$nobukti);
				}
			}
		}
		//echo "trans_print:".gpost('trans_print',$q);
		$tprint=gpost('trans_print',0);
		if($tprint!=0) echo $no;
	}
	else if($opt=='u') { // edit
		$jt=gpost('trans_jenis');
		$urai=gpost('uraian');
		$tgl=gpost('trans_tanggal');
		
		if($jt==JT_UMUM){
			$jur=array(); $l=0; $nom=0;
			for($i=1;$i<=8;$i++){
				$rekitem=gpost('rekitem'.$i);
				$debet=gpost('debet'.$i);
				$kredit=gpost('kredit'.$i);
				//log_print("transaksi: rekitem".$i"=".$rekitem." debet".$i."=".$debet
				if($rekitem!="-"){
					$jur[$l]=array();
					$jur[$l]['rek']=$rekitem;
					$jur[$l]['debet']=$debet;
					$jur[$l]['kredit']=$kredit;
					$nom+=$debet;
					$l++;
				}
			}
			$q=transaksi_update($cid,$tgl,$urai,$jur);
		} else {
			$rekkas=gpost('rekkas');
			$nom=gpost('nominal');
			$rekitem=gpost('rekitem');
			if($rekitem!="-" && $nom!=0){
				if($jt==JT_OUTCOME) { $rekd=$rekitem; $rekk=$rekkas; }
				else { $rekd=$rekkas; $rekk=$rekitem; }
				$q=transaksi_edit($cid,$tgl,$urai,$nom,$rekd,$rekk,$rekkas,$rekitem);
			}
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
		$r=array('rekkas'=>0,'budget'=>0);
		$r['tanggal']=date("Y-m-d");
		$jtrans=gpost('jenistransaksi',JT_UMUM);
	}
	
	if($jtrans==JT_UMUM){
		if($opt!='df'){
			$fform->dimension(500,120);
			$fform->ptop=50;
		}
	} else {
		if($opt=='af'){ // af : add form 
			$fform->dimension(760,120);
			$fform->ptop=50;
		}
	}
	//if($opt!='df') $fform->ptop=50;
	
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
	
	$budget=budget_opt(1,1);
	
	$fform->head();
	if($opt=='af'){ require_once(MODDIR.'control.php'); // Add or Edit form
		$no=transaksi_newnomer();
		hiddenval('trans_jenis',$jtrans);
		hiddenval('trans_nomer',$no['nomer']);
		hiddenval('trans_ct',$no['ct']);
		
		$fform->fl('<b>No. Jurnal</b>','<b><span id="box_trans_nomer">'.$no['nomer'].'</span></b>');
		$fform->fi('<b>No. Bukti</b>',iText('trans_nobukti','','width:300px'));
		$fform->fi('Tanggal',inputTanggal('trans_tanggal',$r['tanggal'],'transaksi_getnomer()'));
		
		if($jtrans==JT_UMUM){
			$rekening=rekening_opt();
			$fform->fa('Uraian',iTextArea('uraian',$r['uraian'],$fform->rwidths,3));
			
			echo '<tr height=""><td id="box_transaksi_list" colspan="2"><div style="">';
				
			$fmod='tpi_lain_transaksi_list';
			$xtable=new xtable($fmod,'siswa');
			$xtable->noopt=true;
			$xtable->row_strip=false;
			//$xtable->tbl_width='';

			$dsp='';
			$xtable->head('Rek. Perkiraan','Debet','Kredit');
			// loop 3 combo box 
			for($i=1;$i<=10;$i++){
				if($i==5) $dsp='none';
				$xtable->row_begin($i,'style="display:'.$dsp.'"');
				$xtable->td(iSelect('rekitem'.$i,$rekening,'-','width:100%')); // traget :: autosuggest ::
				// $xtable->td(iSuggest()); // traget :: autosuggest ::
				$xtable->td(iTextC('debet'.$i,0,'text-align:right;width:120px'),120);
				$xtable->td(iTextC('kredit'.$i,0,'text-align:right;width:120px'),120);
				$xtable->row_end();
			}//end of : loop 3 combo box 
			$xtable->foot();
			
			hiddenval('transaksi_list_num',4);
		} else {
			$rekening=rekening_nokasbank_opt();
			$rekkasbank=rekening_kasbank_opt();
			$fform->fi('Rek. Kas/Bank',iSelect('rekkas',$rekkasbank,'-','','transaksi_getnomer()'));
			$fform->fg('pada '.jt_name($jtrans));
			
			echo '<tr height=""><td id="box_transaksi_list" colspan="2"><div style="">';
				
				$fmod='tpi_lain_transaksi_list';
				$xtable=new xtable($fmod,'siswa');
				$xtable->noopt=true;
				$xtable->row_strip=false;

				$dsp='';
				$xtable->head('Rek. Perkiraan{180px}','Uraian','Nominal{R}');
				for($i=1;$i<=10;$i++){
					if($i==4) $dsp='none';
					$xtable->row_begin($i,'style="display:'.$dsp.'"');
						$xtable->td(iSelect('rekitem'.$i,$rekening,'-','width:180px'),80);
						$xtable->td(iTextArea('uraian'.$i,'','width:100%;min-height:24px;',1));
						$xtable->td(iTextC('nominal'.$i,0,'text-align:right;width:120px','','onblur="transaksi_getsubtotal();'.($jtrans==JT_OUTCOME?'transaksi_cekbudget()':'').'"'),120);
					$xtable->row_end();
				}
				echo '<tr valign="" style="display:" class="xtr0"><td></td><td align="center"><b>Jumlah</b></td><td id="trans_subtotal" align="right"><div id="trans_subtotal"><b>Rp 0</b></div></td></tr>';
				$xtable->foot();
				
				hiddenval('transaksi_list_num',3);
				
				$s='<div id="tlist_add" style="float:left;margin-top:6px;margin-bottom:6px"><a href="javascript:void(0)" onclick="transaksi_list_add()" class="linkb">Tambah baris perkiraan...</a></div>';
				echo $s;
				
			echo '</div></td></tr>';			
		}
		if($jtrans==JT_OUTCOME){
			$fform->fi('<b>pada anggaran</b>',iSelect('budget',$budget,$r['budget'],$fform->rwidths,'transaksi_cekbudget()'));
		} else {
			hiddenval('budget',0);
		}
		
	} else if($opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
		hiddenval('trans_jenis',$r['jenis']);
			$fform->fl('<b>Nomor transaksi</b>','<b>'.$r['nomer'].'</b>');
			$fform->fi('Tanggal',inputTanggal('trans_tanggal',$r['tanggal']));
		if($jtrans==JT_UMUM){
			$rekening=rekening_opt();
			$fform->fa('Uraian',iTextArea('uraian',$r['uraian'],$fform->rwidths,3));
			echo '<tr height=""><td id="box_transaksi_list" colspan="2"><div style="">';
			$fmod='tpi_lain_transaksi_list';
			$xtable=new xtable($fmod,'siswa');
			$xtable->noopt=true;
			$xtable->row_strip=false;
			$xtable->tbl_width='';

			$dsp='';
			$xtable->head('Rek. Perkiraan{80px}','Debet','Kredit');
			$t1=mysql_query("SELECT * FROM keu_jurnal WHERE transaksi='$cid' ORDER BY replid"); $l=1; $rs=0;
			while($r1=mysql_fetch_array($t1)){
				$xtable->row_begin($l,'style="display:"');
					$xtable->td(iSelect('rekitem'.$l,$rekening,$r1['rek'],'width:80px'),80);
					$xtable->td(iTextC('debet'.$l,$r1['debet'],'width:120px'),120);
					$xtable->td(iTextC('kredit'.$l,$r1['kredit'],'width:120px'),120);
				$xtable->row_end();
				$l++; $rs++;
			}
			for($i=$l;$i<=10;$i++){
				if($i>4) $dsp='none';
				else $rs++;
				$xtable->row_begin($i,'style="display:'.$dsp.'"');
					$xtable->td(iSelect('rekitem'.$i,$rekening,'-','width:80px'),80);
					$xtable->td(iTextC('debet'.$i,0,'width:120px'),120);
					$xtable->td(iTextC('kredit'.$i,0,'width:120px'),120);
				$xtable->row_end();
			}
			$xtable->foot();
			
			$s='<div id="tlist_add" style="float:left;margin-top:6px;margin-bottom:6px"><a href="javascript:void(0)" onclick="transaksi_list_add()" class="linkb">Tambah baris perkiraan...</a></div>';
			echo $s;
				
			hiddenval('transaksi_list_num',$rs);
			echo '</div></td></tr>';
		} else {
			$rekening=rekening_nokasbank_opt();
			$rekkasbank=rekening_kasbank_opt();
			$fform->fi('Rek. Kas/Bank',iSelect('rekkas',$rekkasbank,$r['rekkas'],$fform->rwidths));
			$fform->fg('pada '.jt_name($r['jenis']));
			$fform->fi('Rek. perkiraan',iSelect('rekitem',$rekening,$r['rekitem'],$fform->rwidths));
			$fform->fa('Uraian',iTextArea('uraian',$r['uraian'],$fform->rwidths,3));
			$fform->fi('Nominal',iTextC('nominal',$r['nominal'],'width:120px'));
		}
		if($jtrans==JT_OUTCOME){
			$fform->fi('<b>pada anggaran</b>',iSelect('budget',$budget,$r['budget'],$fform->rwidths,'transaksi_cekbudget()'));
		} else {
			hiddenval('budget',0);
		}
	
	} else if($opt=='df'){ // Delete form 
		$fform->rheight='';
		$fform->fc('Apakah anda yakin untuk menghapus data transaksi ini?');
		$fform->fl('Nomor','<b>'.$r['nomer'].'</b>');
		$fform->fl('Tanggal',fftgl($r['tanggal']));
		$fform->fl('Uraian',$r['uraian']);
		//$fform->fl('Nominal',fRp($r['nominal']));
		
	}
	if($opt=='af' || ($opt=='uf' && $jtrans==JT_UMUM)){
		$s='';//'<div id="tlist_add" style="float:left"><a href="javascript:void(0)" onclick="transaksi_list_add()" class="linkb">Tambah baris perkiraan...</a></div>';
		if($jtrans!=JT_UMUM) $s.='<div style="float:right;margin-right:-20px">'.iCheckx('trans_print','Cetak bukti transaksi',0,'float:right').'</div>';
		else $s.=iCheckx('trans_print','Cetak bukti transaksi',0,'float:right;display:none');
		$fform->optional_button=$s;
	} else {
		$s=iCheckx('trans_print','Cetak bukti transaksi',0,'float:right;display:none');
		$fform->optional_button=$s;
	}
	$fform->foot();
} ?>