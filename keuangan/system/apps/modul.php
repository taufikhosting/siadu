<?php 
require_once(MODDIR.'fform/fform.php'); 
$opt=gpost('opt');
$cid=gpost('cid');
if($cid=='')
	$cid=0;
appmod_use('keu/kategori','keu/rekening','aka/angkatan','aka/tahunajaran','aka/siswa');
// form Module
$fmod='modul';
$dbtable='keu_modul';
$fform=new fform($fmod,$opt,$cid,'Modul pembayaran');

$inp=app_form_gpost('kategori','reftipe','refid','nama','rek1','rek2','rek3','keterangan','nominal','cicilan');

if($opt=='a'||$opt=='u'||$opt=='d'){ 
	$q=false;
	if($opt=='a'){ // add
		$q=dbInsert($dbtable,$inp);
		if($q){
			$modid=mysql_insert_id(); $refid=$inp['refid'];
			$pemb=array('modul'=>$modid,'siswa'=>0,'nominal'=>0,'cicilan'=>0);
			
			if($inp['reftipe']==RT_USP){ $piut=0; // Set pembayaran uang pangkal
				$t=mysql_query("SELECT aka_siswa.replid,aka_siswa.sumnet,aka_siswa.angsuran FROM aka_siswa WHERE aka_siswa.angkatan='$refid'");
				while($r=mysql_fetch_array($t)){
					$pemb['siswa']=$r['replid'];
					$pemb['nominal']=$r['sumnet'];
					$pemb['cicilan']=$r['angsuran'];
					$q=dbInsert("keu_pembayaran",$pemb);
					if($q) $piut+=$pemb['nominal'];
				}
				$jur=array();
				$jur[0]=array('rek'=>$inp['rek3'],'debet'=>$piut,'kredit'=>0);
				$jur[1]=array('rek'=>$inp['rek2'],'debet'=>0,'kredit'=>$piut);
				$q=transaksi_posting_auto("Target pendapatan uang pangkal angkatan ".angkatan_name($refid).".",$jur);
			}else if($inp['reftipe']==RT_SPP){ 
				$piut=0; // Set pembayaran uang sekolah
				$db = siswa_db_bytahunajaran($refid,"sppbulan");
				$t=$db->query();
				log_print("mysql_num_rows(t):".mysql_num_rows($t).";");
				while($r=mysql_fetch_array($t)){
					$pemb['siswa']=$r['replid'];
					$pemb['nominal']=$r['sppbulan']*12;
					$pemb['cicilan']=$r['sppbulan'];
					$q=dbInsert("keu_pembayaran",$pemb);
					if($q) 
						$piut+=$pemb['nominal'];
				}
				$jur=array();
				$jur[0]=array('rek'=>$inp['rek3'],'debet'=>$piut,'kredit'=>0);
				$jur[1]=array('rek'=>$inp['rek2'],'debet'=>0,'kredit'=>$piut);
				$q=transaksi_posting_auto("Target pendapatan sekolah tahun ajaran ".tahunajaran_name($refid).".",$jur);
			}
		}
	}
	else if($opt=='u') { // edit
		$q=dbUpdate($dbtable,$inp,"replid='$cid'");
	}
	else if($opt=='d'){ // delete
		$q=dbDel($dbtable,"replid='$cid'");
	}
	$fform->notif($q);
} else {
	if($opt=='uf'||$opt=='df'){ // Prepocessing form
		$r=dbSFA("*",$dbtable,"W/replid='$cid'");
	} else {
		$r=array();
		$r['nama']=gpost('snama');
		$r['kategori']=gpost('kategori');
		$r['rek1']='-'; $r['rek2']='-'; $r['rek3']='-';
		$r['nominal']=0; $r['cicilan']=0;
		$r['reftipe']=gpost('reftipe');
		$r['refid']=gpost('refid');
	}
	$rekening=rekening_opt();
	
	$fform->dimension(440,140);
	if($opt!='df')$fform->ptop=20;
	$fform->head();
	if($opt=='af' || $opt=='uf'){ require_once(MODDIR.'control.php'); // Add or Edit form
	
		hiddenval('mod_reftipe',$r['reftipe']);
		hiddenval('mod_refid',$r['refid']);
		$fform->fl('Kategori pembayaran',kategori_name($r['kategori']));		
		
		if($r['reftipe']==RT_SPP){
			$fform->fl('Nama pembayaran',$r['nama']);
			hiddenval('nama',$r['nama']);
			$fform->fi('Rek. kas',iSelect('rek1',$rekening,$r['rek1'],$fform->rwidths));
			$fform->fi('Rek. pendapatan',iSelect('rek2',$rekening,$r['rek2'],$fform->rwidths));
			$fform->fi('Rek. piutang',iSelect('rek3',$rekening,$r['rek3'],$fform->rwidths));
			hiddenval('nominal',0);
			hiddenval('cicilan',0);
		} else if($r['reftipe']==RT_PSB){
			$fform->fl('Nama pembayaran',$r['nama']);
			hiddenval('nama',$r['nama']);
			$fform->fi('Rek. kas',iSelect('rek1',$rekening,$r['rek1'],$fform->rwidths));
			$fform->fi('Rek. pendapatan',iSelect('rek2',$rekening,$r['rek2'],$fform->rwidths));
			hiddenval('rek3',0);
			hiddenval('nominal',0);
			hiddenval('cicilan',0);
		} else if($r['reftipe']==RT_USP){
			$fform->fl('Nama pembayaran',$r['nama']);
			hiddenval('nama',$r['nama']);
			$fform->fi('Rek. kas',iSelect('rek1',$rekening,$r['rek1'],$fform->rwidths));
			$fform->fi('Rek. pendapatan',iSelect('rek2',$rekening,$r['rek2'],$fform->rwidths));
			$fform->fi('Rek. piutang',iSelect('rek3',$rekening,$r['rek3'],$fform->rwidths));
			hiddenval('nominal',0);
			hiddenval('cicilan',0);
		} else {
			$fform->fi('Nama pembayaran',iText('nama',$r['nama'],$fform->rwidths));
			$fform->fi('Rek. kas',iSelect('rek1',$rekening,$r['rek1'],$fform->rwidths));
			$fform->fi('Rek. pendapatan',iSelect('rek2',$rekening,$r['rek2'],$fform->rwidths));
			if($r['kategori']==1 || $r['kategori']==3){
				$fform->fi('Rek. piutang',iSelect('rek3',$rekening,$r['rek3'],$fform->rwidths));
				$fform->fi('Jml pembayaran',iTextC('nominal',$r['nominal'],'width:120px'));
				$fform->fi('Besar cicilan',iTextC('cicilan',$r['cicilan'],'width:120px'));
			} else {
				$fform->fi('Jml pembayaran',iTextC('nominal',$r['nominal'],'width:120px'));
				hiddenval('rek3',0);
				hiddenval('cicilan',0);
			}
		}
		
		$fform->fa('Keterangan',iTextarea('keterangan',$r['keterangan'],$fform->rwidths,3));
		
	} else if($opt=='df'){ // Delete form 
	
		$fform->dlg_del($r['nama']);
		
	} $fform->foot();
} ?>